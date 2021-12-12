import 'package:flutter/material.dart';
import 'package:flutter/cupertino.dart';
import '../../packages/hexcolor/hexcolor.dart';
import '../../Controllers/UserController.dart';
import '../../helpers/LoaderDialog.dart';
import '../../helpers/ToastHelper.dart';
import '../../helpers/LanguageHelper.dart' as LanguageHelper;
import '../../lang/ar/app.dart' as messages_ar;
import '../../lang/en/app.dart' as messages_en;
import '../MyAccount/MyAccount.dart';
import 'package:flutter/widgets.dart';
import '../../helpers/SizeConfig.dart';

class EditMyAccountPassword extends StatefulWidget {
  @override
  State<StatefulWidget> createState() {
    // TODO: implement createState
    return _EditMyAccountPasswordState();
  }
}

class _EditMyAccountPasswordState extends State<EditMyAccountPassword> {

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

  UserController userController = new UserController();

  final TextEditingController _oldPassController = new TextEditingController();
  final TextEditingController _newPassController = new TextEditingController();
  final TextEditingController _confirmNewPassController = new TextEditingController();
  var language = LanguageHelper.Language;

  _onPressedUpdate() {
    setState(() {
      showLoaderDialogFunction(context);
      if (_oldPassController.text.trim().isNotEmpty &&
          _newPassController.text.trim().isNotEmpty &&
          _confirmNewPassController.text.trim().isNotEmpty) {
        userController.ChangePassword(_oldPassController.text.trim(), _newPassController.text.trim(),
                _confirmNewPassController.text.trim(), context)
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
            language == "en" ? messages_en.getTranslation("pleasefillallfields") : messages_ar.getTranslation("pleasefillallfields")
            );
      }
    });
  }

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

    //declare variables here

    return Scaffold(
      backgroundColor: Hexcolor('f0f0f0'),
      appBar: AppBar(
        title: Text(
          language == "en" ? messages_en.getTranslation("EditMyAccountPassword") : messages_ar.getTranslation("EditMyAccountPassword")
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
          //padding: EdgeInsets.all(SizeConfig.screenWidth/20),
          alignment: Alignment.center,
          child: ListView(
            //shrinkWrap: true,
            padding: EdgeInsets.all(30.0),
            children: <Widget>[
              Container(
                child: Card(
                    color: Colors.white.withOpacity(0.8),
                    child: Padding(
                      padding: EdgeInsets.all(20.0),
                      child: Column(
                        children: <Widget>[
                          TextField(
                            controller: _oldPassController,
                            autofocus: true,
                            style: Theme.of(context).textTheme.body1,
                            obscureText: true,
                            decoration: InputDecoration(
                              hintText:
                              language == "en" ? messages_en.getTranslation("currentpass") : messages_ar.getTranslation("currentpass")
                              ,
                              icon: Icon(Icons.lock_open),
                            ),
                          ),
                          TextField(
                            controller: _newPassController,
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
                            controller: _confirmNewPassController,
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
          )),
    );
  }
}
