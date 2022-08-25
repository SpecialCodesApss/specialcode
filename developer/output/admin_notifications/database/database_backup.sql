

CREATE TABLE `admin_notifications` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `notification_id` bigint(20) NOT NULL,
  `module_id` bigint(20) NOT NULL,
  `is_marked_as_readed` tinyint(4) NOT NULL DEFAULT '0',
  `is_marked_as_deleted` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;


INSERT INTO admin_sections (`id`, `parent_section_id`, `section_name_ar`, `section_name_en`, `section_icon`, `section_flag`, `controller_name`, `module_name`, `is_notification_able`, `is_drop_menu`, `active`, `sort`, `created_at`, `updated_at`) VALUES 
('14','','اشعارات الإدارة','Admin notifications','fas fa-bell','admin_notifications','Admin_notificationController','Admin_notification','0','0','1','11','2022-01-15 18:03:59','2022-01-15 18:03:59');

INSERT INTO api_requests (`id`, `name`, `controller_name`, `Mobile_List`, `Mobile_Create`, `Mobile_Update`, `Mobile_View`, `Mobile_Delete`, `list_authorization_status`, `create_authorization_status`, `update_authorization_status`, `view_authorization_status`, `delete_authorization_status`, `parameters`, `created_at`, `updated_at`) VALUES 
('7','admin_notifications','Admin_notificationController','1','1','1','1','1','0','1','1','0','1','[\"notification_id\",\"model_id\",\"is_marked_as_readed\",\"is_marked_as_deleted\"]','2022-01-15 18:04:10','2022-01-15 18:04:10');

INSERT INTO extensions (`id`, `extension_flag_name`, `extension_module_name`, `extension_description`, `additional_extensions`, `additional_tables`, `additional_modules`, `created_at`, `updated_at`) VALUES 
('7','admin_notifications','Admin_notification','Admin notifications','[]','[]','[]','2022-01-15 18:03:59','2022-01-15 18:03:59');

INSERT INTO admin_notifications (`id`, `notification_id`, `module_id`, `is_marked_as_readed`, `is_marked_as_deleted`, `created_at`, `updated_at`) VALUES 
('1','1','1','0','0','2022-01-15 20:00:16','2022-01-18 04:29:11');

INSERT INTO admin_notifications (`id`, `notification_id`, `module_id`, `is_marked_as_readed`, `is_marked_as_deleted`, `created_at`, `updated_at`) VALUES 
('2','1','1','0','0','2022-01-15 20:27:18','2022-01-18 04:29:12');

INSERT INTO admin_notifications (`id`, `notification_id`, `module_id`, `is_marked_as_readed`, `is_marked_as_deleted`, `created_at`, `updated_at`) VALUES 
('3','1','49','0','0','2022-01-15 20:32:37','2022-01-18 04:29:14');

INSERT INTO admin_notifications (`id`, `notification_id`, `module_id`, `is_marked_as_readed`, `is_marked_as_deleted`, `created_at`, `updated_at`) VALUES 
('4','1','50','0','0','2022-01-15 20:43:32','2022-01-18 04:29:15');

INSERT INTO admin_notifications (`id`, `notification_id`, `module_id`, `is_marked_as_readed`, `is_marked_as_deleted`, `created_at`, `updated_at`) VALUES 
('5','5','1','0','0','2022-01-15 21:31:54','2022-01-18 04:29:16');

INSERT INTO admin_notifications (`id`, `notification_id`, `module_id`, `is_marked_as_readed`, `is_marked_as_deleted`, `created_at`, `updated_at`) VALUES 
('6','5','2','0','0','2022-01-15 21:35:02','2022-01-18 04:29:17');
