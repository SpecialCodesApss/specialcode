<?php
namespace Developer\Traits;
use App\Models\Admin_sections;
use App\Models\Route;
use File;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use DB;
use Statickidz\GoogleTranslate;

trait Flutter_traits{


/*
     * ****************************
     * Create API Cotroller File Method
     * **************************************
     */
    public function CreateFlutterAPIControllerFile($module_name,$table_name,$table_fields,$input,$App_Folder_Name){

        /******************************/
        /******Start Controller Content******/
        /******************************/

        $controller_name=$module_name.'Controller';

        $base_url = $_SERVER['SERVER_NAME'];
        $base_url=str_replace('localhost','192.168.1.6',$base_url); // if its link is local host replace it by local

        //get Store/Update Functions Parametes and its body
        $API_body='';
        $functionParameters='';
        $comma = '';
        $requestfields='';
        $multipartImageCode='';
        foreach ($table_fields as $table_field){
            if(isset($input[$table_field.'_mobileAPIActive'])){
                $new_line=' \''.$table_field.'\' : \'$'.$table_field.'\',';
                $API_body=$API_body.$new_line;

                if($input[$table_field.'_datatype'] == 'number' || $input[$table_field.'_datatype'] == 'join_select'|| $input[$table_field.'_datatype'] == 'table_to_select' ){
                    if($table_field !='user_id') {
                        $dataType = 'int';
                        $requestfields .= '
                    request.fields["' . $table_field . '"] = ' . $table_field . ';';
                    }
                }
                elseif($input[$table_field.'_datatype'] == 'image' || $input[$table_field.'_datatype'] == 'file'){
                    $dataType = 'File?';
                    $multipartImageCode.='
                    if('.$table_field.' != null){
                    var '.$table_field.'stream = new http.ByteStream(DelegatingStream.typed('.$table_field.'.openRead()));
                    var '.$table_field.'length = await '.$table_field.'.length();
                    var multipartFile = new http.MultipartFile(\''.$table_field.'\', '.$table_field.'stream, '.$table_field.'length,
                        filename: basename('.$table_field.'.path));
                    request.files.add(multipartFile);
                    }
                    ';
                }
                else{
                    if($table_field !='user_id') {
                        $dataType = 'String';
                        $requestfields .= '
                    request.fields["' . $table_field . '"] = ' . $table_field . ';';
                    }
                }

                if($table_field !='user_id'){
                    $functionParameters = $functionParameters.$comma.$dataType.' '.$table_field;
                    $comma = ',';
                }

            }
        }

        $FlutterAPI_controller_content='
          import \'dart:convert\';
import \'package:http/http.dart\' as http ;
import \'package:shared_preferences/shared_preferences.dart\';
import \'../helpers/sharedPreferencesHelper.dart\' as sharedPreferencesHelper;
import \'../helpers/LanguageHelper.dart\' as LanguageHelper;

import \'package:path/path.dart\';
import \'package:async/async.dart\';
import \'dart:io\';

class '.$controller_name.' {
  String serverUrl = "http://'.$base_url.'/framework1.7";
  var status ;
  var message;
  var data;
  var listData;
  var token = sharedPreferencesHelper.token;
  var language = LanguageHelper.Language;

  _init() async{
    await LanguageHelper.initialize();
    await sharedPreferencesHelper.initialize_token();
    language = LanguageHelper.Language;
    token = sharedPreferencesHelper.token;
  }

  index(int page,String searchText) async {
  await _init();
    Uri request_URL = Uri.parse(serverUrl +"/api/'.$table_name.'?page=$page&searchText=$searchText");
    final prefs = await SharedPreferences.getInstance();


    final  response = await http.get(request_URL,
        headers: {
          \'Accept\' : \'application/json\',
          \'Authorization\': \'Bearer $token\',
          \'language\': (language)!
        });

    data = json.decode(response.body);
    status =data["success"];
    message=data["message"];
    listData = data["data"]["data"];
  }


  store('.$functionParameters.') async {
    //basic variables
    await _init();
    Uri request_URL = Uri.parse(serverUrl +"/api/'.$table_name.'");
    final prefs = await SharedPreferences.getInstance();




    var request = new http.MultipartRequest("POST", request_URL,);

    '.$multipartImageCode.'
    '.$requestfields.'

    request.headers["Accept"] = \'application/json\';
    request.headers["Authorization"] = \'Bearer $token\';
    request.headers["language"] = (language)!;
    var streamedResponse = await request.send();
    var response = await http.Response.fromStream(streamedResponse);
    data = json.decode(response.body);
    status =data["success"];
    message=data["message"];



  }

  update(int id,'.$functionParameters.') async {
     //basic variables
    await _init();
    Uri request_URL = Uri.parse(serverUrl +"/api/'.$table_name.'/$id?_method=PUT");
    final prefs = await SharedPreferences.getInstance();




    var request = new http.MultipartRequest("POST", request_URL,);

    '.$multipartImageCode.'
    '.$requestfields.'

    request.headers["Accept"] = \'application/json\';
    request.headers["Authorization"] = \'Bearer $token\';
    request.headers["language"] = (language)!;
    var streamedResponse = await request.send();
    var response = await http.Response.fromStream(streamedResponse);
    data = json.decode(response.body);
    status =data["success"];
    message=data["message"];




  }


  view(int id) async {
     //basic variables
    await _init();
    Uri request_URL = Uri.parse(serverUrl +"/api/'.$table_name.'/$id");
    final prefs = await SharedPreferences.getInstance();



    final  response = await http.get(request_URL,
        headers: {
          \'Accept\' : \'application/json\',
          \'Authorization\': \'Bearer $token\',
          \'language\': (language)!
        });
    data = json.decode(response.body);
    status =data["success"];
    message=data["message"];

  }

  delete(int id) async {
     //basic variables
    await _init();
    Uri request_URL = Uri.parse(serverUrl +"/api/'.$table_name.'/$id");
    final prefs = await SharedPreferences.getInstance();



    final  response = await http.delete(request_URL,
        headers: {
          \'Accept\' : \'application/json\',
          \'Authorization\': \'Bearer $token\',
          \'language\': (language)!
        });
    data = json.decode(response.body);
    status =data["success"];
    message=data["message"];

  }

}
';

        //Step 2 :: make Controller for Table
        $file = $controller_name.'.dart';
        $destinationPath="flutter_dev/".$App_Folder_Name."/lib/Controllers/";
        if (!is_dir($destinationPath)) {  mkdir($destinationPath,0777,true);  }
        File::put($destinationPath.$file,$FlutterAPI_controller_content);

        /******************************/
        /******End Controller Content******/
        /******************************/

    }


