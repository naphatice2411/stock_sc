<?php
load_fun('user');
load_fun('picture');
   
if(isset($_FILES["profilePicture"]["type"])&&$_FILES["profilePicture"]["type"]!=''){
    $validextensions = array("jpeg", "jpg", "png");
    $temporary = explode(".", $_FILES["profilePicture"]["name"]);
    $file_extension = strtolower(end($temporary));

    $targetPath = BASE_PATH."system/pictures/profile/".current_user("username").".png"; // Target path where file is to be stored
    // print_r($_FILES["profilePicture"]);
    // print $file_extension;
    if ((($_FILES["profilePicture"]["type"] == "image/png") || ($_FILES["profilePicture"]["type"] == "image/jpg") || ($_FILES["profilePicture"]["type"] == "image/jpeg")
        ) && ($_FILES["profilePicture"]["size"] < 1024*1024*5)//Approx. 100kb files can be uploaded.
        && in_array($file_extension, $validextensions)){
        if ($_FILES["profilePicture"]["error"] > 0){
            echo "Return Code: " . $_FILES["profilePicture"]["error"] . "<br/><br/>";
        }else{
            //if (file_exists(BASE_PATH."apps/home/profile/upload/" . $_FILES["profilePicture"]["name"])) {
            //echo $_FILES["profilePicture"]["name"] . " <span id='invalid'><b>already exists.</b></span> ";
            //}
            //else
            //{
            $sourcePath = $_FILES['profilePicture']['tmp_name']; // Storing source path of the file in a variable
            //move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
            //print $sourcePath."</br>";
            //print $targetPath;
            imagepng(imagecreatefromstring(file_get_contents($sourcePath)), $targetPath);
            image_resize($targetPath, $targetPath, 240, 240, "png");
            print "แก้ไขรูปประจำตัวเรียบร้อยแล้ว";
            /*echo "<span id='success'>Image Uploaded Successfully...!!</span><br/>";
            echo "<br/><b>File Name:</b> " . $_FILES["profilePicture"]["name"] . "<br>";
            echo "<b>Location :</b>".$targetPath."<br>";
            echo "<b>Type:</b> " . $_FILES["profilePicture"]["type"] . "<br>";
            echo "<b>Size:</b> " . ($_FILES["profilePicture"]["size"] / 1024) . " kB<br>";
            echo "<b>Temp file:</b> " . $_FILES["profilePicture"]["tmp_name"] . "<br>";*/
            ///}
        }
    }else{
        echo "<span id='invalid'>ไม่สามารถเปลี่ยนรูปได้<span>";
    }
}else{
    print "No File";
    // print_r($_FILES); 
}
?>