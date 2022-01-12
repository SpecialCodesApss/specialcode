import 'package:flutter_dev/helpers/InternetHelper.dart';
import 'package:hexcolor/hexcolor.dart';
import '../../../Controllers/VerificationController.dart';
import '../../../helpers/LoaderDialog.dart';
import '../../../helpers/ToastHelper.dart';
import '../../../helpers/LanguageHelper.dart' as LanguageHelper;


import '../../../helpers/SizeConfig.dart';
import 'package:flutter/widgets.dart';
import 'package:flutter/material.dart';
import '../../Home.dart';
import 'Login.dart';
import 'EditMobile.dart';
import '../../../helpers/DialogHelper.dart';
import 'Login.dart';

class VerifyRegisterMobile extends StatefulWidget {
  final String mobile;
  VerifyRegisterMobile(this.mobile);

  @override
  State<StatefulWidget> createState() {
    // TODO: implement createState
    return _VerifyRegisterMobileState();
  }
}

class _VerifyRegisterMobileState extends State<VerifyRegisterMobile> {

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
    super.initState();
    read();
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
                context, MaterialPageRoute(builder: (context) => Home()));
          } else {
            hideLoaderDialogFunction(context);
            ShowToast('warning', verificationController.message);
          }
        });
      } else {
        hideLoaderDialogFunction(context);
        ShowToast('error', LanguageHelper.trans("app","pleasefillallfields"));
      }
    });
  }

  _SendVerifyCode() {
    var verifyCode_method = 'mobile'; // get this from settings
    Future.delayed(Duration.zero, () => showLoaderDialogFunction(context));
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
      backgroundColor: HexColor('f0f0f0'),
      appBar: AppBar(
        title: Text(
            LanguageHelper.trans("app","VerifyMobileNumber")
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
                            padding: EdgeInsets.only(
                                top:
                                    (SizeConfig.screenHeight)! / screenHightRatio),
                            child: Text(
                                LanguageHelper.trans("app","verificationcodetext")+" "+widget.mobile
                            ),
                          ),
                          TextField(
                            controller: _verificationcodeController,
                            style: Theme.of(context).textTheme.bodyText1,
                            keyboardType: TextInputType.phone,
                            autofocus: true,
                            decoration: InputDecoration(
                              hintText:
                              LanguageHelper.trans("app","verificationcodehint")

                              ,
                              icon: Icon(Icons.mobile_screen_share),
                            ),
                          ),
                          SizedBox(
                            height: (SizeConfig.screenHeight)! / screenHightRatio,
                          ),
                          ButtonTheme(
                            minWidth: double.infinity,
                            child:
                            RaisedButton(
                              child: Text(
                                  LanguageHelper.trans("app","verify")
                                ,
                                style: Theme.of(context).textTheme.button,
                              ),
                              onPressed: _onPressed,
                            ),
                            buttonColor: HexColor('232323'),
                          ),

                          SizedBox(
                            height: (SizeConfig.screenHeight)! / 7,
                          ),

                          ButtonTheme(
                            minWidth: double.infinity,
                            child:  RaisedButton(
                                color: Theme.of(context).primaryColor,
                                child: Text(
                                    LanguageHelper.trans("app","resendverifycode")
                                  ,
                                  style: Theme.of(context).textTheme.button,
                                ),
                                onPressed: _SendVerifyCode),
                            buttonColor: HexColor('232323'),
                          ),


                          SizedBox(
                            height: (SizeConfig.screenWidth)! / screenHightRatio,
                          ),

                          ButtonTheme(
                            minWidth: double.infinity,
                            child:
                            RaisedButton(
                              child: Text(
                                  LanguageHelper.trans("app","changeMobileNo")
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
