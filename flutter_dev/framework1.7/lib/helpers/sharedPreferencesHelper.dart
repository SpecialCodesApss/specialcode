import 'package:shared_preferences/shared_preferences.dart';
String? token;

initialize_token() async{
  await getCurrentUserToken();
}

Future<String> getCurrentUserToken() async {
  // final prefs = await SharedPreferences.getInstance();
  SharedPreferences prefs = await SharedPreferences.getInstance();
  var user_token = prefs.getString('token');
  if(user_token != null){
    token = user_token;
    return user_token;
  }
  else{
    return '';
  }

}

saveLoginedUserData(String token,String username,String email,String mobile,[String email_verified_at='',String mobile_verified_at=''])
async {
  SharedPreferences prefs = await SharedPreferences.getInstance();
  prefs.setString('token', token);
  prefs.setString('username', username);
  prefs.setString('email', email);
  prefs.setString('mobile', mobile);
  prefs.setString('email_verified_at', email_verified_at);
  prefs.setString('mobile_verified_at', mobile_verified_at);
}
