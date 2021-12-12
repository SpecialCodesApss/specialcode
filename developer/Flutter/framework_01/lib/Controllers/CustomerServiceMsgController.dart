import 'dart:convert';
import 'package:http/http.dart' as http ;
import '../helpers/sharedPreferencesHelper.dart' as sharedPreferencesHelper;
import '../helpers/sharedPreferencesHelper.dart';
import '../helpers/LanguageHelper.dart';
import '../helpers/LanguageHelper.dart' as LanguageHelper;

class CustomerServiceMsgController {
  String serverUrl = 'https://doctorn.app';
  var status ;
  var message;
  var data;

  var token = sharedPreferencesHelper.token;
  var language = LanguageHelper.Language;

  store(String user_name,String email,String mobile,String user_message) async {
    //basic variables
    String request_URL = serverUrl+"/api/customerService/sendMesage";
    final  response = await http.post(request_URL,
        headers: {
          'Accept' : 'application/json',
          'language' : '$language',
        },
        body: {
          'user_name' : user_name ,
          'email' : email ,
          'mobile' : mobile ,
          'user_message' : user_message ,
        }
    );
    data = json.decode(response.body);
    status =data["success"];
    message=data["message"];
  }

}







