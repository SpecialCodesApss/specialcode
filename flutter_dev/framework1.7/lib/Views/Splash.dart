import 'dart:async';
import 'dart:io';
import 'package:flutter_dev/helpers/InternetHelper.dart';
import 'package:flutter_dev/helpers/LoaderDialog.dart';
import 'package:shared_preferences/shared_preferences.dart';

import '../../../../helpers/LanguageHelper.dart' as LanguageHelper;
import '../../lang/ar/app.dart' as messages_ar;
import '../../lang/en/app.dart' as messages_en;
import '../../../../helpers/SettingHelper.dart';
import '../../Controllers/UserController.dart';
import 'main/LangaugePage.dart';
import 'users/auth/Login.dart';
import '../../helpers/mapHelper.dart';
import '../../helpers/DialogHelper.dart';
import '../../helpers/sharedPreferencesHelper.dart' as sharedPreferencesHelper;
import 'package:flutter/material.dart';
import 'package:hexcolor/hexcolor.dart';
import 'users/auth/VerifyRegisterMobile.dart';
import 'Home.dart';
// import 'package:connectivity/connectivity.dart';





class Splash extends StatefulWidget {
  @override
  _SplashState createState() => _SplashState();
}

class _SplashState extends State<Splash> {
  UserController userController = new UserController();
  var token = sharedPreferencesHelper.token;


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

  _read() async{

    /*Internet and loading*/
    /**************/
    await checkInternetConnection();
    setState(() {is_loading = false;});
    /*End Internet and loading*/
    /**************/

    SharedPreferences prefs = await SharedPreferences.getInstance();
    final token = prefs.getString('token') ?? "0";
    if(token != "0") {
      //check if token not expired
      // Future.delayed(Duration.zero, () => showLoaderDialogFunction(context));
      userController.profile(context).whenComplete(() {
        if (userController.status == true) {
          // hideLoaderDialogFunction(context);
          if (this.mounted) {
            Navigator.of(context).pushReplacement(
                MaterialPageRoute(builder: (context) => Home()));
          }
        } else {
          // hideLoaderDialogFunction(context);
          Navigator.of(context).pushReplacement(
              MaterialPageRoute(builder: (context) => LoginPage()));
        }
      });
    }
    else{
      Navigator.of(context).pushReplacement(MaterialPageRoute(builder: (context) => LoginPage()));
    }
  }


    // await LanguageHelper.initialize();
    // var language = LanguageHelper.Language;

    // if(language != null){
    //   Navigator.of(context).push(MaterialPageRoute(builder: (context) => LoginPage()));
    // }
    // else{
    //   Navigator.of(context).push(MaterialPageRoute(builder: (context) => LanguagePage()));
    // }


    // await sharedPreferencesHelper.initialize_token();
    // token = sharedPreferencesHelper.token;
    // language = await LanguageHelper.initialize();

      // if (token != null) {
      //   //check if token not expired
      //   userController.profile(context).whenComplete(() {
      //     if (userController.status == true) {
      //       if (this.mounted) {
      //         var data = userController.data;
      //         var email_verified_at = data["data"]["email_verified_at"];
      //         var email = data["data"]["email"];
      //         if (email_verified_at == null) {
      //           print("aaa");
      //           Navigator.of(context)
      //               .pushReplacement(MaterialPageRoute(builder: (context) => Home()));
      //         } else {
      //           print("bbb");
      //           if(language != null){
      //             Navigator.of(context).pushReplacement(MaterialPageRoute(builder: (context) => LoginPage()));
      //           }
      //           else{
      //             Navigator.of(context).pushReplacement(MaterialPageRoute(builder: (context) => LanguagePage()));
      //           }
      //
      //         }
      //       }
      //     } else {
      //       if(language != null){
      //         Navigator.of(context).pushReplacement(MaterialPageRoute(builder: (context) => LoginPage()));
      //       }
      //       else{
      //         Navigator.of(context).pushReplacement(MaterialPageRoute(builder: (context) => LanguagePage()));
      //       }          }
      //   });
      // } else {
      //   if(language != null){
      //     Navigator.of(context).pushReplacement(MaterialPageRoute(builder: (context) => LoginPage()));
      //   }
      //   else{
      //     Navigator.of(context).pushReplacement(MaterialPageRoute(builder: (context) => LanguagePage()));
      //   }
      // }



  @override
  void initState() {
    super.initState();

    Timer(Duration(seconds: 5), () {
      _read();
    });

  }

  @override
  void dispose() {
    // TODO: implement dispose
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: HexColor('f0f0f0'),
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
        child: Center(
            child: Image(
          image: AssetImage('assets/images/logo_white.png'),
          height: 250.0,
        )),
      ),
    );
  }


}
