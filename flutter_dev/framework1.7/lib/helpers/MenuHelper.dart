// import 'package:flutter_dev/Views/pages/Privacy.dart';

import 'package:flutter_dev/Views/faqs/index.dart';
import 'package:flutter_dev/Views/pages/Contactus.dart';
import 'package:flutter_dev/Views/pages/Notifications.dart';
import 'package:flutter_dev/Views/pages/view.dart';

import '../Views/Pages/Settings.dart';
import 'package:flutter/material.dart';
import 'package:flutter/cupertino.dart';
import 'package:badges/badges.dart';
import 'package:hexcolor/hexcolor.dart';
import 'package:getwidget/getwidget.dart';
import '../Controllers/NotificationController.dart';
//import '../Controllers/WalletController.dart';
import '../Views/users/auth/Login.dart';
import '../Views/Home.dart';
import '../Views/users/my_account/my_account.dart';
// import '../Views/Pages/AboutApp.dart';
// import '../Views/Pages/Aboutus.dart';
// import '../Views/Pages/Contactus.dart';
// import '../Views/Pages/Notifications.dart';
// import '../Views/Pages/TermsAndConditions.dart';
//import '../Views/wallets/view.dart';
// import '../Views/pages/view.dart';
import 'package:shared_preferences/shared_preferences.dart';

import 'LanguageHelper.dart';
import 'SizeConfig.dart';
import 'LanguageHelper.dart' as LanguageHelper;
import '../lang/ar/app.dart' as messages_ar;
import '../lang/en/app.dart' as messages_en;

class MenuHelper  implements Function {
  static var username = "زائــــــــر" ;
  static Widget? menuDrawer;
  double notificationBadgeOpacity = 0.0 ;
  static String notificationCount='1';
  String? walletBalance;
  var language = LanguageHelper.Language;


  Future<String> getNotitficationsCount() async {
    NotificationController notificationController = new NotificationController();
    //get notifications count to view or hide badge
    await notificationController.listUnread().whenComplete((){
      if(notificationController.status == true){
        notificationCount = notificationController.listdata.length.toString();
        if(notificationController.listdata.length > 0){
          notificationBadgeOpacity = 1.0 ;
        }
      }
    });
    return notificationCount;
  }

//  Future<String> getWalletBalance() async {
//    WalletController _WalletController = new WalletController();
//    //get Wallet data
//    await _WalletController.view().whenComplete((){
//      if(_WalletController.status == true){
////        walletBalance = _WalletController.data["data"]["wallet_balance"].toDouble();
//        walletBalance= _WalletController.data["data"]["wallet_balance"].toStringAsFixed(2);
//      }
//    });
//    return walletBalance;
//  }


   Future<String> readUsername() async{
    //get username for user
    final prefs = await SharedPreferences.getInstance();
    final key = 'username';
    final value = prefs.get(key) ?? "0";
    if(value != "0" && value != null){
      username = value.toString();
    }
    return username;
  }

