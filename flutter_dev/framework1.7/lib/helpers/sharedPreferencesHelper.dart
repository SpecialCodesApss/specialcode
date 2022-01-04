import 'package:shared_preferences/shared_preferences.dart';
String? token;

initialize_token() async{
  await getCurrentUserToken();
}

Future<String> getCurrentUserToken() async {
  final prefs = await SharedPreferences.getInstance();
  final key = 'token';
  token = prefs.getString(key);
  return (token)!;
}

saveLoginedUserData(String token,String username,String email,String mobile,String email_verified_at,String mobile_verified_at)
async {
  final prefs = await SharedPreferences.getInstance();
  final key = 'token';
  final value = token;
  prefs.setString(key, value);
  prefs.setString('username', username);
  prefs.setString('email', email);
  prefs.setString('mobile', mobile);
  prefs.setString('email_verified_at', email_verified_at);
  prefs.setString('mobile_verified_at', mobile_verified_at);
}
