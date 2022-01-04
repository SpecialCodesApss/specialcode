import 'package:flutter/material.dart';
import 'package:rating_dialog/rating_dialog.dart';
import 'package:flutter_dev/Views/Pages/Contactus.dart';
import 'package:flutter_dev/helpers/LanguageHelper.dart' as LanguageHelper;
import '../lang/ar/app.dart' as messages_ar;
import '../lang/en/app.dart' as messages_en;


var language = LanguageHelper.Language;

 openRatingDialog(context,title,description,submitButton) async {
  int? rating ;
  String? comment ;
  var response = new Map();

  await showDialog(
      context: context,
      barrierDismissible: true, // set to false if you want to force a rating
      builder: (context) {

        return RatingDialog(
          initialRating: 1.0,
          // your app's name?
          title: Text(
            'Rating Dialog',
            textAlign: TextAlign.center,
            style: const TextStyle(
              fontSize: 25,
              fontWeight: FontWeight.bold,
            ),
          ),
          // encourage your user to leave a high rating?
          message: Text(
            'Tap a star to set your rating. Add more description here if you want.',
            textAlign: TextAlign.center,
            style: const TextStyle(fontSize: 15),
          ),
          // your app's logo?
          image: const FlutterLogo(size: 100),
          submitButtonText: 'Submit',
          commentHint: 'Set your custom comment hint',
          onCancelled: () => print('cancelled'),
          onSubmitted: (response) {
            print('rating: ${response.rating}, comment: ${response.comment}');

            // TODO: add your own logic
            if (response.rating < 3.0) {
              // send their comments to your email or anywhere you wish
              // ask the user to contact you instead of leaving a bad review
            } else {
              // _rateAndReviewApp();
            }
          },
        );


        // return RatingDialog(
        //   icon: Icon(Icons.star_half), // set your own image/icon widget
        //   title: title,
        //   description:description,
        //   submitButton: submitButton,
        //   alternativeButton: language =="en" ? messages_en.getTranslation("Rating_alternativeButton") : messages_ar.getTranslation
        //     ("Rating_alternativeButton"), // optional
        //   positiveComment: language =="en" ? messages_en.getTranslation("Rating_positiveComment") : messages_ar.getTranslation
        //     ("Rating_positiveComment"), // optional
        //   negativeComment: language =="en" ? messages_en.getTranslation("Rating_negativeComment") : messages_ar.getTranslation
        //     ("Rating_negativeComment"), // optional
        //   accentColor: Colors.red, // optional
        //   onSubmitPressed: (int _rating , String _comment) {
        //     rating  = _rating;
        //     comment  = _comment;
        //     // onSubmitPressed;
        //     // print("onSubmitPressed: rating = $rating  comment  = $comment " );
        //     // // TODO: open the app's page on Google Play / Apple App Store
        //   },
        //   onAlternativePressed: () {
        //     Navigator.push(
        //         context,
        //         MaterialPageRoute(builder: (context) => Contactus())
        //     );
        //     // print("onAlternativePressed: do something");
        //     // TODO: maybe you want the user to contact you instead of rating a bad review
        //   }, onSubmitted: (RatingDialogResponse ) {  },
        // );
        //

      });


  response["rating"] = rating;
  response["comment"] = comment;

  return response;
}
