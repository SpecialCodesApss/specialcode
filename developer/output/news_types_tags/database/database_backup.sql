

CREATE TABLE `news_types_tags` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `slug` varchar(50) NOT NULL,
  `name_ar` varchar(50) NOT NULL,
  `name_en` varchar(50) NOT NULL,
  `sort` bigint(20) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;


INSERT INTO admin_sections (`id`, `parent_section_id`, `section_name_ar`, `section_name_en`, `section_icon`, `section_flag`, `controller_name`, `is_notification_able`, `is_drop_menu`, `active`, `sort`, `created_at`, `updated_at`) VALUES 
('61','','علامات الأخبار','News tags','fas fa-boxes','news_types_tags','News_types_tagController','0','0','1','34','2021-03-31 17:53:06','2021-03-31 17:53:06');

INSERT INTO api_requests (`id`, `name`, `controller_name`, `Mobile_List`, `Mobile_Create`, `Mobile_Update`, `Mobile_View`, `Mobile_Delete`, `list_authorization_status`, `create_authorization_status`, `update_authorization_status`, `view_authorization_status`, `delete_authorization_status`, `parameters`, `created_at`, `updated_at`) VALUES 
('46','news_types_tags','News_types_tagController','1','1','1','1','1','0','1','1','0','1','[\"slug\",\"name_ar\",\"name_en\",\"active\"]','2021-03-31 17:53:09','2021-03-31 17:53:09');

INSERT INTO extensions (`id`, `extension_flag_name`, `extension_module_name`, `extension_description`, `additional_extensions`, `additional_tables`, `additional_modules`, `created_at`, `updated_at`) VALUES 
('30','news_types_tags','News_types_tag','News tags','[]','[]','[]','2021-03-31 17:53:06','2021-03-31 17:53:06');

INSERT INTO news_types_tags (`id`, `slug`, `name_ar`, `name_en`, `sort`, `active`, `created_at`, `updated_at`) VALUES 
('1','National','عالميه','National','1','1','2021-03-31 17:53:38','2021-03-31 17:53:51');
