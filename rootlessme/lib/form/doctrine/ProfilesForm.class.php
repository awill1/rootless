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

            // Get the new filename for the uploaded file
//            $shortFilename = $this->getValue('picture_url');
            $shortFilename = $this->getObject()->getPictureUrl();
            $filename = sfConfig::get('sf_upload_dir').'/assets/profile_pictures/'.$shortFilename;

            if ($this->getValue('picture_url')) {
                
                // Resize the picture for each desired times
                $sizes = array('tiny', 'small', 'medium', 'large');
                $filenames = array();
                $shortFilenames = array();
                $mime = 'image/jpg';
                
                // Create the resized picture filenames
                foreach ($sizes as $size)
                {
                    $newFileExtention = '.'.$size.'.jpg';
                    $filenames[$size] = $filename.$newFileExtention;
                    $shortFilenames[$size] = $shortFilename.$newFileExtention;
                    $this->values['picture_url_'.$size] = $shortFilenames[$size];
                }
                
                
                // Now resize the original picture to make the smaller versions
                foreach ($sizes as $size)
                {
                    $img = new sfImage($filename, $mime, 'GD');
                    $pictureSizeInfo = sfConfig::get('app_picture_sizes_'.$size);
                    $maxWidth = $pictureSizeInfo['width'];
                    $maxHeight = $pictureSizeInfo['height'];
                    $transformMethod = $pictureSizeInfo['method'];

                    // Resize the image
                    $img->thumbnail($maxWidth, $maxHeight, $transformMethod);
//                    if($img->getWidth() > $maxWidth || $img->getHeight() > $maxHeight) {
//                        if($img->getWidth() > $img->getHeight())
//                        {
//                            $img->resize($maxWidth,null);
//                        }
//                        else
//                        {
//                            $img->resize(null,$maxHeight);
//                        }
//                    }
                    $img->saveAs($filenames[$size], $mime);
                }

                // Save the resized files to the database
                $response = parent::doSave($con);
            }
            else {
                // There is no picture_url, so just save using the parent 
                // function
                //$response = parent::doSave($con);
            }

            return $response;
        }
        return parent::doSave($con);
    }
}
