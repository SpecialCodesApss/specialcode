
import '../../Controllers/Email_newsletters_userController.dart';
import '../../helpers/LoaderDialog.dart';
import '../../helpers/ToastHelper.dart';
import 'package:framework_01_6/helpers/LanguageHelper.dart' as LanguageHelper;
import '../../lang/ar/email_newsletters_users.dart' as messages_ar;
import '../../lang/en/email_newsletters_users.dart' as messages_en;
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


class Email_newsletters_usersStore extends StatefulWidget {
  @override
  State<StatefulWidget> createState() {
    // TODO: implement createState
    return _Email_newsletters_usersStoreState();
  }
}

class _Email_newsletters_usersStoreState extends State<Email_newsletters_usersStore>{
  //declare variables here

var language = LanguageHelper.Language;
  var data;




  Email_newsletters_userController _Email_newsletters_userController = new Email_newsletters_userController();

  final TextEditingController _user_idController = new TextEditingController();final TextEditingController _emailController = new TextEditingController();

  _onPressedStore(){
    setState(() {
      showLoaderDialogFunction(context);

        _Email_newsletters_userController.store(
            _emailController.text.trim()
        ).whenComplete((){
          if(_Email_newsletters_userController.status == true){
            hideLoaderDialogFunction(context);
            ShowToast('success',_Email_newsletters_userController.message);
            Navigator.push(
                context,
                MaterialPageRoute(builder: (context) =>Home())
            );
          }else{
            hideLoaderDialogFunction(context);
            ShowToast('warning',_Email_newsletters_userController.message);
          }
        });


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
         language =="en" ? messages_en.getTranslation("Subscribe") : messages_ar.getTranslation("Subscribe"),
          style: Theme.of(context).textTheme.title,
        ),
        centerTitle: true,
        leading: IconButton(icon:Icon(Icons.arrow_back),
        onPressed:() => Navigator.of(context).push(
        MaterialPageRoute(builder: (context) => Home())
        ),
        ),
      ),
      
      body: Container(
        child: ListView(
        padding: EdgeInsets.all(10.0),
                          children: <Widget>[

                                            TextField(
                                                      controller: _emailController,
                                                      style: Theme.of(context).textTheme.body1,
                                                      keyboardType: TextInputType.text,
                                                      decoration: InputDecoration(
                                                        icon: Icon(Icons.email_outlined),
                                                        hintText: language =="en" ? messages_en.getTranslation("email") : messages_ar.getTranslation("email"),
                                                        labelText:language =="en" ? messages_en.getTranslation("email") : messages_ar.getTranslation("email"),
                                                      ),
                                                    ),
                                            
                            
                            
                        SizedBox(
                          height: SizeConfig.screenWidth / screenHightRatio,
                        ),
                        RaisedButton(
                          color: Theme.of(context).primaryColor ,
                          child:  Text(
                            language =="en" ? messages_en.getTranslation("Subscribe_Now") : messages_ar.getTranslation("Subscribe_Now"),
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
