import 'package:flutter/material.dart';
import 'package:shared_preferences/shared_preferences.dart';
// import 'flutter_restart.dart';
import 'package:flutter_app_restart/flutter_app_restart.dart';

String? Language;

initialize() async {
  final prefs = await SharedPreferences.getInstance();
  final key = 'Lang';
  var current_lang = prefs.getString(key);
  if (current_lang == "en") {
    Language = "en";
  } else {
    Language = "ar";
  }
}

_save_ar(context) async {
  final prefs = await SharedPreferences.getInstance();
  final key = 'Lang';
  final value = 'ar';
  prefs.setString(key, value);
  Language = value;
  // RestartWidget.of(context).restartApp();
}

_save_en(context) async {
  final prefs = await SharedPreferences.getInstance();
  final key = 'Lang';
  final value = 'en';
  prefs.setString(key, value);
  Language = value;
  // RestartWidget.of(context).restartApp();
}

onLocaleChange(context) {
  if (Language == "en") {
    _save_ar(context);
  } else {
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
