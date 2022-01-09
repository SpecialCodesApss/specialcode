<?php

namespace Developer\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use File;
use DB;
use App\Models\Admin_sections;
use Illuminate\Support\Facades\App;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Lang;
use Session;
use \Statickidz\GoogleTranslate;
use Developer\Traits\Developer_traits;
use Developer\Traits\JSON_API_traits;
use Developer\Traits\Flutter_traits;
use Developer\Traits\Web_traits;

class DeveloperController extends Controller
{
    use Developer_traits,JSON_API_traits,Web_traits,Flutter_traits;


    public function index(){
        return view('developer::index' );
    }

    public function create_extension_table(){
        $hostname = env("DB_DATABASE","framework1.7");
        $db = "Tables_in_".$hostname;
        $tables = DB::select('SHOW TABLES');// returns an array of stdObjects
        $table_fields= DB::getSchemaBuilder()->getColumnListing('users');
        return view('developer::create_module_table', compact('tables','db','table_fields'));
    }

    public function create_module(){
        $hostname = env("DB_DATABASE","framework1.7");
        $db = "Tables_in_".$hostname;
        $tables = DB::select('SHOW TABLES');// returns an array of stdObjects
        $table_fields= DB::getSchemaBuilder()->getColumnListing('users');
        return view('developer::create_module', compact('tables','db','table_fields'));
    }


