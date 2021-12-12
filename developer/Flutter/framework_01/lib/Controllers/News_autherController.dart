
          import 'dart:convert';
import 'package:http/http.dart' as http ;
import 'package:shared_preferences/shared_preferences.dart';


import 'package:path/path.dart';
import 'package:async/async.dart';
import 'dart:io';

class News_autherController {
  String serverUrl = "http://192.168.0.101/framework";
  var status ;
  var message;
  var data;
  List listData;

  Future<String> index(int page,String searchText) async {
    String request_URL = serverUrl+"/api/news_authers?page=$page&searchText=$searchText";
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
  
  
  store(String country_id,String slug,String name_ar,String name_en,String work_title,String Biographical_info_ar,String Biographical_info_en,File profile_image,String email,String website_link,String facebook,String twitter,String linkedin,String SEO_auther_page_title,String SEO_auther_page_metatags,String active) async {
    //basic variables
    String request_URL = serverUrl+"/api/news_authers";
    final prefs = await SharedPreferences.getInstance();
    var token = prefs.get('token') ?? '0';
    var Lang = prefs.get('lang') ?? 'ar';
    
    var uri = Uri.parse(request_URL);
    var request = new http.MultipartRequest("POST", uri,);
    
    
                    if(profile_image != null){
                    var profile_imagestream = new http.ByteStream(DelegatingStream.typed(profile_image.openRead()));
                    var profile_imagelength = await profile_image.length();
                    var multipartFile = new http.MultipartFile('profile_image', profile_imagestream, profile_imagelength,
                        filename: basename(profile_image.path));
                    request.files.add(multipartFile);
                    }
                    
    
                    request.fields["country_id"] = country_id;
                    request.fields["slug"] = slug;
                    request.fields["name_ar"] = name_ar;
                    request.fields["name_en"] = name_en;
                    request.fields["work_title"] = work_title;
                    request.fields["Biographical_info_ar"] = Biographical_info_ar;
                    request.fields["Biographical_info_en"] = Biographical_info_en;
                    request.fields["email"] = email;
                    request.fields["website_link"] = website_link;
                    request.fields["facebook"] = facebook;
                    request.fields["twitter"] = twitter;
                    request.fields["linkedin"] = linkedin;
                    request.fields["SEO_auther_page_title"] = SEO_auther_page_title;
                    request.fields["SEO_auther_page_metatags"] = SEO_auther_page_metatags;
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
  
  update(int id,String country_id,String slug,String name_ar,String name_en,String work_title,String Biographical_info_ar,String Biographical_info_en,File profile_image,String email,String website_link,String facebook,String twitter,String linkedin,String SEO_auther_page_title,String SEO_auther_page_metatags,String active) async {
    //basic variables
    String request_URL = serverUrl+"/api/news_authers/$id?_method=PUT";
    final prefs = await SharedPreferences.getInstance();
    var token = prefs.get('token') ?? '0';
    var Lang = prefs.get('lang') ?? 'ar';
    
    var uri = Uri.parse(request_URL);
    var request = new http.MultipartRequest("POST", uri,);
    
    
                    if(profile_image != null){
                    var profile_imagestream = new http.ByteStream(DelegatingStream.typed(profile_image.openRead()));
                    var profile_imagelength = await profile_image.length();
                    var multipartFile = new http.MultipartFile('profile_image', profile_imagestream, profile_imagelength,
                        filename: basename(profile_image.path));
                    request.files.add(multipartFile);
                    }
                    
    
                    request.fields["country_id"] = country_id;
                    request.fields["slug"] = slug;
                    request.fields["name_ar"] = name_ar;
                    request.fields["name_en"] = name_en;
                    request.fields["work_title"] = work_title;
                    request.fields["Biographical_info_ar"] = Biographical_info_ar;
                    request.fields["Biographical_info_en"] = Biographical_info_en;
                    request.fields["email"] = email;
                    request.fields["website_link"] = website_link;
                    request.fields["facebook"] = facebook;
                    request.fields["twitter"] = twitter;
                    request.fields["linkedin"] = linkedin;
                    request.fields["SEO_auther_page_title"] = SEO_auther_page_title;
                    request.fields["SEO_auther_page_metatags"] = SEO_auther_page_metatags;
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
    String request_URL = serverUrl+"/api/news_authers/$id";
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
    String request_URL = serverUrl+"/api/news_authers/$id";
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
