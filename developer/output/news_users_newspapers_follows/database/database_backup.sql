

CREATE TABLE `news_users_newspapers_follows` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `newspaper_id` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;


INSERT INTO admin_sections (`id`, `parent_section_id`, `section_name_ar`, `section_name_en`, `section_icon`, `section_flag`, `controller_name`, `is_notification_able`, `is_drop_menu`, `active`, `sort`, `created_at`, `updated_at`) VALUES 
('63','','الصحف المتابعة للمستخدمين','newspapers users follows','fab fa-twitter','news_users_newspapers_follows','News_users_newspapers_followController','0','0','1','36','2021-03-31 18:07:19','2021-03-31 18:07:19');

INSERT INTO api_requests (`id`, `name`, `controller_name`, `Mobile_List`, `Mobile_Create`, `Mobile_Update`, `Mobile_View`, `Mobile_Delete`, `list_authorization_status`, `create_authorization_status`, `update_authorization_status`, `view_authorization_status`, `delete_authorization_status`, `parameters`, `created_at`, `updated_at`) VALUES 
('48','news_users_newspapers_follows','News_users_newspapers_followController','1','1','0','0','1','1','1','0','0','1','[\"user_id\",\"newspaper_id\"]','2021-03-31 18:07:21','2021-03-31 18:07:21');

INSERT INTO extensions (`id`, `extension_flag_name`, `extension_module_name`, `extension_description`, `additional_extensions`, `additional_tables`, `additional_modules`, `created_at`, `updated_at`) VALUES 
('32','news_users_newspapers_follows','News_users_newspapers_follow','newspapers users follows','[]','[]','[]','2021-03-31 18:07:19','2021-03-31 18:07:19');

INSERT INTO news_users_newspapers_follows (`id`, `user_id`, `newspaper_id`, `created_at`, `updated_at`) VALUES 
('1','2','1','2021-03-31 18:07:34','2021-03-31 18:07:42');
