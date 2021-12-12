import 'package:flutter/material.dart';
import 'package:framework_01_6/Views/Pages/Contactus.dart';
import 'package:framework_01_6/packages/rating_dialog-1.0.0/lib/rating_dialog.dart';
import 'package:framework_01_6/helpers/LanguageHelper.dart' as LanguageHelper;
import '../lang/ar/app.dart' as messages_ar;
import '../lang/en/app.dart' as messages_en;


var language = LanguageHelper.Language;

 openRatingDialog(context,title,description,submitButton) async {
  int rating ;
  String comment ;
  var response = new Map();

  await showDialog(
      context: context,
      barrierDismissible: true, // set to false if you want to force a rating
      builder: (context) {
        return RatingDialog(
          icon: Icon(Icons.star_half), // set your own image/icon widget
          title: title,
          description:description,
          submitButton: submitButton,
          alternativeButton: language =="en" ? messages_en.getTranslation("Rating_alternativeButton") : messages_ar.getTranslation
            ("Rating_alternativeButton"), // optional
          positiveComment: language =="en" ? messages_en.getTranslation("Rating_positiveComment") : messages_ar.getTranslation
            ("Rating_positiveComment"), // optional
          negativeComment: language =="en" ? messages_en.getTranslation("Rating_negativeComment") : messages_ar.getTranslation
            ("Rating_negativeComment"), // optional
          accentColor: Colors.red, // optional
          onSubmitPressed: (int _rating , String _comment) {
            rating  = _rating;
            comment  = _comment;
            // onSubmitPressed;
            // print("onSubmitPressed: rating = $rating  comment  = $comment " );
            // // TODO: open the app's page on Google Play / Apple App Store
          },
          onAlternativePressed: () {
            Navigator.push(
                context,
                MaterialPageRoute(builder: (context) => Contactus())
            );
            // print("onAlternativePressed: do something");
            // TODO: maybe you want the user to contact you instead of rating a bad review
          },
        );
      });


  response["rating"] = rating;
  response["comment"] = comment;

  return response;
}