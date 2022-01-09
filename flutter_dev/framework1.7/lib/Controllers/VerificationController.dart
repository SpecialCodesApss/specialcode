import 'dart:convert';
import 'package:http/http.dart' as http;
import '../helpers/LanguageHelper.dart' as LanguageHelper;
import '../helpers/sharedPreferencesHelper.dart' as sharedPreferencesHelper;

class VerificationController {
  String serverUrl =  "http://192.168.1.5/framework1.7";
  var status;
  var message;
  var data;
  var mobile;
  var email;
  var language;
  var token;

  _init() async{
    await LanguageHelper.initialize();
    await sharedPreferencesHelper.initialize_token();
    language = LanguageHelper.Language;
    token = sharedPreferencesHelper.token;
  }



  VerifyCode(String verifycode, context) async {
    //basic variables
    await _init();
    Uri request_URL = Uri.parse(serverUrl + "/api/VerifyCode");
    var verify_type = 'mobile';
//    var token = await sharedPreferencesHelper.token;
//    var language = await LanguageHelper.Language;

    final response = await http.post(request_URL, headers: {
      'Accept': 'application/json',
      'Authorization': 'Bearer $token',
      'language': (language)!
    }, body: {
      "token": "$verifycode",
      "verify_type": "$verify_type",
    });

    var data = json.decode(response.body);
    status = data["success"];
    message = data["message"];
  }

  SendMobVerifyCode(context) async {
    //basic variables
    await _init();
    Uri request_URL = Uri.parse(serverUrl + "/api/SendMobVerifyCode");
//    var token = await sharedPreferencesHelper.token;
//    print("token $token");
//    var language = await LanguageHelper.Language;
    print("token $token");

    final response = await http.post(request_URL, headers: {
      'Accept': 'application/json',
      'Authorization': 'Bearer $token',
      'language': (language)!
    }, body: {});

    var data = json.decode(response.body);
    status = data["success"];
    message = data["message"];
  }

  SendEmailVerifyCode(context) async {
    //basic variables
    await _init();
    Uri request_URL = Uri.parse(serverUrl + "/api/SendEmailVerifyCode");
//    var token = await sharedPreferencesHelper.token;
//    var language = await LanguageHelper.Language;
    final response = await http.post(request_URL, headers: {
      'Accept': 'application/json',
      'Authorization': 'Bearer $token',
      'language': (language)!
    }, body: {});

    var data = json.decode(response.body);
    status = data["success"];
    message = data["message"];
  }

  UpdateVerMobile(String mobile, context) async {
    //basic variables
    Uri request_URL = Uri.parse(serverUrl + "/api/UpdateVerMobile");
    var token = await sharedPreferencesHelper.token;
    var language = await LanguageHelper.Language;
    final response = await http.post(request_URL, headers: {
      'Accept': 'application/json',
      'Authorization': 'Bearer $token',
      'language': (language)!
    }, body: {
      'mobile': '$mobile',
    });

    data = json.decode(response.body);
    status = data["success"];
    message = data["message"];
    mobile = mobile;
  }

  UpdateVerEmail(String email, context) async {
    //basic variables
    Uri request_URL = Uri.parse(serverUrl + "/api/UpdateVerEmail");
    var token = await sharedPreferencesHelper.token;
    var language = await LanguageHelper.Language;
    final response = await http.post(request_URL, headers: {
      'Accept': 'application/json',
      'Authorization': 'Bearer $token',
      'language': (language)!
    }, body: {
      'email': '$email',
    });

    data = json.decode(response.body);
    status = data["success"];
    message = data["message"];
  }
}
