<?php

/**
 * Email helper functions
 */
class EmailHelpers
{
    /**
     * Creates a mailer from the app settings
     * @return Swift_Mailer The created mailer
     */
    public static function createMailer()
    {
        // verify we have username/password to send out emails - IMPORTANT
        if (!sfconfig::has('app_mailer_username') or !sfconfig::has('app_mailer_password'))
        {
            throw new sfException('SMTP username/password is required to send email out');
        }
        
        // Create a smtp session
        $connection = Swift_SmtpTransport::newInstance(sfconfig::get('app_mailer_host'),
                                                       sfconfig::get('app_mailer_port'), 
                                                       sfconfig::get('app_mailer_encryption'))
            ->setUsername(sfconfig::get('app_mailer_username'))
            ->setPassword(sfconfig::get('app_mailer_password'));

        // setup connection/content
        return Swift_Mailer::newInstance($connection);
    }
    
    /**
     * Library to facilitate email messages being sent out, sendMail deprecated in symfony 1.2
     * Based on SendGrid documentation http://docs.sendgrid.com/documentation/get-started/integrate/examples/symfony-example-using-smtp/
     *
     * @param string $partial - Array with html and text partials ie array('text'=>'textPartial', 'html'=>'htmlPartial')
     * @param array $parameters - Array we will pass into the partials
     * @param string $mailFrom - Email source
     * @param string $mailTo - Email destination
     * @param string $subject - The subject of the email message
     * @param array $sgHeaders - What we will be placing in the SMTPAPI header. Must be null or a non-empty array
     * @param array $attachments - Email contains the attachments
     */
    public static function sendEmail($partials, $parameters, $mailFrom, $mailTo, $subject, $sgHeaders = null, $attachments = null)
    {
        $text = null;
        $html = null;
        if (is_array($partials))
        {
            // load libraries
            sfContext::getInstance()->getConfiguration()->loadHelpers('Partial');
            if (isset($partials['text']))
            {
                $text = get_partial($partials['text'], $parameters);
            }
            if (isset($partials['html']))
            {
                $html = get_partial($partials['html'], $parameters);
            }
        }
        if ($text === null && $html === null)
        {
            throw new sfException('A text and/or HTML partial must be given');
        }

        try
        {
            // Create the message
            $message = Swift_Message::newInstance()->setSubject($subject)->setTo($mailTo);

            if ($text && $html)
            {
                $message->setBody($html, 'text/html');
                $message->addPart($text, 'text/plain');
            }
            else if ($text)
            {
                $message->setBody($text, 'text/plain');
            }
            else
            {
                $message->setBody($html, 'text/html');
            }

            // if contains SMTPAPI header add it
            if (null !== $sgHeaders)
            {
                $message->getHeaders()->addTextHeader('X-SMTPAPI', json_encode($sgHeaders));
            }

            // update the from address line to include an actual name
            if (is_array($mailFrom) and count($mailFrom) == 2)
            {
                $mailFrom = array($mailFrom['email'] => $mailFrom['name']);
            }

            // add attachments to email
            if ($attachments !== null and is_array($attachments))
            {
                foreach ($attachments as $attachment)
                {
                    $attach = Swift_Attachment::fromPath($attachment['file'], $attachment['mime'])->setFilename($attachment['filename']);
                    $message->attach($attach);
                }
            }

            // Send
            $message->setFrom($mailFrom);
            
            // setup connection/content
            $mailer = EmailHelpers::createMailer();
            $messagesSent = $mailer->send($message);
            
            // Log the message
            sfContext::getInstance()->getLogger()->info('MessagesSent='.$messagesSent);
        }
        catch (Exception $e)
        {
            throw new sfException('Error sending email out - ' . $e->getMessage());
        }
    }
}

?>
