<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */
 'accepted'             => 'يجب قبول خانة :attribute.',
    'active_url'           => 'خانة :attribute لا يُمثّل رابطًا صحيحًا.',
    'after'                => 'يجب على خانة :attribute أن يكون تاريخًا لاحقًا للتاريخ :date.',
    'after_or_equal'       => 'خانة :attribute يجب أن يكون تاريخاً لاحقاً أو مطابقاً للتاريخ :date.',
    'alpha'                => 'يجب أن لا يحتوي خانة :attribute سوى على حروف.',
    'alpha_dash'           => 'يجب أن لا يحتوي خانة :attribute سوى على حروف، أرقام ومطّات.',
    'alpha_num'            => 'يجب أن يحتوي خانة :attribute على حروفٍ وأرقامٍ فقط.',
    'array'                => 'يجب أن يكون خانة :attribute ًمصفوفة.',
    'before'               => 'يجب على خانة :attribute أن يكون تاريخًا سابقًا للتاريخ :date.',
    'before_or_equal'      => 'خانة :attribute يجب أن يكون تاريخا سابقا أو مطابقا للتاريخ :date.',
    'between'              => [
        'numeric' => 'يجب أن تكون  خانة :attribute بين :min و :max.',
        'file'    => 'يجب أن يكون حجم الملف خانة :attribute بين :min و :max كيلوبايت.',
        'string'  => 'يجب أن يكون عدد حروف النّص خانة :attribute بين :min و :max.',
        'array'   => 'يجب أن يحتوي خانة :attribute على عدد من العناصر بين :min و :max.',
    ],
    'boolean'              => 'يجب أن تكون  خانة :attribute إما true أو false .',
    'confirmed'            => 'حقل تأكيد :attribute غير مُطابق إلى خانة :attribute.',
    'date'                 => 'خانة :attribute ليس تاريخًا صحيحًا.',
    'date_equals'          => 'يجب أن يكون خانة :attribute مطابقاً للتاريخ :date.',
    'date_format'          => 'لا يتوافق خانة :attribute مع الشكل :format.',
    'different'            => 'يجب أن يكون الحقلان خانة :attribute و :other مُختلفين.',
    'digits'               => 'يجب أن يحتوي خانة :attribute على :digits أرقام.',
    'digits_between'       => 'يجب أن يحتوي خانة :attribute بين :min و :max رقمًا/أرقام .',
    'dimensions'           => 'الـ خانة :attribute يحتوي على أبعاد صورة غير صالحة.',
    'distinct'             => 'للحقل خانة :attribute خانة مُكرّرة.',
    'email'                => 'يجب أن يكون خانة :attribute عنوان بريد إلكتروني صحيح .',
    'exists'               => 'الخانة المحددة خانة :attribute غير موجودة.',
    'file'                 => 'الـ خانة :attribute يجب أن يكون ملفا.',
    'filled'               => 'خانة :attribute إجباري.',
    'gt'                   => [
        'numeric' => 'يجب أن تكون  خانة :attribute أكبر من :value.',
        'file'    => 'يجب أن يكون حجم الملف خانة :attribute أكبر من :value كيلوبايت.',
        'string'  => 'يجب أن يكون طول النّص خانة :attribute أكثر من :value حروفٍ.',
        'array'   => 'يجب أن يحتوي خانة :attribute على أكثر من :value عناصر/عنصر.',
    ],
    'gte'                  => [
        'numeric' => 'يجب أن تكون  خانة :attribute مساوية أو أكبر من :value.',
        'file'    => 'يجب أن يكون حجم الملف خانة :attribute على الأقل :value كيلوبايت.',
        'string'  => 'يجب أن يكون طول النص خانة :attribute على الأقل :value حروفٍ.',
        'array'   => 'يجب أن يحتوي خانة :attribute على الأقل على :value عُنصرًا/عناصر.',
    ],
    'image'                => 'يجب أن يكون خانة :attribute صورةً.',
    'in'                   => 'خانة :attribute غير موجود.',
    'in_array'             => 'خانة :attribute غير موجود في :other.',
    'integer'              => 'يجب أن يكون خانة :attribute عددًا صحيحًا.',
    'ip'                   => 'يجب أن يكون خانة :attribute عنوان IP صحيحًا.',
    'ipv4'                 => 'يجب أن يكون خانة :attribute عنوان IPv4 صحيحًا.',
    'ipv6'                 => 'يجب أن يكون خانة :attribute عنوان IPv6 صحيحًا.',
    'json'                 => 'يجب أن يكون خانة :attribute نصآ من نوع JSON.',
    'lt'                   => [
        'numeric' => 'يجب أن تكون  خانة :attribute أصغر من :value.',
        'file'    => 'يجب أن يكون حجم الملف خانة :attribute أصغر من :value كيلوبايت.',
        'string'  => 'يجب أن يكون طول النّص خانة :attribute أقل من :value حروفٍ/حرفًا.',
        'array'   => 'يجب أن يحتوي خانة :attribute على أقل من :value عناصر/عنصر.',
    ],
    'lte'                  => [
        'numeric' => 'يجب أن تكون  خانة :attribute مساوية أو أصغر من :value.',
        'file'    => 'يجب أن لا يتجاوز حجم الملف خانة :attribute :value كيلوبايت.',
        'string'  => 'يجب أن لا يتجاوز طول النّص خانة :attribute :value حروفٍ/حرفًا.',
        'array'   => 'يجب أن لا يحتوي خانة :attribute على أكثر من :value عناصر/عنصر.',
    ],
    'max'                  => [
        'numeric' => 'يجب أن تكون  خانة :attribute مساوية أو أصغر من :max.',
        'file'    => 'يجب أن لا يتجاوز حجم الملف خانة :attribute :max كيلوبايت.',
        'string'  => 'يجب أن لا يتجاوز طول النّص خانة :attribute :max حروفٍ/حرفًا.',
        'array'   => 'يجب أن لا يحتوي خانة :attribute على أكثر من :max عناصر/عنصر.',
    ],
    'mimes'                => 'يجب أن يكون ملفًا من نوع : :values.',
    'mimetypes'            => 'يجب أن يكون ملفًا من نوع : :values.',
    'min'                  => [
        'numeric' => 'يجب أن تكون  خانة :attribute مساوية أو أكبر من :min.',
        'file'    => 'يجب أن يكون حجم الملف خانة :attribute على الأقل :min كيلوبايت.',
        'string'  => '  خانة :attribute يجب أن تكون  :min أحرف أو ارقام على الأقل ',
        'array'   => 'يجب أن يحتوي خانة :attribute على الأقل على :min عُنصرًا/عناصر.',
    ],
    'not_in'               => 'خانة :attribute موجود.',
    'not_regex'            => 'صيغة خانة :attribute غير صحيحة.',
    'numeric'              => 'يجب على خانة :attribute أن يكون رقمًا.',
    'present'              => 'يجب تقديم خانة :attribute.',
    'regex'                => 'صيغة خانة :attribute .غير صحيحة.',
    'required'             => 'خانة :attribute مطلوبة.',
    'required_if'          => 'خانة :attribute مطلوبة في حال ما إذا كان :other  :value.',
    'required_unless'      => 'خانة :attribute مطلوبة في حال ما لم يكن :other يساوي :values.',
    'required_with'        => 'خانة :attribute مطلوبة إذا توفّر :values.',
    'required_with_all'    => 'خانة :attribute مطلوبة إذا توفّر :values.',
    'required_without'     => 'خانة :attribute مطلوبة إذا لم يتوفّر :values.',
    'required_without_all' => 'خانة :attribute مطلوبة إذا لم يتوفّر :values.',
    'same'                 => 'يجب أن يتطابق خانة :attribute مع :other.',
    'size'                 => [
        'numeric' => 'يجب أن تكون  خانة :attribute مساوية لـ :size.',
        'file'    => 'يجب أن يكون حجم الملف خانة :attribute :size كيلوبايت.',
        'string'  => 'يجب أن يحتوي النص خانة :attribute على :size حروفٍ/حرفًا بالضبط.',
        'array'   => 'يجب أن يحتوي خانة :attribute على :size عنصرٍ/عناصر بالضبط.',
    ],
    'starts_with'          => 'يجب أن يبدأ خانة :attribute بأحد القيم التالية: :values',
    'string'               => 'يجب أن يكون خانة :attribute نصًا.',
    'timezone'             => 'يجب أن يكون خانة :attribute نطاقًا زمنيًا صحيحًا.',
    'unique'               => ' خانة :attribute مسجل لدينا',
    'uploaded'             => 'فشل في تحميل الـ خانة :attribute.',
    'url'                  => 'صيغة الرابط خانة :attribute غير صحيحة.',
    'uuid'                 => 'خانة :attribute يجب أن يكون بصيغة UUID سليمة.',
    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */
    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
