
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
        "id": "كود التعريف",
            "name_ar": "الاسم بالعربية",
            "name_en": "الاسم بالانجليزية",
            "slug": "الاسم المميز المختصر",
            "country_flag": "علم الدولة",
            "country_alpha2_code": "الرمز الثنائي للدولة",
            "country_alpha3_code": "الرمز الثلاثي للدولة",
            "languages": "اللغات",
            "currencies": "العملات",
            "active": "التفعيل",
            "sort": "الترتيب",
            "created_at": "أنشئت في",
            "updated_at": "تم التحديث في",
            "countries": "الدول",
            "Countrie": "الدولة",
            "Countries": "الدول",
            "searchHere": "ابحث هنا ..",
            "NoListData": "عفوا لايوجد مزيد من البيانات",
            "pullupload": "اسحب لتحميل المزيد من البيانات",
            "loadFailed": "فشل تحميل المزيد من البيانات",
            "releaseToloadMore": "حرر يدك لعرض البيانات",
            "NomoreData": "لايوجد المزيد من البيانات",
            "SARcurrency": " ر.س ",
            "pleasefillallfields": "من فضلك اكتب بيانات جميع الحقول",
            "create": "إضافة",
            "noImageSelected": "لم يتم اختيار صورة",
            "update": "تحديث",
            "yes": "نعم",
            "no": "لا",
            "order": "اطلب",
            "edit": "تعديل",
            "delete": "حذف",
            };