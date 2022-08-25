

CREATE TABLE `contacts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `flag` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ar` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon_text` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` longtext COLLATE utf8mb4_unicode_ci,
  `value_ar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `sort` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO admin_sections (`id`, `parent_section_id`, `section_name_ar`, `section_name_en`, `section_icon`, `section_flag`, `controller_name`, `module_name`, `is_notification_able`, `is_drop_menu`, `active`, `sort`, `created_at`, `updated_at`) VALUES 
('18','','بيانات التواصل','Contacts','fas fa-headphones-alt','contacts','ContactController','Contact','0','0','1','14','2022-01-18 02:42:31','2022-01-18 02:42:31');

INSERT INTO api_requests (`id`, `name`, `controller_name`, `Mobile_List`, `Mobile_Create`, `Mobile_Update`, `Mobile_View`, `Mobile_Delete`, `list_authorization_status`, `create_authorization_status`, `update_authorization_status`, `view_authorization_status`, `delete_authorization_status`, `parameters`, `created_at`, `updated_at`) VALUES 
('11','contacts','ContactController','1','1','1','1','1','0','1','1','0','1','[\"flag\",\"name_ar\",\"name_en\",\"icon_text\",\"image\",\"value_ar\",\"value_en\",\"active\"]','2022-01-18 02:42:36','2022-01-18 02:42:36');

INSERT INTO extensions (`id`, `extension_flag_name`, `extension_module_name`, `extension_description`, `additional_extensions`, `additional_tables`, `additional_modules`, `created_at`, `updated_at`) VALUES 
('11','contacts','Contact','Contacts','[]','[]','[]','2022-01-18 02:42:31','2022-01-18 02:42:31');

INSERT INTO contacts (`id`, `flag`, `name_ar`, `name_en`, `icon_text`, `image`, `value_ar`, `value_en`, `active`, `sort`, `created_at`, `updated_at`) VALUES 
('1','email','البريد الالكتروني','Email','mail','','Info@framework.com','Info@framework.com','1','1','2020-02-19 01:07:20','2020-02-19 01:07:20');

INSERT INTO contacts (`id`, `flag`, `name_ar`, `name_en`, `icon_text`, `image`, `value_ar`, `value_en`, `active`, `sort`, `created_at`, `updated_at`) VALUES 
('2','mobile','الموبايل / الجوال','Mobile','mobile','','0512345678','0512345678','1','1','2020-02-19 01:07:21','2020-02-19 01:07:21');

INSERT INTO contacts (`id`, `flag`, `name_ar`, `name_en`, `icon_text`, `image`, `value_ar`, `value_en`, `active`, `sort`, `created_at`, `updated_at`) VALUES 
('3','address','العنوان','Address','address','','جدة - السعودية','Jeddah , Ksa','1','1','2020-02-19 01:07:21','2020-02-19 01:07:21');

INSERT INTO contacts (`id`, `flag`, `name_ar`, `name_en`, `icon_text`, `image`, `value_ar`, `value_en`, `active`, `sort`, `created_at`, `updated_at`) VALUES 
('4','facebook','الفيسبوك','facebook','facebook','','https://facebook.com/','https://facebook.com/','1','1','2020-02-19 01:07:21','2020-02-19 01:07:21');

INSERT INTO contacts (`id`, `flag`, `name_ar`, `name_en`, `icon_text`, `image`, `value_ar`, `value_en`, `active`, `sort`, `created_at`, `updated_at`) VALUES 
('5','twitter','تويتر','twitter','twitter','','https://twitter.com/','https://twitter.com/','1','1','2020-02-19 01:07:21','2020-02-19 01:07:21');

INSERT INTO contacts (`id`, `flag`, `name_ar`, `name_en`, `icon_text`, `image`, `value_ar`, `value_en`, `active`, `sort`, `created_at`, `updated_at`) VALUES 
('6','instagram','انستجرام','instagram','instagram','','https://instagram.com/','https://instagram.com/','1','1','2020-02-19 01:07:21','2020-02-19 01:07:21');

INSERT INTO contacts (`id`, `flag`, `name_ar`, `name_en`, `icon_text`, `image`, `value_ar`, `value_en`, `active`, `sort`, `created_at`, `updated_at`) VALUES 
('7','snapchat','سناب شات','snapchat','snapchat','','https://snapchat.com/','https://snapchat.com/','1','1','2020-02-19 01:07:21','2020-02-19 01:07:21');

INSERT INTO contacts (`id`, `flag`, `name_ar`, `name_en`, `icon_text`, `image`, `value_ar`, `value_en`, `active`, `sort`, `created_at`, `updated_at`) VALUES 
('8','googleplay','جوجل بلاي','googleplay','googleplay','','https://googleplay.com/','https://googleplay.com/','1','1','2020-02-19 01:07:22','2020-02-19 01:07:22');

INSERT INTO contacts (`id`, `flag`, `name_ar`, `name_en`, `icon_text`, `image`, `value_ar`, `value_en`, `active`, `sort`, `created_at`, `updated_at`) VALUES 
('9','appstore','اب ستور','appstore','appstore','','https://appstore.com/','https://appstore.com/','1','1','2020-02-19 01:07:22','2022-01-18 02:51:16');
