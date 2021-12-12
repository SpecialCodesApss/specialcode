
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
            "category_id": "التصنيف",
            "publisher_newspaper_id": "صحيفة النشر",
            "auther_id": "المحرر",
            "country_id": "البلد",
            "city_id": "المدينة",
            "title_ar": "العنوان بالعربية",
            "sub_title_ar": "العنوان الفرعي بالعربية",
            "content_ar_html": "المحتوي بالعربية",
            "title_en": "العنوان بالإنجليزية",
            "sub_title_en": "العنوان الفرعي بالإنجليزية",
            "content_en_html": "المحتوي بالإنجليزية",
            "image": "الصورة",
            "image_caption": "عنوان الصورة",
            "is_video_news": "من أخبار الفيديوهات",
            "video": "رابط الفيديو",
            "published": "متاح للنشر",
            "publish_date": "تاريخ النشر",
            "archive_date": "تاريخ الأرشيف",
            "news_types_tags": "علامات أنواع الأخبار",
            "permalink_tag": "علامة الرابط الثابت",
            "SEO_tags": "علامات تحسين محركات البحث",
            "is_comment_allowed": "مسموح بالتعليق",
            "is_breaking_news": "من الأخبار العاجلة",
            "is_slider_news": "من الأخبار المتحركة",
            "is_company_news": "من أخبار الشركات",
            "company_id": "الشركة",
            "news_languages": "لغات الخبر",
            "views_count": "عدد المشاهدات",
            "comments_count": "عدد التعليقات",
            "sort": "الترتيب",
            "created_at": "أنشئت في",
            "updated_at": "تم التحديث في",
            "news": "الإخبارية",
            "News": "أخبار",
            "News": "أخبار",
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