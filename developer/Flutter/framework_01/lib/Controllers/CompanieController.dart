
          import 'dart:convert';
import 'package:http/http.dart' as http ;
import 'package:shared_preferences/shared_preferences.dart';


import 'package:path/path.dart';
import 'package:async/async.dart';
import 'dart:io';

class CompanieController {
  String serverUrl = "http://192.168.0.101/framework";
  var status ;
  var message;
  var data;
  List listData;

  Future<String> index(int page,String searchText) async {
    String request_URL = serverUrl+"/api/companies?page=$page&searchText=$searchText";
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
  
  
  store(String categories,String country_id,String city_id,String slug,String company_name_ar,
      String company_name_en,String description_ar,String description_en,File logo_image,
      String email,String phone_number,String whatsapp_number,String website_link,String address,
      String lat,String lng,String facebook,String twitter,String linkedin,String youtube) async {
    //basic variables
    String request_URL = serverUrl+"/api/companies";
    final prefs = await SharedPreferences.getInstance();
    var token = prefs.get('token') ?? '0';
    var Lang = prefs.get('lang') ?? 'ar';
    
    var uri = Uri.parse(request_URL);
    var request = new http.MultipartRequest("POST", uri,);
    
    
                    if(logo_image != null){
                    var logo_imagestream = new http.ByteStream(DelegatingStream.typed(logo_image.openRead()));
                    var logo_imagelength = await logo_image.length();
                    var multipartFile = new http.MultipartFile('logo_image', logo_imagestream, logo_imagelength,
                        filename: basename(logo_image.path));
                    request.files.add(multipartFile);
                    }
                    
    
                    request.fields["categories"] = categories;
                    request.fields["country_id"] = country_id;
                    request.fields["city_id"] = city_id;
                    request.fields["slug"] = slug;
                    request.fields["company_name_ar"] = company_name_ar;
                    request.fields["company_name_en"] = company_name_en;
                    request.fields["description_ar"] = description_ar;
                    request.fields["description_en"] = description_en;
                    request.fields["email"] = email;
                    request.fields["phone_number"] = phone_number;
                    request.fields["whatsapp_number"] = whatsapp_number;
                    request.fields["website_link"] = website_link;
                    request.fields["address"] = address;
                    request.fields["lat"] = lat;
                    request.fields["lng"] = lng;
                    request.fields["facebook"] = facebook;
                    request.fields["twitter"] = twitter;
                    request.fields["linkedin"] = linkedin;
                    request.fields["youtube"] = youtube;

   
    request.headers["Accept"] = 'application/json';
    request.headers["Authorization"] = 'Bearer $token';
    request.headers["language"] = Lang;
    var streamedResponse = await request.send();
    var response = await http.Response.fromStream(streamedResponse);
    data = json.decode(response.body);
    status =data["success"];
    message=data["message"];
    
  }  
  
  update(int id,String categories,String country_id,String city_id,String slug,String company_name_ar,
      String company_name_en,String description_ar,String description_en,File logo_image,String email,
      String phone_number,String whatsapp_number,String website_link,String address,String lat,String lng,
      String facebook,String twitter,String linkedin,String youtube) async {
    //basic variables
    String request_URL = serverUrl+"/api/companies/$id?_method=PUT";
    final prefs = await SharedPreferences.getInstance();
    var token = prefs.get('token') ?? '0';
    var Lang = prefs.get('lang') ?? 'ar';
    
    var uri = Uri.parse(request_URL);
    var request = new http.MultipartRequest("POST", uri,);
    
    
                    if(logo_image != null){
                    var logo_imagestream = new http.ByteStream(DelegatingStream.typed(logo_image.openRead()));
                    var logo_imagelength = await logo_image.length();
                    var multipartFile = new http.MultipartFile('logo_image', logo_imagestream, logo_imagelength,
                        filename: basename(logo_image.path));
                    request.files.add(multipartFile);
                    }
                    
    
                    request.fields["categories"] = categories;
                    request.fields["country_id"] = country_id;
                    request.fields["city_id"] = city_id;
                    request.fields["slug"] = slug;
                    request.fields["company_name_ar"] = company_name_ar;
                    request.fields["company_name_en"] = company_name_en;
                    request.fields["description_ar"] = description_ar;
                    request.fields["description_en"] = description_en;
                    request.fields["email"] = email;
                    request.fields["phone_number"] = phone_number;
                    request.fields["whatsapp_number"] = whatsapp_number;
                    request.fields["website_link"] = website_link;
                    request.fields["address"] = address;
                    request.fields["lat"] = lat;
                    request.fields["lng"] = lng;
                    request.fields["facebook"] = facebook;
                    request.fields["twitter"] = twitter;
                    request.fields["linkedin"] = linkedin;
                    request.fields["youtube"] = youtube;
   
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
    String request_URL = serverUrl+"/api/companies/$id";
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
    String request_URL = serverUrl+"/api/companies/$id";
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

  get_Variables_for_companies_store() async {
    //basic variables
    String request_URL = serverUrl+"/api/get_Variables_for_companies_store";
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


  get_CountryCites_for_companies_store(int country_id) async {
    //basic variables
    String request_URL = serverUrl+"/api/get_CountryCites_for_companies_store";
    final prefs = await SharedPreferences.getInstance();
    var token = prefs.get('token') ?? '0';
    var Lang = prefs.get('lang') ?? 'ar';

    var uri = Uri.parse(request_URL);
    var request = new http.MultipartRequest("POST", uri,);

    request.fields["country_id"] = country_id.toString();

    request.headers["Accept"] = 'application/json';
    request.headers["Authorization"] = 'Bearer $token';
    request.headers["language"] = Lang;
    var streamedResponse = await request.send();
    var response = await http.Response.fromStream(streamedResponse);
    data = json.decode(response.body);
    status =data["success"];
    message=data["message"];

  }

} 
