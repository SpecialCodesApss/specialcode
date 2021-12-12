
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
            "newspaper_name_ar": "arabic newspaper name",
            "newspaper_name_en": "english newspaper name",
            "description_ar": "arabic description",
            "description_en": "english description",
            "logo_image": "logo",
            "email": "email",
            "website_link": "website",
            "facebook": "facebook",
            "twitter": "twitter",
            "linkedin": "linkedin",
            "SEO_newspaper_page_title": "SEOtitle",
            "SEO_newspaper_page_metatags": "SEO metatags",
            "sort": "sort",
            "active": "active",
            "created_at": "created at",
            "updated_at": "updated at",
            "news_newspaper_publishers": "newspapers",
            "News_newspaper_publisher": "newspaper",
            "News_newspaper_publishers": "newspapers",
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