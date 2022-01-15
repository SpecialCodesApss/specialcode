import 'package:flutter_dev/helpers/InternetHelper.dart';
import 'package:hexcolor/hexcolor.dart';
import '../../Controllers/PagesController.dart';
import '../../helpers/LoaderDialog.dart';
import '../../helpers/LanguageHelper.dart' as LanguageHelper;
import '../../helpers/SizeConfig.dart';
import 'package:flutter/widgets.dart';
import 'package:flutter/material.dart';
//import 'package:flutter_html/flutter_html.dart';
import 'package:flutter_widget_from_html/flutter_widget_from_html.dart';
import '../Home.dart';


class PagesView extends StatefulWidget {

  var page_key;
  PagesView(this.page_key);


  @override
  State<StatefulWidget> createState() {
    // TODO: implement createState
    return _PageViewState();
  }
}

class _PageViewState extends State<PagesView> {
  //declare variables here
  var pageTitle = '';
  var pageHtml = '';
  var language = LanguageHelper.Language;


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

  // ViewPageController pageController = new ViewPageController();
  PagesController pageController = new PagesController();
  read() async {
    /*Internet and loading*/
    /**************/
    await checkInternetConnection();
    setState(() {is_loading = false;});
    /*End Internet and loading*/
    /**************/

    await LanguageHelper.initialize();
    language = LanguageHelper.Language;

    Future.delayed(Duration.zero, () => showLoaderDialogFunction(context));
    pageController.view(widget.page_key).whenComplete(() {
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
      backgroundColor: HexColor('f0f0f0'),
      appBar: AppBar(
        title: Text(
          pageTitle,
//          AppLocalizations.of(context).AboutApp == null ? "loading" : AppLocalizations.of(context).AboutApp,
          style: Theme.of(context).textTheme.subtitle1,
        ),
        centerTitle: true,
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
       bottomSheet: widget.page_key == "aboutapp_mobile" ?
      Padding(
        padding: EdgeInsets.only(right: 20.0,left: 20.0),
        child: Text(
            LanguageHelper.trans("app","app_copyrights")
        ),
      ):SizedBox(),
    );
  }
}
