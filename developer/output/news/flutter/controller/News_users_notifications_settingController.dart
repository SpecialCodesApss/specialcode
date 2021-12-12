
          import 'dart:convert';
import 'package:http/http.dart' as http ;
import 'package:shared_preferences/shared_preferences.dart';


import 'package:path/path.dart';
import 'package:async/async.dart';
import 'dart:io';

class News_users_notifications_settingController {
  String serverUrl = "http://192.168.0.101/framework";
  var status ;
  var message;
  var data;
  List listData;

  Future<String> index(int page,String searchText) async {
    String request_URL = serverUrl+"/api/news_users_notifications_settings?page=$page&searchText=$searchText";
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
  
  
  store(String user_id,String active_notification,String notification_type) async {
    //basic variables
    String request_URL = serverUrl+"/api/news_users_notifications_settings";
    final prefs = await SharedPreferences.getInstance();
    var token = prefs.get('token') ?? '0';
    var Lang = prefs.get('lang') ?? 'ar';
    
    var uri = Uri.parse(request_URL);
    var request = new http.MultipartRequest("POST", uri,);
    
    
    
                    request.fields["user_id"] = user_id;
                    request.fields["active_notification"] = active_notification;
                    request.fields["notification_type"] = notification_type;
   
    request.headers["Accept"] = 'application/json';
    request.headers["Authorization"] = 'Bearer $token';
    request.headers["language"] = Lang;
    var streamedResponse = await request.send();
    var response = await http.Response.fromStream(streamedResponse);
    data = json.decode(response.body);
    status =data["success"];
    message=data["message"];
    
  
    
  }  
  
  update(String active_notification,String notification_type) async {
    //basic variables
    String request_URL = serverUrl+"/api/news_users_notifications_settings/0?_method=PUT";
    final prefs = await SharedPreferences.getInstance();
    var token = prefs.get('token') ?? '0';
    var Lang = prefs.get('lang') ?? 'ar';
    
    var uri = Uri.parse(request_URL);
    var request = new http.MultipartRequest("POST", uri,);
    

                    request.fields["active_notification"] = active_notification;
                    request.fields["notification_type"] = notification_type;
   
    request.headers["Accept"] = 'application/json';
    request.headers["Authorization"] = 'Bearer $token';
    request.headers["language"] = Lang;
    var streamedResponse = await request.send();
    var response = await http.Response.fromStream(streamedResponse);
    data = json.decode(response.body);
    status =data["success"];
    message=data["message"];
     
 
    
    
  }


  Future<String> view() async {
    //basic variables
    String request_URL = serverUrl+"/api/news_users_notifications_settings/0";
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
    String request_URL = serverUrl+"/api/news_users_notifications_settings/$id";
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
