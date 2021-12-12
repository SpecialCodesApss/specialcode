//import 'package:flutter/cupertino.dart';
//import 'package:flutter/material.dart';
//
//import '../lang/ar/tests.dart' as messages_ar;
//import '../lang/en/tests.dart' as messages_en;
//
//import '../helpers/LanguageHelper.dart' as LanguageHelper;
//
//class Test extends StatefulWidget {
//  @override
//  _TestState createState() => _TestState();
//}
//
//class _TestState extends State<Test> {
//
//  @override void initState() {
//    // TODO: implement initState
//    super.initState();
////    LanguageHelper.initialize();
//  }
//
//
//
//
//  @override
//  Widget build(BuildContext context) {
//
//    var lang = LanguageHelper.Language;
//    print(lang);
//    return Scaffold(
//      appBar: AppBar(
//        title: Text("Translation Test"),
//        actions: <Widget>[
//          IconButton(
//            icon: Icon(
//              Icons.settings,
//              color: Colors.white,
//            ),
//            onPressed: () {
//              setState((){
//                  LanguageHelper.onLocaleChange(context);
//              });
//            },
//          )
//        ],
//      ),
//      body: Container(
//        child:
//        Column(
//          textDirection:TextDirection.rtl ,
//          children: <Widget>[
//            Text(
//                "تسجيل دخول حساب جديد",
//              textDirection: TextDirection.rtl,
//              textAlign: TextAlign.right,
//            ),
//          ],
//        ),
//      ),
//    );
//  }
//}
