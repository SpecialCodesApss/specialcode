
import '../../Controllers/B_testController.dart';
import '../../helpers/LoaderDialog.dart';
import '../../helpers/ToastHelper.dart';
import 'package:framework_01_5/helpers/LanguageHelper.dart' as LanguageHelper;
import '../../lang/ar/b_tests.dart' as messages_ar;
import '../../lang/en/b_tests.dart' as messages_en;
import '../../main.dart';
import '../../helpers/SizeConfig.dart';
import 'package:flutter/widgets.dart';
import 'package:flutter/material.dart';
import '../Home.dart';
import 'dart:async';
import 'dart:io';
import 'package:flutter/cupertino.dart';
import 'package:flutter/src/widgets/basic.dart';
import 'package:image_picker/image_picker.dart';

import '../../Views/b_tests/index.dart';

class B_testsStore extends StatefulWidget {
  @override
  State<StatefulWidget> createState() {
    // TODO: implement createState
    return _B_testsStoreState();
  }
}

class _B_testsStoreState extends State<B_testsStore>{
  //declare variables here
  
var language = LanguageHelper.Language;
  var data;
    
  
                    File image;
                      Future getImage() async {
                      //focusout from keyboard - its important due to error happen when load image thats clear last textfield
                      FocusScopeNode currentFocus = FocusScope.of(context);
                        if (!currentFocus.hasPrimaryFocus) {
                          currentFocus.unfocus();
                        }
                        
                        var image = await ImagePicker.pickImage(source: ImageSource.gallery);
                        setState(() {
                          image = image;
                        });
                      }
                    
  

  B_testController _B_testController = new B_testController();
  
  final TextEditingController _users_idsController = new TextEditingController();final TextEditingController _pages_idController = new TextEditingController();final TextEditingController _table_idsController = new TextEditingController();final TextEditingController _page_htmlController = new TextEditingController();final TextEditingController _test_2Controller = new TextEditingController();final TextEditingController _emailController = new TextEditingController();final TextEditingController _typeController = new TextEditingController();
  
  _onPressedStore(){
    setState(() {
      showLoaderDialogFunction(context);
      if(_users_idsController.text.trim().isNotEmpty&&_pages_idController.text.trim().isNotEmpty&&_table_idsController.text.trim().isNotEmpty&&_page_htmlController.text.trim().isNotEmpty&&_test_2Controller.text.trim().isNotEmpty&&_emailController.text.trim().isNotEmpty&&_typeController.text.trim().isNotEmpty){
        _B_testController.store(_users_idsController.text.trim(),int.parse(_pages_idController.text.trim()),_table_idsController.text.trim(),_page_htmlController.text.trim(),_test_2Controller.text.trim(),_emailController.text.trim(),image,_typeController.text.trim()).whenComplete((){
          if(_B_testController.status == true){
            hideLoaderDialogFunction(context);
            ShowToast('success',_B_testController.message);
            Navigator.push(
                context,
                MaterialPageRoute(builder: (context) =>B_testsIndex())
            );   
          }else{
            hideLoaderDialogFunction(context);
            ShowToast('warning',_B_testController.message);
          }
        });
      }
      else{
        hideLoaderDialogFunction(context);
        ShowToast('error',
        language =="en" ? messages_en.getTranslation("pleasefillallfields") : messages_ar.getTranslation("pleasefillallfields"));
      }
    });
  }
  
