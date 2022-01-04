import '../../../../helpers/bottomNavigatorBarHelper.dart';

import 'package:badges/badges.dart';
import 'package:curved_navigation_bar/curved_navigation_bar.dart';
import 'package:flutter/material.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter/widgets.dart';
import 'package:hexcolor/hexcolor.dart';
import '../../helpers/LoaderDialog.dart';
import '../../helpers/MenuHelper.dart';
import '../../helpers/SizeConfig.dart';
import '../../helpers/ToastHelper.dart';
import '../../helpers/LanguageHelper.dart' as LanguageHelper;
import '../../lang/ar/app.dart' as messages_ar;
import '../../lang/en/app.dart' as messages_en;
import 'package:shared_preferences/shared_preferences.dart';
// import 'views/users/my_account/my_account.dart';
// import 'views/pages/notifications.dart';
import 'package:flutter_staggered_animations/flutter_staggered_animations.dart';
import 'package:pull_to_refresh/pull_to_refresh.dart';
// import 'package:simple_search_bar/simple_search_bar.dart';



class Home extends StatefulWidget {
  @override
  _HomeState createState() => _HomeState();
}

class _HomeState extends State<Home> {

  var language = LanguageHelper.Language;
  var notificationCount="0";
  var notificationBadgeOpacity=0.0;
  String username = "زائــــــــر";
  var menuDrawer;

  _read(){
    MenuHelper().getNotitficationsCount().then((String result) {
      setState(() {
        notificationCount = result;
        if (int.parse(notificationCount) > 0) {
          notificationBadgeOpacity = 1.0;
        }
      });
    });
//    MenuHelper().getWalletBalance().then((String result) {
//      setState(() {
//        walletBalance = result;
//      });
//    });
    MenuHelper().readUsername().then((String result) {
      if(mounted){
        setState(() {
          username = result;
        });
      }
    });

  }

  @override
  void initState() {
    // TODO: implement initState
    super.initState();
    _read();
  }

  @override
  void dispose() {
    // TODO: implement dispose
    super.dispose();
  }


  @override
  Widget build(BuildContext context) {

    MenuHelper().readDrawer(context, username, notificationCount, 0);
    menuDrawer = MenuHelper.menuDrawer;

    return Scaffold(
        appBar: AppBar(
          title:Text(language == "en" ? messages_en.getTranslation("home") : messages_ar.getTranslation("home"))
          ,
          centerTitle: true,
        ),
      drawer: MenuHelper.menuDrawer,
      body:  ListView(
          children: <Widget>[
            Text("محمد"),
          ],

        ),

        // bottomNavigationBar: bottomNavigator(context,2)

      );
  }
}

