

CREATE TABLE `news` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) NOT NULL,
  `publisher_newspaper_id` bigint(20) DEFAULT NULL,
  `auther_id` bigint(20) DEFAULT NULL,
  `country_id` bigint(20) NOT NULL,
  `city_id` bigint(20) NOT NULL,
  `title_ar` varchar(100) DEFAULT NULL,
  `sub_title_ar` varchar(200) DEFAULT NULL,
  `content_ar_html` longtext,
  `title_en` varchar(100) DEFAULT NULL,
  `sub_title_en` varchar(200) DEFAULT NULL,
  `content_en_html` longtext,
  `image` text NOT NULL,
  `image_caption` varchar(50) DEFAULT NULL,
  `is_video_news` tinyint(1) DEFAULT NULL,
  `video` text,
  `published` tinyint(1) DEFAULT NULL,
  `publish_date` date NOT NULL,
  `archive_date` date DEFAULT NULL,
  `news_types_tags` text,
  `permalink_tag` varchar(50) DEFAULT NULL,
  `SEO_tags` text,
  `is_comment_allowed` tinyint(1) DEFAULT NULL,
  `is_breaking_news` tinyint(1) DEFAULT NULL,
  `is_slider_news` tinyint(1) DEFAULT NULL,
  `is_company_news` tinyint(1) DEFAULT NULL,
  `company_id` bigint(20) DEFAULT NULL,
  `news_languages` text NOT NULL,
  `views_count` bigint(20) NOT NULL DEFAULT '0',
  `comments_count` bigint(20) NOT NULL DEFAULT '0',
  `sort` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permalink_tag` (`permalink_tag`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;



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



CREATE TABLE `news_users_newspapers_follows` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `newspaper_id` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;



CREATE TABLE `news_users_notifications_settings` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `active_notification` tinyint(1) NOT NULL DEFAULT '1',
  `notification_type` enum('every day','every week','every month') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;



CREATE TABLE `news_comments` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `comment_text` text NOT NULL,
  `users_likes_ids` longtext,
  `users_dislikes_ids` longtext,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;



CREATE TABLE `news_favorites` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `news_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;


INSERT INTO admin_sections (`id`, `parent_section_id`, `section_name_ar`, `section_name_en`, `section_icon`, `section_flag`, `controller_name`, `is_notification_able`, `is_drop_menu`, `active`, `sort`, `created_at`, `updated_at`) VALUES 
('59','','المحررين','Authers','fas fa-eye-dropper','news_authers','News_autherController','0','0','1','32','2021-03-31 17:12:04','2021-03-31 17:12:04');

INSERT INTO admin_sections (`id`, `parent_section_id`, `section_name_ar`, `section_name_en`, `section_icon`, `section_flag`, `controller_name`, `is_notification_able`, `is_drop_menu`, `active`, `sort`, `created_at`, `updated_at`) VALUES 
('60','','تصنيفات الأخبار','News categories','fab fa-accusoft','news_categories','News_categorieController','0','0','1','33','2021-03-31 17:37:41','2021-03-31 17:37:41');

INSERT INTO admin_sections (`id`, `parent_section_id`, `section_name_ar`, `section_name_en`, `section_icon`, `section_flag`, `controller_name`, `is_notification_able`, `is_drop_menu`, `active`, `sort`, `created_at`, `updated_at`) VALUES 
('61','','علامات الأخبار','News tags','fas fa-boxes','news_types_tags','News_types_tagController','0','0','1','34','2021-03-31 17:53:06','2021-03-31 17:53:06');

INSERT INTO admin_sections (`id`, `parent_section_id`, `section_name_ar`, `section_name_en`, `section_icon`, `section_flag`, `controller_name`, `is_notification_able`, `is_drop_menu`, `active`, `sort`, `created_at`, `updated_at`) VALUES 
('62','','صحف النشر','newspaper publishers','far fa-clone','news_newspaper_publishers','News_newspaper_publisherController','0','0','1','35','2021-03-31 18:00:57','2021-03-31 18:00:57');

INSERT INTO admin_sections (`id`, `parent_section_id`, `section_name_ar`, `section_name_en`, `section_icon`, `section_flag`, `controller_name`, `is_notification_able`, `is_drop_menu`, `active`, `sort`, `created_at`, `updated_at`) VALUES 
('63','','الصحف المتابعة للمستخدمين','newspapers users follows','fab fa-twitter','news_users_newspapers_follows','News_users_newspapers_followController','0','0','1','36','2021-03-31 18:07:19','2021-03-31 18:07:19');

