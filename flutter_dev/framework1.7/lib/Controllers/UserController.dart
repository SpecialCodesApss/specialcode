import 'dart:convert';
import 'dart:io';
import 'package:http/http.dart' as http;
import '../helpers/sharedPreferencesHelper.dart' as sharedPreferencesHelper;
import '../helpers/LanguageHelper.dart' as LanguageHelper;
import 'package:path/path.dart';
import 'package:async/async.dart';

class UserController {
  String serverUrl = "http://192.168.1.4/framework1.7";
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
    Uri request_URL = Uri.parse(serverUrl + "/api/user/profile");
    final response = await http.get(request_URL, headers: {
      'Accept': 'application/json',
      'Authorization': 'Bearer $token',
      'language': (language)!
    });
    data = json.decode(response.body);
    status = data["success"];
    message = data["message"];
  }

  update(String fullname, String email, String mobile,context,File profile_image) async {
    //basic variables
    //basic variables
    await _init();
    Uri request_URL = Uri.parse(serverUrl + "/api/UpdateProfile");
    var uri = request_URL;
    var request = new http.MultipartRequest("POST", uri);

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

    request.headers["Accept"] = 'application/json';
    request.headers["Authorization"] = 'Bearer $token';
    request.headers["language"] = (language)!;

    var streamedResponse = await request.send();
    var response = await http.Response.fromStream(streamedResponse);

    data = json.decode(response.body);

    print("dataaaaaaaaaa");
    print(data);

    status = data["success"];
    message = data["message"];

    if (data["success"] == true) {
      Uri request_URL2 = Uri.parse(serverUrl + "/api/users");
      final response_2 = await http.post(request_URL2,
          headers: {'Accept': 'application/json', 'Authorization': 'Bearer $token', 'language': (language)!});
      profileData = json.decode(response_2.body);
      if (profileData["success"] == true) {
        _save(profileData["data"]["fullname"], profileData["data"]["email"], profileData["data"]["mobile"],
            profileData["data"]["email_verified_at"], profileData["data"]["mobile_verified_at"]);
      }
    }
  }

  ChangePassword(String old_password, String password, String password_confirmation, context) async {
    //basic variables
    Uri request_URL = Uri.parse(serverUrl + "/api/ChangePassword");
    final response = await http.post(request_URL, headers: {
      'Accept': 'application/json',
      'Authorization': 'Bearer $token',
      'language': (language)!
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
    sharedPreferencesHelper.saveLoginedUserData((token)!, username, email, mobile, email_verified_at, mobile_verified_at);
  }

}
