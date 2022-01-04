import 'dart:convert';
import 'package:http/http.dart' as http;
import '../helpers/sharedPreferencesHelper.dart' as sharedPreferencesHelper;
import '../helpers/LanguageHelper.dart' as LanguageHelper;

class SettingController {
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

  getByGroup(String setting_group) async {
    //basic variables
    await _init();
    Uri request_URL = Uri.parse(serverUrl + "/api/settings/group/$setting_group");
    final response = await http.get(request_URL, headers: {
      'Accept': 'application/json',
      'Authorization': 'Bearer $token',
      'language': (language)!,
    });
    data = json.decode(response.body);
    status = data["success"];
    message = data["message"];

    print(data);

  }

  getByName(String setting_key) async {
    //basic variables
    await _init();
    Uri request_URL = Uri.parse(serverUrl + "/api/settings/name/$setting_key");
    final response = await http.get(request_URL, headers: {
      'Accept': 'application/json',
      'Authorization': 'Bearer $token',
      'language': (language)!,
    });
    data = json.decode(response.body);
    status = data["success"];
    message = data["message"];

    return data;
  }


  _save(String username, String email, String mobile, String email_verified_at, String mobile_verified_at) async {
    sharedPreferencesHelper.saveLoginedUserData((token)!, username, email, mobile, email_verified_at, mobile_verified_at);
  }

}
