import 'package:framework_01_6/Views/Home.dart';

import '../../packages/hexcolor/hexcolor.dart';
import '../../Controllers/ForgotPasswordController.dart';
import '../Auth/Login.dart';
import '../../helpers/LoaderDialog.dart';
import '../../helpers/ToastHelper.dart';
import '../../helpers/LanguageHelper.dart' as LanguageHelper;
import '../../lang/ar/app.dart' as messages_ar;
import '../../lang/en/app.dart' as messages_en;

import '../../helpers/SizeConfig.dart';
import 'package:flutter/widgets.dart';
import 'package:flutter/material.dart';

class RsestPassword extends StatefulWidget {
  final String mobileOrEmail;
  final String ResetCode;
  RsestPassword(this.ResetCode, this.mobileOrEmail, {Key key}) : super(key: key);

  @override
  State<StatefulWidget> createState() {
    // TODO: implement createState
    return _RsestPasswordState();
  }
}

class _RsestPasswordState extends State<RsestPassword>{

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

  ForgotPasswordController forgetpasswordController = new ForgotPasswordController();
  var language = LanguageHelper.Language;
  final TextEditingController _newPasswordController = new TextEditingController();
  final TextEditingController _confirmNewPasswordController = new TextEditingController();

  _ResetPassword(){
    if(_newPasswordController.text.trim().isNotEmpty && _confirmNewPasswordController.text.trim().isNotEmpty) {
      var verifyCode_method = 'mobile'; // get this from settings
      setState(() {
        showLoaderDialogFunction(context);
        if (verifyCode_method == 'mobile') {
          forgetpasswordController.ResetPassword(null, widget.mobileOrEmail, widget.ResetCode,
              _newPasswordController.text.trim(),_confirmNewPasswordController.text.trim(), context)
              .whenComplete(() {
            if (forgetpasswordController.status == true) {
              hideLoaderDialogFunction(context);
              ShowToast('success', forgetpasswordController.message);
              Navigator.pushReplacement(
                  context,
                  MaterialPageRoute(builder: (context) => LoginPage())
              );
            } else {
              hideLoaderDialogFunction(context);
              ShowToast('warning', forgetpasswordController.message);
            }
          });
        }
        else {
          forgetpasswordController.ResetPassword(widget.mobileOrEmail,null, widget.ResetCode,
              _newPasswordController.text.trim(),_confirmNewPasswordController.text.trim(), context)
              .whenComplete(() {
            if (forgetpasswordController.status == true) {
              hideLoaderDialogFunction(context);
              ShowToast('success', forgetpasswordController.message);
              Navigator.push(
                  context,
                  MaterialPageRoute(builder: (context) => Home())
              );
            } else {
              hideLoaderDialogFunction(context);
              ShowToast('warning', forgetpasswordController.message);
            }
          });
        }
      });
    }
    else{
      ShowToast('error',language == "en" ? messages_en.getTranslation("pleasefillallfields") : messages_ar.getTranslation("Notificationspleasefillallfields")
);
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

    return  Scaffold(
      backgroundColor: Hexcolor('f0f0f0'),
      appBar: AppBar(
        title:Text(
          language == "en" ? messages_en.getTranslation("resetpass") : messages_ar.getTranslation("resetpass")
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
          alignment: Alignment.center,
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
                    child: Padding(padding: EdgeInsets.all(20.0),
                      child: Column(
                        children: <Widget>[


              TextField(
                controller: _newPasswordController,
                style: Theme.of(context).textTheme.body1,
                obscureText: true,
                decoration: InputDecoration(
                  hintText:
                  language == "en" ? messages_en.getTranslation("newpass") : messages_ar.getTranslation("newpass")
                  ,
                  icon: Icon(Icons.lock),
                ),
              ),

              TextField(
                controller: _confirmNewPasswordController,
                style: Theme.of(context).textTheme.body1,
                obscureText: true,
                decoration: InputDecoration(
                  hintText:
                  language == "en" ? messages_en.getTranslation("confirmnewpass") : messages_ar.getTranslation("confirmnewpass")
                  ,
                  icon: Icon(Icons.lock),
                ),
              ),

              SizedBox(
                height: SizeConfig.screenHeight / screenHightRatio,
              ),
              ButtonTheme(
                minWidth: double.infinity,
                child:RaisedButton(
                    child: Text(
                      language == "en" ? messages_en.getTranslation("edit") : messages_ar.getTranslation("edit")
                       ,
                      style: Theme.of(context).textTheme.button,
                    ),
                    onPressed: _ResetPassword
                ),
                buttonColor: Hexcolor('232323'),
              ),



            ],
          ),
      )
    ),
    ),


    ],
          )

      ),

    );
  }

}

