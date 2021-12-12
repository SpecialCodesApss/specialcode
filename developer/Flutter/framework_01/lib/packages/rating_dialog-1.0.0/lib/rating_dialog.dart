library rating_dialog;

import 'package:flutter/material.dart';
import 'package:framework_01_6/helpers/LanguageHelper.dart' as LanguageHelper;
import '../../../lang/ar/app.dart' as messages_ar;
import '../../../lang/en/app.dart' as messages_en;

class _RatingDialogState extends State<RatingDialog> {
  int _rating = 0;

  final TextEditingController _commentController = new TextEditingController();
  var language = LanguageHelper.Language;

  List<Widget> _buildStarRatingButtons() {
    List<Widget> buttons = [];

    for (int rateValue = 1; rateValue <= 5; rateValue++) {
      final starRatingButton = IconButton(
          icon: Icon(_rating >= rateValue ? Icons.star : Icons.star_border,
              color: widget.accentColor, size: 35),
          onPressed: () {
            setState(() {
              _rating = rateValue;
            });
          });
      buttons.add(starRatingButton);
    }

    return buttons;
  }

  @override
  Widget build(BuildContext context) {
    final String commentText =
        _rating >= 4 ? widget.positiveComment : widget.negativeComment;
    // final Color commentColor = _rating >= 4 ? Colors.green[600] : Colors.red;

    return AlertDialog(
      contentPadding: EdgeInsets.all(20),
      shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(25)),
      content: Column(
        mainAxisSize: MainAxisSize.min,
        children: <Widget>[
          widget.icon,
          const SizedBox(height: 15),
          Text(widget.title,
              style:
                  const TextStyle(fontSize: 20, fontWeight: FontWeight.bold)),
          const SizedBox(height: 10),
          Text(
            widget.description,
            textAlign: TextAlign.center,
          ),
          Row(
            mainAxisAlignment: MainAxisAlignment.center,
            children: _buildStarRatingButtons(),
          ),
          Visibility(
            visible: _rating > 0,
            child: TextField(
              controller: _commentController,
              style: Theme.of(context).textTheme.body1,
              keyboardType: TextInputType.text,
              decoration: InputDecoration(
                // icon: Icon(Icons.arrow_left),
                hintText: language =="en" ? messages_en.getTranslation("comment_placholder") : messages_ar.getTranslation("comment_placholder"),
                labelText:language =="en" ? messages_en.getTranslation("comment") : messages_ar.getTranslation("comment"),
              ),
            ),
          ),
          Visibility(
            visible: _rating > 0,
            child: Column(
              children: <Widget>[
                const Divider(),
                FlatButton(
                  child: Text(
                    widget.submitButton,
                    style: TextStyle(
                        fontWeight: FontWeight.bold,
                        color: widget.accentColor,
                        fontSize: 18),
                  ),
                  onPressed: () {
                    Navigator.pop(context);
                    widget.onSubmitPressed(_rating , _commentController.text.trim());
                  },
                ),
                Visibility(
                  visible: commentText.isNotEmpty,
                  child: Column(
                    children: <Widget>[
                      SizedBox(height: 5),
                      Text(
                        commentText,
                        textAlign: TextAlign.center,
                      )
                    ],
                  ),
                ),
                Visibility(
                  visible:
                      _rating <= 3 && widget.alternativeButton.isNotEmpty,
                  child: FlatButton(
                    child: Text(
                      widget.alternativeButton,
                      style: TextStyle(
                          color: widget.accentColor,
                          fontWeight: FontWeight.bold),
                    ),
                    onPressed: () {
                      Navigator.pop(context);
                      widget.onAlternativePressed();
                    },
                  ),
                ),
              ],
            ),
          ),
        ],
      ),
    );
  }
}

class RatingDialog extends StatefulWidget {
  final String title;
  final String description;
  final String submitButton;
  final String alternativeButton;
  final String positiveComment;
  final String negativeComment;
  final Widget icon;
  final Color accentColor;
  final onSubmitPressed;
  final VoidCallback onAlternativePressed;

  RatingDialog(
      {@required this.icon,
      @required this.title,
      @required this.description,
      @required this.onSubmitPressed,
      @required this.submitButton,
      this.accentColor = Colors.blue,
      this.alternativeButton = "",
      this.positiveComment = "",
      this.negativeComment = "",
      this.onAlternativePressed});

  @override
  _RatingDialogState createState() => new _RatingDialogState();
}
