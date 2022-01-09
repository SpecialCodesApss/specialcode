import 'dart:io';

import 'package:flutter/material.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter_dev/helpers/InternetHelper.dart';
import 'package:hexcolor/hexcolor.dart';
import '../../../Controllers/UserController.dart';
import '../../../helpers/LoaderDialog.dart';
import '../../../helpers/ToastHelper.dart';
import 'my_account.dart';
import 'package:flutter/widgets.dart';
import '../../../helpers/SizeConfig.dart';
import '../../../../helpers/LanguageHelper.dart' as LanguageHelper;
import '../../../lang/ar/app.dart' as messages_ar;
import '../../../lang/en/app.dart' as messages_en;
// import 'dart:io';
import 'package:image_picker/image_picker.dart';

class EditMyAccount extends StatefulWidget {
  @override
  State<StatefulWidget> createState() {
    // TODO: implement createState
    return _EditMyAccountState();
  }
}

class _EditMyAccountState extends State<EditMyAccount> {
  UserController userController = new UserController();

  final TextEditingController _usernameController = new TextEditingController();
  final TextEditingController _emailController = new TextEditingController();
  final TextEditingController _mobileController = new TextEditingController();
  var language = LanguageHelper.Language;



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



  _onPressedUpdate() {

    showLoaderDialogFunction(context);
      if (_usernameController.text.trim().isNotEmpty &&
          _emailController.text.trim().isNotEmpty &&
          _mobileController.text.trim().isNotEmpty) {
        userController
            .update(
                _usernameController.text.trim(), _emailController.text.trim(), _mobileController.text.trim()
          ,context,user_profile_image)
            .whenComplete(() {
          hideLoaderDialogFunction(context);
          if (userController.status == true) {
            ShowToast('success', userController.message);
            Navigator.push(context, MaterialPageRoute(builder: (context) => MyAccount()));
          } else {
            ShowToast('warning', userController.message);
          }
        });
      } else {
        hideLoaderDialogFunction(context);
        ShowToast('error',
          language == "en" ? messages_en.getTranslation("pleasefillallfields") :
          messages_ar.getTranslation("pleasefillallfields") ,
            );
      }

  }

  //declare variables here
  var username = "";
  var mobile = "";
  var email = "";
  UserController userProfileController = new UserController();

  String serverUrl = "http://192.168.1.5/framework1.7/";

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

    Future.delayed(Duration.zero, () => showLoaderDialogFunction(context));
    userProfileController.profile(context).whenComplete(() {
      if (userProfileController.status == true) {
        setState(() {
          _usernameController.text = userProfileController.data["data"]["fullname"] ?? "";
          _mobileController.text = userProfileController.data["data"]["mobile"] ?? "";
          _emailController.text = userProfileController.data["data"]["email"] ?? "";
          if(userProfileController.data["data"]["profile_image"] != null ){
            profile_image = serverUrl + userProfileController.data["data"]["profile_image"];
          }else{
            profile_image = "";
          }
        });
        Future.delayed(Duration.zero, () => hideLoaderDialogFunction(context));
      } else {
        ShowToast('warning', userProfileController.message);
        Future.delayed(Duration.zero, () => hideLoaderDialogFunction(context));
      }
    });
  }

  @override
  initState() {
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

    return Scaffold(
      backgroundColor: HexColor('f0f0f0'),
      appBar: AppBar(
        title: Text(
          language == "en" ? messages_en.getTranslation("EditMyAccount") : messages_ar.getTranslation("EditMyAccount")
          ,
          style: Theme.of(context).textTheme.subtitle1,
        ),
        automaticallyImplyLeading: true,
        centerTitle: true,
        leading: IconButton(
          icon: Icon(Icons.arrow_back),
          onPressed: () => Navigator.pop(context, false),
        ),
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
            Container(
              child: Card(
                  color: Colors.white.withOpacity(0.8),
                  child: Padding(
                    padding: EdgeInsets.all(20.0),
                    child: Column(
                      children: <Widget>[


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




                        TextFormField(
                          controller: _usernameController,
                          //initialValue: username,
                          style: Theme.of(context).textTheme.bodyText1,
                          decoration: InputDecoration(
                            hintText:
                            language == "en" ? messages_en.getTranslation("name") : messages_ar.getTranslation("name")
                            ,
                            icon: Icon(Icons.account_circle),
                          ),
                        ),
                        TextFormField(
                          controller: _mobileController,
                          //initialValue: mobile,
                          style: Theme.of(context).textTheme.bodyText1,
                          decoration: InputDecoration(
                            hintText:
                            language == "en" ? messages_en.getTranslation("mobile") : messages_ar.getTranslation("mobile")
                            ,
                            icon: Icon(Icons.mobile_screen_share),
                          ),
                          keyboardType: TextInputType.number,
                        ),
                        TextFormField(
                          controller: _emailController,
                          //initialValue: email,
                          style: Theme.of(context).textTheme.bodyText1,
                          decoration: InputDecoration(
                            hintText:
                            language == "en" ? messages_en.getTranslation("email") : messages_ar.getTranslation("email")
                            ,
                            icon: Icon(Icons.email),
                          ),
                        ),
                        SizedBox(
                          height: (SizeConfig.screenWidth)! / screenHightRatio,
                        ),
                        ButtonTheme(
                          minWidth: double.infinity,
                          child: RaisedButton(
                              child: Text(
                                language == "en" ? messages_en.getTranslation("edit") : messages_ar.getTranslation("edit")
                                ,
                                style: Theme.of(context).textTheme.button,
                              ),
                              onPressed: _onPressedUpdate),
                          buttonColor: HexColor('232323'),
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