INSERT INTO admin_sections (`id`, `parent_section_id`, `section_name_ar`, `section_name_en`, `section_icon`, `section_flag`, `controller_name`, `is_notification_able`, `is_drop_menu`, `active`, `sort`, `created_at`, `updated_at`) VALUES 
('64','','إعدادات إشعارات الأخبار','News notifications settings','fas fa-cogs','news_users_notifications_settings','News_users_notifications_settingController','0','0','1','37','2021-04-01 06:32:24','2021-04-01 06:32:24');

INSERT INTO admin_sections (`id`, `parent_section_id`, `section_name_ar`, `section_name_en`, `section_icon`, `section_flag`, `controller_name`, `is_notification_able`, `is_drop_menu`, `active`, `sort`, `created_at`, `updated_at`) VALUES 
('67','','الأخبار','News','empty','news','NewsController','0','0','1','39','2021-04-04 18:23:29','2021-04-04 18:23:29');

INSERT INTO admin_sections (`id`, `parent_section_id`, `section_name_ar`, `section_name_en`, `section_icon`, `section_flag`, `controller_name`, `is_notification_able`, `is_drop_menu`, `active`, `sort`, `created_at`, `updated_at`) VALUES 
('69','','تعليقات الأخبار','News comments','empty','news_comments','News_commentController','0','0','1','39','2021-04-04 19:35:27','2021-04-04 19:35:27');

INSERT INTO admin_sections (`id`, `parent_section_id`, `section_name_ar`, `section_name_en`, `section_icon`, `section_flag`, `controller_name`, `is_notification_able`, `is_drop_menu`, `active`, `sort`, `created_at`, `updated_at`) VALUES 
('70','','الأخبار المفضلة','favorites News','far fa-heart','news_favorites','News_favoriteController','0','0','1','40','2021-04-04 19:47:53','2021-04-04 19:47:53');

INSERT INTO api_requests (`id`, `name`, `controller_name`, `Mobile_List`, `Mobile_Create`, `Mobile_Update`, `Mobile_View`, `Mobile_Delete`, `list_authorization_status`, `create_authorization_status`, `update_authorization_status`, `view_authorization_status`, `delete_authorization_status`, `parameters`, `created_at`, `updated_at`) VALUES 
('44','news_authers','News_autherController','1','0','0','1','0','1','0','0','1','0','[\"country_id\",\"slug\",\"name_ar\",\"name_en\",\"work_title\",\"Biographical_info_ar\",\"Biographical_info_en\",\"profile_image\",\"email\",\"website_link\",\"facebook\",\"twitter\",\"linkedin\",\"SEO_auther_page_title\",\"SEO_auther_page_metatags\",\"active\"]','2021-03-31 17:12:06','2021-03-31 17:12:06');

INSERT INTO api_requests (`id`, `name`, `controller_name`, `Mobile_List`, `Mobile_Create`, `Mobile_Update`, `Mobile_View`, `Mobile_Delete`, `list_authorization_status`, `create_authorization_status`, `update_authorization_status`, `view_authorization_status`, `delete_authorization_status`, `parameters`, `created_at`, `updated_at`) VALUES 
('45','news_categories','News_categorieController','1','0','0','0','0','0','0','0','0','0','[\"parent_category_id\",\"slug\",\"name_ar\",\"name_en\",\"description_ar\",\"description_en\",\"category_image\",\"category_icon\",\"active\"]','2021-03-31 17:37:44','2021-03-31 17:37:44');

INSERT INTO api_requests (`id`, `name`, `controller_name`, `Mobile_List`, `Mobile_Create`, `Mobile_Update`, `Mobile_View`, `Mobile_Delete`, `list_authorization_status`, `create_authorization_status`, `update_authorization_status`, `view_authorization_status`, `delete_authorization_status`, `parameters`, `created_at`, `updated_at`) VALUES 
('46','news_types_tags','News_types_tagController','1','1','1','1','1','0','1','1','0','1','[\"slug\",\"name_ar\",\"name_en\",\"active\"]','2021-03-31 17:53:09','2021-03-31 17:53:09');

INSERT INTO api_requests (`id`, `name`, `controller_name`, `Mobile_List`, `Mobile_Create`, `Mobile_Update`, `Mobile_View`, `Mobile_Delete`, `list_authorization_status`, `create_authorization_status`, `update_authorization_status`, `view_authorization_status`, `delete_authorization_status`, `parameters`, `created_at`, `updated_at`) VALUES 
('47','news_newspaper_publishers','News_newspaper_publisherController','1','0','0','1','0','0','0','0','0','0','[\"country_id\",\"slug\",\"newspaper_name_ar\",\"newspaper_name_en\",\"description_ar\",\"description_en\",\"logo_image\",\"email\",\"website_link\",\"facebook\",\"twitter\",\"linkedin\",\"SEO_newspaper_page_title\",\"SEO_newspaper_page_metatags\",\"active\"]','2021-03-31 18:00:59','2021-03-31 18:00:59');

