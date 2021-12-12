

CREATE TABLE `companies_reviews` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `company_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `rate_stars_count` enum('1','2','3','4','5') NOT NULL,
  `comment` text,
  `users_likes_ids` longtext,
  `users_dislikes_ids` longtext,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;


INSERT INTO admin_sections (`id`, `parent_section_id`, `section_name_ar`, `section_name_en`, `section_icon`, `section_flag`, `controller_name`, `is_notification_able`, `is_drop_menu`, `active`, `sort`, `created_at`, `updated_at`) VALUES 
('54','55','تقييمات الشركات','Companies reviews','fas fa-star-half-alt','companies_reviews','Companies_reviewController','0','0','1','27','2021-03-30 13:13:09','2021-03-30 13:13:09');

INSERT INTO api_requests (`id`, `name`, `controller_name`, `Mobile_List`, `Mobile_Create`, `Mobile_Update`, `Mobile_View`, `Mobile_Delete`, `list_authorization_status`, `create_authorization_status`, `update_authorization_status`, `view_authorization_status`, `delete_authorization_status`, `parameters`, `created_at`, `updated_at`) VALUES 
('41','companies_reviews','Companies_reviewController','1','1','0','0','0','0','1','0','0','0','[\"company_id\",\"user_id\",\"rate_stars_count\",\"comment\",\"users_likes_ids\",\"users_dislikes_ids\",\"active\"]','2021-03-30 13:14:28','2021-03-30 13:14:28');

INSERT INTO extensions (`id`, `extension_flag_name`, `extension_module_name`, `extension_description`, `additional_extensions`, `additional_tables`, `additional_modules`, `created_at`, `updated_at`) VALUES 
('25','companies_reviews','Companies_review','Companies reviews','[]','[]','[]','2021-03-30 13:13:09','2021-03-30 13:13:09');

INSERT INTO routes (`id`, `request_method_type`, `router_name`, `controller_name`, `controller_method`, `parameters`, `type`, `middleware`, `created_at`, `updated_at`, `expect_from_CSRF`, `active`) VALUES 
('25','get','getusersInfo_for_companies_reviews','Companies_reviewController','getusersInfo_for_companies_reviews','','web_routes','admin','2021-03-30 13:13:09','2021-03-30 13:13:09','1','1');

INSERT INTO routes (`id`, `request_method_type`, `router_name`, `controller_name`, `controller_method`, `parameters`, `type`, `middleware`, `created_at`, `updated_at`, `expect_from_CSRF`, `active`) VALUES 
('26','post','checkusers_for_companies_reviews','Companies_reviewController','checkusers_for_companies_reviews','','web_routes','admin','2021-03-30 13:13:09','2021-03-30 13:13:09','1','1');

INSERT INTO routes (`id`, `request_method_type`, `router_name`, `controller_name`, `controller_method`, `parameters`, `type`, `middleware`, `created_at`, `updated_at`, `expect_from_CSRF`, `active`) VALUES 
('27','post','searchusers_for_companies_reviews','Companies_reviewController','searchusers_for_companies_reviews','','web_routes','admin','2021-03-30 13:13:09','2021-03-30 13:13:09','1','1');

INSERT INTO routes (`id`, `request_method_type`, `router_name`, `controller_name`, `controller_method`, `parameters`, `type`, `middleware`, `created_at`, `updated_at`, `expect_from_CSRF`, `active`) VALUES 
('28','post','checkusers_for_companies_reviews_forFieldusers_likes_ids','Companies_reviewController','checkusers_for_companies_reviews_forFieldusers_likes_ids','','web_routes','admin','2021-03-30 16:17:39','2021-03-30 16:17:39','1','1');

INSERT INTO routes (`id`, `request_method_type`, `router_name`, `controller_name`, `controller_method`, `parameters`, `type`, `middleware`, `created_at`, `updated_at`, `expect_from_CSRF`, `active`) VALUES 
('29','post','searchusers_for_companies_reviews_forFieldusers_likes_ids','Companies_reviewController','searchusers_for_companies_reviews_forFieldusers_likes_ids','','web_routes','admin','2021-03-30 16:17:39','2021-03-30 16:17:39','1','1');

INSERT INTO routes (`id`, `request_method_type`, `router_name`, `controller_name`, `controller_method`, `parameters`, `type`, `middleware`, `created_at`, `updated_at`, `expect_from_CSRF`, `active`) VALUES 
('30','post','checkusers_for_companies_reviews_forFieldusers_dislikes_ids','Companies_reviewController','checkusers_for_companies_reviews_forFieldusers_dislikes_ids','','web_routes','admin','2021-03-30 16:17:39','2021-03-30 16:17:39','1','1');

INSERT INTO routes (`id`, `request_method_type`, `router_name`, `controller_name`, `controller_method`, `parameters`, `type`, `middleware`, `created_at`, `updated_at`, `expect_from_CSRF`, `active`) VALUES 
('31','post','searchusers_for_companies_reviews_forFieldusers_dislikes_ids','Companies_reviewController','searchusers_for_companies_reviews_forFieldusers_dislikes_ids','','web_routes','admin','2021-03-30 16:17:39','2021-03-30 16:17:39','1','1');

INSERT INTO routes (`id`, `request_method_type`, `router_name`, `controller_name`, `controller_method`, `parameters`, `type`, `middleware`, `created_at`, `updated_at`, `expect_from_CSRF`, `active`) VALUES 
('32','get','getusersInfo_for_companies_reviews_forFieldusers_likes_ids','Companies_reviewController','getusersInfo_for_companies_reviews_forFieldusers_likes_ids','','web_routes','admin','2021-03-30 16:49:16','2021-03-30 16:49:16','1','1');

INSERT INTO routes (`id`, `request_method_type`, `router_name`, `controller_name`, `controller_method`, `parameters`, `type`, `middleware`, `created_at`, `updated_at`, `expect_from_CSRF`, `active`) VALUES 
('33','get','getusersInfo_for_companies_reviews_forFieldusers_dislikes_ids','Companies_reviewController','getusersInfo_for_companies_reviews_forFieldusers_dislikes_ids','','web_routes','admin','2021-03-30 16:49:16','2021-03-30 16:49:16','1','1');

INSERT INTO companies_reviews (`id`, `company_id`, `user_id`, `rate_stars_count`, `comment`, `users_likes_ids`, `users_dislikes_ids`, `active`, `created_at`, `updated_at`) VALUES 
('1','1','1','1','aaa','[\"admin@admin.com\"]','[\"admin@s.com\"]','1','2021-03-30 13:16:39','2021-03-30 13:17:53');

INSERT INTO companies_reviews (`id`, `company_id`, `user_id`, `rate_stars_count`, `comment`, `users_likes_ids`, `users_dislikes_ids`, `active`, `created_at`, `updated_at`) VALUES 
('2','3','2','4','asda','[\"admin@admin.com\",\"a@b.c\"]','[\"admin@s.com\"]','1','2021-03-30 15:59:34','2021-03-30 17:07:16');

INSERT INTO companies_reviews (`id`, `company_id`, `user_id`, `rate_stars_count`, `comment`, `users_likes_ids`, `users_dislikes_ids`, `active`, `created_at`, `updated_at`) VALUES 
('3','1','1','1','اات','','','0','2021-03-30 17:41:51','2021-03-30 17:41:51');

INSERT INTO companies_reviews (`id`, `company_id`, `user_id`, `rate_stars_count`, `comment`, `users_likes_ids`, `users_dislikes_ids`, `active`, `created_at`, `updated_at`) VALUES 
('4','1','1','4','tyi','','','0','2021-03-31 09:40:15','2021-03-31 09:40:15');

INSERT INTO companies_reviews (`id`, `company_id`, `user_id`, `rate_stars_count`, `comment`, `users_likes_ids`, `users_dislikes_ids`, `active`, `created_at`, `updated_at`) VALUES 
('5','1','1','4','جيد','','','0','2021-03-31 09:54:21','2021-03-31 09:54:21');
