<?php
// print_r($_POST);
// print_r($_FILES);
?>
<?php
load_fun('user');
load_fun('picture');

$isUpload = 0;
$errData;
$errData['post']=$_POST;

$chkExist = selectTb('supplies', '*', 'sid="' . $_POST['Nosup'] . '" limit 1');

if (!count($chkExist)) {
    if (isset($_FILES["sparePicture"]["type"]) && $_FILES["sparePicture"]["type"] != '') {
        $validextensions = array("jpeg", "jpg", "png");
        $temporary = explode(".", $_FILES["sparePicture"]["name"]);
        $file_extension = strtolower(end($temporary));

        $filename = $_POST['Nosup'] . ".png";
        $errData['picName']=$filename;

        $targetPath = BASE_PATH . "system/pictures/spare/" . $filename; // Target path where file is to be stored
        if ((($_FILES["sparePicture"]["type"] == "image/png") || ($_FILES["sparePicture"]["type"] == "image/jpg") || ($_FILES["sparePicture"]["type"] == "image/jpeg")) && ($_FILES["sparePicture"]["size"] < 1024 * 1024 * 5) //Approx. 100kb files can be uploaded.
            && in_array($file_extension, $validextensions)
        ) {
            if ($_FILES["sparePicture"]["error"] > 0) {
                $errData['picErr'] = "Return Code: " . $_FILES["sparePicture"]["error"];
            } else {
                $isUpload = 1;
                $sourcePath = $_FILES['sparePicture']['tmp_name']; // Storing source path of the file in a variable
                imagepng(imagecreatefromstring(file_get_contents($sourcePath)), $targetPath);
                image_resize($targetPath, $targetPath, 240, 240, "png");
            }
        } else {
            $errData['picErr'] = "ไม่สามารถอัพโหลดรูปได้";
        }
    } else {
        $isUpload = 1;
        $filename = "noimage.png";
    }

    if ($isUpload) {
        $insertData = array(
            'sid' => "'" . $_POST['Nosup'] . "'",
            'name' => "'" . $_POST['Namesup'] . "'",
            'cname' => "'" . $_POST['Callname'] . "'",
            'min' => "'" . $_POST['Min'] . "'",
            'max' => "'" . $_POST['Max'] . "'",
            'unit' => "'" . $_POST['Unit'] . "'",
            'pic' => "'" . $filename . "'",
            'box' => "'" . $_POST['Area'] . "'",
            'catid' => "'" . $_POST['Group'] . "'",
        );
        $isInserted = insertTb('supplies', $insertData);
    }

    if ($isUpload && $isInserted) {
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