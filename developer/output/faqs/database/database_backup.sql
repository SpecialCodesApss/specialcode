

CREATE TABLE `faqs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `question_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer_ar` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer_en` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `sort` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO admin_sections (`id`, `parent_section_id`, `section_name_ar`, `section_name_en`, `section_icon`, `section_flag`, `controller_name`, `module_name`, `is_notification_able`, `is_drop_menu`, `active`, `sort`, `created_at`, `updated_at`) VALUES 
('7','','الأسئلة الشائعة ','Faqs','fas fa-question','faqs','FaqController','','1','0','1','5','2020-02-14 21:24:42','2020-02-14 21:24:42');

INSERT INTO api_requests (`id`, `name`, `controller_name`, `Mobile_List`, `Mobile_Create`, `Mobile_Update`, `Mobile_View`, `Mobile_Delete`, `list_authorization_status`, `create_authorization_status`, `update_authorization_status`, `view_authorization_status`, `delete_authorization_status`, `parameters`, `created_at`, `updated_at`) VALUES 
('6','faqs','FaqController','1','0','0','0','0','0','0','0','0','0','[\"question_ar\",\"question_en\",\"answer_ar\",\"answer_en\",\"active\"]','2022-01-13 22:56:08','2022-01-13 22:56:08');

INSERT INTO extensions (`id`, `extension_flag_name`, `extension_module_name`, `extension_description`, `additional_extensions`, `additional_tables`, `additional_modules`, `created_at`, `updated_at`) VALUES 
('6','faqs','Faq','Faqs','[]','[]','[]','2022-01-13 22:56:04','2022-01-13 22:56:04');

INSERT INTO faqs (`id`, `question_ar`, `question_en`, `answer_ar`, `answer_en`, `active`, `sort`, `created_at`, `updated_at`) VALUES 
('1','كيف استخدم التطبيق ؟','how to use ?','يمكنك استخدام التطبيق بالشكل المناسب','you can use this app ','1','1','2020-02-19 01:16:04','2020-02-19 01:16:04');

INSERT INTO faqs (`id`, `question_ar`, `question_en`, `answer_ar`, `answer_en`, `active`, `sort`, `created_at`, `updated_at`) VALUES 
('2','كيفية استخدام الحساب ؟','how to use Account ?','يمكنك استخدام الحساب عن طريق تسجيل الدخول أو قم بعمل حساب جديد بالبيانات الخاصة بك','you can use your account after login','1','2','2022-01-13 22:57:57','2022-01-13 23:12:45');
