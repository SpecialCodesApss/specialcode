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
          language == "en" ? messages_en.getTranslation("changeMobileNo") : messages_ar.getTranslation("changeMobileNo")
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
          child: ListView(padding: EdgeInsets.all(30.0),
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
                              language == "en" ? messages_en.getTranslation("changeMobileNo") : messages_ar.getTranslation("changeMobileNo")
                              ,
                            ),
                          ),
                          TextField(
                            controller: _verifyEditController,
                            style: Theme.of(context).textTheme.body1,
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
                            height: SizeConfig.screenHeight / screenHightRatio,
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
