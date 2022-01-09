import 'package:flutter_dev/helpers/InternetHelper.dart';
import 'package:hexcolor/hexcolor.dart';
import '../../../Controllers/VerificationController.dart';
import '../../../helpers/LoaderDialog.dart';
import '../../../helpers/ToastHelper.dart';
import '../../../helpers/LanguageHelper.dart' as LanguageHelper;
import '../../../lang/ar/app.dart' as messages_ar;
import '../../../lang/en/app.dart' as messages_en;
import '../../../helpers/SizeConfig.dart';
import 'package:flutter/widgets.dart';
import 'package:flutter/material.dart';
import 'VerifyRegisterMobile.dart';

class EditMobile extends StatefulWidget {
  @override
  State<StatefulWidget> createState() {
    // TODO: implement createState
    // TODO: implement createState
    return _EditMobileState();
  }
}

class _EditMobileState extends State<EditMobile> {
  /***Start of Declare API functions ****/
  /***********-**************/

  VerificationController verificationController = new VerificationController();
  final TextEditingController _verifyEditController =
      new TextEditingController();
  var language = LanguageHelper.Language;

  _UpdateEmailorMobile() {
    if (_verifyEditController.text.trim().isNotEmpty) {
      var verifyCodemethod = 'mobile'; // get this from settings
      setState(() {
        showLoaderDialogFunction(context);
        if (verifyCodemethod == 'mobile') {
          verificationController.UpdateVerMobile(
                  _verifyEditController.text.trim(), context)
              .whenComplete(() {
            if (verificationController.status == true) {
              hideLoaderDialogFunction(context);
              ShowToast('success', verificationController.message);
              Navigator.push(
                  context,
                  MaterialPageRoute(
                      builder: (context) => VerifyRegisterMobile(
                          verificationController.data['data']['mobile'])));
            } else {
              hideLoaderDialogFunction(context);
              ShowToast('warning', verificationController.message);
            }
          });
        } else {
          verificationController.UpdateVerMobile(
                  _verifyEditController.text.trim(), context)
              .whenComplete(() {
            if (verificationController.status == true) {
              hideLoaderDialogFunction(context);
              ShowToast('success', verificationController.message);
              Navigator.pushReplacement(
                  context,
                  MaterialPageRoute(
                      builder: (context) => VerifyRegisterMobile(
                          verificationController.data['data']['email'])));
            } else {
              hideLoaderDialogFunction(context);
              ShowToast('warning', verificationController.message);
            }
          });
        }
      });
    } else {
      ShowToast('error',
          language == "en" ? messages_en.getTranslation("pleasefillallfields") : messages_ar.getTranslation("pleasefillallfields")
          );
    }
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
          language == "en" ? messages_en.getTranslation("changeMobileNo") : messages_ar.getTranslation("changeMobileNo")
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
          child: ListView(padding: EdgeInsets.all(30.0),
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
                              language == "en" ? messages_en.getTranslation("changeMobileNo") : messages_ar.getTranslation("changeMobileNo")
                              ,
                            ),
                          ),
                          TextField(
                            controller: _verifyEditController,
                            style: Theme.of(context).textTheme.bodyText1,
                            autofocus: true,
                            keyboardType: TextInputType.phone,
                            decoration: InputDecoration(
                              hintText:
                              language == "en" ? messages_en.getTranslation("mobilehinttext") : messages_ar.getTranslation("mobilehinttext")
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
                                  language == "en" ? messages_en.getTranslation("edit") : messages_ar.getTranslation("edit")
                                  ,
                                  style: Theme.of(context).textTheme.button,
                                ),
                                onPressed: _UpdateEmailorMobile),
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
