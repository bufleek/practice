<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../files/bootstrap.css">
    <script src="../files/jquery-3.4.1.js"></script>
    <title>Image Resize</title>
</head>
<body>
    <div class="container">
        <form action="" method="post" class="w-75 card-custom pt-3 px-3" enctype="multipart/form-data">
            <small>Resize and upload image</small>
            <div class="form-group">
            <label class="small">Image</label>
            <input type="file" name="upload_image" id="image" class="form-control form-control-sm" accept="image/*" required>
            </div>
            <div class="form-group">
            <input type="submit" value="Submit" name="form_submit" class="btn btn-primary btn-sm">
            </div> 
<?php
function resizeImage($resourceType,$image_width,$image_height) {
    $resizeWidth = $image_width;
    $resizeHeight = $image_width*(9/16);
    $imageLayer = imagecreatetruecolor($resizeWidth,$resizeHeight);
    imagecopyresampled($imageLayer,$resourceType,0,0,0,0,$resizeWidth,$resizeHeight, $image_width,$image_height);
    return $imageLayer;
}
 
if(isset($_POST["form_submit"])) {
	$imageProcess = 0;
    if(is_array($_FILES)) {
        $fileName = $_FILES['upload_image']['tmp_name']; 
        $sourceProperties = getimagesize($fileName);
        $resizeFileName = time();
        $uploadPath = "./uploads/";
        $fileExt = pathinfo($_FILES['upload_image']['name'], PATHINFO_EXTENSION);
        $uploadImageType = $sourceProperties[2];
        $sourceImageWidth = $sourceProperties[0];
        $sourceImageHeight = $sourceProperties[1];
        switch ($uploadImageType) {
            case IMAGETYPE_JPEG:
                $resourceType = imagecreatefromjpeg($fileName); 
                $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
                imagejpeg($imageLayer,$uploadPath."thump_".$resizeFileName.'.'. $fileExt);
                break;
 
            case IMAGETYPE_GIF:
                $resourceType = imagecreatefromgif($fileName); 
                $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
                imagegif($imageLayer,$uploadPath."thump_".$resizeFileName.'.'. $fileExt);
                break;
 
            case IMAGETYPE_PNG:
                $resourceType = imagecreatefrompng($fileName); 
                $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
                imagepng($imageLayer,$uploadPath."thump_".$resizeFileName.'.'. $fileExt);
                break;
 
            default:
                $imageProcess = 0;
                break;
        }
        move_uploaded_file($fileName, $uploadPath. $resizeFileName. ".". $fileExt);
        $imageProcess = 1;
    }
 
	if($imageProcess == 1){
	?>
		<div class="alert icon-alert with-arrow alert-success form-alter" role="alert">
			<i class="fa fa-fw fa-check-circle"></i>
			<strong> Success ! </strong> <span class="success-message"> Image Resize Successfully </span>
		</div>
	<?php
	}else{
	?>
		<div class="alert icon-alert with-arrow alert-danger form-alter" role="alert">
			<i class="fa fa-fw fa-times-circle"></i>
			<strong> Note !</strong> <span class="warning-message">Invalid Image </span>
		</div>
	<?php
	}
	$imageProcess = 0;
}
?>
        </form>
    </div>
</body>
</html>