    public function CreateFlutterIndexPage($controller_name,$Capital_table_name,$table_fields,$table_name,$input,$section_flag,$App_Folder_Name){

        /******************************/
        /******start index page Content******/
        /******************************/

        $viewType = $input['viewType'];
        $ViewAddButton = $input['ViewAddButton'];
        $ViewSearchBar = $input['ViewSearchBar'];
        $ViewIndexPageAdv = $input['ViewIndexPageAdv'];


        //get theme selected and its code
        $themeCode='theme1';
        $indexTheme = $input['indexTheme'];
        if(isset($indexTheme)){
            $themeCode = file('flutter_dev/themes/indexPage/'.$indexTheme.'/code.txt');
            $themeCode = implode($themeCode);
            $themeCode=str_replace("##section_name##",$section_flag,$themeCode);
            $themeCode=str_replace("##Capital_table_name##",$Capital_table_name,$themeCode);
        }

        //get items name foreach item and its field from DB on new module
        $xmlContnet=simplexml_load_file('flutter_dev/themes/indexPage/'.$indexTheme.'/items.xml');
        foreach ($xmlContnet as $item){
            $itemName=$item->name;
            $moduleFieldName=$input['item_'.$itemName];
//            $moduleFieldName="id";
            $themeCode=str_replace('##'.$itemName.'##',$moduleFieldName,$themeCode);
        }




$page_content='import \'../../Controllers/'.$controller_name.'.dart\';
import \'package:flutter/cupertino.dart\';
import \'../../helpers/LoaderDialog.dart\';
import \'../../helpers/ToastHelper.dart\';
import \'../../helpers/LanguageHelper.dart\' as LanguageHelper;
import \'../../main.dart\';
import \'../../helpers/SizeConfig.dart\';
import \'package:flutter/widgets.dart\';
import \'package:flutter/material.dart\';
import \'../Home.dart\';
import \'package:flutter_staggered_animations/flutter_staggered_animations.dart\';
import \'package:pull_to_refresh/pull_to_refresh.dart\';

import \'../../Views/'.$table_name.'/view.dart\';
import \'../../Views/'.$table_name.'/store.dart\';

class '.$Capital_table_name.'Index extends StatefulWidget {
  @override
  State<StatefulWidget> createState() {
    // TODO: implement createState
    return _'.$Capital_table_name.'IndexState();
  }
}

class _'.$Capital_table_name.'IndexState extends State<'.$Capital_table_name.'Index>{
  //declare variables here
  var language = LanguageHelper.Language;
  var data;
  bool isNoListData=true;
  bool ViewAddButton='.$ViewAddButton.';
  bool ViewSearchBar='.$ViewSearchBar.';
  bool isAdImageEnabled='.$ViewIndexPageAdv.';
  String searchText="";
  var Ad;
  String viewType = "'.$viewType.'";
    int count = 1 ;
    int pagesCount = 1 ;
    int newPage = 2;
  '.$controller_name.' _'.$controller_name.' = new '.$controller_name.'();


  RefreshController _refreshController =
    RefreshController(initialRefresh: false);

    void _onRefresh() async {
      // monitor network fetch
      await Future.delayed(Duration(milliseconds: 1000));
      // if failed,use refreshFailed()
      //get list data
            _'.$controller_name.'.index(1,searchText).whenComplete((){
              if(_'.$controller_name.'.status == true){
                setState(() {
                  data = _'.$controller_name.'.listData;
                  if(data.length > 0){
                    isNoListData=false;
                    pagesCount = _'.$controller_name.'.data["data"]["last_page"];
                  }
                });
              }else{
                ShowToast("warning",_'.$controller_name.'.message);
              }
            });
      _refreshController.refreshCompleted();
    }

    void _onLoading() async {
      // monitor network fetch
      await Future.delayed(Duration(milliseconds: 1000));
      // if failed,use loadFailed(),if no data return,use LoadNodata()
      if (mounted)
        _'.$controller_name.'.index(newPage,searchText).whenComplete((){
          if(_'.$controller_name.'.status == true){
            setState(() {
              data.addAll(_'.$controller_name.'.listData);
              newPage++;
            });
          }
          else{
            _refreshController.loadFailed();
          }
        });

      if(newPage > pagesCount){
        _refreshController.loadNoData();
      }
      else{
        _refreshController.loadComplete();
      }

    }

    void _onSearch(String Text){
          setState(() {
            searchText = Text;
            data=null;
            pagesCount = 1 ;
            newPage = 2;
            _refreshController.resetNoData();
            _onRefresh();
          });
        }

  read() async {

    await LanguageHelper.initialize();
    language = LanguageHelper.Language;


    //get list data
    Future.delayed(Duration.zero, () => showLoaderDialogFunction(context));
    _'.$controller_name.'.index(1,searchText).whenComplete((){
      if(_'.$controller_name.'.status == true){
        setState(() {
          data = _'.$controller_name.'.listData;
          if(data.length > 0){
            isNoListData=false;
            pagesCount = _'.$controller_name.'.data["data"]["last_page"];
          }
        });
        Future.delayed(Duration.zero, () => hideLoaderDialogFunction(context));
      }else{
        ShowToast(\'warning\',_'.$controller_name.'.message);
        Future.delayed(Duration.zero, () => hideLoaderDialogFunction(context));
      }
    });

  }


  @override
  void initState() {
    // TODO: implement initState
    super.initState();
    read();
  }
  @override
  void dispose() {
    // TODO: implement dispose
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    // TODO: implement build
    SizeConfig().init(context); // for media query
    var screenWidthRatio = 10;
    var screenHightRatio = 35;
    var contenttopalignmentratio=20;
    if(SizeConfig.orientation == Orientation.landscape){
      screenWidthRatio = 20 ;
      screenHightRatio = 55 ;

      contenttopalignmentratio=10;
    }
    else{
      screenWidthRatio = 10 ;
      screenHightRatio = 35 ;

      contenttopalignmentratio=3;
    }
    '.$themeCode.'
  }
}
';

        $file = 'index.dart';
        $destinationPath="flutter_dev/".$App_Folder_Name."/lib/Views/".$section_flag."/";
        if (!is_dir($destinationPath)) {  mkdir($destinationPath,0777,true);  }
        File::put($destinationPath.$file,$page_content);


        /******************************/
        /******End index page Content******/
        /******************************/

    }


public function CreateFlutterViewPage($controller_name,$Capital_table_name,$table_fields,$table_name,$input,$section_flag,$App_Folder_Name,$Small_module_name){

    /******************************/
    /******start View page Content******/
    /******************************/

    $ViewPage_ViewImage=$input["ViewPage_ViewImage"];
    $ViewPage_ViewImageType=$input["ViewPage_ViewImageType"];
    $ViewPage_viewOrderBtn=$input["ViewPage_viewOrderBtn"];
    $ViewPage_ViewEditBtn=$input["ViewPage_ViewEditBtn"];
    $ViewPage_ViewDeleteBtn=$input["ViewPage_ViewDeleteBtn"];
    //order button code
    $orderBtnCode='';
    if($ViewPage_viewOrderBtn=="true"){
        $orderBtnCode='
            Padding(
                      padding: EdgeInsets.only(top:50.0,left: 30.0,right: 30.0),
                      child: RaisedButton(
                          color: Theme.of(context).primaryColor ,
                          child:  Text(
                          LanguageHelper.trans("app","order"),
                            style: Theme.of(context).textTheme.button,
                          ),
                          onPressed: null
                      ),
                  ),
        ';
    }

    //delete code and functions
    $deleteFunctions='';
    $deleteDesignCode='';
    if($ViewPage_ViewDeleteBtn=="true"){
        $deleteFunctions='deleteItem() async {
      showLoaderDialogFunction(context);
        _'.$controller_name.'.delete(widget.id).whenComplete((){
          if(_'.$controller_name.'.status == true){
            setState(() {
                ShowToast(\'success\',_'.$controller_name.'.message);
                hideLoaderDialogFunction(context);
                Navigator.push(
                    context,
                    MaterialPageRoute(builder: (context) =>'.$Capital_table_name.'Index())
                );
            });
          }else{
            ShowToast(\'warning\',_'.$controller_name.'.message);
            hideLoaderDialogFunction(context);
          }
        });
    }

    delete () async {
      showDialog(
          context: context,
          barrierDismissible: false,
          builder: (BuildContext context) {
            return AlertDialog(
              title: Center(child: Text(LanguageHelper.trans("app","Alert"))),
              content: Column(
                mainAxisSize: MainAxisSize.min,
                children: <Widget>[
                  Container(
                    padding: EdgeInsets.only(bottom: 30.0),
                    child: Text(
                    LanguageHelper.trans("app","confirmDeleteMessage"),
                      textAlign: TextAlign.center,
                      style: TextStyle(
                        color: Colors.red,
                      ),
                    ),
                  ),
                  Row(
                      mainAxisAlignment: MainAxisAlignment.spaceBetween,
                      children: <Widget>[
                        FlatButton(
                        child: Text(
                        LanguageHelper.trans("app","yes")
                        ),
                            onPressed: () {
                              deleteItem();
                            }),
                        FlatButton(
                            child: Text(
                             LanguageHelper.trans("app","no")
                             ),
                            autofocus: true,
                            color: Theme.of(context).primaryColor,
                            textColor: Colors.white,
                            onPressed: () {
                              Navigator.of(context).pop();
                            })
                      ])
                ],
              ),
            );
          });
    }';

    $deleteDesignCode='Padding(
                      padding: EdgeInsets.only(left: 30.0,right: 30.0),
                      child:RaisedButton(
                            color: Colors.red ,
                            child:  Text(
                            LanguageHelper.trans("app","delete"),
                              style: Theme.of(context).textTheme.button,
                            ),
                          onPressed:() => delete(),
                          padding: EdgeInsets.only(left: 30.0,right: 30.0),
                        ),
                      ),';
    }

    //Edit button design code
    $editDesignCode='';
    if($ViewPage_ViewEditBtn=="true"){
        $editDesignCode='Padding(
                          padding: EdgeInsets.only(left: 30.0,right: 30.0),
                        child: RaisedButton(
                          color: Theme.of(context).primaryColor ,
                          child:  Text(
                          LanguageHelper.trans("app","edit"),
                            style: Theme.of(context).textTheme.button,
                          ),
                          onPressed:() => Navigator.of(context).push(
                              MaterialPageRoute(builder: (context) => '.$Capital_table_name.'Update(widget.id))
                          ),
                          padding: EdgeInsets.only(left: 30.0,right: 30.0),
                        ),
                        ),';
    }

    //delete-Edit Section
    $SectionEdit_DeleteCode='';
    if($ViewPage_ViewDeleteBtn=="true" || $ViewPage_ViewEditBtn=="true"){
        $SectionEdit_DeleteCode='Padding(
                    padding: EdgeInsets.only(top:50.0,left: 30.0,right: 30.0),
                    child: Row(
                      children: <Widget>[
                        '.$editDesignCode.'
                        '.$deleteDesignCode.'
                      ],
                    )
                  )';
    }

