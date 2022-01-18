
          import 'dart:convert';
import 'package:http/http.dart' as http ;
import 'package:shared_preferences/shared_preferences.dart';
import '../helpers/sharedPreferencesHelper.dart' as sharedPreferencesHelper;
import '../helpers/LanguageHelper.dart' as LanguageHelper;

import 'package:path/path.dart';
import 'package:async/async.dart';
import 'dart:io';

class Admin_messageController {
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
    Uri request_URL = Uri.parse(serverUrl +"/api/admin_messages?page=$page&searchText=$searchText");
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


  store(String fullname,String email,String mobile,String message_type,
      File? image,String messages_text,
      ) async {
    //basic variables
    await _init();
    Uri request_URL = Uri.parse(serverUrl +"/api/admin_messages");
    final prefs = await SharedPreferences.getInstance();



    var request = new http.MultipartRequest("POST", request_URL,);


                    if(image != null){
                    var imagestream = new http.ByteStream(DelegatingStream.typed(image.openRead()));
                    var imagelength = await image.length();
                    var multipartFile = new http.MultipartFile('image', imagestream, imagelength,
                        filename: basename(image.path));
                    request.files.add(multipartFile);
                    }


                    request.fields["fullname"] = fullname;
                    request.fields["email"] = email;
                    request.fields["mobile"] = mobile;
                    request.fields["message_type"] = message_type;
                    request.fields["messages_text"] = messages_text;


    request.headers["Accept"] = 'application/json';
    request.headers["Authorization"] = 'Bearer $token';
    request.headers["language"] = (language)!;
    var streamedResponse = await request.send();
    var response = await http.Response.fromStream(streamedResponse);
    data = json.decode(response.body);
    status =data["success"];
    message=data["message"];



  }

  update(int id,String fullname,String email,String mobile,String message_type,File? image,String messages_text,String open_status,String marked_as_readed,String marked_as_deleted) async {
     //basic variables
    await _init();
    Uri request_URL = Uri.parse(serverUrl +"/api/admin_messages/$id?_method=PUT");
    final prefs = await SharedPreferences.getInstance();




    var request = new http.MultipartRequest("POST", request_URL,);


                    if(image != null){
                    var imagestream = new http.ByteStream(DelegatingStream.typed(image.openRead()));
                    var imagelength = await image.length();
                    var multipartFile = new http.MultipartFile('image', imagestream, imagelength,
                        filename: basename(image.path));
                    request.files.add(multipartFile);
                    }


                    request.fields["fullname"] = fullname;
                    request.fields["email"] = email;
                    request.fields["mobile"] = mobile;
                    request.fields["message_type"] = message_type;
                    request.fields["messages_text"] = messages_text;
                    request.fields["open_status"] = open_status;
                    request.fields["marked_as_readed"] = marked_as_readed;
                    request.fields["marked_as_deleted"] = marked_as_deleted;

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
    Uri request_URL = Uri.parse(serverUrl +"/api/admin_messages/$id");
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
    Uri request_URL = Uri.parse(serverUrl +"/api/admin_messages/$id");
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
