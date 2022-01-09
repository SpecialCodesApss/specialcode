import 'dart:convert';
import 'package:http/http.dart' as http;
import '../helpers/sharedPreferencesHelper.dart' as sharedPreferencesHelper;
import '../helpers/LanguageHelper.dart' as LanguageHelper;

class NotificationController {
  String serverUrl = "http://192.168.1.5/framework1.7";
  var status;
  var message;
  var data;
  var listdata ;
  var profileData;

  var token = sharedPreferencesHelper.token;
  var language = LanguageHelper.Language;

   index() async {
    Uri request_URL = Uri.parse(serverUrl + "/api/notifications");
    final response = await http.get(request_URL, headers: {
      'Accept': 'application/json',
      'Authorization': 'Bearer $token',
      'language': (language)!
    });

    data = json.decode(response.body);
    status = data["success"];
    message = data["message"];
    listdata = data["data"];
  }

  listUnread() async {
    Uri request_URL = Uri.parse(serverUrl + "/api/notifications/unread");
    final response = await http.get(request_URL, headers: {
      'Accept': 'application/json',
      'Authorization': 'Bearer $token',
      'language': (language)!
    });

    data = json.decode(response.body);
    status = data["success"];
    message = data["message"];
    listdata = data["data"];
  }

  update() async {
    //basic variables
    Uri request_URL = Uri.parse(serverUrl + "/api/notifications");
    final response = await http.put(request_URL, headers: {
      'Accept': 'application/json',
      'Authorization': 'Bearer $token',
      'language': (language)!
    });
    data = json.decode(response.body);
    status = data["success"];
    message = data["message"];
  }

  delete(int notificationId) async {
    //basic variables
    Uri request_URL = Uri.parse(serverUrl + "/api/notifications/$notificationId");
    final response = await http.delete(request_URL, headers: {
      'Accept': 'application/json',
      'Authorization': 'Bearer $token',
      'language': (language)!
    });
    data = json.decode(response.body);
    status = data["success"];
    message = data["message"];
  }
}