INSERT INTO api_requests (`id`, `name`, `controller_name`, `Mobile_List`, `Mobile_Create`, `Mobile_Update`, `Mobile_View`, `Mobile_Delete`, `list_authorization_status`, `create_authorization_status`, `update_authorization_status`, `view_authorization_status`, `delete_authorization_status`, `parameters`, `created_at`, `updated_at`) VALUES 
('48','news_users_newspapers_follows','News_users_newspapers_followController','1','1','0','0','1','1','1','0','0','1','[\"user_id\",\"newspaper_id\"]','2021-03-31 18:07:21','2021-03-31 18:07:21');

INSERT INTO api_requests (`id`, `name`, `controller_name`, `Mobile_List`, `Mobile_Create`, `Mobile_Update`, `Mobile_View`, `Mobile_Delete`, `list_authorization_status`, `create_authorization_status`, `update_authorization_status`, `view_authorization_status`, `delete_authorization_status`, `parameters`, `created_at`, `updated_at`) VALUES 
('49','news_users_notifications_settings','News_users_notifications_settingController','1','0','1','1','0','1','0','1','1','0','[\"user_id\",\"active_notification\",\"notification_type\"]','2021-04-01 06:36:22','2021-04-01 12:03:52');

INSERT INTO api_requests (`id`, `name`, `controller_name`, `Mobile_List`, `Mobile_Create`, `Mobile_Update`, `Mobile_View`, `Mobile_Delete`, `list_authorization_status`, `create_authorization_status`, `update_authorization_status`, `view_authorization_status`, `delete_authorization_status`, `parameters`, `created_at`, `updated_at`) VALUES 
('50','news','NewsController','1','0','0','1','0','0','0','0','0','0','[\"category_id\",\"publisher_newspaper_id\",\"auther_id\",\"country_id\",\"city_id\",\"title_ar\",\"sub_title_ar\",\"content_ar_html\",\"title_en\",\"sub_title_en\",\"content_en_html\",\"image\",\"image_caption\",\"is_video_news\",\"video\",\"published\",\"publish_date\",\"archive_date\",\"news_types_tags\",\"permalink_tag\",\"SEO_tags\",\"is_comment_allowed\",\"is_breaking_news\",\"is_slider_news\",\"is_company_news\",\"company_id\",\"news_languages\",\"views_count\",\"comments_count\"]','2021-04-01 13:32:54','2021-04-01 13:36:32');

INSERT INTO api_requests (`id`, `name`, `controller_name`, `Mobile_List`, `Mobile_Create`, `Mobile_Update`, `Mobile_View`, `Mobile_Delete`, `list_authorization_status`, `create_authorization_status`, `update_authorization_status`, `view_authorization_status`, `delete_authorization_status`, `parameters`, `created_at`, `updated_at`) VALUES 
('51','news_comments','News_commentController','1','1','0','0','0','0','1','0','0','0','[\"user_id\",\"comment_text\",\"users_likes_ids\",\"users_dislikes_ids\",\"active\"]','2021-04-04 16:21:28','2021-04-04 19:34:49');

INSERT INTO api_requests (`id`, `name`, `controller_name`, `Mobile_List`, `Mobile_Create`, `Mobile_Update`, `Mobile_View`, `Mobile_Delete`, `list_authorization_status`, `create_authorization_status`, `update_authorization_status`, `view_authorization_status`, `delete_authorization_status`, `parameters`, `created_at`, `updated_at`) VALUES 
('52','news_favorites','News_favoriteController','1','1','0','0','1','1','1','0','0','1','[\"news_id\",\"user_id\"]','2021-04-04 19:47:57','2021-04-04 19:47:57');

INSERT INTO extensions (`id`, `extension_flag_name`, `extension_module_name`, `extension_description`, `additional_extensions`, `additional_tables`, `additional_modules`, `created_at`, `updated_at`) VALUES 
('34','news','New','News','[\"news_authers\",\"news_categories\",\"news_types_tags\",\"news_newspaper_publishers\",\"news_users_newspapers_follows\" , \"news_users_notifications_settings\",\"news_comments\",\"news_favorites\"]','[]','[\"news_authers\",\"news_categories\",\"news_types_tags\",\"news_newspaper_publishers\",\"news_users_newspapers_follows\" , \"news_users_notifications_settings\",\"news_comments\",\"news_favorites\"]','2021-04-01 13:32:51','2021-04-04 21:58:47');

