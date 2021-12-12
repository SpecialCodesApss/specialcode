

CREATE TABLE `email_newsletters` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `email_title` varchar(100) NOT NULL,
  `news_html` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;



CREATE TABLE `email_newsletters_users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `email` varchar(150) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;


INSERT INTO admin_sections (`id`, `parent_section_id`, `section_name_ar`, `section_name_en`, `section_icon`, `section_flag`, `controller_name`, `is_notification_able`, `is_drop_menu`, `active`, `sort`, `created_at`, `updated_at`) VALUES 
('56','58','المشتركين','Subscribers','far fa-address-card','email_newsletters_users','Email_newsletters_userController','0','0','1','29','2021-03-31 10:55:36','2021-03-31 10:55:36');

INSERT INTO admin_sections (`id`, `parent_section_id`, `section_name_ar`, `section_name_en`, `section_icon`, `section_flag`, `controller_name`, `is_notification_able`, `is_drop_menu`, `active`, `sort`, `created_at`, `updated_at`) VALUES 
('57','58','النشرة الإخبارية','Email newsletters','far fa-newspaper','email_newsletters','Email_newsletterController','0','0','1','30','2021-03-31 11:15:59','2021-03-31 11:15:59');

INSERT INTO admin_sections (`id`, `parent_section_id`, `section_name_ar`, `section_name_en`, `section_icon`, `section_flag`, `controller_name`, `is_notification_able`, `is_drop_menu`, `active`, `sort`, `created_at`, `updated_at`) VALUES 
('58','','النشرة الإخبارية','Email newsletters','far fa-newspaper','email_newsletters','Email_newsletterController','0','1','1','30','2021-03-31 11:15:59','2021-03-31 11:15:59');

INSERT INTO api_requests (`id`, `name`, `controller_name`, `Mobile_List`, `Mobile_Create`, `Mobile_Update`, `Mobile_View`, `Mobile_Delete`, `list_authorization_status`, `create_authorization_status`, `update_authorization_status`, `view_authorization_status`, `delete_authorization_status`, `parameters`, `created_at`, `updated_at`) VALUES 
('42','email_newsletters_users','Email_newsletters_userController','0','1','0','0','0','0','1','0','0','0','[\"user_id\",\"email\"]','2021-03-31 10:55:39','2021-03-31 11:17:13');

INSERT INTO api_requests (`id`, `name`, `controller_name`, `Mobile_List`, `Mobile_Create`, `Mobile_Update`, `Mobile_View`, `Mobile_Delete`, `list_authorization_status`, `create_authorization_status`, `update_authorization_status`, `view_authorization_status`, `delete_authorization_status`, `parameters`, `created_at`, `updated_at`) VALUES 
('43','email_newsletters','Email_newsletterController','1','1','1','1','1','0','1','1','0','1','[\"email_title\",\"news_html\"]','2021-03-31 11:16:01','2021-03-31 11:16:01');

INSERT INTO extensions (`id`, `extension_flag_name`, `extension_module_name`, `extension_description`, `additional_extensions`, `additional_tables`, `additional_modules`, `created_at`, `updated_at`) VALUES 
('27','email_newsletters','Email_newsletter','Email newsletters','[\"email_newsletters_users\"]','[]','[\"email_newsletters_users\"]','2021-03-31 11:15:59','2021-03-31 18:06:19');

INSERT INTO email_newsletters (`id`, `email_title`, `news_html`, `created_at`, `updated_at`) VALUES 
('2','النشرة البريدية الاولى','<div><b>النشرة البريدية الأولى&nbsp;</b></div><div>مرحبا بكم في النشرة البريدية الأولي&nbsp;</div><div>كيف حالكم&nbsp;</div><div><br></div><div><u>نتمني لكم دوام العافيه&nbsp;</u></div><div><br></div>','2021-03-31 11:55:24','2021-03-31 11:55:49');

INSERT INTO email_newsletters_users (`id`, `user_id`, `email`, `created_at`, `updated_at`) VALUES 
('1','2','user@a.com','2021-03-31 11:02:56','2021-03-31 12:59:12');

INSERT INTO email_newsletters_users (`id`, `user_id`, `email`, `created_at`, `updated_at`) VALUES 
('3','','sevento.apps@gmail.com','2021-03-31 11:11:30','2021-03-31 13:35:13');

INSERT INTO email_newsletters_users (`id`, `user_id`, `email`, `created_at`, `updated_at`) VALUES 
('12','1','admin@admin.com','2021-03-31 13:10:28','2021-03-31 13:10:28');
