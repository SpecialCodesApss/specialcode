

CREATE TABLE `notifications_texts` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `description_text_en` text NOT NULL,
  `description_text_ar` text NOT NULL,
  `module_name` varchar(50) NOT NULL,
  `target_url` text NOT NULL,
  `icon` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;


INSERT INTO admin_sections (`id`, `parent_section_id`, `section_name_ar`, `section_name_en`, `section_icon`, `section_flag`, `controller_name`, `module_name`, `is_notification_able`, `is_drop_menu`, `active`, `sort`, `created_at`, `updated_at`) VALUES 
('15','','نصوص الاشعارات','Notifications_texts','fab fa-accusoft','notifications_texts','Notifications_textController','Notifications_text','0','0','0','12','2022-01-15 18:08:05','2022-01-15 18:08:05');

INSERT INTO api_requests (`id`, `name`, `controller_name`, `Mobile_List`, `Mobile_Create`, `Mobile_Update`, `Mobile_View`, `Mobile_Delete`, `list_authorization_status`, `create_authorization_status`, `update_authorization_status`, `view_authorization_status`, `delete_authorization_status`, `parameters`, `created_at`, `updated_at`) VALUES 
('8','notifications_texts','Notifications_textController','1','1','1','1','1','0','1','1','0','1','[\"description_text_en\",\"description_text_ar\",\"trarget_url\",\"icon\"]','2022-01-15 18:08:10','2022-01-15 18:08:10');

INSERT INTO extensions (`id`, `extension_flag_name`, `extension_module_name`, `extension_description`, `additional_extensions`, `additional_tables`, `additional_modules`, `created_at`, `updated_at`) VALUES 
('8','notifications_texts','Notifications_text','Notifications_texts','[]','[]','[]','2022-01-15 18:08:05','2022-01-15 18:08:05');

INSERT INTO notifications_texts (`id`, `description_text_en`, `description_text_ar`, `module_name`, `target_url`, `icon`, `created_at`, `updated_at`) VALUES 
('1','new registered user','تم تسجيل مستخدم جديد','users','admin/users/##module_id##/edit','user','2022-01-15 19:53:19','2022-01-16 00:43:47');

INSERT INTO notifications_texts (`id`, `description_text_en`, `description_text_ar`, `module_name`, `target_url`, `icon`, `created_at`, `updated_at`) VALUES 
('5','new product info added','تم إضافة منتج جديد','products','admin/products/##module_id##/edit','','2022-01-15 21:31:23','2022-01-16 00:43:53');
