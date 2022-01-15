
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
            "page_key": "page key",
            "title_ar": "arabic title",
            "title_en": "english title",
            "html_page_ar": "html page arabic",
            "html_page_en": "html page english",
            "created_at": "created at",
            "updated_at": "updated at",
            "pages": "pages",
            "Page": "Page",
            "Pages": "Pages",
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