//        'email'                 => 'البريد الالكتروني',
//        'password'              => 'الرقم السري ',
//        'password_confirmation' => 'تأكيد كلمة المرور',
//        'mobile'                => 'الجوال',
//        'size'                  => 'الحجم',
//        'login'                 => 'البريد الالكترونى او رقم الجوال',
//        'image'                 => 'الصورة',
//        'message'               =>  'الرساله',
//        'name_ar'               => 'الاسم باللغه العربيه',
//        'name_en'               => 'الاسم باللغه الانجليزيه',
//        'discount'              => 'الخصم',
//        'description_en'        => 'الوصف باللغه الانجليزيه',
//        'description_ar'        => 'الوصف باللغه العربيه',
//        'name'                  => 'الاسم',
//        'code'                  => 'الكود',
//        'question_ar'           => 'السؤال باللغه العربيه',
//        'question_en'           => 'السؤال باللغه الانجليزيه',
//        'answer_ar'             => 'الاجابه باللغه العربيه',
//        'answer_en'             => 'الاجابه باللغه الانجليزيه',
//        'address_en'            => 'العنوان باللغه الانجليزيه',
//        'address_ar'            => 'العنوان باللغه العربيه',
//        'phone'                 => 'رقم التليفون',
//        'city id'               => 'المدينه',
//        'region_id'             => 'المنطقه',
//        'store_id'              => 'المتجر',
//        'confirm_password'   => 'تأكيد الرقم السري' ,
//        'c_password'   => 'تأكيد الرقم السري' ,
//        'confirm_new_password'   => 'تأكيد الرقم السري' ,
//        'old_password'      => 'الرقم السري الحالى ',
//        'new_password'      => 'الرقم السري الجديد ',
//        'receive_the_card_type' => 'طريقة استلام البطاقة' ,
//        'payment_method'  => 'طريقة الدفع' ,
//        'Bank_Transfer'  => 'تحويل بنكي' ,
//        'image'=>'الصورة',
//        'url'=>'الرابط',
//        'active'=>'التفعيل',
//        'sort'=>'الترتيب',
//        'flag'=>'العلامة المميزة',
//        'name_ar'=>'الاسم العربي',
//        'name_en'=>'الاسم الانجليزي',
//        'icon_text'=>'الايقونة',
//        'image'=>'الصورة',
//        'value_ar'=>'القيمة عربي',
//        'value_en'=>'القيمة انجليزي',
//        'content_key'=>'مفتاح الوصول',
//        'cp_name'=>'الاسم',
//        'content_ar'=>'المحتوي عربي',
//        'content_en'=>'المحتوي الانجليزي',
//        'question_ar'=>'السؤال بالعربية',
//        'question_en'=>'السؤال بالانجليزية',
//        'answer_ar'=>'الاجابة بالعربية',
//        'answer_en'=>'الاجابة بالانجليزية',
//        'active'=>'التفعيل',
//        'sort'=>'الترتيب',
//        'page_key'=>'مفتاح الصفحة',
//        'title_ar'=>'العنوان عربي',
//        'title_en'=>'العنوان انجليزي',
//        'html_page_ar'=>'المحتوي بالعربية',
//        'html_page_en'=>'المحتوي بالإنجليزية',


    ],

];
