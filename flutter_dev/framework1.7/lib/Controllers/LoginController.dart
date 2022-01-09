//login api
import 'dart:convert';
import 'package:http/http.dart' as http;
import '../helpers/sharedPreferencesHelper.dart';
import '../helpers/LanguageHelper.dart';
import '../helpers/LanguageHelper.dart' as LanguageHelper;

class LoginController {
  String serverUrl = "http://192.168.1.5/framework1.7";
  var status;
  var token;
  var message;


  loginData(String email, String password, context) async {
   var language = await LanguageHelper.Language;
    Uri request_URL = Uri.parse(serverUrl + "/oauth/token");
    final response = await http.post(request_URL, headers: {
      'Accept': 'application/json',
      'language': (language)!
    }, body: {
      "username": "$email",
      "password": "$password",
      "grant_type": "password",
      "client_id": "2",
      "client_secret": "A8Z0ph2LBC79EIjFicdxySxiMNGn2FbBNFag1wOw"
    });

    var data = json.decode(response.body);

    status = data["success"];
    message = data["message"];

    if (data["success"] == true) {
      _save(data["access_token"], data["user_info"]["fullname"], data["user_info"]["email"],
          data["user_info"]["mobile"], data["user_info"]["fullname"], data["user_info"]["fullname"]);
    }
  }

  _save(String token, String username, String email, String mobile, String email_verified_at,
      String mobile_verified_at) async {
    saveLoginedUserData(token, username, email, mobile, email_verified_at, mobile_verified_at);
  }

  read() async {
    token = getCurrentUserToken() as String?;
  }
}