INSERT INTO routes (`id`, `request_method_type`, `router_name`, `controller_name`, `controller_method`, `parameters`, `type`, `middleware`, `created_at`, `updated_at`, `expect_from_CSRF`, `active`) VALUES 
('34','post','checknews_types_tags_for_news_forFieldnews_types_tags','NewsController','checknews_types_tags_for_news_forFieldnews_types_tags','','web_routes','admin','2021-04-01 13:32:51','2021-04-01 13:36:30','1','1');

INSERT INTO routes (`id`, `request_method_type`, `router_name`, `controller_name`, `controller_method`, `parameters`, `type`, `middleware`, `created_at`, `updated_at`, `expect_from_CSRF`, `active`) VALUES 
('35','post','searchnews_types_tags_for_news_forFieldnews_types_tags','NewsController','searchnews_types_tags_for_news_forFieldnews_types_tags','','web_routes','admin','2021-04-01 13:32:51','2021-04-01 13:36:30','1','1');

INSERT INTO news (`id`, `category_id`, `publisher_newspaper_id`, `auther_id`, `country_id`, `city_id`, `title_ar`, `sub_title_ar`, `content_ar_html`, `title_en`, `sub_title_en`, `content_en_html`, `image`, `image_caption`, `is_video_news`, `video`, `published`, `publish_date`, `archive_date`, `news_types_tags`, `permalink_tag`, `SEO_tags`, `is_comment_allowed`, `is_breaking_news`, `is_slider_news`, `is_company_news`, `company_id`, `news_languages`, `views_count`, `comments_count`, `sort`, `created_at`, `updated_at`) VALUES 
('3','1','1','1','1','1','ما هو \"لوريم إيبسوم\" ؟','ما هو \"لوريم إيبسوم\" ؟ - ما فائدته ؟','<div><h2 style=\"margin-top: 0px; font-family: DauphinPlain; font-size: 24px; line-height: 24px; text-align: right; color: rgb(0, 0, 0);\">ما هو \"لوريم إيبسوم\" ؟</h2></div><div><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">وريم إيبسوم(Lorem Ipsum) هو ببساطة نص شكلي (بمعنى أن الغاية هي الشكل وليس المحتوى) ويُستخدم في صناعات المطابع ودور النشر. كان لوريم إيبسوم ولايزال المعيار للنص الشكلي منذ القرن الخامس عشر عندما قامت مطبعة مجهولة برص مجموعة من الأحرف بشكل عشوائي أخذتها من نص، لتكوّن كتيّب بمثابة دليل أو مرجع شكلي لهذه الأحرف. خمسة قرون من الزمن لم تقضي على هذا النص، بل انه حتى صار مستخدماً وبشكله الأصلي في الطباعة والتنضيد الإلكتروني. انتشر بشكل كبير في ستينيّات هذا القرن مع إصدار رقائق \"ليتراسيت\" (Letraset) البلاستيكية تحوي مقاطع من هذا النص، وعاد لينتشر مرة أخرى مؤخراَ مع ظهور برامج النشر الإلكتروني مثل \"ألدوس بايج مايكر\" (Aldus PageMaker) والتي حوت أيضاً على نسخ من نص لوريم إيبسوم.</span><br></div><div><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\"><br></span></div><div><h2 style=\"margin-top: 0px; font-family: DauphinPlain; font-size: 24px; line-height: 24px; text-align: right; color: rgb(0, 0, 0);\">ما فائدته ؟</h2></div><div><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام \"هنا يوجد محتوى نصي، هنا يوجد محتوى نصي\" فتجعلها تبدو (أي الأحرف) وكأنها نص مقروء. العديد من برامح النشر المكتبي وبرامح تحرير صفحات الويب تستخدم لوريم إيبسوم بشكل إفتراضي كنموذج عن النص، وإذا قمت بإدخال \"lorem ipsum\" في أي محرك بحث ستظهر العديد من المواقع الحديثة العهد في نتائج البحث. على مدى السنين ظهرت نسخ جديدة ومختلفة من نص لوريم إيبسوم، أحياناً عن طريق الصدفة، وأحياناً عن عمد كإدخال بعض العبارات الفكاهية إليها.</span><br></div>','a','a','<div>a</div>','storage/images/news/image/20210404183716.jpg','عنوان الصورة','1','','1','2021-04-02','2021-05-01','[\"\"]','sfs','','1','1','1','1','1','[\"1\",\"2\"]','0','0','1','2021-04-04 18:37:16','2021-04-04 19:20:01');

