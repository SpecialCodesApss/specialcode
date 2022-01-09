import 'dart:convert';
import 'dart:io';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import '../helpers/sharedPreferencesHelper.dart' as sharedPreferencesHelper;
import '../helpers/sharedPreferencesHelper.dart';
import '../helpers/LanguageHelper.dart';
import '../helpers/LanguageHelper.dart' as LanguageHelper;
import 'package:path/path.dart';
import 'package:async/async.dart';
class RegisterController {
  String serverUrl = "http://192.168.1.5/framework1.7";
  var status;
  var token;
  var message;
  var data;

  var language = LanguageHelper.Language;

  RegisterData(String fullname, String email, String mobile, String gender, String password, String c_password,
  File profile_image,[String type = "user"]) async {
    Uri request_URL = Uri.parse(serverUrl + "/api/register");
    var request = new http.MultipartRequest("POST", request_URL);

    if(profile_image != null){
      var profile_imagestream = new http.ByteStream(DelegatingStream.typed(profile_image.openRead()));
      var profile_imagelength = await profile_image.length();
      var multipartFile = new http.MultipartFile('profile_image', profile_imagestream, profile_imagelength,
          filename: basename(profile_image.path));
      request.files.add(multipartFile);
    }

    request.fields["fullname"] = fullname;
    request.fields["email"] = email;
    request.fields["mobile"] = mobile;
    request.fields["gender"] = gender;
    request.fields["type_id"] = "1";
    request.fields["password"] = password;
    request.fields["c_password"] = c_password;

    request.headers["Accept"] = 'application/json';
    request.headers["Authorization"] = 'Bearer $token';
    request.headers["language"] = (language)!;

    var streamedResponse = await request.send();
    var response = await http.Response.fromStream(streamedResponse);

    data = json.decode(response.body);
    status = data["success"];
    message = data["message"];

    if (data["success"] == true) {
      _save(data["data"]["token"], data["data"]["fullname"], data["data"]["email"], data["data"]["mobile"] ,
          '', '');
    }

    // final response = await http.post(request_URL, headers: {
    //   'Accept': 'application/json',
    //   'language': (language)!
    // }, body: {
    //   "fullname": "$fullname",
    //   "email": "$email",
    //   "mobile": "$mobile",
    //   "gender": "$gender",
    //   "type": "$type",
    //   "password": "$password",
    //   "c_password": "$c_password",
    // });
    //
    // data = json.decode(response.body);
    // status = data["success"];
    // message = data["message"];


  }

  _save(String token, String username, String email, String mobile, [String email_verified_at='',
      String mobile_verified_at='']) async {
    saveLoginedUserData(token, username, email, mobile, email_verified_at, mobile_verified_at);
  }

  read() async {
    token = getCurrentUserToken();
  }
}
