import 'package:flutter/material.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter/widgets.dart';
import 'SizeConfig.dart';
import '../packages/getwidget/lib/getwidget.dart';

void showLoaderDialogFunction(context){
  SizeConfig().init(context); // for media query
  var screenWidthRatio = 10;
  var screenHightRatio = 35;
  if(SizeConfig.orientation == Orientation.landscape){
    screenWidthRatio = 10 ;
    screenHightRatio = 55 ;
  }
  else{
    screenWidthRatio = 5 ;
    screenHightRatio = 35 ;
  }

  showDialog(
      context:context,
      barrierDismissible: false,
      builder: (BuildContext context) {
        return GFLoader();
      });
}

void hideLoaderDialogFunction(context){
  Navigator.of(context, rootNavigator: true).pop('dialog');
}
