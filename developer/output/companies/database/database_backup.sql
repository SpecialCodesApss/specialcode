

CREATE TABLE `companies` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `categories` text,
  `country_id` bigint(20) NOT NULL,
  `city_id` bigint(20) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `company_name_ar` varchar(50) NOT NULL,
  `company_name_en` varchar(50) NOT NULL,
  `description_ar` text NOT NULL,
  `description_en` text NOT NULL,
  `logo_image` text NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `phone_number` varchar(50) DEFAULT NULL,
  `whatsapp_number` varchar(50) DEFAULT NULL,
  `website_link` text,
  `address` text,
  `lat` varchar(50) DEFAULT NULL,
  `lng` varchar(50) DEFAULT NULL,
  `facebook` varchar(200) DEFAULT NULL,
  `twitter` varchar(200) DEFAULT NULL,
  `linkedin` varchar(200) DEFAULT NULL,
  `youtube` varchar(200) DEFAULT NULL,
  `SEO_company_page_title` varchar(150) DEFAULT NULL,
  `SEO_company_page_metatags` text,
  `is_recommended` tinyint(1) NOT NULL DEFAULT '0',
  `views_count` bigint(20) NOT NULL DEFAULT '0',
  `sort` bigint(20) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;



CREATE TABLE `companies_categories` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `parent_category_id` bigint(20) DEFAULT NULL,
  `slug` varchar(50) NOT NULL,
  `name_ar` varchar(50) NOT NULL,
  `name_en` varchar(50) NOT NULL,
  `description_ar` text NOT NULL,
  `description_en` text NOT NULL,
  `category_image` text,
  `category_icon` text,
  `sort` bigint(20) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;



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
('52','55','تصنيفات الشركات','Companies categories','fas fa-bezier-curve','companies_categories','Companies_categorieController','0','0','1','25','2021-03-28 17:27:26','2021-03-28 17:27:26');

INSERT INTO admin_sections (`id`, `parent_section_id`, `section_name_ar`, `section_name_en`, `section_icon`, `section_flag`, `controller_name`, `is_notification_able`, `is_drop_menu`, `active`, `sort`, `created_at`, `updated_at`) VALUES 
('53','55','الشركات','Companies','fas fa-hospital-alt','companies','CompanieController','0','0','1','26','2021-03-28 18:42:04','2021-03-28 18:42:04');

INSERT INTO admin_sections (`id`, `parent_section_id`, `section_name_ar`, `section_name_en`, `section_icon`, `section_flag`, `controller_name`, `is_notification_able`, `is_drop_menu`, `active`, `sort`, `created_at`, `updated_at`) VALUES 
('54','55','تقييمات الشركات','Companies reviews','fas fa-star-half-alt','companies_reviews','Companies_reviewController','0','0','1','27','2021-03-30 13:13:09','2021-03-30 13:13:09');

INSERT INTO admin_sections (`id`, `parent_section_id`, `section_name_ar`, `section_name_en`, `section_icon`, `section_flag`, `controller_name`, `is_notification_able`, `is_drop_menu`, `active`, `sort`, `created_at`, `updated_at`) VALUES 
('55','','الشركات','Companies','fas fa-hospital-alt','companies','CompanieController','0','1','1','26','2021-03-28 18:42:04','2021-03-28 18:42:04');

INSERT INTO api_requests (`id`, `name`, `controller_name`, `Mobile_List`, `Mobile_Create`, `Mobile_Update`, `Mobile_View`, `Mobile_Delete`, `list_authorization_status`, `create_authorization_status`, `update_authorization_status`, `view_authorization_status`, `delete_authorization_status`, `parameters`, `created_at`, `updated_at`) VALUES 
('39','companies_categories','Companies_categorieController','1','0','0','0','0','0','0','0','0','0','[\"parent_category_id\",\"slug\",\"name_ar\",\"name_en\",\"description_ar\",\"description_en\",\"category_image\",\"category_icon\",\"active\"]','2021-03-28 17:27:28','2021-03-28 17:27:28');

INSERT INTO api_requests (`id`, `name`, `controller_name`, `Mobile_List`, `Mobile_Create`, `Mobile_Update`, `Mobile_View`, `Mobile_Delete`, `list_authorization_status`, `create_authorization_status`, `update_authorization_status`, `view_authorization_status`, `delete_authorization_status`, `parameters`, `created_at`, `updated_at`) VALUES 
('40','companies','CompanieController','1','1','0','1','0','0','1','0','0','0','[\"categories\",\"country_id\",\"city_id\",\"slug\",\"company_name_ar\",\"company_name_en\",\"description_ar\",\"description_en\",\"logo_image\",\"email\",\"phone_number\",\"whatsapp_number\",\"website_link\",\"address\",\"lat\",\"lng\",\"facebook\",\"twitter\",\"linkedin\",\"youtube\",\"SEO_company_page_title\",\"SEO_company_page_metatags\",\"is_recommended\",\"views_count\",\"active\"]','2021-03-28 18:42:06','2021-03-28 18:42:06');

INSERT INTO api_requests (`id`, `name`, `controller_name`, `Mobile_List`, `Mobile_Create`, `Mobile_Update`, `Mobile_View`, `Mobile_Delete`, `list_authorization_status`, `create_authorization_status`, `update_authorization_status`, `view_authorization_status`, `delete_authorization_status`, `parameters`, `created_at`, `updated_at`) VALUES 
('41','companies_reviews','Companies_reviewController','1','1','0','0','0','0','1','0','0','0','[\"company_id\",\"user_id\",\"rate_stars_count\",\"comment\",\"users_likes_ids\",\"users_dislikes_ids\",\"active\"]','2021-03-30 13:14:28','2021-03-30 13:14:28');

