import 'package:flutter_dev/helpers/InternetHelper.dart';

import '../../../helpers/bottomNavigatorBarHelper.dart';
import 'package:hexcolor/hexcolor.dart';
import '../../../Controllers/UserController.dart';
import '../../../helpers/LoaderDialog.dart';
import '../../../helpers/MenuHelper.dart';
import '../../../helpers/ToastHelper.dart';
import '../../../helpers/LanguageHelper.dart' as LanguageHelper;


import '../../../helpers/SizeConfig.dart';
import 'package:flutter/widgets.dart';
import 'package:flutter/material.dart';
import 'edit.dart';
import 'change_password.dart';
import '../../Home.dart';

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
  var profile_image = '';
  var data;

  String notificationCount = '0';
  double notificationBadgeOpacity = 0.0;
  int _page = 3;
  GlobalKey _bottomNavigationKey = GlobalKey();
  var language = LanguageHelper.Language;

  String serverUrl = "http://192.168.1.4/framework1.7/";

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

  UserController userController = new UserController();
  read() async {

    /*Internet and loading*/
    /**************/
    await checkInternetConnection();
    setState(() {is_loading = false;});
    /*End Internet and loading*/
    /**************/

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
          if(userController.data["data"]["profile_image"] != null ){
            profile_image = serverUrl + userController.data["data"]["profile_image"];
          }else{
            profile_image = "";
          }
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
      backgroundColor: HexColor('f0f0f0'),
      appBar: AppBar(
        title: Text(
            LanguageHelper.trans("app","MyAccount")
          ,
          style: Theme.of(context).textTheme.subtitle1,
        ),
        centerTitle: true,
        leading: IconButton(
          icon: Icon(Icons.arrow_back),
          onPressed: () => Navigator.of(context).push(MaterialPageRoute(builder: (context) => Home())),
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

                          Container(
                            width: 122,height: 122,
                            decoration: BoxDecoration(
                              shape: BoxShape.circle,
                              border: Border.all(
                                  color:const Color(0xFF707070),width:1),
                            ),
                            child:ClipRRect(
                              borderRadius: BorderRadius.circular(60.0),
                              child: profile_image != '' ?
                              Image.network(profile_image,fit: BoxFit.cover,width: 150,height: 150,)
                                  :Image.asset("assets/images/noimage.png",fit: BoxFit.cover,width: 150,height: 150,),
                            ),
                          ),

                          // Icon(
                          //   Icons.account_circle,
                          //   size: (SizeConfig.screenHeight)! / 6,
                          //   color: Theme.of(context).primaryColor,
                          // ),
                          Text(
                            username,
                            style: Theme.of(context).textTheme.bodyText2,
                            textAlign: TextAlign.center,
                          ),
                          Text(
                            mobile,
                            style: Theme.of(context).textTheme.bodyText1,
                            textAlign: TextAlign.center,
                          ),
                          Text(
                            email,
                            style: Theme.of(context).textTheme.bodyText1,
                            textAlign: TextAlign.center,
                          ),
                          SizedBox(
                            height: (SizeConfig.screenHeight)! / 7,
                          ),
                          ButtonTheme(
                            minWidth: double.infinity,
                            child: RaisedButton(
                              child: Text(
                                  LanguageHelper.trans("app","EditMyAccount")
                                ,
                                style: Theme.of(context).textTheme.button,
                              ),
                              onPressed: () {
                                Navigator.push(context, MaterialPageRoute(builder: (context) => EditMyAccount()));
                              },
                            ),
                            buttonColor: HexColor('#232323'),
                          ),

                          SizedBox(
                            height: (SizeConfig.screenWidth)! / screenHightRatio,
                          ),
                          ButtonTheme(
                            minWidth: double.infinity,
                            child: RaisedButton(
                              color: Theme.of(context).primaryColor,
                              child: Text(
                                  LanguageHelper.trans("app","EditMyAccountPassword")
                                ,
                                style: Theme.of(context).textTheme.button,
                              ),
                              onPressed: () {
                                Navigator.push(
                                    context, MaterialPageRoute(builder: (context) => EditMyAccountPassword()));
                              },
                            ),
                            buttonColor: HexColor('232323'),
                          ),
                        ],
                      ),
                    )),
              ),
            ],
          )),
      bottomNavigationBar:bottomNavigator(context,3),
    );
  }
}
