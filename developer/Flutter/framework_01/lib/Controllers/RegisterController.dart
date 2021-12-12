import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import '../helpers/sharedPreferencesHelper.dart' as sharedPreferencesHelper;
import '../helpers/sharedPreferencesHelper.dart';
import '../helpers/LanguageHelper.dart';
import '../helpers/LanguageHelper.dart' as LanguageHelper;

class RegisterController {
  String serverUrl = "http://192.168.0.101/framework";
  var status;
  var token;
  var message;
  var data;

  var language = LanguageHelper.Language;

  RegisterData(String fullname, String email, String mobile, String gender, String password, String c_password,
      [String type = "user"]) async {
    String request_URL = serverUrl + "/api/register";

    final response = await http.post(request_URL, headers: {
      'Accept': 'application/json',
      'language': language,
    }, body: {
      "fullname": "$fullname",
      "email": "$email",
      "mobile": "$mobile",
      "gender": "$gender",
      "type": "$type",
      "password": "$password",
      "c_password": "$c_password",
    });

    data = json.decode(response.body);
    status = data["success"];
    message = data["message"];

    if (data["success"] == true) {
      _save(data["data"]["token"], data["data"]["fullname"], data["data"]["email"], data["data"]["mobile"] ,
          data["data"]["email_verified_at"], data["data"]["mobile_verified_at"]);
    }
  }

  _save(String token, String username, String email, String mobile, String email_verified_at,
      String mobile_verified_at) async {
    saveLoginedUserData(token, username, email, mobile, email_verified_at, mobile_verified_at);
  }

  read() async {
    token = getCurrentUserToken();
  }
}
