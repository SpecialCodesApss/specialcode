<?php

namespace Developer\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use File;
use ZipArchive;
use \RecursiveIteratorIterator;
use Zip;
use Image;


class ProjectController extends Controller
{

    public function view(){
        return view('developer::start_project');
    }


    public function view_deployment(){
        return view('developer::deployment');
    }

    public function deployment_web(){

        //make App Debug to False to avoid show code , and only shows error template pages
        $env_file=".env";
        $content = file($env_file);
        $content = str_replace("APP_DEBUG=true","APP_DEBUG=false",$content);
        file_put_contents($env_file, $content);

        //clear-cache and all sessions ... etc
        \Artisan::call('cache:clear');
        \Artisan::call('auth:clear-resets');
        \Artisan::call('config:clear');
        \Artisan::call('event:clear');
        \Artisan::call('optimize:clear');
        \Artisan::call('route:clear');
        \Artisan::call('view:clear');
        \Artisan::call('cache:forget spatie.permission.cache');
        \Artisan::call('config:cache');


        $zip = Zip::create(public_path('../web.zip'));
        $zip->add( array(
            public_path('../admin'),
            public_path('../app'),
            public_path('../bootstrap'),
            public_path('../config'),
            public_path('../css'),
            public_path('../database'),
            public_path('../fonts'),
            public_path('../img'),
            public_path('../js'),
            public_path('../resources'),
            public_path('../routes'),
            public_path('../storage'),
            public_path('../vendor'),
            public_path('../.env'),
            public_path('../.htaccess'),
            public_path('../artisan'),
            public_path('../composer.json'),
            public_path('../composer.lock'),
            public_path('../favicon.ico'),
            public_path('../framework.sql'),
            public_path('../index.php'),
            public_path('../package.json'),
            public_path('../phpunit.xml'),
            public_path('../robots.txt'),
            public_path('../server.php'),
            public_path('../web.config'),
            public_path('../webpack.mix.js'),
        ));

        return back()->with('success','Web Deployment ZIP file is Successfully created on root folder for this project');

    }


