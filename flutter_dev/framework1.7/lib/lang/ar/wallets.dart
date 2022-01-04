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
  "withdrawal_amount_required" : "مبلغ السحب المطلوب",
  "withdrawal_from_wallet" : " سحب من المحفظة ",
  "money_withdrawal_status" : "حالة السحب",
  "Wallets_withdrawals" : "السحب من المحفظة",
  "chargeAmount" : "مبلغ الشحن",
  "chargeWallet" : "شحن رصيد المحفظة ",
  "wallet_user_id" : "معرف المستخدم",
  "wallet_balance" : "رصيد المحفظة",
  "wallet_activation" : "تفعيل المحفظة",
  "Wallets" : "محفظتي",
  "notEnoughWalletAmount" : "رصيد المحفظة غير كافي",
};
