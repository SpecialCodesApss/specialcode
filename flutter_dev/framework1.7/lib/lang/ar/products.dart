
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
            "user_id": "معرف المستخدم",
            "name_ar": "الاسم بالعربية",
            "name_en": "الاسم بالانجليزية",
            "image": "الصورة",
            "active": "التفعيل",
            "sort": "الترتيب",
            "created_at": "أنشئت في",
            "updated_at": "تم التحديث في",
            "products": "منتجات",
            "Product": "منتج",
            "Products": "منتجات",
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