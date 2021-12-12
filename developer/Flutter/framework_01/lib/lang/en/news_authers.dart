
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
            "country_id": "country",
            "slug": "Slug",
            "name_ar": "arabic name",
            "name_en": "english name",
            "work_title": "work title",
            "Biographical_info_ar": "arabic Biographical info",
            "Biographical_info_en": "english Biographical info",
            "profile_image": "profile image",
            "email": "email",
            "website_link": "website",
            "facebook": "facebook",
            "twitter": "twitter",
            "linkedin": "linkedin",
            "SEO_auther_page_title": "SEO title",
            "SEO_auther_page_metatags": "SEO metatags",
            "sort": "sort",
            "active": "active",
            "created_at": "created at",
            "updated_at": "updated at",
            "news_authers": "news authers",
            "News_auther": "News auther",
            "News_authers": "News authers",
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