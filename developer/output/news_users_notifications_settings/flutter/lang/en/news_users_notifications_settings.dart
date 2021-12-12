
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
            "user_id": "user",
            "active_notification": "notification activation",
            "notification_type": "notification type",
            "created_at": "created at",
            "updated_at": "updated at",
            "news_users_notifications_settings": "news_users_notifications_settings",
            "News_users_notifications_setting": "News_users_notifications_setting",
            "News_users_notifications_settings": "News_users_notifications_settings",
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

            "every day": "every day",
            "every week": "every week",
            "every month": "every month",
            };