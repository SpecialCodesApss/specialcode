
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
            "name_ar": "arabic name",
            "name_en": "english name",
            "slug": "slug",
            "country_flag": "country flag",
            "country_alpha2_code": "country alpha2 code",
            "country_alpha3_code": "country alpha3 code",
            "languages": "languages",
            "currencies": "currencies",
            "active": "active",
            "sort": "sort",
            "created_at": "created at",
            "updated_at": "updated at",
            "countries": "countries",
            "Countrie": "Country",
            "Countries": "Countries",
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