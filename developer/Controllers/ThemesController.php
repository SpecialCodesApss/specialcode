<?php

namespace Developer\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use File;
use DB;
use App\Models\Admin_sections;
use Session;


class ThemesController extends Controller
{

    public function view_theme_url_customize(){
        return view('developer::themes.themes_url_customize' );
    }

    public function customize_theme_url(Request $request){
        $modules = [];
        $pathes=$request->pathes;
        $pathes = explode(',', $pathes);
        $files = $request->file('files');

//        return $pathes;

        $i=0;
        foreach ($files as $file) {
            $file_path = $pathes[$i];
            $content = file($file);
            $content = str_replace("\"../files/assets","\"{{url('themes/web/default/assets",$content);
            $content = str_replace("\"../files/bower_components","\"{{url('themes/web/default/assets/bower_components",$content);
            $content = str_replace("\"../files/extra-pages","\"{{url('themes/web/default/assets/extra-pages",$content);
            $content = str_replace(".ico\"",".ico')}}\"",$content);
            $content = str_replace(".svg\"",".svg')}}\"",$content);
            $content = str_replace(".css\"",".css')}}\"",$content);
            $content = str_replace(".js\"",".js')}}\"",$content);
            $content = str_replace(".png\"",".png')}}\"",$content);
            $content = str_replace(".jpg\"",".jpg')}}\"",$content);


            $content = str_replace("\"assets","\"{{url('themes/web/default/assets",$content);

            file_put_contents($file_path, $content);
            $i++;
        }
        return back()->with('success','Themes Urls Customized');

//        return "done";
//        return view('developer::index' );
    }



}
