import 'package:flutter/material.dart';
import 'package:framework_01_6/Controllers/SettingController.dart';
import 'package:framework_01_6/helpers/DialogHelper.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'flutter_restart.dart';

String current_app_version = "1.5";
bool there_is_new_version = false;

getAppVersionSetting() async{
  var data = await SettingController().getByName("last_app_version");

  if(data["success"]== true){
    var last_app_version = data["data"]["setting_value"];

    if(last_app_version != current_app_version){
      there_is_new_version = true;
    }
  }

  return there_is_new_version;

}