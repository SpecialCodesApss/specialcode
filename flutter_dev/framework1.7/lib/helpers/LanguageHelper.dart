import 'package:flutter/material.dart';
import 'package:shared_preferences/shared_preferences.dart';
// import 'flutter_restart.dart';
import 'package:flutter_app_restart/flutter_app_restart.dart';
// import 'package:restart_app/restart_app.dart';

String? Language;

initialize() async {
  // final prefs = await SharedPreferences.getInstance();
  // var current_lang = prefs.getString('Lang');
  SharedPreferences prefs = await SharedPreferences.getInstance();
  var current_lang = prefs.getString('Lang');
  if (current_lang == "en") {
    Language = "en";
  } else if (current_lang == "ar") {
    Language = "ar";
  }
  else{
    Language = "ar";
  }
  // return Language;
}

_save_ar(context) async {
  SharedPreferences prefs = await SharedPreferences.getInstance();
  prefs.setString("Lang", "ar");
  Language = "ar";
  FlutterRestart.restartApp();
  // final prefs = await SharedPreferences.getInstance();
  // prefs.setString("Lang", "ar");
  // Language = "ar";
  // await FlutterRestart.restartApp();
  // FlutterRestart.restartApp();
  // RestartWidget.of(context).restartApp();
}

_save_en(context) async {
  SharedPreferences prefs = await SharedPreferences.getInstance();
  prefs.setString("Lang", "en");
  Language = "en";
  FlutterRestart.restartApp();
  // final prefs = await SharedPreferences.getInstance();
  // final key = 'Lang';
  // final value = 'en';
  // prefs.setString(key, value);
  // Language = value;
  // await FlutterRestart.restartApp();
  // RestartWidget.of(context).restartApp();
}

onLocaleChange(context,lang) {
  if (lang == "ar") {
    _save_ar(context);
  }
  else if (lang == "en") {
    _save_en(context);
  }
}

getCurrentLanguage() async {
  final prefs = await SharedPreferences.getInstance();
  final key = 'Lang';
  var current_lang = prefs.getString(key);
  if (current_lang == "en") {
    Language = "en";
  } else {
    Language = "ar";
  }
  return Language;
}
