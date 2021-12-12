import 'dart:convert';
import 'package:http/http.dart' as http;
import '../helpers/sharedPreferencesHelper.dart' as sharedPreferencesHelper;
import '../helpers/sharedPreferencesHelper.dart';
import '../helpers/LanguageHelper.dart';
import '../helpers/LanguageHelper.dart' as LanguageHelper;

class NotificationController {
  String serverUrl = "http://192.168.0.101/framework";
  var status;
  var message;
  var data;
  List listdata;
  var profileData;

  var token = sharedPreferencesHelper.token;
  var language = LanguageHelper.Language;

  Future<String> index() async {
    String request_URL = serverUrl + "/api/notifications";
    final response = await http.get(request_URL, headers: {
      'Accept': 'application/json',
      'Authorization': 'Bearer $token',
      'language': language,
    });

    data = json.decode(response.body);
    status = data["success"];
    message = data["message"];
    listdata = data["data"];
  }

  Future<String> listUnread() async {
    String request_URL = serverUrl + "/api/notifications/unread";
    final response = await http.get(request_URL, headers: {
      'Accept': 'application/json',
      'Authorization': 'Bearer $token',
      'language': language,
    });

    data = json.decode(response.body);
    status = data["success"];
    message = data["message"];
    listdata = data["data"];
  }

  update() async {
    //basic variables
    String request_URL = serverUrl + "/api/notifications";
    final response = await http.put(request_URL, headers: {
      'Accept': 'application/json',
      'Authorization': 'Bearer $token',
      'language': language,
    });
    data = json.decode(response.body);
    status = data["success"];
    message = data["message"];
  }

  delete(int notificationId) async {
    //basic variables
    String request_URL = serverUrl + "/api/notifications/$notificationId";
    final response = await http.delete(request_URL, headers: {
      'Accept': 'application/json',
      'Authorization': 'Bearer $token',
      'language': language,
    });
    data = json.decode(response.body);
    status = data["success"];
    message = data["message"];
  }
}