    public function send_table_fields(Request $request){
        //get database table to use it inside join functions between tables
        $hostname = env("DB_DATABASE","framework1.7");
        $db = "Tables_in_".$hostname;
        $tables = DB::select('SHOW TABLES'); // returns an array of stdObjects
        //get tables selector
        $tables_selector='';
        foreach ($tables as $table){
            $tables_selector=$tables_selector."<option value=".$table->$db.">".$table->$db."</option>";
        }


        $table_name=$request->table_name;
        $table_fields= DB::getSchemaBuilder()->getColumnListing($table_name);

        //for google translate object
        $trans = new GoogleTranslate();
        //translate table name
        $source = 'en';
        $target = 'ar';

        $table_fields_table='';
        $table_fields_names='';
        $fields_count=0;
        foreach ($table_fields as $table_field) {

            $fields_count++;
            //$trans_ar = 'TahaAlaa';
            //*********** Start Translation **************//
            //*********** Start Translation **************//
            //get field variables
            //if field contain "ar" or "en" convert it to "arabic - english"
            if(strpos($table_field, '_ar') !== false){
                $trans_en=str_replace("_ar","_arabic",$table_field);
            }
            elseif(strpos($table_field, '_en') !== false){
                $trans_en=str_replace("_en","_english",$table_field);
            }
            else{
                $trans_en=$table_field;
            }
            $trans_en=str_replace("_"," ",$trans_en);
            //get arabic translation
            if($table_field=='id'){
                $trans_ar='كود التعريف';
            }
            elseif($table_field=='image'){
                $trans_ar='الصورة';
            }
            elseif($table_field=='url'){
                $trans_ar='الرابط';
            }
            elseif($table_field=='active'){
                $trans_ar='التفعيل';
            }
            elseif($table_field=='sort'){
                $trans_ar='الترتيب';
            }
            elseif($table_field=='name_ar'){
                $trans_ar='الاسم بالعربية';
                $trans_en='arabic name';
            }
            elseif($table_field=='name_en'){
                $trans_ar='الاسم بالانجليزية';
                $trans_en='english name';
            }
            elseif($table_field=='title_ar'){
                $trans_ar='العنوان بالعربية';
                $trans_en='arabic title';
            }
            elseif($table_field=='title_en'){
                $trans_ar='العنوان بالانجليزية';
                $trans_en='english title';
            }
            elseif($table_field=='description_ar'){
                $trans_ar='الوصف بالعربية';
                $trans_en='arabic description';
            }
            elseif($table_field=='description_en'){
                $trans_ar='الوصف بالانجليزية';
                $trans_en='english description';
            }
            elseif($table_field=='description_html_ar'){
                $trans_ar='الوصف بالعربية';
                $trans_en='arabic description';
            }
            elseif($table_field=='description_html_en'){
                $trans_ar='الوصف بالانجليزية';
                $trans_en='english description';
            }
            elseif($table_field=='slug'){
                $trans_ar='الاسم المختصر المميز';
                $trans_en='Slug';
            }
            else{
                $trans_ar = $trans->translate($source, $target, $trans_en);
            }
            //*********** End Translation **************//
            //*********** End Translation **************//

            //******************Start to Datatype of field *****************//
            //******************Start to Datatype of field *****************//
            $field_Unique_Key ="";
            $selector_items='';

            if (strpos($table_field, 'ids') !== false){
                $datatype='table_to_table';
            }
            elseif($table_field=='id' ){
                $datatype='number';
            }
            elseif(strpos($table_field, 'id') !== false){
                $datatype='join_select';
            }

            elseif(strpos($table_field, 'image') !== false || strpos($table_field, 'logo') !== false
                || strpos($table_field, 'photo') !== false || strpos($table_field, 'img') !== false){
                $datatype='image';
            }
            elseif(strpos($table_field, 'file') !== false ){
                $datatype='file';
            }
            elseif(strpos($table_field, 'icon') !== false){
                $datatype='varchar';
            }
            elseif(strpos($table_field, 'url') !== false || strpos($table_field, 'link') !== false
                || strpos($table_field, 'website') !== false){
                $datatype='url_link';
            }
            elseif(strpos($table_field, 'html') !== false){
                $datatype='HTMLtextarea';
            }
            elseif(strpos($table_field, 'flag') !== false){
                $datatype='varchar';
            }
            elseif(strpos($table_field, 'active') !== false){
                $datatype='active';
            }
            elseif($table_field=='sort'){
                $datatype='sort';
            }

            elseif(strpos($table_field, 'is_') !== false){
//                $datatype='is_checkbox';
                $datatype='is_switch';
            }
            elseif(strpos($table_field, 'checkbox') !== false){
                $datatype='table_to_checkbox';
            }
            elseif(strpos($table_field, 'selectbox') !== false){
                $datatype='table_to_select';
            }

            elseif(strpos($table_field, 'price') !== false || strpos($table_field, 'cost') !== false){
                $datatype='price';
            }
            elseif(strpos($table_field, 'datetime') !== false){
                $datatype='datetime';
            }
            elseif($table_field == 'created_at' ||$table_field == 'updated_at' ){
                $datatype='datetime';
            }
            elseif(strpos($table_field, 'date') !== false){
                $datatype='date';
            }
            elseif(strpos($table_field, 'time') !== false){
                $datatype='time';
            }
            elseif(strpos($table_field, 'duration') !== false){
                $datatype='number';
            }
            elseif(strpos($table_field, 'order_status') !== false){
                $datatype='order_status';
            }
            elseif(strpos($table_field, 'status') !== false){
                $datatype='select';
            }


            else{
                //get input type for each parameter
                $columns = DB::select( DB::raw('SHOW COLUMNS FROM '.$table_name.''));
                $table_field_type='varchar';
                foreach($columns as $column) {

                    if($column->Field == $table_field ){
                        $table_field_type=$column->Type;
                        $field_Unique_Key=$column->Key;
                        if(strpos($column->Type, 'enum') !== false){
                            $items=$column->Type;
                            $items=str_replace("enum",'',$items);
                            $items=str_replace("(",'',$items);
                            $items=str_replace(")",'',$items);
                            $items=str_replace("'",'',$items);
                            $selector_items = $items;
                        }
                    }


                }

                if(strpos($table_field_type, 'integer') !== false ||strpos($table_field_type, 'bigint') !== false ||
                    strpos($table_field_type, 'tinyint') !== false ||strpos($table_field_type, 'smallint') !== false ||
                    strpos($table_field_type, 'mediumint')!== false ||strpos($table_field_type, 'boolean') !== false ){
                    $datatype = 'number';
                }
                elseif(strpos($table_field_type, 'char') !== false ||strpos($table_field_type, 'varchar') !== false ){
                    $datatype = 'varchar';
                }
                elseif(strpos($table_field_type, 'tinytext') !== false || strpos($table_field_type, 'text') !== false ||
                    strpos($table_field_type, 'longtext')!== false || strpos($table_field_type, 'mediumtext') !== false ){
                    $datatype = 'textarea';
                }
                elseif(strpos($table_field_type, 'date') !== false ){
                    $datatype = 'date';
                }
                elseif(strpos($table_field_type, 'enum') !== false ){
                    $datatype = 'enum_selector';
                }
                else {
                    $datatype = 'varchar';
                }
            }


            $datatypeArray=['number','price','varchar','enum_selector','is_checkbox','is_switch','image','file','url_link','select','select_niceSelector','select_with_search','date','time','datetime','textarea','HTMLtextarea','table_to_checkbox','table_to_select','table_to_table','table_to_tagInput', 'active', 'order_status', 'sort'];
            $options='';
            foreach ($datatypeArray as $data){
                if($datatype == $data ){
                    $option=' <option value="'.$data.'" selected>'.$data.'</option>';
                }
                else{
                    $option=' <option value="'.$data.'">'.$data.'</option>';
                }
                $options=$options.$option;
            }

            //******************End to Datatype of field *****************//
            //******************End to Datatype of field *****************//


            //********** start of checeked sections ****************//
            //********** start of checeked sections ****************//
            if($field_Unique_Key == "UNI")
            {
                $ischecked_is_Unique ="checked='checked'";
            }
            else{
                $ischecked_is_Unique ="";
            }
            if($table_field == 'sort'
                || $table_field == 'created_at' || $table_field == 'updated_at')
            {
                $ischecked_adminTabelview ="";
            }
            else{
                $ischecked_adminTabelview ="checked='checked'";
            }

            if($table_field == 'id' || $table_field == 'created_at' || $table_field == 'updated_at')
            {
                $ischecked_adminview ="";
            }
            else{
                $ischecked_adminview ="checked='checked'";
            }

            if($table_field == 'id' || $table_field == 'created_at' || $table_field == 'updated_at')
            {
                $ischecked_adminRequired ="";
            }

            else{
                $ischecked_adminRequired ="checked='checked'";
            }


            if($table_field == 'id' || $table_field == 'created_at' || $table_field == 'updated_at'||$table_field == 'sort')
            {
                $ischecked_mobileAPIActive ="";
            }
            else{
                $ischecked_mobileAPIActive ="checked='checked'";
            }

            if($table_field == 'id' || $table_field == 'created_at' || $table_field == 'updated_at' ||$table_field == 'sort')
            {
                $ischecked_mobileAPIRequired ="";
            }
            else{
                $ischecked_mobileAPIRequired ="checked='checked'";
            }

            //********** end of checeked sections ****************//
            //********** end of checeked sections ****************//

            //********** start of Selector DB ****************//
            //********** start of Selector DB ****************//

            $field_tables_selector = '<select  class="col-md-6 form-control" style="float: left" name="'.$table_field.'_joinedTable" id="">
                '.$tables_selector.'
                </select>' .
                '<input  class="col-md-6 form-control" type="text" name="'.$table_field.'_joinedTable_field" placeholder="table field name"/>';


            //********** end of Selector DB ****************//
            //********** end of Selector DB ****************//

            $table_fields_names.='<tr class="row100 head"><th class="cell100 column1">'.$table_field.'</th></tr>';


            $table_fields_table='<tr >'.$table_fields_table.'

            <td> <input class="form-control col-md-12" type="text" name="'.$table_field.'_en" value="'.$trans_en.'"></td>
            <td> <input class="form-control col-md-12" type="text" name="'.$table_field.'_ar"  value="'.$trans_ar.'"></td>

            <td>
            <select class="form-control" name="'.$table_field.'_datatype"  value="'.$datatype.'" ">
                '.$options.'
            </select>
            </td>

            <td> <input type="text" class="form-control  col-md-12"" name="'.$table_field.'_selector_items"  value="'.$selector_items.'"></td>

            <td> <input type="checkbox" class="form-control col-md-12" name="'.$table_field.'_is_Unique"   '.$ischecked_is_Unique.'></td>
            <td> <input type="checkbox" class="form-control col-md-12" name="'.$table_field.'_adminTabelview"   '.$ischecked_adminTabelview.'></td>
            <td> <input type="checkbox" class="form-control col-md-12" name="'.$table_field.'_moduleProtected"  ></td>
            <td> <input type="checkbox" class="form-control col-md-12" name="'.$table_field.'_adminview"   '.$ischecked_adminview.'></td>
            <td> <input type="checkbox" class="form-control col-md-12" name="'.$table_field.'_adminRequiredStore"   '.$ischecked_adminRequired.'></td>
            <td> <input type="checkbox" class="form-control col-md-12" name="'.$table_field.'_adminRequiredUpdate"   '.$ischecked_adminRequired.'></td>
            <td> <input type="checkbox" class="form-control col-md-12" name="'.$table_field.'_mobileAPIActive"  '.$ischecked_mobileAPIActive.'></td>
            <td> <input type="checkbox" class="form-control col-md-12" name="'.$table_field.'_mobileAPIRequiredStore"   '.$ischecked_mobileAPIRequired.'></td>
            <td> <input type="checkbox" class="form-control col-md-12" name="'.$table_field.'_mobileAPIRequiredUpdate"   '.$ischecked_mobileAPIRequired.'></td>
            <td class="col-md-12">
                '.$field_tables_selector.'
            </td>
            </tr>';
        }

        $result=[];
        $result['fields']=$table_fields_table;
        $result['table_fields_names']=$table_fields_names;
        $result['table_name']=$table_name;

        $module_name=ucfirst($table_name);
        $module_name=rtrim($module_name, "s");
        $result['module_name']=$module_name;

        $section_name_en=ucfirst($table_name);
        $result['section_name_en']=$section_name_en;

        //translate
        $text = ucfirst($table_name);
        $section_name_ar = $trans->translate($source, $target, $text);
        //$section_name_ar = "TahaAlaa";
        $result['section_name_ar']=$section_name_ar;
        $result['section_flag']=$table_name;

        //get total sections in system to define sort nmber
        $sort=DB::table('admin_sections')->get()->count()+1;
        $result['sort']=$sort;


        $result['fields_count']=$fields_count;

        return view('developer::create_module', compact('tables','db','table_fields','result'));

//        return $result;

    }


//    public function get_table_fields(Request $request){
//        //get database table to use it inside join functions between tables
//        $hostname = env("DB_DATABASE","framework1.7");
//        $db = "Tables_in_".$hostname;
//        $tables = DB::select('SHOW TABLES'); // returns an array of stdObjects
//        //get tables selector
//        $tables_selector='';
//        foreach ($tables as $table){
//            $tables_selector=$tables_selector."<option value=".$table->$db.">".$table->$db."</option>";
//        }
//
//
//        $table_name=$request->table_name;
//        $table_fields= DB::getSchemaBuilder()->getColumnListing($table_name);
//
//        //for google translate object
//        $trans = new GoogleTranslate();
//        //translate table name
//        $source = 'en';
//        $target = 'ar';
//
//        $table_fields_table='';
//        $table_fields_names='';
//        foreach ($table_fields as $table_field) {
//            //$trans_ar = 'TahaAlaa';
//            //*********** Start Translation **************//
//            //*********** Start Translation **************//
//            //get field variables
//            //if field contain "ar" or "en" convert it to "arabic - english"
//            if(strpos($table_field, '_ar') !== false){
//                $trans_en=str_replace("_ar","_arabic",$table_field);
//            }
//            elseif(strpos($table_field, '_en') !== false){
//                $trans_en=str_replace("_en","_english",$table_field);
//            }
//            else{
//                $trans_en=$table_field;
//            }
//            $trans_en=str_replace("_"," ",$trans_en);
//            //get arabic translation
//            if($table_field=='id'){
//                $trans_ar='كود التعريف';
//            }
//            elseif($table_field=='image'){
//                $trans_ar='الصورة';
//            }
//            elseif($table_field=='url'){
//                $trans_ar='الرابط';
//            }
//            elseif($table_field=='active'){
//                $trans_ar='التفعيل';
//            }
//            elseif($table_field=='sort'){
//                $trans_ar='الترتيب';
//            }
//            elseif($table_field=='name_ar'){
//                $trans_ar='الاسم بالعربية';
//                $trans_en='arabic name';
//            }
//            elseif($table_field=='name_en'){
//                $trans_ar='الاسم بالانجليزية';
//                $trans_en='english name';
//            }
//            elseif($table_field=='description_ar'){
//                $trans_ar='الوصف بالعربية';
//                $trans_en='arabic description';
//            }
//            elseif($table_field=='description_en'){
//                $trans_ar='الوصف بالانجليزية';
//                $trans_en='english description';
//            }
//            elseif($table_field=='description_html_ar'){
//                $trans_ar='الوصف بالعربية';
//                $trans_en='arabic description';
//            }
//            elseif($table_field=='description_html_en'){
//                $trans_ar='الوصف بالانجليزية';
//                $trans_en='english description';
//            }
//            elseif($table_field=='slug'){
//                $trans_ar='الاسم المختصر المميز';
//                $trans_en='Slug';
//            }
//            else{
//                $trans_ar = $trans->translate($source, $target, $trans_en);
//            }
//            //*********** End Translation **************//
//            //*********** End Translation **************//
//
//            //******************Start to Datatype of field *****************//
//            //******************Start to Datatype of field *****************//
//            $field_Unique_Key ="";
//            $selector_items='';
//
//            if (strpos($table_field, 'ids') !== false){
//                $datatype='table_to_table';
//            }
//            elseif($table_field=='id' ){
//                $datatype='number';
//            }
//            elseif(strpos($table_field, 'id') !== false){
//                $datatype='join_select';
//            }
//
//            elseif(strpos($table_field, 'image') !== false || strpos($table_field, 'logo') !== false
//                || strpos($table_field, 'photo') !== false || strpos($table_field, 'img') !== false){
//                $datatype='image';
//            }
//            elseif(strpos($table_field, 'file') !== false ){
//                $datatype='file';
//            }
//            elseif(strpos($table_field, 'icon') !== false){
//                $datatype='varchar';
//            }
//            elseif(strpos($table_field, 'url') !== false || strpos($table_field, 'link') !== false
//                || strpos($table_field, 'website') !== false){
//                $datatype='url_link';
//            }
//            elseif(strpos($table_field, 'html') !== false){
//                $datatype='HTMLtextarea';
//            }
//            elseif(strpos($table_field, 'flag') !== false){
//                $datatype='varchar';
//            }
//            elseif(strpos($table_field, 'active') !== false){
//                $datatype='active';
//            }
//            elseif($table_field=='sort'){
//                $datatype='sort';
//            }
//
//            elseif(strpos($table_field, 'is_') !== false){
//                $datatype='is_checkbox';
//            }
//            elseif(strpos($table_field, 'checkbox') !== false){
//                $datatype='table_to_checkbox';
//            }
//            elseif(strpos($table_field, 'selectbox') !== false){
//                $datatype='table_to_select';
//            }
//
//            elseif(strpos($table_field, 'price') !== false || strpos($table_field, 'cost') !== false){
//                $datatype='price';
//            }
//            elseif(strpos($table_field, 'datetime') !== false){
//                $datatype='datetime';
//            }
//            elseif($table_field == 'created_at' ||$table_field == 'updated_at' ){
//                $datatype='datetime';
//            }
//            elseif(strpos($table_field, 'date') !== false){
//                $datatype='date';
//            }
//            elseif(strpos($table_field, 'time') !== false){
//                $datatype='time';
//            }
//            elseif(strpos($table_field, 'duration') !== false){
//                $datatype='number';
//            }
//            elseif(strpos($table_field, 'order_status') !== false){
//                $datatype='order_status';
//            }
//            elseif(strpos($table_field, 'status') !== false){
//                $datatype='select';
//            }
//
//
//            else{
//                //get input type for each parameter
//                $columns = DB::select( DB::raw('SHOW COLUMNS FROM '.$table_name.''));
//                $table_field_type='varchar';
//                foreach($columns as $column) {
//
//                    if($column->Field == $table_field ){
//                        $table_field_type=$column->Type;
//                        $field_Unique_Key=$column->Key;
//                        if(strpos($column->Type, 'enum') !== false){
//                            $items=$column->Type;
//                            $items=str_replace("enum",'',$items);
//                            $items=str_replace("(",'',$items);
//                            $items=str_replace(")",'',$items);
//                            $items=str_replace("'",'',$items);
//                            $selector_items = $items;
//                        }
//                    }
//
//
//                }
//
//                if(strpos($table_field_type, 'integer') !== false ||strpos($table_field_type, 'bigint') !== false ||
//                    strpos($table_field_type, 'tinyint') !== false ||strpos($table_field_type, 'smallint') !== false ||
//                    strpos($table_field_type, 'mediumint')!== false ||strpos($table_field_type, 'boolean') !== false ){
//                    $datatype = 'number';
//                }
//                elseif(strpos($table_field_type, 'char') !== false ||strpos($table_field_type, 'varchar') !== false ){
//                    $datatype = 'varchar';
//                }
//                elseif(strpos($table_field_type, 'tinytext') !== false || strpos($table_field_type, 'text') !== false ||
//                    strpos($table_field_type, 'longtext')!== false || strpos($table_field_type, 'mediumtext') !== false ){
//                    $datatype = 'textarea';
//                }
//                elseif(strpos($table_field_type, 'date') !== false ){
//                    $datatype = 'date';
//                }
//                elseif(strpos($table_field_type, 'enum') !== false ){
//                    $datatype = 'enum_selector';
//                }
//                else {
//                    $datatype = 'varchar';
//                }
//            }
//
//
//            $datatypeArray=['number','price','varchar','enum_selector','is_checkbox','image','file','url_link','select','select_niceSelector','select_with_search','date','time','datetime','textarea','HTMLtextarea','table_to_checkbox','table_to_select','table_to_table','table_to_tagInput', 'active', 'order_status', 'sort'];
//            $options='';
//            foreach ($datatypeArray as $data){
//                if($datatype == $data ){
//                    $option=' <option value="'.$data.'" selected>'.$data.'</option>';
//                }
//                else{
//                    $option=' <option value="'.$data.'">'.$data.'</option>';
//                }
//                $options=$options.$option;
//            }
//
//            //******************End to Datatype of field *****************//
//            //******************End to Datatype of field *****************//
//
//
//            //********** start of checeked sections ****************//
//            //********** start of checeked sections ****************//
//            if($field_Unique_Key == "UNI")
//            {
//                $ischecked_is_Unique ="checked='checked'";
//            }
//            else{
//                $ischecked_is_Unique ="";
//            }
//            if($table_field == 'sort'
//                || $table_field == 'created_at' || $table_field == 'updated_at')
//            {
//                $ischecked_adminTabelview ="";
//            }
//            else{
//                $ischecked_adminTabelview ="checked='checked'";
//            }
//
//            if($table_field == 'id' || $table_field == 'created_at' || $table_field == 'updated_at')
//            {
//                $ischecked_adminview ="";
//            }
//            else{
//                $ischecked_adminview ="checked='checked'";
//            }
//
//            if($table_field == 'id' || $table_field == 'created_at' || $table_field == 'updated_at')
//            {
//                $ischecked_adminRequired ="";
//            }
//
//            else{
//                $ischecked_adminRequired ="checked='checked'";
//            }
//
////
////            if($table_field == 'id' || $table_field == 'created_at' || $table_field == 'updated_at'||$table_field == 'sort')
////            {
////                $ischecked_adminRequired ="";
////            }
////            else{
////                $ischecked_adminRequired ="checked='checked'";
////            }
//
//            if($table_field == 'id' || $table_field == 'created_at' || $table_field == 'updated_at'||$table_field == 'sort')
//            {
//                $ischecked_mobileAPIActive ="";
//            }
//            else{
//                $ischecked_mobileAPIActive ="checked='checked'";
//            }
//
//            if($table_field == 'id' || $table_field == 'created_at' || $table_field == 'updated_at' ||$table_field == 'sort')
//            {
//                $ischecked_mobileAPIRequired ="";
//            }
//            else{
//                $ischecked_mobileAPIRequired ="checked='checked'";
//            }
//
//            //********** end of checeked sections ****************//
//            //********** end of checeked sections ****************//
//
//            //********** start of Selector DB ****************//
//            //********** start of Selector DB ****************//
//
//            $field_tables_selector = '<select  class="col-md-6 form-control" style="float: left" name="'.$table_field.'_joinedTable" id="">
//                '.$tables_selector.'
//                </select>' .
//                '<input  class="col-md-6 form-control" type="text" name="'.$table_field.'_joinedTable_field" placeholder="table field name"/>';
//
//
//            //********** end of Selector DB ****************//
//            //********** end of Selector DB ****************//
//
//            $table_fields_names.='<tr class="row100 head"><th class="cell100 column1">'.$table_field.'</th></tr>';
//
//
//            $table_fields_table='<tr >'.$table_fields_table.'
//
//            <td> <input class="form-control col-md-12" type="text" name="'.$table_field.'_en" value="'.$trans_en.'"></td>
//            <td> <input class="form-control col-md-12" type="text" name="'.$table_field.'_ar"  value="'.$trans_ar.'"></td>
//
//            <td>
//            <select class="form-control" name="'.$table_field.'_datatype"  value="'.$datatype.'" ">
//                '.$options.'
//            </select>
//            </td>
//
//            <td> <input type="text" class="form-control  col-md-12"" name="'.$table_field.'_selector_items"  value="'.$selector_items.'"></td>
//
//            <td> <input type="checkbox" class="form-control col-md-12" name="'.$table_field.'_is_Unique"   '.$ischecked_is_Unique.'></td>
//            <td> <input type="checkbox" class="form-control col-md-12" name="'.$table_field.'_adminTabelview"   '.$ischecked_adminTabelview.'></td>
//            <td> <input type="checkbox" class="form-control col-md-12" name="'.$table_field.'_moduleProtected"  ></td>
//            <td> <input type="checkbox" class="form-control col-md-12" name="'.$table_field.'_adminview"   '.$ischecked_adminview.'></td>
//            <td> <input type="checkbox" class="form-control col-md-12" name="'.$table_field.'_adminRequiredStore"   '.$ischecked_adminRequired.'></td>
//            <td> <input type="checkbox" class="form-control col-md-12" name="'.$table_field.'_adminRequiredUpdate"   '.$ischecked_adminRequired.'></td>
//            <td> <input type="checkbox" class="form-control col-md-12" name="'.$table_field.'_mobileAPIActive"  '.$ischecked_mobileAPIActive.'></td>
//            <td> <input type="checkbox" class="form-control col-md-12" name="'.$table_field.'_mobileAPIRequiredStore"   '.$ischecked_mobileAPIRequired.'></td>
//            <td> <input type="checkbox" class="form-control col-md-12" name="'.$table_field.'_mobileAPIRequiredUpdate"   '.$ischecked_mobileAPIRequired.'></td>
//            <td class="col-md-12">
//                '.$field_tables_selector.'
//            </td>
//            </tr>';
//        }
//
//        $result=[];
//        $result['fields']=$table_fields_table;
//        $result['table_fields_names']=$table_fields_names;
//        $result['table_name']=$table_name;
//
//        $module_name=ucfirst($table_name);
//        $module_name=rtrim($module_name, "s");
//        $result['module_name']=$module_name;
//
//        $section_name_en=ucfirst($table_name);
//        $result['section_name_en']=$section_name_en;
//
//        //translate
//        $text = ucfirst($table_name);
//        $section_name_ar = $trans->translate($source, $target, $text);
//        //$section_name_ar = "TahaAlaa";
//        $result['section_name_ar']=$section_name_ar;
//        $result['section_flag']=$table_name;
//
//        //get total sections in system to define sort nmber
//        $sort=DB::table('admin_sections')->get()->count()+1;
//        $result['sort']=$sort;
//
//        return $result;
//
//    }

