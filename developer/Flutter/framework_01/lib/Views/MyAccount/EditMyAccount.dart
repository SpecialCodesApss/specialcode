import 'package:flutter/material.dart';
import 'package:flutter/cupertino.dart';
import '../../packages/hexcolor/hexcolor.dart';
import '../../Controllers/UserController.dart';
import '../../helpers/LoaderDialog.dart';
import '../../helpers/ToastHelper.dart';
import '../../Views/MyAccount/MyAccount.dart';
import 'package:flutter/widgets.dart';
import '../../helpers/SizeConfig.dart';
import '../../helpers/LanguageHelper.dart' as LanguageHelper;
import '../../lang/ar/app.dart' as messages_ar;
import '../../lang/en/app.dart' as messages_en;

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


  _onPressedUpdate() {
    setState(() {
      showLoaderDialogFunction(context);
      if (_usernameController.text.trim().isNotEmpty &&
          _emailController.text.trim().isNotEmpty &&
          _mobileController.text.trim().isNotEmpty) {
        userController
            .update(
                _usernameController.text.trim(), _emailController.text.trim(), _mobileController.text.trim(), context)
            .whenComplete(() {
          if (userController.status == true) {
            hideLoaderDialogFunction(context);
            ShowToast('success', userController.message);
            Navigator.push(context, MaterialPageRoute(builder: (context) => MyAccount()));
          } else {
            hideLoaderDialogFunction(context);
            ShowToast('warning', userController.message);
          }
        });
      } else {
        hideLoaderDialogFunction(context);
        ShowToast('error',
          language == "en" ? messages_en.getTranslation("pleasefillallfields") : messages_ar.getTranslation("pleasefillallfields") ,
            );
      }
    });
  }

  //declare variables here
  var username = "";
  var mobile = "";
  var email = "";
  UserController userProfileController = new UserController();

  read() async {
    Future.delayed(Duration.zero, () => showLoaderDialogFunction(context));
    userProfileController.profile(context).whenComplete(() {
      if (userProfileController.status == true) {
        setState(() {
          _usernameController.text = userProfileController.data["data"]["fullname"] ?? "";
          _mobileController.text = userProfileController.data["data"]["mobile"] ?? "";
          _emailController.text = userProfileController.data["data"]["email"] ?? "";
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
      backgroundColor: Hexcolor('f0f0f0'),
      appBar: AppBar(
        title: Text(
          language == "en" ? messages_en.getTranslation("EditMyAccount") : messages_ar.getTranslation("EditMyAccount")
          ,
          style: Theme.of(context).textTheme.title,
        ),
        automaticallyImplyLeading: true,
        centerTitle: true,
        leading: IconButton(
          icon: Icon(Icons.arrow_back),
          onPressed: () => Navigator.pop(context, false),
        ),
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
            Container(
              child: Card(
                  color: Colors.white.withOpacity(0.8),
                  child: Padding(
                    padding: EdgeInsets.all(20.0),
                    child: Column(
                      children: <Widget>[
                        TextFormField(
                          controller: _usernameController,
                          //initialValue: username,
                          style: Theme.of(context).textTheme.body1,
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
                          style: Theme.of(context).textTheme.body1,
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
                          style: Theme.of(context).textTheme.body1,
                          decoration: InputDecoration(
                            hintText:
                            language == "en" ? messages_en.getTranslation("email") : messages_ar.getTranslation("email")
                            ,
                            icon: Icon(Icons.email),
                          ),
                        ),
                        SizedBox(
                          height: SizeConfig.screenWidth / screenHightRatio,
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
                          buttonColor: Hexcolor('232323'),
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
