import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:flutter_dev/helpers/InternetHelper.dart';
import '../../helpers/LanguageHelper.dart' as LanguageHelper;
import '../Home.dart';


class Settings extends StatefulWidget {
  @override
  _SettingsState createState() => _SettingsState();
}

class _SettingsState extends State<Settings> {

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

  var language;

  changeLanguage(lang) async {
    await LanguageHelper.onLocaleChange(context,lang);
    await LanguageHelper.initialize();
    setState(() {
      language = LanguageHelper.Language;
    });
    Navigator.of(context).pushReplacement(
        MaterialPageRoute(builder: (context) => Home())
    );
  }

  read() async {
    /*Internet and loading*/
    /**************/
    await checkInternetConnection();
    setState(() {is_loading = false;});
    /*End Internet and loading*/
    /**************/

    await LanguageHelper.initialize();
    setState(() {
      language = LanguageHelper.Language;
    });
  }

  @override
  void initState() {
    // TODO: implement initState
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
    return Scaffold(
      appBar: AppBar(
        title: Text(
            LanguageHelper.trans("app","Settings")
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
        child: Padding(
          padding: EdgeInsets.all(30.0),
          child: Column(
            mainAxisAlignment: MainAxisAlignment.center,
            crossAxisAlignment: CrossAxisAlignment.center,
            children: <Widget>[
              Text(
          LanguageHelper.trans("app","Choose_language")
              ),

              ElevatedButton(
                  onPressed: (){
                    changeLanguage("ar");
                  },
                  child: Text(
                      'العربية'
                  )),
              ElevatedButton(
                  onPressed: (){
                    changeLanguage("en");
                  },
                  child: Text(
                      'English'
                  ))

              // ButtonTheme(
              //   minWidth: double.infinity,
              //   child: RaisedButton(
              //     child:  Text(
              //       "العربيـــــــــــة",
              //       style: Theme.of(context).textTheme.button,
              //     ),
              //     onPressed: ()=> language == "en" ? LanguageHelper.onLocaleChange(context) : null,
              //   ),
              // ),
              // ButtonTheme(
              //   minWidth: double.infinity,
              //   child: RaisedButton(
              //     child:  Text(
              //       "ُEnglish",
              //       style: Theme.of(context).textTheme.button,
              //     ),
              //     onPressed: ()=> language == "ar" ? LanguageHelper.onLocaleChange(context) : null,
              //   ),
              // ),
            ],
          ),
        ),
      )
    );
  }


}
