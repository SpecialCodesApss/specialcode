
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
            "newspaper_name_ar": "اسم الصحيفة بالعربية",
            "newspaper_name_en": "اسم الصحيفة بالإنجليزية",
            "description_ar": "الوصف بالعربية",
            "description_en": "الوصف بالانجليزية",
            "logo_image": "الشعار",
            "email": "البريد الإلكتروني",
            "website_link": "رابط الموقع",
            "facebook": "الفيسبوك",
            "twitter": "تويتر",
            "linkedin": "لينكدان",
            "SEO_newspaper_page_title": "عنوان SEO",
            "SEO_newspaper_page_metatags": "SEO الكلمات الدليليه",
            "sort": "الترتيب",
            "active": "التفعيل",
            "created_at": "أنشئت في",
            "updated_at": "تم التحديث في",
            "news_newspaper_publishers": "الصحف الإخبارية",
            "News_newspaper_publisher": "صحيفة الأخبار",
            "News_newspaper_publishers": "الصحف الإخبارية",
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