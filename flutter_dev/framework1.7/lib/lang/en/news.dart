
        getTranslation(String message_name) {
              var translation_response = "not found $message_name";
              messages.forEach((key, value) {
                if (key == message_name) {
                  translation_response = value;
                }
              });
              return translation_response;
            }
            
            var messages = {
        "id": "id",
            "category_id": "category",
            "publisher_newspaper_id": "newspaper",
            "auther_id": "auther",
            "country_id": "country",
            "city_id": "city",
            "title_ar": "arabic title",
            "sub_title_ar": "arabic sub title",
            "content_ar_html": "arabic content",
            "title_en": "english title",
            "sub_title_en": "english sub title",
            "content_en_html": "english content",
            "image": "image",
            "image_caption": "image caption",
            "is_video_news": "is video news",
            "video": "video",
            "published": "published",
            "publish_date": "publish date",
            "archive_date": "archive date",
            "news_types_tags": "news types tags",
            "permalink_tag": "permalink tag",
            "SEO_tags": "SEO tags",
            "is_comment_allowed": "is comment allowed",
            "is_breaking_news": "is breaking news",
            "is_slider_news": "is slider news",
            "is_company_news": "is company news",
            "company_id": "company",
            "news_languages": "news languages",
            "views_count": "views count",
            "comments_count": "comments count",
            "sort": "sort",
            "created_at": "created at",
            "updated_at": "updated at",
            "news": "news",
            "News": "News",
            "News": "News",
            "searchHere": "Search here ..",
            "NoListData": "there are no more data",
            "pullupload": "pull to load more ..",
            "loadFailed": "load Failed",
            "releaseToloadMore": "release to load more",
            "NomoreData": "there are no more data",
            "SARcurrency": " SAR ",
            "pleasefillallfields": "please fill all fields",
            "create": "create",
            "noImageSelected": "no image selected",
            "update": "update",
            "yes": "yes",
            "no": "no",
            "order": "order",
            "edit": "edit",
            "delete": "delete",
            };