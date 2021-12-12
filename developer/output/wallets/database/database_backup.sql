

CREATE TABLE `wallets` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `wallet_id` varchar(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `wallet_balance` double(10,2) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;



CREATE TABLE `wallets_withdrawals` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `account_owner_name` varchar(255) NOT NULL,
  `iban_number` varchar(255) NOT NULL,
  `account_number` varchar(255) NOT NULL,
  `withdrawal_amount_required` varchar(255) NOT NULL,
  `money_withdrawal_status` varchar(255) NOT NULL DEFAULT 'قيد المراجعة',
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;


INSERT INTO admin_sections (`id`, `parent_section_id`, `section_name_ar`, `section_name_en`, `section_icon`, `section_flag`, `controller_name`, `is_notification_able`, `is_drop_menu`, `active`, `sort`, `created_at`, `updated_at`) VALUES 
('28','','المحفظة الالكترونية','Wallets','fas fa-wallet','wallets','WalletController','1','0','1','17','2020-05-21 06:25:12','2020-05-21 06:25:12');

INSERT INTO admin_sections (`id`, `parent_section_id`, `section_name_ar`, `section_name_en`, `section_icon`, `section_flag`, `controller_name`, `is_notification_able`, `is_drop_menu`, `active`, `sort`, `created_at`, `updated_at`) VALUES 
('29','','السحب من المحفظة','Wallets withdrawals','fas fa-sign-out-alt','wallets_withdrawals','Wallets_withdrawalController','1','0','1','18','2020-05-21 08:38:24','2020-05-21 08:38:24');

INSERT INTO api_requests (`id`, `name`, `controller_name`, `Mobile_List`, `Mobile_Create`, `Mobile_Update`, `Mobile_View`, `Mobile_Delete`, `list_authorization_status`, `create_authorization_status`, `update_authorization_status`, `view_authorization_status`, `delete_authorization_status`, `parameters`, `created_at`, `updated_at`) VALUES 
('17','wallets','WalletController','0','0','0','1','0','0','0','0','1','0','[\"user_id\",\"wallet_balance\",\"active\"]','2020-05-21 06:25:13','2020-05-21 06:45:48');

INSERT INTO api_requests (`id`, `name`, `controller_name`, `Mobile_List`, `Mobile_Create`, `Mobile_Update`, `Mobile_View`, `Mobile_Delete`, `list_authorization_status`, `create_authorization_status`, `update_authorization_status`, `view_authorization_status`, `delete_authorization_status`, `parameters`, `created_at`, `updated_at`) VALUES 
('18','wallets_withdrawals','Wallets_withdrawalController','1','1','1','1','1','1','1','1','1','1','[\"bank_name\",\"account_owner_name\",\"iban_number\",\"withdrawal_amount_required\"]','2020-05-21 08:38:25','2020-05-21 08:38:25');

INSERT INTO extensions (`id`, `extension_flag_name`, `extension_module_name`, `extension_description`, `additional_extensions`, `additional_tables`, `additional_modules`, `created_at`, `updated_at`) VALUES 
('2','wallets','Wallet','to add wallet','[\"wallets_withdrawals\"]','[]','[\"Wallets_withdrawal\"]','2020-08-17 11:32:29','2020-08-18 08:33:49');
