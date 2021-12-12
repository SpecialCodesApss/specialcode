
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
            "company_id": "company",
            "user_id": "user",
            "rate_stars_count": "rating",
            "comment": "comment",
            "users_likes_ids": "users who likes",
            "users_dislikes_ids": "users who dislikes",
            "active": "active",
            "created_at": "created at",
            "updated_at": "updated at",
            "companies_reviews": "companies reviews",
            "Companies_review": "Companies review",
            "Companies_reviews": "Companies reviews",
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

            "Rating_box_title": "The Rating Dialog",
            "Rating_box_description": "Tap a star to set your rating. Add more description here if you want.",
            "Rating_box_Submitbtn_text": "SUBMIT",
            };