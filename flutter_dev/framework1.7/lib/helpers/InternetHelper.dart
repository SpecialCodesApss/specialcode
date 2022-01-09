
import 'dart:async';

import 'package:connectivity/connectivity.dart';
import 'package:flutter/material.dart';

import 'DialogHelper.dart';
import 'LoaderDialog.dart';


class InternetHelper {

  var is_not_connected ;
  var connected_type ;


  chkInternetConnection(context) async {
    var connectivityResult = await (Connectivity().checkConnectivity());
    if (connectivityResult == ConnectivityResult.mobile) {
      // I am connected to a mobile network.
      is_not_connected = false;
      connected_type = "mobile";
    } else if (connectivityResult == ConnectivityResult.wifi) {
      is_not_connected = false;
      connected_type = "wifi";
    }
    else {
      is_not_connected = true;
    }
    return is_not_connected;
  }



 getInternetWidget(context,checkInternetConnection){
  return Center(
        child: Container(
          child:Column(
            mainAxisAlignment: MainAxisAlignment.center,
            crossAxisAlignment: CrossAxisAlignment.center,
            children: [
              Image.asset('assets/images/internet_disabled.png',
                width: 250,
              ),
              SizedBox(height: 15.0,),
              Text(
                "Please Check your internet Connection",
              ),
              SizedBox(height: 10.0,),
              ElevatedButton(
                onPressed: () async {
                  showLoaderDialogFunction(context);
                  await checkInternetConnection();
                  Timer(Duration(milliseconds:300), (){
                    hideLoaderDialogFunction(context);
                  });
                },
                child: Text(
                    'refresh page'
                ),
              )
            ],
          ) ,
        ),
      );
}







}