    //get theme selected and its code
    $themeCode='theme1';
    $viewTheme = $input['viewTheme'];
    if(isset($viewTheme)){
        $themeCode = file('flutter_dev/themes/viewPage/'.$viewTheme.'/code.txt');
        $themeCode = implode($themeCode);
        $themeCode=str_replace("##section_name##",$section_flag,$themeCode);
        $themeCode=str_replace("##Capital_table_name##",$Capital_table_name,$themeCode);
    }

    //get items name foreach item and its field from DB on new module
    $xmlContnet=simplexml_load_file('flutter_dev/themes/viewPage/'.$viewTheme.'/items.xml');
    foreach ($xmlContnet as $item){
        $itemName=$item->name;
        $moduleFieldName=$input['item_'.$itemName];
//            $moduleFieldName="id";
        $themeCode=str_replace('##'.$itemName.'##',$moduleFieldName,$themeCode);
    }

    $themeCode=str_replace('##OrderBtn##',$orderBtnCode,$themeCode);
    $themeCode=str_replace('##$SectionEdit_DeleteCode##',$SectionEdit_DeleteCode,$themeCode);
    $themeCode=str_replace('﻿','',$themeCode);



    $page_content='
        import \'../../Controllers/'.$controller_name.'.dart\';
import \'../../helpers/LoaderDialog.dart\';
import \'../../helpers/ToastHelper.dart\';
import \'../../helpers/LanguageHelper.dart\' as LanguageHelper;
import \'../../main.dart\';
import \'../../helpers/SizeConfig.dart\';
import \'package:flutter/widgets.dart\';
import \'package:flutter/material.dart\';
import \'../Home.dart\';
import \'package:carousel_slider/carousel_slider.dart\';

import \'../../Views/'.$table_name.'/index.dart\';
import \'../../Views/'.$table_name.'/update.dart\';


class '.$Capital_table_name.'View extends StatefulWidget {

  final int id;
  '.$Capital_table_name.'View(this.id);

  @override
  State<StatefulWidget> createState() {
    // TODO: implement createState
    return _'.$Capital_table_name.'ViewState();
  }
}

class _'.$Capital_table_name.'ViewState extends State<'.$Capital_table_name.'View>{
  //declare variables here
var language = LanguageHelper.Language;
    final List<String> imgList = [];
    bool ViewImage = '.$ViewPage_ViewImage.';
    String ViewedImageType = "'.$ViewPage_ViewImageType.'";
  var data;

