
          import 'dart:convert';
import 'package:http/http.dart' as http ;
import 'package:shared_preferences/shared_preferences.dart';
import '../helpers/sharedPreferencesHelper.dart' as sharedPreferencesHelper;
import '../helpers/LanguageHelper.dart' as LanguageHelper;

import 'package:path/path.dart';
import 'package:async/async.dart';
import 'dart:io';

class ProductController {
  String serverUrl = "http://192.168.1.4/framework1.7";
  var status ;
  var message;
  var data;
  var listData;
  var token = sharedPreferencesHelper.token;
  var language = LanguageHelper.Language;

  _init() async{
    await LanguageHelper.initialize();
    await sharedPreferencesHelper.initialize_token();
    language = LanguageHelper.Language;
    token = sharedPreferencesHelper.token;
  }

  index(int page,String searchText) async {
  await _init();
    Uri request_URL = Uri.parse(serverUrl +"/api/products?page=$page&searchText=$searchText");
    final prefs = await SharedPreferences.getInstance();


    final  response = await http.get(request_URL,
        headers: {
          'Accept' : 'application/json',
          'Authorization': 'Bearer $token',
          'language': (language)!
        });

    data = json.decode(response.body);
    status =data["success"];
    message=data["message"];
    listData = data["data"]["data"];
  }


  store(String name,String selector) async {
    //basic variables
    await _init();
    Uri request_URL = Uri.parse(serverUrl +"/api/products");
    final prefs = await SharedPreferences.getInstance();




    var request = new http.MultipartRequest("POST", request_URL,);

    
    
                    request.fields["name"] = name;
                    request.fields["selector"] = selector;

    request.headers["Accept"] = 'application/json';
    request.headers["Authorization"] = 'Bearer $token';
    request.headers["language"] = (language)!;
    var streamedResponse = await request.send();
    var response = await http.Response.fromStream(streamedResponse);
    data = json.decode(response.body);
    status =data["success"];
    message=data["message"];



  }

  update(int id,String name,String selector) async {
     //basic variables
    await _init();
    Uri request_URL = Uri.parse(serverUrl +"/api/products/$id?_method=PUT");
    final prefs = await SharedPreferences.getInstance();




    var request = new http.MultipartRequest("POST", request_URL,);

    
    
                    request.fields["name"] = name;
                    request.fields["selector"] = selector;

    request.headers["Accept"] = 'application/json';
    request.headers["Authorization"] = 'Bearer $token';
    request.headers["language"] = (language)!;
    var streamedResponse = await request.send();
    var response = await http.Response.fromStream(streamedResponse);
    data = json.decode(response.body);
    status =data["success"];
    message=data["message"];




  }


  view(int id) async {
     //basic variables
    await _init();
    Uri request_URL = Uri.parse(serverUrl +"/api/products/$id");
    final prefs = await SharedPreferences.getInstance();



    final  response = await http.get(request_URL,
        headers: {
          'Accept' : 'application/json',
          'Authorization': 'Bearer $token',
          'language': (language)!
        });
    data = json.decode(response.body);
    status =data["success"];
    message=data["message"];

  }

  delete(int id) async {
     //basic variables
    await _init();
    Uri request_URL = Uri.parse(serverUrl +"/api/products/$id");
    final prefs = await SharedPreferences.getInstance();



    final  response = await http.delete(request_URL,
        headers: {
          'Accept' : 'application/json',
          'Authorization': 'Bearer $token',
          'language': (language)!
        });
    data = json.decode(response.body);
    status =data["success"];
    message=data["message"];

  }

}
