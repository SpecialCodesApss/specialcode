

CREATE TABLE `b_tests` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `users_ids` longtext NOT NULL,
  `pages_id` longtext NOT NULL,
  `table_ids` text NOT NULL,
  `page_html` longtext NOT NULL,
  `test_2` varchar(50) NOT NULL,
  `email` text NOT NULL,
  `image` text NOT NULL,
  `type` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;


INSERT INTO admin_sections (`id`, `parent_section_id`, `section_name_ar`, `section_name_en`, `section_icon`, `section_flag`, `controller_name`, `is_notification_able`, `is_drop_menu`, `active`, `sort`, `created_at`, `updated_at`) VALUES 
('40','','B_tests','B_tests','fab fa-accessible-icon','b_tests','B_testController','0','0','1','17','2021-03-15 01:07:55','2021-03-15 01:07:55');

INSERT INTO api_requests (`id`, `name`, `controller_name`, `Mobile_List`, `Mobile_Create`, `Mobile_Update`, `Mobile_View`, `Mobile_Delete`, `list_authorization_status`, `create_authorization_status`, `update_authorization_status`, `view_authorization_status`, `delete_authorization_status`, `parameters`, `created_at`, `updated_at`) VALUES 
('28','b_tests','B_testController','1','1','1','1','1','1','1','1','1','1','[\"users_ids\",\"pages_id\",\"table_ids\",\"page_html\",\"test_2\",\"email\",\"image\",\"type\"]','2021-03-15 01:07:55','2021-03-17 02:15:08');

INSERT INTO extensions (`id`, `extension_flag_name`, `extension_module_name`, `extension_description`, `additional_extensions`, `additional_tables`, `additional_modules`, `created_at`, `updated_at`) VALUES 
('12','b_tests','B_test','B_tests','[]','[]','[]','2021-03-15 01:07:55','2021-03-15 01:07:55');

INSERT INTO routes (`id`, `request_method_type`, `router_name`, `controller_name`, `controller_method`, `parameters`, `type`, `middleware`, `created_at`, `updated_at`, `expect_from_CSRF`, `active`) VALUES 
('9','post','checkusers_for_b_tests','B_testController','checkusers_for_b_tests','','web_routes','admin','2021-03-15 01:32:07','2021-03-15 01:32:07','1','1');

INSERT INTO routes (`id`, `request_method_type`, `router_name`, `controller_name`, `controller_method`, `parameters`, `type`, `middleware`, `created_at`, `updated_at`, `expect_from_CSRF`, `active`) VALUES 
('10','post','searchusers_for_b_tests','B_testController','searchusers_for_b_tests','','web_routes','admin','2021-03-15 01:32:07','2021-03-15 01:32:07','1','1');

INSERT INTO routes (`id`, `request_method_type`, `router_name`, `controller_name`, `controller_method`, `parameters`, `type`, `middleware`, `created_at`, `updated_at`, `expect_from_CSRF`, `active`) VALUES 
('13','get','getusersInfo_for_b_tests','B_testController','getusersInfo_for_b_tests','','web_routes','admin','2021-03-16 23:47:34','2021-03-16 23:47:34','1','1');

INSERT INTO routes (`id`, `request_method_type`, `router_name`, `controller_name`, `controller_method`, `parameters`, `type`, `middleware`, `created_at`, `updated_at`, `expect_from_CSRF`, `active`) VALUES 
('14','post','checkusers_types_for_b_tests','B_testController','checkusers_types_for_b_tests','','web_routes','admin','2021-03-17 00:30:31','2021-03-17 00:30:31','1','1');

INSERT INTO routes (`id`, `request_method_type`, `router_name`, `controller_name`, `controller_method`, `parameters`, `type`, `middleware`, `created_at`, `updated_at`, `expect_from_CSRF`, `active`) VALUES 
('15','post','searchusers_types_for_b_tests','B_testController','searchusers_types_for_b_tests','','web_routes','admin','2021-03-17 00:30:31','2021-03-17 00:30:31','1','1');

INSERT INTO routes (`id`, `request_method_type`, `router_name`, `controller_name`, `controller_method`, `parameters`, `type`, `middleware`, `created_at`, `updated_at`, `expect_from_CSRF`, `active`) VALUES 
('16','get','getbannersInfo_for_b_tests','B_testController','getbannersInfo_for_b_tests','','web_routes','admin','2021-03-17 02:15:06','2021-03-17 02:15:06','1','1');

INSERT INTO routes (`id`, `request_method_type`, `router_name`, `controller_name`, `controller_method`, `parameters`, `type`, `middleware`, `created_at`, `updated_at`, `expect_from_CSRF`, `active`) VALUES 
('17','post','checkbanners_for_b_tests','B_testController','checkbanners_for_b_tests','','web_routes','admin','2021-03-17 02:15:06','2021-03-17 02:15:06','1','1');

INSERT INTO routes (`id`, `request_method_type`, `router_name`, `controller_name`, `controller_method`, `parameters`, `type`, `middleware`, `created_at`, `updated_at`, `expect_from_CSRF`, `active`) VALUES 
('18','post','searchbanners_for_b_tests','B_testController','searchbanners_for_b_tests','','web_routes','admin','2021-03-17 02:15:06','2021-03-17 02:15:06','1','1');

INSERT INTO routes (`id`, `request_method_type`, `router_name`, `controller_name`, `controller_method`, `parameters`, `type`, `middleware`, `created_at`, `updated_at`, `expect_from_CSRF`, `active`) VALUES 
('19','get','getlanguagesInfo_for_b_tests','B_testController','getlanguagesInfo_for_b_tests','','web_routes','admin','2021-03-17 02:15:06','2021-03-17 02:15:06','1','1');

INSERT INTO routes (`id`, `request_method_type`, `router_name`, `controller_name`, `controller_method`, `parameters`, `type`, `middleware`, `created_at`, `updated_at`, `expect_from_CSRF`, `active`) VALUES 
('20','post','checklanguages_for_b_tests','B_testController','checklanguages_for_b_tests','','web_routes','admin','2021-03-17 02:15:06','2021-03-17 02:15:06','1','1');

INSERT INTO routes (`id`, `request_method_type`, `router_name`, `controller_name`, `controller_method`, `parameters`, `type`, `middleware`, `created_at`, `updated_at`, `expect_from_CSRF`, `active`) VALUES 
('21','post','searchlanguages_for_b_tests','B_testController','searchlanguages_for_b_tests','','web_routes','admin','2021-03-17 02:15:06','2021-03-17 02:15:06','1','1');
