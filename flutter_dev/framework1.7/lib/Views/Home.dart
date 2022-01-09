import 'package:flutter_dev/helpers/InternetHelper.dart';

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
import 'package:upgrader/upgrader.dart';


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


  _read() async {

    /*Internet and loading*/
    /**************/
    await checkInternetConnection();
    setState(() {is_loading = false;});
    /*End Internet and loading*/
    /**************/

    // MenuHelper().getNotitficationsCount().then((String result) {
    //   setState(() {
    //     notificationCount = result;
    //     if (int.parse(notificationCount) > 0) {
    //       notificationBadgeOpacity = 1.0;
    //     }
    //   });
    // });
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


  String serverUrl = "192.168.1.5/framework1.7/";


  final appcastURL =
      'https://raw.githubusercontent.com/larryaasen/upgrader/master/test/testappcast.xml';



  @override
  Widget build(BuildContext context) {

    MenuHelper().readDrawer(context, username, notificationCount, 0);
    menuDrawer = MenuHelper.menuDrawer;

    Upgrader().clearSavedSettings();
    // final appcastURL =
    //     'https://raw.githubusercontent.com/larryaasen/upgrader/master/test/testappcast.xml';

     final appcastURL = 'http://192.168.1.5/framework1.7/appcast.xml';
    final cfg = AppcastConfiguration(url: appcastURL, supportedOS: ['android','ios']);

    return
      UpgradeAlert(
        appcastConfig: cfg,
          dialogStyle: UpgradeDialogStyle.material,
        // dialogStyle: UpgradeDialogStyle.cupertino,
        debugLogging: true,
        canDismissDialog: true,
        countryCode: "EG" ,
        messages:UpgraderMessages(code: 'ar') ,
    showReleaseNotes: false,
    child:
    Scaffold(
        appBar: AppBar(
          title:Text(language == "en" ? messages_en.getTranslation("home") : messages_ar.getTranslation("home"))
          ,
          centerTitle: true,
        ),
      drawer: MenuHelper.menuDrawer,
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


      ListView(
          children: <Widget>[
            Text("...محمد"),
          ],

        ),

        // bottomNavigationBar: bottomNavigator(context,2)
      )
      );
  }
}

