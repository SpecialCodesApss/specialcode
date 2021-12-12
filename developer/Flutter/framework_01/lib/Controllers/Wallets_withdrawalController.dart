import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:shared_preferences/shared_preferences.dart';

class Wallets_withdrawalController {
  String serverUrl = "http://192.168.0.101/framework";
  var status;
  var message;
  var data;
  List listData;

  Future<String> index(int page, String searchText) async {
    String request_URL = serverUrl + "/api/wallets_withdrawals?page=$page&searchText=$searchText";
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
    listData = data["data"]["data"];
  }

  store(String bank_name, String account_owner_name, String iban_number, String account_number,
      String withdrawal_amount_required) async {
    //basic variables
    String request_URL = serverUrl + "/api/wallets_withdrawals";
    final prefs = await SharedPreferences.getInstance();
    var token = prefs.get('token') ?? '0';
    var Lang = prefs.get('lang') ?? 'ar';

    var uri = Uri.parse(request_URL);
    var request = new http.MultipartRequest(
      "POST",
      uri,
    );

    request.fields["bank_name"] = bank_name;
    request.fields["account_owner_name"] = account_owner_name;
    request.fields["iban_number"] = iban_number;
    request.fields["account_number"] = account_number;
    request.fields["withdrawal_amount_required"] = withdrawal_amount_required;

    request.headers["Accept"] = 'application/json';
    request.headers["Authorization"] = 'Bearer $token';
    request.headers["language"] = Lang;
    var streamedResponse = await request.send();
    var response = await http.Response.fromStream(streamedResponse);
    data = json.decode(response.body);
    status = data["success"];
    message = data["message"];
  }

  update(int id, String bank_name, String account_owner_name, String iban_number, String account_number,
      String withdrawal_amount_required) async {
    //basic variables
    String request_URL = serverUrl + "/api/wallets_withdrawals/$id?_method=PUT";
    final prefs = await SharedPreferences.getInstance();
    var token = prefs.get('token') ?? '0';
    var Lang = prefs.get('lang') ?? 'ar';

    var uri = Uri.parse(request_URL);
    var request = new http.MultipartRequest(
      "POST",
      uri,
    );

    request.fields["bank_name"] = bank_name;
    request.fields["account_owner_name"] = account_owner_name;
    request.fields["iban_number"] = iban_number;
    request.fields["account_number"] = account_number;
    request.fields["withdrawal_amount_required"] = withdrawal_amount_required;

    request.headers["Accept"] = 'application/json';
    request.headers["Authorization"] = 'Bearer $token';
    request.headers["language"] = Lang;
    var streamedResponse = await request.send();
    var response = await http.Response.fromStream(streamedResponse);
    data = json.decode(response.body);
    status = data["success"];
    message = data["message"];
  }

  view(int id) async {
    //basic variables
    String request_URL = serverUrl + "/api/wallets_withdrawals/$id";
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
    //basic variables
    String request_URL = serverUrl + "/api/wallets_withdrawals/$id";
    final prefs = await SharedPreferences.getInstance();
    var token = prefs.get('token') ?? '0';
    var Lang = prefs.get('lang') ?? 'ar';

    final response = await http.delete(request_URL, headers: {
      'Accept': 'application/json',
      'Authorization': 'Bearer $token',
      'language': Lang,
    });
    data = json.decode(response.body);
    status = data["success"];
    message = data["message"];
  }
}
