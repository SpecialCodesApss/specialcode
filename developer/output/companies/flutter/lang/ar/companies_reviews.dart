
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
            "company_id": "الشركة",
            "user_id": "المستخدم",
            "rate_stars_count": "التقييم",
            "comment": "التعليق",
            "users_likes_ids": "المستخدمون المعجبون",
            "users_dislikes_ids": "المستخدمون الغير معجبون",
            "active": "التفعيل",
            "created_at": "أنشئت في",
            "updated_at": "تم التحديث في",
            "companies_reviews": "الشركات_مراجعات",
            "Companies_review": "تقييم الشركة",
            "Companies_reviews": "تقييمات الشركة",
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

              "Rating_box_title": "تقييم الشركة",
              "Rating_box_description": "اضغط على النجوم لتقييم الشركة ، كما يمكنك إضافة تعليق خاص بك",
              "Rating_box_Submitbtn_text": "إرسال التقييم",
            };