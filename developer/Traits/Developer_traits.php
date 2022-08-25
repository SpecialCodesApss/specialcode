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


trait Developer_traits{

    public function CreateModuleFile($module_name,$module_fields,$module_protected_fields){
        /******************************/
        /******Start Module Content******/
        /******************************/
        //module File Content

        $module_content='<?php
                namespace App\Models;
                use Illuminate\Database\Eloquent\Model;

                class '.$module_name.' extends Model
                {
                    /**
                     * The attributes that are mass assignable.
                     *
                     * @var array
                     */
                    protected $fillable = '.$module_fields.';


                    /**
                     * The attributes that should be hidden for arrays.
                     *
                     * @var array
                     */
                    protected $hidden = '.$module_protected_fields.';

                }';

        //Step 1 :: make Module for Table
        $file = $module_name.'.php';
        $destinationPath="app/Models/";
        if (!is_dir($destinationPath)) {  mkdir($destinationPath,0777,true);  }
        File::put($destinationPath.$file,$module_content);
        /******************************/
        /******End Module Content******/
        /******************************/
    }


    /*
     * ****************************
     * Create API Cotroller File Method
     * **************************************
     */
    public function CreateAPIControllerFile($module_name,$table_name,$table_fields,$section_flag,$input,$Capital_table_name){

        /******************************/
        /******Start Controller Content******/
        /******************************/

        $controller_name=$module_name.'Controller';
        $module_controller_name="use App\\Models\\".$module_name.";";

        $input_variable='';


        //store validator
        $validations ='';
        foreach ($table_fields as $table_field){
            if(isset($input[$table_field.'_mobileAPIRequiredStore'])){
                $new_line='\''.$table_field.'\'=>\'required\',
                ';
                $validations=$validations.$new_line;
            }

            //input variable define
            if($table_field != "id" && $table_field != "user_id" && $table_field != "created_at" &&
                $table_field != "updated_at" && $input[$table_field.'_datatype'] != 'file'
                && $input[$table_field.'_datatype'] != 'image'){
                $new_input_variable = '
                $input["'.$table_field.'"]=$request->'.$table_field.';';
                $input_variable.=$new_input_variable;
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
                $old_'.$table_field.'='.$module_name.'::find($id)->'.$table_field.';
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
                'type' => 'api_routes'
            ])->first();

            $Routeinput=[];
            $Routeinput['request_method_type']='post';
            $Routeinput['router_name']='delete'.$module_name.'images';
            $Routeinput['controller_name']=$module_name.'Controller';
            $Routeinput['controller_method']='delete'.$module_name.'images';
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


        //check notification
        $notification_export_commands='';
        $notification_use_commands='';
        $notification_commands='';
        if($input['is_notification_able']=='1'){
            $notification_export_commands='use App\Http\Traits\admin_notification_traits;';
            $notification_use_commands='use admin_notification_traits;';
            $notification_commands='
         //create admin notification
        $notification_input=[];
        $notification_input["notification_id"]='.$input["notification_text_id"].';
        $notification_input["module_id"]=$'.$module_name.'->id;
        $this->createNotification($notification_input);
        ';
        }



        $API_controller_content='<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
'.$module_controller_name.'
'.$use_module_statments.'
use Validator;
use File;
'.$notification_export_commands.'

class '.$controller_name.' extends BaseController
{

    '.$notification_use_commands.'
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

        '.$input_variable.'


       '.$user_id_code_Store.'

        $validator='.$controller_validations.'

        if($validator->fails()){
            return $this->sendError($validator->errors()->first());
        }

        '.$files_store_statements.'


        $sort_number = '.$module_name.'::all()->count()+1;
        $input[\'sort\'] = $sort_number;

        $'.$module_name.' = '.$module_name.'::create($input);

        '.$notification_commands.'

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
            return $this->sendError(trans("messages.data not found"));
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
       '.$input_variable.'

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
    public function destroy(Request $request,$id)
    {
        //delete files
        '.$files_to_deleted_statements.'
        '.$user_id_code_Delete.'
        '.$multiple_files_to_deleted_statements.'
        '.$module_name.'::where([\'id\'=>$id ])'.$where_Delete.'->delete();



        return $this->sendResponse(trans("'.$section_flag.'.'.$module_name.'_delete"));

    }

     //additional Functions
            '.$delete_one_image_function.'
            '.$delete_one_file_function.'

}
';

        //Step 2 :: make Controller for Table
        $file = $controller_name.'.php';
        $destinationPath="app/Http/Controllers/API/";
        if (!is_dir($destinationPath)) {  mkdir($destinationPath,0777,true);  }
        File::put($destinationPath.$file,$API_controller_content);

        /******************************/
        /******End Controller Content******/
        /******************************/

    }

    public function CreateControllerFile($module_name,$table_name,$table_fields,$section_flag,$input,$Capital_table_name){

        /******************************/
        /******Start Controller Content******/
        /******************************/

        $controller_name=$module_name.'Controller';
        $module_controller_name="use App\\Models\\".$module_name.";";

        //store validator
        $validations ='';
        $input_operations=''; // this variable to handel compined date and time to only one datetime variable and store it

        $index_header_code='';
        $index_table_code='';
        $index_inside_loop_code='';
        $AutoCode_for_showing_checkbox_names='';
        $AutoCode_for_showing_selectbox_names='';
        $AutoCode_for_showing_checkbox_value='';
        $AutoCode_for_showing_EditColumn_for_checkbox='';
        $AutoCode_for_showing_activeType_value='';

        $file_type_commands='';
        $file_type_vars='';

        $input_variable='';

        foreach ($table_fields as $table_field){

            $new_line ='';

            if(isset($input[$table_field.'_is_Unique'])){
                if( isset($input[$table_field.'_adminRequiredStore'])) {
                    $new_line = '\'' . $table_field . '\'=>\'required|unique:' . $table_name . '\',
                    ';
                }

            }
            elseif($input[$table_field.'_datatype'] == 'datetime') {
                if (isset($input[$table_field . '_adminRequiredStore'])) {
                    $new_line = '\'' . $table_field . '_date\'=>\'required\',
                    ' . '\'' . $table_field . '_time\'=>\'required\',
                    ';
                }

                if ($table_field != "created_at" && $table_field != "updated_at") {
                    $input_operations .= '$input[\'' . $table_field . '\']=$input[\'' . $table_field . '_date\'].\' \'.$input[\'' . $table_field . '_time\'];';
                }
            }
            elseif($input[$table_field.'_datatype'] == 'table_to_checkbox'){
                if( isset($input[$table_field.'_adminRequiredUpdate'])) {
                    $new_line = '\'' . $table_field . '\'=>\'required\',
                    ';
                }
                $input_operations.='$input[\''.$table_field.'\']=json_encode($input[\''.$table_field.'\']);
                    ';

                //get table data code
                $joined_table_name = $input[$table_field.'_joinedTable'];
                $table_module_name=ucfirst($joined_table_name);
                $table_module_name=rtrim($table_module_name, "s");
                $index_header_code.= 'use App\Models\\'.$table_module_name.';';

                $joined_table_field_name=$input[$table_field.'_joinedTable_field'];


                $AutoCode_for_showing_checkbox_names.='
                     ->editColumn(\''.$table_field.'\', function('.$module_name.' $data) {
                            $'.$table_field.'_data =\'\';
                            $data_'.$table_field.' =json_decode($data->'.$table_field.');
                            foreach ($data_'.$table_field.' as $info){
                                if($info != null){
                                $'.$table_module_name.' = '.$table_module_name.'::find($info);
                                $'.$table_field.'_data.= $'.$table_module_name.'->'.$joined_table_field_name.' .\' - \';
                                }
                            }
                                return $'.$table_field.'_data;
                        })
                    ';
            }
            elseif($input[$table_field.'_datatype'] == 'table_to_select'){
                if( isset($input[$table_field.'_adminRequiredStore'])) {
                    $new_line = '\'' . $table_field . '\'=>\'required\',
                    ';
                }
                //get table data code
                $joined_table_name = $input[$table_field.'_joinedTable'];
                $joined_table_field_name=$input[$table_field.'_joinedTable_field'];
                $table_module_name=ucfirst($joined_table_name);
                $table_module_name=rtrim($table_module_name, "s");
                $index_header_code.= 'use App\Models\\'.$table_module_name.';';

                $AutoCode_for_showing_selectbox_names.='
                     ->editColumn(\''.$table_field.'\', function('.$module_name.' $data) {
                            $'.$table_field.'_data =\'\';
                            $info =$data->'.$table_field.';
                            if($info != null){
                                $'.$table_module_name.' = '.$table_module_name.'::find($info);
                                $'.$table_field.'_data.= $'.$table_module_name.'->'.$joined_table_field_name.' ;
                                }
                                return $'.$table_field.'_data;
                        })
                    ';
            }
            elseif($input[$table_field.'_datatype'] == 'table_to_tagInput' || $input[$table_field.'_datatype'] == 'table_to_table'){
                if( isset($input[$table_field.'_adminRequiredStore'])) {
                    $new_line = '\'' . $table_field . '\'=>\'required\',
                    ';
                }
                //get table data code
                $joined_table_name = $input[$table_field.'_joinedTable'];
                $joined_table_field_name=$input[$table_field.'_joinedTable_field'];
                $table_module_name=ucfirst($joined_table_name);
                $table_module_name=rtrim($table_module_name, "s");
                $index_header_code.= 'use App\Models\\'.$table_module_name.';';
            }
            elseif($input[$table_field.'_datatype'] == 'time'){
                if( isset($input[$table_field.'_adminRequiredStore'])) {
                    $new_line = '\'' . $table_field . '\'=>\'required\',
                    ';
                }
                //get table data code
                $index_inside_loop_code.= '
                              $info->'.$table_field.'=date("h:i a",strtotime($info->'.$table_field.'));
                              $info->'.$table_field.'=str_replace("am","صباحا",$info->'.$table_field.');
                              $info->'.$table_field.'=str_replace("pm","مساءاً",$info->'.$table_field.');
                              ';
            }
            elseif($input[$table_field.'_datatype'] == 'enum_selector'){
                if( isset($input[$table_field.'_adminRequiredStore'])) {
                    $new_line = '\'' . $table_field . '\'=>\'required\',
                    ';
                }

                $selector_array= $input[$table_field.'_selector_items'];
                $selector_array=explode(',', $selector_array);


                $if_else_options='';
                foreach ($selector_array as $selector_en){
                    //translate select //for google translate object
                    $trans = new GoogleTranslate(); $source = 'en'; $target = 'ar';
                    $selector_ar = $trans->translate($source, $target, $selector_en);
                    $if_else_options.='
                            if($data->'.$table_field.'=="'.$selector_en.'"){
                            return trans(\''.$section_flag.'.'.$selector_en.'\');
                            }';
                }


                $AutoCode_for_showing_checkbox_names.='
                     ->editColumn(\''.$table_field.'\', function('.$module_name.' $data) {
                                '.$if_else_options.'
                        })
                    ';
            }

            elseif($input[$table_field.'_datatype'] == 'file' || $input[$table_field.'_datatype'] == 'image'){
                if( isset($input[$table_field.'_adminRequiredStore'])) {
                    $new_line = '\'' . $table_field . '\'=>\'required\',
                    ';
                }
                //get table data code
                $index_inside_loop_code.= '
                              $info->'.$table_field.'=url($info->'.$table_field.');
                              ';
            }

            elseif($input[$table_field.'_datatype'] == 'is_checkbox'){
//                    if( isset($input[$table_field.'_adminRequiredStore'])) {
//                        $new_line = '\'' . $table_field . '\'=>\'required\',
//                    ';
//                    }

                $AutoCode_for_showing_checkbox_value.='
                        if(isset($input[\''.$table_field.'\'])){
                        $input[\''.$table_field.'\']= 1;
                        }else{
                        $input[\''.$table_field.'\']= 0;
                        }
                    ';

                $AutoCode_for_showing_EditColumn_for_checkbox.='
                     ->editColumn(\''.$table_field.'\', function('.$module_name.' $data) {
                            if($data->'.$table_field.' != null){
                              return trans("admin.yes");
                            }
                            else{
                                return trans("admin.no");;
                            }
                        })
                    ';
            }
            elseif($input[$table_field.'_datatype'] == 'is_switch'){


                $AutoCode_for_showing_checkbox_value.='
                        if(isset($input[\''.$table_field.'\'])){
                        $input[\''.$table_field.'\']= 1;
                        }else{
                        $input[\''.$table_field.'\']= 0;
                        }
                    ';

                $AutoCode_for_showing_EditColumn_for_checkbox.='
                     ->editColumn(\''.$table_field.'\', function('.$module_name.' $data) {
                            if($data->'.$table_field.' != null){
                              return trans("admin.yes");
                            }
                            else{
                                return trans("admin.no");
                            }
                        })
                    ';
            }
            elseif($input[$table_field.'_datatype'] == 'active'){

                if( isset($input[$table_field.'_adminRequiredStore'])) {
                    $new_line = '\'' . $table_field . '\'=>\'required\',
                    ';
                }

                $AutoCode_for_showing_activeType_value.='
                     ->editColumn(\''.$table_field.'\', function('.$module_name.' $data) {
                            if($data->'.$table_field.' == "1"){
                              return trans("admin.active");
                            }
                            else{
                                return trans("admin.inactive");
                            }
                        })
                    ';
            }

            else{

                if( isset($input[$table_field.'_adminRequiredStore'])) {
                    $new_line = '\'' . $table_field . '\'=>\'required\',
                    ';
                }
            }

            $validations=$validations.$new_line;



            if($input[$table_field.'_datatype'] == 'file' || $input[$table_field.'_datatype'] == 'image'){
//                    $new_line='\''.$table_field.'\'=>\'required\',
//                    ';
                //get table data code
                $index_inside_loop_code.= '
                if(isset($info->image)){
                            $info->'.$table_field.'=url($info->'.$table_field.');
                        }
                              ';
            }


            //additionals autocreated function or commands
            if($input[$table_field.'_datatype'] == 'file'){
                $file_type_commands.='
            $'.$table_field.'_filetype = $this->getFileTypeByLink($'.$module_name.'->'.$table_field.');
            ';
                $file_type_vars=',\''.$table_field.'_filetype\'';
            }

            //input variable define
            if($table_field != "id" && $table_field != "created_at" &&
                $table_field != "updated_at" && $input[$table_field.'_datatype'] != 'file'
                && $input[$table_field.'_datatype'] != 'image'){
                $new_input_variable = '
                $input["'.$table_field.'"]=$request->'.$table_field.';';
                $input_variable.=$new_input_variable;
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
            $this->validate($request, [
            '.$validations.'
        ]);
        ';
        //update validators
        $validations ='';
        $input_operations='';
        $update_query_information =''; // used to make jsondecode when get array from db
        $view_query_information =''; // used to make jsondecode when get array from db
        foreach ($table_fields as $table_field){

            $new_line = '';
            if( $input[$table_field.'_datatype'] != 'image' && $input[$table_field.'_datatype'] != 'file' ){
                if(isset($input[$table_field.'_is_Unique']) && isset($input[$table_field.'_adminRequiredUpdate']) ){
                    $new_line='\''.$table_field.'\'=>\'required|unique:'.$table_name.','.$table_field.',\'.$'.$module_name.'->id.\',id\',
                    ';
                }
                elseif($input[$table_field.'_datatype'] == 'datetime' ) {
                    if (isset($input[$table_field . '_adminRequiredUpdate'])) {
                        $new_line = '\'' . $table_field . '_date\'=>\'required\',' . '\'' . $table_field . '_time\'=>\'required\',
                    ';
                    }

                    if ($table_field != "created_at" && $table_field != "updated_at") {
                        $input_operations .= '$input[\'' . $table_field . '\']=$input[\'' . $table_field . '_date\'].\' \'.$input[\'' . $table_field . '_time\'];';

                    }
                }
                elseif($input[$table_field.'_datatype'] == 'table_to_checkbox'){
                    if( isset($input[$table_field.'_adminRequiredUpdate'])) {
                        $new_line = '\'' . $table_field . '\'=>\'required\',
                    ';
                    }
                    $input_operations.='$input[\''.$table_field.'\']=json_encode($input[\''.$table_field.'\']);
                    ';
                    $update_query_information.='$'.$module_name.'->'.$table_field.'=json_decode($'.$module_name.'->'.$table_field.');';
                }
                elseif($input[$table_field.'_datatype'] == 'table_to_tagInput' ){
                    if( isset($input[$table_field.'_adminRequiredUpdate'])) {
                        $new_line = '\'' . $table_field . '\'=>\'required\',
                    ';
                    }
                    $input_operations.='$'.$table_field.'=$input["'.$table_field.'"];
                $'.$table_field.' = str_replace(",","\",\"",$'.$table_field.');
                $'.$table_field.' = "[\"".$'.$table_field.'."\"]";
                $input["'.$table_field.'"]=$'.$table_field.';';

                    $update_query_information.='$'.$table_field.' = $'.$module_name.'->'.$table_field.';
                $'.$table_field.' = str_replace("[",\'\',$'.$table_field.');
                $'.$table_field.' = str_replace("]",\'\',$'.$table_field.');
                $'.$table_field.' = str_replace("\"",\'\',$'.$table_field.');
                $'.$module_name.'->'.$table_field.' = $'.$table_field.';';

                }
                elseif ($input[$table_field.'_datatype'] == 'table_to_table'){
                    if( isset($input[$table_field.'_adminRequiredUpdate'])) {
                        $new_line = '\'' . $table_field . '\'=>\'required\',
                    ';
                    }
                    $input_operations.='$'.$table_field.'=$input["'.$table_field.'"];
                $'.$table_field.' = str_replace(",","\",\"",$'.$table_field.');
                $'.$table_field.' = "[\"".$'.$table_field.'."\"]";
                $input["'.$table_field.'"]=$'.$table_field.';';

                    $update_query_information.='$'.$table_field.' = $'.$module_name.'->'.$table_field.';
                $'.$table_field.' = str_replace("[",\'\',$'.$table_field.');
                $'.$table_field.' = str_replace("]",\'\',$'.$table_field.');
                $'.$table_field.' = str_replace("\"",\'\',$'.$table_field.');
                $'.$module_name.'->'.$table_field.' = $'.$table_field.';';
                }

                else{
                    if( isset($input[$table_field.'_adminRequiredUpdate'])) {
                        $new_line = '\'' . $table_field . '\'=>\'required\',
                    ';
                    }
                }

                $validations=$validations.$new_line;
            }
        }
        $controller_update_validations='
            $this->validate($request, [
            '.$validations.'
        ]);
        ';

        //get permissions according to inputs
        $premissions='
        $this->middleware(\'permission:'.$module_name.'_Create\', [\'only\' => [\'create\',\'store\']]);
        $this->middleware(\'permission:'.$module_name.'_Read\', [\'only\' => [\'index\',\'show\']]);
        $this->middleware(\'permission:'.$module_name.'_Update\', [\'only\' => [\'update\',\'edit\']]);
        $this->middleware(\'permission:'.$module_name.'_Delete\', [\'only\' => [\'delete\',\'destroy\']]);
        ';


        //get actions buttons according to admin premissions
        $actionBtns='<div style="display:inline-block; width: 210px;">';
        if(isset($input['Admin_View'])){
            $actionBtns=$actionBtns.'
            <a class="icon-btn" href="'.$table_name.'/\'.$row_id.\'"><i class="fa fa-eye text-view"></i></a>';
        }
        if(isset($input['Admin_Update'])){
            $actionBtns=$actionBtns.'
            <a class="icon-btn" href="'.$table_name.'/\'.$row_id.\'/edit"><i class="fa fa-pencil text-edit"></i></a>';
        }
        if(isset($input['Admin_Delete'])){
            $actionBtns=$actionBtns.'
            <form id="\'.$form_id.\'" method="POST" action="'.$table_name.'/\'.$row_id.\'" style="display:inline">
                                        <input name="_method" type="hidden" value="DELETE">
                                        <input name="_token" type="hidden" value="\'.csrf_token().\'">
                                        <button type="button" onclick="return deleteItem(\'."\'$form_id\'".\')"
                                        class="btn icon-btn"><i class="fa fa-trash text-delete"></i></button>
                                    </form>';
        }
        $actionBtns=$actionBtns.'</div>';

        //*******check images or logo in fields to add its requirements ******//
        /***************************/
        $files_store_statements='';
        foreach ($table_fields as $table_field){
            if($input[$table_field.'_datatype'] == 'image' || $input[$table_field.'_datatype'] == 'file'){
                $files_store_statements=$files_store_statements.'
                if ($request->hasFile(\''.$table_field.'\')) {
                    $document = $request->file(\''.$table_field.'\');
                    $ext = $document->getClientOriginalExtension();
                    if ($request->file(\''.$table_field.'\') && $request->file(\''.$table_field.'\')->isValid()) {
                        $imageName = date(\'YmdHis\') . ".$ext";
                        $path = \'storage/images/'.$section_flag.'/'.$table_field.'/\';
                        $request->file(\''.$table_field.'\')->move($path, $imageName);
                        $input[\''.$table_field.'\'] = $path.$imageName;
                    }
                }
                ';
            }
        }

        $files_update_store_statements='';
        foreach ($table_fields as $table_field){
            if($input[$table_field.'_datatype'] == 'image' || $input[$table_field.'_datatype'] == 'file'){
                $files_update_store_statements=$files_update_store_statements.'
                $old_'.$table_field.'='.$module_name.'::find($id)->'.$table_field.';
                if ($request->hasFile(\''.$table_field.'\')) {
                    $document = $request->file(\''.$table_field.'\');
                    $ext = $document->getClientOriginalExtension();
                    if ($request->file(\''.$table_field.'\') && $request->file(\''.$table_field.'\')->isValid()) {
                        $imageName = date(\'YmdHis\') . ".$ext";
                        $path = \'storage/images/'.$section_flag.'/'.$table_field.'/\';
                        $request->file(\''.$table_field.'\')->move($path, $imageName);
                        $input[\''.$table_field.'\'] = $path.$imageName;
                        File::delete($old_'.$table_field.');
                    }
                    else{
                    $input[\''.$table_field.'\'] =$old_'.$table_field.';
                    }
                }
                ';
            }
        }

        $files_to_deleted_statements=' // delete files and images
        ';
        $join_selected_resultsCode='';
        $join_selected_compact_vars='';
        $comma=',';
        $order_status_replacement_code ='';
        foreach ($table_fields as $table_field){
            if($input[$table_field.'_datatype'] == 'image' || $input[$table_field.'_datatype'] == 'file'){
                $files_to_deleted_statements=$files_to_deleted_statements.'
                $old_'.$table_field.'='.$module_name.'::find($id)->'.$table_field.';
                 File::delete($old_'.$table_field.');
                ';
            }
            elseif($input[$table_field.'_datatype']=='join_select'){
                $joined_table=$input[$table_field.'_joinedTable'];
                $new_resultLine='
                $'.$table_field.'s=DB::table("'.$joined_table.'")->orderBy(\'id\', \'asc\')->get(\'id\');
                $'.$joined_table.'=[];
                $'.$joined_table.'[]="";
                foreach ($'.$table_field.'s as $info){
                    $'.$joined_table.'[$info->id]=$info->id;
                }
                ';

                $join_selected_resultsCode.=$new_resultLine;
                $join_selected_compact_vars.=$comma."'".$joined_table."'";
            }
            elseif($input[$table_field.'_datatype']=='table_to_select'){
                $joined_table=$input[$table_field.'_joinedTable'];
                $joined_table_field_name=$input[$table_field.'_joinedTable_field'];

                $joined_table_field_name = $joined_table_field_name;
                if(str_contains($joined_table_field_name,'_ar') || str_contains($joined_table_field_name,'_en')){
                    $joined_table_field_name = str_replace('_ar','',$joined_table_field_name);
                    $joined_table_field_name = str_replace('_en','',$joined_table_field_name);
                    $joined_table_field_name='{\''.$joined_table_field_name.'_\'.$lang} ';
                }

                $new_resultLine='
                $'.$table_field.'s=DB::table("'.$joined_table.'")->orderBy(\'id\', \'asc\')->get();
                $'.$joined_table.'=[];
                $'.$joined_table.'[]="";
                foreach ($'.$table_field.'s as $info){
                    $'.$joined_table.'[$info->id]=$info->'.$joined_table_field_name.';
                }
                ';
                $join_selected_resultsCode.=$new_resultLine;
                $join_selected_compact_vars.=$comma."'".$joined_table."'";
            }
            elseif($input[$table_field.'_datatype']=='table_to_checkbox'){
                $joined_table=$input[$table_field.'_joinedTable'];
                $new_resultLine='
                $'.$joined_table.'=DB::table("'.$joined_table.'")->orderBy(\'id\', \'asc\')->get();
                ';
                $join_selected_resultsCode.=$new_resultLine;
                $join_selected_compact_vars.=$comma."'".$joined_table."'";
            }

            //check if there are order_status
            elseif($input[$table_field.'_datatype']=='order_status'){
                $order_status_replacement_code ='
            if($info->order_status == \'pending\'){
                            $info->order_status=trans("messages.pending");
                        }
                        if($info->order_status == \'processing\'){
                            $info->order_status=trans("messages.processing");
                        }
                        if($info->order_status == \'completed\'){
                            $info->order_status=trans("messages.completed");
                        }
                        if($info->order_status == \'cant_process\'){
                            $info->order_status=trans("messages.cant_process");
                        }
            ';
            }

            $comma=',';

        }


        /***************************/
        /*******Check Multiple Files ******/
        /***************************/

        $Multiple_images_store_statements='//store images if found';
        $Multiple_files_store_statements='//store files if found';
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

            $show_images_statments='$images='.$Capital_table_name.'_image::where(\''.$module_name.'_id\',$id)->get();';
            $multiple_file_var=$multiple_file_var.',"images"';
            $use_module_statments=$use_module_statments."use App\\Models\\".$Capital_table_name."_image;";

            //create Router for delete image or file
            //check if this route not inserted before
            $route_inserted=\App\Models\Route::
            where(['request_method_type'=>'post',
                'router_name'=>'delete'.$module_name.'images',
                'type' => 'web_routes',
                'middleware' => 'admin',
            ])->first();

            $Routeinput=[];
            $Routeinput['request_method_type']='post';
            $Routeinput['router_name']='delete'.$module_name.'images';
            $Routeinput['controller_name']=$module_name.'Controller';
            $Routeinput['controller_method']='delete'.$module_name.'images';
            $Routeinput['parameters']='id';
            $Routeinput['type']='web_routes';
            $Routeinput['middleware']='admin';
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
            $show_files_statments='$files='.$Capital_table_name.'_file::where(\''.$module_name.'_id\',$id)->get();';
            $multiple_file_var=$multiple_file_var.',"files"';
            $use_module_statments=$use_module_statments."use App\\Models\\".$Capital_table_name."_file;";


            //check if this route not inserted before
            $route_inserted=\App\Models\Route::
            where(['request_method_type'=>'post',
                'router_name'=>'delete'.$module_name.'files',
                'type' => 'web_routes',
                'middleware' => 'admin',
            ])->first();

            $Routeinput=[];
            $Routeinput['request_method_type']='post';
            $Routeinput['router_name']='delete'.$module_name.'files';
            $Routeinput['controller_name']=$module_name.'Controller';
            $Routeinput['controller_method']='delete'.$module_name.'files';
            $Routeinput['parameters']='id';
            $Routeinput['type']='web_routes';
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
            $images='.$Capital_table_name.'_image::where("'.$module_name.'_id",$id)->get();
            foreach($images as $image){
             $sub_old_image=$image->image;
                 File::delete($sub_old_image);
            }
            '.$Capital_table_name.'_image::where("'.$module_name.'_id",$id)->delete();
            ';
        }
        if($input['table_has_multiple_files']=='1'){
            $multiple_files_to_deleted_statements=$multiple_files_to_deleted_statements.'
            $files='.$Capital_table_name.'_file::where("'.$module_name.'_id",$id)->get();
            foreach($files as $file){
             $sub_old_file=$file->file;
                 File::delete($sub_old_file);
            }
            '.$Capital_table_name.'_file::where("'.$module_name.'_id",$id)->delete();
            ';
        }


        //**** Create Custom Functions Needed for tables**********************//
        /*****************************************************************************/
        $custom_functions = '';
        $custom_module_controller_name ='';

        foreach ($table_fields as $table_field){

            if($input[''.$table_field.'_datatype']=="table_to_table"){

                $custom_field_table_name = $input[''.$table_field.'_joinedTable'];
                $custom_field_name = $input[''.$table_field.'_joinedTable_field'];
                $custom_table_module_name=ucfirst($custom_field_table_name);
                $custom_table_module_name=rtrim($custom_table_module_name, "s");


                //add code to include module name for new function
//                $custom_module_controller_name.="use App\\".$custom_table_module_name.";";


                //make function to get all data for this table
                $custom_functions.='public function get'.$custom_field_table_name.'Info_for_'.$table_name.'_forField'.$table_field.'(Request $request){
        $'.$module_name.'_id = $request->'.$module_name.'_id;
        //get row info
        $'.$module_name.' = '.$module_name.'::find($'.$module_name.'_id);


        $'.$custom_field_table_name.'_info = $'.$module_name.'->'.$table_field.';

            $'.$custom_field_table_name.'_info = json_decode($'.$custom_field_table_name.'_info);

            $data = '.$custom_table_module_name.'::orderBy(\'id\', \'desc\')->whereIn(\''.$custom_field_name.'\', $'.$custom_field_table_name.'_info)->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn(\'action\', function ($row) {
                    $module_id = $row->id;
                    $btn = \'
                    <div style="display:inline-block; width: 210px;">
                    <a class="btn btn-info" href="'.$custom_field_table_name.'/\' . $module_id . \'">عرض</a>
                    </div>
                    \';
                    return $btn;
                })
                ->rawColumns([\'action\'])
                ->make(true);
    }
                ';

                //create custom Route to handle this info

                //check if this route not inserted before
                $route_inserted=\App\Models\Route::
                where(['request_method_type'=>'get',
                    'router_name'=>'get'.$custom_field_table_name.'Info_for_'.$table_name.'_forField'.$table_field.'',
                    'type' => 'web_routes',
                    'middleware' => 'admin',
                ])->first();

                $Routeinput=[];
                $Routeinput['request_method_type']='get';
                $Routeinput['router_name']='get'.$custom_field_table_name.'Info_for_'.$table_name.'_forField'.$table_field.'';
                $Routeinput['controller_name']=$module_name.'Controller';
                $Routeinput['controller_method']='get'.$custom_field_table_name.'Info_for_'.$table_name.'_forField'.$table_field.'';
                $Routeinput['parameters']='';
                $Routeinput['type']='web_routes';
                $Routeinput['middleware']='admin';
                $Routeinput['expect_from_CSRF']='1';
                $Routeinput['active']='1';

                if(!isset($route_inserted)){
                    $router=\App\Models\Route::create($Routeinput);
                }
                else{
                    $route_inserted->update($Routeinput);
                }
            }

            if($input[''.$table_field.'_datatype']=="table_to_tagInput" || $input[$table_field.'_datatype'] == 'table_to_table'){

                $custom_field_table_name = $input[''.$table_field.'_joinedTable'];
                $custom_field_name = $input[''.$table_field.'_joinedTable_field'];
                $custom_table_module_name=ucfirst($custom_field_table_name);
                $custom_table_module_name=rtrim($custom_table_module_name, "s");


                //make function to get all data for this table
                $custom_functions.='public function check'.$custom_field_table_name.'_for_'.$table_name.'_forField'.$table_field.'(Request $request){
        $'.$custom_field_table_name.'= $request["'.$custom_field_name.'"];
        $'.$custom_table_module_name.' = '.$custom_table_module_name.'::where("'.$custom_field_name.'",$'.$custom_field_table_name.')->first();
        if(isset($'.$custom_table_module_name.')){
            return "true";
        }
        else{
            return "false";
        }
    }
    public function search'.$custom_field_table_name.'_for_'.$table_name.'_forField'.$table_field.'(Request $request){
        $search_text = $request["search_text"];
        $response_array=[];
        $'.$custom_field_table_name.' = '.$custom_table_module_name.'::where("'.$custom_field_name.'",\'like\',\'%\'.$search_text.\'%\')->get(\''.$custom_field_name.'\');
        foreach ($'.$custom_field_table_name.' as $'.$custom_table_module_name.'){
            array_push($response_array,$'.$custom_table_module_name.'->'.$custom_field_name.');
        }
        return $response_array;
    }';

                //create custom Route to handle this info

                //check if this route not inserted before
                $route_inserted=\App\Models\Route::
                where(['request_method_type'=>'post',
                    'router_name'=>'check'.$custom_field_table_name.'_for_'.$table_name.'_forField'.$table_field.'',
                    'type' => 'web_routes',
                    'middleware' => 'admin',
                ])->first();
                $Routeinput=[];
                $Routeinput['request_method_type']='post';
                $Routeinput['router_name']='check'.$custom_field_table_name.'_for_'.$table_name.'_forField'.$table_field.'';
                $Routeinput['controller_name']=$module_name.'Controller';
                $Routeinput['controller_method']='check'.$custom_field_table_name.'_for_'.$table_name.'_forField'.$table_field.'';
                $Routeinput['parameters']='';
                $Routeinput['type']='web_routes';
                $Routeinput['middleware']='admin';
                $Routeinput['expect_from_CSRF']='1';
                $Routeinput['active']='1';
                if(!isset($route_inserted)){
                    $router=\App\Models\Route::create($Routeinput);
                }
                else{
                    $route_inserted->update($Routeinput);
                }

                //check if this route not inserted before
                $route_inserted=\App\Models\Route::
                where(['request_method_type'=>'post',
                    'router_name'=>'search'.$custom_field_table_name.'_for_'.$table_name.'_forField'.$table_field.'',
                    'type' => 'web_routes',
                    'middleware' => 'admin',
                ])->first();
                $Routeinput=[];
                $Routeinput['request_method_type']='post';
                $Routeinput['router_name']='search'.$custom_field_table_name.'_for_'.$table_name.'_forField'.$table_field.'';
                $Routeinput['controller_name']=$module_name.'Controller';
                $Routeinput['controller_method']='search'.$custom_field_table_name.'_for_'.$table_name.'_forField'.$table_field.'';
                $Routeinput['parameters']='';
                $Routeinput['type']='web_routes';
                $Routeinput['middleware']='admin';
                $Routeinput['expect_from_CSRF']='1';
                $Routeinput['active']='1';
                if(!isset($route_inserted)){
                    $router=\App\Models\Route::create($Routeinput);
                }
                else{
                    $route_inserted->update($Routeinput);
                }




            }
        }
        //**** End of Create Custom Functions Needed for tables**********************//
        /*****************************************************************************/








        $controller_content='<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
'.$module_controller_name.'
'.$custom_module_controller_name.'
use Spatie\Permission\Models\Role;
use DB;
use File;
use DataTables;
use Illuminate\Support\Facades\App;
use \App\Http\Traits\file_type_traits;
'.$use_module_statments.'
'.$index_header_code.'

class '.$controller_name.' extends Controller
{

    use file_type_traits;
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        '.$premissions.'
    }

            /**
             * Display a listing of the resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function index(Request $request)
            {

                if ($request->ajax()) {
                    $data = '.$module_name.'::query();


                    '.$index_table_code.'

                    '.$order_status_replacement_code.'



                    return Datatables::eloquent($data)

                        '.$AutoCode_for_showing_checkbox_names.'
                        '.$AutoCode_for_showing_selectbox_names.'
                        '.$AutoCode_for_showing_EditColumn_for_checkbox.'
                        '.$AutoCode_for_showing_activeType_value.'

                        ->addColumn(\'action\', function($row){
                            $row_id=$row->id;
                            $form_id="delete_'.$module_name.'_form_".$row_id;
                            $btn=\''.$actionBtns.'\';
                            return $btn;
                        })
                        ->rawColumns([\'action\'])

                        ->make(true);
                }
                return view(\'backend.'.$table_name.'.index\');

            }



            /**
             * Show the form for creating a new resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function create()
            {

                $lang = App::getLocale();
                $sort_number = '.$module_name
            .'::all()->count()+1;

            '.$join_selected_resultsCode.'
                return view(\'backend.'.$table_name.'.create\',compact(\'sort_number\''.$join_selected_compact_vars.'));
            }

            /**
             * Store a newly created resource in storage.
             *
             * @param  \Illuminate\Http\Request  $request
             * @return \Illuminate\Http\Response
             */
            public function store(Request $request)
            {

                $lang = App::getLocale();
                '.$controller_validations.'

                '.$input_variable.'

                '.$AutoCode_for_showing_checkbox_value.'

                '.$input_operations.'

                '.$files_store_statements.'


                $'.$module_name.' = '.$module_name.'::create($input);

                '.$Multiple_images_store_statements.'
                '.$Multiple_files_store_statements.'


                if($request->save_type=="save_and_add_new"){
                    return redirect()->route(\''.$table_name.'.create\')
                        ->with(\'success\',trans(\'admin.info_added\'));
                }
                else{
                    return redirect()->route(\''.$table_name.'.index\')
                        ->with(\'success\',trans(\'admin.info_added\'));
                }

            }


            /**
             * Display the specified resource.
             *
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function show($id)
            {
            $lang = App::getLocale();
                $'.$module_name.' = '.$module_name.'::find($id);
                '.$show_images_statments.'
                '.$show_files_statments.'

                '.$join_selected_resultsCode.'
                 '.$update_query_information.'


                return view(\'backend.'.$table_name.'.show\',compact(\''.$module_name.'\' '.$multiple_file_var.' '.$join_selected_compact_vars.' ));

            }


            /**
             * Show the form for editing the specified resource.
             *
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {

            $lang = App::getLocale();
                $'.$module_name.' = '.$module_name.'::find($id);
                '.$show_images_statments.'
                '.$show_files_statments.'

                '.$join_selected_resultsCode.'
                '.$update_query_information.'

                '.$file_type_commands.'


                return view(\'backend.'.$table_name.'.edit\',compact(\''.$module_name.'\'
                '.$multiple_file_var.''.$join_selected_compact_vars.''.$file_type_vars.' ));
            }


            /**
             * Update the specified resource in storage.
             *
             * @param  \Illuminate\Http\Request  $request
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function update(Request $request, $id)
            {

            $'.$module_name.' = '.$module_name.'::find($id);
                 '.$controller_update_validations.'

                '.$input_variable.'

                '.$AutoCode_for_showing_checkbox_value.'

                '.$input_operations.'

                '.$files_update_store_statements.'


                $'.$module_name.'->update($input);

                '.$Multiple_images_store_statements.'
                '.$Multiple_files_store_statements.'

                return redirect()->route(\''.$table_name.'.index\')
                    ->with(\'success\',trans(\'admin.info_edited\'));
            }

            /**
             * Remove the specified resource from storage.
             *
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function destroy($id)
            {
                '.$files_to_deleted_statements.'

                '.$multiple_files_to_deleted_statements.'

                '.$module_name.'::find($id)->delete();
                return redirect()->route(\''.$table_name.'.index\')
                    ->with(\'success\',trans(\'admin.info_deleted\'));
            }

            //additional Functions
            '.$delete_one_image_function.'
            '.$delete_one_file_function.'


            '.$custom_functions.'




        }';

        //Step 2 :: make Controller for Table
        $file = $controller_name.'.php';
        $destinationPath="app/Http/Controllers/admin/";
        if (!is_dir($destinationPath)) {  mkdir($destinationPath,0777,true);  }
        File::put($destinationPath.$file,$controller_content);

        /******************************/
        /******End Controller Content******/
        /******************************/
    }

    public function Insert_AdminSectionDB($controller_name,$section_flag,$input){
        /******************************/
        /******start add module to admin_menu Content******/
        /******************************/


        //first check if this flag inserted before or not
        $isThereSameFlag=Admin_sections::where('section_flag',$section_flag)->first();
        if(! isset($isThereSameFlag) ){
            Admin_sections::create([
                'section_name_ar' => $input['section_name_ar'],
                'section_name_en' => $input['section_name_en'],
                'section_icon' => $input["section_icon"],
                'section_flag' => $section_flag,
                'controller_name' => $controller_name,
                'module_name' => $input['module_name'],
                'is_notification_able' => $input['is_notification_able'],
                'is_drop_menu' => $input['is_drop_menu'],
                'active' => $input['active'],
                'sort' => $input['sort'],
            ]);
        }


        /******************************/
        /******end add module to admin_menu Content******/
        /******************************/
    }

    public function Insert_ExtensionDB($module_name,$section_flag,$input){

        //first check if this flag inserted before or not
        $isThereSameFlag=Extension::where('extension_flag_name',$section_flag)->first();
        if(! isset($isThereSameFlag) ){
            Extension::create([
                'extension_flag_name' =>$section_flag,
                'extension_module_name' => $module_name,
                'extension_description' => $input['section_name_en'],
                'additional_extensions' => "[]",
                'additional_tables' =>"[]",
                'additional_modules' => "[]",
            ]);
        }


        /******************************/
        /******end add module to admin_menu Content******/
        /******************************/
    }

    public function Insert_PremissionDB($module_name,$input){
        /******************************/
        /******start add module premission and roles_has_permission for current module ******/
        /******************************/

        //Create premissions
        $permissions = [];

        if(isset($input['Admin_Create'])){
            array_push($permissions,''.$module_name.'_Create');
        }
        if(isset($input['Admin_List'])){
            array_push($permissions,''.$module_name.'_Read');
        }
        if(isset($input['Admin_Update'])){
            array_push($permissions,''.$module_name.'_Update');
        }
        if(isset($input['Admin_Delete'])){
            array_push($permissions,''.$module_name.'_Delete');
        }

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

        /******************************/
        /******end add module premission and roles_has_permission for current module ******/
        /******************************/
    }

    public function CreateLanguageFiles($table_fields,$section_flag,$input){




        /******************************/
        /******Start Make Language File******/
        /******************************/

        //get ar and en lang content
        //get fields
        $ar_lines='';
        $en_lines='';
        foreach ($table_fields as $table_field){

            $ar_new_line="'".$table_field."'=>'".$input[$table_field."_ar"]."',\n";
            $en_new_line="'".$table_field."'=>'".$input[$table_field."_en"]."',\n";
            $ar_lines=$ar_lines.$ar_new_line;
            $en_lines=$en_lines.$en_new_line;



            if($input[$table_field.'_datatype']=='enum_selector'){
                $selector_array= $input[$table_field.'_selector_items'];
                $selector_array=explode(',', $selector_array);
                $selector_options='';
                foreach ($selector_array as $selector_en){
                    //translate select //for google translate object
                    $trans = new GoogleTranslate(); $source = 'en'; $target = 'ar';
                    $selector_ar = $trans->translate($source, $target, $selector_en);
                    $ar_new_line="'".$selector_en."'=>'".$selector_ar."',\n";
                    $en_new_line="'".$selector_en."'=>'".$selector_en."',\n";
                    $ar_lines=$ar_lines.$ar_new_line;
                    $en_lines=$en_lines.$en_new_line;
                }


            }
        }

        //add CRUD Messages TRanslation to Files
        //for google translate object
        $trans = new GoogleTranslate();
        //translate table name
        $source = 'en';
        $target = 'ar';
        $module_name=$input['module_name'];


        //module Capital
        $module_message_en=$module_name;
        $module_message_ar= $trans->translate($source, $target, $module_message_en);
        $ar_new_line="'".$module_name."'=>'".$module_message_ar."',\n";
        $en_new_line="'".$module_name."'=>'".$module_message_en."',\n";
        $ar_lines=$ar_lines.$ar_new_line;
        $en_lines=$en_lines.$en_new_line;
        //module Small
        $module_message_en=strtolower($module_name);
        $module_message_ar= $trans->translate($source, $target, $module_message_en);
        $ar_new_line="'".$module_message_en."'=>'".$module_message_ar."',\n";
        $en_new_line="'".$module_message_en."'=>'".$module_message_en."',\n";
        $ar_lines=$ar_lines.$ar_new_line;
        $en_lines=$en_lines.$en_new_line;
        //Section flag
        $text_message_en=ucfirst($section_flag);
        $text_message_ar= $trans->translate($source, $target, $text_message_en);
        $ar_new_line="'".$text_message_en."'=>'".$text_message_ar."',\n";
        $en_new_line="'".$text_message_en."'=>'".$text_message_en."',\n";
        $ar_lines=$ar_lines.$ar_new_line;
        $en_lines=$en_lines.$en_new_line;
        //Section flag
        $text_message_en=$section_flag;
        $text_message_ar= $trans->translate($source, $target, $text_message_en);
        $ar_new_line="'".$text_message_en."'=>'".$text_message_ar."',\n";
        $en_new_line="'".$text_message_en."'=>'".$text_message_en."',\n";
        $ar_lines=$ar_lines.$ar_new_line;
        $en_lines=$en_lines.$en_new_line;

        //Page Title
        $ar_new_line="'Admin - ".$text_message_en."'=>' لوحة التحكم - ".$text_message_ar."',\n";
        $en_new_line="'Admin - ".$text_message_en."'=>'Admin - ".ucfirst($text_message_en)."',\n";
        $ar_lines=$ar_lines.$ar_new_line;
        $en_lines=$en_lines.$en_new_line;


        //Section English Name
        $text_message_en=$input["section_name_en"];
        $text_message_ar= $trans->translate($source, $target, $text_message_en);
        $ar_new_line="'".$text_message_en."'=>'".$text_message_ar."',\n";
        $en_new_line="'".$text_message_en."'=>'".$text_message_en."',\n";
        $ar_lines=$ar_lines.$ar_new_line;
        $en_lines=$en_lines.$en_new_line;



        //Create
        $create_message_en=$module_name." created successfully";
        $create_message_ar= $trans->translate($source, $target, $create_message_en);
        $ar_new_line="'".$module_name."_create'=>'".$create_message_ar."',\n";
        $en_new_line="'".$module_name."_create'=>'".$create_message_en."',\n";
        $ar_lines=$ar_lines.$ar_new_line;
        $en_lines=$en_lines.$en_new_line;

        //read
        $read_message_en=$module_name." retrieved successfully";
        $read_message_ar= $trans->translate($source, $target, $read_message_en);
        $ar_new_line="'".$module_name."_read'=>'".$read_message_ar."',\n";
        $en_new_line="'".$module_name."_read'=>'".$read_message_en."',\n";
        $ar_lines=$ar_lines.$ar_new_line;
        $en_lines=$en_lines.$en_new_line;

        //update
        $update_message_en=$module_name." updated successfully";
        $update_message_ar= $trans->translate($source, $target, $update_message_en);
        $ar_new_line="'".$module_name."_update'=>'".$update_message_ar."',\n";
        $en_new_line="'".$module_name."_update'=>'".$update_message_en."',\n";
        $ar_lines=$ar_lines.$ar_new_line;
        $en_lines=$en_lines.$en_new_line;

        //delete
        $delete_message_en=$module_name." deleted successfully";
        $delete_message_ar= $trans->translate($source, $target, $delete_message_en);
        $ar_new_line="'".$module_name."_delete'=>'".$delete_message_ar."',\n";
        $en_new_line="'".$module_name."_delete'=>'".$delete_message_en."',\n";
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




        $file = $section_flag.'.php';
        $ar_destinationPath="resources/lang/ar/";
        $en_destinationPath="resources/lang/en/";
        if (!is_dir($ar_destinationPath)) {  mkdir($ar_destinationPath,0777,true); }
        if (!is_dir($en_destinationPath)) {  mkdir($en_destinationPath,0777,true); }
        File::put($ar_destinationPath.$file,$ar_lang_content);
        File::put($en_destinationPath.$file,$en_lang_content);

        /******************************/
        /******End Make Language File******/
        /******************************/
    }

    public function CreateIndexPage($table_fields,$table_name,$input,$section_flag){

        /******************************/
        /******start index page Content******/
        /******************************/

        $multiplefiles_script='';
        $fotter_Mfiles_script='';
        $html_Mfiles_script='';

        //declare headers in table and //declare field in datatables js
        $page_table_header='';
        $datatables_fields='';
        foreach ($table_fields as $table_field){
            if(isset($input[$table_field.'_adminTabelview'])){
                //declare datatables fields and //declare header
                if(strpos($table_field, 'image')  !== false || $input[$table_field.'_datatype'] == "image"){
                    $new_line='{data: \''.$table_field.'\', name: \''.$table_field.'\',
                                        render: function(data,type,row){
                                            return \'<img src="\' + \'{{url(\'/\')}}\' +\'/\'+ data + \'",width=60px, height=60px />\'},
                                        orderable: false
                                    },
                                    ';

                    $header_new_line='<th class="is_filter">{{trans("'.$table_name.'.'.$table_field.'")}}</th>
                          ';
                }
                elseif(strpos($table_field, 'file') !== false){
                    $new_line='
                    {data: \''.$table_field.'\', name: \''.$table_field.'\',
                        "render": function(data, type, row, meta) {
                            if (type === \'display\') {
                                data = \'<a target="_blank" href="\' + \'{{url(\'/\')}}\' +\'/\'+ data + \'">{{trans("admin.openFile")}} </a>\';
                            }
                            return data;
                        }
                        },

                    ';
                    $header_new_line='<th class="is_filter">{{trans("'.$table_name.'.'.$table_field.'")}}</th>
                          ';
                }

                elseif(strpos($table_field, 'url') !== false || strpos($table_field, 'link') !== false
                    || strpos($table_field, 'website') !== false){
                    $new_line='
                    {data: \''.$table_field.'\', name: \''.$table_field.'\',
                        "render": function(data, type, row, meta) {
                                data = \'<a style="text-decoration: underline" target="_blank" href="\' + data + \'">\' + data + \' </a>\';
                            return data;
                        }
                        },

                    ';
                    $header_new_line='<th class="is_filter">{{trans("'.$table_name.'.'.$table_field.'")}}</th>
                          ';
                }

                elseif(strpos($table_field, 'ids') || $input[$table_field.'_datatype'] == 'HTMLtextarea'){
                    $new_line='';
                    $header_new_line='';
                }


                else{
                    $new_line='{data: \''.$table_field.'\', name: \''.$table_field.'\'},
                    ';
                    $header_new_line='<th class="is_filter">{{trans("'.$table_name.'.'.$table_field.'")}}</th>
                          ';
                }
                $datatables_fields=$datatables_fields.$new_line;
                $page_table_header=$page_table_header.$header_new_line;


            }
        }
        $page_table_header=$page_table_header.'<th width="100px">{{trans("admin.Control")}}</th>';
        $datatables_fields=$datatables_fields.' {data: \'action\', name: \'action\', orderable: false,
                                        paging:false,
                                        searchable: false,
                                        bSearchable:false,
                                    },';
        $addNewbtn='';
        if(isset($input['Admin_Create'])){
            $addNewbtn=' <a class="btn btn-primary"
            href="{{ route(\''.$section_flag.'.create\') }}">
  {{trans(\'admin.Create\')}} </a> <br> <br>';

        }

        $Export_options='';
        if(isset($input['Admin_Export_Copy'])){
            $Export_options=$Export_options.'
             {extend:\'copyHtml5\',text:"{{trans("admin.copyHtml5")}}",
                                        exportOptions: {
                                            columns: \':not(:last-child)\',
                                        },
                                    },
            ';
        }
        if(isset($input['Admin_Export_Excel'])){
            $Export_options=$Export_options.'
             {extend:\'excelHtml5\',text:"{{trans("admin.excelHtml5")}}",
                                        exportOptions: {
                                            columns: \':not(:last-child)\',
                                        },
                                    },
            ';
        }
        if(isset($input['Admin_Export_CSV'])){
            $Export_options=$Export_options.'
            {extend:\'csvHtml5\',text:"{{trans("admin.csvHtml5")}}",
                                        exportOptions: {
                                            columns: \':not(:last-child)\',
                                        },
                                    },
            ';
        }
        if(isset($input['Admin_Export_PDF'])){
            $Export_options=$Export_options.'
             {extend:\'pdfHtml5\',text:"{{trans("admin.pdfHtml5")}}" ,
                                        customize: function (doc) {
                                            doc.defaultStyle =
                                                {
                                                    font: \'AEfont\',
                                                    alignment: \'center\',
                                                    fontSize: 16,
                                                }
                                        },

                                    } ,
            ';
        }
        if(isset($input['Admin_Export_Print'])){
            $Export_options=$Export_options.'
             {extend:\'print\',text:"{{trans("admin.print")}}" ,
                                        exportOptions: {
                                            columns: \':not(:last-child)\',
                                        },
                                    },
            ';
        }


        $page_content='@extends(\'backend.layouts.app\')
@section(\'title\',trans(\''.$section_flag.'.Admin - '.$section_flag.'\'))
@section(\'header\')


<link href="{{url(\'themes/admin/admindek/assets/css/jquery.dataTables.min.css\')}} " rel="stylesheet">
<link href="{{url(\'themes/admin/admindek/assets/css/dataTables.bootstrap4.min.css\')}} " rel="stylesheet">
<link href="{{url(\'themes/admin/admindek/assets/css/responsive.dataTables.min.css\')}} " rel="stylesheet">




@endsection
@section(\'content\')
<?php $lang=App::getLocale(); ?>

<!-- [ breadcrumb ] start -->
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="'.$input['section_icon'].' bg-c-blue"></i>
                    <div class="d-inline">
                        <h5>{{trans(\''.$section_flag.'.Admin - '.$section_flag.'\')}}</h5>
                        <span>{{trans(\'admin.manage and control all system sides\')}}
                             </span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class=" breadcrumb breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{url(\'admin/dashboard\')}}"><i class="feather icon-home"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">{{trans(\''.$section_flag.'.'.$section_flag.'\')}}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- [ breadcrumb ] end -->
<div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <!-- [ page content ] start -->
                    <div class="row">
                        <div class="col-sm-12">


    <div class="card">
                                <div class="card-header">
                                    <h5>{{trans(\''.$section_flag.'.Admin - '.$section_flag.'\')}}</h5>
                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>
                                            <li><i class="feather icon-maximize full-card"></i></li>
                                            <li><i class="feather icon-minus minimize-card"></i></li>
                                            <li><i class="feather icon-refresh-cw reload-card"></i></li>
                                            <li><i class="feather icon-trash close-card"></i></li>                                                                 <li><i class="feather icon-chevron-left open-card-option"></i></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-block">
    <div class="pcoded-inner-content">
        <div class="main-body">

                <div class="page-body">


    <div class="wrapper_cols">
        <div class="col_page_content">
            <div class="row">
                <div class="col-lg-12 align_btn_end">
                       '.$addNewbtn.'
                </div>

                    <div class="col-md-12">
                        <div class="blog_tablesearch">
                            <div >
                                <table  id="example" class="table table-striped table-bordered display nowrap dataTable " style="width:100%">
                                    <thead>
                                    <tr>
                                        '.$page_table_header.'
                                    </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                    <tr>
                                        '.$page_table_header.'
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <script type="text/javascript">



                        $(document).ready(function() {
                            var base_url = \'{{url(\'/\')}}\';
                            window.pdfMake.fonts = {
                                AEfont: {
                                        normal: \'AEfont-Regular.ttf\',
                                        bold: \'AEfont-Regular.ttf\',
                                        italics: \'AEfont-Regular.ttf\',
                                        bolditalics: \'AEfont-Regular.ttf\'
                                    }
                                };
                            var table = $(\'.dataTable\').DataTable({
                                "order": [[ 0, "desc" ]],
                                dom: \'Bfrtip\',
                                buttons: [
                                '.$Export_options.'
                                ],
                                processing: true,
                                serverSide: true,
                                responsive: true,
                                "language": {
                                    "sProcessing":   "{{trans("admin.sProcessing")}}",
                                    "sZeroRecords":   "{{trans("admin.sZeroRecords")}}",
                                    "sInfo":          "{{trans("admin.sInfo")}}",
                                    "sInfoEmpty":    "{{trans("admin.sInfoEmpty")}}",
                                    "sInfoFiltered":  "{{trans("admin.sInfoFiltered")}}",
                                    "sInfoPostFix":  "",
                                    "sSearch":       "{{trans("admin.sSearch")}}",
                                    "sUrl":          "",
                                    "oPaginate": {
                                        "sFirst":     "{{trans("admin.sFirst")}}",
                                        "sPrevious":  "{{trans("admin.sPrevious")}}",
                                        "sNext":      "{{trans("admin.sNext")}}",
                                        "sLast":     "{{trans("admin.sLast")}}",
                                    }
                                },
                                ajax: "{{ route(\''.$section_flag.'.index\') }}",
                                aoColumns: [
                                    '.$datatables_fields.'
                                ],
                                initComplete: function () {
                                    this.api().columns(\'.is_filter\').every(function () {
                                        var column = this;
                                        var input = document.createElement("input");
                                        $(input).addClass("form-control")
                                        $(input).appendTo($(column.footer()).empty())
                                            .on(\'change\', function () {
                                                column.search($(this).val(), false, false, true).draw();
                                            });
                                    });
                                }
                            });
                        });
                    </script>

            </div>
            </div>
            </div>
            <!--row-->
        </div>
        <!--col_page_content-->


    </div>
    </div>


    </div>
    </div>
    </div>
    </div>

@endsection



@section(\'footer\')
    '.$fotter_Mfiles_script.'


            <script type="text/javascript" src="{{url(\'themes/admin/admindek/assets/js/jquery.dataTables.min.js\')}}"></script>
        <script type="text/javascript" src="{{url(\'themes/admin/admindek/assets/js/dataTables.bootstrap4.min.js\')}}"></script>
        <script type="text/javascript" src="{{url(\'themes/admin/admindek/assets/js/dataTables.responsive.min.js\')}}"></script>
        <script type="text/javascript" src="{{url(\'themes/admin/admindek/assets/js/dataTables.buttons.min.js\')}}"></script>
        <script type="text/javascript" src="{{url(\'themes/admin/admindek/assets/js/buttons.print.min.js\')}}"></script>
        <script type="text/javascript" src="{{url(\'themes/admin/admindek/assets/js/jszip.min.js\')}}"></script>
        <script type="text/javascript" src="{{url(\'themes/admin/admindek/assets/js/pdfmake.min.js\')}}"></script>
        <script type="text/javascript" src="{{url(\'themes/admin/admindek/assets/js/vfs_fonts.js\')}}"></script>
        <script type="text/javascript" src="{{url(\'themes/admin/admindek/assets/js/buttons.html5.min.js\')}}"></script>


@endsection

';

        $file = 'index.blade.php';
        $destinationPath="resources/views/backend/".$section_flag."/";
        if (!is_dir($destinationPath)) {  mkdir($destinationPath,0777,true);  }
        File::put($destinationPath.$file,$page_content);


        /******************************/
        /******End index page Content******/
        /******************************/


    }

    public function CreateViewPage($table_fields,$table_name,$section_flag,$module_name,$input){

        /******************************/
        /******start show page Content******/
        /******************************/



        $multiplefiles_script='';
        $fotter_Mfiles_script='';
        $html_Mfiles_script='';

        //declare get form inputs and its type to create i
        $form_content='';
        foreach ($table_fields as $table_field){
            //get input type for each parameter and define input type and its style cols.
            if($input[$table_field.'_datatype'] == 'number' && $table_field=='id' ){
                $new_line = '
                   <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("' . $section_flag . '.' . $table_field . '")}}:</strong>
                            <div>{{$' . $module_name . '->' . $table_field . '}}</div>
                        </div>
                    </div>';
            }
            elseif($input[$table_field.'_datatype'] == 'number'){
                $new_line = ' <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("' . $section_flag . '.' . $table_field . '")}}:</strong>
<div>{{$' . $module_name . '->' . $table_field . '}}</div>                        </div>
                    </div>';
            }
            elseif($input[$table_field.'_datatype'] == 'price'){
                $new_line = ' <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("' . $section_flag . '.' . $table_field . '")}}:</strong>
<div>{{$' . $module_name . '->' . $table_field . '}}</div>                        </div>
                    </div>';
            }
            elseif($input[$table_field.'_datatype'] == 'varchar'){
                $new_line = ' <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("' . $section_flag . '.' . $table_field . '")}}:</strong>
<div>{{$' . $module_name . '->' . $table_field . '}}</div>                        </div>
                    </div>';
            }
            elseif($input[$table_field.'_datatype'] == 'textarea'){
                $new_line = '
                   <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("' . $section_flag . '.' . $table_field . '")}}:</strong>
<div>{{$' . $module_name . '->' . $table_field . '}}</div>
                        </div>
                    </div>';
            }
            elseif($input[$table_field.'_datatype'] == 'HTMLtextarea'){
                $new_line = '
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("' . $section_flag . '.' . $table_field . '")}}:</strong>
                            <textarea name="' . $table_field . '" id="' . $table_field . '" >
                            @if(old(\'' . $table_field . '\') != null)
                            {{ old(\'' . $table_field . '\') }}
                            @else
                            {{$' . $module_name . '->' . $table_field . '}}
                            @endif
                            </textarea>
                        </div>
                    </div>
                     <script>
                        $(\'#' . $table_field . '\').richText({});
                    </script>
                    ';
            }

            elseif($input[$table_field.'_datatype'] == 'date'){
                $new_line = ' <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("' . $section_flag . '.' . $table_field . '")}}:</strong>
                            {!! Form::date(\'' . $table_field . '\', $' . $module_name . '->' . $table_field . ', array(\'placeholder\' => trans("' . $section_flag . '.' . $table_field . '"),\'class\' => \'form-control\',\'disabled\')) !!}
                        </div>
                    </div>';
            }
            elseif($input[$table_field.'_datatype'] == 'time'){
                $new_line = ' <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("' . $section_flag . '.' . $table_field . '")}}:</strong>
                            {!! Form::time(\'' . $table_field . '\', $' . $module_name . '->' . $table_field . ', array(\'placeholder\' => trans("' . $section_flag . '.' . $table_field . '"),\'class\' => \'form-control\',\'disabled\')) !!}
                        </div>
                    </div>';
            }
            elseif($input[$table_field.'_datatype'] == 'datetime'){
                $new_line = ' <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("' . $section_flag . '.' . $table_field . '")}}  {{trans("admin.date")}} :</strong>
                            {!! Form::date(\'' .  $table_field . '_date\',  date(\'Y-m-d\',strtotime($' . $module_name . '->' . $table_field . '))  , array(\'placeholder\' => trans("' . $section_flag . '.' . $table_field .  ' "),\'class\' => \'form-control\',\'disabled\')) !!}
                        </div>
                    </div>
                     <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("' . $section_flag . '.' . $table_field . '")}}   {{trans("admin.time")}}  :</strong>
                            {!! Form::time(\'' . $table_field . '_time\', date(\'H:i\',strtotime($' . $module_name . '->' . $table_field . ')), array(\'placeholder\' => trans("' . $section_flag . '.' . $table_field .  ' "),\'class\' => \'form-control\',\'disabled\')) !!}
                        </div>
                    </div>
                    ';
            }
            elseif($input[$table_field.'_datatype'] == 'image'){
                $new_line = '
                       <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>{{trans("' . $section_flag . '.' . $table_field . '")}}:</strong>
                                <div class="col-12">
                                @if(isset($' . $module_name . '->' . $table_field . '))
                                    <img class="img-responsive" src="{{url($'.$module_name.'->' . $table_field . ')}}" alt="">
                                @endif
                                </div>
                               </div>
                        </div>';
            }
            elseif($input[$table_field.'_datatype'] == 'file'){
                $new_line = '<div class="col-xs-3 col-sm-3 col-md-3">

                            <div class="form-group">
                                <strong>{{trans("' . $section_flag . '.' . $table_field . '")}}:</strong><br>
                                <div class="col-12">
                                <a href="{{url($'.$module_name.'->' . $table_field . ')}}">
                                <u>{{trans(\'admin.Download\')}}</u></a>
                                </div>
                               </div>
                        </div>';
            }
            elseif($input[$table_field.'_datatype'] == 'url_link'){
                $new_line = '<div class="col-xs-3 col-sm-3 col-md-3">
                            <div class="form-group">
                                <strong>{{trans("' . $section_flag . '.' . $table_field . '")}}:</strong>
                                <div class="col-12">
                                <a href="{{$'.$module_name.'->' . $table_field . '}}"><u>{{$'.$module_name.'->' . $table_field . '}}</u></a>
                                </div>
                               </div>
                        </div>';
            }
            elseif($input[$table_field.'_datatype']=='select'){
                $new_line=' <div class="col-xs-3 col-sm-3 col-md-3">
                            <div class="form-group">
                                <strong>{{trans("'.$section_flag.'.'.$table_field.'")}}:</strong>
<div>{{$' . $module_name . '->' . $table_field . '}}</div>                            </div>
                        </div>';
            }

            elseif($input[$table_field.'_datatype']=='enum_selector'){

                $selector_array= $input[$table_field.'_selector_items'];
                $selector_array=explode(',', $selector_array);
                $selector_options='';

                foreach ($selector_array as $selector_en){
                    $selector_options.='
                        <option value="'.$selector_en.'"

                        @if(old(\''.$table_field.'\')=="'.$selector_en.'")!=null)
                            @if(old(\''.$table_field.'\')=="'.$selector_en.'")
                            selected
                            @endif
                        @else
                            @if($'.$module_name.'->'.$table_field.'=="'.$selector_en.'")
                            selected
                            @endif
                        @endif
                        >{{trans(\''.$section_flag.'.'.$selector_en.'\')}}</option>
                        ';
                }


                $new_line='<div class="col-xs-3 col-sm-3 col-md-3">
                            <div class="form-group">
                        <div class="box">
                            <strong>{{trans("'.$section_flag.'.'.$table_field.'")}}:</strong>

                            <div>
                {{trans("'.$section_flag.'.{$' . $module_name . '->' . $table_field . '}")}}
                </div>
                        </div>

                        <br><br>
                    </div>
                        </div>';
            }

            elseif($input[$table_field.'_datatype']=='select_niceSelector'){
                $new_line='<div class="col-xs-3 col-sm-3 col-md-3">
                            <div class="form-group">
                        <div class="box">
                            <strong>{{trans("'.$section_flag.'.'.$table_field.'")}}:</strong>
                            <select class="wide form-control"  id="'.$table_field.'" name="'.$table_field.'">
                                <option value="1" @if($'.$module_name.'->'.$table_field.'=="1") selected @endif>الخيار الاول</option>
                                <option value="2" @if($'.$module_name.'->'.$table_field.'=="2") selected @endif>الخيار الثاني</option>
                                <option value="3" @if($'.$module_name.'->'.$table_field.'=="3") selected @endif>الخيار الثالث</option>
                            </select>
                        </div>
                        <script>
                            $(document).ready(function() {
                                $("#'.$table_field.':not(.ignore)").niceSelect();
                                //FastClick.attach(document.body);
                            });
                        </script>
                        <br><br>
                    </div>
                        </div>';
            }
            elseif($input[$table_field.'_datatype']=='select_with_search'){
                $new_line='<div class="col-xs-3 col-sm-3 col-md-3">
                                    <div class="form-group">
                                <div>
                                    <strong>{{trans("'.$section_flag.'.'.$table_field.'")}}:</strong>
                                    <select  id="'.$table_field.'" name="'.$table_field.'" data-placeholder="Choose a Country..." class="form-control chosen-select" tabindex="2">
                                        <option value="Antarctica" @if($'.$module_name.'->'.$table_field.'=="Antarctica") selected @endif>Antarctica</option>
                                        <option value="Argentina" @if($'.$module_name.'->'.$table_field.'=="Argentina") selected @endif>Argentina</option>
                                        <option value="Armenia" @if($'.$module_name.'->'.$table_field.'=="Armenia") selected @endif >Armenia</option>
                                        <option value="Ecuador" @if($'.$module_name.'->'.$table_field.'=="Ecuador") selected @endif>Ecuador</option>
                                        <option value="Egypt" @if($'.$module_name.'->'.$table_field.'=="Egypt") selected @endif >Egypt</option>
                                    </select>
                                </div>
                                <br><br>
                            </div>
                        </div>';
            }

            elseif($input[$table_field.'_datatype']=='is_checkbox'){
                $new_line='<div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("'.$section_flag.'.'.$table_field.'")}}:</strong>
                            <input type="checkbox" name="'.$table_field.'" class="form-control disabled"

                            @if(old(\''.$table_field.'\') != null)
                               @if(old(\''.$table_field.'\')=="on")
                               checked
                               @endif
                           @else
                                @if($'.$module_name.'->'.$table_field.'==1) checked @endif
                           @endif
                             >
                        </div>
                    </div>';
            }

            elseif($input[$table_field.'_datatype']=='is_switch'){
                $new_line='<div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("'.$section_flag.'.'.$table_field.'")}}:</strong>
                            <br>
                            <input disabled type="checkbox" name="'.$table_field.'"  class="js-switch"

                            @if(old(\''.$table_field.'\') != null)
                               @if(old(\''.$table_field.'\')=="on")
                               checked
                               @endif
                           @else
                                @if($'.$module_name.'->'.$table_field.'==1) checked @endif
                           @endif
                             >
                        </div>
                    </div>';
            }

            elseif($input[$table_field.'_datatype']=='join_select'){
                $joined_table=$input[$table_field.'_joinedTable'];
                $data=DB::table($joined_table)->select('id')->get();

                $selector=[];
                foreach ($data as $info){
                    array_push($selector,"$info->id");
                }
                $selector=json_encode($selector);
                $new_line=' <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>{{trans("'.$section_flag.'.'.$table_field.'")}}:</strong>
                                {!!Form::select(\''.$table_field.'\', $'.$joined_table.', $' . $module_name . '->' . $table_field . ', [\'class\' => \'form-control\',\'disabled\'])!!}
                            </div>
                        </div>';
            }
            elseif($input[$table_field.'_datatype']=='table_to_select'){
                $joined_table=$input[$table_field.'_joinedTable'];
                $joined_table_field_name=$input[$table_field.'_joinedTable_field'];
//                $joined_table_field_name="id";

                $data=DB::table($joined_table)->get();
                $selector=[];
                $selectorNew='';
                $comma='';
                foreach ($data as $info){
                    $aaa= $info->{$joined_table_field_name};
                    array_push($selector,$aaa);
                    $selectorNew.=$comma.$info->id.'=>'.$aaa;
                    $comma=',';
                }
                $selectorNew="[".$selectorNew."]";
                $new_line=' <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>{{trans("'.$section_flag.'.'.$table_field.'")}}:</strong>
                                {!!Form::select(\''.$table_field.'\', $'.$joined_table.',  $' . $module_name . '->' . $table_field . ', [\'class\' => \'form-control  chosen-select\',\'disabled\'])!!}
                            </div>
                        </div>';
            }
            elseif($input[$table_field.'_datatype']=='table_to_checkbox'){
                $joined_table=$input[$table_field.'_joinedTable'];
                $joined_table_field_name=$input[$table_field.'_joinedTable_field'];

                $joined_table_field_name = $joined_table_field_name;
                if(str_contains($joined_table_field_name,'_ar') || str_contains($joined_table_field_name,'_en')){
                    $joined_table_field_name = str_replace('_ar','',$joined_table_field_name);
                    $joined_table_field_name = str_replace('_en','',$joined_table_field_name);
                    $joined_table_field_name='{\''.$joined_table_field_name.'_\'.$lang} ';
                }

                $new_line=' <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{trans("'.$section_flag.'.'.$table_field.'")}}:</strong><br>
                 @foreach($'.$joined_table.' as $info)
                    <input type="checkbox" name="'.$table_field.'[]" disabled="disabled" value="{{$info->id}}"

                     @if(old(\''.$table_field.'\') != null)
                               @if(in_array($info->id,old(\''.$table_field.'\')))
                               checked
                               @endif
                           @else
                                @if(in_array($info->id,$'.$module_name.'->'.$table_field.')) checked @endif
                           @endif
                           >

                     {{$info->'.$joined_table_field_name.'}}
                @endforeach
                            </div>
                        </div>';
            }

            elseif($input[$table_field.'_datatype']=='table_to_tagInput'){
                $joined_table=$input[$table_field.'_joinedTable'];
                $joined_table_field_name=$input[$table_field.'_joinedTable_field'];
                $new_line='<div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{trans("'.$section_flag.'.'.$table_field.'")}}:</strong><br>
                                <input id="'.$table_field.'" name="'.$table_field.'" type="text" value="{{$'.$module_name.'->'.$table_field.'}}"  disabled="disabled">
                            <script type="text/javascript">
                                '.$joined_table.'_autoComplete = [];
                                $(function() {
                                    $(\'#'.$table_field.'\').tagsInput();
                                    $("#'.$table_field.'_tag").attr("disabled",\'disabled\');
                                });

                                function check'.$joined_table.'_for_'.$table_name.'_forField'.$table_field.'('.$joined_table_field_name.',successCallback){
                                    var _token = \'<?php echo csrf_token() ?>\';
                                    var res = "false";

                                    $.ajax({
                                        url: "{{url("admin/check'.$joined_table.'_for_'.$table_name.'_forField'.$table_field.'")}}",
                                        type: "post",
                                        async: false,
                                        data:{
                                            '.$joined_table_field_name.':'.$joined_table_field_name.',
                                            _token:_token
                                        },
                                        success: function(response) {
                                            res = response;
                                            successCallback(res);
                                        },
                                    });
                                }

                                function search'.$joined_table.'_for_'.$table_name.'_forField'.$table_field.'(search_text,successCallback){
                                    var _token = \'<?php echo csrf_token() ?>\';
                                    var search_res = [];

                                    $.ajax({
                                        url: "{{url("admin/search'.$joined_table.'_for_'.$table_name.'_forField'.$table_field.'")}}",
                                        type: "post",
                                        async: false,
                                        data:{
                                            search_text:search_text,
                                            _token:_token
                                        },
                                        success: function(response) {
                                            search_res = response;
                                            successCallback(search_res);
                                        },
                                    });
                                }
                            </script>
                             </div>
                        </div>';
            }

            elseif($input[$table_field.'_datatype']=='table_to_table'){
                //**** Create Custom Functions Needed for tables**********************//
                /*****************************************************************************/
                $custom_functions_Script_in_view_page = '';

                if($input[''.$table_field.'_datatype']=="table_to_table") {

                    $custom_field_table_name = $input['' . $table_field . '_joinedTable'];
                    $custom_table_module_name = ucfirst($custom_field_table_name);
                    $custom_table_module_name = rtrim($custom_table_module_name, "s");
                    $custom_table_fields = DB::getSchemaBuilder()->getColumnListing($custom_field_table_name);
                    //make function to get all data for this table

                    //declare headers in table and //declare field in datatables js
                    $page_table_header = '';
                    $datatables_fields = '';
                    foreach ($custom_table_fields as $custom_table_field) {

                        if ( !in_array($custom_table_field, array('email_verify_code','mobile_verify_code',
                            'email_verified_at','mobile_verified_at','password','remember_token','created_at'
                        ,'updated_at'), true ) ) {
                            //declare header
                            $new_line = '<th class="is_filter">{{trans("' . $custom_field_table_name . '.' . $custom_table_field . '")}}</th>
                          ';
                            $page_table_header = $page_table_header . $new_line;
                            //declare datatables fields
                            if (strpos($custom_table_field, 'image') !== false) {
                                $new_line = '{data: \'' . $custom_table_field . '\', name: \'' . $custom_table_field . '\',
                                        render: function(data,type,row){
                                            return \'<img src="\' + \'{{url(\'/\')}}\' +\'/\'+ data + \'",width=60px, height=60px />\'},
                                        orderable: false
                                    },
                                    ';
                            } elseif (strpos($custom_table_field, 'file') !== false) {
                                $new_line = '';
                            } elseif (strpos($custom_table_field, 'url') !== false || strpos($custom_table_field, 'link') !== false
                                || strpos($custom_table_field, 'website') !== false) {
                                $new_line = '
                    {data: \'' . $custom_table_field . '\', name: \'' . $custom_table_field . '\',
                        "render": function(data, type, row, meta) {
                                data = \'<a style="text-decoration: underline" target="_blank" href="\' + data + \'">\' + data + \' </a>\';
                            return data;
                        }
                        },

                    ';
                            } elseif (strpos($custom_table_field, 'ids')) {
                                $new_line = '';
                            } else {
                                $new_line = '{data: \'' . $custom_table_field . '\', name: \'' . $custom_table_field . '\'},
                    ';
                            }
                            $datatables_fields = $datatables_fields . $new_line;


                        }
                    }
                    $page_table_header=$page_table_header.'<th width="100px">تحكم</th>';
                    $datatables_fields=$datatables_fields.' {data: \'action\', name: \'action\', orderable: false,
                                        paging:false,
                                        searchable: false,
                                        bSearchable:false,
                                    },';



                    $custom_functions_Script_in_view_page = '
 <div class="col-md-12">
 <strong>{{trans("'.$table_name.'.'.$table_field.'")}}:</strong>
                                    <div class="blog_tablesearch">
                                        <div class="table-responsive">
                                            <table  id="table_'.$table_field.'" class="table table-striped table-bordered display nowrap dataTable " style="width:100%">
                                                <thead>
                                                <tr>
                                                    '.$page_table_header.'
                                                </tr>
                                                </thead>
                                                <tbody></tbody>
                                                <tfoot>
                                                <tr>
                                                    '.$page_table_header.'
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>

<script type="text/javascript">


                                    $(document).ready(function() {
                                        window.pdfMake.fonts = {
                                            AEfont: {
                                                normal: \'AEfont-Regular.ttf\',
                                                bold: \'AEfont-Regular.ttf\',
                                                italics: \'AEfont-Regular.ttf\',
                                                bolditalics: \'AEfont-Regular.ttf\'
                                            }
                                        };
                                        var table = $(\'#table_'.$table_field.'\').DataTable({
                                            dom: \'Bfrtip\',
                                            buttons: [
                                                {extend:\'copyHtml5\',text:\'نسخ\',
                                                    exportOptions: {
                                                        columns: \':not(:last-child)\',
                                                    },
                                                },
                                                {extend:\'excelHtml5\',text:\'تصدير Excel\',
                                                    exportOptions: {
                                                        columns: \':not(:last-child)\',
                                                    },
                                                },
                                                {extend:\'csvHtml5\',text:\'تصدير CSV\',
                                                    exportOptions: {
                                                        columns: \':not(:last-child)\',
                                                    },
                                                },
                                                {extend:\'pdfHtml5\',text:\'تصدير PDF\' ,
                                                    customize: function (doc) {
                                                        doc.defaultStyle =
                                                            {
                                                                font: \'AEfont\',
                                                                alignment: \'center\',
                                                                fontSize: 16,
                                                            }
                                                    },


                                                } ,
                                                {extend:\'print\',text:\'طباعة\' ,
                                                    exportOptions: {
                                                        columns: \':not(:last-child)\',
                                                    },
                                                },
                                            ],
                                            processing: true,
                                            serverSide: true,
                                            responsive: true,
                                            "language": {
                                                "sProcessing":   "جارٍ التحميل...",
                                                "sLengthMenu":   "أظهر _MENU_ مدخلات",
                                                "sZeroRecords":  "لم يعثر على أية سجلات",
                                                "sInfo":         "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
                                                "sInfoEmpty":    "يعرض 0 إلى 0 من أصل 0 سجل",
                                                "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
                                                "sInfoPostFix":  "",
                                                "sSearch":       "ابحث:",
                                                "sUrl":          "",
                                                "oPaginate": {
                                                    "sFirst":    "الأول",
                                                    "sPrevious": "السابق",
                                                    "sNext":     "التالي",
                                                    "sLast":     "الأخير"
                                                }
                                            },
                                            ajax: {
                                                url: \'{{ route(\'get'.$custom_field_table_name.'Info_for_'.$table_name.'_forField'.$table_field.'\') }}\',
                                                data: {
                                                    \''.$module_name.'_id\' : \'{{ $'.$module_name.'->id}}\' ,
                                                }
                                            },
                                            aoColumns: [
                                               '.$datatables_fields.'
                                            ],

                                            initComplete: function () {
                                                this.api().columns(\'.is_filter\').every(function () {
                                                    var column = this;
                                                    var input = document.createElement("input");
                                                    $(input).addClass("form-control")
                                                    $(input).appendTo($(column.footer()).empty())
                                                        .on(\'change\', function () {
                                                            column.search($(this).val(), false, false, true).draw();
                                                        });
                                                });
                                            }
                                        });

                                    });

                                </script>';


                }

                //**** End of Create Custom Functions Needed for tables**********************//
                /*****************************************************************************/
                $new_line= $custom_functions_Script_in_view_page;

            }
            elseif($input[$table_field.'_datatype']=='active'){
                $new_line=' <div class="col-xs-3 col-sm-3 col-md-3">
                            <div class="form-group">
                                <strong>{{trans("'.$section_flag.'.'.$table_field.'")}}:</strong>

                                <div>
                                @if($' . $module_name . '->' . $table_field . '=="1")
                                {{trans(\'admin.active\')}}
                                @else
                                {{trans(\'admin.inactive\')}}
                                @endif
                                </div>

                            </div>
                        </div>';
            }
            elseif($input[$table_field.'_datatype']=='sort'){
                $new_line=' <div class="col-md-3">
                            <div class="form-group">
                                <strong>{{trans("'.$section_flag.'.'.$table_field.'")}}:</strong>
                                {!! Form::number(\''.$table_field.'\',$' . $module_name . '->' . $table_field . ', array(\'placeholder\' => trans("'.$section_flag.'.'.$table_field.'"),\'class\' => \'form-control\',\'disabled\')) !!}
                            </div>
                        </div>';
            }
            elseif($input[$table_field.'_datatype']=='order_status'){
                $new_line=' <div class="col-xs-3 col-sm-3 col-md-3">
                            <div class="form-group">
                                <strong>{{trans("'.$section_flag.'.'.$table_field.'")}}:</strong>
                                {!!Form::select(\''.$table_field.'\', [\'pending\' => "في الانتظار",\'processing\' => "جاري تنفيذ الطلب",\'completed\' => "تم تنفيذ الطلب",\'cant_process\' => "لا يمكن تنفيذ الطلب"], $' . $module_name . '->' . $table_field . ', [\'class\' => \'form-control\',\'disabled\'])!!}
                            </div>
                        </div>';
            }
            else{
                $new_line = ' <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("' . $section_flag . '.' . $table_field . '")}}:</strong>
                            {!! Form::text(\'' . $table_field . '\', $' . $module_name . '->' . $table_field . ', array(\'placeholder\' => trans("' . $section_flag . '.' . $table_field . '"),\'class\' => \'form-control\',\'disabled\')) !!}
                        </div>
                    </div>';
            }
            $form_content=$form_content."
            ".$new_line."
            ";

        }

        // this code only if module has multiple files or images or has image or file with initial state




        if($input[$table_field.'_datatype']=='file'){
            $fotter_Mfiles_script=$fotter_Mfiles_script.'
    <script !src="">
        var url = [];
        var initialPreviewConfig = [];
    </script>

        <script type="text/javascript">
            url.push("{{url($' . $module_name . '->' . $table_field . ')}}");
            initialPreviewConfig.push({filename: "' . $table_field . '",
            downloadUrl: "{{url($' . $module_name . '->' . $table_field . ')}}", size: 930321, width: "120px", url: "", key: ""});
        </script>


            <script !src="">
            $("#' . $table_field . '").fileinput({
                theme: \'fa\',
                uploadUrl: \'#\', // you must set a valid URL here else you will get an error
                allowedFileExtensions: [\'jpg\', \'png\', \'gif\'],
                overwriteInitial: false,
                maxFileSize: 1000,
                maxFilesNum: 1,
                minFilesNum: 1,
                showUpload: false,
                initialPreview: url,
                initialPreviewAsData: true,
                initialPreviewConfig: initialPreviewConfig,
                showBrowse:false,
                msgPlaceholder : "{{trans(\'admin.Select file..\')}}",
                msgSelected : "{{trans(\'admin.msgSelected\')}}",
                msgProcessing : "{{trans(\'admin.msgProcessing\')}}",
                removeTitle : "{{trans(\'admin.removeTitle\')}}",
                uploadTitle : "{{trans(\'admin.uploadTitle\')}}",
                downloadTitle : "{{trans(\'admin.downloadTitle\')}}",
                zoomTitle : "{{trans(\'admin.zoomTitle\')}}",
                dragTitle : "{{trans(\'admin.dragTitle\')}}",
                msgNo : "{{trans(\'admin.msgNo\')}}",
                msgNoFilesSelected : "{{trans(\'admin.msgNoFilesSelected\')}}",
                msgCancelled : "{{trans(\'admin.msgCancelled\')}}",
                msgPaused : "{{trans(\'admin.msgPaused\')}}",
                msgZoomTitle : "{{trans(\'admin.msgZoomTitle\')}}",
                msgZoomModalHeading : "{{trans(\'admin.msgZoomModalHeading\')}}",
                msgFileRequired : "{{trans(\'admin.msgFileRequired\')}}",
                browseLabel : "{{trans(\'admin.browseLabel\')}}",
                removeLabel : "{{trans(\'admin.removeLabel\')}}",
                dropZoneTitle : "{{trans(\'admin.dropZoneTitle\')}}",
            });
             </script>';
        }


        if($input['table_has_multiple_images']==1 || $input['table_has_multiple_files']==1){
            $multiplefiles_script='
        @section(\'header\')
    <link href="{{url(\'admin/assets/css/fileinput.css\')}}" media="all" rel="stylesheet" type="text/css" />
    <script src="{{url(\'admin/assets/js/fileinput.js\')}}" type="text/javascript"></script>
    <script src="{{url(\'admin/assets/js/theme.js\')}}" type="text/javascript"></script>
@stop
        ';

        }
        if($input['table_has_multiple_images']==1){
            $fotter_Mfiles_script=$fotter_Mfiles_script.'
    <script !src="">
        var url = [];
        var initialPreviewConfig = [];
    </script>
    @foreach($images as $image)
        <script type="text/javascript">
            url.push("{{url($image->image)}}");
            initialPreviewConfig.push({filename: "image", downloadUrl: "{{url($image->image)}}", size: 930321, width: "120px", url: "", key: ""});
        </script>
    @endforeach

            <script !src="">
            $("#images").fileinput({
                theme: \'fa\',
                uploadUrl: \'#\', // you must set a valid URL here else you will get an error
                allowedFileExtensions: [\'jpg\', \'png\', \'gif\'],
                overwriteInitial: false,
                maxFileSize: 1000,
                maxFilesNum: 6,
                minFilesNum: 1,
                showUpload: false,
                initialPreview: url,
                initialPreviewAsData: true,
                initialPreviewConfig: initialPreviewConfig,
                showBrowse:false,
                msgPlaceholder : "{{trans(\'admin.Select file..\')}}",
                msgSelected : "{{trans(\'admin.msgSelected\')}}",
                msgProcessing : "{{trans(\'admin.msgProcessing\')}}",
                removeTitle : "{{trans(\'admin.removeTitle\')}}",
                uploadTitle : "{{trans(\'admin.uploadTitle\')}}",
                downloadTitle : "{{trans(\'admin.downloadTitle\')}}",
                zoomTitle : "{{trans(\'admin.zoomTitle\')}}",
                dragTitle : "{{trans(\'admin.dragTitle\')}}",
                msgNo : "{{trans(\'admin.msgNo\')}}",
                msgNoFilesSelected : "{{trans(\'admin.msgNoFilesSelected\')}}",
                msgCancelled : "{{trans(\'admin.msgCancelled\')}}",
                msgPaused : "{{trans(\'admin.msgPaused\')}}",
                msgZoomTitle : "{{trans(\'admin.msgZoomTitle\')}}",
                msgZoomModalHeading : "{{trans(\'admin.msgZoomModalHeading\')}}",
                msgFileRequired : "{{trans(\'admin.msgFileRequired\')}}",
                browseLabel : "{{trans(\'admin.browseLabel\')}}",
                removeLabel : "{{trans(\'admin.removeLabel\')}}",
                dropZoneTitle : "{{trans(\'admin.dropZoneTitle\')}}",
            });

             </script>';


            $html_Mfiles_script=$html_Mfiles_script.'
            <div class="form-group col-md-12">
            <label for="images">{{trans(\'admin.images\')}}</label>
            <div class="file-loading">
                <input id="images" name="images[]" type="file" multiple class="file" data-overwrite-initial="false"
                       >
            </div>
            </div>
            ';
        }
        if($input['table_has_multiple_files']==1){
            $fotter_Mfiles_script=$fotter_Mfiles_script.'
<script !src="">
        var url_files = [];
        var initialPreviewConfig_files = [];
    </script>
    @foreach($files as $file)
        <script type="text/javascript">
            url_files.push("{{url($file->file)}}");
            initialPreviewConfig_files.push({filename: "file", downloadUrl: "{{url($file->file)}}", size: 930321, width: "120px", url: "", key: ""});
        </script>
    @endforeach

<script !src="">
            $("#files").fileinput({
                theme: \'fa\',
                uploadUrl: \'#\', // you must set a valid URL here else you will get an error
                allowedFileExtensions: [\'rar\', \'zip\', \'doc\', \'docx\', \'pdf\'],
                overwriteInitial: false,
                maxFileSize: 1000,
                maxFilesNum: 6,
                minFilesNum: 1,
                showUpload: false,
                initialPreview: url_files,
                initialPreviewAsData: true,
                initialPreviewConfig: initialPreviewConfig_files,
                showBrowse:false,
                msgPlaceholder : "{{trans(\'admin.Select file..\')}}",
                msgSelected : "{{trans(\'admin.msgSelected\')}}",
                msgProcessing : "{{trans(\'admin.msgProcessing\')}}",
                removeTitle : "{{trans(\'admin.removeTitle\')}}",
                uploadTitle : "{{trans(\'admin.uploadTitle\')}}",
                downloadTitle : "{{trans(\'admin.downloadTitle\')}}",
                zoomTitle : "{{trans(\'admin.zoomTitle\')}}",
                dragTitle : "{{trans(\'admin.dragTitle\')}}",
                msgNo : "{{trans(\'admin.msgNo\')}}",
                msgNoFilesSelected : "{{trans(\'admin.msgNoFilesSelected\')}}",
                msgCancelled : "{{trans(\'admin.msgCancelled\')}}",
                msgPaused : "{{trans(\'admin.msgPaused\')}}",
                msgZoomTitle : "{{trans(\'admin.msgZoomTitle\')}}",
                msgZoomModalHeading : "{{trans(\'admin.msgZoomModalHeading\')}}",
                msgFileRequired : "{{trans(\'admin.msgFileRequired\')}}",
                browseLabel : "{{trans(\'admin.browseLabel\')}}",
                removeLabel : "{{trans(\'admin.removeLabel\')}}",
                dropZoneTitle : "{{trans(\'admin.dropZoneTitle\')}}",
            });


             </script>';

            $html_Mfiles_script=$html_Mfiles_script.'
            <div class="form-group col-md-12">
            <label for="images">{{trans(\'admin.files\')}}</label>
            <div class="file-loading">
                <input id="files" name="files[]" type="file" multiple class="file" data-overwrite-initial="false"
                       >
            </div>
            </div>
            ';
        }





        $page_content='@extends(\'backend.layouts.app\')
'.$multiplefiles_script.'

@section(\'title\',trans(\''.$section_flag.'.Admin - '.$section_flag.'\'))
@section(\'header\')
@endsection

@section(\'content\')

<?php $lang=App::getLocale(); ?>

<!-- [ breadcrumb ] start -->
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="'.$input['section_icon'].' bg-c-blue"></i>
                    <div class="d-inline">
                        <h5>{{trans(\''.$section_flag.'.Admin - '.$section_flag.'\')}}</h5>
                        <span>{{trans(\'admin.manage and control all system sides\')}}
                             </span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class=" breadcrumb breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{url(\'admin/dashboard\')}}"><i class="feather icon-home"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">{{trans(\''.$section_flag.'.'.$section_flag.'\')}}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- [ breadcrumb ] end -->
<div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <!-- [ page content ] start -->
                    <div class="row">
                        <div class="col-sm-12">


    <div class="card">
                                <div class="card-header">
                                    <h5>{{trans(\''.$section_flag.'.Admin - '.$section_flag.'\')}}</h5>
                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>
                                            <li><i class="feather icon-maximize full-card"></i></li>
                                            <li><i class="feather icon-minus minimize-card"></i></li>
                                            <li><i class="feather icon-refresh-cw reload-card"></i></li>
                                            <li><i class="feather icon-trash close-card"></i></li>                                                                 <li><i class="feather icon-chevron-left open-card-option"></i></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-block">

    <div class="wrapper_cols">
        <div class="col_page_content">
            <div class="row">

    <div class="col-lg-12">
           <br>
                <h4>{{trans(\'admin.viewModule\')}}</h4>
        </div>
        <div class="col-md-12 ">
        <div class="align_btn_end">
                <a class="btn btn-primary" href="{{ route(\''.$section_flag.'.index\') }}">
                {{trans(\'admin.back\')}}</a>
            </div>
        </div>


 </div>




    <div class="row">
        '.$form_content.'

        '.$html_Mfiles_script.'

    </div>

            </div>
        </div>
    </div>




    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>

@endsection


@section(\'footer\')
    '.$fotter_Mfiles_script.'
@endsection
';

        $file = 'show.blade.php';
        $destinationPath="resources/views/backend/".$section_flag."/";
        if (!is_dir($destinationPath)) {  mkdir($destinationPath,0777,true);  }
        File::put($destinationPath.$file,$page_content);


        /******************************/
        /******End show page Content******/
        /******************************/

    }


    public function CreateStorePage($table_fields,$section_flag,$input){

        /******************************/
        /******start create page Content******/
        /******************************/

        $multiplefiles_script='';
        $fotter_Mfiles_script='';
        $html_Mfiles_script='';

        $table_name = $input["table_name"];

        //declare get form inputs and its type to create i
        $form_content='';
        foreach ($table_fields as $table_field){
            //get input type for each parameter

            if(isset($input[$table_field.'_adminview'])){
                if($input[$table_field.'_datatype'] == 'number' && $table_field=='id' ){
                    $new_line = '
                   <div class="col-xs-12 col-sm-12 col-md-12 nopadding">
                   <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("' . $section_flag . '.' . $table_field . '")}}:</strong>
                            {!! Form::number(\'' . $table_field . '\', "", array(\'placeholder\' => trans("' . $section_flag . '.' . $table_field . '"),\'class\' => \'form-control\')) !!}
                        </div>
                    </div></div>';
                }
                elseif($input[$table_field.'_datatype'] == 'number'){
                    $new_line = ' <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("' . $section_flag . '.' . $table_field . '")}}:</strong>
                            {!! Form::number(\'' . $table_field . '\',"", array(\'placeholder\' => trans("' . $section_flag . '.' . $table_field . '"),\'class\' => \'form-control\')) !!}
                        </div>
                    </div>';
                }
                elseif($input[$table_field.'_datatype'] == 'price'){
                    $new_line = ' <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("' . $section_flag . '.' . $table_field . '")}}:</strong>
                            {!! Form::number(\'' . $table_field . '\',"", array(\'placeholder\' => "00.000",\'class\' => \'form-control\',\'step\' => "0.100")) !!}
                        </div>
                    </div>';
                }
                elseif($input[$table_field.'_datatype'] == 'varchar'){
                    $new_line = ' <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("' . $section_flag . '.' . $table_field . '")}}:</strong>
                            {!! Form::text(\'' . $table_field . '\', "", array(\'placeholder\' => trans("' . $section_flag . '.' . $table_field . '"),\'class\' => \'form-control\')) !!}
                        </div>
                    </div>';
                }
                elseif($input[$table_field.'_datatype'] == 'textarea'){
                    $new_line = '
                   <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("' . $section_flag . '.' . $table_field . '")}}:</strong>
                            {!! Form::textarea(\'' . $table_field . '\',old(\'' . $table_field . '\'), array(\'placeholder\' => trans("' . $section_flag . '.' . $table_field . '"),\'class\' => \'form-control\')) !!}
                        </div>
                    </div>';
                }
                elseif($input[$table_field.'_datatype'] == 'HTMLtextarea'){
                    $new_line = '
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("' . $section_flag . '.' . $table_field . '")}}:</strong>
                            <textarea name="' . $table_field . '" id="' . $table_field . '" >
                            {{ old(\'' . $table_field . '\') }}</textarea>
                        </div>
                    </div>
                    <script>
                        $(\'#' . $table_field . '\').richText({});
                    </script>

                    ';
                }

                elseif($input[$table_field.'_datatype'] == 'date'){
                    $new_line = ' <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("' . $section_flag . '.' . $table_field . '")}}:</strong>
                            {!! Form::date(\'' . $table_field . '\',"", array(\'placeholder\' => trans("' . $section_flag . '.' . $table_field . '"),\'class\' => \'form-control\')) !!}
                        </div>
                    </div>';
                }
                elseif($input[$table_field.'_datatype'] == 'time'){
                    $new_line = ' <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("' . $section_flag . '.' . $table_field . '")}}:</strong>
                            {!! Form::time(\'' . $table_field . '\',"", array(\'placeholder\' => trans("' . $section_flag . '.' . $table_field . '"),\'class\' => \'form-control\')) !!}
                        </div>
                    </div>';
                }
                elseif($input[$table_field.'_datatype'] == 'datetime'){
                    $new_line = ' <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("' . $section_flag . '.' . $table_field . '")}}  التاريخ :</strong>
                            {!! Form::date(\'' . $table_field . '_date\',"", array(\'placeholder\' => trans("' . $section_flag . '.' . $table_field .  ' "),\'class\' => \'form-control\')) !!}
                        </div>
                    </div>
                     <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("' . $section_flag . '.' . $table_field . '")}}  الوقت :</strong>
                            {!! Form::time(\'' . $table_field . '_time\',"", array(\'placeholder\' => trans("' . $section_flag . '.' . $table_field .  ' "),\'class\' => \'form-control\')) !!}
                        </div>
                    </div>
                    ';
                }
                elseif($input[$table_field.'_datatype'] == 'image'){
                    $new_line = '<div class="col-xs-12 col-sm-12 col-md-12 nopadding">

                            <div class="form-group">
                            <strong>{{trans("' . $section_flag . '.' . $table_field . '")}}:</strong>
                            <br>
                             <div class="col-md-12  text-center">
                              <img src="{{url(\'storage/images/noimage.png\')}}" class="uploaded_image"
                     alt="' . $table_field . '-Image" id="' . $table_field . '_image">
                <input type="file" name="' . $table_field . '" id="' . $table_field . '_input"
                onchange="putImage(\'' . $table_field . '_input\',\'' . $table_field . '_image\',
                \'change_' . $table_field . '_btn\')"
                name="image" class="inputfile_file">
                </div>

                 <div class="col-md-12  text-center top-marging-15">
                <button type="button" class="btn btn-outline-primary"
                onclick="OpenImgUpload(\'' . $table_field . '_input\',\'change_' . $table_field . '_btn\')">
                {{trans(\'admin.Upload\')}}
                </button>
                </div>


                        </div></div>';
                }
                elseif($input[$table_field.'_datatype'] == 'file'){
                    $new_line = '<div class="col-xs-12 col-sm-12 col-md-12 nopadding">

                            <div class="form-group">
                            <strong>{{trans("' . $section_flag . '.' . $table_field . '")}}:</strong><br>
                            <input type="file" id="' . $table_field . '" name="' . $table_field . '" class="file">

                        </div></div>';


                    $fotter_Mfiles_script.='
<script type="text/javascript">

        $("#' . $table_field . '").fileinput(
            {
                showUpload:false,
                maxFileSize:25600,
                maxFilePreviewSize:25600,
                maxFileCount:20,
                showDownload: true,
                showRemove: true,
                allowedFileTypes:["image", "text", "video", "audio","pdf"],
                msgPlaceholder : "{{trans(\'admin.Select file..\')}}",
                msgSelected : "{{trans(\'admin.msgSelected\')}}",
                msgProcessing : "{{trans(\'admin.msgProcessing\')}}",
                removeTitle : "{{trans(\'admin.removeTitle\')}}",
                uploadTitle : "{{trans(\'admin.uploadTitle\')}}",
                downloadTitle : "{{trans(\'admin.downloadTitle\')}}",
                zoomTitle : "{{trans(\'admin.zoomTitle\')}}",
                dragTitle : "{{trans(\'admin.dragTitle\')}}",
                msgNo : "{{trans(\'admin.msgNo\')}}",
                msgNoFilesSelected : "{{trans(\'admin.msgNoFilesSelected\')}}",
                msgCancelled : "{{trans(\'admin.msgCancelled\')}}",
                msgPaused : "{{trans(\'admin.msgPaused\')}}",
                msgZoomTitle : "{{trans(\'admin.msgZoomTitle\')}}",
                msgZoomModalHeading : "{{trans(\'admin.msgZoomModalHeading\')}}",
                msgFileRequired : "{{trans(\'admin.msgFileRequired\')}}",
                browseLabel : "{{trans(\'admin.browseLabel\')}}",
                removeLabel : "{{trans(\'admin.removeLabel\')}}",
                dropZoneTitle : "{{trans(\'admin.dropZoneTitle\')}}",

            }
        );
    </script> ';


                }
//                elseif($input[$table_field.'_datatype'] == 'file'){
//                    $new_line = '<div class="col-xs-12 col-sm-12 col-md-12 nopadding">
//                        <div class="col-xs-6 col-sm-6 col-md-6">
//                            <div class="form-group">
//                            <strong>{{trans("' . $section_flag . '.' . $table_field . '")}}:</strong>
//                            {!! Form::file(\'' . $table_field . '\', null, array(\'placeholder\' => trans("' . $section_flag . '.' . $table_field . '"),\'class\' => \'form-control\')) !!}
//                          </div>
//                        </div></div>';
//                }
                elseif($input[$table_field.'_datatype']=='select'){
                    $new_line=' <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{trans("'.$section_flag.'.'.$table_field.'")}}:</strong>
                                {!!Form::select(\''.$table_field.'\', [\'text\',\'text\'],"", [\'class\' => \'form-control\'])!!}
                            </div>
                        </div>';
                }

                elseif($input[$table_field.'_datatype']=='enum_selector'){

                    $selector_array= $input[$table_field.'_selector_items'];
                    $selector_array=explode(',', $selector_array);
                    $selector_options='';
                    foreach ($selector_array as $selector_en){
                        $selector_options.='
                        <option value="'.$selector_en.'"
                        @if(old(\''.$table_field.'\')=="'.$selector_en.'")!=null)
                            @if(old(\''.$table_field.'\')=="'.$selector_en.'")
                            selected
                            @endif
                        @endif
                        >{{trans(\''.$section_flag.'.'.$selector_en.'\')}}</option>
                        ';
                    }


                    $new_line='<div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                        <div class="box">
                            <strong>{{trans("'.$section_flag.'.'.$table_field.'")}}:</strong>
                            <select class="wide form-control" id="'.$table_field.'" name="'.$table_field.'">
                                '.$selector_options.'
                            </select>
                        </div>
                        <script>
                            $(document).ready(function() {
                                $("#'.$table_field.':not(.ignore)").niceSelect();
                                //FastClick.attach(document.body);
                            });
                        </script>
                        <br><br>
                    </div>
                        </div>';
                }

                elseif($input[$table_field.'_datatype']=='select_niceSelector'){
                    $new_line='<div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                        <div class="box">
                            <strong>{{trans("'.$section_flag.'.'.$table_field.'")}}:</strong>
                            <select class="wide form-control" id="'.$table_field.'" name="'.$table_field.'">
                                <option value="1">الخيار الاول</option>
                                <option value="2">الخيار الثاني</option>
                                <option value="2">الخيار الثاني</option>
                                <option value="2">الخيار الثاني</option>
                                <option value="2">الخيار الثاني</option>
                                <option value="2">الخيار الثاني</option>
                            </select>
                        </div>
                        <script>
                            $(document).ready(function() {
                                $("#'.$table_field.':not(.ignore)").niceSelect();
                                //FastClick.attach(document.body);
                            });
                        </script>
                        <br><br>
                    </div>
                        </div>';
                }
                elseif($input[$table_field.'_datatype']=='select_with_search'){
                    $new_line='<div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                <div>
                                    <strong>{{trans("'.$section_flag.'.'.$table_field.'")}}:</strong>
                                    <select id="'.$table_field.'" name="'.$table_field.'" data-placeholder="Choose a Country..." class="form-control chosen-select" tabindex="2">
                                        <option value="Antarctica">Antarctica</option>
                                        <option value="Argentina">Argentina</option>
                                        <option value="Armenia">Armenia</option>
                                        <option value="Ecuador">Ecuador</option>
                                        <option value="Egypt">Egypt</option>
                                    </select>
                                </div>
                                <br><br>
                            </div>
                        </div>';
                }
                elseif($input[$table_field.'_datatype']=='is_checkbox'){
                    $new_line='<div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("'.$section_flag.'.'.$table_field.'")}}:</strong>
                            <input type="checkbox" name="'.$table_field.'" class="form-control"

                            @if(old(\''.$table_field.'\') != null)
                               @if(old(\''.$table_field.'\')=="on")
                               checked
                               @endif
                           @endif


                          >
                        </div>
                    </div>';
                }
                elseif($input[$table_field.'_datatype']=='is_switch'){
                    $new_line='<div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("'.$section_flag.'.'.$table_field.'")}}:</strong> <br>
                            <input type="checkbox" name="'.$table_field.'" class="js-switch"

                            @if(old(\''.$table_field.'\') != null)
                               @if(old(\''.$table_field.'\')=="on")
                               checked
                               @endif
                           @endif


                          >
                        </div>
                    </div>';
                }

                elseif($input[$table_field.'_datatype']=='order_status'){
                    $new_line=' <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{trans("'.$section_flag.'.'.$table_field.'")}}:</strong>
                                {!!Form::select(\''.$table_field.'\', [\'pending\' => "في الانتظار",\'processing\' => "جاري تنفيذ الطلب",\'completed\' => "تم تنفيذ الطلب",\'cant_process\' => "لا يمكن تنفيذ الطلب"], "", [\'class\' => \'form-control\'])!!}
                            </div>
                        </div>';
                }
                elseif($input[$table_field.'_datatype']=='join_select'){
                    $joined_table=$input[$table_field.'_joinedTable'];
                    $data=DB::table($joined_table)->select('id')->get();

                    $selector=[];
                    $selectorNew='';
                    $comma='';
                    foreach ($data as $info){
                        array_push($selector,$info->id);
                        $selectorNew.=$comma.$info->id.'=>'.$info->id;
                        $comma=',';
                    }
                    $selectorNew="[".$selectorNew."]";
                    $new_line=' <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>{{trans("'.$section_flag.'.'.$table_field.'")}}:</strong>
                                {!!Form::select(\''.$table_field.'\', $'.$joined_table.', null, [\'class\' => \'form-control\'])!!}
                            </div>
                        </div>';
                }
                elseif($input[$table_field.'_datatype']=='table_to_select'){
                    $joined_table=$input[$table_field.'_joinedTable'];
                    $joined_table_field_name=$input[$table_field.'_joinedTable_field'];


//                    $joined_table_field_name = $joined_table_field_name;
//                    if(str_contains($joined_table_field_name,'_ar') || str_contains($joined_table_field_name,'_en')){
//                        $joined_table_field_name = str_replace('_ar','',$joined_table_field_name);
//                        $joined_table_field_name = str_replace('_en','',$joined_table_field_name);
//                        $joined_table_field_name='{\''.$joined_table_field_name.'_\'.$lang} ';
//                    }

                    $data=DB::table($joined_table)->get();
                    $selector=[];
                    $selectorNew='';
                    $comma='';
                    foreach ($data as $info){
                        array_push($selector,$info->{$joined_table_field_name});
                        $selectorNew.=$comma.$info->id.'=>'.$info->{$joined_table_field_name};
                        $comma=',';
                    }
                    $selectorNew="[".$selectorNew."]";
                    $new_line=' <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>{{trans("'.$section_flag.'.'.$table_field.'")}}:</strong>
                                {!!Form::select(\''.$table_field.'\', $'.$joined_table.', "old(\''.$table_field.'\')", [\'class\' => \'form-control  chosen-select\'])!!}
                            </div>
                        </div>';
                }
                elseif($input[$table_field.'_datatype']=='table_to_checkbox'){
                    $joined_table=$input[$table_field.'_joinedTable'];
                    $joined_table_field_name=$input[$table_field.'_joinedTable_field'];

                    $joined_table_field_name = $joined_table_field_name;
                    if(str_contains($joined_table_field_name,'_ar') || str_contains($joined_table_field_name,'_en')){
                        $joined_table_field_name = str_replace('_ar','',$joined_table_field_name);
                        $joined_table_field_name = str_replace('_en','',$joined_table_field_name);
                        $joined_table_field_name='{\''.$joined_table_field_name.'_\'.$lang} ';
                    }

                    $new_line=' <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{trans("'.$section_flag.'.'.$table_field.'")}}:</strong><br>
                 @foreach($'.$joined_table.' as $info)
                    <input type="checkbox" name="'.$table_field.'[]"

                    @if(old(\''.$table_field.'\') != null)
                               @if(in_array($info->id,old(\''.$table_field.'\')))
                               checked
                               @endif
                           @endif

                    value="{{$info->id}}" >
                    {{$info->'.$joined_table_field_name.'}}
                @endforeach
                            </div>
                        </div>';
                }
                elseif($input[$table_field.'_datatype']=='table_to_tagInput' || $input[$table_field.'_datatype'] == 'table_to_table'){
                    $joined_table=$input[$table_field.'_joinedTable'];
                    $joined_table_field_name=$input[$table_field.'_joinedTable_field'];
                    $new_line='<div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{trans("'.$section_flag.'.'.$table_field.'")}}:</strong><br>
                                <input id="'.$table_field.'" name="'.$table_field.'" type="text" value="">
                            <script type="text/javascript">
                                '.$joined_table.'_autoComplete = [];
                                $(function() {
                                    $(\'#'.$table_field.'\').tagsInput({
                                        \'onAddTag\': function(input, value) {
                                            check'.$joined_table.'_for_'.$table_name.'_forField'.$table_field.'(value,function(result){
                                                if(result == "true"){
                                                }
                                                else{
                                                    $(\'#'.$table_field.'\').removeTag(value)
                                                    $(\'#'.$table_field.'_tag\').val(value)
                                                    $(\'#'.$table_field.'_tag\').addClass("error")
                                                    $(\'#'.$table_field.'_tag\').trigger(\'focus\');
                                                }
                                            });
                                        },
                                        \'autocomplete\': {
                                            source: '.$joined_table.'_autoComplete
                                        },
                                    });
                                    $("#'.$table_field.'_tag").on("input", function(){
                                        if( $("#'.$table_field.'_tag").val().length >= 3){
                                            search'.$joined_table.'_for_'.$table_name.'_forField'.$table_field.'($(this).val(),function(result){
                                                '.$joined_table.'_autoComplete.length=0;
                                                for (var i = 0; i < result.length; i++) {
                                                    '.$joined_table.'_autoComplete.push(result[i])
                                                }
                                            });
                                        }
                                    });
                                });

                                function check'.$joined_table.'_for_'.$table_name.'_forField'.$table_field.'('.$joined_table_field_name.',successCallback){
                                    var _token = \'<?php echo csrf_token() ?>\';
                                    var res = "false";

                                    $.ajax({
                                        url: "{{url("admin/check'.$joined_table.'_for_'.$table_name.'_forField'.$table_field.'")}}",
                                        type: "post",
                                        async: false,
                                        data:{
                                            '.$joined_table_field_name.':'.$joined_table_field_name.',
                                            _token:_token
                                        },
                                        success: function(response) {
                                            res = response;
                                            successCallback(res);
                                        },
                                    });
                                }

                                function search'.$joined_table.'_for_'.$table_name.'_forField'.$table_field.'(search_text,successCallback){
                                    var _token = \'<?php echo csrf_token() ?>\';
                                    var search_res = [];

                                    $.ajax({
                                        url: "{{url("admin/search'.$joined_table.'_for_'.$table_name.'_forField'.$table_field.'")}}",
                                        type: "post",
                                        async: false,
                                        data:{
                                            search_text:search_text,
                                            _token:_token
                                        },
                                        success: function(response) {
                                            search_res = response;
                                            successCallback(search_res);
                                        },
                                    });
                                }
                            </script>
                             </div>
                        </div>';
                }
                elseif($input[$table_field.'_datatype']=='active'){
//                    $new_line=' <div class="col-xs-12 col-sm-12 col-md-12">
//                            <div class="form-group">
//                                <strong>{{trans("'.$section_flag.'.'.$table_field.'")}}:</strong>
//                                {!!Form::select(\''.$table_field.'\', [\'غير مفعل\',\'مفعل\'], null, [\'class\' => \'form-control\'])!!}
//                            </div>
//                        </div>';


                    $new_line='<div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                        <div class="box">
                            <strong>{{trans("'.$section_flag.'.'.$table_field.'")}}:</strong>
                               <select class="wide form-control" id="' . $table_field . '" name="' . $table_field . '">
                                <option value="1" @if(old(\''.$table_field.'\')=="1") selected @endif>
                                    {{trans(\'admin.active\')}}</option>
                                <option value="0" @if(old(\''.$table_field.'\')=="0") selected @endif>
                                    {{trans(\'admin.inactive\')}}
                                </option>
                                </select>


                        </div>
                        <script>
                            $(document).ready(function() {
                                $("#'.$table_field.':not(.ignore)").niceSelect();
                                //FastClick.attach(document.body);
                            });
                        </script>
                        <br><br>
                    </div>
                        </div>';
                }
                elseif($input[$table_field.'_datatype']=='sort'){
                    $new_line=' <div class="col-md-3">
                            <div class="form-group">
                                <strong>{{trans("'.$section_flag.'.'.$table_field.'")}}:</strong>
                                {!! Form::number(\''.$table_field.'\',$sort_number, array(\'placeholder\' => trans("'.$section_flag.'.'.$table_field.'"),\'class\' => \'form-control\')) !!}
                            </div>
                        </div>';
                }
                else{
                    $new_line = ' <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("' . $section_flag . '.' . $table_field . '")}}:</strong>
                            {!! Form::text(\'' . $table_field . '\', old(\''.$table_field.'\'), array(\'placeholder\' => trans("' . $section_flag . '.' . $table_field . '"),\'class\' => \'form-control\')) !!}
                        </div>
                    </div>';
                }

                $form_content=$form_content."
                ".$new_line."
                ";
            }

        }


        // this code only if module has multiple files or images

        if($input['table_has_multiple_images']==1 || $input['table_has_multiple_files']==1){
            $multiplefiles_script='
        @section(\'header\')
    <link href="{{url(\'admin/assets/css/fileinput.css\')}}" media="all" rel="stylesheet" type="text/css" />
    <script src="{{url(\'admin/assets/js/fileinput.js\')}}" type="text/javascript"></script>
    <script src="{{url(\'admin/assets/js/theme.js\')}}" type="text/javascript"></script>
@stop
        ';

        }
        if($input['table_has_multiple_images']==1){
            $fotter_Mfiles_script=$fotter_Mfiles_script.'

            <script !src="">
            $("#images").fileinput({
                showUpload:false,
                maxFileSize:25600,
                maxFilePreviewSize:25600,
                maxFileCount:20,
                showDownload: true,
                showRemove: true,
                msgPlaceholder : "{{trans(\'admin.Select file..\')}}",
                msgSelected : "{{trans(\'admin.msgSelected\')}}",
                msgProcessing : "{{trans(\'admin.msgProcessing\')}}",
                removeTitle : "{{trans(\'admin.removeTitle\')}}",
                uploadTitle : "{{trans(\'admin.uploadTitle\')}}",
                downloadTitle : "{{trans(\'admin.downloadTitle\')}}",
                zoomTitle : "{{trans(\'admin.zoomTitle\')}}",
                dragTitle : "{{trans(\'admin.dragTitle\')}}",
                msgNo : "{{trans(\'admin.msgNo\')}}",
                msgNoFilesSelected : "{{trans(\'admin.msgNoFilesSelected\')}}",
                msgCancelled : "{{trans(\'admin.msgCancelled\')}}",
                msgPaused : "{{trans(\'admin.msgPaused\')}}",
                msgZoomTitle : "{{trans(\'admin.msgZoomTitle\')}}",
                msgZoomModalHeading : "{{trans(\'admin.msgZoomModalHeading\')}}",
                msgFileRequired : "{{trans(\'admin.msgFileRequired\')}}",
                browseLabel : "{{trans(\'admin.browseLabel\')}}",
                removeLabel : "{{trans(\'admin.removeLabel\')}}",
                dropZoneTitle : "{{trans(\'admin.dropZoneTitle\')}}",

            });
            $(\'.file-preview-frame\').click(function () {
                $(this).hide();
                $(\'.file-error-message\').hide();
                $(\'.kv-fileinput-error\').hide();
            });

             </script>';


            $html_Mfiles_script=$html_Mfiles_script.'
            <div class="form-group col-md-12">
            <label for="images">{{trans(\'admin.images\')}}</label>
            <div class="file-loading">
                <input id="images" name="images[]" type="file" multiple class="file" data-overwrite-initial="false"
                       >
            </div>
            </div>
            ';
        }
        if($input['table_has_multiple_files']==1){
            $fotter_Mfiles_script=$fotter_Mfiles_script.'<script !src="">
            $("#files").fileinput({
                showUpload:false,
                maxFileSize:25600,
                maxFilePreviewSize:25600,
                maxFileCount:20,
                showDownload: true,
                showRemove: true,
                msgPlaceholder : "{{trans(\'admin.Select file..\')}}",
                msgSelected : "{{trans(\'admin.msgSelected\')}}",
                msgProcessing : "{{trans(\'admin.msgProcessing\')}}",
                removeTitle : "{{trans(\'admin.removeTitle\')}}",
                uploadTitle : "{{trans(\'admin.uploadTitle\')}}",
                downloadTitle : "{{trans(\'admin.downloadTitle\')}}",
                zoomTitle : "{{trans(\'admin.zoomTitle\')}}",
                dragTitle : "{{trans(\'admin.dragTitle\')}}",
                msgNo : "{{trans(\'admin.msgNo\')}}",
                msgNoFilesSelected : "{{trans(\'admin.msgNoFilesSelected\')}}",
                msgCancelled : "{{trans(\'admin.msgCancelled\')}}",
                msgPaused : "{{trans(\'admin.msgPaused\')}}",
                msgZoomTitle : "{{trans(\'admin.msgZoomTitle\')}}",
                msgZoomModalHeading : "{{trans(\'admin.msgZoomModalHeading\')}}",
                msgFileRequired : "{{trans(\'admin.msgFileRequired\')}}",
                browseLabel : "{{trans(\'admin.browseLabel\')}}",
                removeLabel : "{{trans(\'admin.removeLabel\')}}",
                dropZoneTitle : "{{trans(\'admin.dropZoneTitle\')}}",

            });
            $(\'.file-preview-frame\').click(function () {
                $(this).hide();
                $(\'.file-error-message\').hide();
                $(\'.kv-fileinput-error\').hide();
            });

             </script>';

            $html_Mfiles_script=$html_Mfiles_script.'
            <div class="form-group col-md-12">
            <label for="images">{{trans(\'admin.files\')}}</label>
            <div class="file-loading">
                <input id="files" name="files[]" type="file" multiple class="file" data-overwrite-initial="false"
                       >
            </div>
            </div>
            ';
        }


        $page_content='@extends(\'backend.layouts.app\')
'.$multiplefiles_script.'


@section(\'title\',trans(\''.$section_flag.'.Admin - '.$section_flag.'\'))
@section(\'header\')
@endsection

@section(\'content\')


<?php $lang=App::getLocale(); ?>

<!-- [ breadcrumb ] start -->
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="'.$input['section_icon'].' bg-c-blue"></i>
                    <div class="d-inline">
                        <h5>{{trans(\''.$section_flag.'.Admin - '.$section_flag.'\')}}</h5>
                        <span>{{trans(\'admin.manage and control all system sides\')}}
                             </span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class=" breadcrumb breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{url(\'admin/dashboard\')}}"><i class="feather icon-home"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">{{trans(\''.$section_flag.'.'.$section_flag.'\')}}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- [ breadcrumb ] end -->
<div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <!-- [ page content ] start -->
                    <div class="row">
                        <div class="col-sm-12">


    <div class="card">
                                <div class="card-header">
                                    <h5>{{trans(\''.$section_flag.'.Admin - '.$section_flag.'\')}}</h5>
                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>
                                            <li><i class="feather icon-maximize full-card"></i></li>
                                            <li><i class="feather icon-minus minimize-card"></i></li>
                                            <li><i class="feather icon-refresh-cw reload-card"></i></li>
                                            <li><i class="feather icon-trash close-card"></i></li>                                                                 <li><i class="feather icon-chevron-left open-card-option"></i></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-block">

    <div class="wrapper_cols">
        <div class="col_page_content">
            <div class="row">

        <div class="col-lg-12">
           <br>
                <h4>{{trans(\'admin.Create\')}}</h4>
        </div>
        <div class="col-md-12 ">
        <div class="align_btn_end">
                <a class="btn btn-primary" href="{{ route(\''.$section_flag.'.index\') }}">
                {{trans(\'admin.back\')}}</a>
            </div>
        </div>
    </div>




    {!! Form::open(array(\'enctype\'=>\'multipart/form-data\',\'route\' => \''.$section_flag.'.store\',
    \'method\'=>\'POST\',
    \'id\'=>\'form\')) !!}
    <input type="text" name="save_type" id="save_type" value="save" class="hidden">

    <div class="row">


    '.$form_content.'




        '.$html_Mfiles_script.'
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">{{trans(\'admin.save\')}}</button>
            <button type="button"  onclick="
            $(\'#save_type\').val(\'save_and_add_new\');
                document.getElementById(\'form\').submit();
                return false
            " class="btn btn-primary">{{trans(\'admin.save_and_addNew\')}}</button>
        </div>
    </div>
    {!! Form::close() !!}
            </div>
        </div>
    </div>


    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>

 <script>
                                $(document).ready(function() {
                                    $("input").keydown(function(event){
                                        if(event.keyCode == 13) {
                                            event.preventDefault();
                                            $("form").submit();
                                            // return false;
                                        }
                                    });
                                });
                            </script>




@endsection

@section(\'footer\')
'.$fotter_Mfiles_script.'
@endsection

';

        $file = 'create.blade.php';
        $destinationPath="resources/views/backend/".$section_flag."/";
        if (!is_dir($destinationPath)) {  mkdir($destinationPath,0777,true);  }
        File::put($destinationPath.$file,$page_content);

        /******************************/
        /******End create page Content******/
        /******************************/

    }

    public function CreateUpdatePage($table_fields,$table_name,$section_flag,$module_name,$input,$Capital_table_name){

        /******************************/
        /******start Edit page Content******/
        /******************************/



        $multiplefiles_script='';
        $fotter_Mfiles_script='';
        $html_Mfiles_script='';

        //declare get form inputs and its type
        $form_content='';
        foreach ($table_fields as $table_field){
            //get input type for each parameter

            if(isset($input[$table_field.'_adminview'])){
                if($input[$table_field.'_datatype'] == 'number' && $table_field=='id' ){
                    $new_line = '
                   <div class="col-xs-12 col-sm-12 col-md-12 nopadding">
                   <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("' . $section_flag . '.' . $table_field . '")}}:</strong>
                            {!! Form::number(\'' . $table_field . '\', $' . $module_name . '->' . $table_field . ', array(\'placeholder\' => trans("' . $section_flag . '.' . $table_field . '"),\'class\' => \'form-control\')) !!}
                        </div>
                    </div></div>';
                }
                elseif($input[$table_field.'_datatype'] == 'number'){
                    $new_line = ' <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("' . $section_flag . '.' . $table_field . '")}}:</strong>
                            {!! Form::number(\'' . $table_field . '\',$' . $module_name . '->' . $table_field . ', array(\'placeholder\' => trans("' . $section_flag . '.' . $table_field . '"),\'class\' => \'form-control\')) !!}
                        </div>
                    </div>';
                }
                elseif($input[$table_field.'_datatype'] == 'price'){
                    $new_line = ' <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("' . $section_flag . '.' . $table_field . '")}}:</strong>
                            {!! Form::number(\'' . $table_field . '\', $' . $module_name . '->' . $table_field . ', array(\'placeholder\' => trans("' . $section_flag . '.' . $table_field . '"),\'class\' => \'form-control\',\'step\' => "0.100")) !!}
                        </div>
                    </div>';
                }
                elseif($input[$table_field.'_datatype'] == 'varchar'){
                    $new_line = ' <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("' . $section_flag . '.' . $table_field . '")}}:</strong>
                            {!! Form::text(\'' . $table_field . '\', $' . $module_name . '->' . $table_field . ', array(\'placeholder\' => trans("' . $section_flag . '.' . $table_field . '"),\'class\' => \'form-control\')) !!}
                        </div>
                    </div>';
                }
                elseif($input[$table_field.'_datatype'] == 'textarea'){
                    $new_line = '
                   <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("' . $section_flag . '.' . $table_field . '")}}:</strong>
                            {!! Form::textarea(\'' . $table_field . '\',$' . $module_name . '->' . $table_field . ', array(\'placeholder\' => trans("' . $section_flag . '.' . $table_field . '"),\'class\' => \'form-control\')) !!}
                        </div>
                    </div>';
                }
                elseif($input[$table_field.'_datatype'] == 'HTMLtextarea'){
                    $new_line = '
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>{{trans("' . $section_flag . '.' . $table_field . '")}}:</strong>
                            <textarea name="' . $table_field . '" id="' . $table_field . '" >
                            @if(old(\'' . $table_field . '\') != null)
                            {{ old(\'' . $table_field . '\') }}
                            @else
                            {{$' . $module_name . '->' . $table_field . '}}
                            @endif
                            </textarea>
                        </div>
                    </div>
                     <script>
                        $(\'#' . $table_field . '\').richText({});
                    </script>
                    ';
                }

                elseif($input[$table_field.'_datatype'] == 'date'){
                    $new_line = ' <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("' . $section_flag . '.' . $table_field . '")}}:</strong>
                            {!! Form::date(\'' . $table_field . '\',$' . $module_name . '->' . $table_field . ', array(\'placeholder\' => trans("' . $section_flag . '.' . $table_field . '"),\'class\' => \'form-control\')) !!}
                        </div>
                    </div>';
                }
                elseif($input[$table_field.'_datatype'] == 'time'){
                    $new_line = ' <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("' . $section_flag . '.' . $table_field . '")}}:</strong>
                            {!! Form::time(\'' . $table_field . '\', $' . $module_name . '->' . $table_field . ', array(\'placeholder\' => trans("' . $section_flag . '.' . $table_field . '"),\'class\' => \'form-control\')) !!}
                        </div>
                    </div>';
                }
                elseif($input[$table_field.'_datatype'] == 'datetime'){
                    $new_line = ' <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("' . $section_flag . '.' . $table_field . '")}}  التاريخ :</strong>
                            {!! Form::date(\'' .  $table_field . '_date\',  date(\'Y-m-d\',strtotime($' . $module_name . '->' . $table_field . '))  , array(\'placeholder\' => trans("' . $section_flag . '.' . $table_field .  ' "),\'class\' => \'form-control\')) !!}
                        </div>
                    </div>
                     <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("' . $section_flag . '.' . $table_field . '")}}  الوقت :</strong>
                            {!! Form::time(\'' . $table_field . '_time\', date(\'H:i\',strtotime($' . $module_name . '->' . $table_field . ')), array(\'placeholder\' => trans("' . $section_flag . '.' . $table_field .  ' "),\'class\' => \'form-control\')) !!}
                        </div>
                    </div>
                    ';
                }
                elseif($input[$table_field.'_datatype'] == 'image'){

                    $new_line = '<div class="col-xs-12 col-sm-12 col-md-12 nopadding">
                            <div class="form-group">
                            <strong>{{trans("' . $section_flag . '.' . $table_field . '")}}:</strong>
                            <br>
                             <div class="col-md-12  text-center">

                             @if(isset($' . $module_name . '->' . $table_field . '))
                                <img  src="{{url($'.$module_name.'->' . $table_field . ')}}"  class="uploaded_image"
                     alt="' . $table_field . '-Image" id="' . $table_field . '_image">
                            @else
                            <img  src="{{url(\'storage/images/noimage.png\')}}"  class="uploaded_image"
                     alt="' . $table_field . '-Image" id="' . $table_field . '_image">
                            @endif


                <input type="file" name="' . $table_field . '" id="' . $table_field . '_input"
                onchange="putImage(\'' . $table_field . '_input\',\'' . $table_field . '_image\',
                \'change_' . $table_field . '_btn\')"
                name="image" class="inputfile_file">
                </div>

                 <div class="col-md-12  text-center top-marging-15">
                <button type="button" class="btn btn-outline-primary"
                onclick="OpenImgUpload(\'' . $table_field . '_input\',\'change_' . $table_field . '_btn\')">
                {{trans(\'admin.Upload\')}}
                </button>
                </div>
                        </div></div>';

//                    $new_line = ' <div class="col-xs-12 col-sm-12 col-md-12 nopadding">
//                        <div class="col-xs-6 col-sm-6 col-md-6">
//                        <div class="form-group">
//                            <strong>{{trans("' . $section_flag . '.' . $table_field . '")}}:</strong>
//                            <div class="col-12">
//                            @if(isset($' . $module_name . '->' . $table_field . '))
//                                <img class="img-responsive" src="{{url($'.$module_name.'->' . $table_field . ')}}" alt="">
//                            @endif
//                            </div>
//                            {!! Form::file(\''.$table_field.'\', null, array(\'class\' => \'form-control\',\'disabled\')) !!}
//                                       </div>
//                        </div></div>';
                }
                elseif($input[$table_field.'_datatype'] == 'file'){
                    $new_line = ' <div class="col-xs-12 col-sm-12 col-md-12 nopadding">

                        <div class="form-group">
                            <strong>{{trans("' . $section_flag . '.' . $table_field . '")}}:</strong>
                            <br>

                             <input type="file" id="' . $table_field . '" name="' . $table_field . '" class="file">
                                       </div>
                        </div>
                        ';





                    $fotter_Mfiles_script.='
<script type="text/javascript">
        // initial satate for file or image #####
            var url = [];
            var initialPreviewConfig = [];
           url.push("{{url($' . $module_name . '->' . $table_field . ')}}");
            initialPreviewConfig.push(
            {filename: "' . $table_field . '",
            type:"{{$'.$table_field.'_filetype}}",
            downloadUrl: "{{url($' . $module_name . '->' . $table_field . ')}}", size: 930321,
            width: "120px",
             url: "", key: ""});
        // initialize plugin with defaults
        $("#' . $table_field . '").fileinput(
            {
                 showUpload:false,
                maxFileSize:25600,
                maxFilePreviewSize:25600,
                maxFileCount:20,
                showDownload: true,
                showRemove: true,
                initialPreview: url,
                initialPreviewAsData: true,
                initialPreviewConfig: initialPreviewConfig,
                msgPlaceholder : "{{trans(\'admin.Select file..\')}}",
                msgSelected : "{{trans(\'admin.msgSelected\')}}",
                msgProcessing : "{{trans(\'admin.msgProcessing\')}}",
                removeTitle : "{{trans(\'admin.removeTitle\')}}",
                uploadTitle : "{{trans(\'admin.uploadTitle\')}}",
                downloadTitle : "{{trans(\'admin.downloadTitle\')}}",
                zoomTitle : "{{trans(\'admin.zoomTitle\')}}",
                dragTitle : "{{trans(\'admin.dragTitle\')}}",
                msgNo : "{{trans(\'admin.msgNo\')}}",
                msgNoFilesSelected : "{{trans(\'admin.msgNoFilesSelected\')}}",
                msgCancelled : "{{trans(\'admin.msgCancelled\')}}",
                msgPaused : "{{trans(\'admin.msgPaused\')}}",
                msgZoomTitle : "{{trans(\'admin.msgZoomTitle\')}}",
                msgZoomModalHeading : "{{trans(\'admin.msgZoomModalHeading\')}}",
                msgFileRequired : "{{trans(\'admin.msgFileRequired\')}}",
                browseLabel : "{{trans(\'admin.browseLabel\')}}",
                removeLabel : "{{trans(\'admin.removeLabel\')}}",
                dropZoneTitle : "{{trans(\'admin.dropZoneTitle\')}}",
            }
        );
    </script> ';

                }
                elseif($input[$table_field.'_datatype']=='select'){
                    $new_line=' <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{trans("'.$section_flag.'.'.$table_field.'")}}:</strong>
                                {!!Form::select(\''.$table_field.'\', [\'text\',\'text\'],$' . $module_name . '->' . $table_field . ', [\'class\' => \'form-control\'])!!}
                            </div>
                        </div>';
                }

                elseif($input[$table_field.'_datatype']=='enum_selector'){

                    $selector_array= $input[$table_field.'_selector_items'];
                    $selector_array=explode(',', $selector_array);
                    $selector_options='';
                    foreach ($selector_array as $selector_en){
                        $selector_options.='
                        <option value="'.$selector_en.'"
                        @if(old(\''.$table_field.'\')=="'.$selector_en.'")!=null)
                            @if(old(\''.$table_field.'\')=="'.$selector_en.'")
                            selected
                            @endif
                        @else
                            @if($'.$module_name.'->'.$table_field.'=="'.$selector_en.'")
                            selected
                            @endif
                        @endif
                        >{{trans(\''.$section_flag.'.'.$selector_en.'\')}}</option>
                        ';
                    }


                    $new_line='<div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                        <div class="box">
                            <strong>{{trans("'.$section_flag.'.'.$table_field.'")}}:</strong>
                            <select class="wide form-control" id="'.$table_field.'" name="'.$table_field.'">
                                '.$selector_options.'
                            </select>
                        </div>
                        <script>
                            $(document).ready(function() {
                                $("#'.$table_field.':not(.ignore)").niceSelect();
                                //FastClick.attach(document.body);
                            });
                        </script>
                        <br><br>
                    </div>
                        </div>';
                }
                elseif($input[$table_field.'_datatype']=='select_niceSelector'){
                    $new_line='<div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                        <div class="box">
                            <strong>{{trans("'.$section_flag.'.'.$table_field.'")}}:</strong>
                            <select class="wide form-control"  id="'.$table_field.'" name="'.$table_field.'">
                                <option value="1" @if($'.$module_name.'->'.$table_field.'=="1") selected @endif>الخيار الاول</option>
                                <option value="2" @if($'.$module_name.'->'.$table_field.'=="2") selected @endif>الخيار الثاني</option>
                                <option value="3" @if($'.$module_name.'->'.$table_field.'=="3") selected @endif>الخيار الثالث</option>
                            </select>
                        </div>
                        <script>
                            $(document).ready(function() {
                                $("#'.$table_field.':not(.ignore)").niceSelect();
                                //FastClick.attach(document.body);
                            });
                        </script>
                        <br><br>
                    </div>
                        </div>';
                }
                elseif($input[$table_field.'_datatype']=='select_with_search'){
                    $new_line='<div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                <div>
                                    <strong>{{trans("b_tests.type")}}:</strong>
                                    <select  id="'.$table_field.'" name="'.$table_field.'" data-placeholder="Choose a Country..." class="form-control chosen-select" tabindex="2">
                                        <option value="Antarctica" @if($'.$module_name.'->'.$table_field.'=="Antarctica") selected @endif>Antarctica</option>
                                        <option value="Argentina" @if($'.$module_name.'->'.$table_field.'=="Argentina") selected @endif>Argentina</option>
                                        <option value="Armenia" @if($'.$module_name.'->'.$table_field.'=="Armenia") selected @endif >Armenia</option>
                                        <option value="Ecuador" @if($'.$module_name.'->'.$table_field.'=="Ecuador") selected @endif>Ecuador</option>
                                        <option value="Egypt" @if($'.$module_name.'->'.$table_field.'=="Egypt") selected @endif >Egypt</option>
                                    </select>
                                </div>
                                <br><br>
                            </div>
                        </div>';
                }
                elseif($input[$table_field.'_datatype']=='is_switch'){
                    $new_line='<div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("'.$section_flag.'.'.$table_field.'")}}:</strong>
                            <br>
                            <input type="checkbox" name="'.$table_field.'" class="js-switch"

                            @if(old(\''.$table_field.'\') != null)
                               @if(old(\''.$table_field.'\')=="on")
                               checked
                               @endif
                           @else
                                @if($'.$module_name.'->'.$table_field.'==1) checked @endif
                           @endif
                              >
                        </div>
                    </div>';
                }
                elseif($input[$table_field.'_datatype']=='order_status'){
                    $new_line=' <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{trans("'.$section_flag.'.'.$table_field.'")}}:</strong>
                                {!!Form::select(\''.$table_field.'\', [\'pending\' => "في الانتظار",\'processing\' => "جاري تنفيذ الطلب",\'completed\' => "تم تنفيذ الطلب",\'cant_process\' => "لا يمكن تنفيذ الطلب"], $' . $module_name . '->' . $table_field . ', [\'class\' => \'form-control\'])!!}
                            </div>
                        </div>';
                }
                elseif($input[$table_field.'_datatype']=='join_select'){
                    $joined_table=$input[$table_field.'_joinedTable'];
                    $new_line=' <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>{{trans("'.$section_flag.'.'.$table_field.'")}}:</strong>
                                {!!Form::select(\''.$table_field.'\', $'.$joined_table.', $' . $module_name . '->' . $table_field . ', [\'class\' => \'form-control\'])!!}
                            </div>
                        </div>';
                }
                elseif($input[$table_field.'_datatype']=='table_to_select'){
                    $joined_table=$input[$table_field.'_joinedTable'];
                    $joined_table_field_name=$input[$table_field.'_joinedTable_field'];
                    $data=DB::table($joined_table)->get();
                    $selector=[];
                    $selectorNew='';
                    $comma='';
                    foreach ($data as $info){
                        array_push($selector,$info->{$joined_table_field_name});
                        $selectorNew.=$comma.$info->id.'=>'.$info->{$joined_table_field_name};
                        $comma=',';
                    }
                    $selectorNew="[".$selectorNew."]";
                    $new_line=' <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>{{trans("'.$section_flag.'.'.$table_field.'")}}:</strong>
                                {!!Form::select(\''.$table_field.'\', $'.$joined_table.', $' . $module_name . '->' . $table_field . ', [\'class\' => \'form-control  chosen-select\'])!!}
                            </div>
                        </div>';
                }
                elseif($input[$table_field.'_datatype']=='table_to_checkbox'){
                    $joined_table=$input[$table_field.'_joinedTable'];
                    $joined_table_field_name=$input[$table_field.'_joinedTable_field'];

                    $joined_table_field_name = $joined_table_field_name;
                    if(str_contains($joined_table_field_name,'_ar') || str_contains($joined_table_field_name,'_en')){
                        $joined_table_field_name = str_replace('_ar','',$joined_table_field_name);
                        $joined_table_field_name = str_replace('_en','',$joined_table_field_name);
                        $joined_table_field_name='{\''.$joined_table_field_name.'_\'.$lang} ';
                    }

                    $new_line=' <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{trans("'.$section_flag.'.'.$table_field.'")}}:</strong><br>
                 @foreach($'.$joined_table.' as $info)
                    <input type="checkbox" name="'.$table_field.'[]" value="{{$info->id}}"

                    @if(old(\''.$table_field.'\') != null)
                               @if(in_array($info->id,old(\''.$table_field.'\')))
                               checked
                               @endif
                           @else
                                @if(in_array($info->id,$'.$module_name.'->'.$table_field.')) checked @endif
                           @endif

                      > {{$info->'.$joined_table_field_name.'}}
                @endforeach
                            </div>
                        </div>';
                }

                elseif($input[$table_field.'_datatype']=='table_to_tagInput' || $input[$table_field.'_datatype'] == 'table_to_table'){
                    $joined_table=$input[$table_field.'_joinedTable'];
                    $joined_table_field_name=$input[$table_field.'_joinedTable_field'];
                    $new_line='<div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{trans("'.$section_flag.'.'.$table_field.'")}}:</strong><br>
                                <input id="'.$table_field.'" name="'.$table_field.'" type="text" value="{{$'.$module_name.'->'.$table_field.'}}">
                            <script type="text/javascript">
                                '.$joined_table.'_autoComplete = [];
                                $(function() {
                                    $(\'#'.$table_field.'\').tagsInput({
                                        \'onAddTag\': function(input, value) {
                                            check'.$joined_table.'_for_'.$table_name.'_forField'.$table_field.'(value,function(result){
                                                if(result == "true"){
                                                }
                                                else{
                                                    $(\'#'.$table_field.'\').removeTag(value)
                                                    $(\'#'.$table_field.'_tag\').val(value)
                                                    $(\'#'.$table_field.'_tag\').addClass("error")
                                                    $(\'#'.$table_field.'_tag\').trigger(\'focus\');
                                                }
                                            });
                                        },
                                        \'autocomplete\': {
                                            source: '.$joined_table.'_autoComplete
                                        },
                                    });
                                    $("#'.$table_field.'_tag").on("input", function(){
                                        if( $("#'.$table_field.'_tag").val().length >= 3){
                                            search'.$joined_table.'_for_'.$table_name.'_forField'.$table_field.'($(this).val(),function(result){
                                                '.$joined_table.'_autoComplete.length=0;
                                                for (var i = 0; i < result.length; i++) {
                                                    '.$joined_table.'_autoComplete.push(result[i])
                                                }
                                            });
                                        }
                                    });
                                });

                                function check'.$joined_table.'_for_'.$table_name.'_forField'.$table_field.'('.$joined_table_field_name.',successCallback){
                                    var _token = \'<?php echo csrf_token() ?>\';
                                    var res = "false";

                                    $.ajax({
                                        url: "{{url("admin/check'.$joined_table.'_for_'.$table_name.'_forField'.$table_field.'")}}",
                                        type: "post",
                                        async: false,
                                        data:{
                                            '.$joined_table_field_name.':'.$joined_table_field_name.',
                                            _token:_token
                                        },
                                        success: function(response) {
                                            res = response;
                                            successCallback(res);
                                        },
                                    });
                                }

                                function search'.$joined_table.'_for_'.$table_name.'_forField'.$table_field.'(search_text,successCallback){
                                    var _token = \'<?php echo csrf_token() ?>\';
                                    var search_res = [];

                                    $.ajax({
                                        url: "{{url("admin/search'.$joined_table.'_for_'.$table_name.'_forField'.$table_field.'")}}",
                                        type: "post",
                                        async: false,
                                        data:{
                                            search_text:search_text,
                                            _token:_token
                                        },
                                        success: function(response) {
                                            search_res = response;
                                            successCallback(search_res);
                                        },
                                    });
                                }
                            </script>
                             </div>
                        </div>';
                }

                elseif($input[$table_field.'_datatype']=='active'){

                    $new_line='<div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                        <div class="box">
                            <strong>{{trans("'.$section_flag.'.'.$table_field.'")}}:</strong>
                            <select class="wide form-control" id="' . $table_field . '" name="' . $table_field . '">
                                <option value="1" @if($' . $module_name . '->' . $table_field . '=="1") selected @endif>
                                    {{trans(\'admin.active\')}}</option>
                                <option value="0" @if($' . $module_name . '->' . $table_field . ' !="1") selected @endif>
                                    {{trans(\'admin.inactive\')}}
                                </option>
                                </select>
                        </div>
                        <script>
                            $(document).ready(function() {
                                $("#'.$table_field.':not(.ignore)").niceSelect();
                                //FastClick.attach(document.body);
                            });
                        </script>
                        <br><br>
                    </div>
                        </div>';
                }
                elseif($input[$table_field.'_datatype']=='sort'){
                    $new_line=' <div class="col-md-3">
                            <div class="form-group">
                                <strong>{{trans("'.$section_flag.'.'.$table_field.'")}}:</strong>
                                {!! Form::number(\''.$table_field.'\',$' . $module_name . '->' . $table_field . ', array(\'placeholder\' => trans("'.$section_flag.'.'.$table_field.'"),\'class\' => \'form-control\')) !!}
                            </div>
                        </div>';
                }
                else{
                    $new_line = ' <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("' . $section_flag . '.' . $table_field . '")}}:</strong>
                            {!! Form::text(\'' . $table_field . '\', $' . $module_name . '->' . $table_field . ', array(\'placeholder\' => trans("' . $section_flag . '.' . $table_field . '"),\'class\' => \'form-control\')) !!}
                        </div>
                    </div>';
                }

                $form_content=$form_content."
                ".$new_line."
                ";
            }

        }


        // this code only if module has multiple files or images

        if($input['table_has_multiple_images']==1 || $input['table_has_multiple_files']==1){
            $multiplefiles_script='
        @section(\'header\')
    <link href="{{url(\'admin/assets/css/fileinput.css\')}}" media="all" rel="stylesheet" type="text/css" />
    <script src="{{url(\'admin/assets/js/fileinput.js\')}}" type="text/javascript"></script>
    <script src="{{url(\'admin/assets/js/theme.js\')}}" type="text/javascript"></script>
@stop
        ';

        }
        if($input['table_has_multiple_images']==1){
            $fotter_Mfiles_script=$fotter_Mfiles_script.'
    <script !src="">
        var url = [];
        var initialPreviewConfig = [];
    </script>
    @foreach($images as $image)
        <script type="text/javascript">
            url.push("{{url($image->image)}}");
            initialPreviewConfig.push({filename: "image", downloadUrl: "{{url($image->image)}}", size: 930321, width: "120px", url: "{{url(\'admin/delete'.$module_name.'images\')}}", key: "{{$image->id}}"});
        </script>
    @endforeach

            <script !src="">
            $("#images").fileinput({
                 showUpload:false,
                maxFileSize:25600,
                maxFilePreviewSize:25600,
                maxFileCount:20,
                showDownload: true,
                showRemove: true,
                initialPreview: url,
                initialPreviewAsData: true,
                initialPreviewConfig: initialPreviewConfig,
                msgPlaceholder : "{{trans(\'admin.Select file..\')}}",
                msgSelected : "{{trans(\'admin.msgSelected\')}}",
                msgProcessing : "{{trans(\'admin.msgProcessing\')}}",
                removeTitle : "{{trans(\'admin.removeTitle\')}}",
                uploadTitle : "{{trans(\'admin.uploadTitle\')}}",
                downloadTitle : "{{trans(\'admin.downloadTitle\')}}",
                zoomTitle : "{{trans(\'admin.zoomTitle\')}}",
                dragTitle : "{{trans(\'admin.dragTitle\')}}",
                msgNo : "{{trans(\'admin.msgNo\')}}",
                msgNoFilesSelected : "{{trans(\'admin.msgNoFilesSelected\')}}",
                msgCancelled : "{{trans(\'admin.msgCancelled\')}}",
                msgPaused : "{{trans(\'admin.msgPaused\')}}",
                msgZoomTitle : "{{trans(\'admin.msgZoomTitle\')}}",
                msgZoomModalHeading : "{{trans(\'admin.msgZoomModalHeading\')}}",
                msgFileRequired : "{{trans(\'admin.msgFileRequired\')}}",
                browseLabel : "{{trans(\'admin.browseLabel\')}}",
                removeLabel : "{{trans(\'admin.removeLabel\')}}",
                dropZoneTitle : "{{trans(\'admin.dropZoneTitle\')}}",

            });
            $(\'.file-preview-frame\').click(function () {
                $(this).hide();
                $(\'.file-error-message\').hide();
                $(\'.kv-fileinput-error\').hide();
            });

             </script>';


            $html_Mfiles_script=$html_Mfiles_script.'
            <div class="form-group col-md-12">
            <label for="images">{{trans(\'admin.images\')}}</label>
            <div class="file-loading">
                <input id="images" name="images[]" type="file" multiple class="file" data-overwrite-initial="false"
                       >
            </div>
            </div>
            ';
        }
        if($input['table_has_multiple_files']==1){
            $fotter_Mfiles_script=$fotter_Mfiles_script.'

    <script !src="">
        var url_files = [];
        var initialPreviewConfig_files = [];
    </script>
    @foreach($files as $file)
        <script type="text/javascript">
            url_files.push("{{url($file->file)}}");
            initialPreviewConfig_files.push({filename: "file",
            downloadUrl: "{{url($file->file)}}", size: 930321,
            width: "120px", url: "{{url(\'admin/delete'.$module_name.'files\')}}",
            key: "{{$file->id}}"});
        </script>
    @endforeach

<script !src="">
            $("#files").fileinput({
                 showUpload:false,
                maxFileSize:25600,
                maxFilePreviewSize:25600,
                maxFileCount:20,
                showDownload: true,
                showRemove: true,
                initialPreview: url,
                initialPreviewAsData: true,
                initialPreviewConfig: initialPreviewConfig,
                msgPlaceholder : "{{trans(\'admin.Select file..\')}}",
                msgSelected : "{{trans(\'admin.msgSelected\')}}",
                msgProcessing : "{{trans(\'admin.msgProcessing\')}}",
                removeTitle : "{{trans(\'admin.removeTitle\')}}",
                uploadTitle : "{{trans(\'admin.uploadTitle\')}}",
                downloadTitle : "{{trans(\'admin.downloadTitle\')}}",
                zoomTitle : "{{trans(\'admin.zoomTitle\')}}",
                dragTitle : "{{trans(\'admin.dragTitle\')}}",
                msgNo : "{{trans(\'admin.msgNo\')}}",
                msgNoFilesSelected : "{{trans(\'admin.msgNoFilesSelected\')}}",
                msgCancelled : "{{trans(\'admin.msgCancelled\')}}",
                msgPaused : "{{trans(\'admin.msgPaused\')}}",
                msgZoomTitle : "{{trans(\'admin.msgZoomTitle\')}}",
                msgZoomModalHeading : "{{trans(\'admin.msgZoomModalHeading\')}}",
                msgFileRequired : "{{trans(\'admin.msgFileRequired\')}}",
                browseLabel : "{{trans(\'admin.browseLabel\')}}",
                removeLabel : "{{trans(\'admin.removeLabel\')}}",
                dropZoneTitle : "{{trans(\'admin.dropZoneTitle\')}}",

            });
            $(\'.file-preview-frame\').click(function () {
                $(this).hide();
                $(\'.file-error-message\').hide();
                $(\'.kv-fileinput-error\').hide();
            });

             </script>';

            $html_Mfiles_script=$html_Mfiles_script.'
            <div class="form-group col-md-12">
            <label for="images">{{trans(\'admin.files\')}}</label>
            <div class="file-loading">
                <input id="files" name="files[]" type="file" multiple class="file" data-overwrite-initial="false"
                       >
            </div>
            </div>
            ';
        }

        $page_content='@extends(\'backend.layouts.app\')
'.$multiplefiles_script.'
@section(\'title\',trans(\''.$section_flag.'.Admin - '.$section_flag.'\'))
@section(\'header\')
@endsection

@section(\'content\')


<?php $lang=App::getLocale(); ?>

<!-- [ breadcrumb ] start -->
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="'.$input['section_icon'].' bg-c-blue"></i>
                    <div class="d-inline">
                        <h5>{{trans(\''.$section_flag.'.Admin - '.$section_flag.'\')}}</h5>
                        <span>{{trans(\'admin.manage and control all system sides\')}}
                             </span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class=" breadcrumb breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{url(\'admin/dashboard\')}}"><i class="feather icon-home"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">{{trans(\''.$section_flag.'.'.$section_flag.'\')}}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- [ breadcrumb ] end -->
<div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <!-- [ page content ] start -->
                    <div class="row">
                        <div class="col-sm-12">


    <div class="card">
                                <div class="card-header">
                                    <h5>{{trans(\''.$section_flag.'.Admin - '.$section_flag.'\')}}</h5>
                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>
                                            <li><i class="feather icon-maximize full-card"></i></li>
                                            <li><i class="feather icon-minus minimize-card"></i></li>
                                            <li><i class="feather icon-refresh-cw reload-card"></i></li>
                                            <li><i class="feather icon-trash close-card"></i></li>                                                                 <li><i class="feather icon-chevron-left open-card-option"></i></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-block">

    <div class="wrapper_cols">
        <div class="col_page_content">
            <div class="row">

    <div class="col-lg-12">
           <br>
                <h4>{{trans(\'admin.EditModule\')}}</h4>
        </div>
        <div class="col-md-12 ">
        <div class="align_btn_end">
                <a class="btn btn-primary" href="{{ route(\''.$section_flag.'.index\') }}">
                {{trans(\'admin.back\')}}</a>
            </div>
        </div>


 </div>



    {!! Form::model($'.$module_name.', [\'method\' => \'PATCH\',\'enctype\'=>\'multipart/form-data\',\'route\' => [\''.$section_flag.'.update\', $'.$module_name.'->id]]) !!}
    <div class="row">


        '.$form_content.'

        '.$html_Mfiles_script.'
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">{{trans(\'admin.Save\')}}</button>
        </div>
    </div>
    {!! Form::close() !!}
            </div>
        </div>
    </div>


    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>


     <script>
                                $(document).ready(function() {
                                    $("input").keydown(function(event){
                                        if(event.keyCode == 13) {
                                            event.preventDefault();
                                            $("form").submit();
                                            // return false;
                                        }
                                    });
                                });
                            </script>


@endsection


@section(\'footer\')
    '.$fotter_Mfiles_script.'
@endsection
';
        $file = 'edit.blade.php';
        $destinationPath="resources/views/backend/".$section_flag."/";
        if (!is_dir($destinationPath)) {  mkdir($destinationPath,0777,true);  }
        File::put($destinationPath.$file,$page_content);

        /******************************/
        /******End Edit page Content******/
        /******************************/

    }

    public function UpdateCSRF_TokenFile(){
        //generate code for expect CSRFtoken of
        $expected_routes='';
        $comma='';
        $admin_routes=\App\Models\Route::where(
            ['type'=>'web_routes','middleware' => 'admin','expect_from_CSRF'=>1])->get();
        if(isset($admin_routes)){
            foreach ($admin_routes as $admin_route){
                $expected_routes=$expected_routes.'\'admin/'.$admin_route['router_name'].'\',';
            }
//            $comma=',';
        }

        $web_routes=\App\Models\Route::where(
            ['type'=>'web_routes','middleware' => 'user','expect_from_CSRF'=>1])->get();
        if(isset($web_routes)){
            foreach ($web_routes as $web_route){
//                $expected_routes=$expected_routes.$web_route['router_name'].'\',';
                $expected_routes=$expected_routes.'\''.$web_route['router_name'].'\',';
            }
        }

        $VerifyCsrfToken_content='<?php

    namespace App\Http\Middleware;
    use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

    class VerifyCsrfToken extends Middleware
    {
        /**
         * Indicates whether the XSRF-TOKEN cookie should be set on the response.
         *
         * @var bool
         */
        protected $addHttpCookie = true;

        /**
         * The URIs that should be excluded from CSRF verification.
         *
         * @var array
         */
        protected $except = [\'developer/create_extension_table\',\'developer/create_extension\','.$expected_routes.'];
    }
                ';
        //insert new CSRF Content into Content file
        $file ='VerifyCsrfToken.php';
        $destinationPath="app/Http/Middleware/";
        if (!is_dir($destinationPath)) {  mkdir($destinationPath,0777,true);  }
        File::put($destinationPath.$file,$VerifyCsrfToken_content);
    }

}
