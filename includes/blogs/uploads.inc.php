<?php
session_start();
// If submit button has been clicked...
if (isset($_SESSION['u_id'])) {
  if (isset($_POST['submit'])) {

    $file = $_FILES['Image'];
    $fileName = $_FILES['Image']['name'];
    $fileTmpName = $_FILES['Image']['tmp_name'];
    $fileSize = $_FILES['Image']['size'];
    $fileError = $_FILES['Image']['error'];
    $fileType = $_FILES['Image']['type'];

    $fileExt = explode('.',$fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg','jpeg','png','gif');
    echo $fileExt;
    echo $fileName;
      if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
          if ($fileSize < 1000000) {
            $fileNameNew = uniqid('',true)."."."$fileActualExt";
            $fileDestination = '../../uploads/blogs/'.$fileNameNew;
            move_uploaded_file($fileTmpName, $fileDestination);

            $sql = "INSERT INTO blog_imgs `post_image` = '$fileNameNew'";
            mysqli_query($conn, $sql);
            header("Location: ../../blog_form.php?blog_form=success");
            exit();
          }else{
            echo "Your file is too big";
          }
        }else {
          echo "There was an error uploading your file";
        }
      }else {
        echo 'You cannot upload files of this type.';
      }
    }else{
      header("Location: ../../blog_form.php?upload=failed");
      exit();
    }

  }
else{
header("Location: ../../index.php?loggedin=false");
}
 ?>
