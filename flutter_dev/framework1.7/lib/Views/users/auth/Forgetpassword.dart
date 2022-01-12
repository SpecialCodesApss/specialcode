import 'package:flutter_dev/helpers/InternetHelper.dart';
import 'package:hexcolor/hexcolor.dart';
import '../../../Controllers/ForgotPasswordController.dart';
import '../../../helpers/LoaderDialog.dart';
import '../../../helpers/ToastHelper.dart';
import '../../../helpers/LanguageHelper.dart' as LanguageHelper;
//
//
import '../../../helpers/SizeConfig.dart';
import 'package:flutter/widgets.dart';
import 'package:flutter/material.dart';
import 'VerificationCode.dart';

class Forgetpassword extends StatefulWidget {
  @override
  State<StatefulWidget> createState() {
    // TODO: implement createState
    return _ForgetpasswordState();
  }
}

class _ForgetpasswordState extends State<Forgetpassword> {
  /***Start of Declare API functions ****/
  /***********-**************/

  ForgotPasswordController forgetpasswordController = new ForgotPasswordController();
  final TextEditingController _verificationcodeController = new TextEditingController();
  var language = LanguageHelper.Language;

  _SendResetCode() {
    setState(() {
      if (_verificationcodeController.text.trim().isNotEmpty) {
        var verifyCode_method = 'mobile'; // get this from settings
        showLoaderDialogFunction(context);
        if (verifyCode_method == 'mobile') {
          forgetpasswordController.SendMobileResetCode(_verificationcodeController.text.trim(), context)
              .whenComplete(() {
            if (forgetpasswordController.status == true) {
              hideLoaderDialogFunction(context);
              ShowToast('success', forgetpasswordController.message);
              Navigator.push(context,
                  MaterialPageRoute(builder: (context) => Verificationcode(_verificationcodeController.text.trim())));
            } else {
              hideLoaderDialogFunction(context);
              ShowToast('warning', forgetpasswordController.message);
            }
          });
        } else {
          forgetpasswordController.SendEmailResetCode(_verificationcodeController.text.trim(), context)
              .whenComplete(() {
            if (forgetpasswordController.status == true) {
              hideLoaderDialogFunction(context);
              ShowToast('success', forgetpasswordController.message);
              Navigator.push(context,
                  MaterialPageRoute(builder: (context) => Verificationcode(_verificationcodeController.text.trim())));
            } else {
              hideLoaderDialogFunction(context);
              ShowToast('warning', forgetpasswordController.message);
            }
          });
        }
      } else {
        ShowToast('error', LanguageHelper.trans("app","pleasefillallfields"));
      }
    });
  }

  /***End of Declare API functions ****/
  /***********-**************/

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

  read() async {
    /*Internet and loading*/
    /**************/
    await checkInternetConnection();
    setState(() {is_loading = false;});
    /*End Internet and loading*/
    /**************/
  }

  @override
  void initState() {
    // TODO: implement initState
    read();
    super.initState();
  }
  @override
  void dispose() {
    // TODO: implement dispose
    super.dispose();
  }

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

    return Scaffold(
      backgroundColor: HexColor('f0f0f0'),
      appBar: AppBar(
        title: Text(
            LanguageHelper.trans("app","forgetpassword")
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
                image: AssetImage('assets/images/logo_white.png'),
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
                            padding: EdgeInsets.only(top: (SizeConfig.screenHeight)! / screenHightRatio),
                            child: Text(
                                LanguageHelper.trans("app","forgetpasswordbymobiletext")
                            ),
                          ),
                          TextField(
                            controller: _verificationcodeController,
                            style: Theme.of(context).textTheme.bodyText1,
                            autofocus: true,
                            keyboardType: TextInputType.phone,
                            decoration: InputDecoration(
                              hintText:
                              LanguageHelper.trans("app","forgetpassmobhinttext")
                                ,
                              icon: Icon(Icons.mobile_screen_share),
                            ),
                          ),
                          SizedBox(
                            height: (SizeConfig.screenHeight)! / screenHightRatio,
                          ),
                          ButtonTheme(
                            minWidth: double.infinity,
                            child: RaisedButton(
                                child: Text(
                                    LanguageHelper.trans("app","sendcode")
                                  ,
                                  style: Theme.of(context).textTheme.button,
                                ),
                                onPressed: _SendResetCode),
                            buttonColor: HexColor('232323'),
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