  '.$controller_name.' _'.$controller_name.' = new '.$controller_name.'();
  read() async {

  await LanguageHelper.initialize();
    language = LanguageHelper.Language;

    //get  data
    Future.delayed(Duration.zero, () => showLoaderDialogFunction(context));
    _'.$controller_name.'.view(widget.id).whenComplete((){
      if(_'.$controller_name.'.status == true){
        setState(() {
          data = _'.$controller_name.'.data;
        });
        Future.delayed(Duration.zero, () => hideLoaderDialogFunction(context));
      }else{
        ShowToast(\'warning\',_'.$controller_name.'.message);
        Future.delayed(Duration.zero, () => hideLoaderDialogFunction(context));
      }
    });
  }

  '.$deleteFunctions.'


  @override
  void initState() {
    // TODO: implement initState
    super.initState();
    read();
  }
  @override
  void dispose() {
    // TODO: implement dispose
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    // TODO: implement build
    SizeConfig().init(context); // for media query
    var screenWidthRatio = 10;
    var screenHightRatio = 35;
    var contenttopalignmentratio=20;
    if(SizeConfig.orientation == Orientation.landscape){
      screenWidthRatio = 20 ;
      screenHightRatio = 55 ;

      contenttopalignmentratio=10;
    }
    else{
      screenWidthRatio = 10 ;
      screenHightRatio = 35 ;

      contenttopalignmentratio=3;
    }

    '.$themeCode.'
  }
}
';

    $file = 'view.dart';
    $destinationPath="flutter_dev/".$App_Folder_Name."/lib/Views/".$section_flag."/";
    if (!is_dir($destinationPath)) {  mkdir($destinationPath,0777,true);  }
    File::put($destinationPath.$file,$page_content);

    /******************************/
    /******End View page Content******/
    /******************************/
}




    public function CreateFlutterStorePage($controller_name,$Capital_table_name,$table_fields,$table_name,$input,$section_flag,$App_Folder_Name){

        /******************************/
        /******start Store page Content******/
        /******************************/

        $Fields_Controller='';
        $ifStatmentsForFields='';
        $storeFunctionParametes='';
        $UpdateStateStatments='';
        $formTextFields='';
        $andand='';
        $comma='';
        $toStringVar='';
        $imageDesignCode='';
        $imageDesignFunction='';
        foreach ($table_fields as $table_field){
            if(isset($input[$table_field.'_mobileAPIActive'])){


                $new_line='';
                //get parametes for store function
                if($input[$table_field.'_datatype'] == 'number' || $input[$table_field.'_datatype'] == 'join_select'|| $input[$table_field.'_datatype'] == 'table_to_select' ){
                    if($table_field !='user_id') {
                        $new_line = 'final TextEditingController _' . $table_field . 'Controller = new TextEditingController();';
                        $Fields_Controller = $Fields_Controller . $new_line;
                        //get if statments code
                        $statment_line = '_' . $table_field . 'Controller.text.trim().isNotEmpty';
                        $ifStatmentsForFields = $ifStatmentsForFields . $andand . $statment_line;
                        $newParameterline = 'int.parse(_' . $table_field . 'Controller.text.trim())';
                        $storeFunctionParametes .= $comma . $newParameterline;
                        $toStringVar = '.toString()';
                        $updateNewLine = '_' . $table_field . 'Controller.text=_' . $controller_name . '.data["data"]["' . $table_field . '"]' . $toStringVar . ';';
                        //get form text fields
                        $textFieldNewline = '
                                            TextField(
                                                      controller: _' . $table_field . 'Controller,
                                                      style: Theme.of(context).textTheme.bodyText1,
                                                      keyboardType: TextInputType.text,
                                                      decoration: InputDecoration(
                                                        icon: Icon(Icons.arrow_left),
                                                        hintText:
                                                        LanguageHelper.trans("' . $table_name . '","' . $table_field . '"),
                                                        labelText:
                                                        LanguageHelper.trans("' . $table_name . '","' . $table_field . '"),
                                                      ),
                                                    ),
                                            ';
                        $formTextFields .= $textFieldNewline;
                        //this to update state and update text fields with ideal data
                        $UpdateStateStatments .= $updateNewLine;
                    }

                }
                elseif($input[$table_field.'_datatype'] == 'image'){
                    $newParameterline=$table_field;
                    $storeFunctionParametes.=$comma.$newParameterline;
                    $toStringVar='.toString()';

                    $imageDesignFunction='
                    var '.$table_field.';
                    Future getImage() async {
                      FocusScopeNode currentFocus = FocusScope.of(context);
                      if (!currentFocus.hasPrimaryFocus) {
                        currentFocus.unfocus();
                      }
                      var picked_'.$table_field.' = await ImagePicker.platform.pickImage(source: ImageSource.gallery);
                      setState(() {
                        '.$table_field.' = File(picked_'.$table_field.'!.path);
                      });
                    }
                    ';




                    $imageDesignCode.='
                    '.$table_field.' != null ?
                            Image.file('.$table_field.',width: 150,height: 150,)
                            :Text(
                                LanguageHelper.trans("app","noImageSelected")
                            ),
                                  RaisedButton(
                                    onPressed: getImage,
                                    child: Icon(
                                      Icons.add_a_photo,
                                      color: Colors.white,
                                    ),
                                  ),
                    ';
                }
                else{

                    if($table_field !='user_id') {
                        $new_line = 'final TextEditingController _' . $table_field . 'Controller = new TextEditingController();';
                        $Fields_Controller = $Fields_Controller . $new_line;
                        //get if statments code
                        $statment_line = '_' . $table_field . 'Controller.text.trim().isNotEmpty';
                        $ifStatmentsForFields = $ifStatmentsForFields . $andand . $statment_line;
                        $newParameterline = '_' . $table_field . 'Controller.text.trim()';
                        $storeFunctionParametes .= $comma . $newParameterline;
                        $toStringVar = '.toString()';
                        $updateNewLine = '_' . $table_field . 'Controller.text=_' . $controller_name . '.data["data"]["' . $table_field . '"]' . $toStringVar . ' ;';
                        //get form text fields
                        $textFieldNewline = 'TextField(
                                                      controller: _' . $table_field . 'Controller,
                                                      style: Theme.of(context).textTheme.bodyText1,
                                                      keyboardType: TextInputType.text,
                                                      decoration: InputDecoration(
                                                        icon: Icon(Icons.arrow_left),
                                                        hintText:
                                                        LanguageHelper.trans("' . $table_name . '","' . $table_field . '"),
                                                        labelText:LanguageHelper.trans("' . $table_name . '","' . $table_field . '"),
                                                      ),
                                                    ),
                                            ';
                        $formTextFields .= $textFieldNewline;
                        //this to update state and update text fields with ideal data
                        $UpdateStateStatments .= $updateNewLine;
                    }
                }

                if($table_field !='user_id') {
                    $andand = '&&';
                    $comma = ',';
                }

            }

        }

