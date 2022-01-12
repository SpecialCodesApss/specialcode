<?php

namespace Developer\Controllers;

use App\Models\Admin_sections;
use App\Models\Api_request;
use App\Http\Controllers\Controller;
use DB;
use Schema;
use File;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Storage;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Storage;

class ExtensionsController extends Controller
{
    public function index(){
        $extensions = DB::table("extensions")->get();
        return view('developer::extensions' , compact('extensions') );
    }


    public function export_extension(Request $request){
        $extension_id = $request->extension_id;
        $extension_info=DB::table("extensions")->where('id',$extension_id)->first();
        $extension_flag_name = $extension_info->extension_flag_name;


        $additional_extensions = $extension_info->additional_extensions;
        $additional_tables= $extension_info->additional_tables;
        $additional_extensions = json_decode($additional_extensions);
        $additional_tables = json_decode($additional_tables);

        //get full extension info from admin section
        $extension_full_info=DB::table("admin_sections")->where('section_flag',$extension_flag_name)->first();

        $extension_name=$extension_full_info->section_flag;
        $extension_controller_name=$extension_full_info->controller_name;



        $destination_parent_folder = 'developer/output/'.$extension_name;

        //Copy Admin Controller for extension in output module folder
        $destination_folder = '/admin/controller/';
        $destinationPath=$destination_parent_folder.$destination_folder;
        $file_name=$extension_controller_name.'.php';
        $source_file='app/Http/Controllers/admin/'. $extension_controller_name.'.php';
        if (file_exists($source_file)){
            if (!is_dir($destinationPath)) {  mkdir($destinationPath,0777,true);  }
            $content = file($source_file);
            File::put($destinationPath.$file_name,$content);
            //Admin Controllers for Extra and additional extensions
            foreach ($additional_extensions as $additional_extension){
                //get full extension info from admin section
                $additional_extension_full_info=DB::table("admin_sections")->where('section_flag',$additional_extension)->first();
                $additional_extension_controller_name=$additional_extension_full_info->controller_name;
                $destination_folder = '/admin/controller/';
                $destinationPath=$destination_parent_folder.$destination_folder;
                $file_name=$additional_extension_controller_name.'.php';
                $source_file='app/Http/Controllers/admin/'. $additional_extension_controller_name.'.php';
                if (!is_dir($destinationPath)) {  mkdir($destinationPath,0777,true);  }
                $content = file($source_file);
                File::put($destinationPath.$file_name,$content);
            }
        }



        //Copy Admin Views for extension in output module folder
        $destination_folder = '/admin/views/'.$extension_name.'/';
        $destinationPath=$destination_parent_folder.$destination_folder;
        //File 1 : index
        $file_name='index.blade.php';
        $source_file='resources/views/backend/'.$extension_name.'/index.blade.php';
        if (file_exists($source_file)) {
            if (!is_dir($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $content = file($source_file);
            File::put($destinationPath . $file_name, $content);
        }
        //File 2 : create
        $file_name='create.blade.php';
        $source_file='resources/views/backend/'.$extension_name.'/create.blade.php';
        if (file_exists($source_file)) {
            if (!is_dir($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $content = file($source_file);
            File::put($destinationPath . $file_name, $content);
        }
        //File 3 : view
        $file_name='show.blade.php';
        $source_file='resources/views/backend/'.$extension_name.'/show.blade.php';
        if (file_exists($source_file)) {
            if (!is_dir($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $content = file($source_file);
            File::put($destinationPath . $file_name, $content);
        }
        //File 4 : edit
        $file_name='edit.blade.php';
        $source_file='resources/views/backend/'.$extension_name.'/edit.blade.php';
        if (file_exists($source_file)) {
            if (!is_dir($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $content = file($source_file);
            File::put($destinationPath . $file_name, $content);
        }

            //Copy Admin Views for extension in output module folder for Extra and additional extensions
            foreach ($additional_extensions as $additional_extension){
                //get full extension info from admin section
                $additional_extension_full_info=DB::table("admin_sections")->where('section_flag',$additional_extension)->first();
                $additional_extension_controller_name=$additional_extension_full_info->controller_name;
                $destination_folder = '/admin/views/'.$additional_extension.'/';
                $destinationPath=$destination_parent_folder.$destination_folder;
                //File 1 : index
                $file_name='index.blade.php';
                $source_file='resources/views/backend/'.$additional_extension.'/index.blade.php';
                if (file_exists($source_file)) {
                    if (!is_dir($destinationPath)) {
                        mkdir($destinationPath, 0777, true);
                    }
                    $content = file($source_file);
                    File::put($destinationPath . $file_name, $content);
                }
                //File 2 : create
                $file_name='create.blade.php';
                $source_file='resources/views/backend/'.$additional_extension.'/create.blade.php';
                if (file_exists($source_file)) {
                    if (!is_dir($destinationPath)) {
                        mkdir($destinationPath, 0777, true);
                    }
                    $content = file($source_file);
                    File::put($destinationPath . $file_name, $content);
                }
                //File 3 : view
                $file_name='show.blade.php';
                $source_file='resources/views/backend/'.$additional_extension.'/show.blade.php';
                if (file_exists($source_file)) {
                    if (!is_dir($destinationPath)) {
                        mkdir($destinationPath, 0777, true);
                    }
                    $content = file($source_file);
                    File::put($destinationPath . $file_name, $content);
                }
                //File 4 : edit
                $file_name='edit.blade.php';
                $source_file='resources/views/backend/'.$additional_extension.'/edit.blade.php';
                if (file_exists($source_file)) {
                    if (!is_dir($destinationPath)) {
                        mkdir($destinationPath, 0777, true);
                    }
                    $content = file($source_file);
                    File::put($destinationPath . $file_name, $content);
                }
            }


        //Copy Mobile API Controller for extension in output module folder
        $destination_folder = '/api/';
        $destinationPath=$destination_parent_folder.$destination_folder;
        $file_name=$extension_controller_name.'.php';
        $source_file='app/Http/Controllers/API/'. $extension_controller_name.'.php';
        if (!is_dir($destinationPath)) {  mkdir($destinationPath,0777,true);  }
        if (file_exists($source_file)) {
            $content = file($source_file);
            File::put($destinationPath . $file_name, $content);
        }
            //API Controllers for Extra and additional extensions
            foreach ($additional_extensions as $additional_extension){
                //get full extension info from admin section
                $additional_extension_full_info=DB::table("admin_sections")->where('section_flag',$additional_extension)->first();
                $additional_extension_controller_name=$additional_extension_full_info->controller_name;
                $destination_folder = '/api/';
                $destinationPath=$destination_parent_folder.$destination_folder;
                $file_name=$additional_extension_controller_name.'.php';
                $source_file='app/Http/Controllers/API/'. $additional_extension_controller_name.'.php';
                if (file_exists($source_file)) {
                    if (!is_dir($destinationPath)) {
                        mkdir($destinationPath, 0777, true);
                    }
                    $content = file($source_file);
                    File::put($destinationPath . $file_name, $content);
                }
            }

        //Copy and Export database tables
        $get_all_table_query = "SHOW TABLES";
        $result = DB::select(DB::raw($get_all_table_query));



        $tables = [
            'admin_sections',
            'api_requests',
            'extensions',
            'routes',
            $extension_name,
        ];

            //get names for additional extensions
        $additional_extension_where_statments_for_admin_sections='';
        $additional_extension_where_statments_for_api_requests='';
        $additional_extension_where_statments_for_routes='';
            foreach ($additional_extensions as $additional_extension){
                $additional_extension_controller_name = Admin_sections::where("section_flag",$additional_extension)->get("controller_name");
                array_push($tables,$additional_extension);
                $additional_extension_where_statments_for_admin_sections.="OR section_flag = '$additional_extension'";
                $additional_extension_where_statments_for_api_requests.="OR name = '$additional_extension'";
                $additional_extension_where_statments_for_routes.="OR controller_name = '$additional_extension_controller_name'";
            }
            foreach ($additional_tables as $additional_table){
                array_push($tables,$additional_table);
            }

        $structure = '';
        $data = '';
        foreach ($tables as $table) {
            if($table != 'admin_sections' && $table != 'api_requests' && $table != 'extensions'&& $table != 'routes' ){
                $show_table_query = "SHOW CREATE TABLE " . $table . "";
                $show_table_result = DB::select(DB::raw($show_table_query));
                foreach ($show_table_result as $show_table_row) {
                    $show_table_row = (array)$show_table_row;
                    $structure .= "\n\n" . $show_table_row["Create Table"] . ";\n\n";
                }

                $select_query = "SELECT * FROM " . $table;
            }


            if($table == 'admin_sections'){
                $select_query = "SELECT * FROM " . $table." Where section_flag = '$extension_name' $additional_extension_where_statments_for_admin_sections ";
            }
            elseif($table == 'extensions'){
                $select_query = "SELECT * FROM " . $table." Where extension_flag_name = '$extension_name' ";
            }
            elseif($table == 'api_requests'){
                    $select_query = "SELECT * FROM " . $table." Where name = '$extension_name' $additional_extension_where_statments_for_api_requests";
            }
            elseif($table == 'routes'){
                    $select_query = "SELECT * FROM " . $table." Where controller_name = '$extension_controller_name' $additional_extension_where_statments_for_routes";
            }
            else{
                $select_query = "SELECT * FROM " . $table;
            }


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

        $destination_folder = '/database/';
        $destinationPath=$destination_parent_folder.$destination_folder;
        $file_name= 'database_backup.sql';
        if (!is_dir($destinationPath)) {  mkdir($destinationPath,0777,true);  }
        $content = $structure . $data;
        File::put($destinationPath.$file_name,$content);



        //Copy Languages files
        $destination_folder = '/lang/ar/';
        $destinationPath=$destination_parent_folder.$destination_folder;
        $file_name=$extension_name.'.php';
        $source_file='resources/lang/ar/'. $extension_name.'.php';
        if (file_exists($source_file)) {
            if (!is_dir($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $content = file($source_file);
            File::put($destinationPath . $file_name, $content);
        }
        ////Copy Languages files for Extra and additional extensions
        foreach ($additional_extensions as $additional_extension){
            //get full extension info from admin section
            $additional_extension_full_info=DB::table("admin_sections")->where('section_flag',$additional_extension)->first();
            $additional_extension_controller_name=$additional_extension_full_info->controller_name;
            $destination_folder = '/lang/ar/';
            $destinationPath=$destination_parent_folder.$destination_folder;
            $file_name=$additional_extension.'.php';
            $source_file='resources/lang/ar/'. $additional_extension.'.php';
            if (file_exists($source_file)) {
                if (!is_dir($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }
                $content = file($source_file);
                File::put($destinationPath . $file_name, $content);
            }
        }

        //Copy Languages files
        $destination_folder = '/lang/en/';
        $destinationPath=$destination_parent_folder.$destination_folder;
        $file_name=$extension_name.'.php';
        $source_file='resources/lang/en/'. $extension_name.'.php';
        if (file_exists($source_file)) {
            if (!is_dir($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $content = file($source_file);
            File::put($destinationPath . $file_name, $content);
        }
        ////Copy Languages files for Extra and additional extensions
        foreach ($additional_extensions as $additional_extension){
            //get full extension info from admin section
            $additional_extension_full_info=DB::table("admin_sections")->where('section_flag',$additional_extension)->first();
            $additional_extension_controller_name=$additional_extension_full_info->controller_name;
            $destination_folder = '/lang/en/';
            $destinationPath=$destination_parent_folder.$destination_folder;
            $file_name=$additional_extension.'.php';
            $source_file='resources/lang/en/'. $additional_extension.'.php';
            if (file_exists($source_file)) {
                if (!is_dir($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }
                $content = file($source_file);
                File::put($destinationPath . $file_name, $content);
            }
        }


        //Copy Module files
        $extension_module_name = $extension_info->extension_module_name;
        $extension_additional_modules = $extension_info->additional_modules;
        $extension_additional_modules = json_decode($extension_additional_modules);
        $destination_folder = '/module_file/';
        $destinationPath=$destination_parent_folder.$destination_folder;
        $file_name=$extension_module_name.'.php';
        $source_file='app/'. $extension_module_name.'.php';
        if (file_exists($source_file)) {
            if (!is_dir($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $content = file($source_file);
            File::put($destinationPath . $file_name, $content);
        }
        ////Copy Module files for Extra and additional extensions
        $i=0;
        foreach ($additional_extensions as $additional_extension){
            //get full extension info from admin section
//            $additional_extension_module_name=$extension_additional_modules[$i];
            $additional_extension_module_name=ucfirst($additional_extension);
            $additional_extension_module_name=rtrim($additional_extension, "s");

            $extension_flag_name = $extension_info->extension_flag_name;
            $i++;
            $additional_extension_full_info=DB::table("admin_sections")->where('section_flag',$additional_extension)->first();
            $additional_extension_controller_name=$additional_extension_full_info->controller_name;
            $destination_folder = '/module_file/';
            $destinationPath=$destination_parent_folder.$destination_folder;
            $file_name=$additional_extension_module_name.'.php';
            $source_file='app/'. $additional_extension_module_name.'.php';
            if (file_exists($source_file)) {
                if (!is_dir($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }
                $content = file($source_file);
                File::put($destinationPath . $file_name, $content);
            }
        }



        //*************************Flutter Files **************************//
        //Copy Flutter Controller for extension in output module folder
        $destination_folder = '/flutter/controller/';
        $destinationPath=$destination_parent_folder.$destination_folder;
        $file_name=$extension_controller_name.'.dart';
        $source_file='developer/Flutter/framework_01/lib/Controllers/'. $extension_controller_name.'.dart';
        if (file_exists($source_file)) {
            if (!is_dir($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $content = file($source_file);
            File::put($destinationPath . $file_name, $content);
        }
        //Flutter Controllers for Extra and additional extensions
        foreach ($additional_extensions as $additional_extension){
            //get full extension info from admin section
            $additional_extension_full_info=DB::table("admin_sections")->where('section_flag',$additional_extension)->first();
            $additional_extension_controller_name=$additional_extension_full_info->controller_name;
            $destination_folder = '/flutter/controller/';
            $destinationPath=$destination_parent_folder.$destination_folder;
            $file_name=$additional_extension_controller_name.'.dart';
            $source_file='developer/Flutter/framework_01/lib/Controllers/'. $additional_extension_controller_name.'.dart';
            if (file_exists($source_file)) {
                if (!is_dir($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }
                $content = file($source_file);
                File::put($destinationPath . $file_name, $content);
            }
        }


        //Copy Flutter Views for extension in output module folder
        $destination_folder = '/flutter/views/'.$extension_name.'/';
        $destinationPath=$destination_parent_folder.$destination_folder;
        //File 1 : index
        $file_name='index.dart';
        $source_file='developer/Flutter/framework_01/lib/Views/'.$extension_name.'/index.dart';
        if (file_exists($source_file)) {
            if (!is_dir($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $content = file($source_file);
            File::put($destinationPath . $file_name, $content);
        }
        //File 2 : create
        $file_name='store.dart';
        $source_file='developer/Flutter/framework_01/lib/Views/'.$extension_name.'/store.dart';
        if (file_exists($source_file)) {
            if (!is_dir($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $content = file($source_file);
            File::put($destinationPath . $file_name, $content);
        }
        //File 3 : view
        $file_name='view.dart';
        $source_file='developer/Flutter/framework_01/lib/Views/'.$extension_name.'/view.dart';
        if (file_exists($source_file)) {
            if (!is_dir($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $content = file($source_file);
            File::put($destinationPath . $file_name, $content);
        }
        //File 4 : edit
        $file_name='update.dart';
        $source_file='developer/Flutter/framework_01/lib/Views/'.$extension_name.'/update.dart';
        if (file_exists($source_file)) {
            if (!is_dir($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $content = file($source_file);
            File::put($destinationPath . $file_name, $content);
        }

        //Copy Flutter Views for extension in output module folder for Extra and additional extensions
        foreach ($additional_extensions as $additional_extension){
            //get full extension info from admin section
            $additional_extension_full_info=DB::table("admin_sections")->where('section_flag',$additional_extension)->first();
            $additional_extension_controller_name=$additional_extension_full_info->controller_name;
            $destination_folder = '/flutter/views/'.$additional_extension.'/';
                $destinationPath = $destination_parent_folder . $destination_folder;
                //File 1 : index
                $file_name = 'index.dart';
                $source_file = 'developer/Flutter/framework_01/lib/Views/' . $additional_extension . '/index.dart';
                if (file_exists($source_file)) {
                    if (!is_dir($destinationPath)) {
                        mkdir($destinationPath, 0777, true);
                    }
                    $content = file($source_file);
                    File::put($destinationPath . $file_name, $content);
                }
                //File 2 : create
                $file_name = 'store.dart';
                $source_file = 'developer/Flutter/framework_01/lib/Views/' . $additional_extension . '/store.dart';
                if (file_exists($source_file)) {
                    if (!is_dir($destinationPath)) {
                        mkdir($destinationPath, 0777, true);
                    }
                    $content = file($source_file);
                    File::put($destinationPath . $file_name, $content);
                }
                //File 3 : view
                $file_name = 'view.dart';
                $source_file = 'developer/Flutter/framework_01/lib/Views/' . $additional_extension . '/view.dart';
                if (file_exists($source_file)) {
                    if (!is_dir($destinationPath)) {
                        mkdir($destinationPath, 0777, true);
                    }
                    $content = file($source_file);
                    File::put($destinationPath . $file_name, $content);
                }
                //File 4 : edit
                $file_name = 'update.dart';
                $source_file = 'developer/Flutter/framework_01/lib/Views/' . $additional_extension . '/update.dart';
                if (file_exists($source_file)) {
                    if (!is_dir($destinationPath)) {
                        mkdir($destinationPath, 0777, true);
                    }
                    $content = file($source_file);
                    File::put($destinationPath . $file_name, $content);
                }
        }


        //Copy Languages files
        $destination_folder = '/flutter/lang/ar/';
        $destinationPath=$destination_parent_folder.$destination_folder;
        $file_name=$extension_name.'.dart';
        $source_file = 'developer/Flutter/framework_01/lib/lang/ar/'.$extension_name.'.dart';
        if (file_exists($source_file)) {
            if (!is_dir($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $content = file($source_file);
            File::put($destinationPath . $file_name, $content);
        }
        ////Copy Languages files for Extra and additional extensions
        foreach ($additional_extensions as $additional_extension){
            //get full extension info from admin section
            $additional_extension_full_info=DB::table("admin_sections")->where('section_flag',$additional_extension)->first();
            $additional_extension_controller_name=$additional_extension_full_info->controller_name;
            $destination_folder = '/flutter/lang/ar/';
            $destinationPath=$destination_parent_folder.$destination_folder;
            $file_name=$additional_extension.'.dart';
            $source_file = 'developer/Flutter/framework_01/lib/lang/ar/'.$additional_extension.'.dart';
            if (file_exists($source_file)) {
                if (!is_dir($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }
                $content = file($source_file);
                File::put($destinationPath . $file_name, $content);
            }
        }

        //Copy Languages files
        $destination_folder = '/flutter/lang/en/';
        $destinationPath=$destination_parent_folder.$destination_folder;
        $file_name=$extension_name.'.dart';
        $source_file = 'developer/Flutter/framework_01/lib/lang/en/'.$extension_name.'.dart';
        if (file_exists($source_file)) {
            if (!is_dir($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $content = file($source_file);
            File::put($destinationPath . $file_name, $content);
        }
        ////Copy Languages files for Extra and additional extensions
        foreach ($additional_extensions as $additional_extension){
            //get full extension info from admin section
            $additional_extension_full_info=DB::table("admin_sections")->where('section_flag',$additional_extension)->first();
            $additional_extension_controller_name=$additional_extension_full_info->controller_name;
            $destination_folder = '/flutter/lang/en/';
            $destinationPath=$destination_parent_folder.$destination_folder;
            $file_name=$additional_extension.'.dart';
            $source_file = 'developer/Flutter/framework_01/lib/lang/en/'.$additional_extension.'.dart';
            if (file_exists($source_file)) {
                if (!is_dir($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }
                $content = file($source_file);
                File::put($destinationPath . $file_name, $content);
            }
        }


        return back()->with('success','Extension Exported Successfuly to -developer/output- Folder');

    }




    public function delete_extension(Request $request){
        $extension_id = $request->extension_id;
        $extension_info=DB::table("extensions")->where('id',$extension_id)->first();
        $extension_flag_name = $extension_info->extension_flag_name;

        $additional_extensions = $extension_info->additional_extensions;
        $additional_tables= $extension_info->additional_tables;
        $additional_extensions = json_decode($additional_extensions);
        $additional_tables = json_decode($additional_tables);

        //get full extension info from admin section
        $extension_full_info=DB::table("admin_sections")->where('section_flag',$extension_flag_name)->first();

        $extension_name=$extension_full_info->section_flag;
        $extension_controller_name=$extension_full_info->controller_name;


        $module_name=ucfirst($extension_name);
        $module_name=rtrim($module_name, "s");
        $modules=[$module_name];
        foreach ($additional_extensions as $additional_extension){
            $module_name=ucfirst($additional_extension);
            $module_name=rtrim($module_name, "s");
            array_push($modules,$module_name);
        }


        //Delete Admin Controller for extension
        $source_file='app/Http/Controllers/admin/'. $extension_controller_name.'.php';
        if (file_exists($source_file)){
            unlink($source_file);
            //Delete Admin Controllers for Extra and additional extensions
            foreach ($additional_extensions as $additional_extension){
                //get full extension info from admin section
                $additional_extension_full_info=DB::table("admin_sections")->where('section_flag',$additional_extension)->first();
                $additional_extension_controller_name=$additional_extension_full_info->controller_name;
                $source_file='app/Http/Controllers/admin/'. $additional_extension_controller_name.'.php';
                unlink($source_file);
            }
        }


        //del Admin Views for extension in output module folder
        //File 1 : index
        $source_file='resources/views/backend/'.$extension_name.'/index.blade.php';
        if (file_exists($source_file)) {
            unlink($source_file);
        }
        //File 2 : create
        $source_file='resources/views/backend/'.$extension_name.'/create.blade.php';
        if (file_exists($source_file)) {
            unlink($source_file);
        }
        //File 3 : view
        $source_file='resources/views/backend/'.$extension_name.'/show.blade.php';
        if (file_exists($source_file)) {
            unlink($source_file);
        }
        //File 4 : edit
        $source_file='resources/views/backend/'.$extension_name.'/edit.blade.php';
        if (file_exists($source_file)) {
            unlink($source_file);
        }
        //delete Folder
        $source_folder='resources/views/backend/'.$extension_name;
        if (is_dir($source_folder)) {
            rmdir($source_folder);
        }

        //del Admin Views for extension in output module folder for Extra and additional extensions
        foreach ($additional_extensions as $additional_extension){
            //get full extension info from admin section
            $additional_extension_full_info=DB::table("admin_sections")->where('section_flag',$additional_extension)->first();
            $additional_extension_controller_name=$additional_extension_full_info->controller_name;
            //File 1 : index
            $source_file='resources/views/'.$additional_extension.'/index.blade.php';
            if (file_exists($source_file)) {
                unlink($source_file);
            }
            //File 2 : create
            $source_file='resources/views/'.$additional_extension.'/create.blade.php';
            if (file_exists($source_file)) {
                unlink($source_file);
            }
            //File 3 : view
            $source_file='resources/views/'.$additional_extension.'/show.blade.php';
            if (file_exists($source_file)) {
                unlink($source_file);
            }
            //File 4 : edit
            $source_file='resources/views/'.$additional_extension.'/edit.blade.php';
            if (file_exists($source_file)) {
                unlink($source_file);
            }
            //delete Folder
            $source_folder='resources/views/'.$additional_extension;
            if (is_dir($source_folder)) {
                rmdir($source_folder);
            }
        }


        //Delete Mobile API Controller for extension in output module folder
        $source_file='app/Http/Controllers/API/'. $extension_controller_name.'.php';
        if (file_exists($source_file)) {
            unlink($source_file);
        }
        //API Controllers for Extra and additional extensions
        foreach ($additional_extensions as $additional_extension){
            //get full extension info from admin section
            $additional_extension_full_info=DB::table("admin_sections")->where('section_flag',$additional_extension)->first();
            $additional_extension_controller_name=$additional_extension_full_info->controller_name;
            $source_file='app/Http/Controllers/API/'. $additional_extension_controller_name.'.php';
            if (file_exists($source_file)) {
                unlink($source_file);
            }
        }

        //Del Languages files
        $source_file='resources/lang/ar/'. $extension_name.'.php';
        if (file_exists($source_file)) {
            unlink($source_file);
        }
        ////del Languages files for Extra and additional extensions
        foreach ($additional_extensions as $additional_extension){
            //get full extension info from admin section
            $additional_extension_full_info=DB::table("admin_sections")->where('section_flag',$additional_extension)->first();
            $source_file='resources/lang/ar/'. $additional_extension.'.php';
            if (file_exists($source_file)) {
                unlink($source_file);
            }
        }

        //del Languages files
        $file_name=$extension_name.'.php';
        $source_file='resources/lang/en/'. $extension_name.'.php';
        if (file_exists($source_file)) {
            unlink($source_file);
        }
        ////Copy Languages files for Extra and additional extensions
        foreach ($additional_extensions as $additional_extension){
            //get full extension info from admin section
            $additional_extension_full_info=DB::table("admin_sections")->where('section_flag',$additional_extension)->first();
            $source_file='resources/lang/en/'. $additional_extension.'.php';
            if (file_exists($source_file)) {
                unlink($source_file);
            }
        }


        //del Module files
        $extension_module_name = $extension_info->extension_module_name;
        $extension_additional_modules = $extension_info->additional_modules;
        $extension_additional_modules = json_decode($extension_additional_modules);
        $source_file='app/'. $extension_module_name.'.php';
        if (file_exists($source_file)) {
            unlink($source_file);
        }
        ////del Module files for Extra and additional extensions
        $i=0;
        foreach ($additional_extensions as $additional_extension){
            //get full extension info from admin section
            $additional_extension_module_name=$extension_additional_modules[$i];
            $i++;
            $additional_extension_full_info=DB::table("admin_sections")->where('section_flag',$additional_extension)->first();
            $source_file='app/'. $additional_extension_module_name.'.php';
            if (file_exists($source_file)) {
                unlink($source_file);
            }
        }


        //*************************Flutter Files **************************//
        //del Flutter Controller for extension in output module folder
        $source_file='developer/Flutter/framework_01/lib/Controllers/'. $extension_controller_name.'.dart';
        if (file_exists($source_file)) {
            unlink($source_file);
        }
        //Flutter Controllers for Extra and additional extensions
        foreach ($additional_extensions as $additional_extension){
            //get full extension info from admin section
            $additional_extension_full_info=DB::table("admin_sections")->where('section_flag',$additional_extension)->first();
            $additional_extension_controller_name=$additional_extension_full_info->controller_name;
            $source_file='developer/Flutter/framework_01/lib/Controllers/'. $additional_extension_controller_name.'.dart';
            if (file_exists($source_file)) {
                unlink($source_file);
            }
        }


        //del Flutter Views for extension in output module folder
        //File 1 : index
        $source_file='developer/Flutter/framework_01/lib/Views/'.$extension_name.'/index.dart';
        if (file_exists($source_file)) {
            unlink($source_file);
        }
        //File 2 : create
        $source_file='developer/Flutter/framework_01/lib/Views/'.$extension_name.'/store.dart';
        if (file_exists($source_file)) {
            unlink($source_file);
        }
        //File 3 : view
        $source_file='developer/Flutter/framework_01/lib/Views/'.$extension_name.'/view.dart';
        if (file_exists($source_file)) {
            unlink($source_file);
        }
        //File 4 : edit
        $source_file='developer/Flutter/framework_01/lib/Views/'.$extension_name.'/update.dart';
        if (file_exists($source_file)) {
            unlink($source_file);
        }
        //delete folder
        $source_folder='developer/Flutter/framework_01/lib/Views/'.$extension_name;
        if (is_dir($source_folder)) {
            rmdir($source_folder);
        }

        //Copy Flutter Views for extension in output module folder for Extra and additional extensions
        foreach ($additional_extensions as $additional_extension){
            //get full extension info from admin section
            $additional_extension_full_info=DB::table("admin_sections")->where('section_flag',$additional_extension)->first();

            //File 1 : index
            $source_file = 'developer/Flutter/framework_01/lib/Views/' . $additional_extension . '/index.dart';
            if (file_exists($source_file)) {
                unlink($source_file);
            }
            //File 2 : create
            $source_file = 'developer/Flutter/framework_01/lib/Views/' . $additional_extension . '/store.dart';
            if (file_exists($source_file)) {
                unlink($source_file);
            }
            //File 3 : view
            $source_file = 'developer/Flutter/framework_01/lib/Views/' . $additional_extension . '/view.dart';
            if (file_exists($source_file)) {
                unlink($source_file);
            }
            //File 4 : edit
            $source_file = 'developer/Flutter/framework_01/lib/Views/' . $additional_extension . '/update.dart';
            if (file_exists($source_file)) {
                unlink($source_file);
            }
            //delete folder
            $source_folder='developer/Flutter/framework_01/lib/Views/'.$additional_extension;
            if (is_dir($source_folder)) {
                rmdir($source_folder);
            }
        }


        //del Languages files
        $source_file = 'developer/Flutter/framework_01/lib/lang/ar/'.$extension_name.'.dart';
        if (file_exists($source_file)) {
            unlink($source_file);
        }
        ////Copy Languages files for Extra and additional extensions
        foreach ($additional_extensions as $additional_extension){
            //get full extension info from admin section
            $additional_extension_full_info=DB::table("admin_sections")->where('section_flag',$additional_extension)->first();
            $source_file = 'developer/Flutter/framework_01/lib/lang/ar/'.$additional_extension.'.dart';
            if (file_exists($source_file)) {
                unlink($source_file);
            }
        }

        //del Languages files
        $file_name=$extension_name.'.dart';
        $source_file = 'developer/Flutter/framework_01/lib/lang/en/'.$extension_name.'.dart';
        if (file_exists($source_file)) {
            unlink($source_file);
        }
        ////Copy Languages files for Extra and additional extensions
        foreach ($additional_extensions as $additional_extension){
            //get full extension info from admin section
            $additional_extension_full_info=DB::table("admin_sections")->where('section_flag',$additional_extension)->first();
            $source_file = 'developer/Flutter/framework_01/lib/lang/en/'.$additional_extension.'.dart';
            if (file_exists($source_file)) {
                unlink($source_file);
            }
        }

        //Delete JSON API requests
        $api_request=Api_request::where('name',$extension_flag_name)->first();
        $Generated_JSON_APIs_Requests='';

            $list_code='';
            $create_code='';
            $update_code='';
            $view_code='';
            $delete_code='';
            $_is_second_item=false;
            if($api_request['Mobile_List']==1){
                if($_is_second_item==true){$comma=',';}else{$comma='';}
                if($api_request['list_authorization_status']==1){
                    $header='"header": [
							{
								"key": "Accept",
								"value": "application/json",
								"type": "text"
							},
							{
								"key": "Authorization",
								"value": "{{token}}",
								"type": "text"
							},
							{
								"key": "language",
								"value": "ar",
								"type": "text"
							}
						],
                    ';
                }else{  $header='"header": [],';}
                $list_code=$comma.'{
                        "name": "List '.$api_request['name'].'",
                        "request": {
                            "method": "GET",
                            '.$header.'
                            "url": {
                                "raw": "{{url}}/api/'.$api_request['name'].'",
                                "host": [
                                    "{{url}}"
                                ],
                                "path": [
                                    "api",
                                    "'.$api_request['name'].'"
                                ]
                            }
                        },
                        "response": []
                    }';
                $_is_second_item=true;
            }

            if($api_request['Mobile_Create']==1){
                if($_is_second_item==true){$comma=',';}else{$comma='';}
                if($api_request['create_authorization_status']==1){
                    $header='"header": [
							{
								"key": "Accept",
								"value": "application/json",
								"type": "text"
							},
							{
								"key": "Authorization",
								"value": "{{token}}",
								"type": "text"
							},
							{
								"key": "language",
								"value": "ar",
								"type": "text"
							}
						],
                    ';
                }else{  $header='"header": [],';}
                $parameters=$api_request['parameters'];
                $parameters=\GuzzleHttp\json_decode($parameters);

                $parameters_code='';
                $first_item=true;

                foreach ($parameters as $parameter){
                    $type='text';
                    if(strpos($parameter,'image') !== false ){
                        $type='file';
                    }
                    $comma= ($first_item==true) ? '' : ',';
                    $parameters_code=$parameters_code.'
                                '.$comma.'{
                                    "key": "'.$parameter.'",
                                    "value": "'.$parameter.'",
                                    "type": "'.$type.'"
                                }
                    ';
                    $first_item=false;
                }
                $create_code=$comma.'{
					"name": "Create '.$api_request['name'].'",
					"request": {
						"method": "POST",
						'.$header.'
						"body": {
							"mode": "formdata",
							"formdata": [
								'.$parameters_code.'
							]
						},
						"url": {
							"raw": "{{url}}/api/'.$api_request['name'].'",
							"host": [
								"{{url}}"
							],
							"path": [
								"api",
								"'.$api_request['name'].'"
							]

						}
					},
					"response": []
				}';
                $_is_second_item=true;
            }

            if($api_request['Mobile_Update']==1){
                if($_is_second_item==true){$comma=',';}else{$comma='';}
                if($api_request['update_authorization_status']==1){
                    $header='"header": [
							{
								"key": "Accept",
								"value": "application/json",
								"type": "text"
							},
							{
								"key": "Authorization",
								"value": "{{token}}",
								"type": "text"
							},
							{
								"key": "language",
								"value": "ar",
								"type": "text"
							}
						],
                    ';
                }else{  $header='"header": [],';}
                $parameters=$api_request['parameters'];
                $parameters=\GuzzleHttp\json_decode($parameters);

                $parameters_code='';
                $first_item=true;
                foreach ($parameters as $parameter){
                    $type='text';
                    if(strpos($parameter,'image') !== false ){
                        $type='file';
                    }
                    $comma= ($first_item==true) ? '' : ',';
                    $parameters_code=$parameters_code.'
                                '.$comma.'{
                                    "key": "'.$parameter.'",
                                    "value": "'.$parameter.'",
                                    "type": "'.$type.'"
                                }
                    ';
                    $first_item=false;
                }
                $update_code=$comma.'{
					"name": "Update '.$api_request['name'].'",
					"request": {
						"method": "POST",
						'.$header.'
						"body": {
							"mode": "formdata",
							"formdata": [
								'.$parameters_code.'
							]
						},
						"url": {
							"raw": "{{url}}/api/'.$api_request['name'].'/1",
							"host": [
								"{{url}}"
							],
							"path": [
								"api",
								"'.$api_request['name'].'",
								"1"
							],
							"query": [
								{
									"key": "_method",
									"value": "PUT"
								}
							]
						}
					},
					"response": []
				}';
                $_is_second_item=true;
            }


            if($api_request['Mobile_View']==1){
                if($_is_second_item==true){$comma=',';}else{$comma='';}
                if($api_request['view_authorization_status']==1){
                    $header='"header": [
							{
								"key": "Accept",
								"value": "application/json",
								"type": "text"
							},
							{
								"key": "Authorization",
								"value": "{{token}}",
								"type": "text"
							},
							{
								"key": "language",
								"value": "ar",
								"type": "text"
							}
						],
                    ';
                }else{  $header='"header": [],';}
                $parameters=$api_request['parameters'];
                $parameters=\GuzzleHttp\json_decode($parameters);

                $parameters_code='';
                $first_item=true;
                foreach ($parameters as $parameter){
                    $type='text';
                    if(strpos($parameter,'image') !== false ){
                        $type='file';
                    }
                    $comma= ($first_item==true) ? '' : ',';
                    $parameters_code=$parameters_code.'
                                '.$comma.'{
                                    "key": "'.$parameter.'",
                                    "value": "'.$parameter.'",
                                    "type": "'.$type.'"
                                }
                    ';
                    $first_item=false;
                }
                $view_code=$comma.'{
					"name": "Show '.$api_request['name'].'",
					"request": {
						"method": "GET",
						'.$header.'
						"url": {
							"raw": "{{url}}/api/'.$api_request['name'].'/1",
							"host": [
								"{{url}}"
							],
							"path": [
								"api",
								"'.$api_request['name'].'",
								"1"
							]
						}
					},
					"response": []
				}';
                $_is_second_item=true;
            }


            if($api_request['Mobile_Delete']==1){
                if($_is_second_item==true){$comma=',';}else{$comma='';}
                if($api_request['delete_authorization_status']==1){
                    $header='"header": [
							{
								"key": "Accept",
								"value": "application/json",
								"type": "text"
							},
							{
								"key": "Authorization",
								"value": "{{token}}",
								"type": "text"
							},
							{
								"key": "language",
								"value": "ar",
								"type": "'.$type.'"
							}
						],
                    ';
                }else{  $header='"header": [],';}
                $parameters=$api_request['parameters'];
                $parameters=\GuzzleHttp\json_decode($parameters);

                $parameters_code='';
                $first_item=true;
                foreach ($parameters as $parameter){
                    $type='text';
                    if(strpos($parameter,'image') !== false ){
                        $type='file';
                    }
                    $comma= ($first_item==true) ? '' : ',';
                    $parameters_code=$parameters_code.'
                                '.$comma.'{
                                    "key": "'.$parameter.'",
                                    "value": "'.$parameter.'",
                                    "type": "'.$type.'"
                                }
                    ';
                    $first_item=false;
                }
                $delete_code=$comma.'{
					"name": "Delete '.$api_request['name'].'",
					"request": {
						"method": "DELETE",
						'.$header.'
						"url": {
							"raw": "{{url}}/api/'.$api_request['name'].'/1",
							"host": [
								"{{url}}"
							],
							"path": [
								"api",
								"'.$api_request['name'].'",
								"1"
							]
						}
					},
					"response": []
				}';
                $_is_second_item=true;
            }

            $Generated_JSON_APIs_Requests=$Generated_JSON_APIs_Requests.',
                {
                "name": "'.$api_request['name'].'",
                "item": [
                       '.$list_code.'
                       '.$create_code.'
                       '.$update_code.'
                       '.$view_code.'
                       '.$delete_code.'
                ],
                "protocolProfileBehavior": {}
            }
            ';

            //delete this auto generated code from json file
        $JSON_Content = file('developer/Framework_V_1.7.postman_collection.json');
        $JSON_Content = implode($JSON_Content);
        $JSON_Content=str_replace($Generated_JSON_APIs_Requests,"",$JSON_Content);
        $new_file = 'Framework_V_1.7.postman_collection.json';
        $destinationPath="developer/";
        File::put($destinationPath.$new_file,$JSON_Content);



        //Delete database tables ot fields
        $tables = [
            'admin_sections',
            'api_requests',
            'extensions',
            $extension_name,
        ];

        //get names for additional extensions
        $where_admin_section=[$extension_name];
        $where_api_requests=[$extension_name];
        foreach ($additional_extensions as $additional_extension){
            array_push($tables,$additional_extension);
            array_push($where_admin_section,$additional_extension);
            array_push($where_api_requests,$additional_extension);
        }
        foreach ($additional_tables as $additional_table){
            array_push($tables,$additional_table);
        }

        foreach ($tables as $table) {

            if($table == 'admin_sections'){
                DB::table('admin_sections')->whereIn('section_flag',$where_admin_section)->delete();
            }
            elseif($table == 'api_requests'){
                DB::table('api_requests')->whereIn('name',$where_api_requests)->delete();
            }
            elseif($table == 'extensions'){
                DB::table('extensions')->where('extension_flag_name',$extension_name)->delete();
            }
            else{
                Schema::drop($table);
            }

        }



        /******************************/
        /******Delete  module premission and roles_has_permission for current module ******/
        /******************************/

        foreach ($modules as $module_name){
            //Create premissions
            $permissions = [];
            array_push($permissions,''.$module_name.'_Create');
            array_push($permissions,''.$module_name.'_Read');
            array_push($permissions,''.$module_name.'_Update');
            array_push($permissions,''.$module_name.'_Delete');

            $role=Role::find(1);
            //cheek if its permission inserted before or not
            $isTherePremission=Permission::where("name",$module_name.'_Read')->first();
            if(isset($isTherePremission)){
                foreach ($permissions as $permission) {
                    //revoke this premission for role admin
                    $role->revokePermissionTo($permission);
                    //delete new premissions
                    Permission::where(['name' => $permission])->delete();
                }
            }
        }

        //clear caches
        \Artisan::call('cache:forget spatie.permission.cache');

        /******************************/
        /******end Delete module premission and roles_has_permission for current module ******/
        /******************************/

        return back()->with('success','Extension Deleted Successfuly from this system');
    }




    public function viewInstall_module(){
        return view('developer::install_module');
    }

    public function install_module(Request $request){

//        $module_name=$request->module_name;
        $modules = [];
        $pathes=$request->pathes;
        $pathes = explode(',', $pathes);
        $files = $request->file('files');

        $i=0;
        foreach ($files as $file) {
            //check file path
            $destinationPath='';
            if(strpos($pathes[$i],'admin/controller') !== false){
                $destinationPath="app/Http/Controllers/admin";
            }
            elseif(strpos($pathes[$i],'admin/views') !== false){
                $uri_segments = explode('/',  $pathes[$i]);
                $destinationPath="resources/views/backend/".$uri_segments[3];
            }
            elseif(strpos($pathes[$i],'/api') !== false){
                $destinationPath="app/Http/Controllers/API";
            }
            elseif(strpos($pathes[$i],'/database') !== false){

                $commands = file_get_contents($file);
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
                foreach($commands as $command){
                    if(trim($command)){
                        DB::statement($command);
                    }
                }


            }
            elseif(strpos($pathes[$i],'/flutter/controller') !== false){
                $destinationPath="developer/Flutter/framework_01/lib/Controllers";
            }
//

            elseif(strpos($pathes[$i],'flutter/lang/ar') !== false){
                $destinationPath="developer/Flutter/framework_01/lib/lang/ar";
            }
            elseif(strpos($pathes[$i],'flutter/lang/en') !== false){
                $destinationPath="developer/Flutter/framework_01/lib/lang/en";
            }


            elseif(strpos($pathes[$i],'flutter/views') !== false){
                $uri_segments = explode('/',  $pathes[$i]);
                $destinationPath="developer/Flutter/framework_01/lib/Views/".$uri_segments[3];
            }
            elseif(strpos($pathes[$i],'/lang') !== false){
                if(strpos($pathes[$i],'ar') !== false){
                    $destinationPath="resources/lang/ar";
                }
                elseif(strpos($pathes[$i],'en') !== false){
                    $destinationPath="resources/lang/en";
                }
            }
            elseif(strpos($pathes[$i],'module_file') !== false){
                $uri_segments = explode('/',  $pathes[$i]);
                $new_module_file_name = $uri_segments[2];
                array_push($modules,$new_module_file_name);
                $destinationPath="app";
            }

            if($destinationPath != null || $destinationPath != ''){
                $fileName = $file->getClientOriginalName();
                if(!is_dir($destinationPath)){
                    mkdir($destinationPath,0777,true);
                }
                $file->move($destinationPath, $fileName);
            }
            $i++;
        }


        /******************************/
        /******start add module premission and roles_has_permission for current module ******/
        /******************************/

        foreach ($modules as $module_name){
            $module_name = str_replace(".php","",$module_name);
            //Create premissions
            $permissions = [];
            array_push($permissions,''.$module_name.'_Create');
            array_push($permissions,''.$module_name.'_Read');
            array_push($permissions,''.$module_name.'_Update');
            array_push($permissions,''.$module_name.'_Delete');

            $role=Role::find(1);
            //cheek if its permission inserted before or not
            $isTherePremission=Permission::where("name",$module_name.'_Read')->first();
            if(! isset($isTherePremission)){
                foreach ($permissions as $permission) {
                    //instert new premissions
                    Permission::create(['name' => $permission]);
                    //set this premission for role admin
                    $role->givePermissionTo($permission);
                }
            }
        }

        /******************************/
        /******end add module premission and roles_has_permission for current module ******/
        /******************************/
//        echo "Module is successfully installed";
        return back()->with('success','Extension installed Successfuly to this system');
    }


}
