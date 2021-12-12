import 'package:flutter/material.dart';
import 'package:fluttertoast/fluttertoast.dart';
//import '../packages/fluttertoast/lib/fluttertoast.dart';
import '../packages/hexcolor/hexcolor.dart';


  ShowToast(String Type , String Msg){
    if(Type == 'success'){
      Fluttertoast.showToast(
          msg: Msg,
          toastLength: Toast.LENGTH_SHORT,
          gravity: ToastGravity.CENTER,
//          timeInSecForIosWeb: 1,
          backgroundColor: Hexcolor('#51a351'),
          textColor: Colors.white,
          fontSize: 16.0
      );
    }
    else if(Type == 'warning'){
      Fluttertoast.showToast(
          msg: Msg,
          toastLength: Toast.LENGTH_SHORT,
          gravity: ToastGravity.CENTER,
//          timeInSecForIosWeb: 1,
          backgroundColor:Hexcolor('#f89406'),
          textColor: Colors.white,
          fontSize: 16.0
      );
    }
    else if(Type == 'error'){
      Fluttertoast.showToast(
          msg: Msg,
          toastLength: Toast.LENGTH_SHORT,
          gravity: ToastGravity.CENTER,
//          timeInSecForIosWeb: 1,
          backgroundColor: Hexcolor('#bd362f'),
          textColor: Colors.white,
          fontSize: 16.0
      );
    }
    else if(Type == 'info'){
      Fluttertoast.showToast(
          msg: Msg,
          toastLength: Toast.LENGTH_SHORT,
          gravity: ToastGravity.CENTER,
//          timeInSecForIosWeb: 1,
          backgroundColor: Hexcolor('#2f96b4'),
          textColor: Colors.white,
          fontSize: 16.0
      );
    }

  }