    public function store(Request $request){

        //project Nam Section
        $project_name = $request->project_name;
        if(isset($project_name)){
                $env_file=".env";
                $content = file($env_file);
                $content = str_replace("APP_NAME=framework_1_5","APP_NAME=".$project_name,$content);
                file_put_contents($env_file, $content);


                $file="developer/Flutter/framework_01/android/app/src/main/AndroidManifest.xml";
                $content = file($file);
                $content = str_replace("framework_01_5",$project_name,$content);
                file_put_contents($file, $content);

        }



        //project Nam Section
        $database_name = $request->database_name;
        if(isset($project_name)){
                $env_file=".env";
                $content = file($env_file);
                $content = str_replace("DB_DATABASE=framework","DB_DATABASE=".$database_name,$content);
                file_put_contents($env_file, $content);

                if(isset($database_name)){
                //create database
                        DB::select(DB::raw("CREATE DATABASE $database_name"));

                        //Copy and Export database tables
                        $hostname = env("DB_DATABASE","framework");
                        $db = "Tables_in_".$hostname;
                        $tables = DB::select('SHOW TABLES');

                        $structure = '';
                        $data = '';
                        foreach ($tables as $table) {
                            $table=$table->$db;
                                $show_table_query = "SHOW CREATE TABLE " . $table . "";
                                $show_table_result = DB::select(DB::raw($show_table_query));
                                foreach ($show_table_result as $show_table_row) {
                                    $show_table_row = (array)$show_table_row;
                                    $structure .= "\n\n" . $show_table_row["Create Table"] . ";\n\n";
                                }

                            $select_query = "SELECT * FROM " . $table;
                            $records = DB::select(DB::raw($select_query));

                            foreach ($records as $record) {
                                $record = (array)$record;
                                $table_column_array = array_keys($record);
                                foreach ($table_column_array as $key => $name) {
                                    $table_column_array[$key] = '`' . $table_column_array[$key] . '`';
                                }
                                $table_value_array = array_values($record);
                                $data .= "\nINSERT INTO $table (";
                                $data .= "" . implode(", ", $table_column_array) . ") VALUES \n";
                                foreach($table_value_array as $key => $record_column)
                                    $table_value_array[$key] = addslashes($record_column);
                                $data .= "('" . implode("','", $table_value_array) . "');\n";
                            }
                        }

                        $content = $structure . $data;

                        // perform queries
                        $commands = $content;
                        //delete comments
                        $lines = explode("\n",$commands);
                        $commands = '';
                        foreach($lines as $line){
                            $line = trim($line);
                            $needle='--';
                            $length = strlen($needle);
                            $status=substr($line, 0, $length) === $needle;
                            if( $line && !$status ){
                                $commands .= $line . "\n";
                            }
                        }
                        //convert to array
                        $commands = explode(";", $commands);
                        //run commands
                        $total = $success = 0;
                        $new_database=mysqli_connect('127.0.0.1', 'root', ''); // connect server 2
                        mysqli_select_db($new_database,$database_name); // select database 2
                        foreach($commands as $command){
                            if(trim($command)){
                                mysqli_query($new_database,$command);
                            }
                        }
                       mysqli_close($new_database);
                       }


        }





        //website Section
        $app_real_website = $request->app_real_website;
        if(isset($app_real_website)){
                $env_file=".env";
                $content = file($env_file);
                $content = str_replace("http://www.framework.com",$app_real_website,$content);
                file_put_contents($env_file, $content);
        }



        //Colors Section
        $primary_color = $request->primary_color;
        $secondary_color = $request->secondary_color;
        $button_color = $request->button_color;
        $main_file="developer/Flutter/framework_01/lib/main.dart";
        $content = file($main_file);
        if($primary_color != ''){
        $content = str_replace("0a77c5",$primary_color,$content);
        file_put_contents($main_file, $content);
        }
        if($secondary_color != ''){
        $content = str_replace("f8f80a",$secondary_color,$content);
        file_put_contents($main_file, $content);
        }
        if($button_color != ''){
        $content = str_replace("0a0a0a",$button_color,$content);
        file_put_contents($main_file, $content);
        }


        //change bundle id or project package name
        $package_id = $request->package_id;
        if($package_id != ''){
                $file="developer/Flutter/framework_01/android/app/build.gradle";
                $content = file($file);
                $content = str_replace("com.saudiapp.framework",$package_id,$content);
                file_put_contents($file, $content);

        //
        $file="developer/Flutter/framework_01/android/app/src/main/AndroidManifest.xml";
        $content = file($file);
        $content = str_replace("com.saudiapp.framework",$package_id,$content);
        file_put_contents($file, $content);
        //
        $file="developer/Flutter/framework_01/android/app/src/debug/AndroidManifest.xml";
        $content = file($file);
        $content = str_replace("com.saudiapp.framework",$package_id,$content);
        file_put_contents($file, $content);
        //
        $file="developer/Flutter/framework_01/android/app/src/profile/AndroidManifest.xml";
        $content = file($file);
        $content = str_replace("com.saudiapp.framework",$package_id,$content);
        file_put_contents($file, $content);
        //
        $file="developer/Flutter/framework_01/android/app/src/main/kotlin/com/example/framework_01_5/MainActivity.kt";
        $content = file($file);
        $content = str_replace("com.saudiapp.framework",$package_id,$content);
        file_put_contents($file, $content);
        //
        $file="developer/Flutter/framework_01/ios/Runner/Info.plist";
        $content = file($file);
        $content = str_replace("com.saudiapp.framework",$package_id,$content);
        file_put_contents($file, $content);

        }


        //Images Section
        $dashboard_logo = $request->dashboard_logo;
        if(isset($dashboard_logo)){
        print("dashboard_logo");
            $file_name="logo.png";
                move_uploaded_file($dashboard_logo,"storage/images/".$file_name);
        }

        //
        $splash_image = $request->splash_image;
        if(isset($splash_image)){
        $file_name="splash.gif";
        move_uploaded_file($splash_image,"developer/Flutter/framework_01/assets/images/".$file_name);
        }

        //
        $basic_splash_image = $request->basic_splash_image;
        if(isset($basic_splash_image)){
            $image_resize = Image::make($basic_splash_image->getRealPath());
            $image_resize->resize(2208,1242);
            $image_resize->save("developer/Flutter/framework_01/ios/Runner/Assets.xcassets/LaunchImage.imageset/LaunchImage.png");
            $image_resize->resize(1104,621);
            $image_resize->save("developer/Flutter/framework_01/ios/Runner/Assets.xcassets/LaunchImage.imageset/LaunchImage@2x.png");
            $image_resize->resize(552,310);
            $image_resize->save("developer/Flutter/framework_01/ios/Runner/Assets.xcassets/LaunchImage.imageset/LaunchImage@3x.png");

//            $file_name1="LaunchImage.png";
//            $file_name2="LaunchImage@2x.png";
//            $file_name3="LaunchImage@3x.png";
//            copy($dest.$file_name, "developer/Flutter/framework_01/ios/Runner/Assets.xcassets/LaunchImage.imageset/".$file_name1);
//            copy($dest.$file_name, "developer/Flutter/framework_01/ios/Runner/Assets.xcassets/LaunchImage.imageset/".$file_name2);
//            copy($dest.$file_name, "developer/Flutter/framework_01/ios/Runner/Assets.xcassets/LaunchImage.imageset/".$file_name3);



//        $file_name="ic_launcher.png";
//        $dest = "developer/Flutter/framework_01/android/app/src/main/res/mipmap-hdpi/";
//        if(move_uploaded_file($basic_splash_image,$dest.$file_name)){


//            $dest="developer/Flutter/framework_01/assets/images/";
//         $logo_file_name="logo_color.png";
//         move_uploaded_file($basic_splash_image,$dest.$logo_file_name);
////         copy($dest.$file_name, "developer/Flutter/framework_01/assets/images/".$logo_file_name);
//         $logo_file_name="logo_white.png";
//         move_uploaded_file($basic_splash_image,$dest.$logo_file_name);
////         copy($dest.$logo_file_name, "developer/Flutter/framework_01/assets/images/".$logo_file_name);
//

//            copy($dest.$file_name, "developer/Flutter/framework_01/android/app/src/main/res/mipmap-mdpi/".$file_name);
//            copy($dest.$file_name, "developer/Flutter/framework_01/android/app/src/main/res/mipmap-xhdpi/".$file_name);
//            copy($dest.$file_name, "developer/Flutter/framework_01/android/app/src/main/res/mipmap-xxhdpi/".$file_name);
//            copy($dest.$file_name, "developer/Flutter/framework_01/android/app/src/main/res/mipmap-xxxhdpi/".$file_name);

            //

//        }
        }
        //
        $app_icon = $request->app_icon;

        if(isset($app_icon)) {

            //get and resize App icons for android
            $filename="ic_launcher.png";
            $image_resize = Image::make($app_icon->getRealPath());
            $image_resize->resize(512, 512);
            $image_resize->save("developer/Flutter/framework_01/android/app/src/main/res/mipmap-xxxhdpi/".$filename);
            $image_resize->resize(144, 144);
            $image_resize->save("developer/Flutter/framework_01/android/app/src/main/res/mipmap-xxhdpi/".$filename);
            $image_resize->resize(96, 96);
            $image_resize->save("developer/Flutter/framework_01/android/app/src/main/res/mipmap-xhdpi/".$filename);
            $image_resize->resize(72, 72);
            $image_resize->save("developer/Flutter/framework_01/android/app/src/main/res/mipmap-hdpi/".$filename);
            $image_resize->resize(48, 48);
            $image_resize->save("developer/Flutter/framework_01/android/app/src/main/res/mipmap-mdpi/".$filename);


            //get and resize App icons for IOS
            $IOS_image_resize = Image::make($app_icon->getRealPath());
            $IOS_image_resize->resize(1024,1024);
            $IOS_image_resize->save("developer/Flutter/framework_01/ios/Runner/Assets.xcassets/AppIcon.appiconset/Icon-App-1024x1024@1x.png");
            $IOS_image_resize->resize(180,180);
            $IOS_image_resize->save("developer/Flutter/framework_01/ios/Runner/Assets.xcassets/AppIcon.appiconset/Icon-App-60x60@3x.png");
            $IOS_image_resize->resize(167,167);
            $IOS_image_resize->save("developer/Flutter/framework_01/ios/Runner/Assets.xcassets/AppIcon.appiconset/Icon-App-83.5x83.5@2x.png");
            $IOS_image_resize->resize(152,152);
            $IOS_image_resize->save("developer/Flutter/framework_01/ios/Runner/Assets.xcassets/AppIcon.appiconset/Icon-App-76x76@2x.png");
            $IOS_image_resize->resize(120,120);
            $IOS_image_resize->save("developer/Flutter/framework_01/ios/Runner/Assets.xcassets/AppIcon.appiconset/Icon-App-60x60@2x.png");
            $IOS_image_resize->resize(120,120);
            $IOS_image_resize->save("developer/Flutter/framework_01/ios/Runner/Assets.xcassets/AppIcon.appiconset/Icon-App-40x40@3x.png");
            $IOS_image_resize->resize(87,87);
            $IOS_image_resize->save("developer/Flutter/framework_01/ios/Runner/Assets.xcassets/AppIcon.appiconset/Icon-App-29x29@3x.png");
            $IOS_image_resize->resize(80,80);
            $IOS_image_resize->save("developer/Flutter/framework_01/ios/Runner/Assets.xcassets/AppIcon.appiconset/Icon-App-40x40@2x.png");
            $IOS_image_resize->resize(76,76);
            $IOS_image_resize->save("developer/Flutter/framework_01/ios/Runner/Assets.xcassets/AppIcon.appiconset/Icon-App-76x76@1x.png");
            $IOS_image_resize->resize(60,60);
            $IOS_image_resize->save("developer/Flutter/framework_01/ios/Runner/Assets.xcassets/AppIcon.appiconset/Icon-App-20x20@3x.png");
            $IOS_image_resize->resize(58,58);
            $IOS_image_resize->save("developer/Flutter/framework_01/ios/Runner/Assets.xcassets/AppIcon.appiconset/Icon-App-29x29@2x.png");
            $IOS_image_resize->resize(40,40);
            $IOS_image_resize->save("developer/Flutter/framework_01/ios/Runner/Assets.xcassets/AppIcon.appiconset/Icon-App-40x40@1x.png");
            $IOS_image_resize->resize(40,40);
            $IOS_image_resize->save("developer/Flutter/framework_01/ios/Runner/Assets.xcassets/AppIcon.appiconset/Icon-App-20x20@2x.png");
            $IOS_image_resize->resize(29,29);
            $IOS_image_resize->save("developer/Flutter/framework_01/ios/Runner/Assets.xcassets/AppIcon.appiconset/Icon-App-29x29@1x.png");
            $IOS_image_resize->resize(20,20);
            $IOS_image_resize->save("developer/Flutter/framework_01/ios/Runner/Assets.xcassets/AppIcon.appiconset/Icon-App-20x20@1x.png");

//            $file_name="ic_launcher.png";
//            $dest = "developer/Flutter/framework_01/android/app/src/main/res/mipmap-hdpi/";
//            if(move_uploaded_file($basic_splash_image,$dest.$file_name)){
//            copy($dest.$file_name, "developer/Flutter/framework_01/android/app/src/main/res/mipmap-mdpi/".$file_name);
//            copy($dest.$file_name, "developer/Flutter/framework_01/android/app/src/main/res/mipmap-xhdpi/".$file_name);
//            copy($dest.$file_name, "developer/Flutter/framework_01/android/app/src/main/res/mipmap-xxhdpi/".$file_name);
//            copy($dest.$file_name, "developer/Flutter/framework_01/android/app/src/main/res/mipmap-xxxhdpi/".$file_name);
//        }


//            $file_name1="Icon-App-20x20@1x.png";
//        $file_name2="Icon-App-20x20@2x.png";
//        $file_name3="Icon-App-20x20@3x.png";
//        $file_name4="Icon-App-29x29@1x.png";
//        $file_name5="Icon-App-29x29@2x.png";
//        $file_name6="Icon-App-29x29@3x.png";
//        $file_name7="Icon-App-40x40@1x.png";
//        $file_name8="Icon-App-40x40@2x.png";
//        $file_name9="Icon-App-40x40@3x.png";
//        $file_name10="Icon-App-60x60@2x.png";
//        $file_name11="Icon-App-60x60@3x.png";
//        $file_name12="Icon-App-76x76@1x.png";
//        $file_name13="Icon-App-76x76@2x.png";
//        $file_name14="Icon-App-83.5x83.5@2x.png";
//        $file_name15="Icon-App-1024x1024@1x.png";
//        $icon_dest="developer/Flutter/framework_01/ios/Runner/Assets.xcassets/AppIcon.appiconset/";
//        if( move_uploaded_file($app_icon,$icon_dest.$file_name1)){
//            copy($icon_dest.$file_name1, "developer/Flutter/framework_01/ios/Runner/Assets.xcassets/AppIcon.appiconset/".$file_name2);
//            copy($icon_dest.$file_name1, "developer/Flutter/framework_01/ios/Runner/Assets.xcassets/AppIcon.appiconset/".$file_name3);
//            copy($icon_dest.$file_name1, "developer/Flutter/framework_01/ios/Runner/Assets.xcassets/AppIcon.appiconset/".$file_name4);
//            copy($icon_dest.$file_name1, "developer/Flutter/framework_01/ios/Runner/Assets.xcassets/AppIcon.appiconset/".$file_name5);
//            copy($icon_dest.$file_name1, "developer/Flutter/framework_01/ios/Runner/Assets.xcassets/AppIcon.appiconset/".$file_name6);
//            copy($icon_dest.$file_name1, "developer/Flutter/framework_01/ios/Runner/Assets.xcassets/AppIcon.appiconset/".$file_name7);
//            copy($icon_dest.$file_name1, "developer/Flutter/framework_01/ios/Runner/Assets.xcassets/AppIcon.appiconset/".$file_name8);
//            copy($icon_dest.$file_name1, "developer/Flutter/framework_01/ios/Runner/Assets.xcassets/AppIcon.appiconset/".$file_name9);
//            copy($icon_dest.$file_name1, "developer/Flutter/framework_01/ios/Runner/Assets.xcassets/AppIcon.appiconset/".$file_name10);
//            copy($icon_dest.$file_name1, "developer/Flutter/framework_01/ios/Runner/Assets.xcassets/AppIcon.appiconset/".$file_name11);
//            copy($icon_dest.$file_name1, "developer/Flutter/framework_01/ios/Runner/Assets.xcassets/AppIcon.appiconset/".$file_name12);
//            copy($icon_dest.$file_name1, "developer/Flutter/framework_01/ios/Runner/Assets.xcassets/AppIcon.appiconset/".$file_name13);
//            copy($icon_dest.$file_name1, "developer/Flutter/framework_01/ios/Runner/Assets.xcassets/AppIcon.appiconset/".$file_name14);
//            copy($icon_dest.$file_name1, "developer/Flutter/framework_01/ios/Runner/Assets.xcassets/AppIcon.appiconset/".$file_name15);
//        }
//


        }

        //
        $app_bg = $request->app_bg;
        if(isset($app_bg)){
        $file_name="bg.png";
        move_uploaded_file($app_bg,"developer/Flutter/framework_01/assets/images/".$file_name);
        }
        //
        $app_login_bg = $request->app_login_bg;
        if(isset($app_login_bg)){
        $file_name="bg_login.png";
        move_uploaded_file($app_login_bg,"developer/Flutter/framework_01/assets/images/".$file_name);
        }

        return back()->with('success','New Project data Created Successfuly to this system');
    }


}