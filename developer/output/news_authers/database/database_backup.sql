

CREATE TABLE `news_authers` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `country_id` bigint(20) DEFAULT NULL,
  `slug` varchar(50) NOT NULL,
  `name_ar` varchar(50) NOT NULL,
  `name_en` varchar(50) NOT NULL,
  `work_title` varchar(50) DEFAULT NULL,
  `Biographical_info_ar` text,
  `Biographical_info_en` text,
  `profile_image` text,
  `email` varchar(150) DEFAULT NULL,
  `website_link` text,
  `facebook` text,
  `twitter` text,
  `linkedin` varchar(250) DEFAULT NULL,
  `SEO_auther_page_title` varchar(200) DEFAULT NULL,
  `SEO_auther_page_metatags` text,
  `sort` bigint(20) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;


INSERT INTO admin_sections (`id`, `parent_section_id`, `section_name_ar`, `section_name_en`, `section_icon`, `section_flag`, `controller_name`, `is_notification_able`, `is_drop_menu`, `active`, `sort`, `created_at`, `updated_at`) VALUES 
('59','','المحررين','Authers','fas fa-eye-dropper','news_authers','News_autherController','0','0','1','32','2021-03-31 17:12:04','2021-03-31 17:12:04');

INSERT INTO api_requests (`id`, `name`, `controller_name`, `Mobile_List`, `Mobile_Create`, `Mobile_Update`, `Mobile_View`, `Mobile_Delete`, `list_authorization_status`, `create_authorization_status`, `update_authorization_status`, `view_authorization_status`, `delete_authorization_status`, `parameters`, `created_at`, `updated_at`) VALUES 
('44','news_authers','News_autherController','1','0','0','1','0','1','0','0','1','0','[\"country_id\",\"slug\",\"name_ar\",\"name_en\",\"work_title\",\"Biographical_info_ar\",\"Biographical_info_en\",\"profile_image\",\"email\",\"website_link\",\"facebook\",\"twitter\",\"linkedin\",\"SEO_auther_page_title\",\"SEO_auther_page_metatags\",\"active\"]','2021-03-31 17:12:06','2021-03-31 17:12:06');

INSERT INTO extensions (`id`, `extension_flag_name`, `extension_module_name`, `extension_description`, `additional_extensions`, `additional_tables`, `additional_modules`, `created_at`, `updated_at`) VALUES 
('28','news_authers','News_auther','Authers','[]','[]','[]','2021-03-31 17:12:04','2021-03-31 17:12:04');

INSERT INTO news_authers (`id`, `country_id`, `slug`, `name_ar`, `name_en`, `work_title`, `Biographical_info_ar`, `Biographical_info_en`, `profile_image`, `email`, `website_link`, `facebook`, `twitter`, `linkedin`, `SEO_auther_page_title`, `SEO_auther_page_metatags`, `sort`, `active`, `created_at`, `updated_at`) VALUES 
('1','1','aaa','احمد علاء','Ahmed Alaa','','محرر حر يعمل بالجريدة','محرر حر يعمل بالجريدة','storage/images/news_authers/profile_image/20210331182627.jpg','http://google.com/','http://google.com/','http://google.com/','http://google.com/','http://google.com/','','','1','1','2021-03-31 17:26:10','2021-04-01 07:24:13');