  void readDrawer(context,username,notificationCount,walletBalance) {
    if(int.parse(notificationCount) >0){
      notificationBadgeOpacity = 1.0;
    }
    SizeConfig().init(context); // for media query
    var screenWidthRatio = 10;
    var screenHightRatio = 35;
    var DrawerRatio = 35;
    if(SizeConfig.orientation == Orientation.landscape){
      screenWidthRatio = 20 ;
      screenHightRatio = 55 ;
      DrawerRatio= 55;
    }
    else{
      screenWidthRatio = 10 ;
      screenHightRatio = 35 ;
      DrawerRatio= 55;
    }


    menuDrawer = Drawer(
      // Add a ListView to the drawer. This ensures the user can scroll
      // through the options in the drawer if there isn't enough vertical
      // space to fit everything.
      child: ListView(
        // Important: Remove any padding from the ListView.
        padding: EdgeInsets.zero,
        children: <Widget>[
          Container(
            height: (SizeConfig.screenHeight)! / 6.5,
            child: DrawerHeader(
              child:Row(
                children: <Widget>[
                  Center(
                    child: Icon(
                      Icons.account_circle,
                      size: (SizeConfig.screenHeight)!*2 / screenHightRatio ,
                      color: Colors.white70,
                    ),
                  ),
                  Padding(
                    padding: EdgeInsets.only(left: 10.0, right: 10.0),
                    child:Text(
                      username,
                      style: Theme.of(context).textTheme.subtitle1,
                      textAlign: TextAlign.center,
                    ),
                  )
                ],
              ),
              decoration: BoxDecoration(
                color: Theme.of(context).primaryColor.withOpacity(0.8),
//                image: DecorationImage(
//                  image: AssetImage("assets/images/menuBackground.jpg"),
//                  fit: BoxFit.cover,
//                ),
              ),
            ),
          ),
//          InkWell(
//            onTap: () {
//              Navigator.push(
//                  context,
//                  MaterialPageRoute(builder: (context) => WalletsView())
//              );
//            },
//            child: Container(
//              margin: EdgeInsets.only(left:20.0,right:20.0,top:10.0,bottom: 5.0),
//              decoration: BoxDecoration(
//                color: Colors.white,
//                borderRadius: BorderRadius.all(
//                    Radius.circular(10.0)
//                ),
//                boxShadow: [
//                  BoxShadow(
//                    color: HexColor("#266E00").withOpacity(0.1),
//                    spreadRadius: 5,
//                    blurRadius: 7,
//                    offset: Offset(3, 3), // changes position of shadow
//                  ),
//                ],
//              ),
//              child: GFListTile(
//                  padding: EdgeInsets.all(0.0),
//                  titleText: walletBalance != null ? walletBalance +AppLocalizations.of(context).SARcurrency : '0.00'+AppLocalizations.of(context).SARcurrency ,
//                  subtitleText:AppLocalizations.of(context).wallet_balance,
//                  icon: Icon(Icons.account_balance_wallet,color:  HexColor("036474"))
//              ),
//            ),
//          ),

          SizedBox(
            height: 10.0,
            child: Container(
              decoration: BoxDecoration(
                border: Border(
                    bottom: BorderSide(width: 1.0, color: Colors.black12),
                ),
              ),
            ),
          ),

          ListTile(
            leading: Icon(Icons.home,color:  HexColor("036474")),
            title: Text(
              language == "en" ? messages_en.getTranslation("home") : messages_ar.getTranslation("home")
              ,
            ),
            onTap: () {
              Navigator.push(
                  context,
                  MaterialPageRoute(builder: (context) => Home())
              );
            },
          ),
          SizedBox(
              height: 5.0,
              child: Padding(
                padding: EdgeInsets.only(
                  left: 20.0,
                  right: 20.0,
                ),
                child : Container(
                  decoration: BoxDecoration(
                    border: Border(
                      bottom: BorderSide(width: 1.0, color: Colors.black12),
                    ),
                  ),
                ),
              )
          ),

          ListTile(
            leading: Icon(Icons.account_circle,color:  HexColor("036474")),
            title: Text(
              language == "en" ? messages_en.getTranslation("MyAccount") : messages_ar.getTranslation("MyAccount")
              ,
            ),
            onTap: () {
              Navigator.push(
                  context,
                  MaterialPageRoute(builder: (context) => MyAccount())
              );
            },
          ),



          SizedBox(
              height: 5.0,
              child: Padding(
                padding: EdgeInsets.only(
                  left: 20.0,
                  right: 20.0,
                ),
                child : Container(
                  decoration: BoxDecoration(
                    border: Border(
                      bottom: BorderSide(width: 1.0, color: Colors.black12),
                    ),
                  ),
                ),
              )
          ),
          ListTile(
              leading: Icon(Icons.notifications_active,color:  HexColor("036474")),
              title: Row(
                children: <Widget>[
                  Text(
                    language == "en" ? messages_en.getTranslation("Notifications") : messages_ar.getTranslation("Notifications")
                    ,
                  ),
                  Opacity(opacity: notificationBadgeOpacity ,
                    child: Padding(
                      padding: EdgeInsets.only(right: 10.0,left: 10.0),
                      child:Badge(
                        badgeContent: Text(notificationCount.toString(),
                          style: TextStyle(
                              color: Colors.white
                          ),
                        ),
                        badgeColor: Colors.pink,
                      ),
                    ),
                  ),
                ],
              ),

              onTap: () {
                Navigator.push(
                    context,
                    MaterialPageRoute(builder: (context) => Notifications())
                );
              }
          ),

          SizedBox(
              height: 5.0,
              child: Padding(
                padding: EdgeInsets.only(
                  left: 20.0,
                  right: 20.0,
                ),
                child : Container(
                  decoration: BoxDecoration(
                    border: Border(
                      bottom: BorderSide(width: 1.0, color: Colors.black12),
                    ),
                  ),
                ),
              )
          ),
          ListTile(
            leading: Icon(Icons.email,color:  HexColor("036474")),
            title: Text(
              language == "en" ? messages_en.getTranslation("Contactus") : messages_ar.getTranslation("Contactus")
              ,
            ),
            onTap: () {
              Navigator.push(
                  context,
                  MaterialPageRoute(builder: (context) => Contactus())
              );
            },
          ),

          SizedBox(
              height: 5.0,
              child: Padding(
                padding: EdgeInsets.only(
                  left: 20.0,
                  right: 20.0,
                ),
                child : Container(
                  decoration: BoxDecoration(
                    border: Border(
                      bottom: BorderSide(width: 1.0, color: Colors.black12),
                    ),
                  ),
                ),
              )
          ),
          ListTile(
            leading: Icon(Icons.info,color:  HexColor("036474")),
            title: Text(
              language == "en" ? messages_en.getTranslation("Aboutus") : messages_ar.getTranslation("Aboutus")
              ,
            ),
            onTap: () {
              Navigator.push(
                  context,
                  MaterialPageRoute(builder: (context) => PagesView("aboutus_mobile"))
              );
            },
          ),

          SizedBox(
              height: 5.0,
              child: Padding(
                padding: EdgeInsets.only(
                  left: 20.0,
                  right: 20.0,
                ),
                child : Container(
                  decoration: BoxDecoration(
                    border: Border(
                      bottom: BorderSide(width: 1.0, color: Colors.black12),
                    ),
                  ),
                ),
              )
          ),
          ListTile(
            leading: Icon(Icons.info_outline,color:  HexColor("036474")),
            title: Text(
              language == "en" ? messages_en.getTranslation("AboutApp") : messages_ar.getTranslation("AboutApp")
              ,
            ),
            onTap: () {
              Navigator.push(
                  context,
                  MaterialPageRoute(builder: (context) => PagesView("aboutapp_mobile"))
              );
            },
          ),

          SizedBox(
              height: 5.0,
              child: Padding(
                padding: EdgeInsets.only(
                  left: 20.0,
                  right: 20.0,
                ),
                child : Container(
                  decoration: BoxDecoration(
                    border: Border(
                      bottom: BorderSide(width: 1.0, color: Colors.black12),
                    ),
                  ),
                ),
              )
          ),
          ListTile(
            leading: Icon(Icons.bookmark,color:  HexColor("036474")),
            title: Text(
              language == "en" ? messages_en.getTranslation("TermsAndConditions") : messages_ar.getTranslation("TermsAndConditions")
              ,
            ),
            onTap: () {
              Navigator.push(
                  context,
                  MaterialPageRoute(builder: (context) => PagesView("terms_mobile"))
              );
            },
          ),


          SizedBox(
              height: 5.0,
              child: Padding(
                padding: EdgeInsets.only(
                  left: 20.0,
                  right: 20.0,
                ),
                child : Container(
                  decoration: BoxDecoration(
                    border: Border(
                      bottom: BorderSide(width: 1.0, color: Colors.black12),
                    ),
                  ),
                ),
              )
          ),
          ListTile(
            leading: Icon(Icons.add_moderator_outlined,color:  HexColor("036474")),
            title: Text(
              language == "en" ? messages_en.getTranslation("Privacy") : messages_ar.getTranslation("Privacy")
              ,
            ),
            onTap: () {
              Navigator.push(
                  context,
                  MaterialPageRoute(builder: (context) => PagesView("privacy_mobile"))
              );
            },
          ),




          SizedBox(
              height: 5.0,
              child: Padding(
                padding: EdgeInsets.only(
                  left: 20.0,
                  right: 20.0,
                ),
                child : Container(
                  decoration: BoxDecoration(
                    border: Border(
                      bottom: BorderSide(width: 1.0, color: Colors.black12),
                    ),
                  ),
                ),
              )
          ),
          ListTile(
            leading: Icon(Icons.comment_outlined,color:  HexColor("036474")),
            title: Text(
              language == "en" ? messages_en.getTranslation("faqs") : messages_ar.getTranslation("faqs")
              ,
            ),
            onTap: () {
              Navigator.push(
                  context,
                  MaterialPageRoute(builder: (context) => FaqsIndex())
              );
            },
          ),


          SizedBox(
              height: 5.0,
              child: Padding(
                padding: EdgeInsets.only(
                  left: 20.0,
                  right: 20.0,
                ),
                child : Container(
                  decoration: BoxDecoration(
                    border: Border(
                      bottom: BorderSide(width: 1.0, color: Colors.black12),
                    ),
                  ),
                ),
              )
          ),
          ListTile(
            leading: Icon(Icons.settings,color:  HexColor("036474")),
            title: Text(
              language == "en" ? messages_en.getTranslation("Settings") : messages_ar.getTranslation
                ("Settings")
              ,
            ),
            onTap: () {
              Navigator.push(
                  context,
                  MaterialPageRoute(builder: (context) => Settings())
              );
            },
          ),

          SizedBox(
              height: 5.0,
              child: Padding(
                padding: EdgeInsets.only(
                  left: 20.0,
                  right: 20.0,
                ),
                child : Container(
                  decoration: BoxDecoration(
                    border: Border(
                      bottom: BorderSide(width: 1.0, color: Colors.black12),
                    ),
                  ),
                ),
              )
          ),
          ListTile(
            leading: Icon(Icons.rotate_left,color:  HexColor("036474")),
            title: Text(
              language == "en" ? messages_en.getTranslation("Logout") : messages_ar.getTranslation("Logout")
              ,
            ),
            onTap: () async {
              final prefs = await SharedPreferences.getInstance();
              prefs.remove("token");
              Navigator.pushReplacement(
                  context,
                  MaterialPageRoute(builder: (context) => LoginPage())
              );
            },
          ),
        ],
      ),
    );
  }



}
