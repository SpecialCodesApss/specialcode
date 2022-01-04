
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
            "parent_category_id": "parent category",
            "slug": "Slug",
            "name_ar": "arabic name",
            "name_en": "english name",
            "description_ar": "arabic description",
            "description_en": "english description",
            "category_image": "category image",
            "category_icon": "category icon",
            "sort": "sort",
            "active": "active",
            "created_at": "created at",
            "updated_at": "updated at",
            "news_categories": "news categories",
            "News_categorie": "News categorie",
            "News_categories": "News categories",
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