import 'package:framework_01_6/helpers/bottomNavigatorBarHelper.dart';
import '../../packages/hexcolor/hexcolor.dart';
import '../../Controllers/UserController.dart';
import '../../helpers/LoaderDialog.dart';
import '../../helpers/MenuHelper.dart';
import '../../helpers/ToastHelper.dart';
import '../../helpers/LanguageHelper.dart' as LanguageHelper;
import '../../lang/ar/app.dart' as messages_ar;
import '../../lang/en/app.dart' as messages_en;
import '../../helpers/SizeConfig.dart';
import 'package:flutter/widgets.dart';
import 'package:flutter/material.dart';
import '../MyAccount/EditMyAccount.dart';
import '../MyAccount/EditMyAccountPassword.dart';
import '../Home.dart';

class MyAccount extends StatefulWidget {
  @override
  State<StatefulWidget> createState() {
    // TODO: implement createState
    return _MyAccountState();
  }
}

class _MyAccountState extends State<MyAccount> {
  //declare variables here
  var username = '';
  var mobile = '';
  var email = '';
  var data;

  String notificationCount = '0';
  double notificationBadgeOpacity = 0.0;
  int _page = 3;
  GlobalKey _bottomNavigationKey = GlobalKey();
  var language = LanguageHelper.Language;

  UserController userController = new UserController();
  read() async {
    Future.delayed(Duration.zero, () => showLoaderDialogFunction(context));
    userController.profile(context).whenComplete(() {
      print(userController.data);
      if (userController.status == true) {
        Future.delayed(Duration.zero, () => hideLoaderDialogFunction(context));
        setState(() {
          data = userController.data["data"];
          username = userController.data["data"]["fullname"] ?? " ";
          mobile = userController.data["data"]["mobile"] ?? " ";
          email = userController.data["data"]["email"] ?? " ";
        });
      } else {
        Future.delayed(Duration.zero, () => hideLoaderDialogFunction(context));
        ShowToast('warning', userController.message);
      }
    });
  }

  @override
  initState() {
    super.initState();
    MenuHelper().getNotitficationsCount().then((String result) {
      setState(() {
        notificationCount = result;
        if (int.parse(notificationCount) > 0) {
          notificationBadgeOpacity = 1.0;
        }
      });
    });
    read();
  }
  @override
  void dispose() {
    // TODO: implement dispose
    super.dispose();
  }

  Future<bool>_onBackPressed(){
    Navigator.of(context).push(
        MaterialPageRoute(builder: (context) => Home())
    );
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

    return Scaffold(
      backgroundColor: Hexcolor('f0f0f0'),
      appBar: AppBar(
        title: Text(
          language == "en" ? messages_en.getTranslation("MyAccount") : messages_ar.getTranslation("MyAccount")
          ,
          style: Theme.of(context).textTheme.title,
        ),
        centerTitle: true,
        leading: IconButton(
          icon: Icon(Icons.arrow_back),
          onPressed: () => Navigator.of(context).push(MaterialPageRoute(builder: (context) => Home())),
        ),
      ),
      body: WillPopScope(
        onWillPop: _onBackPressed,
        child: Container(
            alignment: Alignment.center,
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
                            Icon(
                              Icons.account_circle,
                              size: SizeConfig.screenHeight / 6,
                              color: Theme.of(context).primaryColor,
                            ),
                            Text(
                              username,
                              style: Theme.of(context).textTheme.body2,
                              textAlign: TextAlign.center,
                            ),
                            Text(
                              mobile,
                              style: Theme.of(context).textTheme.body1,
                              textAlign: TextAlign.center,
                            ),
                            Text(
                              email,
                              style: Theme.of(context).textTheme.body1,
                              textAlign: TextAlign.center,
                            ),
                            SizedBox(
                              height: SizeConfig.screenHeight / 7,
                            ),
                            ButtonTheme(
                              minWidth: double.infinity,
                              child: RaisedButton(
                                child: Text(
                                  language == "en" ? messages_en.getTranslation("EditMyAccount") : messages_ar.getTranslation("EditMyAccount")
                                  ,
                                  style: Theme.of(context).textTheme.button,
                                ),
                                onPressed: () {
                                  Navigator.push(context, MaterialPageRoute(builder: (context) => EditMyAccount()));
                                },
                              ),
                              buttonColor: Hexcolor('#232323'),
                            ),

                            SizedBox(
                              height: SizeConfig.screenWidth / screenHightRatio,
                            ),
                            ButtonTheme(
                              minWidth: double.infinity,
                              child: RaisedButton(
                                color: Theme.of(context).primaryColor,
                                child: Text(
                                  language == "en" ? messages_en.getTranslation("EditMyAccountPassword") : messages_ar.getTranslation("EditMyAccountPassword")
                                  ,
                                  style: Theme.of(context).textTheme.button,
                                ),
                                onPressed: () {
                                  Navigator.push(
                                      context, MaterialPageRoute(builder: (context) => EditMyAccountPassword()));
                                },
                              ),
                              buttonColor: Hexcolor('232323'),
                            ),
                          ],
                        ),
                      )),
                ),
              ],
            )),
      ),
      bottomNavigationBar:bottomNavigator(context,3),
    );
  }
}
