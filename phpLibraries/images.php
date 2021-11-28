<?php 

/** 
 * General purpose PHP image functions
 * 
 * PHP version 7.4
 * 
 * @category PHP
 * @package  Libraries
 * @author   Riley Childs <riley.childs@yahoo.com>
 * @license  Attribution-ShareAlike 4.0 International (CC BY-SA 4.0)
 * @link     none available
 */

require 'include/connect.php';

/** 
 * Uploads images to website directory
 * 
 * @param string $folder the upload folder to send images to
 * 
 * @return upload status
 */
function uploadImage($folder) 
{
    $target_dir = "$folder/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
      
    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            /*  echo "<br><br>File is an image - " . $check["mime"] . ".<br><br>"; */
            $uploadOk = 1;
        } else {
            echo "File is not an image.<br><br>";
            $uploadOk = 0;
        }
    }
      
    // Check file size
    if ($_FILES["image"]["size"] > 500000) {
         echo "Sorry, your file is too large.<br><br>";
         $uploadOk = 0;
    }
      
    // Allow certain file formats
    if ($imageFileType != "jpg" 
        && $imageFileType != "png"
        && $imageFileType != "jpeg"
        && $imageFileType != "gif" 
        && isset($_POST['image']) 
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br><br>";
        $uploadOk = 0;
    }
      
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.<br><br>";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            /* echo "The file ".
             htmlspecialchars( basename( $_FILES["image"]["name"])). 
            " has been uploaded.<br><br>"; */
        } else if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file) 
            && isset($_POST['image'])
        ) {
            echo "Sorry, there was an error uploading your file.<br><br>";
        }
    }
}


/** 
 * Checks if there's a temporary location
 *
 * @return Error message
 */
function checkTempLocation()
{
    if (!file_exists(sys_get_temp_dir())) {
        echo "<h4>Sorry, image uploading is down for maintenance.</h4>";
    }
}


/** 
 * Enables file uploads
 * Callback for createForm(), located in phpCRUD.php
 *
 * @return input type 'file'
 */
function enableUpload()
{
    if (file_exists(sys_get_temp_dir())) {
        echo "<input type='file' name='image'><br><br>";
    } else {
        echo "<input type='file' name='image' disabled><br><br>";
    }
}
  
?>