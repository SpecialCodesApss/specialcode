

CREATE TABLE `news_newspaper_publishers` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `country_id` bigint(20) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `newspaper_name_ar` varchar(50) NOT NULL,
  `newspaper_name_en` varchar(50) NOT NULL,
  `description_ar` text NOT NULL,
  `description_en` text NOT NULL,
  `logo_image` text NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `website_link` text,
  `facebook` varchar(200) DEFAULT NULL,
  `twitter` varchar(200) DEFAULT NULL,
  `linkedin` varchar(200) DEFAULT NULL,
  `SEO_newspaper_page_title` varchar(150) DEFAULT NULL,
  `SEO_newspaper_page_metatags` text,
  `sort` bigint(20) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;


INSERT INTO admin_sections (`id`, `parent_section_id`, `section_name_ar`, `section_name_en`, `section_icon`, `section_flag`, `controller_name`, `is_notification_able`, `is_drop_menu`, `active`, `sort`, `created_at`, `updated_at`) VALUES 
('62','','صحف النشر','newspaper publishers','far fa-clone','news_newspaper_publishers','News_newspaper_publisherController','0','0','1','35','2021-03-31 18:00:57','2021-03-31 18:00:57');

INSERT INTO api_requests (`id`, `name`, `controller_name`, `Mobile_List`, `Mobile_Create`, `Mobile_Update`, `Mobile_View`, `Mobile_Delete`, `list_authorization_status`, `create_authorization_status`, `update_authorization_status`, `view_authorization_status`, `delete_authorization_status`, `parameters`, `created_at`, `updated_at`) VALUES 
('47','news_newspaper_publishers','News_newspaper_publisherController','1','0','0','1','0','0','0','0','0','0','[\"country_id\",\"slug\",\"newspaper_name_ar\",\"newspaper_name_en\",\"description_ar\",\"description_en\",\"logo_image\",\"email\",\"website_link\",\"facebook\",\"twitter\",\"linkedin\",\"SEO_newspaper_page_title\",\"SEO_newspaper_page_metatags\",\"active\"]','2021-03-31 18:00:59','2021-03-31 18:00:59');

INSERT INTO extensions (`id`, `extension_flag_name`, `extension_module_name`, `extension_description`, `additional_extensions`, `additional_tables`, `additional_modules`, `created_at`, `updated_at`) VALUES 
('31','news_newspaper_publishers','News_newspaper_publisher','newspaper publishers','[]','[]','[]','2021-03-31 18:00:57','2021-03-31 18:00:57');

INSERT INTO news_newspaper_publishers (`id`, `country_id`, `slug`, `newspaper_name_ar`, `newspaper_name_en`, `description_ar`, `description_en`, `logo_image`, `email`, `website_link`, `facebook`, `twitter`, `linkedin`, `SEO_newspaper_page_title`, `SEO_newspaper_page_metatags`, `sort`, `active`, `created_at`, `updated_at`) VALUES 
('1','1','Youm7','اليوم السابع..','Youm7','اليوم السابع','Youm7','storage/images/news_newspaper_publishers/logo_image/20210331190136.jpg','','','','','','','','1','1','2021-03-31 18:01:36','2021-03-31 18:01:45');
