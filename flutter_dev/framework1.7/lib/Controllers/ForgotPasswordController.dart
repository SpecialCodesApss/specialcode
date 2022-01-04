import 'dart:convert';
import 'package:http/http.dart' as http;
import '../helpers/LanguageHelper.dart' as LanguageHelper;
import '../helpers/sharedPreferencesHelper.dart' as sharedPreferencesHelper;

class ForgotPasswordController {
  String serverUrl = "http://192.168.0.101/framework";
  var status;
  var message;
  var data;
  var mobile;
  var email;

  var token = sharedPreferencesHelper.token;
  var language = LanguageHelper.Language;

  SendMobileResetCode(String mobile, context) async {
    //basic variables
    Uri request_URL = Uri.parse(serverUrl + "/api/SendMobileResetCode/" + mobile);
    final response = await http.get(request_URL, headers: {
      'Accept': 'application/json',
      'language': (language)!,
    });

    var data = json.decode(response.body);
    status = data["success"];
    message = data["message"];
  }

  SendEmailResetCode(String email, context) async {
    //basic variables
    Uri request_URL = Uri.parse(serverUrl + "/api/SendEmailResetCode/" + email);
    final response = await http.get(request_URL, headers: {
      'Accept': 'application/json',
      'language': (language)!,
    });

    var data = json.decode(response.body);
    status = data["success"];
    message = data["message"];
  }

  CheckResetCode(String email, String mobile, String Resetcode, context) async {
    //basic variables
    Uri request_URL = Uri.parse(serverUrl + "/api/CheckResetCode");
    if (mobile.isNotEmpty) {
      final response = await http.post(request_URL, headers: {
        'Accept': 'application/json',
        'language': (language)!,
      }, body: {
        'mobile': '$mobile',
        'token': '$Resetcode',
      });
      var data = json.decode(response.body);
      status = data["success"];
      message = data["message"];
    } else {
      final response = await http.post(request_URL, headers: {
        'Accept': 'application/json',
        'language': (language)!,
      }, body: {
        'email': '$email',
        'token': '$Resetcode',
      });
      var data = json.decode(response.body);
      status = data["success"];
      message = data["message"];
    }
  }

  ResetPassword(
      String email, String mobile, String Resetcode, String password, String password_confirmation, context) async {
    //basic variables
    Uri request_URL = Uri.parse(serverUrl + "/api/ResetPassword");
    if (mobile.isNotEmpty) {
      final response = await http.post(request_URL, headers: {
        'Accept': 'application/json',
        'language': (language)!,
      }, body: {
        'mobile': '$mobile',
        'token': '$Resetcode',
        'password': '$password',
        'password_confirmation': '$password_confirmation',
      });
      var data = json.decode(response.body);
      status = data["success"];
      message = data["message"];
    } else {
      final response = await http.post(request_URL, headers: {
        'Accept': 'application/json',
        'language': (language)!,
      }, body: {
        'email': '$email',
        'token': '$Resetcode',
        'password': '$password',
        'password_confirmation': '$password_confirmation',
      });
      var data = json.decode(response.body);
      status = data["success"];
      message = data["message"];
    }
  }
}
