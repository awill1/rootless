<?php

/**
 * Email helper functions
 */
class ImageHelpers
{
    /**
     * 
     * @param type $inputFile
     * @return type
     */
    public static function resizeImage($inputFile)
    {
        // Get the filename information for the uploaded file
            // For example:
            // $this->getObject()->getPictureUrl() returns picture1.jpg
            // basename => picture1.jpg, filename => picture1, extension => jpg
            $pathParts = pathinfo($inputFile);
            $basename = $pathParts['basename'];
            $shortFilename = $pathParts['filename'];
            $extention = $pathParts['extension'];
            
            // Get the final ouput directory for the image
            $outputDirectory = sfConfig::get('sf_upload_write_dir').'/assets/profile_pictures/';
                
            // Get the path of the full size source file to thumbnail
            $uploadDirectory = sfConfig::get('sf_upload_dir').'/assets/profile_pictures/';
            $temporaryImage = $uploadDirectory.$basename;
            
            $fullSizeDestinationImage = $outputDirectory.$basename;
            
            $filesToCopy = Array();
            $filesToCopy[] = $basename;
            
            // Create the resized picture sizes
            $sizes = array('tiny', 'small', 'medium', 'large');
            $imgFileNameArray = array('picture_url' => $basename);

            // Resize the picture for each desired size
            foreach ($sizes as $size)
            {
                // New file name looks like picture1_small.jpg
                $newFileExtention = '_'.$size.'.'.$extention;
                $newShortFilename = $shortFilename.$newFileExtention;
                $newFilename = $uploadDirectory.$newShortFilename;
                
                // Update the file name to be saved in the database
                // change $this to getProfile()
                // $getProfile()->values['picture_url_'.$size] = $newShortFilename;

                // Now resize the original picture to make the smaller versions
                $img = new sfImage($temporaryImage);
                $pictureSizeInfo = sfConfig::get('app_picture_sizes_'.$size);
                $maxWidth = $pictureSizeInfo['width'];
                $maxHeight = $pictureSizeInfo['height'];
                $transformMethod = $pictureSizeInfo['method'];

                // Resize the image
                $img->thumbnail($maxWidth, $maxHeight, $transformMethod);
                $img->saveAs($newFilename);
                $filesToCopy[] = $newShortFilename;
                
                $imgFileNameArray['picture_url_'.$size] = $newShortFilename;
            }
            
            // Copy all files to the destination directory and delete the old one.
            // This is needed if the environment is saving images to Amazon S3. 
            foreach($filesToCopy as $fileToCopy)
            {
                
                $tempFile = $uploadDirectory.$fileToCopy;
                // Make sure the file exists and the outpu directory is 
                // different than the upload directory
                if ($uploadDirectory != $outputDirectory && is_file($tempFile) && file_exists($tempFile))
                {
                    copy($tempFile, $outputDirectory.$fileToCopy);
                    unlink($tempFile);
                }
            }
        return $imgFileNameArray;
    }
}

?>
