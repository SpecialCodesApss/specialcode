

CREATE TABLE `languages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name_ar` varchar(255) NOT NULL,
  `name_en` varchar(255) NOT NULL,
  `ISO_code` varchar(10) NOT NULL,
  `language_icon` text,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `sort` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;


INSERT INTO admin_sections (`id`, `parent_section_id`, `section_name_ar`, `section_name_en`, `section_icon`, `section_flag`, `controller_name`, `is_notification_able`, `is_drop_menu`, `active`, `sort`, `created_at`, `updated_at`) VALUES 
('42','','اللغات','Languages','fas fa-language','languages','LanguageController','0','0','1','16','2021-03-19 15:38:19','2021-03-19 15:38:19');

INSERT INTO api_requests (`id`, `name`, `controller_name`, `Mobile_List`, `Mobile_Create`, `Mobile_Update`, `Mobile_View`, `Mobile_Delete`, `list_authorization_status`, `create_authorization_status`, `update_authorization_status`, `view_authorization_status`, `delete_authorization_status`, `parameters`, `created_at`, `updated_at`) VALUES 
('30','languages','LanguageController','1','0','0','0','0','0','0','0','0','0','[\"name_ar\",\"name_en\",\"ISO_code\",\"language_icon\",\"active\"]','2021-03-19 15:38:21','2021-03-19 16:59:09');

INSERT INTO extensions (`id`, `extension_flag_name`, `extension_module_name`, `extension_description`, `additional_extensions`, `additional_tables`, `additional_modules`, `created_at`, `updated_at`) VALUES 
('14','languages','Language','Languages','[]','[]','[]','2021-03-19 15:38:19','2021-03-19 15:38:19');

INSERT INTO languages (`id`, `name_ar`, `name_en`, `ISO_code`, `language_icon`, `active`, `sort`, `created_at`, `updated_at`) VALUES 
('1','العربية','Arabic','ar','','1','2','2020-07-14 15:27:24','2021-03-19 15:45:12');

INSERT INTO languages (`id`, `name_ar`, `name_en`, `ISO_code`, `language_icon`, `active`, `sort`, `created_at`, `updated_at`) VALUES 
('2','الانجليزية','English','en','','1','1','2020-07-14 15:27:24','2021-03-19 15:44:57');