        $page_content='
import \'../../Controllers/'.$controller_name.'.dart\';
import \'../../helpers/LoaderDialog.dart\';
import \'../../helpers/ToastHelper.dart\';
import \'../../helpers/LanguageHelper.dart\' as LanguageHelper;
import \'../../main.dart\';
import \'../../helpers/SizeConfig.dart\';
import \'package:flutter/widgets.dart\';
import \'package:flutter/material.dart\';
import \'../Home.dart\';
import \'dart:async\';
import \'dart:io\';
import \'package:flutter/cupertino.dart\';
import \'package:flutter/src/widgets/basic.dart\';
import \'package:image_picker/image_picker.dart\';

import \'../../Views/'.$table_name.'/index.dart\';

class '.$Capital_table_name.'Store extends StatefulWidget {
  @override
  State<StatefulWidget> createState() {
    // TODO: implement createState
    return _'.$Capital_table_name.'StoreState();
  }
}

class _'.$Capital_table_name.'StoreState extends State<'.$Capital_table_name.'Store>{
  //declare variables here

var language = LanguageHelper.Language;
  var data;

  '.$imageDesignFunction.'


  '.$controller_name.' _'.$controller_name.' = new '.$controller_name.'();

  '.$Fields_Controller.'

  _onPressedStore(){
    setState(() {
      showLoaderDialogFunction(context);
      if('.$ifStatmentsForFields.'){
        _'.$controller_name.'.store('.$storeFunctionParametes.').whenComplete((){
          if(_'.$controller_name.'.status == true){
            hideLoaderDialogFunction(context);
            ShowToast(\'success\',_'.$controller_name.'.message);
            Navigator.push(
                context,
                MaterialPageRoute(builder: (context) =>'.$Capital_table_name.'Index())
            );
          }else{
            hideLoaderDialogFunction(context);
            ShowToast(\'warning\',_'.$controller_name.'.message);
          }
        });
      }
      else{
        hideLoaderDialogFunction(context);
        ShowToast(\'error\',
        LanguageHelper.trans("app","pleasefillallfields"));
      }
    });
  }

  read() async {
    await LanguageHelper.initialize();
    language = LanguageHelper.Language;
  }


  @override
  void initState() {
    // TODO: implement initState
    super.initState();
    read();
  }
  @override
  void dispose() {
    // TODO: implement dispose
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    // TODO: implement build
    SizeConfig().init(context); // for media query
    var screenWidthRatio = 10;
    var screenHightRatio = 35;
    var contenttopalignmentratio=20;
    if(SizeConfig.orientation == Orientation.landscape){
      screenWidthRatio = 20 ;
      screenHightRatio = 55 ;

      contenttopalignmentratio=10;
    }
    else{
      screenWidthRatio = 10 ;
      screenHightRatio = 35 ;

      contenttopalignmentratio=3;
    }
return Scaffold(
      appBar: AppBar(
        title:Text(
        LanguageHelper.trans("'.$table_name.'","'.$Capital_table_name.'"),
          style: Theme.of(context).textTheme.subtitle1,
        ),
        centerTitle: true,
        leading: IconButton(icon:Icon(Icons.arrow_back),
        onPressed:() => Navigator.of(context).push(
        MaterialPageRoute(builder: (context) => '.$Capital_table_name.'Index())
        ),
        ),
      ),

      body: Container(
        child: ListView(
        padding: EdgeInsets.all(10.0),
                          children: <Widget>[
                            '.$formTextFields.'
                            '.$imageDesignCode.'

                        SizedBox(
                          height: 20,
                        ),
                        RaisedButton(
                          color: Theme.of(context).primaryColor ,
                          child:  Text(
                          LanguageHelper.trans("app","create"),
                            style: Theme.of(context).textTheme.button,
                          ),
                          onPressed: _onPressedStore,
                        ),
                      ]
                      ),
              )
    );
  }
}
';

        $file = 'store.dart';
        $destinationPath="flutter_dev/".$App_Folder_Name."/lib/Views/".$section_flag."/";
        if (!is_dir($destinationPath)) {  mkdir($destinationPath,0777,true);  }
        File::put($destinationPath.$file,$page_content);

        /******************************/
        /******End Store page Content******/
        /******************************/
    }




