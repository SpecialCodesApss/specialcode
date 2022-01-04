
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
            "parent_category_id": "التصنيف الرئيسي",
            "slug": "الاسم المختصر المميز",
            "name_ar": "الاسم بالعربية",
            "name_en": "الاسم بالانجليزية",
            "description_ar": "الوصف بالعربية",
            "description_en": "الوصف بالانجليزية",
            "category_image": "صورة التصنيف",
            "category_icon": "ايقونة التصنيف",
            "sort": "الترتيب",
            "active": "التفعيل",
            "created_at": "أنشئت في",
            "updated_at": "تم التحديث في",
            "news_categories": "تصنيفات الأخبار",
            "News_categorie": "تصنيف الخبر",
            "News_categories": "تصنيفات الأخبار",
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