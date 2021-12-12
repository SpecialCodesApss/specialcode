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
  "searchHere": "ابحث هنا ..",
  "Manual_payments_methods": "طرق الدفع اليدوية",
  "Manual_payment_method": "طريقة الدفع اليدوية",
  "NoListData": "لايوجد بيانات .",
  "pullupload": "اسحب لتحميل المزيد من البيانات",
  "loadFailed": "فشل التحميل",
  "releaseToloadMore": "حرر يدك لعرض البيانات",
  "NomoreData": "لايوجد مزيد من البيانات",
  "SARcurrency": " ر.س ",
  "Manual_payment_method_text": "من فضلك قم بإختيار طريقة الدفع اليدوية التي تفضل استخدامها",
  "payment_method_details": "تفاصيل طريقة الدفع",
  "insert_payment_details": "أكتب هنا تفاصيل عملية الدفع التي قمت بها وبيانات التحويل وبيانات الحساب المحول منه",
  "payment_details": "تفاصيل التحويل الذي قمت به",
  "payment_image": "صورة إثبات التحويل",
  "no_payment_image_selected": "لم يتم اختيار صورة إثبات التحويل",
  "create_order": "تأكيد وإنهاء الطلب",
  "pleasefillallfields": "برجاء إدخال بيانات جميع الحقول",
  "aaaaa": "aaa",
};
