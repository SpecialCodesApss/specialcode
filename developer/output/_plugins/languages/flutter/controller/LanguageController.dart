
          import 'dart:convert';
import 'package:http/http.dart' as http ;
import 'package:shared_preferences/shared_preferences.dart';


import 'package:path/path.dart';
import 'package:async/async.dart';
import 'dart:io';

class LanguageController {
  String serverUrl = "http://192.168.1.101/framework";
  var status ;
  var message;
  var data;
  List listData;

  Future<String> index(int page,String searchText) async {
    String request_URL = serverUrl+"/api/languages?page=$page&searchText=$searchText";
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
  
  
  // store(String name_ar,String name_en,String ISO_code,File language_icon,String active) async {
  //   //basic variables
  //   String request_URL = serverUrl+"/api/languages";
  //   final prefs = await SharedPreferences.getInstance();
  //   var token = prefs.get('token') ?? '0';
  //   var Lang = prefs.get('lang') ?? 'ar';
  //
  //   var uri = Uri.parse(request_URL);
  //   var request = new http.MultipartRequest("POST", uri,);
  //
  //
  //                   if(language_icon != null){
  //                   var language_iconstream = new http.ByteStream(DelegatingStream.typed(language_icon.openRead()));
  //                   var language_iconlength = await language_icon.length();
  //                   var multipartFile = new http.MultipartFile('language_icon', language_iconstream, language_iconlength,
  //                       filename: basename(language_icon.path));
  //                   request.files.add(multipartFile);
  //                   }
  //
  //
  //                   request.fields["name_ar"] = name_ar;
  //                   request.fields["name_en"] = name_en;
  //                   request.fields["ISO_code"] = ISO_code;
  //                   request.fields["active"] = active;
  //
  //   request.headers["Accept"] = 'application/json';
  //   request.headers["Authorization"] = 'Bearer $token';
  //   request.headers["language"] = Lang;
  //   var streamedResponse = await request.send();
  //   var response = await http.Response.fromStream(streamedResponse);
  //   data = json.decode(response.body);
  //   status =data["success"];
  //   message=data["message"];
  //
  //
  //
  // }
  //
  // update(int id,String name_ar,String name_en,String ISO_code,File language_icon,String active) async {
  //   //basic variables
  //   String request_URL = serverUrl+"/api/languages/$id?_method=PUT";
  //   final prefs = await SharedPreferences.getInstance();
  //   var token = prefs.get('token') ?? '0';
  //   var Lang = prefs.get('lang') ?? 'ar';
  //
  //   var uri = Uri.parse(request_URL);
  //   var request = new http.MultipartRequest("POST", uri,);
  //
  //
  //                   if(language_icon != null){
  //                   var language_iconstream = new http.ByteStream(DelegatingStream.typed(language_icon.openRead()));
  //                   var language_iconlength = await language_icon.length();
  //                   var multipartFile = new http.MultipartFile('language_icon', language_iconstream, language_iconlength,
  //                       filename: basename(language_icon.path));
  //                   request.files.add(multipartFile);
  //                   }
  //
  //
  //                   request.fields["name_ar"] = name_ar;
  //                   request.fields["name_en"] = name_en;
  //                   request.fields["ISO_code"] = ISO_code;
  //                   request.fields["active"] = active;
  //
  //   request.headers["Accept"] = 'application/json';
  //   request.headers["Authorization"] = 'Bearer $token';
  //   request.headers["language"] = Lang;
  //   var streamedResponse = await request.send();
  //   var response = await http.Response.fromStream(streamedResponse);
  //   data = json.decode(response.body);
  //   status =data["success"];
  //   message=data["message"];
  //
  //
  //
  //
  // }
  //
  //
  // view(int id) async {
  //   //basic variables
  //   String request_URL = serverUrl+"/api/languages/$id";
  //   final prefs = await SharedPreferences.getInstance();
  //   var token = prefs.get('token') ?? '0';
  //   var Lang = prefs.get('lang') ?? 'ar';
  //
  //   final  response = await http.get(request_URL,
  //       headers: {
  //         'Accept' : 'application/json',
  //         'Authorization' :'Bearer $token',
  //         'language' : Lang,
  //       });
  //   data = json.decode(response.body);
  //   status =data["success"];
  //   message=data["message"];
  //
  // }
  //
  // delete(int id) async {
  //   //basic variables
  //   String request_URL = serverUrl+"/api/languages/$id";
  //   final prefs = await SharedPreferences.getInstance();
  //   var token = prefs.get('token') ?? '0';
  //   var Lang = prefs.get('lang') ?? 'ar';
  //
  //   final  response = await http.delete(request_URL,
  //       headers: {
  //         'Accept' : 'application/json',
  //         'Authorization' :'Bearer $token',
  //         'language' : Lang,
  //       });
  //   data = json.decode(response.body);
  //   status =data["success"];
  //   message=data["message"];
  //
  // }

} 
