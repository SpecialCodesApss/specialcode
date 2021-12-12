

CREATE TABLE `news_users_notifications_settings` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `active_notification` tinyint(1) NOT NULL DEFAULT '1',
  `notification_type` enum('every day','every week','every month') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;


INSERT INTO admin_sections (`id`, `parent_section_id`, `section_name_ar`, `section_name_en`, `section_icon`, `section_flag`, `controller_name`, `is_notification_able`, `is_drop_menu`, `active`, `sort`, `created_at`, `updated_at`) VALUES 
('64','','إعدادات إشعارات الأخبار','News notifications settings','fas fa-cogs','news_users_notifications_settings','News_users_notifications_settingController','0','0','1','37','2021-04-01 06:32:24','2021-04-01 06:32:24');

INSERT INTO api_requests (`id`, `name`, `controller_name`, `Mobile_List`, `Mobile_Create`, `Mobile_Update`, `Mobile_View`, `Mobile_Delete`, `list_authorization_status`, `create_authorization_status`, `update_authorization_status`, `view_authorization_status`, `delete_authorization_status`, `parameters`, `created_at`, `updated_at`) VALUES 
('49','news_users_notifications_settings','News_users_notifications_settingController','1','0','1','1','0','1','0','1','1','0','[\"user_id\",\"active_notification\",\"notification_type\"]','2021-04-01 06:36:22','2021-04-01 12:03:52');

INSERT INTO extensions (`id`, `extension_flag_name`, `extension_module_name`, `extension_description`, `additional_extensions`, `additional_tables`, `additional_modules`, `created_at`, `updated_at`) VALUES 
('33','news_users_notifications_settings','News_users_notifications_setting','News_users_notifications_settings','[]','[]','[]','2021-04-01 06:32:24','2021-04-01 06:32:24');

INSERT INTO news_users_notifications_settings (`id`, `user_id`, `active_notification`, `notification_type`, `created_at`, `updated_at`) VALUES 
('1','1','1','every week','2021-04-01 06:36:41','2021-04-01 12:29:17');
