

CREATE TABLE `news_categories` (
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


INSERT INTO admin_sections (`id`, `parent_section_id`, `section_name_ar`, `section_name_en`, `section_icon`, `section_flag`, `controller_name`, `is_notification_able`, `is_drop_menu`, `active`, `sort`, `created_at`, `updated_at`) VALUES 
('60','','تصنيفات الأخبار','News categories','fab fa-accusoft','news_categories','News_categorieController','0','0','1','33','2021-03-31 17:37:41','2021-03-31 17:37:41');

INSERT INTO api_requests (`id`, `name`, `controller_name`, `Mobile_List`, `Mobile_Create`, `Mobile_Update`, `Mobile_View`, `Mobile_Delete`, `list_authorization_status`, `create_authorization_status`, `update_authorization_status`, `view_authorization_status`, `delete_authorization_status`, `parameters`, `created_at`, `updated_at`) VALUES 
('45','news_categories','News_categorieController','1','0','0','0','0','0','0','0','0','0','[\"parent_category_id\",\"slug\",\"name_ar\",\"name_en\",\"description_ar\",\"description_en\",\"category_image\",\"category_icon\",\"active\"]','2021-03-31 17:37:44','2021-03-31 17:37:44');

INSERT INTO extensions (`id`, `extension_flag_name`, `extension_module_name`, `extension_description`, `additional_extensions`, `additional_tables`, `additional_modules`, `created_at`, `updated_at`) VALUES 
('29','news_categories','News_categorie','News categories','[]','[]','[]','2021-03-31 17:37:41','2021-03-31 17:37:41');

INSERT INTO news_categories (`id`, `parent_category_id`, `slug`, `name_ar`, `name_en`, `description_ar`, `description_en`, `category_image`, `category_icon`, `sort`, `active`, `created_at`, `updated_at`) VALUES 
('1','','basic_category','التصنيف الرئيسي','Basic Category','التصنيف الرئيسي','Basic Category','storage/images/news_categories/category_image/20210331184022.jpg','storage/images/news_categories/category_icon/20210331184022.jpg','1','1','2021-03-31 17:40:22','2021-03-31 17:40:22');

INSERT INTO news_categories (`id`, `parent_category_id`, `slug`, `name_ar`, `name_en`, `description_ar`, `description_en`, `category_image`, `category_icon`, `sort`, `active`, `created_at`, `updated_at`) VALUES 
('2','1','sub_category','التصنيف الفرعي','sub_category','التصنيف الفرعي','sub_category','storage/images/news_categories/category_image/20210331184500.jpg','storage/images/news_categories/category_icon/20210331184500.jpg','2','1','2021-03-31 17:45:00','2021-03-31 17:45:00');
