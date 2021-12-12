

CREATE TABLE `events` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name_ar` varchar(50) NOT NULL,
  `name_en` varchar(50) NOT NULL,
  `description_html_ar` longtext NOT NULL,
  `description_html_en` longtext NOT NULL,
  `city` varchar(100) DEFAULT NULL,
  `image` text NOT NULL,
  `date` date NOT NULL,
  `website` text,
  `sort` bigint(20) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;


INSERT INTO admin_sections (`id`, `parent_section_id`, `section_name_ar`, `section_name_en`, `section_icon`, `section_flag`, `controller_name`, `is_notification_able`, `is_drop_menu`, `active`, `sort`, `created_at`, `updated_at`) VALUES 
('50','','الفعاليات','Events','far fa-calendar-check','events','EventController','0','0','1','23','2021-03-24 02:11:52','2021-03-24 02:11:52');

INSERT INTO api_requests (`id`, `name`, `controller_name`, `Mobile_List`, `Mobile_Create`, `Mobile_Update`, `Mobile_View`, `Mobile_Delete`, `list_authorization_status`, `create_authorization_status`, `update_authorization_status`, `view_authorization_status`, `delete_authorization_status`, `parameters`, `created_at`, `updated_at`) VALUES 
('37','events','EventController','1','0','0','0','0','0','0','0','0','0','[\"name_ar\",\"name_en\",\"description_html_ar\",\"description_html_en\",\"city\",\"image\",\"date\",\"website\",\"active\"]','2021-03-24 02:11:55','2021-03-24 02:11:55');

INSERT INTO extensions (`id`, `extension_flag_name`, `extension_module_name`, `extension_description`, `additional_extensions`, `additional_tables`, `additional_modules`, `created_at`, `updated_at`) VALUES 
('21','events','Event','Events','[]','[]','[]','2021-03-24 02:11:52','2021-03-24 02:11:52');

INSERT INTO events (`id`, `name_ar`, `name_en`, `description_html_ar`, `description_html_en`, `city`, `image`, `date`, `website`, `sort`, `active`, `created_at`, `updated_at`) VALUES 
('1','التجمع السنوي','Yearly Community','<div>التجمع السنوي الأول لهذا العام التجمع السنوي الأول لهذا العام التجمع السنوي الأول لهذا العام التجمع السنوي الأول لهذا العام التجمع السنوي الأول لهذا العام التجمع السنوي الأول لهذا العام التجمع السنوي الأول لهذا العام التجمع السنوي الأول لهذا العام التجمع السنوي الأول لهذا العام التجمع السنوي الأول لهذا العام التجمع السنوي الأول لهذا العام التجمع السنوي الأول لهذا العام&nbsp;<br></div>','<div style=\"text-align: left;\">First Yearly Community for this year&nbsp;</div>','القاهرة ، مصر','storage/images/our_events/image/20210324015932.jpg','2022-12-12','https://www.google.com/','1','1','2021-03-24 01:59:32','2021-03-24 06:48:13');
