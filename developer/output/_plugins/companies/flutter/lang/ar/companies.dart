
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
            "categories": "التصنيفات",
            "country_id": "الدولة",
            "city_id": "المدينة",
            "slug": "الاسم المختصر المميز",
            "company_name_ar": "الاسم بالعربيه",
            "company_name_en": "الاسم بالانجليزيه",
            "description_ar": "الوصف بالعربية",
            "description_en": "الوصف بالانجليزية",
            "logo_image": "شعار الشركة",
            "email": "البريد الإلكتروني",
            "phone_number": "رقم التليفون",
            "whatsapp_number": "رقم الواتس اب",
            "website_link": "رابط الموقع",
            "address": "العنوان",
            "lat": "احداثي خط الطول",
            "lng": "احداثي خط العرض",
            "facebook": "الفيسبوك",
            "twitter": "تويتر",
            "linkedin": "لينكدان",
            "youtube": "اليوتيوب",
            "SEO_company_page_title": "SEO company page title",
            "SEO_company_page_metatags": "SEO company page metatags",
            "is_recommended": "موصى به",
            "views_count": "عدد الزيارات",
            "sort": "الترتيب",
            "active": "التفعيل",
            "created_at": "أنشئت في",
            "updated_at": "تم التحديث في",
            "companies": "شركات",
            "Companie": "شركة",
            "Companies": "شركات",
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
            "Add_new_company": "إضافه بيانات شركة جديده",
            "city": "المدينه",
            "country": "الدوله",
            };