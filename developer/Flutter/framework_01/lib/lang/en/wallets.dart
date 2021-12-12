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
  "withdrawal_amount_required" : "withdrawal amount required",
  "withdrawal_from_wallet" : "withdrawal from wallet",
  "money_withdrawal_status" : "money withdrawal status",
  "Wallets_withdrawals" : "wallets_withdrawals",
  "chargeAmount" : "Charge amount",
  "chargeWallet" : "Charge Wallet",
  "wallet_user_id" : "wallet user id",
  "wallet_balance" : "wallet balance",
  "wallet_activation" : "wallet activation",
  "Wallets" : "My Wallet",
  "notEnoughWalletAmount" : "not enough wallet amount",
};
