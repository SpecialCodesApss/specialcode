
import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import '../../../helpers/LanguageHelper.dart' as LanguageHelper;

class LanguagePage extends StatefulWidget {
  const LanguagePage({Key? key}) : super(key: key);

  @override
  _LanguagePageState createState() => _LanguagePageState();
}

class _LanguagePageState extends State<LanguagePage> {

  var language;

  changeLanguage(lang) async {
    await LanguageHelper.onLocaleChange(context,lang);
    await LanguageHelper.initialize();
    setState(() {
      language = LanguageHelper.Language;
    });
  }

  read() async {
    await LanguageHelper.initialize();
    setState(() {
       language = LanguageHelper.Language;
    });
    print(language);
  }


  @override
  void initState() {
    // TODO: implement initState
    super.initState();
    read();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body:Container(
        child:
          Center(
            child: Column(
              mainAxisAlignment: MainAxisAlignment.center,
              crossAxisAlignment: CrossAxisAlignment.center,
              children: [


                // Text(
                //   language.toString(),
                //   style: TextStyle(
                //     color: Colors.red
                //   ),
                // ),

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

              ],
            ),
          ),
      ) ,
    );



  }
}
