import 'dart:convert';
import 'package:http/http.dart' as http;
import '../helpers/sharedPreferencesHelper.dart' as sharedPreferencesHelper;
import '../helpers/LanguageHelper.dart' as LanguageHelper;

class UserController {
  String serverUrl = "http://192.168.0.101/framework";
  var status;
  var message;
  var data;
  var profileData;
  var token = sharedPreferencesHelper.token;
  var language = LanguageHelper.Language;

  _init() async{
    await LanguageHelper.initialize();
    await sharedPreferencesHelper.initialize_token();
      language = LanguageHelper.Language;
      token = sharedPreferencesHelper.token;
  }

  profile(context) async {
    //basic variables
    await _init();
    String request_URL = serverUrl + "/api/user/profile";
    final response = await http.get(request_URL, headers: {
      'Accept': 'application/json',
      'Authorization': 'Bearer $token',
      'language': language,
    });
    data = json.decode(response.body);
    status = data["success"];
    message = data["message"];
  }

  update(String fullname, String email, String mobile, context) async {
    //basic variables
    String request_URL = serverUrl + "/api/users";
    final response = await http.put(request_URL, headers: {
      'Accept': 'application/json',
      'Authorization': 'Bearer $token',
      'language': language,
    }, body: {
      'fullname': '$fullname',
      'email': '$email',
      'mobile': '$mobile',
    });

    data = json.decode(response.body);
    status = data["success"];
    message = data["message"];

    if (data["success"] == true) {
      String request_URL2 = serverUrl + "/api/profile";
      final response_2 = await http.post(request_URL2,
          headers: {'Accept': 'application/json', 'Authorization': 'Bearer $token', 'language': language});
      profileData = json.decode(response_2.body);
      if (profileData["success"] == true) {
        _save(profileData["data"]["fullname"], profileData["data"]["email"], profileData["data"]["mobile"],
            profileData["data"]["email_verified_at"], profileData["data"]["mobile_verified_at"]);
      }
    }
  }

  ChangePassword(String old_password, String password, String password_confirmation, context) async {
    //basic variables
    String request_URL = serverUrl + "/api/ChangePassword";
    final response = await http.post(request_URL, headers: {
      'Accept': 'application/json',
      'Authorization': 'Bearer $token',
      'language': language,
    }, body: {
      'old_password': '$old_password',
      'password': '$password',
      'password_confirmation': '$password_confirmation',
    });
    var data = json.decode(response.body);
    status = data["success"];
    message = data["message"];
  }

  _save(String username, String email, String mobile, String email_verified_at, String mobile_verified_at) async {
    sharedPreferencesHelper.saveLoginedUserData(token, username, email, mobile, email_verified_at, mobile_verified_at);
  }

}
