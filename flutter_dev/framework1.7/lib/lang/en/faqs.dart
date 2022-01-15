
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
            "question_ar": "question arabic",
            "question_en": "question english",
            "answer_ar": "answer arabic",
            "answer_en": "answer english",
            "active": "active",
            "sort": "sort",
            "created_at": "created at",
            "updated_at": "updated at",
            "faqs": "faqs",
            "Faq": "Faq",
            "Faqs": "Faqs",
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