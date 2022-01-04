import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:flutter_dev/Views/users/auth/Login.dart';
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
import 'helpers/LanguageHelper.dart' as LanguageHelper;
import 'package:flutter_app_restart/flutter_app_restart.dart';
import 'helpers/sharedPreferencesHelper.dart' as sharedPreferencesHelper;
import 'package:hexcolor/hexcolor.dart';

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
  var language = LanguageHelper.Language;
  var token = sharedPreferencesHelper.token;

  // This widget is the root of your application.
  @override
  void initState() {
    // TODO: implement initState
    _read();
    super.initState();
  }

  _read() async {
    await LanguageHelper.initialize();
    await sharedPreferencesHelper.initialize_token();
    setState(() {
      language = LanguageHelper.Language;
      token = sharedPreferencesHelper.token;
    });
  }

  @override
  Widget build(BuildContext context) {
    var lang = LanguageHelper.Language;
    // TODO: implement build
    return GestureDetector(
      onTap: () {
        FocusScopeNode currentFocus = FocusScope.of(context);
        if (!currentFocus.hasPrimaryFocus) {
          currentFocus.unfocus();
        }
      },
      child: MaterialApp(
        // builder: (BuildContext context, Widget child) {
        //   return  Directionality(
        //     textDirection: language == "en" ? TextDirection.ltr : TextDirection.rtl,
        //     child: new Builder(
        //       builder: (BuildContext context) {
        //         return new MediaQuery(
        //           data: MediaQuery.of(context).copyWith(
        //             textScaleFactor: 1.0,
        //           ),
        //           child: child,
        //         );
        //       },
        //     ),
        //   );
        // },
        locale: Locale("ar"),
        title: 'framework',
        theme: ThemeData(
            primarySwatch: Colors.blue,
            primaryColor: HexColor('#0a77c5'),
            accentColor: HexColor('#f8f80a'),
            // Define the default font family.
            fontFamily: 'Arial',
            // Define the default TextTheme. Use this to specify the default
            // text styling for headlines, titles, bodies of text, and more.
            // textTheme: TextTheme(
            //   headline: TextStyle(fontSize: 72.0, fontWeight: FontWeight.bold),
            //   title: TextStyle(fontSize: 17.0, color: Colors.white),
            //   body1: TextStyle(fontSize: 14.0, fontFamily: 'Arial'),
            //   button: TextStyle(fontSize: 13.0, fontFamily: 'Arial', color: Colors.white),
            //   subtitle: TextStyle(fontSize: 15.0, fontWeight: FontWeight.bold),
            //   display1: TextStyle(fontSize: 20.0, fontWeight: FontWeight.bold, color: Colors.black12),
            // ),
            buttonTheme: ButtonThemeData(
              padding: EdgeInsets.all(10.0),
              buttonColor: HexColor('#0a0a0a'), //  <-- dark color
            )),
        home: Directionality(
          textDirection: language == "en" ? TextDirection.ltr : TextDirection.rtl,
          // child: Splash(),
          child: LoginPage(),
        ),
      ),
    );
  }
}
