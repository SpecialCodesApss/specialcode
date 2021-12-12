

CREATE TABLE `country_cities` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `country_id` bigint(20) NOT NULL,
  `name_ar` varchar(50) NOT NULL,
  `name_en` varchar(50) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `sort` bigint(20) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;


INSERT INTO admin_sections (`id`, `parent_section_id`, `section_name_ar`, `section_name_en`, `section_icon`, `section_flag`, `controller_name`, `is_notification_able`, `is_drop_menu`, `active`, `sort`, `created_at`, `updated_at`) VALUES 
('46','48','المدن','Cities','fas fa-city','country_cities','Country_citieController','0','0','1','20','2021-03-23 04:42:24','2021-03-23 04:42:24');

INSERT INTO api_requests (`id`, `name`, `controller_name`, `Mobile_List`, `Mobile_Create`, `Mobile_Update`, `Mobile_View`, `Mobile_Delete`, `list_authorization_status`, `create_authorization_status`, `update_authorization_status`, `view_authorization_status`, `delete_authorization_status`, `parameters`, `created_at`, `updated_at`) VALUES 
('34','country_cities','Country_citieController','1','0','0','0','0','0','0','0','0','0','[\"country_id\",\"name_ar\",\"name_en\",\"slug\",\"active\"]','2021-03-23 04:42:26','2021-03-23 04:42:26');

INSERT INTO extensions (`id`, `extension_flag_name`, `extension_module_name`, `extension_description`, `additional_extensions`, `additional_tables`, `additional_modules`, `created_at`, `updated_at`) VALUES 
('18','country_cities','Country_citie','Cities','[]','[]','[]','2021-03-23 04:42:24','2021-03-23 04:42:24');

INSERT INTO country_cities (`id`, `country_id`, `name_ar`, `name_en`, `slug`, `sort`, `active`, `created_at`, `updated_at`) VALUES 
('1','1','القاهرة','Cairo','Cairo','1','1','2021-03-23 05:07:45','2021-03-23 05:07:45');

INSERT INTO country_cities (`id`, `country_id`, `name_ar`, `name_en`, `slug`, `sort`, `active`, `created_at`, `updated_at`) VALUES 
('2','1','الجيزة','Giza','Giza','2','1','2021-03-23 05:08:16','2021-03-23 05:08:55');