  read() async {
    
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
         language =="en" ? messages_en.getTranslation("B_tests") : messages_ar.getTranslation("B_tests"),
          style: Theme.of(context).textTheme.title,
        ),
        centerTitle: true,
        leading: IconButton(icon:Icon(Icons.arrow_back),
        onPressed:() => Navigator.of(context).push(
        MaterialPageRoute(builder: (context) => B_testsIndex())
        ),
        ),
      ),
      
      body: Container(
        child: ListView(
        padding: EdgeInsets.all(10.0),
                          children: <Widget>[
                            TextField(
                                                      controller: _users_idsController,
                                                      style: Theme.of(context).textTheme.body1,
                                                      keyboardType: TextInputType.text,
                                                      decoration: InputDecoration(
                                                        icon: Icon(Icons.arrow_left),
                                                        hintText: language =="en" ? messages_en.getTranslation("users_ids") : messages_ar.getTranslation("users_ids"),
                                                        labelText:language =="en" ? messages_en.getTranslation("users_ids") : messages_ar.getTranslation("users_ids"),
                                                      ),
                                                    ),
                                            
                                            TextField(
                                                      controller: _pages_idController,
                                                      style: Theme.of(context).textTheme.body1,
                                                      keyboardType: TextInputType.text,
                                                      decoration: InputDecoration(
                                                        icon: Icon(Icons.arrow_left),
                                                        hintText:language =="en" ? messages_en.getTranslation("pages_id") : messages_ar.getTranslation("pages_id"),
                                                        labelText:language =="en" ? messages_en.getTranslation("pages_id") : messages_ar.getTranslation("pages_id"),
                                                      ),
                                                    ),
                                            TextField(
                                                      controller: _table_idsController,
                                                      style: Theme.of(context).textTheme.body1,
                                                      keyboardType: TextInputType.text,
                                                      decoration: InputDecoration(
                                                        icon: Icon(Icons.arrow_left),
                                                        hintText: language =="en" ? messages_en.getTranslation("table_ids") : messages_ar.getTranslation("table_ids"),
                                                        labelText:language =="en" ? messages_en.getTranslation("table_ids") : messages_ar.getTranslation("table_ids"),
                                                      ),
                                                    ),
                                            TextField(
                                                      controller: _page_htmlController,
                                                      style: Theme.of(context).textTheme.body1,
                                                      keyboardType: TextInputType.text,
                                                      decoration: InputDecoration(
                                                        icon: Icon(Icons.arrow_left),
                                                        hintText: language =="en" ? messages_en.getTranslation("page_html") : messages_ar.getTranslation("page_html"),
                                                        labelText:language =="en" ? messages_en.getTranslation("page_html") : messages_ar.getTranslation("page_html"),
                                                      ),
                                                    ),
                                            TextField(
                                                      controller: _test_2Controller,
                                                      style: Theme.of(context).textTheme.body1,
                                                      keyboardType: TextInputType.text,
                                                      decoration: InputDecoration(
                                                        icon: Icon(Icons.arrow_left),
                                                        hintText: language =="en" ? messages_en.getTranslation("test_2") : messages_ar.getTranslation("test_2"),
                                                        labelText:language =="en" ? messages_en.getTranslation("test_2") : messages_ar.getTranslation("test_2"),
                                                      ),
                                                    ),
                                            TextField(
                                                      controller: _emailController,
                                                      style: Theme.of(context).textTheme.body1,
                                                      keyboardType: TextInputType.text,
                                                      decoration: InputDecoration(
                                                        icon: Icon(Icons.arrow_left),
                                                        hintText: language =="en" ? messages_en.getTranslation("email") : messages_ar.getTranslation("email"),
                                                        labelText:language =="en" ? messages_en.getTranslation("email") : messages_ar.getTranslation("email"),
                                                      ),
                                                    ),
                                            TextField(
                                                      controller: _typeController,
                                                      style: Theme.of(context).textTheme.body1,
                                                      keyboardType: TextInputType.text,
                                                      decoration: InputDecoration(
                                                        icon: Icon(Icons.arrow_left),
                                                        hintText: language =="en" ? messages_en.getTranslation("type") : messages_ar.getTranslation("type"),
                                                        labelText:language =="en" ? messages_en.getTranslation("type") : messages_ar.getTranslation("type"),
                                                      ),
                                                    ),
                                            
                            
                                  image == null
                                      ? Text(
                                      language =="en" ? messages_en.getTranslation("noImageSelected") : messages_ar.getTranslation("noImageSelected"))
                                      : Image.file(image),
                                  RaisedButton(
                                    onPressed: getImage,
                                    child: Icon(
                                      Icons.add_a_photo,
                                      color: Colors.white,
                                    ),
                                  ),
                    
                            
                        SizedBox(
                          height: SizeConfig.screenWidth / screenHightRatio,
                        ),
                        RaisedButton(
                          color: Theme.of(context).primaryColor ,
                          child:  Text(
                            language =="en" ? messages_en.getTranslation("create") : messages_ar.getTranslation("create"),
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
