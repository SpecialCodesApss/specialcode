getTranslation(String message_name) {
  String translation_response = "not found $message_name";
  translation_response = messages[message_name] ?? translation_response;
  return translation_response;
}


var messages = {
  "login": "Login",
  "mobile": "Mobile",
  "password": "Password",
  "forgetpassword": "forget password ?",
  "locale": "en",
  "mobilehinttext": "write your mobile here",
  "passwordhinttext": "write password here",
  "didnthaveaccount": "Didn't have account ?",
  "registernewaccount": "Register New account",
  "registernewDoctoraccount": "Are you Doctor ? , Register from here ..",
  "enterasvisitor": "Enter as visitor",
  "forgetpasswordbymobiletext": "You can now recover your account via our registered phone number",
  "forgetpassmobhinttext": "Registered Mobile",
  "sendcode": "Send code",
  "verificationcode": "Verification code",
  "verificationcodetext": "Enter verify code was sent to your mobile here",
  "verificationcodehint": "Enter verify code here",
  "verify": "Verify",
  "resetpass": "Reset Password",
  "currentpass": "Current Password",
  "newpass": "New Password",
  "confirmnewpass": "Confirm New Password",
  "edit": "Edit",
  "register": "Register",
  "name": "Name",
  "email": "Email",
  "confirmpassword": "Repeat Password",
  "haveaccount": "Do you have account ?",
  "VerifyMobileNumber": "Verify Mobile Number",
  "resendverifycode": "Resend Verify Code",
  "changeMobileNo": "Edit Mobile",
  "home": "Home",
  "MyAccount": "My Account",
  "Notifications": "Notifications",
  "Contactus": "Contact us",
  "Aboutus": "About us",
  "AboutApp": "About App",
  "Logout": "Logout",
  "EditMyAccount": "Edit My Account",
  "EditmyDoctorAccount": "Edit My Doctor Account",
  "EditMyAccountPassword": "Change Password",
  "mobileoremail": "Your Mobile or Email",
  "Msgtitle": "Title",
  "Message": "Message",
  "send": "Send",
  "TermsAndConditions": "Terms And Conditions",
  "pleasefillallfields": "please fill all fields",
  "visitor": "Visitor",
  "Nonotifications": "No unread notifications found",
  "NoListData": "No data Found",
  "Settings": "Settings",
  "Choose_language": "Choose Perefered language",
  "please_update_app": "There is a new version of this App , please update it from the store",
  "app_copyrights": "This App Developed and Designed By Saudi-App.com",


  "Rating_alternativeButton": "Contact us instead?",
  "Rating_positiveComment":  "We are so happy to hear :)",
  "Rating_negativeComment": "We're sad to hear :(",

  "comment": "comment",
  "uploadPhoto": "upload Photo",
  "comment_placholder": "wirte your comment - optional",


};
