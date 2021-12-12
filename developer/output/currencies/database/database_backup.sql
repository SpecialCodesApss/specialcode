

CREATE TABLE `currencies` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name_ar` varchar(255) NOT NULL,
  `name_en` varchar(255) NOT NULL,
  `ISO_code` varchar(10) NOT NULL,
  `value` double(10,3) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `sort` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;


INSERT INTO admin_sections (`id`, `parent_section_id`, `section_name_ar`, `section_name_en`, `section_icon`, `section_flag`, `controller_name`, `is_notification_able`, `is_drop_menu`, `active`, `sort`, `created_at`, `updated_at`) VALUES 
('43','','العملات','Currencies','fas fa-money-bill-wave-alt','currencies','CurrencieController','0','0','1','17','2021-03-19 19:41:04','2021-03-19 19:41:04');

INSERT INTO api_requests (`id`, `name`, `controller_name`, `Mobile_List`, `Mobile_Create`, `Mobile_Update`, `Mobile_View`, `Mobile_Delete`, `list_authorization_status`, `create_authorization_status`, `update_authorization_status`, `view_authorization_status`, `delete_authorization_status`, `parameters`, `created_at`, `updated_at`) VALUES 
('31','currencies','CurrencieController','1','0','0','0','0','0','0','0','0','0','[\"name_ar\",\"name_en\",\"ISO_code\",\"value\",\"active\"]','2021-03-19 19:41:06','2021-03-19 19:41:06');

INSERT INTO extensions (`id`, `extension_flag_name`, `extension_module_name`, `extension_description`, `additional_extensions`, `additional_tables`, `additional_modules`, `created_at`, `updated_at`) VALUES 
('15','currencies','Currencie','Currencies','[]','[]','[]','2021-03-19 19:41:04','2021-03-19 19:41:04');

INSERT INTO currencies (`id`, `name_ar`, `name_en`, `ISO_code`, `value`, `active`, `sort`, `created_at`, `updated_at`) VALUES 
('1','الدولار الأمريكي','USD Dollar','USD','1','1','0','2020-07-14 15:27:24','2021-03-19 03:56:26');

INSERT INTO currencies (`id`, `name_ar`, `name_en`, `ISO_code`, `value`, `active`, `sort`, `created_at`, `updated_at`) VALUES 
('2','الريال السعودي','Saudi Riyal','SAR','0.27','1','0','2020-07-14 15:27:24','2021-03-19 03:57:19');

INSERT INTO currencies (`id`, `name_ar`, `name_en`, `ISO_code`, `value`, `active`, `sort`, `created_at`, `updated_at`) VALUES 
('3','الجنيه المصري','Egyptian Pound','EGP','0.064','1','0','2020-07-14 15:27:24','2021-03-19 03:57:04');
