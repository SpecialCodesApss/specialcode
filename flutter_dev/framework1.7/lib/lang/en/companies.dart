
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
            "categories": "categories",
            "country_id": "country",
            "city_id": "city",
            "slug": "Slug",
            "company_name_ar": "arabic name",
            "company_name_en": "english name",
            "description_ar": "arabic description",
            "description_en": "english description",
            "logo_image": "logo",
            "email": "email",
            "phone_number": "phone number",
            "whatsapp_number": "whatsapp number",
            "website_link": "website link",
            "address": "address",
            "lat": "lat",
            "lng": "lng",
            "facebook": "facebook",
            "twitter": "twitter",
            "linkedin": "linkedin",
            "youtube": "youtube",
            "SEO_company_page_title": "SEO company page title",
            "SEO_company_page_metatags": "SEO company page metatags",
            "is_recommended": "is recommended",
            "views_count": "views count",
            "sort": "sort",
            "active": "active",
            "created_at": "created at",
            "updated_at": "updated at",
            "companies": "companies",
            "Companie": "Companie",
            "Companies": "Companies",
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
            "Add_new_company": "Add new company",
            "city": "city",
            "country": "country",
            };