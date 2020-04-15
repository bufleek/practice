<?php
    function resizeImage($resourceType,$image_width,$image_height) {
        $resizeWidth = $image_width;
        $resizeHeight = floatval($image_width)*(9/16);
        $imageLayer = imagecreatetruecolor($resizeWidth,$resizeHeight);
        imagecopyresampled($imageLayer,$resourceType,0,0,0,0,$resizeWidth,$resizeHeight, $image_width,$image_height);
        return $imageLayer;
    }
?>