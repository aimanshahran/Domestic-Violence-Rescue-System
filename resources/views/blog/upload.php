<?php

// Getting file name
$filename = $_FILES['file']['name'];

// file type
$filetype = $_POST['filetype'];

// Valid extension
if($filetype == 'image'){
    $valid_ext = array('png','jpeg','jpg');
}

// Location
$location = "/public/img/uploads".$filename;

// file extension
$file_extension = pathinfo($location, PATHINFO_EXTENSION);
$file_extension = strtolower($file_extension);

$return_filename = "";

// Check extension
if(in_array($file_extension,$valid_ext)){

    // Upload file
    if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){

        $return_filename = $filename;

    }

}

echo $return_filename;
