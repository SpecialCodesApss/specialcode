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
  "searchHere": "Search Here ..",
  "Manual_payments_methods": "Manual payments methods",
  "Manual_payment_method": "Manual payment method",
  "NoListData": "there is no data.",
  "pullupload": "pull to upload more data",
  "loadFailed": "load Failed",
  "releaseToloadMore": "release To load More",
  "NomoreData": "there is no more data",
  "SARcurrency": " SAR ",
  "Manual_payment_method_text": "Please Select prefered manual payment method",
  "payment_method_details": "payment method details",
  "insert_payment_details": "please insert your transaction details",
  "payment_details": "Payment transaction details",
  "payment_image": "payment verify image",
  "no_payment_image_selected": "no payment verify image selected",
  "create_order": "confirm and create order",
  "pleasefillallfields": "please fill all fields",
  "aaaaa": "aaa",
  "aaaaa": "aaa",
};
