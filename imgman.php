
<?php
// script to read all images (jpg,gif,png) from a specified folder and generate 160x160 and 1024x768 size png images
$dir_path='third'; // directory 
$filename_start = 'nature'; // target file name 

$dir_path=$dir_path."/"; // append with slash '/';
$width_thumbnail = 160;
$height_thumbnail = 160;
$width_standard = 1024;
$height_standard = 768;

//echo $dir_path;

$images = glob($dir_path . "{*.JPG,*.jpg}", GLOB_BRACE);
// Get image size
$inc=1;
foreach($images as $image)
{
list($source_width, $source_height) = getimagesize($image);
$source = imagecreatefromjpeg($image);

resizeImg($source,$width_thumbnail,$height_thumbnail,$source_width,$source_height,$inc); // for thumbnail
resizeImg($source,$width_standard,$height_standard,$source_width,$source_height,$inc); // for standard

$inc++;
}

function resizeImg($source,$target_width,$target_height,$source_width,$source_height,$inc)
{
global $dir_path,$filename_start;
$target = imagecreatetruecolor($target_width, $target_height);


imagecopyresized($target, $source, 0, 0, 0, 0, $target_width, $target_height, $source_width, $source_height); // resize

$target_filename=$dir_path.$filename_start."_".$inc."_".$target_width."x".$target_height.".png";

imagepng($target,$target_filename); // write the image as png

}

?>
