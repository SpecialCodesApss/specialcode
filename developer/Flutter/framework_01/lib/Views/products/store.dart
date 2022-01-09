
import '../../Controllers/ProductController.dart';
import '../../helpers/LoaderDialog.dart';
import '../../helpers/ToastHelper.dart';
import 'package:framework_01_5/helpers/LanguageHelper.dart' as LanguageHelper;
import '../../lang/ar/products.dart' as messages_ar;
import '../../lang/en/products.dart' as messages_en;
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

import '../../Views/products/index.dart';

class ProductsStore extends StatefulWidget {
  @override
  State<StatefulWidget> createState() {
    // TODO: implement createState
    return _ProductsStoreState();
  }
}

class _ProductsStoreState extends State<ProductsStore>{
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
                    


  ProductController _ProductController = new ProductController();

  final TextEditingController _name_arController = new TextEditingController();final TextEditingController _name_enController = new TextEditingController();final TextEditingController _description_arController = new TextEditingController();final TextEditingController _description_enController = new TextEditingController();final TextEditingController _html_text_arController = new TextEditingController();final TextEditingController _html_text_enController = new TextEditingController();final TextEditingController _activeController = new TextEditingController();final TextEditingController _user_idController = new TextEditingController();

  _onPressedStore(){
    setState(() {
      showLoaderDialogFunction(context);
      if(_name_arController.text.trim().isNotEmpty&&_name_enController.text.trim().isNotEmpty&&_description_arController.text.trim().isNotEmpty&&_description_enController.text.trim().isNotEmpty&&_html_text_arController.text.trim().isNotEmpty&&_html_text_enController.text.trim().isNotEmpty&&_activeController.text.trim().isNotEmpty&&_user_idController.text.trim().isNotEmpty){
        _ProductController.store(_name_arController.text.trim(),_name_enController.text.trim(),image,_description_arController.text.trim(),_description_enController.text.trim(),_html_text_arController.text.trim(),_html_text_enController.text.trim(),_activeController.text.trim(),_user_idController.text.trim()).whenComplete((){
          if(_ProductController.status == true){
            hideLoaderDialogFunction(context);
            ShowToast('success',_ProductController.message);
            Navigator.push(
                context,
                MaterialPageRoute(builder: (context) =>ProductsIndex())
            );
          }else{
            hideLoaderDialogFunction(context);
            ShowToast('warning',_ProductController.message);
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
         language =="en" ? messages_en.getTranslation("Products") : messages_ar.getTranslation("Products"),
          style: Theme.of(context).textTheme.title,
        ),
        centerTitle: true,
        leading: IconButton(icon:Icon(Icons.arrow_back),
        onPressed:() => Navigator.of(context).push(
        MaterialPageRoute(builder: (context) => ProductsIndex())
        ),
        ),
      ),

      body: Container(
        child: ListView(
        padding: EdgeInsets.all(10.0),
                          children: <Widget>[
                            TextField(
                                                      controller: _name_arController,
                                                      style: Theme.of(context).textTheme.body1,
                                                      keyboardType: TextInputType.text,
                                                      decoration: InputDecoration(
                                                        icon: Icon(Icons.arrow_left),
                                                        hintText: language =="en" ? messages_en.getTranslation("name_ar") : messages_ar.getTranslation("name_ar"),
                                                        labelText:language =="en" ? messages_en.getTranslation("name_ar") : messages_ar.getTranslation("name_ar"),
                                                      ),
                                                    ),
                                            TextField(
                                                      controller: _name_enController,
                                                      style: Theme.of(context).textTheme.body1,
                                                      keyboardType: TextInputType.text,
                                                      decoration: InputDecoration(
                                                        icon: Icon(Icons.arrow_left),
                                                        hintText: language =="en" ? messages_en.getTranslation("name_en") : messages_ar.getTranslation("name_en"),
                                                        labelText:language =="en" ? messages_en.getTranslation("name_en") : messages_ar.getTranslation("name_en"),
                                                      ),
                                                    ),
                                            TextField(
                                                      controller: _description_arController,
                                                      style: Theme.of(context).textTheme.body1,
                                                      keyboardType: TextInputType.text,
                                                      decoration: InputDecoration(
                                                        icon: Icon(Icons.arrow_left),
                                                        hintText: language =="en" ? messages_en.getTranslation("description_ar") : messages_ar.getTranslation("description_ar"),
                                                        labelText:language =="en" ? messages_en.getTranslation("description_ar") : messages_ar.getTranslation("description_ar"),
                                                      ),
                                                    ),
                                            TextField(
                                                      controller: _description_enController,
                                                      style: Theme.of(context).textTheme.body1,
                                                      keyboardType: TextInputType.text,
                                                      decoration: InputDecoration(
                                                        icon: Icon(Icons.arrow_left),
                                                        hintText: language =="en" ? messages_en.getTranslation("description_en") : messages_ar.getTranslation("description_en"),
                                                        labelText:language =="en" ? messages_en.getTranslation("description_en") : messages_ar.getTranslation("description_en"),
                                                      ),
                                                    ),
                                            TextField(
                                                      controller: _html_text_arController,
                                                      style: Theme.of(context).textTheme.body1,
                                                      keyboardType: TextInputType.text,
                                                      decoration: InputDecoration(
                                                        icon: Icon(Icons.arrow_left),
                                                        hintText: language =="en" ? messages_en.getTranslation("html_text_ar") : messages_ar.getTranslation("html_text_ar"),
                                                        labelText:language =="en" ? messages_en.getTranslation("html_text_ar") : messages_ar.getTranslation("html_text_ar"),
                                                      ),
                                                    ),
                                            TextField(
                                                      controller: _html_text_enController,
                                                      style: Theme.of(context).textTheme.body1,
                                                      keyboardType: TextInputType.text,
                                                      decoration: InputDecoration(
                                                        icon: Icon(Icons.arrow_left),
                                                        hintText: language =="en" ? messages_en.getTranslation("html_text_en") : messages_ar.getTranslation("html_text_en"),
                                                        labelText:language =="en" ? messages_en.getTranslation("html_text_en") : messages_ar.getTranslation("html_text_en"),
                                                      ),
                                                    ),
                                            TextField(
                                                      controller: _activeController,
                                                      style: Theme.of(context).textTheme.body1,
                                                      keyboardType: TextInputType.text,
                                                      decoration: InputDecoration(
                                                        icon: Icon(Icons.arrow_left),
                                                        hintText: language =="en" ? messages_en.getTranslation("active") : messages_ar.getTranslation("active"),
                                                        labelText:language =="en" ? messages_en.getTranslation("active") : messages_ar.getTranslation("active"),
                                                      ),
                                                    ),
                                            TextField(
                                                      controller: _user_idController,
                                                      style: Theme.of(context).textTheme.body1,
                                                      keyboardType: TextInputType.text,
                                                      decoration: InputDecoration(
                                                        icon: Icon(Icons.arrow_left),
                                                        hintText: language =="en" ? messages_en.getTranslation("user_id") : messages_ar.getTranslation("user_id"),
                                                        labelText:language =="en" ? messages_en.getTranslation("user_id") : messages_ar.getTranslation("user_id"),
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
