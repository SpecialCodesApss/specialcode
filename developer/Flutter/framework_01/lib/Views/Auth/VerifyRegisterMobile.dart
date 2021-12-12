import '../../packages/hexcolor/hexcolor.dart';
import '../../Controllers/VerificationController.dart';
import '../../helpers/LoaderDialog.dart';
import '../../helpers/ToastHelper.dart';
import '../../helpers/LanguageHelper.dart' as LanguageHelper;
import '../../lang/ar/app.dart' as messages_ar;
import '../../lang/en/app.dart' as messages_en;

import '../../helpers/SizeConfig.dart';
import 'package:flutter/widgets.dart';
import 'package:flutter/material.dart';
import '../Auth/Login.dart';
import 'Login.dart';
import 'EditMobile.dart';
import '../../helpers/DialogHelper.dart';

class VerifyRegisterMobile extends StatefulWidget {
  final String mobile;
  VerifyRegisterMobile(this.mobile, {Key key}) : super(key: key);

  @override
  State<StatefulWidget> createState() {
    // TODO: implement createState
    return _VerifyRegisterMobileState();
  }
}

class _VerifyRegisterMobileState extends State<VerifyRegisterMobile> {

  @override
  void initState() {
    // TODO: implement initState
    super.initState();
  }
  @override
  void dispose() {
    // TODO: implement dispose
    super.dispose();
  }

  /***Start of Declare API functions ****/
  /***********-**************/

  VerificationController verificationController = new VerificationController();
  var language = LanguageHelper.Language;
  final TextEditingController _verificationcodeController =
      new TextEditingController();

  _onPressed() {
    setState(() {
      showLoaderDialogFunction(context);
      if (_verificationcodeController.text.trim().toLowerCase().isNotEmpty) {
        verificationController.VerifyCode(
                _verificationcodeController.text.trim().toLowerCase(), context)
            .whenComplete(() {
          if (verificationController.status == true) {
            hideLoaderDialogFunction(context);
            ShowToast('success', verificationController.message);
            Navigator.pushReplacement(
                context, MaterialPageRoute(builder: (context) => LoginPage()));
          } else {
            hideLoaderDialogFunction(context);
            ShowToast('warning', verificationController.message);
          }
        });
      } else {
        hideLoaderDialogFunction(context);
        ShowToast('error',
            language == "en" ? messages_en.getTranslation("pleasefillallfields") :
      messages_ar.getTranslation("Notificationspleasefillallfields") ,
);
      }
    });
  }

  _SendVerifyCode() {
    var verifyCode_method = 'mobile'; // get this from settings
    setState(() {
      showLoaderDialogFunction(context);
      if (verifyCode_method == 'mobile') {
        verificationController.SendMobVerifyCode(context).whenComplete(() {
          if (verificationController.status == true) {
            hideLoaderDialogFunction(context);
            ShowToast('success', verificationController.message);
          } else {
            hideLoaderDialogFunction(context);
            ShowToast('warning', verificationController.message);
          }
        });
      } else {
        verificationController.SendEmailVerifyCode(context).whenComplete(() {
          if (verificationController.status == true) {
            hideLoaderDialogFunction(context);
            ShowToast('success', verificationController.message);
          } else {
            hideLoaderDialogFunction(context);
            ShowToast('warning', verificationController.message);
          }
        });
      }
    });
  }

  /***End of Declare API functions ****/
  /***********-**************/

  @override
  Widget build(BuildContext context) {
    // TODO: implement build
    SizeConfig().init(context); // for media query
    var screenWidthRatio = 10;
    var screenHightRatio = 35;
    var contenttopalignmentratio = 20;
    if (SizeConfig.orientation == Orientation.landscape) {
      screenWidthRatio = 20;
      screenHightRatio = 55;

      contenttopalignmentratio = 10;
    } else {
      screenWidthRatio = 10;
      screenHightRatio = 35;

      contenttopalignmentratio = 3;
    }

    return  Scaffold(
      backgroundColor: Hexcolor('f0f0f0'),
      appBar: AppBar(
        title: Text(
          language == "en" ? messages_en.getTranslation("VerifyMobileNumber") : messages_ar.getTranslation("VerifyMobileNumber")
          ,
          style: Theme.of(context).textTheme.title,
        ),
        centerTitle: true,
      ),
      body: Container(
          decoration: BoxDecoration(
            /*image: DecorationImage(
            image: AssetImage("assets/images/bg.png"),
            fit: BoxFit.cover,
          ),*/
          ),
          child: ListView(
            padding: EdgeInsets.all(30.0),
            children: <Widget>[
              Image(
                image: AssetImage('assets/images/white_logo.png'),
                height: 150.0,
              ),
              Container(
                child: Card(
                    color: Colors.white.withOpacity(0.8),
                    child: Padding(
                      padding: EdgeInsets.all(20.0),
                      child: Column(
                        children: <Widget>[

                          Padding(
                            padding: EdgeInsets.only(
                                top:
                                    SizeConfig.screenHeight / screenHightRatio),
                            child: Text(
                                language == "en" ?
                                messages_en.getTranslation("verificationcodetext") +" "+widget.mobile
                                    : messages_ar.getTranslation("verificationcodetext")+" "+widget.mobile
                            ),
                          ),
                          TextField(
                            controller: _verificationcodeController,
                            style: Theme.of(context).textTheme.body1,
                            keyboardType: TextInputType.phone,
                            autofocus: true,
                            decoration: InputDecoration(
                              hintText:
                              language == "en" ? messages_en.getTranslation("verificationcodehint") : messages_ar.getTranslation("verificationcodehint")
                              ,
                              icon: Icon(Icons.mobile_screen_share),
                            ),
                          ),
                          SizedBox(
                            height: SizeConfig.screenHeight / screenHightRatio,
                          ),
                          ButtonTheme(
                            minWidth: double.infinity,
                            child:
                            RaisedButton(
                              child: Text(
                                language == "en" ? messages_en.getTranslation("verify") : messages_ar.getTranslation("verify")
                                ,
                                style: Theme.of(context).textTheme.button,
                              ),
                              onPressed: _onPressed,
                            ),
                            buttonColor: Hexcolor('232323'),
                          ),

                          SizedBox(
                            height: SizeConfig.screenHeight / 7,
                          ),

                          ButtonTheme(
                            minWidth: double.infinity,
                            child:  RaisedButton(
                                color: Theme.of(context).primaryColor,
                                child: Text(
                                  language == "en" ? messages_en.getTranslation("resendverifycode") : messages_ar.getTranslation("resendverifycode")
                                  ,
                                  style: Theme.of(context).textTheme.button,
                                ),
                                onPressed: _SendVerifyCode),
                            buttonColor: Hexcolor('232323'),
                          ),


                          SizedBox(
                            height: SizeConfig.screenWidth / screenHightRatio,
                          ),

                          ButtonTheme(
                            minWidth: double.infinity,
                            child:
                            RaisedButton(
                              child: Text(
                                language == "en" ? messages_en.getTranslation("changeMobileNo") : messages_ar.getTranslation("changeMobileNo")
                                ,
                                style: Theme.of(context).textTheme.button,
                              ),
                              onPressed: () {
                                Navigator.push(
                                    context,
                                    MaterialPageRoute(
                                        builder: (context) => EditMobile()));
                              },
                            ),
                            buttonColor: Hexcolor('232323'),
                          ),
                        ],
                      ),
                    )),
              ),
            ],
          )),
    );
  }
}