    public function get_theme_items(Request $request){
        $themeName=$request->themeName;
        $table_name=$request->tableName;
        $Page=$request->Page;
        $itemsSelector='';
        $table_fields_selector='';
        $table_fields= DB::getSchemaBuilder()->getColumnListing($table_name);
        foreach ($table_fields as $table_field){
            $table_fields_selector.='<option value="'.$table_field.'">'.$table_field.'</option>';
        }

        $xmlContnet=simplexml_load_file('developer/Flutter/themes/'.$Page.'/'.$themeName.'/items.xml');
        foreach ($xmlContnet as $item){
            $itemsSelector.='
                <th>'.$item->name.'</th>
                            <td>
                                <select class="form-control" name="item_'.$item->name.'" id="item_'.$item->name.'">
                                    '.$table_fields_selector.'
                                </select>
                            </td>
            ';
        }
        return $itemsSelector;
    }


    public function store_extension(Request $request) {

        $input=$request->all();



        /*Play Smart here*/
        $input['country_id_datatype']='table_to_select';


        /*End Play Smart here */

//        $input['module_name']="News";
        $table_name=$input['table_name'];
        $Capital_table_name=ucfirst($table_name);
//        $module_name=$input['module_name'];
       $module_name=$input['module_name'];
        $Small_module_name=lcfirst($module_name);
        $section_flag=$input['section_flag'];

        $controller_name=$module_name.'Controller';
        $module_controller_name="use App\\".$module_name.";";


        //get module fields
        $table_fields= DB::getSchemaBuilder()->getColumnListing($table_name);

        $module_fields=[];
        foreach ($table_fields as $table_field){
            if($table_field!='id' && $table_field!='created_at' && $table_field!='updated_at' ){
                array_push($module_fields,$table_field);
            }
        }
        $module_fields=json_encode($module_fields);



        //get protected fields
        $module_protected_fields=[];
        foreach ($table_fields as $table_field){
            if(isset($input[$table_field.'_moduleProtected'])){
                array_push($module_protected_fields,$table_field);
            }
        }
        $module_protected_fields=json_encode($module_protected_fields);


        //Step 1 : Create Module File
        $this->CreateModuleFile($module_name,$module_fields,$module_protected_fields);
        //if this table has multiple file or multiple images on new tables , then create module for child table
        if($input['table_has_multiple_images']=='1'){
            $sub_table_name=$table_name.'_images';
            //get module fields
            $sub_table_fields= DB::getSchemaBuilder()->getColumnListing($sub_table_name);
            $sub_module_fields=[];
            foreach ($sub_table_fields as $table_field){
                if($table_field!='id' && $table_field!='created_at' && $table_field!='updated_at' ){
                    array_push($sub_module_fields,$table_field);
                }
            }
            $sub_module_fields=json_encode($sub_module_fields);
            $this->CreateModuleFile($Capital_table_name."_image",$sub_module_fields,'[]');
        }
        if($input['table_has_multiple_files']=='1'){
            $sub_table_name=$table_name.'_files';
            //get module fields
            $sub_table_fields= DB::getSchemaBuilder()->getColumnListing($sub_table_name);
            $sub_module_fields=[];
            foreach ($sub_table_fields as $table_field){
                if($table_field!='id' && $table_field!='created_at' && $table_field!='updated_at' ){
                    array_push($sub_module_fields,$table_field);
                }
            }
            $sub_module_fields=json_encode($sub_module_fields);
            $this->CreateModuleFile($Capital_table_name."_file",$sub_module_fields,'[]');
        }

        //Step 2 : Create Controller File for Admin
        //check if admin controller is active
        if(isset($input['Admin_Coding'])){
            $this->CreateControllerFile($module_name,$table_name,$table_fields,$section_flag,$input,$Capital_table_name);
        }


        //Step 2 : Create Controller File for website
        //check if admin controller is active
        if(isset($input['Web_Coding'])){
            $this->CreateWebControllerFile($module_name,$table_name,$table_fields,$section_flag,$input,
                $Capital_table_name);
        }


        //Step 3 : Create Controller File
        //check if mobile API controller is active
        if(isset($input['Mobile_Coding'])){
            $this->CreateAPIControllerFile($module_name,$table_name,$table_fields,$section_flag,$input,
                $Capital_table_name);
        }

        //Step 4 : ِAdd Module to Admin Section table and Menu
        if(isset($input['Admin_Coding'])){
            $this->Insert_AdminSectionDB($controller_name,$section_flag,$input);
        }
            // ِAdd Extension data to Extensions Table
            $this->Insert_ExtensionDB($module_name,$section_flag,$input);

        //Step 5 : ِAdd Premissions to Permission Table
        if(isset($input['Admin_Coding'])){
            $this->Insert_PremissionDB($module_name,$input);
        }

        //Step 6 : Create Langauges Files
        $this->CreateLanguageFiles($table_fields,$section_flag,$input);

        //Step 7 : Create Index Page
        $this->CreateIndexPage($table_fields,$table_name,$input,$section_flag);

        //Step 8 : Create View Page
        $this->CreateViewPage($table_fields,$table_name,$section_flag,$module_name,$input);

        //Step 9 : Create Store Page
        $this->CreateStorePage($table_fields,$section_flag,$input);

        //Step 10 : Create Update Page
        $this->CreateUpdatePage($table_fields,$table_name,$section_flag,$module_name,$input,$Capital_table_name);

        //Step 11 : Update CSRF_Token File to avoid problems in post multiple files,images
        $this->UpdateCSRF_TokenFile();

        //Step 12 : store_new_api_request
        $this->store_new_api_request($table_name,$controller_name,$input,$table_fields);

        //Step 13 : Update JSON Collection File
        $this->Update_JSON_API_File($table_name);


        //check if mobile API controller is active
        if(isset($input['Mobile_Coding'])){
            //Step 14 : Create Controller File
            $this->CreateFlutterAPIControllerFile($module_name,$table_name,$table_fields,$input,'framework_01');
            if(isset($input['Mobile_List'])){
                //Step 15 : Create Flutter index Screen File
                $this->CreateFlutterIndexPage($controller_name,$Capital_table_name,$table_fields,$table_name,$input,$section_flag,'framework_01');
            }
            if(isset($input['Mobile_View'])){
                //Step 16 : Create Flutter View Screen File
                $this->CreateFlutterViewPage($controller_name,$Capital_table_name,$table_fields,$table_name,$input,$section_flag,'framework_01',$Small_module_name);
            }
            if(isset($input['Mobile_Create'])){
                //Step 17 : Create Flutter Store Screen File
                $this->CreateFlutterStorePage($controller_name,$Capital_table_name,$table_fields,$table_name,$input,$section_flag,'framework_01');
            }
            if(isset($input['Mobile_Update'])){
                //Step 18 : Create Flutter Update Screen File
                $this->CreateFlutterUpdatePage($controller_name,$Capital_table_name,$table_fields,$table_name,$input,$section_flag,'framework_01');
            }

            //Step 20 : update Flutter Languages Files by new translations
           $this->UpdateFlutterLanguageFiles($table_fields,$section_flag,$table_name,$Capital_table_name,$input,'framework_01');
        }



        return $input;
//        return back()->with('success','Extension Created Successfuly to this system');

    }
}
