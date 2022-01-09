import 'dart:async';
import 'dart:convert';
import 'dart:io';
import 'package:flutter/material.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter_dev/helpers/InternetHelper.dart';
import 'package:hexcolor/hexcolor.dart';
import '../../../Controllers/UserController.dart';
import '../../../helpers/ToastHelper.dart';
import '../../../helpers/LanguageHelper.dart' as LanguageHelper;
import '../../../lang/ar/app.dart' as messages_ar;
import '../../../lang/en/app.dart' as messages_en;
import 'package:flutter_app_restart/flutter_app_restart.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:flutter/widgets.dart';
import '../../../../helpers/SizeConfig.dart';
import 'Forgetpassword.dart';
import 'Register.dart';
import '../../Home.dart';

import '../../../Controllers/LoginController.dart';
import '../../../helpers/DialogHelper.dart';
import '../../../helpers/LoaderDialog.dart';
import 'package:flutter_spinkit/flutter_spinkit.dart';
import '../../../helpers/mapHelper.dart';



class LoginPage extends StatefulWidget{
  @override
  State<StatefulWidget> createState() {
    // TODO: implement createState
    return _LoginPageState();
  }
}

class _LoginPageState extends State<LoginPage>{
  var language;

  /*Internet and loading*/
  /**************/
  var is_not_connected = false;
  var is_loading = false;
  checkInternetConnection() async{
    var connected = await InternetHelper().chkInternetConnection(context);
    setState((){ is_not_connected = connected;});
  }
  /*End Internet and loading*/
  /**************/

  UserController userController = new UserController();
  read() async {

    /*Internet and loading*/
    /**************/
    await checkInternetConnection();
    setState(() {is_loading = false;});
    /*End Internet and loading*/
    /**************/

    await LanguageHelper.initialize();
    setState(() {
      language = LanguageHelper.Language;
    });


    // print("login $language");
//     language = await LanguageHelper.initialize();
//     print("login $language");
//
//
    SharedPreferences prefs = await SharedPreferences.getInstance();
    final token = prefs.getString('token') ?? "0";
    if(token != "0") {
      //check if token not expired
      Future.delayed(Duration.zero, () => showLoaderDialogFunction(context));
      userController.profile(context).whenComplete((){
        if(userController.status == true){
          hideLoaderDialogFunction(context);
          if (this.mounted){
            Navigator.of(context).pushReplacement(MaterialPageRoute(builder: (context) => Home()));
          }
        }else{
          hideLoaderDialogFunction(context);
        }
      });


    }

  }
  @override
  initState(){
    //check if internet is active or not to disable App if its Not Connected to internet .
    read();
    super.initState();
  }

  @override
  void dispose() {
    // TODO: implement dispose
    super.dispose();
  }


  LoginController loginController = new LoginController();
  String msgStatus = '';

  final TextEditingController _emailController = new TextEditingController();
  final TextEditingController _passwordController = new TextEditingController();

  _onPressedLogin() {
    // showLoaderDialogFunction(context);
      if(_emailController.text.trim().toLowerCase().isNotEmpty &&
          _passwordController.text.trim().isNotEmpty ){
        Future.delayed(Duration.zero, () => showLoaderDialogFunction(context));
        loginController.loginData(_emailController.text.trim().toLowerCase(),
            _passwordController.text.trim(),context).whenComplete(() async{
          if(loginController.status == true){
            hideLoaderDialogFunction(context);
            SharedPreferences prefs = await SharedPreferences.getInstance();
            final token = prefs.getString('token') ?? "0";
            if(token != "0") {
              Navigator.of(context).pushReplacement(MaterialPageRoute(builder: (context) => Home()));
              // Navigator.of(context).pushReplacement(MaterialPageRoute(builder: (context) => Home()));
              // Navigator.of(context).push(MaterialPageRoute(builder: (context) => Home()));
            }

          }else{
            hideLoaderDialogFunction(context);
            ShowToast('warning',loginController.message);
          }
        });
      }
      else{
        // hideLoaderDialogFunction(context);
        ShowToast('error',language == "en" ? messages_en.getTranslation("pleasefillallfields") : messages_ar.getTranslation("pleasefillallfields")
            );
      }

  }