    public function CreateFlutterUpdatePage($controller_name,$Capital_table_name,$table_fields,$table_name,$input,$section_flag,$App_Folder_Name){

        /******************************/
        /******start Update page Content******/
        /******************************/

        $Fields_Controller='';
        $ifStatmentsForFields='';
        $storeFunctionParametes='';
        $UpdateStateStatments='data=_'.$controller_name.'.data;';
        $formTextFields='';
        $andand='';
        $comma='';
         $toStringVar='';
        $imageDesignCode='';
        $imageDesignFunction='';
        foreach ($table_fields as $table_field){
            if(isset($input[$table_field.'_mobileAPIActive'])){

                $new_line='';

                //get parametes for store function
                if($input[$table_field.'_datatype'] == 'number' ||
                    $input[$table_field.'_datatype'] == 'join_select'||
                    $input[$table_field.'_datatype'] == 'table_to_select' ){
                    if($table_field !='user_id') {
                        $new_line = 'final TextEditingController _' . $table_field . 'Controller = new TextEditingController();';
                        $Fields_Controller = $Fields_Controller . $new_line;
                        //get if statments code
                        $statment_line = '_' . $table_field . 'Controller.text.trim().isNotEmpty';
                        $ifStatmentsForFields = $ifStatmentsForFields . $andand . $statment_line;
                        $newParameterline = 'int.parse(_' . $table_field . 'Controller.text.trim())';
                        $storeFunctionParametes .= $comma . $newParameterline;
                        $toStringVar = '.toString()';
                        $updateNewLine = '_' . $table_field . 'Controller.text=_' . $controller_name . '.data["data"]["' . $table_field . '"]' . $toStringVar . ' ;';
                        //get form text fields
                        $textFieldNewline = '
                                            TextField(
                                                      controller: _' . $table_field . 'Controller,
                                                      style: Theme.of(context).textTheme.bodyText1,
                                                      keyboardType: TextInputType.text,
                                                      decoration: InputDecoration(
                                                        icon: Icon(Icons.arrow_left),
                                                        hintText: LanguageHelper.trans("' . $table_name . '","' . $table_field . '"),
                                                        labelText:LanguageHelper.trans("' . $table_name . '","' . $table_field . '"),
                                                      ),
                                                    ),
                                            ';
                        //this to update state and update text fields with ideal data
                        $UpdateStateStatments .= $updateNewLine;
                        $formTextFields .= $textFieldNewline;
                    }

                }
                elseif($input[$table_field.'_datatype'] == 'image'){
                    $newParameterline=$table_field;
                    $storeFunctionParametes.=$comma.$newParameterline;
                    $toStringVar='.toString()';

                    $imageDesignFunction='
                    var '.$table_field.';
                    Future getImage() async {
                      FocusScopeNode currentFocus = FocusScope.of(context);
                      if (!currentFocus.hasPrimaryFocus) {
                        currentFocus.unfocus();
                      }
                      var picked_'.$table_field.' = await ImagePicker.platform.pickImage(source: ImageSource.gallery);
                      setState(() {
                        '.$table_field.' = File(picked_'.$table_field.'!.path);
                      });
                    }
                    ';


                    $imageDesignCode.='
                    FadeInImage.assetNetwork(
                                    placeholder:"assets/images/noimage.png" ,
                                    image: data != null ? "http://192.168.1.6/framework1.7/"+data["data"]["'.$table_field.'"] : "assets/images/noimage.png" ,
                                  ),

                                  '.$table_field.' != null ?
                                    Image.file('.$table_field.',width: 150,height: 150,)
                                    :Text(
                                        LanguageHelper.trans("app","noImageSelected")
                                    ),

                                  RaisedButton(
                                    onPressed: getImage,
                                    child: Icon(
                                      Icons.add_a_photo,
                                      color: Colors.white,
                                    ),
                                  ),
                    ';
                }
                else{
                    if($table_field !='user_id') {
                        $new_line = 'final TextEditingController _' . $table_field . 'Controller = new TextEditingController();';
                        $Fields_Controller = $Fields_Controller . $new_line;
                        //get if statments code
                        $statment_line = '_' . $table_field . 'Controller.text.trim().isNotEmpty';
                        $ifStatmentsForFields = $ifStatmentsForFields . $andand . $statment_line;
                        $newParameterline = '_' . $table_field . 'Controller.text.trim()';
                        $storeFunctionParametes .= $comma . $newParameterline;
                        $toStringVar = '.toString()';
                        $updateNewLine = '_' . $table_field . 'Controller.text=_' . $controller_name . '.data["data"]["' . $table_field . '"]' . $toStringVar . ' ;';
                        //get form text fields
                        $textFieldNewline = 'TextField(
                                                      controller: _' . $table_field . 'Controller,
                                                      style: Theme.of(context).textTheme.bodyText1,
                                                      keyboardType: TextInputType.text,
                                                      decoration: InputDecoration(
                                                        icon: Icon(Icons.arrow_left),
                                                        hintText:LanguageHelper.trans("' . $table_name . '","' . $table_field . '"),
                                                        labelText:LanguageHelper.trans("' . $table_name . '","' . $table_field . '"),
                                                      ),
                                                    ),
                                            ';
                        //this to update state and update text fields with ideal data
                        $UpdateStateStatments .= $updateNewLine;
                        $formTextFields .= $textFieldNewline;
                    }
                }


                if($table_field !='user_id') {
                    $andand = '&&';
                    $comma = ',';
                }

            }

        }

        $page_content='
        import \'../../Controllers/'.$controller_name.'.dart\';
import \'../../helpers/LoaderDialog.dart\';
import \'../../helpers/ToastHelper.dart\';
import \'../../helpers/LanguageHelper.dart\' as LanguageHelper;
import \'../../main.dart\';
import \'../../helpers/SizeConfig.dart\';
import \'package:flutter/widgets.dart\';
import \'package:flutter/material.dart\';
import \'../Home.dart\';
import \'dart:async\';
import \'dart:io\';
import \'package:flutter/cupertino.dart\';
import \'package:flutter/src/widgets/basic.dart\';
import \'package:image_picker/image_picker.dart\';

import \'../../Views/'.$table_name.'/index.dart\';


class '.$Capital_table_name.'Update extends StatefulWidget {

  final int id;
  '.$Capital_table_name.'Update(this.id);
  @override
  State<StatefulWidget> createState() {
    // TODO: implement createState
    return _'.$Capital_table_name.'UpdateState();
  }
}

class _'.$Capital_table_name.'UpdateState extends State<'.$Capital_table_name.'Update>{
  //declare variables here
  var language = LanguageHelper.Language;
  var data;


  '.$imageDesignFunction.'


  '.$controller_name.' _'.$controller_name.' = new '.$controller_name.'();

  '.$Fields_Controller.'

