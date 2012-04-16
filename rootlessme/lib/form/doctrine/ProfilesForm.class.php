<?php

/**
 * Profiles form.
 *
 * @package    RootlessMe
 * @subpackage form
 * @author     awilliams
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ProfilesForm extends BaseProfilesForm
{
    /**
     * Configures the profiles form
     */
    public function configure()
    {
        // Set up the extra widgets
        $this->setWidget('picture_url', new sfWidgetFormInputFile());

        // Hide the other file inputs since they will be derived from the
        // uploaded file
        $this->setWidget('picture_url_large', new sfWidgetFormInputHidden());
        $this->setWidget('picture_url_medium', new sfWidgetFormInputHidden());
        $this->setWidget('picture_url_small', new sfWidgetFormInputHidden());
        $this->setWidget('picture_url_tiny', new sfWidgetFormInputHidden());

        // Change the birthday widget to be a textbox
        $this->setWidget('birthday', new sfWidgetFormInputText());

        // Setup the extra validators
        $this->setValidator('picture_url', new sfValidatorFile(array(
            'required' => false,
            'mime_types' => 'web_images',
            'path' => sfConfig::get('sf_upload_dir').'/assets/profile_pictures')));
        
        // Change some of the widgets to be dropdowns
        $this->setWidget('country', new sfWidgetFormI18nChoiceCountry());
        $this->setWidget('gender', new sfWidgetFormChoice(array('choices' => array(null => '' , 'male' => 'Male', 'female' => 'Female'))));
        $this->setWidget('state', new sfWidgetFormChoice(array('choices' => array
           (null => '',
            'AL' => 'Alabama',
            'AK' => 'Alaska',
            'AZ' => 'Arizona',
            'AR' => 'Arkansas',
            'CA' => 'California',
            'CO' => 'Colorado',
            'CT' => 'Connecticut',
            'DE' => 'Delaware',
            'DC' => 'District of Columbia',
            'FL' => 'Florida',
            'GA' => 'Georgia',
            'HI' => 'Hawaii',
            'ID' => 'Idaho',
            'IL' => 'Illinois',
            'IN' => 'Indiana',
            'IA' => 'Iowa',
            'KS' => 'Kansas',
            'KY' => 'Kentucky',
            'LA' => 'Louisiana',
            'ME' => 'Maine',
            'MD' => 'Maryland',
            'MA' => 'Massachusetts',
            'MI' => 'Michigan',
            'MN' => 'Minnesota',
            'MS' => 'Mississippi',
            'MO' => 'Missouri',
            'MT' => 'Montana',
            'NE' => 'Nebraska',
            'NV' => 'Nevada',
            'NH' => 'New Hampshire',
            'NJ' => 'New Jersey',
            'NM' => 'New Mexico',
            'NY' => 'New York',
            'NC' => 'North Carolina',
            'ND' => 'North Dakota',
            'OH' => 'Ohio',
            'OK' => 'Oklahoma',
            'OR' => 'Oregon',
            'PA' => 'Pennsylvania',
            'RI' => 'Rhode Island',
            'SC' => 'South Carolina',
            'SD' => 'South Dakota',
            'TN' => 'Tennessee',
            'TX' => 'Texas',
            'UT' => 'Utah',
            'VT' => 'Vermont',
            'VA' => 'Virginia',
            'WA' => 'Washington',
            'WV' => 'West Virginia',
            'WI' => 'Wisconsin',
            'WY' => 'Wyoming'))));

        unset($this['person_id']);
        unset($this['created_at']);
        unset($this['updated_at']);
    }

    public function doSave($con = null) {
        if ($this->getValue('picture_url') )
        {
            $shortFilename = $this->getObject()->getPictureUrl();
            $filename = sfConfig::get('sf_upload_dir').'/assets/profile_pictures/'.$shortFilename;
            
            if (!is_dir($filename)  && file_exists($filename))
            {
                unlink($filename);
            }

            // Save the form data to the database
            $response = parent::doSave($con);

            // Get the filename information for the uploaded file
            // For example:
            //$this->getObject()->getPictureUrl() returns picture1.jpg
            // basename => picture1.jpg, filename => picture1, extension => jpg
            $pathParts = pathinfo($this->getObject()->getPictureUrl());
            $basename = $pathParts['basename'];
            // short file name look
            $shortFilename = $pathParts['filename'];
            $fileLocation = sfConfig::get('sf_upload_dir').'/assets/profile_pictures/';
            $originalFilePath = $fileLocation.$basename;
            $extention = $pathParts['extension'];


            if ($this->getValue('picture_url')) {
                
                // Resize the picture for each desired times
                $sizes = array('tiny', 'small', 'medium', 'large');
                
                // Create the resized picture filenames
                foreach ($sizes as $size)
                {
                    // New file name looks like picture1_small.jpg
                    $newFileExtention = '_'.$size.'.'.$extention;
                    $newFilename = $fileLocation.$shortFilename.$newFileExtention;
                    $newShortFilename = $shortFilename.$newFileExtention;
                    // Update the file name to be saved in the database
                    $this->values['picture_url_'.$size] = $newShortFilename;

                    // Now resize the original picture to make the smaller versions
                    $img = new sfImage($originalFilePath);
                    $pictureSizeInfo = sfConfig::get('app_picture_sizes_'.$size);
                    $maxWidth = $pictureSizeInfo['width'];
                    $maxHeight = $pictureSizeInfo['height'];
                    $transformMethod = $pictureSizeInfo['method'];

                    // Resize the image
                    $img->thumbnail($maxWidth, $maxHeight, $transformMethod);
                    $img->saveAs($newFilename);
                }

                // Save the resized files to the database
                $response = parent::doSave($con);
            }
            
            return $response;
        }
        return parent::doSave($con);
    }
}
