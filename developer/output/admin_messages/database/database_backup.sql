

CREATE TABLE `admin_messages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `message_type` enum('Complaint','Suggestion','Technical Support','Management') NOT NULL,
  `image` text,
  `messages_text` text NOT NULL,
  `open_status` enum('open','closed') DEFAULT 'open',
  `marked_as_readed` tinyint(4) NOT NULL DEFAULT '0',
  `marked_as_deleted` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;


INSERT INTO admin_sections (`id`, `parent_section_id`, `section_name_ar`, `section_name_en`, `section_icon`, `section_flag`, `controller_name`, `module_name`, `is_notification_able`, `is_drop_menu`, `active`, `sort`, `created_at`, `updated_at`) VALUES 
('17','','رسائل الإدارة','Admin Messages','far fa-envelope-open','admin_messages','Admin_messageController','Admin_message','0','0','1','14','2022-01-18 00:18:05','2022-01-18 00:18:05');

INSERT INTO api_requests (`id`, `name`, `controller_name`, `Mobile_List`, `Mobile_Create`, `Mobile_Update`, `Mobile_View`, `Mobile_Delete`, `list_authorization_status`, `create_authorization_status`, `update_authorization_status`, `view_authorization_status`, `delete_authorization_status`, `parameters`, `created_at`, `updated_at`) VALUES 
('10','admin_messages','Admin_messageController','0','1','0','1','0','0','0','0','0','0','[\"user_id\",\"fullname\",\"email\",\"mobile\",\"message_type\",\"image\",\"messages_text\",\"open_status\",\"marked_as_readed\",\"marked_as_deleted\"]','2022-01-18 00:18:12','2022-01-18 00:18:12');

INSERT INTO extensions (`id`, `extension_flag_name`, `extension_module_name`, `extension_description`, `additional_extensions`, `additional_tables`, `additional_modules`, `created_at`, `updated_at`) VALUES 
('10','admin_messages','Admin_message','Admin Messages','[]','[]','[]','2022-01-18 00:18:05','2022-01-18 00:18:05');

INSERT INTO admin_messages (`id`, `user_id`, `fullname`, `email`, `mobile`, `message_type`, `image`, `messages_text`, `open_status`, `marked_as_readed`, `marked_as_deleted`, `created_at`, `updated_at`) VALUES 
('1','','Ahmed','a@b.c','123456','Complaint','storage/images/admin_messages/image/20220118004528.png','test','open','1','0','2022-01-18 00:45:28','2022-01-18 03:35:19');

INSERT INTO admin_messages (`id`, `user_id`, `fullname`, `email`, `mobile`, `message_type`, `image`, `messages_text`, `open_status`, `marked_as_readed`, `marked_as_deleted`, `created_at`, `updated_at`) VALUES 
('2','','Ahmed','a@b.c','123456','Complaint','storage/images/admin_messages/image/20220118004734.png','test','open','0','0','2022-01-18 00:47:34','2022-01-18 03:35:15');

INSERT INTO admin_messages (`id`, `user_id`, `fullname`, `email`, `mobile`, `message_type`, `image`, `messages_text`, `open_status`, `marked_as_readed`, `marked_as_deleted`, `created_at`, `updated_at`) VALUES 
('3','','Ahmed..00','a@b.c','123456','Complaint','storage/images/admin_messages/image/20220118004835.png','test','open','1','0','2022-01-18 00:48:35','2022-01-18 01:28:20');

INSERT INTO admin_messages (`id`, `user_id`, `fullname`, `email`, `mobile`, `message_type`, `image`, `messages_text`, `open_status`, `marked_as_readed`, `marked_as_deleted`, `created_at`, `updated_at`) VALUES 
('4','','1','1','1','Suggestion','','1','closed','0','0','2022-01-18 01:12:02','2022-01-18 01:12:02');

INSERT INTO admin_messages (`id`, `user_id`, `fullname`, `email`, `mobile`, `message_type`, `image`, `messages_text`, `open_status`, `marked_as_readed`, `marked_as_deleted`, `created_at`, `updated_at`) VALUES 
('5','','1','1','1','Complaint','','1','open','0','0','2022-01-18 01:27:10','2022-01-18 01:27:10');

INSERT INTO admin_messages (`id`, `user_id`, `fullname`, `email`, `mobile`, `message_type`, `image`, `messages_text`, `open_status`, `marked_as_readed`, `marked_as_deleted`, `created_at`, `updated_at`) VALUES 
('6','','محمد','Admin@admin.com','0501321561651','Complaint','storage/images/admin_messages/image/20220118013311.png','لدي مشكلة يرجي حلها','open','0','0','2022-01-18 01:33:11','2022-01-18 01:33:11');

INSERT INTO admin_messages (`id`, `user_id`, `fullname`, `email`, `mobile`, `message_type`, `image`, `messages_text`, `open_status`, `marked_as_readed`, `marked_as_deleted`, `created_at`, `updated_at`) VALUES 
('7','','ha','v','55','Complaint','','g','open','0','0','2022-01-18 01:59:39','2022-01-18 01:59:39');

INSERT INTO admin_messages (`id`, `user_id`, `fullname`, `email`, `mobile`, `message_type`, `image`, `messages_text`, `open_status`, `marked_as_readed`, `marked_as_deleted`, `created_at`, `updated_at`) VALUES 
('8','','1','2','3','Complaint','storage/images/admin_messages/image/20220118020211.jpg','4','open','1','0','2022-01-18 02:02:11','2022-01-18 02:02:33');

INSERT INTO admin_messages (`id`, `user_id`, `fullname`, `email`, `mobile`, `message_type`, `image`, `messages_text`, `open_status`, `marked_as_readed`, `marked_as_deleted`, `created_at`, `updated_at`) VALUES 
('9','','g','f','55','Complaint','','cf','open','0','0','2022-01-18 02:24:39','2022-01-18 02:24:39');

INSERT INTO admin_messages (`id`, `user_id`, `fullname`, `email`, `mobile`, `message_type`, `image`, `messages_text`, `open_status`, `marked_as_readed`, `marked_as_deleted`, `created_at`, `updated_at`) VALUES 
('10','','mo','as@zf.f','158','Suggestion','storage/images/admin_messages/image/20220118022641.jpg','wewe','open','1','0','2022-01-18 02:26:41','2022-01-18 02:27:05');
