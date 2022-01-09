import 'dart:io';

import 'package:flutter/material.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter_dev/helpers/InternetHelper.dart';
import 'package:hexcolor/hexcolor.dart';
import 'package:image_picker/image_picker.dart';
import '../../../helpers/LoaderDialog.dart';
import '../../../helpers/LanguageHelper.dart' as LanguageHelper;
import '../../../lang/ar/app.dart' as messages_ar;
import '../../../lang/en/app.dart' as messages_en;
import 'package:flutter_app_restart/flutter_app_restart.dart';
import '../Auth/Login.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:flutter/widgets.dart';
import '../../../helpers/SizeConfig.dart';
import 'Forgetpassword.dart';
import 'VerifyRegisterMobile.dart';
import '../../../Controllers/RegisterController.dart';
import '../../../helpers/DialogHelper.dart';
import '../../../helpers/ToastHelper.dart';
import 'package:flutter_spinkit/flutter_spinkit.dart';

import '../../Home.dart';

class Register extends StatefulWidget {
  @override
  State<StatefulWidget> createState() {
    // TODO: implement createState
    return _RegisterState();
  }
}

class _RegisterState extends State<Register> {


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

  RegisterController registerController = new RegisterController();
  var language = LanguageHelper.Language;

  final TextEditingController _fullnameController = new TextEditingController();
  final TextEditingController _emailController = new TextEditingController();
  final TextEditingController _mobileController = new TextEditingController();
  final TextEditingController _passwordController = new TextEditingController();
  final TextEditingController _c_passwordController =
      new TextEditingController();
  String radioItem = 'male';


  var profile_image = "";
  var user_profile_image;
  Future getImage() async {
    //focusout from keyboard - its important due to error happen when load image thats clear last textfield
    FocusScopeNode currentFocus = FocusScope.of(context);
    if (!currentFocus.hasPrimaryFocus) {
      currentFocus.unfocus();
    }
    var image = await ImagePicker.platform.pickImage(source: ImageSource.gallery);
    setState(() {
      user_profile_image = File(image!.path);
    });
  }


