<?php

namespace Developer\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use File;
use DB;
use App\Admin_sections;
use Session;
use Statickidz\GoogleTranslate;


class UsersController extends Controller
{

    public function create_user_module(Request $request){
        $input = $request->all();
        //add users navigator to admin sections

        ////////////////////////////////////////////////////
        ////////////////// 1 /////////////////////////////
        ///////////////////////////////////////////////////
        //first check if this flag inserted before or not
        $isThereSameFlag=Admin_sections::where('section_flag',"users")->first();
        if(! isset($isThereSameFlag) ){
            Admin_sections::create([
                'section_name_ar' => "المستخدمين",
                'section_name_en' => "Users",
                'section_icon' => "user",
                'section_flag' => "users",
                'controller_name' => "UsersController",
                'is_notification_able' => 1,
                'is_drop_menu' => 0,
                'active' => 1,
                'sort' => 1,
            ]);
        }


        ////////////////////////////////////////////////////
        ////////////////// 2 /////////////////////////////
        ///////////////////////////////////////////////////
        //add language files
        /******************************/
        /******Start Make Language File******/
        /******************************/

        //get ar and en lang content
        //get fields
        $ar_lines='';
        $en_lines='';


        $table_fields=["id","type_id ","profile_image","fullname","email","mobile"
        ,"gender","email_verify_code","mobile_verify_code","email_verified_at","mobile_verified_at"
            ,"password","created_at","updated_at"];

        $table_fields_en=["id","User Type","Profile image","Full name","Email","Mobile"
            ,"Gender","Email verification code","Mobile verification code",
            "Email verified at","Mobile verified at"
            ,"Password","Created at","Updated at"];

        $table_fields_ar=["كود المستخدم","نوع المستخدم ","صورة البروفايل","اسم المستخدم ",
            "البريد الإلكتروني","رقم الجوال"
            ,"نوع الجنس","كود تأكيد البريد","كود تأكيد الموبايل","تاريخ تفعيل البريد",
            "تاريخ تفعيل الجوال"
            ,"الرقم السري","تاريخ الإضافة","تاريخ التحديث"];

        $i=0;
        foreach ($table_fields as $table_field){
            $ar_new_line="'".$table_field."'=>'".$table_fields_en[$i]."',\n";
            $en_new_line="'".$table_field."'=>'".$table_fields_ar[$i]."',\n";
            $ar_lines=$ar_lines.$ar_new_line;
            $en_lines=$en_lines.$en_new_line;
            $i++;
        }

        //add CRUD Messages TRanslation to Files

        //Create
        $create_message_en="User created successfully";
        $create_message_ar= "تم إضافة بيانات المستخدم بنجاح";
        $ar_new_line="'User_created'=>'".$create_message_ar."',\n";
        $en_new_line="'User_created'=>'".$create_message_en."',\n";
        $ar_lines=$ar_lines.$ar_new_line;
        $en_lines=$en_lines.$en_new_line;

        //read
        $create_message_en="User readed successfully";
        $create_message_ar= "تم استرجاع بيانات المستخدم بنجاح";
        $ar_new_line="'User_readed'=>'".$create_message_ar."',\n";
        $en_new_line="'User_readed'=>'".$create_message_en."',\n";
        $ar_lines=$ar_lines.$ar_new_line;
        $en_lines=$en_lines.$en_new_line;

        //Update
        $create_message_en="User Updated successfully";
        $create_message_ar= "تم تعديل بيانات المستخدم بنجاح";
        $ar_new_line="'User_updated'=>'".$create_message_ar."',\n";
        $en_new_line="'User_updated'=>'".$create_message_en."',\n";
        $ar_lines=$ar_lines.$ar_new_line;
        $en_lines=$en_lines.$en_new_line;

        //Delete
        $create_message_en="User Deleted successfully";
        $create_message_ar= "تم إضافة بيانات المستخدم بنجاح";
        $ar_new_line="'User_deleted'=>'".$create_message_ar."',\n";
        $en_new_line="'User_deleted'=>'".$create_message_en."',\n";
        $ar_lines=$ar_lines.$ar_new_line;
        $en_lines=$en_lines.$en_new_line;

        //additional
        $ar_new_line="'Users'=>'المستخدمين',\n";
        $ar_new_line="'Users'=>'Users',\n";
        $ar_lines=$ar_lines.$ar_new_line;
        $en_lines=$en_lines.$en_new_line;

        $ar_new_line="'Admin - Users'=>' لوحة التحكم - المستخدمين' ,\n";
        $ar_new_line="'Admin - Users'=>'Admin - Users',\n";
        $ar_lines=$ar_lines.$ar_new_line;
        $en_lines=$en_lines.$en_new_line;



        $ar_lang_content='
        <?php
        return [
            '.$ar_lines.'
        ];?>';
        $en_lang_content='
        <?php
        return [
            '.$en_lines.'
        ];?>';



        $file = 'users.php';
        $ar_destinationPath="resources/lang/ar/";
        $en_destinationPath="resources/lang/en/";
        if (!is_dir($ar_destinationPath)) {  mkdir($ar_destinationPath,0777,true); }
        if (!is_dir($en_destinationPath)) {  mkdir($en_destinationPath,0777,true); }
        File::put($ar_destinationPath.$file,$ar_lang_content);
        File::put($en_destinationPath.$file,$en_lang_content);

        /******************************/
        /******End Make Language File******/
        /******************************/


        ////////////////////////////////////////////////////
        ////////////////// 3 /////////////////////////////
        ///////////////////////////////////////////////////
        /// add module premissions and give its to admin and super admin //
        $permissions = [];
        array_push($permissions,'User_Create');
        array_push($permissions,'User_Read');
        array_push($permissions,'User_Update');
        array_push($permissions,'User_Delete');
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        foreach ($permissions as $permission) {
            $role = Role::where(['name' => "super_admin"])->first();
            $role->givePermissionTo($permission);
            $role = Role::where(['name' => "admin"])->first();
            $role->givePermissionTo($permission);
        }




    }





}
