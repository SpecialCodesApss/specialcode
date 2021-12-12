
import 'package:flutter/material.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter/widgets.dart';

void showDialogFunction(String TextMsg,context){

  showDialog(
      context:context,
      builder: (BuildContext context) {
        return AlertDialog(
          content: Form(
            child: Column(
              mainAxisSize: MainAxisSize.min,
              children: <Widget>[
                Padding(
                  padding: EdgeInsets.all(8.0),
                  child: Text(
                      TextMsg
                  ),
                ),
                Padding(
                  padding: const EdgeInsets.all(8.0),
                  child: RaisedButton(
                    child: Text(
                      "موافق",
                      style: Theme.of(context).textTheme.button,
                    ),

                    onPressed: () {
                      //close alert dialog
                      Navigator.of(context, rootNavigator: true).pop('dialog');
                    },
                  ),
                )
              ],
            ),
          ),
        );
      });
}

