

CREATE TABLE `sponsers` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name_ar` varchar(50) NOT NULL,
  `name_en` varchar(50) NOT NULL,
  `logo_image` text NOT NULL,
  `website_link` text NOT NULL,
  `sort` bigint(20) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;


INSERT INTO admin_sections (`id`, `parent_section_id`, `section_name_ar`, `section_name_en`, `section_icon`, `section_flag`, `controller_name`, `is_notification_able`, `is_drop_menu`, `active`, `sort`, `created_at`, `updated_at`) VALUES 
('44','','الرعاة','Sponsers','fab fa-adversal','sponsers','SponserController','0','0','1','18','2021-03-20 00:25:56','2021-03-20 00:25:56');

INSERT INTO api_requests (`id`, `name`, `controller_name`, `Mobile_List`, `Mobile_Create`, `Mobile_Update`, `Mobile_View`, `Mobile_Delete`, `list_authorization_status`, `create_authorization_status`, `update_authorization_status`, `view_authorization_status`, `delete_authorization_status`, `parameters`, `created_at`, `updated_at`) VALUES 
('32','sponsers','SponserController','1','0','0','0','0','0','0','0','0','0','[\"name_ar\",\"name_en\",\"logo_image\",\"website_link\",\"active\"]','2021-03-20 00:26:01','2021-03-20 00:26:01');

INSERT INTO extensions (`id`, `extension_flag_name`, `extension_module_name`, `extension_description`, `additional_extensions`, `additional_tables`, `additional_modules`, `created_at`, `updated_at`) VALUES 
('16','sponsers','Sponser','Sponsers','[]','[]','[]','2021-03-20 00:25:57','2021-03-20 00:25:57');

INSERT INTO sponsers (`id`, `name_ar`, `name_en`, `logo_image`, `website_link`, `sort`, `active`, `created_at`, `updated_at`) VALUES 
('3','فودافون مصر','Vodafone Egypt','storage/images/sponsers/logo_image/20210323014022.jpg','https://web.vodafone.com.eg/','1','1','2021-03-23 01:40:22','2021-03-23 01:40:22');

INSERT INTO sponsers (`id`, `name_ar`, `name_en`, `logo_image`, `website_link`, `sort`, `active`, `created_at`, `updated_at`) VALUES 
('4','الاتصالات السعودية STC','STC TeleCom','storage/images/sponsers/logo_image/20210323014114.jpg','https://www.stc.com.sa/','2','1','2021-03-23 01:41:14','2021-03-23 01:41:14');
