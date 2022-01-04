import 'dart:io';
import '../../../../helpers/LanguageHelper.dart' as LanguageHelper;
import '../../lang/ar/app.dart' as messages_ar;
import '../../lang/en/app.dart' as messages_en;
import '../../../../helpers/SettingHelper.dart';
import '../../Controllers/UserController.dart';
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
  var language = LanguageHelper.Language;

  _read() async{
    await sharedPreferencesHelper.initialize_token();
    await LanguageHelper.initialize();
    token = sharedPreferencesHelper.token;
    language = sharedPreferencesHelper.token;

    setState(() {
      Future.delayed(const Duration(milliseconds: 1000), () async {


        // var connectivityResult = await (Connectivity().checkConnectivity());
        // if (connectivityResult == ConnectivityResult.mobile || connectivityResult == ConnectivityResult.wifi) {
        //   //check if there are new version of App
          var there_is_new_version = await getAppVersionSetting();
          if(there_is_new_version == true){
            showDialogFunction(
                language =="en" ? messages_en.getTranslation("please_update_app") : messages_ar.getTranslation
                  ("please_update_app")
                , context);
          }


          if (token != null) {
            //check if token not expired
            userController.profile(context).whenComplete(() {
              if (userController.status == true) {
                if (this.mounted) {
                  var data = userController.data;
                  var email_verified_at = data["data"]["email_verified_at"];
                  var email = data["data"]["email"];
                  if (email_verified_at == null) {
                    print("aaa");
                    Navigator.of(context)
                        .pushReplacement(MaterialPageRoute(builder: (context) => Home()));
                  } else {
                    print("bbb");
                    Navigator.of(context).pushReplacement(MaterialPageRoute(builder: (context) => Home()));
                  }
                }
              } else {
                Navigator.pushReplacement(context, MaterialPageRoute(builder: (context) => LoginPage()));
              }
            });
          } else {
            Navigator.of(context).pushReplacement(MaterialPageRoute(builder: (context) => LoginPage()));
          }
        // }
        // else{
        //   showDialogFunction("من فضلك تأكد من اتصالك بالانترنت أو من امكانية الوصول إلى سيرفر التطبيق بنجاح", context);
        // }
      });
    });
  }

  @override
  void initState() {
    super.initState();
    _read();
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
      body: Container(
        decoration: BoxDecoration(
//                image: DecorationImage(
//                  image: AssetImage("assets/images/language_design.png"),
//                  fit: BoxFit.cover,
//                ),
            ),
        child: Center(
            child: Image(
          image: AssetImage('assets/images/logo_white.png'),
          height: 250.0,
        )),
      ),
    );
  }
}
