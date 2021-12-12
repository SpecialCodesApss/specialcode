
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
            "country_id": "البلد",
            "slug": "الاسم المختصر المميز",
            "name_ar": "الاسم بالعربية",
            "name_en": "الاسم بالانجليزية",
            "work_title": "المسمي الوظيفي",
            "Biographical_info_ar": "السيرة الذاتية بالعربية",
            "Biographical_info_en": "السيرة الذاتية بالإنجليزية",
            "profile_image": "الصورة الشخصية",
            "email": "البريد الإلكتروني",
            "website_link": "الموقع الإلكتروني",
            "facebook": "الفيسبوك",
            "twitter": "تويتر",
            "linkedin": "لينكدان",
            "SEO_auther_page_title": "صفحة SEO",
            "SEO_auther_page_metatags": "SEO الكلمات الدليلية",
            "sort": "الترتيب",
            "active": "التفعيل",
            "created_at": "أنشئت في",
            "updated_at": "تم التحديث في",
            "news_authers": "المحررين ",
            "News_auther": "الأخبار",
            "News_authers": "المحررين ",
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