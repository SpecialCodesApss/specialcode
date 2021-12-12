
          import 'dart:convert';
import 'package:http/http.dart' as http ;
import 'package:shared_preferences/shared_preferences.dart';


import 'package:path/path.dart';
import 'package:async/async.dart';
import 'dart:io';

class B_testController {
  String serverUrl = "http://192.168.1.101/framework";
  var status ;
  var message;
  var data;
  List listData;

  Future<String> index(int page,String searchText) async {
    String request_URL = serverUrl+"/api/b_tests?page=$page&searchText=$searchText";
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
  
  
  store(String users_ids,int pages_id,String table_ids,String page_html,String test_2,String email,File image,String type) async {
    //basic variables
    String request_URL = serverUrl+"/api/b_tests";
    final prefs = await SharedPreferences.getInstance();
    var token = prefs.get('token') ?? '0';
    var Lang = prefs.get('lang') ?? 'ar';
    
    var uri = Uri.parse(request_URL);
    var request = new http.MultipartRequest("POST", uri,);
    
    
                    if(image != null){
                    var imagestream = new http.ByteStream(DelegatingStream.typed(image.openRead()));
                    var imagelength = await image.length();
                    var multipartFile = new http.MultipartFile('image', imagestream, imagelength,
                        filename: basename(image.path));
                    request.files.add(multipartFile);
                    }
                    
    
                    request.fields["users_ids"] = users_ids;
                    request.fields["pages_id"] = pages_id;
                    request.fields["table_ids"] = table_ids;
                    request.fields["page_html"] = page_html;
                    request.fields["test_2"] = test_2;
                    request.fields["email"] = email;
                    request.fields["type"] = type;
   
    request.headers["Accept"] = 'application/json';
    request.headers["Authorization"] = 'Bearer $token';
    request.headers["language"] = Lang;
    var streamedResponse = await request.send();
    var response = await http.Response.fromStream(streamedResponse);
    data = json.decode(response.body);
    status =data["success"];
    message=data["message"];
    
  
    
  }  
  
  update(int id,String users_ids,int pages_id,String table_ids,String page_html,String test_2,String email,File image,String type) async {
    //basic variables
    String request_URL = serverUrl+"/api/b_tests/$id?_method=PUT";
    final prefs = await SharedPreferences.getInstance();
    var token = prefs.get('token') ?? '0';
    var Lang = prefs.get('lang') ?? 'ar';
    
    var uri = Uri.parse(request_URL);
    var request = new http.MultipartRequest("POST", uri,);
    
    
                    if(image != null){
                    var imagestream = new http.ByteStream(DelegatingStream.typed(image.openRead()));
                    var imagelength = await image.length();
                    var multipartFile = new http.MultipartFile('image', imagestream, imagelength,
                        filename: basename(image.path));
                    request.files.add(multipartFile);
                    }
                    
    
                    request.fields["users_ids"] = users_ids;
                    request.fields["pages_id"] = pages_id;
                    request.fields["table_ids"] = table_ids;
                    request.fields["page_html"] = page_html;
                    request.fields["test_2"] = test_2;
                    request.fields["email"] = email;
                    request.fields["type"] = type;
   
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
    String request_URL = serverUrl+"/api/b_tests/$id";
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
    String request_URL = serverUrl+"/api/b_tests/$id";
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
