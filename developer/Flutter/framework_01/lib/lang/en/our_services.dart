
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
            "name_ar": "Arabic Name",
            "name_en": "English Name",
            "description_html_ar": "description html arabic",
            "description_html_en": "description html english",
            "image": "image",
            "sort": "sort",
            "active": "active",
            "created_at": "created at",
            "updated_at": "updated at",
            "our_services": "our_services",
            "Our_service": "Our_service",
            "Our_services": "Our_services",
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