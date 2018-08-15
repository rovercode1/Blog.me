<?php
include 'includes/dbh.inc.php'; // Do Database Connection in this file
extract($_POST);

$UploadedFileName=$_FILES['UploadImage']['name'];
if($UploadedFileName!='')
{
  $upload_directory = "uploads/blogs/"; 
  $TargetPath=time().$UploadedFileName;
  if(move_uploaded_file($_FILES['UploadImage']['tmp_name'], $upload_directory.$TargetPath)){
    $QueryInsertFile="INSERT INTO blogs SET ImageColumnName='$TargetPath'";
    // Write Mysql Query Here to insert this $QueryInsertFile   .
  }
}
?>
