import 'package:flutter/material.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter/widgets.dart';
import '../helpers/LanguageHelper.dart' as LanguageHelper;
import '../lang/ar/app.dart' as messages_ar;
import '../lang/en/app.dart' as messages_en;

var language = LanguageHelper.Language;

showYesNoDialogFunction(String TextMsg,context) async {
  String dialogResponse='' ;
  await showDialog(
    context: context,
    builder: (BuildContext context) {
      return AlertDialog(
        title: Text('Alert Dialog Title Text.'),
        content: Text(TextMsg),
        actions: <Widget>[
          FlatButton(
            child: Text(language == "en" ? messages_en.getTranslation("yes") : messages_ar.getTranslation("yes")),
            onPressed: () {
              //Put your code here which you want to execute on Yes button click.
              Navigator.of(context).pop();
              dialogResponse = "YES";
            },
          ),

          FlatButton(
            child: Text(language == "en" ? messages_en.getTranslation("no") : messages_ar.getTranslation("no")),
            onPressed: () {
              //Put your code here which you want to execute on No button click.
              Navigator.of(context).pop();
              dialogResponse = "NO";
            },
          ),

          FlatButton(
            child: Text(language == "en" ? messages_en.getTranslation("cancel") : messages_ar.getTranslation("cancel")),
            onPressed: () {
              //Put your code here which you want to execute on Cancel button click.
              Navigator.of(context).pop();
              dialogResponse = "CANCEL";
            },
          ),
        ],
      );
    },
  );

  return dialogResponse;

}