  @override
  Widget build(BuildContext context) {

    // TODO: implement build
    SizeConfig().init(context); // for media query
    var screenWidthRatio = 10;
    var screenHightRatio = 35;
    if(SizeConfig.orientation == Orientation.landscape){
       screenWidthRatio = 20 ;
       screenHightRatio = 55 ;
    }
    else{
       screenWidthRatio = 10 ;
       screenHightRatio = 35 ;
    }

    return  Directionality(
      textDirection: language == "en" ? TextDirection.ltr : TextDirection.rtl,
      child: Scaffold(
        backgroundColor: HexColor('f0f0f0'),
        appBar: AppBar(
          title: Text(
            language == "en" ? messages_en.getTranslation("login") : messages_ar.getTranslation("login")
            ,
            style: Theme.of(context).textTheme.subtitle1,
          ),
          centerTitle: true,
        ),
        body:

        /*Internet and loading*/
        /**************/
        is_not_connected == true ?
        InternetHelper().getInternetWidget(context,checkInternetConnection)
        :is_loading == true ?
                Center(child: CircularProgressIndicator())
        :
        /*Internet and loading*/
        /**************/

        Container(
          child: ListView(
            padding: EdgeInsets.all(30.0),
            children: <Widget>[
                Image(
                    image: AssetImage('assets/images/logo_white.png'),
                  height: 150.0,
                ),

                Container(
                  child: Card(
                    // color: Colors.white.withOpacity(0.8),
                    child: Padding(padding: EdgeInsets.all(20.0),
                      child: Column(
                        children: <Widget>[
                          TextField(
                            controller: _emailController,
                            style: Theme.of(context).textTheme.bodyText1,
                            keyboardType: TextInputType.number,
                            autocorrect: true,
                            decoration: InputDecoration(
                              icon: Icon(Icons.account_circle),
                              hintText:
                              language == "en" ? messages_en.getTranslation("mobilehinttext") : messages_ar.getTranslation("mobilehinttext")
                              ,
                              labelText:
                              language == "en" ? messages_en.getTranslation("mobile") : messages_ar.getTranslation("mobile")
                              ,
                              focusColor: Colors.green,
                            ),
                          ),
                          TextField(
                            controller: _passwordController,
                            style: Theme.of(context).textTheme.bodyText1,
                            obscureText: true,
                            decoration: InputDecoration(
                              counterStyle: TextStyle(fontFamily: 'Droid'),
                              icon: Icon(Icons.lock),
                              hintText:
                              language == "en" ? messages_en.getTranslation("passwordhinttext") : messages_ar.getTranslation("passwordhinttext")
                              ,
                              labelText:
                              language == "en" ? messages_en.getTranslation("password") : messages_ar.getTranslation("password")
                              ,
                              focusColor: Colors.green,
                            ),
                          ),
                          InkWell (
                            onTap: () {
                              Navigator.push(
                                  context,
                                  MaterialPageRoute(builder: (context) => Forgetpassword())
                              );
                            },
                            child:Padding(
                              padding: EdgeInsets.only(
                                right: (SizeConfig.screenWidth)! / screenWidthRatio ,
                                left: (SizeConfig.screenWidth)! / screenWidthRatio ,
                                top: (SizeConfig.screenHeight)! / screenHightRatio ,
                                bottom: (SizeConfig.screenHeight)! / screenHightRatio,
                              ),
                              child :Text(
                                language == "en" ? messages_en.getTranslation("forgetpassword") : messages_ar.getTranslation("forgetpassword")
                                 ,
                                style: TextStyle(
//                    decoration: TextDecoration.underline,
                                ),
                              ),
                            ),
                          ),

                          SizedBox(
                            height: (SizeConfig.screenWidth)! / screenHightRatio,
                          ),

                          ButtonTheme(
                            minWidth: double.infinity,
                              child: RaisedButton(
                                child:  Text(
                                  language == "en" ? messages_en.getTranslation("login") : messages_ar.getTranslation("login")
                                  ,
                                  style: Theme.of(context).textTheme.button,
                                ),
                                onPressed: _onPressedLogin,
                              ),
                            buttonColor: HexColor('232323'),
                          ),

                          SizedBox(
                            height: (SizeConfig.screenHeight)! / 7,
                          ),
                          Row(
                            mainAxisAlignment: MainAxisAlignment.center,
                            children: <Widget>[
                              Text(
                                language == "en" ? messages_en.getTranslation("didnthaveaccount") : messages_ar.getTranslation("didnthaveaccount")
                                 ,
                                style: TextStyle(
                                ),
                              ),
                            ],
                          ),
                          InkWell(
                            onTap: () async {
                              Navigator.push(
                                  context,
                                  MaterialPageRoute(builder: (context) => Register())
                              );
                            },
                            child: Row(
                              mainAxisAlignment: MainAxisAlignment.center,
                              children: <Widget>[
                                Text(
                                  language == "en" ? messages_en.getTranslation("registernewaccount") : messages_ar.getTranslation("registernewaccount")
                                   ,
                                  style: TextStyle(
//                      decoration: TextDecoration.underline,
                                    fontWeight: FontWeight.bold,
                                  ),
                                ),
                              ],
                            ),
                          ),

                          SizedBox(height: 30.0),

                        ],
                      ),
                    )
                  ),
                ),




              SizedBox(
                height: 20.0,
              ),

            ],
          ),
        ),
      ),
    );
  }
}

// _save_ar() async {
//   final prefs = await SharedPreferences.getInstance();
//   final key = 'Lang';
//   final value = 'ar';
//   prefs.setString(key, value);
// //  print('saved $value');
// }
// _save_en() async {
//   final prefs = await SharedPreferences.getInstance();
//   final key = 'Lang';
//   final value = 'en';
//   prefs.setString(key, value);
// //  print('saved $value');
// }
