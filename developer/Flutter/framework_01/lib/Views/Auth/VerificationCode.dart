import '../../packages/hexcolor/hexcolor.dart';
import '../../Controllers/ForgotPasswordController.dart';
import '../../helpers/LoaderDialog.dart';
import '../../helpers/ToastHelper.dart';
import '../../helpers/LanguageHelper.dart' as LanguageHelper;
import '../../lang/ar/app.dart' as messages_ar;
import '../../lang/en/app.dart' as messages_en;

import '../../helpers/SizeConfig.dart';
import 'package:flutter/widgets.dart';
import 'package:flutter/material.dart';
import 'ResetPassword.dart';

class Verificationcode extends StatefulWidget {
  final String mobileOrEmail;
  Verificationcode(this.mobileOrEmail, {Key key}) : super(key: key);

  @override
  State<StatefulWidget> createState() {
    // TODO: implement createState
    return _VerificationcodeState();
  }
}

class _VerificationcodeState extends State<Verificationcode> {

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
  var language = LanguageHelper.Language;
  ForgotPasswordController forgetpasswordController =
      new ForgotPasswordController();
  final TextEditingController _verificationcodeController =
      new TextEditingController();

  _CheckResetCode() {
    if (_verificationcodeController.text.trim().isNotEmpty) {
      var verifyCode_method = 'mobile'; // get this from settings
      setState(() {
        showLoaderDialogFunction(context);
        if (verifyCode_method == 'mobile') {
          forgetpasswordController.CheckResetCode(null, widget.mobileOrEmail,
                  _verificationcodeController.text.trim(), context)
              .whenComplete(() {
            if (forgetpasswordController.status == true) {
              hideLoaderDialogFunction(context);
              ShowToast('success', forgetpasswordController.message);
              Navigator.push(
                  context,
                  MaterialPageRoute(
                      builder: (context) => RsestPassword(
                          _verificationcodeController.text.trim(),
                          widget.mobileOrEmail)));
            } else {
              hideLoaderDialogFunction(context);
              ShowToast('warning', forgetpasswordController.message);
            }
          });
        } else {
          forgetpasswordController.CheckResetCode(widget.mobileOrEmail, null,
                  _verificationcodeController.text.trim(), context)
              .whenComplete(() {
            if (forgetpasswordController.status == true) {
              hideLoaderDialogFunction(context);
              ShowToast('success', forgetpasswordController.message);
              Navigator.pushReplacement(
                  context,
                  MaterialPageRoute(
                      builder: (context) => RsestPassword(
                          _verificationcodeController.text.trim(),
                          widget.mobileOrEmail)));
            } else {
              hideLoaderDialogFunction(context);
              ShowToast('warning', forgetpasswordController.message);
            }
          });
        }
      });
    } else {
      ShowToast('error',
          language == "en" ? messages_en.getTranslation("pleasefillallfields") : messages_ar.getTranslation("Notificationspleasefillallfields") ,
);
    }
  }

  /***End of Declare API functions ****/
  /***********-**************/

  @override
  Widget build(BuildContext context) {
    // TODO: implement build

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
          language == "en" ? messages_en.getTranslation("verificationcode") : messages_ar.getTranslation("verificationcode")
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
          //padding: EdgeInsets.all(SizeConfig.screenWidth/20),
          alignment: Alignment.center,
          child: ListView(
            //shrinkWrap: true,
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
                              language == "en" ? messages_en.getTranslation("verificationcodetext") : messages_ar.getTranslation("verificationcodetext")
                              ,
                              style: Theme.of(context).textTheme.body1,
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
                            child: RaisedButton(
                                child: Text(
                                  language == "en" ? messages_en.getTranslation("verify") : messages_ar.getTranslation("verify")
                                  ,
                                  style: Theme.of(context).textTheme.button,
                                ),
                                onPressed: _CheckResetCode),
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
