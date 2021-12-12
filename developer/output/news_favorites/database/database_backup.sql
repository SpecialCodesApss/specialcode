

CREATE TABLE `news_favorites` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `news_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;


INSERT INTO admin_sections (`id`, `parent_section_id`, `section_name_ar`, `section_name_en`, `section_icon`, `section_flag`, `controller_name`, `is_notification_able`, `is_drop_menu`, `active`, `sort`, `created_at`, `updated_at`) VALUES 
('70','','الأخبار المفضلة','favorites News','far fa-heart','news_favorites','News_favoriteController','0','0','1','40','2021-04-04 19:47:53','2021-04-04 19:47:53');

INSERT INTO api_requests (`id`, `name`, `controller_name`, `Mobile_List`, `Mobile_Create`, `Mobile_Update`, `Mobile_View`, `Mobile_Delete`, `list_authorization_status`, `create_authorization_status`, `update_authorization_status`, `view_authorization_status`, `delete_authorization_status`, `parameters`, `created_at`, `updated_at`) VALUES 
('52','news_favorites','News_favoriteController','1','1','0','0','1','1','1','0','0','1','[\"news_id\",\"user_id\"]','2021-04-04 19:47:57','2021-04-04 19:47:57');

INSERT INTO extensions (`id`, `extension_flag_name`, `extension_module_name`, `extension_description`, `additional_extensions`, `additional_tables`, `additional_modules`, `created_at`, `updated_at`) VALUES 
('36','news_favorites','News_favorite','favorites News','[]','[]','[]','2021-04-04 19:47:53','2021-04-04 19:47:53');

INSERT INTO news_favorites (`id`, `news_id`, `user_id`, `created_at`, `updated_at`) VALUES 
('1','3','1','2021-04-04 19:50:12','2021-04-04 19:50:25');

INSERT INTO news_favorites (`id`, `news_id`, `user_id`, `created_at`, `updated_at`) VALUES 
('2','2','1','2021-04-04 19:56:07','2021-04-04 19:56:07');