  _onPressed() {
    setState(() {
      showLoaderDialogFunction(context);
      if (_fullnameController.text.trim().toLowerCase().isNotEmpty &&
          _emailController.text.trim().isNotEmpty &&
          _mobileController.text.trim().isNotEmpty &&
          radioItem != null &&
          _passwordController.text.trim().isNotEmpty &&
          _c_passwordController.text.trim().isNotEmpty) {
        registerController.RegisterData(
                _fullnameController.text.trim().toLowerCase(),
                _emailController.text.trim(),
                _mobileController.text.trim(),
                radioItem.trim(),
                _passwordController.text.trim(),
                _c_passwordController.text.trim(),
                user_profile_image,"user")
            .whenComplete(() {
          if (registerController.status == true) {
            hideLoaderDialogFunction(context);
            ShowToast('success', registerController.message);
            Navigator.push(
                context,
                MaterialPageRoute(
                    builder: (context) => VerifyRegisterMobile(
                        registerController.data['data']['mobile'])));
          } else {
            hideLoaderDialogFunction(context);
            ShowToast('warning', registerController.message);
          }
        });
      } else {
        hideLoaderDialogFunction(context);
        ShowToast('error',
            language == "en" ? messages_en.getTranslation("pleasefillallfields") : messages_ar.getTranslation("Notificationspleasefillallfields") ,
);
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
    if (SizeConfig.orientation == Orientation.landscape) {
      screenWidthRatio = 20;
      screenHightRatio = 55;
    } else {
      screenWidthRatio = 10;
      screenHightRatio = 35;
    }

    return  Scaffold(
      backgroundColor: HexColor('f0f0f0'),
      appBar: AppBar(
        title: Text(
          language == "en" ? messages_en.getTranslation("registernewaccount") : messages_ar.getTranslation("registernewaccount")
          ,
          style: Theme.of(context).textTheme.subtitle1,
        ),
        automaticallyImplyLeading: true,
        centerTitle: true,
//          leading: IconButton(icon:Icon(Icons.arrow_back),
//            onPressed:() => Navigator.pop(context, false),
//          ),
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


            Column(
              children: [
                Container(
                  width: 122,height: 122,
                  decoration: BoxDecoration(
                    shape: BoxShape.circle,
                    border: Border.all(
                        color:const Color(0xFF707070),width:1),
                  ),
                  child:ClipRRect(
                    borderRadius: BorderRadius.circular(60.0),
                    child:
                    user_profile_image != null ?
                    Image.file(user_profile_image) :
                    profile_image != '' ?
                    Image.network(profile_image,fit: BoxFit.cover,width: 150,height: 150,)
                        :Image.asset("assets/images/noimage.png",fit: BoxFit.cover,width: 150,height: 150,),
                  ),
                ),


                const SizedBox(height: 8,),
                InkWell(
                  onTap: getImage,
                  child: Container(
                    height: 27,
                    width: 80,
                    alignment: Alignment.center,
                    decoration: BoxDecoration(
                      color:const Color(0xFF183A88),
                      borderRadius: BorderRadius.circular(14),

                    ),
                    child: Text(
                      language == "en" ? messages_en.getTranslation("uploadPhoto") :
                      messages_ar.getTranslation("uploadPhoto")
                      ,
                      style: TextStyle(
                        color: const Color(0xFFFFFFFF),
                        fontFamily: 'Cairo',
                        fontWeight: FontWeight.normal,
                        fontSize: 10,
                      ),
                    ),
                  ),
                ),

              ],
            ),



            // Image(
            //   image: AssetImage('assets/images/logo_white.png'),
            //   height: 150.0,
            // ),
            Container(
              child: Card(
                  color: Colors.white.withOpacity(0.8),
                  child: Padding(
                    padding: EdgeInsets.all(20.0),
                    child: Column(
                      children: <Widget>[
                        TextField(
                          controller: _fullnameController,
                          style: Theme.of(context).textTheme.bodyText1,
                          decoration: InputDecoration(
                            hintText:
                            language == "en" ? messages_en.getTranslation("name") : messages_ar.getTranslation("name")
                            ,
                            icon: Icon(Icons.account_circle),
                          ),
                        ),
                        TextField(
                          controller: _emailController,
                          style: Theme.of(context).textTheme.bodyText1,
                          keyboardType: TextInputType.emailAddress ,
                          autocorrect: false,
                          decoration: InputDecoration(
                            hintText:
                            language == "en" ? messages_en.getTranslation("email") : messages_ar.getTranslation("email")
                            ,
                            icon: Icon(Icons.email),
                          ),
                        ),
                        TextField(
                          controller: _mobileController,
                          style: Theme.of(context).textTheme.bodyText1,
                          keyboardType: TextInputType.phone,
                          decoration: InputDecoration(
                            hintText:
                            language == "en" ? messages_en.getTranslation("mobile") : messages_ar.getTranslation("mobile")
                            ,
                            icon: Icon(Icons.mobile_screen_share),
                          ),
                        ),

                        Row(
                          children: <Widget>[

                            Expanded(
                              child: RadioListTile(
                                groupValue: radioItem,
                                title: Text('ذكر'),
                                value: 'male',
                                onChanged: (val) {
                                  setState(() {
                                    radioItem = val.toString();
                                  });
                                },
                              ),
                            ),

                            Expanded(
                              child: RadioListTile(
                                groupValue: radioItem,
                                title: Text('أنثي'),
                                value: 'female',
                                onChanged: (val) {
                                  setState(() {
                                    radioItem = val.toString();
                                  });
                                },
                              ),
                            ),
                          ],
                        ),

                        TextField(
                          controller: _passwordController,
                          style: Theme.of(context).textTheme.bodyText1,
                          obscureText: true,
                          decoration: InputDecoration(
                            hintText:
                            language == "en" ? messages_en.getTranslation("password") : messages_ar.getTranslation("password")
                            ,
                            icon: Icon(Icons.lock),
                          ),
                        ),
                        TextField(
                          controller: _c_passwordController,
                          style: Theme.of(context).textTheme.bodyText1,
                          obscureText: true,
                          decoration: InputDecoration(
                            hintText:
                            language == "en" ? messages_en.getTranslation("confirmpassword") : messages_ar.getTranslation("confirmpassword")
                            ,
                            icon: Icon(Icons.lock),
                          ),
                        ),
                        SizedBox(
                          height: (SizeConfig.screenWidth)! / screenHightRatio,
                        ),
                        ButtonTheme(
                          minWidth: double.infinity,
                          child: RaisedButton(
                              child: Text(
                                language == "en" ? messages_en.getTranslation("register") : messages_ar.getTranslation("register")
                                ,
                                style: Theme.of(context).textTheme.button,
                              ),
                              onPressed: _onPressed),
                          buttonColor: HexColor('232323'),
                        ),
                        SizedBox(
                          height: (SizeConfig.screenWidth)! / screenHightRatio,
                        ),
                        Row(
                          mainAxisAlignment: MainAxisAlignment.center,
                          children: <Widget>[
                            Text(
                              language == "en" ? messages_en.getTranslation("haveaccount") : messages_ar.getTranslation("haveaccount")
                              ,
                              style: TextStyle(),
                            ),
                          ],
                        ),
                        InkWell(
                          onTap: () {
                            Navigator.push(
                                context,
                                MaterialPageRoute(
                                    builder: (context) => LoginPage()));
                          },
                          child: Row(
                            mainAxisAlignment: MainAxisAlignment.center,
                            children: <Widget>[
                              Text(
                                language == "en" ? messages_en.getTranslation("login") : messages_ar.getTranslation("login")
                                ,
                                style: TextStyle(
                                  decoration: TextDecoration.underline,
                                  fontWeight: FontWeight.bold,
                                ),
                              ),
                            ],
                          ),
                        ),
                      ],
                    ),
                  )),
            ),
          ],
        ),
      ),
    );
  }
}