  _onPressedUpdate(){
    setState(() {
      showLoaderDialogFunction(context);
      if('.$ifStatmentsForFields.'){
        _'.$controller_name.'.update(widget.id,'.$storeFunctionParametes.').whenComplete((){
          if(_'.$controller_name.'.status == true){
            hideLoaderDialogFunction(context);
            ShowToast(\'success\',_'.$controller_name.'.message);
            Navigator.push(
                context,
                MaterialPageRoute(builder: (context) =>'.$Capital_table_name.'Index())
            );
          }else{
            hideLoaderDialogFunction(context);
            ShowToast(\'warning\',_'.$controller_name.'.message);
          }
        });
      }
      else{
        hideLoaderDialogFunction(context);
        ShowToast(\'error\',
        LanguageHelper.trans("app","pleasefillallfields")
        );
      }
    });
  }

  read() async {

  await LanguageHelper.initialize();
    language = LanguageHelper.Language;

    Future.delayed(Duration.zero, () => showLoaderDialogFunction(context));
    _'.$controller_name.'.view(widget.id).whenComplete((){
      if(_'.$controller_name.'.status == true){
        setState(() {
          '.$UpdateStateStatments.'
        });
        Future.delayed(Duration.zero, () => hideLoaderDialogFunction(context));
      }else{
        ShowToast(\'warning\',_'.$controller_name.'.message);
        Future.delayed(Duration.zero, () => hideLoaderDialogFunction(context));
      }
    });
  }


  @override
  void initState() {
    // TODO: implement initState
    super.initState();
    read();
  }
  @override
  void dispose() {
    // TODO: implement dispose
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    // TODO: implement build
    SizeConfig().init(context); // for media query
    var screenWidthRatio = 10;
    var screenHightRatio = 35;
    var contenttopalignmentratio=20;
    if(SizeConfig.orientation == Orientation.landscape){
      screenWidthRatio = 20 ;
      screenHightRatio = 55 ;

      contenttopalignmentratio=10;
    }
    else{
      screenWidthRatio = 10 ;
      screenHightRatio = 35 ;

      contenttopalignmentratio=3;
    }
return Scaffold(
      appBar: AppBar(
        title:Text(
        LanguageHelper.trans("'.$table_name.'","'.$Capital_table_name.'"),
          style: Theme.of(context).textTheme.subtitle1,
        ),
        centerTitle: true,
        leading: IconButton(icon:Icon(Icons.arrow_back),
        onPressed:() => Navigator.of(context).push(
        MaterialPageRoute(builder: (context) => '.$Capital_table_name.'Index())
        ),
        ),
      ),

      body: Container(
              child: ListView(
              padding: EdgeInsets.all(10.0),
                                children: <Widget>[
                                  '.$formTextFields.'
                                  '.$imageDesignCode.'

                              SizedBox(
                                height: 20,
                              ),
                              RaisedButton(
                                color: Theme.of(context).primaryColor ,
                                child:  Text(
                                LanguageHelper.trans("app","update"),
                                  style: Theme.of(context).textTheme.button,
                                ),
                                onPressed: _onPressedUpdate,
                              ),
                            ]
                            ),
                    )
    );
  }
}
';

        $file = 'update.dart';
        $destinationPath="flutter_dev/".$App_Folder_Name."/lib/Views/".$section_flag."/";
        if (!is_dir($destinationPath)) {  mkdir($destinationPath,0777,true);  }
        File::put($destinationPath.$file,$page_content);

        /******************************/
        /******End Update page Content******/
        /******************************/
    }


    function UpdateFlutterLanguageFiles($table_fields,$section_flag,$table_name,$Capital_table_name,$input,$App_Folder_Name)
    {

        //get ar and en lang content
        //get fields
        $ar_lines = '
        getTranslation(String message_name) {
              var translation_response = "not found $message_name";
              messages.forEach((key, value) {
                if (key == message_name) {
                  translation_response = value;
                }
              });
              return translation_response;
            }

            var messages = {
        ';
        $en_lines = '
        getTranslation(String message_name) {
              var translation_response = "not found $message_name";
              messages.forEach((key, value) {
                if (key == message_name) {
                  translation_response = value;
                }
              });
              return translation_response;
            }

            var messages = {
        ';
        foreach ($table_fields as $table_field) {
            $ar_lines .= '"' . $table_field . '": "' . $input[$table_field . "_ar"] . '",
            ';
            $en_lines .= '"' . $table_field . '": "' . $input[$table_field . "_en"] . '",
            ';
        }

        //add translation for tanle name and module name
        //for google translate object
        $trans = new GoogleTranslate();
        //translate table name
        $source = 'en';
        $target = 'ar';
        $module_name=$input['module_name'];
        $table_name_USfirst = ucfirst($table_name);
        $module_name_ar= $trans->translate($source, $target, $module_name);
        $table_name_ar= $trans->translate($source, $target, $table_name);
        $table_name_USfirst_ar= $trans->translate($source, $target, $table_name_USfirst);
        $en_lines .= '"' . $table_name . '": "' . $table_name . '",
            ';
        $ar_lines .= '"' . $table_name . '": "' . $table_name_ar . '",
            ';
        $en_lines .= '"' . $module_name . '": "' . $module_name . '",
            ';
        $ar_lines .= '"' . $module_name . '": "' . $module_name_ar . '",
            ';
        $en_lines .= '"' . $table_name_USfirst . '": "' . $table_name_USfirst . '",
            ';
        $ar_lines .= '"' . $table_name_USfirst . '": "' . $table_name_USfirst_ar . '",
            ';

        //add another basic translation
        $language_array_tags=[];
        array_push($language_array_tags,array(
            "tag" => "searchHere",
            "ar_translation" => "ابحث هنا ..",
            "en_translation" => "Search here .."
        ));
        array_push($language_array_tags,array(
            "tag" => "NoListData",
            "ar_translation" => "عفوا لايوجد مزيد من البيانات",
            "en_translation" => "there are no more data"
        ));
        array_push($language_array_tags,array(
            "tag" => "pullupload",
            "ar_translation" => "اسحب لتحميل المزيد من البيانات",
            "en_translation" => "pull to load more .."
        ));
        array_push($language_array_tags,array(
            "tag" => "loadFailed",
            "ar_translation" => "فشل تحميل المزيد من البيانات",
            "en_translation" => "load Failed"
        ));
        array_push($language_array_tags,array(
            "tag" => "releaseToloadMore",
            "ar_translation" => "حرر يدك لعرض البيانات",
            "en_translation" => "release to load more"
        ));
        array_push($language_array_tags,array(
            "tag" => "NomoreData",
            "ar_translation" => "لايوجد المزيد من البيانات",
            "en_translation" => "there are no more data"
        ));
        array_push($language_array_tags,array(
            "tag" => "SARcurrency",
            "ar_translation" => " ر.س ",
            "en_translation" => " SAR "
        ));
        array_push($language_array_tags,array(
            "tag" => "pleasefillallfields",
            "ar_translation" => "من فضلك اكتب بيانات جميع الحقول",
            "en_translation" => "please fill all fields"
        ));
        array_push($language_array_tags,array(
            "tag" => "create",
            "ar_translation" => "إضافة",
            "en_translation" => "create"
        ));
        array_push($language_array_tags,array(
            "tag" => "noImageSelected",
            "ar_translation" => "لم يتم اختيار صورة",
            "en_translation" => "no image selected"
        ));
        array_push($language_array_tags,array(
            "tag" => "update",
            "ar_translation" => "تحديث",
            "en_translation" => "update"
        ));
        array_push($language_array_tags,array(
            "tag" => "yes",
            "ar_translation" => "نعم",
            "en_translation" => "yes"
        ));
        array_push($language_array_tags,array(
            "tag" => "no",
            "ar_translation" => "لا",
            "en_translation" => "no"
        ));
        array_push($language_array_tags,array(
            "tag" => "order",
            "ar_translation" => "اطلب",
            "en_translation" => "order"
        ));
        array_push($language_array_tags,array(
            "tag" => "edit",
            "ar_translation" => "تعديل",
            "en_translation" => "edit"
        ));
        array_push($language_array_tags,array(
            "tag" => "delete",
            "ar_translation" => "حذف",
            "en_translation" => "delete"
        ));



        foreach ($language_array_tags as $tag){
            $ar_lines .= '"' . $tag["tag"] . '": "' . $tag["ar_translation"]  . '",
            ';
            $en_lines .= '"' . $tag["tag"]  . '": "' . $tag["en_translation"]  . '",
            ';
        }

        $ar_lines .= "};";
        $en_lines .= "};";

        $file = $section_flag . '.dart';
        $ar_destinationPath = "flutter_dev/" . $App_Folder_Name . "/lib/lang/ar/";
        $en_destinationPath = "flutter_dev/" . $App_Folder_Name . "/lib/lang/en/";
        if (!is_dir($ar_destinationPath)) {
            mkdir($ar_destinationPath, 0777, true);
        }
        if (!is_dir($en_destinationPath)) {
            mkdir($en_destinationPath, 0777, true);
        }
        File::put($ar_destinationPath . $file, $ar_lines);
        File::put($en_destinationPath . $file, $en_lines);


        //add translation functions to language helper
        $import_file_lines='
        import \'../../lang/ar/'.$table_name.'.dart\' as '.$table_name.'_messages_ar;
        import \'../../lang/en/'.$table_name.'.dart\' as '.$table_name.'_messages_en;
        ';
        $lang_helper_file=file('flutter_dev/framework1.7/lib/helpers/LanguageHelper.dart');
        $lang_helper_des_file = implode($lang_helper_file);
        $lang_helper_file=str_replace(
            '/*Import Additional languages files here*/',
            '
            '.$import_file_lines.'
            /*Import Additional languages files here*/',
            $lang_helper_file
        );

        $lang_function_lines='
        if (module == "'.$table_name.'"){
            Language == "en" ? translate = '.$table_name.'_messages_en.getTranslation(word_text)
            : translate = '.$table_name.'_messages_ar.getTranslation(word_text);
          }
        ';
        $lang_helper_file=str_replace(
            '/*Add Additional languages functions here*/',
            '
            '.$lang_function_lines.'
            /*Add Additional languages functions here*/',
            $lang_helper_file
        );

        $lang_helper_des_file='flutter_dev/framework1.7/lib/helpers/LanguageHelper.dart';
        $lang_helper_file = implode("", $lang_helper_file); //Put the array back into one string
        file_put_contents($lang_helper_des_file, $lang_helper_file);



//
//            $message_message_file ="flutter_dev/".$App_Folder_Name."/lib/l10n/messages_messages.dart";
//            if($table_field != 'id' && $table_field != 'user_id' &&
//                $table_field != 'created_at' && $table_field != 'updated_at'  ){
//
//                $content = file($message_message_file);
//                //Read the file into an array. and check if its translation is inserted before or not
//                $search = '"'.$table_field.'"';
//                $matches=false;
//                foreach($content as $line)
//                {
//                    // Check if the line contains the string we're looking for, and print if it does
//                    if(strpos($line, $search) !== false)
//                        $matches=true;
//                }
//                if($matches == false){
//                    $ar_new_line='
//                    "'.$table_field.'" : MessageLookupByLibrary.simpleMessage("'.$input[$table_field."_ar"].'"),';
//                        $en_new_line='
//                    "'.$table_field.'" : MessageLookupByLibrary.simpleMessage("'.$input[$table_field."_en"].'"),';
//                        $ar_lines=$ar_lines.$ar_new_line;
//                        $en_lines=$en_lines.$en_new_line;
//
//                        $locatizationLines=$locatizationLines.'
//                        String get '.$table_field.' {
//                            return Intl.message("'.$table_field.'", name: "'.$table_field.'");
//                          }
//                    ';
//                }
//            }
//
//        }
//
//        //table name translation
//        $content = file($message_message_file);
//        //Read the file into an array. and check if its translation is inserted before or not
//        $search = $Capital_table_name;
//        $matches=false;
//        foreach($content as $line)
//        {
//            // Check if the line contains the string we're looking for, and print if it does
//            if(strpos($line, $search) !== false)
//                $matches=true;
//        }
//        if($matches == false){
//            $ar_line_table_name='
//            "'.$Capital_table_name.'" : MessageLookupByLibrary.simpleMessage("'.$input['section_name_ar'].'"),';
//            $en_line_table_name='
//            "'.$Capital_table_name.'" : MessageLookupByLibrary.simpleMessage("'.$table_name.'"),';
//            $locatizationLine_table_name='
//                            String get '.$Capital_table_name.' {
//                                return Intl.message("'.$Capital_table_name.'", name: "'.$Capital_table_name.'");
//                              }
//                        ';
//        }
//        else{
//            $ar_line_table_name='';
//            $en_line_table_name='';
//            $locatizationLine_table_name='';
//        }
//
//        $ar_lines=$ar_lines.$ar_line_table_name;
//        $en_lines=$en_lines.$en_line_table_name;
//        $locatizationLines=$locatizationLines.$locatizationLine_table_name;
//
//         //update all messages file
//         $message_message_file ="flutter_dev/".$App_Folder_Name."/lib/l10n/messages_messages.dart";
//         $messages_en_file ="flutter_dev/".$App_Folder_Name."/lib/l10n/messages_en.dart";
//         $messages_ar_file ="flutter_dev/".$App_Folder_Name."/lib/l10n/messages_ar.dart";
//         $locatizationFile ="flutter_dev/".$App_Folder_Name."/lib/localizations.dart";
//
//
//         //update File 1
//         $content = file($message_message_file);
//        //Read the file into an array. Line number => line content
//        foreach($content as $lineNumber => &$lineContent)
//        {
//            if($lineNumber == 80) {
//                $lineContent .= $en_lines. PHP_EOL; //Modify the line. (We're adding another line by using PHP_EOL)
//            }
//        }
//        $allContent = implode("", $content); //Put the array back into one string
//        file_put_contents($message_message_file, $allContent);
//
//
//
//         //update File 2
//                  $content = file($messages_en_file);
//                  //Read the file into an array. Line number => line content
//                  foreach($content as $lineNumber => &$lineContent)
//                  {
//                      if($lineNumber == 80) {
//                          $lineContent .= $en_lines . PHP_EOL; //Modify the line. (We're adding another line by using PHP_EOL)
//                      }
//                  }
//                  $allContent = implode("", $content); //Put the array back into one string
//                  file_put_contents($messages_en_file, $allContent);
//
//         //update File 3
//                  $content = file($messages_ar_file);
//                  //Read the file into an array. Line number => line content
//                  foreach($content as $lineNumber => &$lineContent)
//                  {
//                      if($lineNumber == 80) {
//                          $lineContent .= $ar_lines . PHP_EOL; //Modify the line. (We're adding another line by using PHP_EOL)
//                      }
//                  }
//                  $allContent = implode("", $content); //Put the array back into one string
//                  file_put_contents($messages_ar_file, $allContent);
//         //update File 4
//                  $content = file($locatizationFile);
//                  //Read the file into an array. Line number => line content
//                  foreach($content as $lineNumber => &$lineContent)
//                  {
//                      if($lineNumber == 180) {
//                          $lineContent .= $locatizationLines . PHP_EOL; //Modify the line. (We're adding another line by using PHP_EOL)
//                      }
//                  }
//                  $allContent = implode("", $content); //Put the array back into one string
//                  file_put_contents($locatizationFile, $allContent);
//
//
//
//
    }

}
