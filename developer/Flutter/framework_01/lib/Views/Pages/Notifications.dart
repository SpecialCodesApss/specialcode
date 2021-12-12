import 'package:framework_01_6/helpers/bottomNavigatorBarHelper.dart';

import '../../packages/flutter_badges/lib/badges.dart';
import '../../packages/curved_navigation_bar/lib/curved_navigation_bar.dart';
import '../../packages/hexcolor/hexcolor.dart';
import '../../Controllers/NotificationController.dart';
import '../../helpers/LoaderDialog.dart';
import '../../helpers/MenuHelper.dart';
import '../../helpers/ToastHelper.dart';
import '../../helpers/LanguageHelper.dart' as LanguageHelper;
import '../../lang/ar/app.dart' as messages_ar;
import '../../lang/en/app.dart' as messages_en;
import '../../helpers/SizeConfig.dart';
import 'package:flutter/widgets.dart';
import 'package:flutter/material.dart';
import '../../packages/getwidget/lib/getwidget.dart';


import '../Home.dart';

class Notifications extends StatefulWidget {
  @override
  State<StatefulWidget> createState() {
    // TODO: implement createState
    return _NotificationsState();
  }
}

class _NotificationsState extends State<Notifications> {
  String notificationCount = '0';
  double notificationBadgeOpacity = 0.0;
  int _page = 1;
  GlobalKey _bottomNavigationKey = GlobalKey();
  var language = LanguageHelper.Language;

  //declare variables here
  List data;
  bool isNoNotifications = true;
  NotificationController notificationController = new NotificationController();
  read() async {
    //get all un readed notifications
    Future.delayed(Duration.zero, () => showLoaderDialogFunction(context));
    notificationController.listUnread().whenComplete(() {
      if (notificationController.status == true) {
        setState(() {
          data = notificationController.listdata;
          if (data.length > 0) {
            isNoNotifications = false;
          }
        });
        Future.delayed(Duration.zero, () => hideLoaderDialogFunction(context));
        //mark all notifications as readed
        notificationController.update();
      } else {
        ShowToast('warning', notificationController.message);
        Future.delayed(Duration.zero, () => hideLoaderDialogFunction(context));
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

    return  Scaffold(
      backgroundColor: Hexcolor('f0f0f0'),
      appBar: AppBar(
        title: Text(
          language == "en" ? messages_en.getTranslation("Notifications") : messages_ar.getTranslation("Notifications") ,
          style: Theme.of(context).textTheme.title,
        ),
        centerTitle: true,
        leading: IconButton(
          icon: Icon(Icons.arrow_back),
          onPressed: () => Navigator.of(context)
              .push(MaterialPageRoute(builder: (context) => Home())),
        ),
      ),
      body:
      isNoNotifications
          ? WillPopScope(
        onWillPop: _onBackPressed,
            child: Container(
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
                                Text(
                                  language == "en" ? messages_en.getTranslation("Nonotifications") : messages_ar.getTranslation("Nonotifications"),
                                  style: Theme.of(context).textTheme.body1,
                                ),
                              ],
                            ),
                          )),
                    ),
                  ],
                ),
              ),
          )
          : WillPopScope(
        onWillPop: _onBackPressed,
            child: Container(
                decoration: BoxDecoration(
                  /*image: DecorationImage(
              image: AssetImage("assets/images/bg.png"),
              fit: BoxFit.cover,
            ),*/
                ),
                child: ListView.builder(
                  padding: EdgeInsets.only(top: 10.0, bottom: 5.0),
                  itemCount: data == null ? 0 : data.length,
                  itemBuilder: (BuildContext context, int index) {
                    return Container(
                      margin: EdgeInsets.only(
                          left: 20.0, right: 20.0, top: 10.0, bottom: 5.0),
                      decoration: BoxDecoration(
                        color: Colors.white,
                        borderRadius: BorderRadius.all(Radius.circular(10.0)),
                        boxShadow: [
                          BoxShadow(
                            color: Hexcolor("#68628d").withOpacity(0.1),
                            spreadRadius: 5,
                            blurRadius: 7,
                            offset: Offset(3, 3), // changes position of shadow
                          ),
                        ],
                      ),
                      child: GFListTile(
                          padding: EdgeInsets.all(0.0),
                          titleText: data[index]["notification_text"],
                          icon: Icon(Icons.add_alert)),
                    );
                  },
                ),
              ),
          ),


      bottomNavigationBar: bottomNavigator(context,0)

    );
  }
}
