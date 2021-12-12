import 'package:flutter/material.dart';
import 'package:framework_01_6/Views/Home.dart';
import 'package:framework_01_6/Views/MyAccount/MyAccount.dart';
import 'package:framework_01_6/Views/Pages/AboutApp.dart';
import 'package:framework_01_6/Views/Pages/Contactus.dart';
import 'package:framework_01_6/Views/Pages/Notifications.dart';
import 'package:framework_01_6/packages/curved_navigation_bar/lib/curved_navigation_bar.dart';
import 'package:framework_01_6/packages/flutter_badges/lib/badges.dart';
import 'package:framework_01_6/packages/hexcolor/src/hexcolor.dart';


String notificationCount = '0';
double notificationBadgeOpacity = 0.0;
int _page = 1;
GlobalKey _bottomNavigationKey = GlobalKey();


Widget bottomNavigator(context,current_index){

  return CurvedNavigationBar(
    index: current_index,
    height: 50.0,
    items: <Widget>[
      int.parse(notificationCount) > 0 ?  Container(
        alignment: Alignment.center,
        child: Badge(
          position: BadgePosition.topEnd(),
          badgeContent: null,
          child: IconButton(
            icon: Icon(Icons.add_alert, size: 30,color:Colors.white),
          ),
        ),
      ) : Icon(Icons.add_alert, size: 30,color:Colors.white) ,
      Icon(Icons.message, size: 30,color:Colors.white),
      Icon(Icons.home, size: 30,color:Colors.white),
      Icon(Icons.account_box, size: 30,color:Colors.white),
      Icon(Icons.info_outline, size: 30,color:Colors.white),
    ],
    color: Hexcolor('232323'),
    buttonBackgroundColor:  Hexcolor('232323'),
    backgroundColor:Hexcolor('f0f0f0'),
    animationCurve: Curves.easeInOut,
    animationDuration: Duration(milliseconds: 600),
    onTap: (index) {
        _page = index;
        if(index == 0){
          Navigator.of(context).push(
              MaterialPageRoute(builder: (context) => Notifications())
          );
        }
        if(index == 1){
          Navigator.of(context).push(
              MaterialPageRoute(builder: (context) => Contactus())
          );
        }
        if(index == 2){
          Navigator.of(context).push(
              MaterialPageRoute(builder: (context) => Home())
          );
        }
        if(index == 3){
          Navigator.of(context).push(
              MaterialPageRoute(builder: (context) => MyAccount())
          );
        }
        if(index == 4){
          Navigator.of(context).push(
              MaterialPageRoute(builder: (context) => AboutApp())
          );
        }
    },
  );

}