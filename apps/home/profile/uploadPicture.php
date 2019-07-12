<?php
if(isset($_FILES["profilePicture"]["type"]))
{
    print "getFile";
$validextensions = array("jpeg", "jpg", "png");
$temporary = explode(".", $_FILES["profilePicture"]["name"]);
$file_extension = end($temporary);
if ((($_FILES["profilePicture"]["type"] == "image/png") || ($_FILES["profilePicture"]["type"] == "image/jpg") || ($_FILES["profilePicture"]["type"] == "image/jpeg")
) && ($_FILES["profilePicture"]["size"] < 100000)//Approx. 100kb files can be uploaded.
&& in_array($file_extension, $validextensions)) {
if ($_FILES["profilePicture"]["error"] > 0)
{
echo "Return Code: " . $_FILES["profilePicture"]["error"] . "<br/><br/>";
}
else
{
if (file_exists(BASE_PATH."apps/home/profile/upload/" . $_FILES["profilePicture"]["name"])) {
echo $_FILES["profilePicture"]["name"] . " <span id='invalid'><b>already exists.</b></span> ";
}
else
{
$sourcePath = $_FILES['profilePicture']['tmp_name']; // Storing source path of the file in a variable
$targetPath = BASE_PATH."apps/home/profile/upload/".$_FILES['profilePicture']['name']; // Target path where file is to be stored
move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
echo "<span id='success'>Image Uploaded Successfully...!!</span><br/>";
echo "<br/><b>File Name:</b> " . $_FILES["profilePicture"]["name"] . "<br>";
echo "<b>Location :</b>".$targetPath."<br>";
echo "<b>Type:</b> " . $_FILES["profilePicture"]["type"] . "<br>";
echo "<b>Size:</b> " . ($_FILES["profilePicture"]["size"] / 1024) . " kB<br>";
echo "<b>Temp file:</b> " . $_FILES["profilePicture"]["tmp_name"] . "<br>";
}
}
}
else
{
echo "<span id='invalid'>***Invalid file Size or Type***<span>";
}
}else{
    print "No File";
    print_r($_FILES);
    
}
?>