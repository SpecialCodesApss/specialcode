
          import 'dart:convert';
import 'package:http/http.dart' as http ;
import 'package:shared_preferences/shared_preferences.dart';


import 'package:path/path.dart';
import 'package:async/async.dart';
import 'dart:io';

class CurrencieController {
  String serverUrl = "http://192.168.1.101/framework";
  var status ;
  var message;
  var data;
  List listData;

  Future<String> index(int page,String searchText) async {
    String request_URL = serverUrl+"/api/currencies?page=$page&searchText=$searchText";
    final prefs = await SharedPreferences.getInstance();
    var token = prefs.get('token') ?? '0';
    var Lang = prefs.get('lang') ?? 'ar';
    final  response = await http.get(request_URL,
        headers: {
          'Accept' : 'application/json',
          'Authorization' :'Bearer $token',
          'language' : Lang,
        });

    data = json.decode(response.body);
    status =data["success"];
    message=data["message"];
    listData = data["data"]["data"];
  }
  
  
  store(String name_ar,String name_en,String ISO_code,String value,String active) async {
    //basic variables
    String request_URL = serverUrl+"/api/currencies";
    final prefs = await SharedPreferences.getInstance();
    var token = prefs.get('token') ?? '0';
    var Lang = prefs.get('lang') ?? 'ar';
    
    var uri = Uri.parse(request_URL);
    var request = new http.MultipartRequest("POST", uri,);
    
    
    
                    request.fields["name_ar"] = name_ar;
                    request.fields["name_en"] = name_en;
                    request.fields["ISO_code"] = ISO_code;
                    request.fields["value"] = value;
                    request.fields["active"] = active;
   
    request.headers["Accept"] = 'application/json';
    request.headers["Authorization"] = 'Bearer $token';
    request.headers["language"] = Lang;
    var streamedResponse = await request.send();
    var response = await http.Response.fromStream(streamedResponse);
    data = json.decode(response.body);
    status =data["success"];
    message=data["message"];
    
  
    
  }  
  
  update(int id,String name_ar,String name_en,String ISO_code,String value,String active) async {
    //basic variables
    String request_URL = serverUrl+"/api/currencies/$id?_method=PUT";
    final prefs = await SharedPreferences.getInstance();
    var token = prefs.get('token') ?? '0';
    var Lang = prefs.get('lang') ?? 'ar';
    
    var uri = Uri.parse(request_URL);
    var request = new http.MultipartRequest("POST", uri,);
    
    
    
                    request.fields["name_ar"] = name_ar;
                    request.fields["name_en"] = name_en;
                    request.fields["ISO_code"] = ISO_code;
                    request.fields["value"] = value;
                    request.fields["active"] = active;
   
    request.headers["Accept"] = 'application/json';
    request.headers["Authorization"] = 'Bearer $token';
    request.headers["language"] = Lang;
    var streamedResponse = await request.send();
    var response = await http.Response.fromStream(streamedResponse);
    data = json.decode(response.body);
    status =data["success"];
    message=data["message"];
     
 
    
    
  }
    
  
  view(int id) async {
    //basic variables
    String request_URL = serverUrl+"/api/currencies/$id";
    final prefs = await SharedPreferences.getInstance();
    var token = prefs.get('token') ?? '0';
    var Lang = prefs.get('lang') ?? 'ar';

    final  response = await http.get(request_URL,
        headers: {
          'Accept' : 'application/json',
          'Authorization' :'Bearer $token',
          'language' : Lang,
        });
    data = json.decode(response.body);
    status =data["success"];
    message=data["message"];

  }  

  delete(int id) async {
    //basic variables
    String request_URL = serverUrl+"/api/currencies/$id";
    final prefs = await SharedPreferences.getInstance();
    var token = prefs.get('token') ?? '0';
    var Lang = prefs.get('lang') ?? 'ar';

    final  response = await http.delete(request_URL,
        headers: {
          'Accept' : 'application/json',
          'Authorization' :'Bearer $token',
          'language' : Lang,
        });
    data = json.decode(response.body);
    status =data["success"];
    message=data["message"];

  }

} 
