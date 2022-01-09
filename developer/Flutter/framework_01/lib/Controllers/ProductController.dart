
          import 'dart:convert';
import 'package:http/http.dart' as http ;
import 'package:shared_preferences/shared_preferences.dart';


import 'package:path/path.dart';
import 'package:async/async.dart';
import 'dart:io';

class ProductController {
  String serverUrl = "http://192.168.1.101/framework";
  var status ;
  var message;
  var data;
  List listData;

  Future<String> index(int page,String searchText) async {
    String request_URL = serverUrl+"/api/products?page=$page&searchText=$searchText";
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


  store(String name_ar,String name_en,File image,String description_ar,String description_en,String html_text_ar,String html_text_en,String active,String user_id) async {
    //basic variables
    String request_URL = serverUrl+"/api/products";
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
                    
    
                    request.fields["name_ar"] = name_ar;
                    request.fields["name_en"] = name_en;
                    request.fields["description_ar"] = description_ar;
                    request.fields["description_en"] = description_en;
                    request.fields["html_text_ar"] = html_text_ar;
                    request.fields["html_text_en"] = html_text_en;
                    request.fields["active"] = active;
                    request.fields["user_id"] = user_id;

    request.headers["Accept"] = 'application/json';
    request.headers["Authorization"] = 'Bearer $token';
    request.headers["language"] = Lang;
    var streamedResponse = await request.send();
    var response = await http.Response.fromStream(streamedResponse);
    data = json.decode(response.body);
    status =data["success"];
    message=data["message"];



  }

  update(int id,String name_ar,String name_en,File image,String description_ar,String description_en,String html_text_ar,String html_text_en,String active,String user_id) async {
    //basic variables
    String request_URL = serverUrl+"/api/products/$id?_method=PUT";
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
                    
    
                    request.fields["name_ar"] = name_ar;
                    request.fields["name_en"] = name_en;
                    request.fields["description_ar"] = description_ar;
                    request.fields["description_en"] = description_en;
                    request.fields["html_text_ar"] = html_text_ar;
                    request.fields["html_text_en"] = html_text_en;
                    request.fields["active"] = active;
                    request.fields["user_id"] = user_id;

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
    String request_URL = serverUrl+"/api/products/$id";
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
    String request_URL = serverUrl+"/api/products/$id";
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