INSERT INTO extensions (`id`, `extension_flag_name`, `extension_module_name`, `extension_description`, `additional_extensions`, `additional_tables`, `additional_modules`, `created_at`, `updated_at`) VALUES 
('24','companies','Companie','Companies','[\"companies_categories\",\"companies_reviews\"]','[]','[\"companies_categories\",\"companies_reviews\"]','2021-03-28 18:42:04','2021-03-31 12:56:53');

INSERT INTO routes (`id`, `request_method_type`, `router_name`, `controller_name`, `controller_method`, `parameters`, `type`, `middleware`, `created_at`, `updated_at`, `expect_from_CSRF`, `active`) VALUES 
('22','get','get_Variables_for_companies_store','CompanieController','get_Variables_for_companies_store','','api_routes','','2021-03-17 02:15:06','2021-03-29 17:15:27','1','1');

INSERT INTO routes (`id`, `request_method_type`, `router_name`, `controller_name`, `controller_method`, `parameters`, `type`, `middleware`, `created_at`, `updated_at`, `expect_from_CSRF`, `active`) VALUES 
('23','post','get_CountryCites_for_companies_store','CompanieController','get_CountryCites_for_companies_store','','api_routes','','2021-03-17 02:15:06','2021-03-29 17:24:30','1','1');

INSERT INTO routes (`id`, `request_method_type`, `router_name`, `controller_name`, `controller_method`, `parameters`, `type`, `middleware`, `created_at`, `updated_at`, `expect_from_CSRF`, `active`) VALUES 
('24','post','get_CountryCites_for_companies_store_Admin','CompanieController','get_CountryCites_for_companies_store_Admin','','web_routes','admin','2021-03-17 02:15:06','2021-03-29 17:24:30','1','1');

INSERT INTO companies (`id`, `categories`, `country_id`, `city_id`, `slug`, `company_name_ar`, `company_name_en`, `description_ar`, `description_en`, `logo_image`, `email`, `phone_number`, `whatsapp_number`, `website_link`, `address`, `lat`, `lng`, `facebook`, `twitter`, `linkedin`, `youtube`, `SEO_company_page_title`, `SEO_company_page_metatags`, `is_recommended`, `views_count`, `sort`, `active`, `created_at`, `updated_at`) VALUES 
('1','[\"1\"]','1','1','111','222','333','4','5','storage/images/companies/logo_image/20210328184323.jpg','6','7','8','9','10','11','12','13','14','15','16','17','18','1','0','1','1','2021-03-28 18:43:23','2021-03-28 18:44:22');

INSERT INTO companies (`id`, `categories`, `country_id`, `city_id`, `slug`, `company_name_ar`, `company_name_en`, `description_ar`, `description_en`, `logo_image`, `email`, `phone_number`, `whatsapp_number`, `website_link`, `address`, `lat`, `lng`, `facebook`, `twitter`, `linkedin`, `youtube`, `SEO_company_page_title`, `SEO_company_page_metatags`, `is_recommended`, `views_count`, `sort`, `active`, `created_at`, `updated_at`) VALUES 
('3','[1]','2','4','gyy','g','h','h','b','storage/images/companies/logo_image/20210329155259.jpg','h','6','5','6','g','1','1','7','6','y','y','','','0','0','0','1','2021-03-29 15:52:59','2021-03-29 18:55:05');

INSERT INTO companies (`id`, `categories`, `country_id`, `city_id`, `slug`, `company_name_ar`, `company_name_en`, `description_ar`, `description_en`, `logo_image`, `email`, `phone_number`, `whatsapp_number`, `website_link`, `address`, `lat`, `lng`, `facebook`, `twitter`, `linkedin`, `youtube`, `SEO_company_page_title`, `SEO_company_page_metatags`, `is_recommended`, `views_count`, `sort`, `active`, `created_at`, `updated_at`) VALUES 
('4','[\"1\"]','2','4','00','00','00','00','00','storage/images/companies/logo_image/20210329173635.jpg','00','0','0','0','0','0','0','0','0','0','0','0','0','1','0','3','1','2021-03-29 17:36:35','2021-03-29 17:36:35');

INSERT INTO companies_categories (`id`, `parent_category_id`, `slug`, `name_ar`, `name_en`, `description_ar`, `description_en`, `category_image`, `category_icon`, `sort`, `active`, `created_at`, `updated_at`) VALUES 
('1','','basic_category','التصنيف الرئيسي','Basic Category','التصنيف الرئيسي','Basic Category','storage/images/companies_categories/category_image/20210328180956.jpg','','1','1','2021-03-28 18:09:56','2021-03-28 21:10:41');

INSERT INTO companies_categories (`id`, `parent_category_id`, `slug`, `name_ar`, `name_en`, `description_ar`, `description_en`, `category_image`, `category_icon`, `sort`, `active`, `created_at`, `updated_at`) VALUES 
('2','1','sub_category','التصنيف الفرعي','sub category','التصنيف الفرعي','sub_category','storage/images/companies_categories/category_image/20210328181029.jpg','','2','1','2021-03-28 18:10:29','2021-03-28 21:10:58');

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
