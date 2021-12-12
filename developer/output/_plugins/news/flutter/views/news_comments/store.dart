
import '../../Controllers/News_commentController.dart';
import '../../helpers/LoaderDialog.dart';
import '../../helpers/ToastHelper.dart';
import 'package:framework_01_6/helpers/LanguageHelper.dart' as LanguageHelper;
import '../../lang/ar/news_comments.dart' as messages_ar;
import '../../lang/en/news_comments.dart' as messages_en;
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

import '../../Views/news_comments/index.dart';

class News_commentsStore extends StatefulWidget {
  @override
  State<StatefulWidget> createState() {
    // TODO: implement createState
    return _News_commentsStoreState();
  }
}

class _News_commentsStoreState extends State<News_commentsStore>{
  //declare variables here
  
var language = LanguageHelper.Language;
  var data;
    
  
  

  News_commentController _News_commentController = new News_commentController();
  
  final TextEditingController _user_idController = new TextEditingController();final TextEditingController _comment_textController = new TextEditingController();final TextEditingController _users_likes_idsController = new TextEditingController();final TextEditingController _users_dislikes_idsController = new TextEditingController();final TextEditingController _activeController = new TextEditingController();
  
  _onPressedStore(){
    setState(() {
      showLoaderDialogFunction(context);
      if(
          _comment_textController.text.trim().isNotEmpty
         ){
        _News_commentController.store(
            _comment_textController.text.trim(),
        ).whenComplete((){
          if(_News_commentController.status == true){
            hideLoaderDialogFunction(context);
            ShowToast('success',_News_commentController.message);
            Navigator.push(
                context,
                MaterialPageRoute(builder: (context) =>News_commentsIndex())
            );   
          }else{
            hideLoaderDialogFunction(context);
            ShowToast('warning',_News_commentController.message);
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
         language =="en" ? messages_en.getTranslation("News_comments") : messages_ar.getTranslation("News_comments"),
          style: Theme.of(context).textTheme.title,
        ),
        centerTitle: true,
        leading: IconButton(icon:Icon(Icons.arrow_back),
        onPressed:() => Navigator.of(context).push(
        MaterialPageRoute(builder: (context) => News_commentsIndex())
        ),
        ),
      ),
      
      body: Container(
        child: ListView(
        padding: EdgeInsets.all(10.0),
                          children: <Widget>[

                                            TextField(
                                                      controller: _comment_textController,
                                                      style: Theme.of(context).textTheme.body1,
                                                      keyboardType: TextInputType.text,
                                                      decoration: InputDecoration(
                                                        icon: Icon(Icons.arrow_left),
                                                        hintText: language =="en" ? messages_en.getTranslation("comment_text") : messages_ar.getTranslation("comment_text"),
                                                        labelText:language =="en" ? messages_en.getTranslation("comment_text") : messages_ar.getTranslation("comment_text"),
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
