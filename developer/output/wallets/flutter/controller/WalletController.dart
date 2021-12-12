import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:shared_preferences/shared_preferences.dart';

class WalletController {
  String serverUrl = "http://192.168.1.101/framework";
  var status;
  var message;
  var data;
  List listData;

  Future<String> index(int page, String searchText) async {
//    String request_URL = serverUrl+"/api/wallets?page=$page&searchText=$searchText";
//    final prefs = await SharedPreferences.getInstance();
//    var token = prefs.get('token') ?? '0';
//    var Lang = prefs.get('lang') ?? 'ar';
//    final  response = await http.get(request_URL,
//        headers: {
//          'Accept' : 'application/json',
//          'Authorization' :'Bearer $token',
//          'language' : Lang,
//        });
//
//    data = json.decode(response.body);
//    status =data["success"];
//    message=data["message"];
//    listData = data["data"]["data"];
  }

  store(int user_id, String wallet_balance, String active) async {
//    //basic variables
//    String request_URL = serverUrl+"/api/wallets";
//    final prefs = await SharedPreferences.getInstance();
//    var token = prefs.get('token') ?? '0';
//    var Lang = prefs.get('lang') ?? 'ar';
//
//    var uri = Uri.parse(request_URL);
//    var request = new http.MultipartRequest("POST", uri,);
//
//
//
//                    request.fields["user_id"] = user_id.toString();
//                    request.fields["wallet_balance"] = wallet_balance;
//                    request.fields["active"] = active;
//
//    request.headers["Accept"] = 'application/json';
//    request.headers["Authorization"] = 'Bearer $token';
//    request.headers["language"] = Lang;
//    var streamedResponse = await request.send();
//    var response = await http.Response.fromStream(streamedResponse);
//    data = json.decode(response.body);
//    status =data["success"];
//    message=data["message"];
//
//    /*
//    final  response = await http.post(request_URL,
//        headers: {
//          'Accept' : 'application/json',
//          'Authorization' :'Bearer $token',
//          'language' : Lang,
//        },
//        body: {
//           'user_id' : '$user_id', 'wallet_balance' : '$wallet_balance', 'active' : '$active',
//        });
//
//    data = json.decode(response.body);
//    status =data["success"];
//    message=data["message"];
//    */
//
  }

  update(int id, int user_id, String wallet_balance, String active) async {
    //basic variables
//    String request_URL = serverUrl+"/api/wallets/$id?_method=PUT";
//    final prefs = await SharedPreferences.getInstance();
//    var token = prefs.get('token') ?? '0';
//    var Lang = prefs.get('lang') ?? 'ar';
//
//    var uri = Uri.parse(request_URL);
//    var request = new http.MultipartRequest("POST", uri,);
//
//
//
//                    request.fields["user_id"] = user_id;
//                    request.fields["wallet_balance"] = wallet_balance;
//                    request.fields["active"] = active;
//
//    request.headers["Accept"] = 'application/json';
//    request.headers["Authorization"] = 'Bearer $token';
//    request.headers["language"] = Lang;
//    var streamedResponse = await request.send();
//    var response = await http.Response.fromStream(streamedResponse);
//    data = json.decode(response.body);
//    status =data["success"];
//    message=data["message"];
//
  }

  view() async {
    //basic variables
    String request_URL = serverUrl + "/api/wallets/1";
    final prefs = await SharedPreferences.getInstance();
    var token = prefs.get('token') ?? '0';
    var Lang = prefs.get('lang') ?? 'ar';

    final response = await http.get(request_URL, headers: {
      'Accept': 'application/json',
      'Authorization': 'Bearer $token',
      'language': Lang,
    });
    data = json.decode(response.body);
    status = data["success"];
    message = data["message"];
  }

  delete(int id) async {
//    //basic variables
//    String request_URL = serverUrl+"/api/wallets/$id";
//    final prefs = await SharedPreferences.getInstance();
//    var token = prefs.get('token') ?? '0';
//    var Lang = prefs.get('lang') ?? 'ar';
//
//    final  response = await http.delete(request_URL,
//        headers: {
//          'Accept' : 'application/json',
//          'Authorization' :'Bearer $token',
//          'language' : Lang,
//        });
//    data = json.decode(response.body);
//    status =data["success"];
//    message=data["message"];
  }
}
