import 'dart:convert';
import 'package:http/http.dart' as http;
import '../helpers/sharedPreferencesHelper.dart' as sharedPreferencesHelper;
import '../helpers/LanguageHelper.dart';
import '../helpers/LanguageHelper.dart' as LanguageHelper;
import '../helpers/sharedPreferencesHelper.dart';

class ViewPageController {
  String serverUrl = "http://192.168.0.101/framework";
  var status;
  var message;
  var data;

  var token = sharedPreferencesHelper.token;
  var language = LanguageHelper.Language;

  show(String key) async {
    //basic variables
    String request_URL = serverUrl + "/api/Pages/$key";
    final response = await http.get(request_URL, headers: {
      'Accept': 'application/json',
      'language': language,
    });
    data = json.decode(response.body);
    status = data["success"];
    message = data["message"];
  }
}
