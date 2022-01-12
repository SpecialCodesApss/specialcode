import 'package:flutter/material.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter_dev/helpers/InternetHelper.dart';
import 'package:hexcolor/hexcolor.dart';
import '../../../Controllers/UserController.dart';
import '../../../helpers/LoaderDialog.dart';
import '../../../helpers/ToastHelper.dart';
import '../../../helpers/LanguageHelper.dart' as LanguageHelper;


import 'my_account.dart';
import 'package:flutter/widgets.dart';
import '../../../helpers/SizeConfig.dart';

class EditMyAccountPassword extends StatefulWidget {
  @override
  State<StatefulWidget> createState() {
    // TODO: implement createState
    return _EditMyAccountPasswordState();
  }
}

class _EditMyAccountPasswordState extends State<EditMyAccountPassword> {

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
        ShowToast('error', LanguageHelper.trans("app","pleasefillallfields"));
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
      backgroundColor: HexColor('f0f0f0'),
      appBar: AppBar(
        title: Text(
            LanguageHelper.trans("app","EditMyAccountPassword")
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
          //padding: EdgeInsets.all((SizeConfig.screenWidth)!/20),
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
                            style: Theme.of(context).textTheme.bodyText1,
                            obscureText: true,
                            decoration: InputDecoration(
                              hintText:
                              LanguageHelper.trans("app","currentpass")
                              ,
                              icon: Icon(Icons.lock_open),
                            ),
                          ),
                          TextField(
                            controller: _newPassController,
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
                            controller: _confirmNewPassController,
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
                            child: RaisedButton(
                                child: Text(
                                  LanguageHelper.trans("app","edit")
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
          )),
    );
  }
}
