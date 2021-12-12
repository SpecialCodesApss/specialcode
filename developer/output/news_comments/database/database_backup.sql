

CREATE TABLE `news_comments` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `comment_text` text NOT NULL,
  `users_likes_ids` longtext,
  `users_dislikes_ids` longtext,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;


INSERT INTO admin_sections (`id`, `parent_section_id`, `section_name_ar`, `section_name_en`, `section_icon`, `section_flag`, `controller_name`, `is_notification_able`, `is_drop_menu`, `active`, `sort`, `created_at`, `updated_at`) VALUES 
('69','','تعليقات الأخبار','News comments','empty','news_comments','News_commentController','0','0','1','39','2021-04-04 19:35:27','2021-04-04 19:35:27');

INSERT INTO api_requests (`id`, `name`, `controller_name`, `Mobile_List`, `Mobile_Create`, `Mobile_Update`, `Mobile_View`, `Mobile_Delete`, `list_authorization_status`, `create_authorization_status`, `update_authorization_status`, `view_authorization_status`, `delete_authorization_status`, `parameters`, `created_at`, `updated_at`) VALUES 
('51','news_comments','News_commentController','1','1','0','0','0','0','1','0','0','0','[\"user_id\",\"comment_text\",\"users_likes_ids\",\"users_dislikes_ids\",\"active\"]','2021-04-04 16:21:28','2021-04-04 19:34:49');

INSERT INTO extensions (`id`, `extension_flag_name`, `extension_module_name`, `extension_description`, `additional_extensions`, `additional_tables`, `additional_modules`, `created_at`, `updated_at`) VALUES 
('35','news_comments','News_comment','News_comments','[]','[]','[]','2021-04-04 16:21:25','2021-04-04 16:21:25');

INSERT INTO routes (`id`, `request_method_type`, `router_name`, `controller_name`, `controller_method`, `parameters`, `type`, `middleware`, `created_at`, `updated_at`, `expect_from_CSRF`, `active`) VALUES 
('36','get','getusersInfo_for_news_comments_forFieldusers_likes_ids','News_commentController','getusersInfo_for_news_comments_forFieldusers_likes_ids','','web_routes','admin','2021-04-04 19:25:28','2021-04-04 19:34:47','1','1');

INSERT INTO routes (`id`, `request_method_type`, `router_name`, `controller_name`, `controller_method`, `parameters`, `type`, `middleware`, `created_at`, `updated_at`, `expect_from_CSRF`, `active`) VALUES 
('37','post','checkusers_for_news_comments_forFieldusers_likes_ids','News_commentController','checkusers_for_news_comments_forFieldusers_likes_ids','','web_routes','admin','2021-04-04 19:25:28','2021-04-04 19:34:47','1','1');

INSERT INTO routes (`id`, `request_method_type`, `router_name`, `controller_name`, `controller_method`, `parameters`, `type`, `middleware`, `created_at`, `updated_at`, `expect_from_CSRF`, `active`) VALUES 
('38','post','searchusers_for_news_comments_forFieldusers_likes_ids','News_commentController','searchusers_for_news_comments_forFieldusers_likes_ids','','web_routes','admin','2021-04-04 19:25:28','2021-04-04 19:34:47','1','1');

INSERT INTO routes (`id`, `request_method_type`, `router_name`, `controller_name`, `controller_method`, `parameters`, `type`, `middleware`, `created_at`, `updated_at`, `expect_from_CSRF`, `active`) VALUES 
('39','get','getusersInfo_for_news_comments_forFieldusers_dislikes_ids','News_commentController','getusersInfo_for_news_comments_forFieldusers_dislikes_ids','','web_routes','admin','2021-04-04 19:25:28','2021-04-04 19:34:47','1','1');

INSERT INTO routes (`id`, `request_method_type`, `router_name`, `controller_name`, `controller_method`, `parameters`, `type`, `middleware`, `created_at`, `updated_at`, `expect_from_CSRF`, `active`) VALUES 
('40','post','checkusers_for_news_comments_forFieldusers_dislikes_ids','News_commentController','checkusers_for_news_comments_forFieldusers_dislikes_ids','','web_routes','admin','2021-04-04 19:25:28','2021-04-04 19:34:47','1','1');

INSERT INTO routes (`id`, `request_method_type`, `router_name`, `controller_name`, `controller_method`, `parameters`, `type`, `middleware`, `created_at`, `updated_at`, `expect_from_CSRF`, `active`) VALUES 
('41','post','searchusers_for_news_comments_forFieldusers_dislikes_ids','News_commentController','searchusers_for_news_comments_forFieldusers_dislikes_ids','','web_routes','admin','2021-04-04 19:25:28','2021-04-04 19:34:47','1','1');

INSERT INTO news_comments (`id`, `user_id`, `comment_text`, `users_likes_ids`, `users_dislikes_ids`, `active`, `created_at`, `updated_at`) VALUES 
('1','1','تعليق جيد جدا','[\"admin@admin.com\"]','[\"admin@s.com\"]','1','2021-04-04 19:36:09','2021-04-04 19:36:57');

INSERT INTO news_comments (`id`, `user_id`, `comment_text`, `users_likes_ids`, `users_dislikes_ids`, `active`, `created_at`, `updated_at`) VALUES 
('2','1','عمل جيد جدا','','','0','2021-04-04 19:42:35','2021-04-04 19:42:35');
