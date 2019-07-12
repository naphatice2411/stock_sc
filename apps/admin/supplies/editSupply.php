<?php
load_fun('user');
load_fun('picture');

$isUpload = 0;
$errData['post']=$_POST;

$chkExist = selectTb('supplies', '*', 'sid="' . $_POST['editInputNosup'] . '" AND NOT(id="'.$_POST['oldId'].'")  limit 1');

if (!count($chkExist)) {
    if (isset($_FILES["editSparePicture"]["type"]) && $_FILES["editSparePicture"]["type"] != '') {
        unlink(BASE_PATH."system/pictures/spare/".$_POST['oldPic']);
        $validextensions = array("jpeg", "jpg", "png");
        $temporary = explode(".", $_FILES["editSparePicture"]["name"]);
        $file_extension = strtolower(end($temporary));

        $filename = $_POST['editInputNosup'] . ".png";
        $errData['picName']=$filename;

        $targetPath = BASE_PATH . "system/pictures/spare/" . $filename; // Target path where file is to be stored
        if ((($_FILES["editSparePicture"]["type"] == "image/png") || ($_FILES["editSparePicture"]["type"] == "image/jpg") || ($_FILES["editSparePicture"]["type"] == "image/jpeg")) && ($_FILES["editSparePicture"]["size"] < 1024 * 1024 * 5) //Approx. 100kb files can be uploaded.
            && in_array($file_extension, $validextensions)
        ) {
            if ($_FILES["editSparePicture"]["error"] > 0) {
                $errData['picErr'] = "Return Code: " . $_FILES["editSparePicture"]["error"];
            } else {
                $isUpload = 1;
                $sourcePath = $_FILES['editSparePicture']['tmp_name']; // Storing source path of the file in a variable
                imagepng(imagecreatefromstring(file_get_contents($sourcePath)), $targetPath);
                image_resize($targetPath, $targetPath, 240, 240, "png");
            }
        } else {
            $errData['picErr'] = "ไม่สามารถอัพโหลดรูปได้";
        }
    }else{
        $isUpload = 1;
        $filename = $_POST['oldPic'];
    }

    if ($isUpload) {
        $updateData=array(
            'sid' => "'" . $_POST['editInputNosup'] . "'",
            'name' => "'" . $_POST['editInputNamesup'] . "'",
            'cname' => "'" . $_POST['editInputCallname'] . "'",
            'min' => "'" . $_POST['editInputMin'] . "'",
            'max' => "'" . $_POST['editInputMax'] . "'",
            'unit' => "'" . $_POST['editOptUnit'] . "'",
            'pic' => "'" . $filename . "'",
            'box' => "'" . $_POST['editInputArea'] . "'",
            'catid' => "'" . $_POST['editOptGroup'] . "'",
        );
        $isUpdated = updateTb('supplies', $updateData,'id="'.$_POST['oldId'].'"');
    }

    if ($isUpload && $isUpdated) {
        $errData['code']=200;
        $errData['status']="เพิ่มข้อมูลเรียบร้อยแล้ว";
    } else {
        $errData['code']=400;
    }
}else{
    $errData['code']=400;
    $errData['status']="รหัสวัสดุซ้ำกับรายการที่มีอยู่แล้ว.. โปรดตรวจสอบ";
}

echo json_encode($errData);


?>