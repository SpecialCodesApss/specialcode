import 'package:flutter_dev/helpers/InternetHelper.dart';

import '../../Home.dart';

import 'package:hexcolor/hexcolor.dart';
import '../../../Controllers/ForgotPasswordController.dart';
import '../Auth/Login.dart';
import '../../../helpers/LoaderDialog.dart';
import '../../../helpers/ToastHelper.dart';
import '../../../helpers/LanguageHelper.dart' as LanguageHelper;



import '../../../helpers/SizeConfig.dart';
import 'package:flutter/widgets.dart';
import 'package:flutter/material.dart';

class RsestPassword extends StatefulWidget {
  final String mobileOrEmail;
  final String ResetCode;
  RsestPassword(this.ResetCode, this.mobileOrEmail);

  @override
  State<StatefulWidget> createState() {
    // TODO: implement createState
    return _RsestPasswordState();
  }
}

class _RsestPasswordState extends State<RsestPassword>{


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
          forgetpasswordController.ResetPassword("", widget.mobileOrEmail, widget.ResetCode,
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
          forgetpasswordController.ResetPassword(widget.mobileOrEmail,"", widget.ResetCode,
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
      ShowToast('error', LanguageHelper.trans("app","pleasefillallfields"));
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
      backgroundColor: HexColor('f0f0f0'),
      appBar: AppBar(
        title:Text(
            LanguageHelper.trans("app","resetpass")
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
          alignment: Alignment.center,
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
                    child: Padding(padding: EdgeInsets.all(20.0),
                      child: Column(
                        children: <Widget>[


              TextField(
                controller: _newPasswordController,
                style: Theme.of(context).textTheme.bodyText1,
                obscureText: true,
                decoration: InputDecoration(
                  hintText:
                  LanguageHelper.trans("app","newpass")
                  ,
                  icon: Icon(Icons.lock),
                ),
              ),

              TextField(
                controller: _confirmNewPasswordController,
                style: Theme.of(context).textTheme.bodyText1,
                obscureText: true,
                decoration: InputDecoration(
                  hintText:
                  LanguageHelper.trans("app","confirmnewpass")
                  ,
                  icon: Icon(Icons.lock),
                ),
              ),

              SizedBox(
                height: (SizeConfig.screenHeight)! / screenHightRatio,
              ),
              ButtonTheme(
                minWidth: double.infinity,
                child:RaisedButton(
                    child: Text(
                      LanguageHelper.trans("app","edit")
                       ,
                      style: Theme.of(context).textTheme.button,
                    ),
                    onPressed: _ResetPassword
                ),
                buttonColor: HexColor('232323'),
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