INSERT INTO news_authers (`id`, `country_id`, `slug`, `name_ar`, `name_en`, `work_title`, `Biographical_info_ar`, `Biographical_info_en`, `profile_image`, `email`, `website_link`, `facebook`, `twitter`, `linkedin`, `SEO_auther_page_title`, `SEO_auther_page_metatags`, `sort`, `active`, `created_at`, `updated_at`) VALUES 
('1','1','aaa','احمد علاء','Ahmed Alaa','','محرر حر يعمل بالجريدة','محرر حر يعمل بالجريدة','storage/images/news_authers/profile_image/20210331182627.jpg','http://google.com/','http://google.com/','http://google.com/','http://google.com/','http://google.com/','','','1','1','2021-03-31 17:26:10','2021-04-01 07:24:13');

INSERT INTO news_categories (`id`, `parent_category_id`, `slug`, `name_ar`, `name_en`, `description_ar`, `description_en`, `category_image`, `category_icon`, `sort`, `active`, `created_at`, `updated_at`) VALUES 
('1','','basic_category','التصنيف الرئيسي','Basic Category','التصنيف الرئيسي','Basic Category','storage/images/news_categories/category_image/20210331184022.jpg','storage/images/news_categories/category_icon/20210331184022.jpg','1','1','2021-03-31 17:40:22','2021-03-31 17:40:22');

INSERT INTO news_categories (`id`, `parent_category_id`, `slug`, `name_ar`, `name_en`, `description_ar`, `description_en`, `category_image`, `category_icon`, `sort`, `active`, `created_at`, `updated_at`) VALUES 
('2','1','sub_category','التصنيف الفرعي','sub_category','التصنيف الفرعي','sub_category','storage/images/news_categories/category_image/20210331184500.jpg','storage/images/news_categories/category_icon/20210331184500.jpg','2','1','2021-03-31 17:45:00','2021-03-31 17:45:00');

INSERT INTO news_types_tags (`id`, `slug`, `name_ar`, `name_en`, `sort`, `active`, `created_at`, `updated_at`) VALUES 
('1','National','عالميه','National','1','1','2021-03-31 17:53:38','2021-03-31 17:53:51');

INSERT INTO news_newspaper_publishers (`id`, `country_id`, `slug`, `newspaper_name_ar`, `newspaper_name_en`, `description_ar`, `description_en`, `logo_image`, `email`, `website_link`, `facebook`, `twitter`, `linkedin`, `SEO_newspaper_page_title`, `SEO_newspaper_page_metatags`, `sort`, `active`, `created_at`, `updated_at`) VALUES 
('1','1','Youm7','اليوم السابع..','Youm7','اليوم السابع','Youm7','storage/images/news_newspaper_publishers/logo_image/20210331190136.jpg','','','','','','','','1','1','2021-03-31 18:01:36','2021-03-31 18:01:45');

INSERT INTO news_users_newspapers_follows (`id`, `user_id`, `newspaper_id`, `created_at`, `updated_at`) VALUES 
('1','2','1','2021-03-31 18:07:34','2021-03-31 18:07:42');

INSERT INTO news_users_notifications_settings (`id`, `user_id`, `active_notification`, `notification_type`, `created_at`, `updated_at`) VALUES 
('1','1','1','every week','2021-04-01 06:36:41','2021-04-01 12:29:17');

INSERT INTO news_comments (`id`, `user_id`, `comment_text`, `users_likes_ids`, `users_dislikes_ids`, `active`, `created_at`, `updated_at`) VALUES 
('1','1','تعليق جيد جدا','[\"admin@admin.com\"]','[\"admin@s.com\"]','1','2021-04-04 19:36:09','2021-04-04 19:36:57');

INSERT INTO news_comments (`id`, `user_id`, `comment_text`, `users_likes_ids`, `users_dislikes_ids`, `active`, `created_at`, `updated_at`) VALUES 
('2','1','عمل جيد جدا','','','0','2021-04-04 19:42:35','2021-04-04 19:42:35');

INSERT INTO news_favorites (`id`, `news_id`, `user_id`, `created_at`, `updated_at`) VALUES 
('1','3','1','2021-04-04 19:50:12','2021-04-04 19:50:25');

INSERT INTO news_favorites (`id`, `news_id`, `user_id`, `created_at`, `updated_at`) VALUES 
('2','2','1','2021-04-04 19:56:07','2021-04-04 19:56:07');
