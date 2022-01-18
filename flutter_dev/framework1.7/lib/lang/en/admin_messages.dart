
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
            "user_id": "user id",
            "fullname": "fullname",
            "email": "email",
            "mobile": "mobile",
            "message_type": "message type",
            "image": "image",
            "messages_text": "message text",
            "open_status": "open status",
            "marked_as_readed": "marked as readed",
            "marked_as_deleted": "marked as deleted",
            "created_at": "created at",
            "updated_at": "updated at",
            "admin_messages": "admin_messages",
            "Admin_message": "Admin_message",
            "Admin_messages": "Admin_messages",
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
            "Complaint": "Complaint",
            "Suggestion": "Suggestion",
            "Technical Support": "Technical Support",
            "Management": "Management",
            };
