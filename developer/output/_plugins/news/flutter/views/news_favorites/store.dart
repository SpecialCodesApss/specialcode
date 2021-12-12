
import '../../Controllers/News_favoriteController.dart';
import '../../helpers/LoaderDialog.dart';
import '../../helpers/ToastHelper.dart';
import 'package:framework_01_6/helpers/LanguageHelper.dart' as LanguageHelper;
import '../../lang/ar/news_favorites.dart' as messages_ar;
import '../../lang/en/news_favorites.dart' as messages_en;
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

import '../../Views/news_favorites/index.dart';

class News_favoritesStore extends StatefulWidget {
  @override
  State<StatefulWidget> createState() {
    // TODO: implement createState
    return _News_favoritesStoreState();
  }
}

class _News_favoritesStoreState extends State<News_favoritesStore>{
  //declare variables here
  
var language = LanguageHelper.Language;
  var data;
    
  
  

  News_favoriteController _News_favoriteController = new News_favoriteController();
  
  final TextEditingController _news_idController = new TextEditingController();final TextEditingController _user_idController = new TextEditingController();
  
  _onPressedStore(){
    setState(() {
      showLoaderDialogFunction(context);
      if(_news_idController.text.trim().isNotEmpty){
        _News_favoriteController.store(
            _news_idController.text.trim()).whenComplete((){
          if(_News_favoriteController.status == true){
            hideLoaderDialogFunction(context);
            ShowToast('success',_News_favoriteController.message);
            Navigator.push(
                context,
                MaterialPageRoute(builder: (context) =>News_favoritesIndex())
            );   
          }else{
            hideLoaderDialogFunction(context);
            ShowToast('warning',_News_favoriteController.message);
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
         language =="en" ? messages_en.getTranslation("News_favorites") : messages_ar.getTranslation("News_favorites"),
          style: Theme.of(context).textTheme.title,
        ),
        centerTitle: true,
        leading: IconButton(icon:Icon(Icons.arrow_back),
        onPressed:() => Navigator.of(context).push(
        MaterialPageRoute(builder: (context) => News_favoritesIndex())
        ),
        ),
      ),
      
      body: Container(
        child: ListView(
        padding: EdgeInsets.all(10.0),
                          children: <Widget>[
                            TextField(
                                                      controller: _news_idController,
                                                      style: Theme.of(context).textTheme.body1,
                                                      keyboardType: TextInputType.text,
                                                      decoration: InputDecoration(
                                                        icon: Icon(Icons.arrow_left),
                                                        hintText: language =="en" ? messages_en.getTranslation("news_id") : messages_ar.getTranslation("news_id"),
                                                        labelText:language =="en" ? messages_en.getTranslation("news_id") : messages_ar.getTranslation("news_id"),
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
