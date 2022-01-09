<?php
namespace Developer\Traits;
use App\Models\Admin_sections;
use App\Models\Extension;
use App\Models\Route;
use File;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use DB;
use \Statickidz\GoogleTranslate;


trait Web_traits{


    public function CreateWebControllerFile($module_name,$table_name,$table_fields,$section_flag,$input,$Capital_table_name){
    /******************************/
    /******Start Controller Content******/
    /******************************/

    $controller_name=$module_name.'Controller';
    $module_controller_name="use App\\Models\\".$module_name.";";

    //store validator
    $validations ='';
    foreach ($table_fields as $table_field){
        if(isset($input[$table_field.'_mobileAPIRequiredStore'])){
            $new_line='\''.$table_field.'\'=>\'required\',
                ';
            $validations=$validations.$new_line;
        }
    }
    if($input['table_has_multiple_images']=='1'){
        $new_line='\'images\'=>\'required\',
                ';
        $validations=$validations.$new_line;
    }
    if($input['table_has_multiple_files']=='1'){
        $new_line='\'files\'=>\'required\',
                ';
        $validations=$validations.$new_line;
    }

    $controller_validations='
            Validator::make($input, [
            '.$validations.'
        ]);
        ';
    //update validators
    $validations ='';
    foreach ($table_fields as $table_field){
        if(isset($input[$table_field.'_mobileAPIRequiredUpdate']) && $input[$table_field.'_datatype'] != 'image' && $input[$table_field.'_datatype'] != 'file'){
            $new_line='\''.$table_field.'\'=>\'required\',
                ';
            $validations=$validations.$new_line;
        }
    }
    $controller_update_validations='
            Validator::make($input, [
            '.$validations.'
        ]);
        ';


    //*******check images or logo in fields to add its requirements ******//
    /***************************/
    $files_store_statements='';
    foreach ($table_fields as $table_field){
        if($input[$table_field.'_datatype'] == 'image' || $input[$table_field.'_datatype'] == 'file'){
            $files_store_statements=$files_store_statements.'
                if ($request->hasFile(\''.$table_field.'\')) {
                    $document = $request->file(\''.$table_field.'\');
                    $ext = $document->getClientOriginalExtension();
                        $imageName = date(\'YmdHis\') . ".$ext";
                        $path = \'storage/images/'.$section_flag.'/'.$table_field.'/\';
                        $request->file(\''.$table_field.'\')->move($path, $imageName);
                        $input[\''.$table_field.'\'] = $path.$imageName;
                }
                ';
        }
    }

    $files_update_store_statements='';
    foreach ($table_fields as $table_field){
        if($input[$table_field.'_datatype'] == 'image' || $input[$table_field.'_datatype'] == 'file'){
            $files_update_store_statements=$files_update_store_statements.'
                $old_'.$table_field.'='.$module_name.'::find($'.$module_name.'_id)->'.$table_field.';
                if ($request->hasFile(\''.$table_field.'\')) {
                    $document = $request->file(\''.$table_field.'\');
                    $ext = $document->getClientOriginalExtension();
                        $imageName = date(\'YmdHis\') . ".$ext";
                        $path = \'storage/images/'.$section_flag.'/'.$table_field.'/\';
                        $request->file(\''.$table_field.'\')->move($path, $imageName);
                        $input[\''.$table_field.'\'] = $path.$imageName;
                        File::delete($old_'.$table_field.');
                    }
                    else{
                    $input[\''.$table_field.'\'] =$old_'.$table_field.';
                }
                ';
        }
    }

    $files_to_deleted_statements=' // delete files and images
        ';
    foreach ($table_fields as $table_field){
        if($input[$table_field.'_datatype'] == 'image' || $input[$table_field.'_datatype'] == 'file'){
            $files_to_deleted_statements=$files_to_deleted_statements.'
                $old_'.$table_field.'='.$module_name.'::find($'.$module_name.'_id)->'.$table_field.';
                 File::delete($old_'.$table_field.');
                ';
        }
    }


    //check if user auth required for each CRUD operations to enable or disable it
    $where_List='';
    if(isset($input['Mobile_require_auth_user_List'])){
        $user_id_code_List='$user_id=$request->user()->id;';
        $where_List.='where([\'user_id\' => $user_id ])->';
    }
    else{ $user_id_code_List=''; $where_List=''; }

    if(isset($input['Mobile_require_auth_user_Create'])){
        $user_id_code_Store='$user_id=$request->user()->id;
             $input[\'user_id\']=$user_id;
            ';
    }
    else{ $user_id_code_Store=''; }

    if(isset($input['Mobile_require_auth_user_View'])){
        $user_id_code_Show='$user_id=$request->user()->id;
            ';
        $where_Show='->where([\'user_id\' => $user_id ])';
    }
    else{ $user_id_code_Show=''; $where_Show=''; }

    if(isset($input['Mobile_require_auth_user_Update'])){
        $user_id_code_Update='$user_id=$request->user()->id;
             $input[\'user_id\']=$user_id;
            ';
        $where_Update='->where([\'user_id\' => $user_id ])';
    }
    else{ $user_id_code_Update=''; $where_Update=''; }

    if(isset($input['Mobile_require_auth_user_Delete'])){
        $user_id_code_Delete='$user_id=$request->user()->id;
            ';
        $where_Delete='->where([\'user_id\' => $user_id ])';
    }
    else{ $user_id_code_Delete=''; $where_Delete=''; }


    /********************************************************************************/
    /******create Where list for all fields to perform search functions on query ***/
    /*************************************/
    $searchWhereList='
        where(function($q) use ($searchText){
            $q';
    foreach($table_fields as $table_field){
        if($table_field != "id" && $table_field != "sort" && $table_field != "active"
            && $table_field != "created_at"  && $table_field != "updated_at"){
            $searchWhereList.=
                '->orWhere("'.$table_field.'","like","%".$searchText."%")';
            $Where_SecondLine='true';
        }
    }

    $searchWhereList.=';})->';


    /***************************/
    /*******Check Multiple Files ******/
    /***************************/

    $Multiple_images_store_statements='';//store images if found
    $Multiple_files_store_statements='';//store files if found
    $use_module_statments='';
    $show_images_statments='';
    $show_files_statments='';
    $multiple_file_var='';
    $delete_one_image_function='';
    $delete_one_file_function='';
    if($input['table_has_multiple_images']=='1'){
        $Multiple_images_store_statements='
                if ($request->hasFile(\'images\')) {
                    $images = $request->file(\'images\');
                    foreach($images as $image){
                        $image_ex = $image->getClientOriginalName();
                        $imageName = date(\'YmdHis\')."_".$image_ex;
                        $path = \'storage/images/'.$section_flag.'/images/\';
                        $image->move($path, $imageName);
                        $Multi_input[\''.$module_name.'_id\'] = $'.$module_name.'->id;
                        $Multi_input[\'image\'] = $path.$imageName;
                        '.$Capital_table_name.'_image::create($Multi_input);
                    }
                }
                ';

        $show_images_statments='$'.$module_name.'->images='.$Capital_table_name.'_image::where(\''.$module_name.'_id\',$id)->get();';
        $multiple_file_var=$multiple_file_var.',"images"';
        $use_module_statments=$use_module_statments."use App\\Models\\".$Capital_table_name."_image;";

        //create Router for delete image or file
        $route_inserted=\App\Models\Route::
        where(['request_method_type'=>'post',
            'router_name'=>'delete'.$module_name.'images',
            'type' => 'web_routes'
        ])->first();

        $Routeinput=[];
        $Routeinput['request_method_type']='post';
        $Routeinput['router_name']='delete'.$module_name.'images';
        $Routeinput['controller_name']=$module_name.'Controller';
        $Routeinput['controller_method']='delete'.$module_name.'images';
        $Routeinput['parameters']='id';
        $Routeinput['type']='web_routes';
        $Routeinput['middleware']='user';
        $Routeinput['expect_from_CSRF']='1';
        $Routeinput['active']='1';

        if(!isset($route_inserted)){
            $router=\App\Models\Route::create($Routeinput);
        }
        else{
            $route_inserted->update($Routeinput);
        }
        //function of delete one image from multiple images
        $delete_one_image_function=$delete_one_image_function.'
            public function delete'.$module_name.'images(Request $request){
            $id=$request->key;
            $image='.$Capital_table_name.'_image::where("id",$id)->first();
             $sub_old_image=$image->image;
                 File::delete($sub_old_image);
            '.$Capital_table_name.'_image::where("id",$id)->delete();
            return true;
            }
            ';
    }
    if($input['table_has_multiple_files']=='1'){
        $Multiple_files_store_statements='
                if ($request->hasFile(\'files\')) {
                    $files = $request->file(\'files\');
                    foreach($files as $file){
                    $file_ex = $file->getClientOriginalName();
                        $file_Name = date(\'YmdHis\')."_".$file_ex;
                        $path = \'storage/images/'.$section_flag.'/files/\';
                        $file->move($path, $file_Name);
                        $Multi_input[\''.$module_name.'_id\'] = $'.$module_name.'->id;
                        $Multi_input[\'file\'] = $path.$file_Name;
                        '.$Capital_table_name.'_file::create($Multi_input);
                    }
                }
                ';
        $show_files_statments='$'.$module_name.'->files='.$Capital_table_name.'_file::where(\''.$module_name.'_id\',$id)->get();';
        $multiple_file_var=$multiple_file_var.',"files"';
        $use_module_statments=$use_module_statments."use App\\Models\\".$Capital_table_name."_file;";


        //check if this route not inserted before
        $route_inserted=\App\Models\Route::
        where(['request_method_type'=>'post',
            'router_name'=>'delete'.$module_name.'files',
            'type' => 'api_routes'
        ])->first();

        $Routeinput=[];
        $Routeinput['request_method_type']='post';
        $Routeinput['router_name']='delete'.$module_name.'files';
        $Routeinput['controller_name']=$module_name.'Controller';
        $Routeinput['controller_method']='delete'.$module_name.'files';
        $Routeinput['parameters']='id';
        $Routeinput['type']='api_routes';
        $Routeinput['middleware']='admin';
        $Routeinput['expect_from_CSRF']='1';
        $Routeinput['active']='1';

        if(!isset($route_inserted)){
            $router=\App\Models\Route::create($Routeinput);
        }
        else{
            $route_inserted->update($Routeinput);
        }
        //function of delete one file from multiple files
        $delete_one_file_function=$delete_one_file_function.'
            public function delete'.$module_name.'files(Request $request){
            $id=$request->key;
            $file='.$Capital_table_name.'_file::where("id",$id)->first();
             $sub_old_file=$file->file;
                 File::delete($sub_old_file);
            '.$Capital_table_name.'_file::where("id",$id)->delete();
            return true;
            }
            ';

    }
    $multiple_files_to_deleted_statements=' // delete files and images in sub tables if this module has mutiple files or images
        ';
    if($input['table_has_multiple_images']=='1'){
        $multiple_files_to_deleted_statements=$multiple_files_to_deleted_statements.'
            $images='.$Capital_table_name.'_image::where("'.$module_name.'_id",$'.$module_name.'_id)->get();
            foreach($images as $image){
             $sub_old_image=$image->image;
                 File::delete($sub_old_image);
            }
            '.$Capital_table_name.'_image::where("'.$module_name.'_id",$'.$module_name.'_id)->delete();
            ';
    }
    if($input['table_has_multiple_files']=='1'){
        $multiple_files_to_deleted_statements=$multiple_files_to_deleted_statements.'
            $files='.$Capital_table_name.'_file::where("'.$module_name.'_id",$'.$module_name.'_id)->get();
            foreach($files as $file){
             $sub_old_file=$file->file;
                 File::delete($sub_old_file);
            }
            '.$Capital_table_name.'_file::where("'.$module_name.'_id",$'.$module_name.'_id)->delete();
            ';
    }

    $section_flag = $input["section_flag"];



    $API_controller_content='<?php
namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
'.$module_controller_name.'
'.$use_module_statments.'
use Validator;
use File;

class '.$controller_name.' extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        '.$user_id_code_List.'
        $searchText=$request->searchText;
        $'.$table_name.' = '.$module_name.'::'.$where_List.' '.$searchWhereList.'paginate(20);
        return $this->sendResponse(trans("'.$section_flag.'.'.$module_name.'_read"),$'.$table_name.'->toArray());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
       '.$user_id_code_Store.'

        $validator='.$controller_validations.'

        if($validator->fails()){
            return $this->sendError($validator->errors()->first());
        }

        '.$files_store_statements.'

        $'.$module_name.' = '.$module_name.'::create($input);

        '.$Multiple_images_store_statements.'
        '.$Multiple_files_store_statements.'

        return $this->sendResponse(trans("'.$section_flag.'.'.$module_name.'_create"),$'.$module_name.'->toArray());
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {

         '.$user_id_code_Show.'
        $'.$module_name.' = '.$module_name.'::where(\'id\', $id)'.$where_Show.'->first();

        if(isset($'.$module_name.')){
        '.$show_images_statments.'
        '.$show_files_statments.'
        }

        if (is_null($'.$module_name.')) {
            return $this->sendError(\''.$module_name.' not found.\');
        }

        return $this->sendResponse(trans("'.$section_flag.'.'.$module_name.'_read"),$'.$module_name.'->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$'.$module_name.'_id)
    {
        $input = $request->except(\'images\',\'files\',\'_method\');
        '.$user_id_code_Update.'

         $validator='.$controller_update_validations.'
        if($validator->fails()){
            return $this->sendError($validator->errors()->first());
        }

        '.$files_update_store_statements.'

        $'.$module_name.'='.$module_name.'::where([\'id\'=>$'.$module_name.'_id ])'.$where_Update.'->update($input);

        '.$Multiple_images_store_statements.'
        '.$Multiple_files_store_statements.'

        $'.$module_name.' = '.$module_name.'::where([\'id\'=>$'.$module_name.'_id , \'user_id\' => $user_id ])->get();
        return $this->sendResponse(trans("'.$section_flag.'.'.$module_name.'_update"),$'.$module_name.'->toArray());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$'.$module_name.'_id)
    {
        //delete files
        '.$files_to_deleted_statements.'
        '.$user_id_code_Delete.'
        '.$multiple_files_to_deleted_statements.'
        '.$module_name.'::where([\'id\'=>$'.$module_name.'_id ])'.$where_Delete.'->delete();



        return $this->sendResponse(trans("'.$section_flag.'.'.$module_name.'_delete"));

    }

     //additional Functions
            '.$delete_one_image_function.'
            '.$delete_one_file_function.'

}
';

    //Step 2 :: make Controller for Table
    $file = $controller_name.'.php';
    $destinationPath="app/Http/Controllers/Frontend/";
    if (!is_dir($destinationPath)) {  mkdir($destinationPath,0777,true);  }
    File::put($destinationPath.$file,$API_controller_content);

    /******************************/
    /******End Controller Content******/
    /******************************/

}

}
