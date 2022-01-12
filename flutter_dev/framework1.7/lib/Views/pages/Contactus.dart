import 'package:flutter_dev/helpers/InternetHelper.dart';
import 'package:hexcolor/hexcolor.dart';
import '../../../Controllers/CustomerServiceMsgController.dart';
import '../../Controllers/PageController.dart';
import '../../helpers/LoaderDialog.dart';
import '../../helpers/ToastHelper.dart';
import '../../helpers/LanguageHelper.dart' as LanguageHelper;
import '../../helpers/SizeConfig.dart';
import 'package:flutter/widgets.dart';
import 'package:flutter/material.dart';
//import 'package:flutter_html/flutter_html.dart';
import 'package:flutter_widget_from_html/flutter_widget_from_html.dart';
import 'package:shared_preferences/shared_preferences.dart';
import '../../helpers/LanguageHelper.dart' as LanguageHelper;
import '../Home.dart';

class Contactus extends StatefulWidget {
  @override
  State<StatefulWidget> createState() {
    // TODO: implement createState
    return _ContactusState();
  }
}

class _ContactusState extends State<Contactus> {
  //declare variables here
  var pageTitle = '';
  var pageHtml = '';

  var language = LanguageHelper.Language;

  CustomerServiceMsgController customerServiceMsgController =
      new CustomerServiceMsgController();

  final TextEditingController _usernameController = new TextEditingController();
  final TextEditingController _emailController = new TextEditingController();
  final TextEditingController _mobileController = new TextEditingController();
  final TextEditingController _messageController = new TextEditingController();

  ViewPageController pageController = new ViewPageController();

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


  read() async {
    /*Internet and loading*/
    /**************/
    await checkInternetConnection();
    setState(() {is_loading = false;});
    /*End Internet and loading*/
    /**************/

    Future.delayed(Duration.zero, () => showLoaderDialogFunction(context));
    pageController.show("contactus").whenComplete(() {
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

  _onPressedUpdate() {
    showLoaderDialogFunction(context);
    if (_usernameController.text.trim().isNotEmpty &&
        _emailController.text.trim().isNotEmpty &&
        _mobileController.text.trim().isNotEmpty &&
        _messageController.text.trim().isNotEmpty) {
      customerServiceMsgController
          .store(_usernameController.text.trim(), _emailController.text.trim(),
              _mobileController.text.trim(), _messageController.text.trim())
          .whenComplete(() {
        if (customerServiceMsgController.status == true) {
          ShowToast('success', customerServiceMsgController.message);

          setState(() {
            _usernameController.clear();
            _emailController.clear();
            _mobileController.clear();
            _messageController.clear();
          });

          Future.delayed(
              Duration.zero, () => hideLoaderDialogFunction(context));
        } else {
          Future.delayed(
              Duration.zero, () => hideLoaderDialogFunction(context));
          ShowToast('warning', customerServiceMsgController.message);
        }
      });
    } else {
      Future.delayed(Duration.zero, () => hideLoaderDialogFunction(context));
      ShowToast('error',
          LanguageHelper.trans("app","pleasefillallfields")
         ,
          );
    }
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
          //pageTitle,
            LanguageHelper.trans("app","Contactus")
          ,
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
          decoration: BoxDecoration(
            /*image: DecorationImage(
            image: AssetImage("assets/images/bg.png"),
            fit: BoxFit.cover,
          ),*/
          ),
          child: ListView(
            children: <Widget>[


                  Padding(
                    padding: EdgeInsets.all(20.0),
                    child:
                    SingleChildScrollView(
                        child: HtmlWidget(pageHtml)
                    ),
                  ),

//              TextField(
//                controller: _usernameController,
//                textDirection: TextDirection.rtl,
//                textAlign: TextAlign.right,
//                style: Theme.of(context).textTheme.bodyText1,
//                decoration: InputDecoration(
//                  hintText:
//                  language == "en" ? messages_en.getTranslation("name") : messages_ar.getTranslation("name"),
//                ),
//              ),



    Container(
    child: Card(
    color: Colors.white.withOpacity(0.8),
    child: Padding(padding: EdgeInsets.all(20.0),
    child:  Column(
                  children: <Widget>[
                    TextField(
                      controller: _usernameController,
                      textAlign: language == "en" ? TextAlign.left : TextAlign.right ,
                      style: Theme.of(context).textTheme.bodyText1,
                      decoration: InputDecoration(
                        hintText:
                        LanguageHelper.trans("app","name")
                        ,
                      ),
                    ),
                    TextField(
                      controller: _emailController,
                      textAlign: language == "en" ? TextAlign.left : TextAlign.right ,
                      keyboardType: TextInputType.emailAddress,
                      style: Theme.of(context).textTheme.bodyText1,
                      decoration: InputDecoration(
                        hintText:
                        LanguageHelper.trans("app","email")
                        ,
                      ),
                    ),
                    TextField(
                      controller: _mobileController,
                      textAlign: language == "en" ? TextAlign.left : TextAlign.right ,
                      keyboardType: TextInputType.phone,
                      style: Theme.of(context).textTheme.bodyText1,
                      decoration: InputDecoration(
                        hintText:
                        LanguageHelper.trans("app","mobile")
                        ,
                      ),
                    ),
                    TextField(
                      controller: _messageController,
                      textAlign: language == "en" ? TextAlign.left : TextAlign.right ,
                      style: Theme.of(context).textTheme.bodyText1,
                      decoration: InputDecoration(
                        hintText:
                        LanguageHelper.trans("app","Message")
                        ,
                      ),
                      maxLines: 6,
                      keyboardType: TextInputType.multiline,
//                expands: true,
//                minLines: 6,
                    ),
                    SizedBox(
                      height: (SizeConfig.screenHeight)! / screenHightRatio,
                    ),
                    ButtonTheme(
                      minWidth: double.infinity,
                      child: RaisedButton(
                          child: Text(
                              LanguageHelper.trans("app","send")
                            ,
                            style: Theme.of(context).textTheme.button,
                          ),
                          onPressed: _onPressedUpdate),
                      buttonColor: HexColor('232323'),
                    ),
                  ],
                ),
              )
              )
              )

//              Container(
//                child: Card(
//                    color: Colors.white.withOpacity(0.8),
//                    child: Padding(
//                      padding: EdgeInsets.all(20.0),
//                      child: Column(
//                        children: <Widget>[
//                          SingleChildScrollView(
//                            child: HtmlWidget( pageHtml
//                            ),
//                          ),
//
//
//                        ],
//                      ),
//                    )),
//              ),


            ],
          )),
    );
  }
}
