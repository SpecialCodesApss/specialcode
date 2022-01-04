import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import '../../helpers/LanguageHelper.dart' as LanguageHelper;
import '../../lang/ar/app.dart' as messages_ar;
import '../../lang/en/app.dart' as messages_en;

class Settings extends StatefulWidget {
  @override
  _SettingsState createState() => _SettingsState();
}

class _SettingsState extends State<Settings> {

  @override
  void initState() {
    // TODO: implement initState
    super.initState();
  }
  @override
  void dispose() {
    // TODO: implement dispose
    super.dispose();
  }

  var language = LanguageHelper.Language;
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(
          language == "en" ? messages_en.getTranslation("Settings") : messages_ar.getTranslation("Settings")
        ),
        centerTitle: true,
      ),

      body: Container(
        alignment: Alignment.center,
        child: Padding(
          padding: EdgeInsets.all(30.0),
          child: Column(
            mainAxisAlignment: MainAxisAlignment.center,
            crossAxisAlignment: CrossAxisAlignment.center,
            children: <Widget>[
              Text(
                  language == "en" ? messages_en.getTranslation("Choose_language") : messages_ar.getTranslation
                    ("Choose_language")
              ),
              ButtonTheme(
                minWidth: double.infinity,
                child: RaisedButton(
                  child:  Text(
                    "العربيـــــــــــة",
                    style: Theme.of(context).textTheme.button,
                  ),
                  onPressed: ()=> language == "en" ? LanguageHelper.onLocaleChange(context) : null,
                ),
              ),
              ButtonTheme(
                minWidth: double.infinity,
                child: RaisedButton(
                  child:  Text(
                    "ُEnglish",
                    style: Theme.of(context).textTheme.button,
                  ),
                  onPressed: ()=> language == "ar" ? LanguageHelper.onLocaleChange(context) : null,
                ),
              ),
            ],
          ),
        ),
      )
    );
  }


}
