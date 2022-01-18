
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
            "user_id": "كود المستخدم",
            "fullname": "الاسم الكامل",
            "email": "البريد الإلكتروني",
            "mobile": "الموبايل",
            "message_type": "نوع الرسالة",
            "image": "صورة توضيحية",
            "messages_text": "نص الرسالة",
            "open_status": "حالة الرسالة",
            "marked_as_readed": "مقروء",
            "marked_as_deleted": "محذوف",
            "created_at": "أنشئت في",
            "updated_at": "تم التحديث في",
            "admin_messages": "admin_messages",
            "Admin_message": "Admin_message",
            "Admin_messages": "Admin_messages",
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
              "Complaint": "مشكلة",
              "Suggestion": "اقتراح",
              "Technical Support": "دعم فني",
              "Management": "الإدارة",
            };
