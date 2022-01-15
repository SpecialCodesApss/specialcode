import 'package:flutter/material.dart';
import 'package:curved_navigation_bar/curved_navigation_bar.dart';
import 'package:badges/badges.dart';
import 'package:flutter_dev/Views/pages/view.dart';
import 'package:hexcolor/hexcolor.dart';
import 'package:flutter_dev/Views/Home.dart';
import 'package:flutter_dev/Views/users/my_account/my_account.dart';
// import 'package:flutter_dev/Views/Pages/AboutApp.dart';
import 'package:flutter_dev/Views/Pages/Contactus.dart';
import 'package:flutter_dev/Views/Pages/Notifications.dart';


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
          // badgeContent: '',
          child: IconButton(
            icon: Icon(Icons.add_alert, size: 30,color:Colors.white), onPressed: () {  },
          ),
        ),
      ) : Icon(Icons.add_alert, size: 30,color:Colors.white) ,
      Icon(Icons.message, size: 30,color:Colors.white),
      Icon(Icons.home, size: 30,color:Colors.white),
      Icon(Icons.account_box, size: 30,color:Colors.white),
      Icon(Icons.info_outline, size: 30,color:Colors.white),
    ],
    color: HexColor('232323'),
    buttonBackgroundColor:  HexColor('232323'),
    backgroundColor:HexColor('f0f0f0'),
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
              MaterialPageRoute(builder: (context) => PagesView("aboutus"))
          );
        }
    },
  );

}
