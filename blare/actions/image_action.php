<?php

class Image 
{
    public function generate_filename($length)
    {

        $array = array(0, 1,2,3,4,5,6,7,8,9,'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
        
        $text = "";
        for ($x = 0; $x < $length; $x++)
        {
            $random = rand(0,61);
            $text .= $array[$random];
        }
        return $text;
    }
    public function crop_image($original_file_name, $cropped_file_name, $max_width, $max_height)
    {
        if (file_exists($original_file_name)) {
            // Get the image's file type (MIME type)
            $image_info = getimagesize($original_file_name);
            $mime_type = $image_info['mime'];

            // Create the image resource based on MIME type
            if
             ($mime_type === 'image/png') {
                $original_image = imagecreatefrompng($original_file_name);
            } elseif ($mime_type === 'image/gif') {
                $original_image = imagecreatefromgif($original_file_name);
            } else {
                // Handle unsupported image types (or return with an error)
                return;
            }
        }
        $original_width = imagesx($original_image);
        $original_height = imagesy($original_image);

        // Resize image based on aspect ratio
        if ($original_height > $original_width) {
            // Portrait: Fit to max width
            $ratio = $max_width / $original_width;
            $new_width = $max_width;
            $new_height = $original_height * $ratio;
        } else {
            // Landscape: Fit to max height
            $ratio = $max_height / $original_height;
            $new_height = $max_height;
            $new_width = $original_width * $ratio;
        }

        // Resize the image
        $new_image = imagecreatetruecolor($new_width, $new_height);
        imagecopyresampled($new_image, $original_image, 0, 0, 0, 0, $new_width, $new_height, $original_width, $original_height);
        imagedestroy($original_image);

        // Crop if necessary to fit max dimensions
        
        if ($max_width != $max_height) {
            // Determine if the cropping will be vertical or horizontal
            if ($max_width > $max_height) {
                // Horizontal case
                $diff = ($new_height - $max_height);
                if($diff < 0 ){
                    $diff = $diff * -1;
                }
                $y = round($diff / 2);
                $x = 0;
            } else {
                // Vertical case
                $diff = ($new_width - $max_height);
                if($diff < 0 ){
                    $diff = $diff * -1;
                }
                $x = round($diff / 2);
                $y = 0;
            }
        } else {
            if ($new_height > $new_width) {
                // Horizontal case
                $diff = ($new_height - $new_width);
                $y = round($diff / 2);
                $x = 0;
            } else {
                // Vertical case
                $diff = ($new_width - $new_height);
                $x = round($diff / 2);
                $y = 0;
            }
        }

        // Create a new blank image to hold the final cropped version
        $new_cropped_image = imagecreatetruecolor($max_width, $max_height);
        imagecopyresampled($new_cropped_image, $new_image, 0, 0, $x, $y, $max_width, $max_height, $max_width, $max_height);

        // Output the final image
        imagejpeg($new_cropped_image, $cropped_file_name, 90);
        
        // Free up memory
        imagedestroy($new_image);
        imagedestroy($new_cropped_image);
    }


    //resize the image
    public function resize_image($original_file_name, $resized_file_name, $max_width, $max_height)
    {
        if (file_exists($original_file_name)) {
            // Get the image's file type (MIME type)
            $image_info = getimagesize($original_file_name);
            $mime_type = $image_info['mime'];

            // Create the image resource based on MIME type
            if ($mime_type === 'image/png') {
                $original_image = imagecreatefrompng($original_file_name);
            } elseif ($mime_type === 'image/gif') {
                $original_image = imagecreatefromgif($original_file_name);
            } else {
                // Handle unsupported image types (or return with an error)
                return;
            }
        }
        $original_width = imagesx($original_image);
        $original_height = imagesy($original_image);

        // Resize image based on aspect ratio
        if ($original_height > $original_width) {
            // Portrait: Fit to max width
            $ratio = $max_width / $original_width;
            $new_width = $max_width;
            $new_height = $original_height * $ratio;
        } else {
            // Landscape: Fit to max height
            $ratio = $max_height / $original_height;
            $new_height = $max_height;
            $new_width = $original_width * $ratio;
        }

        // Resize the image
        $new_image = imagecreatetruecolor($new_width, $new_height);
        imagecopyresampled($new_image, $original_image, 0, 0, 0, 0, $new_width, $new_height, $original_width, $original_height);
        
        
        imagedestroy($original_image);

        // Output the final image
        imagejpeg($new_image, $resized_file_name, 90);

        imagedestroy($new_image);
    }

    public function get_thumb_cover($filename)
    {
        $thumbnail = $filename . "_cover_thumb";
        $this->crop_image($filename,$thumbnail,1366,488);

        if(file_exists($thumbnail))
        {
            return $thumbnail;
        }else{
            return $filename;
        }
    }

    public function get_thumb_post($filename)
    {
        $thumbnail = $filename . "_post_thumb";
        $this->crop_image($filename,$thumbnail,1366,488);

        if(file_exists($thumbnail))
        {
            return $thumbnail;
        }else{
            return $filename;
        }
    }
    public function get_thumb_profile($filename)
    {
        $thumbnail = $filename . "_profile_thumb";
        $this->crop_image($filename,$thumbnail,1366,488);

        if(file_exists($thumbnail))
        {
            return $thumbnail;
        }else{
            return $filename;
        }
    }
}
