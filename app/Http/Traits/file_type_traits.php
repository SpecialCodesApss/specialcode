<?php
namespace App\Http\Traits;

trait file_type_traits{

    public function getFileTypeByLink($link){
        $mime_type = mime_content_type($link);
        if($mime_type == "application/pdf"){
            $image_filetype="pdf";
        }
        elseif(strpos($mime_type,'png') !== false){
            $image_filetype="image";
        }
        elseif(strpos($mime_type,'jpeg') !== false){
            $image_filetype="image";
        }
        elseif(strpos($mime_type,'image') !== false){
            $image_filetype="image";
        }
        elseif(strpos($mime_type,'txt') !== false){
            $image_filetype="text";
        }
        elseif(strpos($mime_type,'text') !== false){
            $image_filetype="text";
        }
        elseif(strpos($mime_type,'video') !== false){
            $image_filetype="video";
        }
        elseif(strpos($mime_type,'audio') !== false){
            $image_filetype="audio";
        }
        else{
            $image_filetype="null";
        }



        return $image_filetype;
    }

}
