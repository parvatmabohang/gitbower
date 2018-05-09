<?php
session_start();
class Image
{

  function isend($uid,$files)
      {
        $gun=0;
        $ifile = [];
        foreach ($files['name'] as $position => $file_name) {
            $file_tmp = $files['tmp_name'][$position];
            $file_name = $files['name'][$position];
            $file_size =$files['size'][$position];
            $expensions= array("jpeg","jpg","png");
            $ifile[] = "image/$uid".$file_name;
            $file_ext=strtolower(end(explode('.',$files['name'][$position])));
            list($width, $height) = getimagesize($file_tmp);
            $new_width = 200;
            $new_height = 200;
            $new_w = 600;
            $new_h = 600;
            if ($file_ext=='jpg' or $file_ext=='jpeg') {
                $image_resource_id = imagecreatefromjpeg($file_tmp);
                $target_layer=imagecreatetruecolor($new_width,$new_height);
                $target_l=imagecreatetruecolor($new_w,$new_h);
                imagecopyresampled($target_layer,$image_resource_id,0,0,0,0,$new_width,$new_height, $width,$height);
                imagecopyresampled($target_l,$image_resource_id,0,0,0,0,$new_w,$new_h, $width,$height);
            }
            if ($file_ext == 'png') {
                $image_resource_id = imagecreatefrompng($file_tmp);
                $target_layer=imagecreatetruecolor($new_width,$new_height);
                $target_l=imagecreatetruecolor($new_w,$new_h);
                imagecopyresampled($target_layer,$image_resource_id,0,0,0,0,$new_width,$new_height, $width,$height);
                imagecopyresampled($target_l,$image_resource_id,0,0,0,0,$new_w,$new_h, $width,$height);
            }
            if (in_array($file_ext,$expensions) === true) {
                if ($file_ext == 'jpg' or $file_ext == 'jpeg') {
                    imagejpeg($target_layer,"image/$uid".$file_name);
                    imagejpeg($target_l,"image/600$uid".$file_name);
                    $gun++;
                    //$imgupload=$rt->imgupload($uid,"images/$uid"."dup$file_name");
                    //if($imgupload){$imginfo="successfully uploaded";}else{echo "Unsuccessfull";}
                 }
                 if ($file_ext == 'png') {
                    imagepng($target_layer,"image/$uid".$file_name);
                    imagepng($target_l,"image/600$uid".$file_name);
                    $gun++;
                 }
                //move_uploaded_file($file_tmp,"image/$uid".$file_name);
            } else {
                echo "extension not allowed, please choose a PDF or JPEG or PNG file.";
            }
         }
         if ($gun == 0) {
           return 789;
         } else {
           return $ifile;
         }

      }
}
?>
