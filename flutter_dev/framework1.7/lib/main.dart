import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:flutter_dev/Views/Home.dart';
import 'package:flutter_dev/Views/Splash.dart';
import 'package:flutter_dev/Views/main/LangaugePage.dart';
import 'package:flutter_dev/Views/users/auth/Login.dart';
import 'package:flutter_dev/Views/users/my_account/edit.dart';
import 'package:flutter_dev/Views/users/my_account/my_account.dart';
import 'package:shared_preferences/shared_preferences.dart';
// import 'package:framework_01_6/Views/companies/index.dart';
// import 'package:framework_01_6/Views/companies/store.dart';
// import 'package:framework_01_6/Views/companies_categories/index.dart';
// import 'package:framework_01_6/Views/companies_reviews/index.dart';
// import 'package:framework_01_6/Views/countries/index.dart';
// import 'package:framework_01_6/Views/country_cities/index.dart';
// import 'package:framework_01_6/Views/country_cities_areas/index.dart';
// import 'package:framework_01_6/Views/currencies/index.dart';
// import 'package:framework_01_6/Views/email_newsletters_users/store.dart';
// import 'package:framework_01_6/Views/events/index.dart';
// import 'package:framework_01_6/Views/languages/index.dart';
// import 'package:framework_01_6/Views/news/index.dart';
// import 'package:framework_01_6/Views/news_authers/index.dart';
// import 'package:framework_01_6/Views/news_categories/index.dart';
// import 'package:framework_01_6/Views/news_comments/index.dart';
// import 'package:framework_01_6/Views/news_newspaper_publishers/index.dart';
// import 'package:framework_01_6/Views/news_users_notifications_settings/index.dart';
// import 'package:framework_01_6/Views/news_users_notifications_settings/update.dart';
// import 'package:framework_01_6/Views/our_services/index.dart';
// import 'package:framework_01_6/Views/sponsers/index.dart';
// import 'Views/Splash.dart';
import 'helpers/InternetHelper.dart';
import 'helpers/LanguageHelper.dart' as LanguageHelper;
import 'package:flutter_app_restart/flutter_app_restart.dart';
import 'helpers/sharedPreferencesHelper.dart' as sharedPreferencesHelper;
import 'package:hexcolor/hexcolor.dart';
import 'package:connectivity/connectivity.dart';

void main() async {
  WidgetsFlutterBinding.ensureInitialized();
  SystemChrome.setPreferredOrientations(
      [DeviceOrientation.portraitUp, DeviceOrientation.landscapeLeft, DeviceOrientation.landscapeRight]).then((_) {
    runApp(
      MyApp(),
    );
  });
}

class MyApp extends StatefulWidget {
  @override
  State<StatefulWidget> createState() {
    // TODO: implement createState
    return _MyAppState();
  }
}

class _MyAppState extends State<MyApp> {

  String language = "ar";
  String? token;

  // This widget is the root of your application.
  @override
  void initState() {
    // TODO: implement initState
    _read();
    super.initState();
  }

  _read() async{
    await LanguageHelper.initialize();
    setState(() {
      language = LanguageHelper.Language!;
    });
  }



  @override
  Widget build(BuildContext context) {
    // TODO: implement build
    return GestureDetector(
      onTap: () {
        FocusScopeNode currentFocus = FocusScope.of(context);
        if (!currentFocus.hasPrimaryFocus) {
          currentFocus.unfocus();
        }
      },
      child: Directionality(
        textDirection: TextDirection.rtl ,
        child: Stack(
          children: [

            MaterialApp(
              locale: Locale('ar'),
              title: 'framework_1.7',
              theme: ThemeData(
                  primaryColor: HexColor('#0a77c5'),
                  // Define the default font family.
                  fontFamily: 'Arial',
                  // Define the default TextTheme. Use this to specify the default
                  // text styling for headlines, titles, bodies of text, and more.
                  textTheme: TextTheme(
                    // headline1: TextStyle(fontSize: 20.0, fontWeight: FontWeight.bold),
                    // subtitle1: TextStyle(fontSize: 17.0, color: Colors.white),
                    // bodyText1: TextStyle(fontSize: 14.0, fontFamily: 'Arial'),
                    button: TextStyle(fontSize: 13.0, fontFamily: 'Arial', color: Colors.white),
                    // subtitle2: TextStyle(fontSize: 15.0, fontWeight: FontWeight.bold),
                    // bodyText2: TextStyle(fontSize: 20.0, fontWeight: FontWeight.bold, color: Colors.black12),
                  ),
                  buttonTheme: ButtonThemeData(
                    padding: EdgeInsets.all(10.0),
                    buttonColor: HexColor('#0a0a0a'), //  <-- dark color
                  ), colorScheme: ColorScheme.fromSwatch(primarySwatch: Colors.blue).copyWith(secondary: HexColor('#f8f80a'))),
              home: Splash(),
              // home: LoginPage(),
            )



          ],
        ),
      ),
    );
  }
}
