getTranslation(String message_name) {
  var translation_response = "not found $message_name";
  messages.forEach((key, value) {
    if (key == message_name) {
      translation_response = value;
    }
  });
  return translation_response;
}

var messages = {
  "login": "تسجيل الدخول",
  "mobile": "رقم الجوال",
  "password": "الرقم السري",
  "forgetpassword": " نسيت الرقم السري ؟",
  "locale": "ar",
  "mobilehinttext": "اكتب رقم الجوال هنا",
  "passwordhinttext": " اكتب الرقم السري هنا",
  "didnthaveaccount": "ليس لديك حساب ؟",
  "registernewaccount": "تسجيل حساب جديد",
  "registernewDoctoraccount": "هل أنت طبيب ؟ ، سجل من هنا ..!",
  "enterasvisitor": "الدخول كزائر",
  "forgetpasswordbymobiletext": "يمكنك الان استعادة حسابك عن طريق رقم الهاتف المسجل لدينا",
  "forgetpassmobhinttext": "رقم الجوال المسجل",
  "sendcode": "إرسال كود التفعيل",
  "verificationcode": "التحقق",
  "verificationcodetext": "أدخل كود التحقق الذي تم إرساله إلى رقم الجوال",
  "verificationcodehint": "ادخل كود التحقق هنا",
  "verify": "تحقق",
  "resetpass": "إعادة ضبط الرقم السري",
  "currentpass": "الرقم السري الحالى",
  "newpass": "الرقم السري الجديد",
  "confirmnewpass": "إعادة الرقم السري الجديد",
  "edit": "تعديل",
  "register": "تسجيل",
  "name": "الاسم",
  "email": "البريد",
  "confirmpassword": "إعادة الرقم السري",
  "haveaccount": "هل تمتلك حساب ؟",
  "VerifyMobileNumber": "تأكيد رقم الجوال",
  "resendverifycode": "إعادة إرسال كود التفعيل",
  "changeMobileNo": "تعديل رقم الجوال",
  "home": "الرئيسية",
  "MyAccount": "حسابي",
  "Notifications": "الإشعارات",
  "Contactus": "اتصل بنا",
  "Aboutus": "من نحن",
  "AboutApp": "عن التطبيق",
  "Logout": "تسجيل الخروج",
  "EditMyAccount": "تعديل حسابي",
  "EditmyDoctorAccount": "تعديل حسابي كـ طبيب ",
  "EditMyAccountPassword": "تغيير الرقم السري",
  "mobileoremail": "رقم الجوال أو البريد",
  "Msgtitle": "عنوان الرسالة",
  "Message": "نص الرسالة",
  "send": "إرسال",
  "TermsAndConditions": "الشروط والأحكام",
  "pleasefillallfields": "من فضلك ادخل جميع البيانات",
  "visitor": "زائـــــر",
  "Nonotifications": "لاتوجد إشعارات غير مقرؤة",
  "NoListData": "عفوا .. لا توجد بيانات !",
  "Settings": "الإعدادات",
  "Choose_language": "اختر اللغة المفضلة",
  "please_update_app": "هناك نسخة حديثة من هذا التطبيق ، من فضلك قم بتحديث التطبيق عن طريق المتجر",
  "app_copyrights": "تم تطوير وتصميم التطبيق بواسطة شركة سعودي آب Saudi-App.com",


  "Rating_alternativeButton": "تواصل معنا الآن ؟",
  "Rating_positiveComment":  "نحن سعداء لاستقبال تقييمك الجيد :) ",
  "Rating_negativeComment": "نأسف لك على تقييمك هذا :(",

  "comment": "تعليقك",
  "comment_placholder": "اكتب تعليقك هنا - اختياري",
};
