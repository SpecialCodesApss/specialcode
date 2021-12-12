import 'package:framework_01_6/helpers/bottomNavigatorBarHelper.dart';

import '../packages/flutter_badges/lib/badges.dart';
import '../packages/curved_navigation_bar/lib/curved_navigation_bar.dart';
import 'package:flutter/material.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter/widgets.dart';
import '../packages/hexcolor/hexcolor.dart';
import '../helpers/LoaderDialog.dart';
import '../helpers/MenuHelper.dart';
import '../helpers/SizeConfig.dart';
import '../helpers/ToastHelper.dart';
import '../helpers/LanguageHelper.dart' as LanguageHelper;
import '../lang/ar/app.dart' as messages_ar;
import '../lang/en/app.dart' as messages_en;
import 'package:shared_preferences/shared_preferences.dart';
import 'MyAccount/MyAccount.dart';
import 'Pages/Notifications.dart';
import '../packages/flutter_staggered_animations/lib/flutter_staggered_animations.dart';
import '../packages/flutter_pulltorefresh/lib/pull_to_refresh.dart';
import '../packages/simples_search_bar/lib/simple_search_bar.dart';


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

  Future<bool>_onBackPressed(){
    Navigator.of(context).push(
        MaterialPageRoute(builder: (context) => Home())
    );
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
      body:  WillPopScope(
        onWillPop: _onBackPressed,
        child: ListView(
            children: <Widget>[
              Text("محمد"),
            ],

          ),
      ),

        bottomNavigationBar: bottomNavigator(context,2)

      );
  }
}

