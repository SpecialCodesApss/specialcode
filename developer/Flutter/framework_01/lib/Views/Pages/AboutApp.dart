import '../../packages/hexcolor/hexcolor.dart';
import '../../Controllers/PageController.dart';
import '../../helpers/LoaderDialog.dart';
import '../../helpers/LanguageHelper.dart' as LanguageHelper;
import '../../lang/ar/app.dart' as messages_ar;
import '../../lang/en/app.dart' as messages_en;
import '../../helpers/SizeConfig.dart';
import 'package:flutter/widgets.dart';
import 'package:flutter/material.dart';
//import 'package:flutter_html/flutter_html.dart';
import 'package:flutter_widget_from_html/flutter_widget_from_html.dart';

import '../Home.dart';

class AboutApp extends StatefulWidget {
  @override
  State<StatefulWidget> createState() {
    // TODO: implement createState
    return _AboutAppState();
  }
}

class _AboutAppState extends State<AboutApp> {
  //declare variables here
  var pageTitle = '';
  var pageHtml = '';
  var language = LanguageHelper.Language;

  ViewPageController pageController = new ViewPageController();
  read() async {
    Future.delayed(Duration.zero, () => showLoaderDialogFunction(context));
    pageController.show("aboutapp").whenComplete(() {
      if (pageController.status == true) {
        Future.delayed(Duration.zero, () => hideLoaderDialogFunction(context));
        setState(() {
          pageTitle = pageController.data["data"]["title_$language"] ?? " ";
          pageHtml = pageController.data["data"]["html_page_$language"] ?? " ";
        });
      }
    });
  }

  @override
  initState() {
    super.initState();
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
          pageTitle,
//          AppLocalizations.of(context).AboutApp == null ? "loading" : AppLocalizations.of(context).AboutApp,
          style: Theme.of(context).textTheme.title,
        ),
        centerTitle: true,
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
              children: <Widget>[
                Container(
                    child:
                    Padding(
                      padding: EdgeInsets.all(20.0),
                      child:
                      SingleChildScrollView(
                          child: HtmlWidget(pageHtml)
                      ),
                    )),
              ],
            )),
      ),
      bottomSheet:
      Padding(
        padding: EdgeInsets.only(right: 20.0,left: 20.0),
        child: Text( language == "en" ? messages_en.getTranslation("app_copyrights") : messages_ar.getTranslation
          ("app_copyrights") ),
      ),
    );
  }
}
