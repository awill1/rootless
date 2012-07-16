<?php

/**
 * sfSnsLogger Logs messages to Amazon Simple Notification Service (SNS).
 *
 * @package    rootlessme
 * @subpackage log
 * @author     awilliams
 * @version    SVN: $Id: sfFileLogger.class.php 10964 2008-08-19 18:33:50Z fabien $
 */
class sfSnsLogger extends sfLogger
{
    protected
        $snsService = null,
        $subject    = 'Operational message',
        $arn        = null,
        $access_key = null,
        $secret_key = null,
        $type       = 'symfony',
        $format     = '%time% %type% [%priority%] %message%%EOL%',
        $timeFormat = '%b %d %H:%M:%S';

    /**
     * Initializes this logger.
     *
     * Available options:
     *
     * - arn:         The Amazon ARN for the SNS topic which the log message is 
     *                published to.
     * - access_key:  The access key for the AWS user
     * - secret_key:  The secret key for the AWS user
     * - subject:     The subject of the notification message
     * - format:      The log line format (default to %time% %type% [%priority%] %message%%EOL%)
     * - time_format: The log time strftime format (default to %b %d %H:%M:%S)
     *
     * @param  sfEventDispatcher $dispatcher  A sfEventDispatcher instance
     * @param  array             $options     An array of options.
     *
     * @return Boolean      true, if initialization completes successfully, otherwise false.
     */
    public function initialize(sfEventDispatcher $dispatcher, $options = array())
    {
        // Load the AWS SDK
        require_once sfConfig::get('app_amazon_sdk_file');
        
        if (!isset($options['arn']))
        {
            throw new sfConfigurationException('You must provide a "arn" parameter for this logger.');
        }
        $this->arn = $options['arn'];

        if (!isset($options['access_key']))
        {
            throw new sfConfigurationException('You must provide a "access_key" parameter for this logger.');
        }
        $this->access_key = $options['access_key'];

        if (!isset($options['secret_key']))
        {
            throw new sfConfigurationException('You must provide a "secret_key" parameter for this logger.');
        }
        $this->secret_key = $options['secret_key'];

        if (isset($options['subject']))
        {
            $this->subject = $options['subject'];
        }

        if (isset($options['type']))
        {
            $this->type = $options['type'];
        }

        if (isset($options['format']))
        {
            $this->format = $options['format'];
        }

        if (isset($options['time_format']))
        {
            $this->timeFormat = $options['time_format'];
        }

        // Create the SNS service    
        $this->snsService = new AmazonSNS(array('key' => $this->access_key, 
                                                'secret' => $this->secret_key));

        // Call the parent initializer
        return parent::initialize($dispatcher, $options);
    }

    /**
     * Logs a message.
     *
     * @param string $message   Message
     * @param string $priority  Message priority
     */
    protected function doLog($message, $priority)
    {
        // Create the formatted message
        $formattedMessage = strtr($this->format, array(
            '%type%'     => $this->type,
            '%message%'  => $message,
            '%time%'     => strftime($this->timeFormat),
            '%priority%' => $this->getPriority($priority),
            '%EOL%'      => PHP_EOL,
        ));
        // Publish the log message to SNS
        $this->snsService->publish($this->arn, $formattedMessage, array('Subject' => $this->subject));
    }

    /**
     * Returns the priority string to use in log messages.
     *
     * @param  string $priority The priority constant
     *
     * @return string The priority to use in log messages
     */
    protected function getPriority($priority)
    {
        return sfLogger::getPriorityName($priority);
    }
}
