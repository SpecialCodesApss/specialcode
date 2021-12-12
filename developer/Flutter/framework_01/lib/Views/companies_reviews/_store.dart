
import '../../Controllers/Companies_reviewController.dart';
import '../../helpers/LoaderDialog.dart';
import '../../helpers/ToastHelper.dart';
import 'package:framework_01_6/helpers/LanguageHelper.dart' as LanguageHelper;
import '../../lang/ar/companies_reviews.dart' as messages_ar;
import '../../lang/en/companies_reviews.dart' as messages_en;
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

import '../../Views/companies_reviews/index.dart';

class Companies_reviewsStore extends StatefulWidget {
  @override
  State<StatefulWidget> createState() {
    // TODO: implement createState
    return _Companies_reviewsStoreState();
  }
}

class _Companies_reviewsStoreState extends State<Companies_reviewsStore>{
  //declare variables here
  
var language = LanguageHelper.Language;
  var data;
    
  
  

  Companies_reviewController _Companies_reviewController = new Companies_reviewController();
  
  final TextEditingController _company_idController = new TextEditingController();final TextEditingController _user_idController = new TextEditingController();final TextEditingController _rate_stars_countController = new TextEditingController();
  final TextEditingController _commentController = new TextEditingController();final TextEditingController _users_likes_idsController = new TextEditingController();final TextEditingController _users_dislikes_idsController = new TextEditingController();final TextEditingController _activeController = new TextEditingController();
  
  _onPressedStore(){
    setState(() {
      showLoaderDialogFunction(context);
      if(_company_idController.text.trim().isNotEmpty
          &&_rate_stars_countController.text.trim().isNotEmpty
          &&_commentController.text.trim().isNotEmpty){
        _Companies_reviewController.store(
            _company_idController.text.trim(),
           _rate_stars_countController.text.trim(),
            _commentController.text.trim(),
            ).whenComplete((){
          if(_Companies_reviewController.status == true){
            hideLoaderDialogFunction(context);
            ShowToast('success',_Companies_reviewController.message);
            Navigator.push(
                context,
                MaterialPageRoute(builder: (context) =>Companies_reviewsIndex())
            );   
          }else{
            hideLoaderDialogFunction(context);
            ShowToast('warning',_Companies_reviewController.message);
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
         language =="en" ? messages_en.getTranslation("Companies_reviews") : messages_ar.getTranslation("Companies_reviews"),
          style: Theme.of(context).textTheme.title,
        ),
        centerTitle: true,
        leading: IconButton(icon:Icon(Icons.arrow_back),
        onPressed:() => Navigator.of(context).push(
        MaterialPageRoute(builder: (context) => Companies_reviewsIndex())
        ),
        ),
      ),
      
      body: Container(
        child: ListView(
        padding: EdgeInsets.all(10.0),
                          children: <Widget>[
                            TextField(
                                                      controller: _company_idController,
                                                      style: Theme.of(context).textTheme.body1,
                                                      keyboardType: TextInputType.text,
                                                      decoration: InputDecoration(
                                                        icon: Icon(Icons.arrow_left),
                                                        hintText: language =="en" ? messages_en.getTranslation("company_id") : messages_ar.getTranslation("company_id"),
                                                        labelText:language =="en" ? messages_en.getTranslation("company_id") : messages_ar.getTranslation("company_id"),
                                                      ),
                                                    ),

                                            TextField(
                                                      controller: _rate_stars_countController,
                                                      style: Theme.of(context).textTheme.body1,
                                                      keyboardType: TextInputType.text,
                                                      decoration: InputDecoration(
                                                        icon: Icon(Icons.arrow_left),
                                                        hintText: language =="en" ? messages_en.getTranslation("rate_stars_count") : messages_ar.getTranslation("rate_stars_count"),
                                                        labelText:language =="en" ? messages_en.getTranslation("rate_stars_count") : messages_ar.getTranslation("rate_stars_count"),
                                                      ),
                                                    ),
                                            TextField(
                                                      controller: _commentController,
                                                      style: Theme.of(context).textTheme.body1,
                                                      keyboardType: TextInputType.text,
                                                      decoration: InputDecoration(
                                                        icon: Icon(Icons.arrow_left),
                                                        hintText: language =="en" ? messages_en.getTranslation("comment") : messages_ar.getTranslation("comment"),
                                                        labelText:language =="en" ? messages_en.getTranslation("comment") : messages_ar.getTranslation("comment"),
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
