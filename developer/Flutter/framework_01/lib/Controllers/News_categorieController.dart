
          import 'dart:convert';
import 'package:http/http.dart' as http ;
import 'package:shared_preferences/shared_preferences.dart';


import 'package:path/path.dart';
import 'package:async/async.dart';
import 'dart:io';

class News_categorieController {
  String serverUrl = "http://192.168.0.101/framework";
  var status ;
  var message;
  var data;
  List listData;

  Future<String> index(int page,String searchText) async {
    String request_URL = serverUrl+"/api/news_categories?page=$page&searchText=$searchText";
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
  
  
  store(String parent_category_id,String slug,String name_ar,String name_en,String description_ar,String description_en,File category_image,File category_icon,String active) async {
    //basic variables
    String request_URL = serverUrl+"/api/news_categories";
    final prefs = await SharedPreferences.getInstance();
    var token = prefs.get('token') ?? '0';
    var Lang = prefs.get('lang') ?? 'ar';
    
    var uri = Uri.parse(request_URL);
    var request = new http.MultipartRequest("POST", uri,);
    
    
                    if(category_image != null){
                    var category_imagestream = new http.ByteStream(DelegatingStream.typed(category_image.openRead()));
                    var category_imagelength = await category_image.length();
                    var multipartFile = new http.MultipartFile('category_image', category_imagestream, category_imagelength,
                        filename: basename(category_image.path));
                    request.files.add(multipartFile);
                    }
                    
                    if(category_icon != null){
                    var category_iconstream = new http.ByteStream(DelegatingStream.typed(category_icon.openRead()));
                    var category_iconlength = await category_icon.length();
                    var multipartFile = new http.MultipartFile('category_icon', category_iconstream, category_iconlength,
                        filename: basename(category_icon.path));
                    request.files.add(multipartFile);
                    }
                    
    
                    request.fields["parent_category_id"] = parent_category_id;
                    request.fields["slug"] = slug;
                    request.fields["name_ar"] = name_ar;
                    request.fields["name_en"] = name_en;
                    request.fields["description_ar"] = description_ar;
                    request.fields["description_en"] = description_en;
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
  
  update(int id,String parent_category_id,String slug,String name_ar,String name_en,String description_ar,String description_en,File category_image,File category_icon,String active) async {
    //basic variables
    String request_URL = serverUrl+"/api/news_categories/$id?_method=PUT";
    final prefs = await SharedPreferences.getInstance();
    var token = prefs.get('token') ?? '0';
    var Lang = prefs.get('lang') ?? 'ar';
    
    var uri = Uri.parse(request_URL);
    var request = new http.MultipartRequest("POST", uri,);
    
    
                    if(category_image != null){
                    var category_imagestream = new http.ByteStream(DelegatingStream.typed(category_image.openRead()));
                    var category_imagelength = await category_image.length();
                    var multipartFile = new http.MultipartFile('category_image', category_imagestream, category_imagelength,
                        filename: basename(category_image.path));
                    request.files.add(multipartFile);
                    }
                    
                    if(category_icon != null){
                    var category_iconstream = new http.ByteStream(DelegatingStream.typed(category_icon.openRead()));
                    var category_iconlength = await category_icon.length();
                    var multipartFile = new http.MultipartFile('category_icon', category_iconstream, category_iconlength,
                        filename: basename(category_icon.path));
                    request.files.add(multipartFile);
                    }
                    
    
                    request.fields["parent_category_id"] = parent_category_id;
                    request.fields["slug"] = slug;
                    request.fields["name_ar"] = name_ar;
                    request.fields["name_en"] = name_en;
                    request.fields["description_ar"] = description_ar;
                    request.fields["description_en"] = description_en;
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
    String request_URL = serverUrl+"/api/news_categories/$id";
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
    String request_URL = serverUrl+"/api/news_categories/$id";
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
