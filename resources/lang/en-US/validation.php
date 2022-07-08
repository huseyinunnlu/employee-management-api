<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Doğrulama
    |--------------------------------------------------------------------------
    |
    | Aşağıdaki öğeler doğrulama(validation) işlemleri sırasında kullanılan varsayılan hata
    | mesajlarını içermektedir. `size` gibi bazı kuralların birden çok çeşidi
    | bulunmaktadır. Her biri ayrı ayrı düzenlenebilir.
    |
    */

    'accepted' => 'The :attribute must be accepted.',
    'accepted_if' => 'The :attribute must be accepted when :other is :value.',
    'active_url' => 'The :attribute is not a valid URL.',
    'after' => 'The :attribute must be a date after :date.',
    'after_or_equal' => 'The :attribute must be a date after or equal to :date.',
    'alpha' => 'The :attribute must only contain letters.',
    'alpha_dash' => 'The :attribute must only contain letters, numbers, dashes and underscores.',
    'alpha_num' => 'The :attribute must only contain letters and numbers.',
    'array' => 'The :attribute must be an array.',
    'before' => 'The :attribute must be a date before :date.',
    'before_or_equal' => 'The :attribute must be a date before or equal to :date.',
    'between' => [
        'numeric' => 'The :attribute must be between :min and :max.',
        'file' => 'The :attribute must be between :min and :max kilobytes.',
        'string' => 'The :attribute must be between :min and :max characters.',
        'array' => 'The :attribute must have between :min and :max items.',
    ],
    'boolean' => 'The :attribute field must be true or false.',
    'confirmed' => 'The :attribute confirmation does not match.',
    'current_password' => 'The password is incorrect.',
    'date' => 'The :attribute is not a valid date.',
    'date_equals' => 'The :attribute must be a date equal to :date.',
    'date_format' => 'The :attribute does not match the format :format.',
    'different' => 'The :attribute and :other must be different.',
    'digits' => 'The :attribute must be :digits digits.',
    'digits_between' => 'The :attribute must be between :min and :max digits.',
    'dimensions' => 'The :attribute has invalid image dimensions.',
    'distinct' => 'The :attribute field has a duplicate value.',
    'email' => 'The :attribute must be a valid email address.',
    'ends_with' => 'The :attribute must end with one of the following: :values.',
    'exists' => 'The selected :attribute is invalid.',
    'file' => 'The :attribute must be a file.',
    'filled' => 'The :attribute field must have a value.',
    'gt' => [
        'numeric' => 'The :attribute must be greater than :value.',
        'file' => 'The :attribute must be greater than :value kilobytes.',
        'string' => 'The :attribute must be greater than :value characters.',
        'array' => 'The :attribute must have more than :value items.',
    ],
    'gte' => [
        'numeric' => 'The :attribute must be greater than or equal to :value.',
        'file' => 'The :attribute must be greater than or equal to :value kilobytes.',
        'string' => 'The :attribute must be greater than or equal to :value characters.',
        'array' => 'The :attribute must have :value items or more.',
    ],
    'image' => 'The :attribute must be an image.',
    'in' => 'The selected :attribute is invalid.',
    'in_array' => 'The :attribute field does not exist in :other.',
    'integer' => 'The :attribute must be an integer.',
    'ip' => 'The :attribute must be a valid IP address.',
    'ipv4' => 'The :attribute must be a valid IPv4 address.',
    'ipv6' => 'The :attribute must be a valid IPv6 address.',
    'json' => 'The :attribute must be a valid JSON string.',
    'lt' => [
        'numeric' => 'The :attribute must be less than :value.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'string' => 'The :attribute must be less than :value characters.',
        'array' => 'The :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'The :attribute must be less than or equal to :value.',
        'file' => 'The :attribute must be less than or equal to :value kilobytes.',
        'string' => 'The :attribute must be less than or equal to :value characters.',
        'array' => 'The :attribute must not have more than :value items.',
    ],
    'max' => [
        'numeric' => 'The :attribute must not be greater than :max.',
        'file' => 'The :attribute must not be greater than :max kilobytes.',
        'string' => 'The :attribute must not be greater than :max characters.',
        'array' => 'The :attribute must not have more than :max items.',
    ],
    'mimes' => 'The :attribute must be a file of type: :values.',
    'mimetypes' => 'The :attribute must be a file of type: :values.',
    'min' => [
        'numeric' => 'The :attribute must be at least :min.',
        'file' => 'The :attribute must be at least :min kilobytes.',
        'string' => 'The :attribute must be at least :min characters.',
        'array' => 'The :attribute must have at least :min items.',
    ],
    'multiple_of' => 'The :attribute must be a multiple of :value.',
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'The :attribute format is invalid.',
    'numeric' => 'The :attribute must be a number.',
    'password' => 'The password is incorrect.',
    'present' => 'The :attribute field must be present.',
    'regex' => 'The :attribute format is invalid.',
    'required' => 'The :attribute field is required.',
    'required_if' => 'The :attribute field is required when :other is :value.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => 'The :attribute field is required when :values is present.',
    'required_with_all' => 'The :attribute field is required when :values are present.',
    'required_without' => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'prohibited' => 'The :attribute field is prohibited.',
    'prohibited_if' => 'The :attribute field is prohibited when :other is :value.',
    'prohibited_unless' => 'The :attribute field is prohibited unless :other is in :values.',
    'prohibits' => 'The :attribute field prohibits :other from being present.',
    'same' => 'The :attribute and :other must match.',
    'size' => [
        'numeric' => 'The :attribute must be :size.',
        'file' => 'The :attribute must be :size kilobytes.',
        'string' => 'The :attribute must be :size characters.',
        'array' => 'The :attribute must contain :size items.',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values.',
    'string' => 'The :attribute must be a string.',
    'timezone' => 'The :attribute must be a valid timezone.',
    'unique' => 'The :attribute has already been taken.',
    'uploaded' => 'The :attribute failed to upload.',
    'url' => 'The :attribute must be a valid URL.',
    'uuid' => 'The :attribute must be a valid UUID.',

    /*
    |--------------------------------------------------------------------------
    | Özelleştirilmiş doğrulama mesajları
    |--------------------------------------------------------------------------
    |
    | Bu alanda her niteleyici (attribute) ve kural (rule) ikilisine özel hata
    | mesajları tanımlayabilirsiniz. Bu özellik, son kullanıcıya daha gerçekçi
    | metinler göstermeniz için oldukça faydalıdır.
    |
    | Örnek:
    | 'invalid_extension'     => 'Dosyanın uzantısı geçersiz.',
    |
    */


    /*
    |--------------------------------------------------------------------------
    | Özelleştirilmiş niteleyici isimleri
    |--------------------------------------------------------------------------
    |
    | Bu alandaki bilgiler "email" gibi niteleyici isimlerini "E-Posta adres"
    | gibi daha okunabilir metinlere çevirmek için kullanılır. Bu bilgiler
    | hata mesajlarının daha temiz olmasını sağlar.
    |
    | Örnek:
    |
    | 'email' => 'E-Posta adresi',
    | 'password' => 'Şifre',
    |
    */

    'attributes' => [
        "start_date" => "Permit start date",
        "end_date" => "Permit end date",
        "days.*" => "Days",
        "end_time" => "Permit end time",
        "start_time" => "Permit start time",
        "notes" => "Notes",
        "type_id" => "Type",
        "user_id" => "User",
        "role_id" => "Role",
        "musteri_id" => "Müşteri",
        "company_id" => "Company",
        "department_id" => "Department",
        "employeer_branch_id" => "Employeer branch",
        "position_id" => "Position",
        "manager_id" => "Manager",
        "work_place_id" => "Work place",
        "job_id" => "Job",
        "insurance_no" => "SGK Insurance no",
        "birthday" => "Birthday",
        "work_type" => "Work type",
        "work_status" => "Work status",
        "insurance_status" => "Insurance status",
        "language_id" => "Language",
        "businness_arragnment_type" => "Business arrangment type",
        "arrangment_end_date" => "Arrangment end date",
        "disability_status" => "Disability status",
        "first_name" => "First name",
        "last_name" => "Last name",
        "id_number" => "Id number",
        "id_serie_number" => "Id serie number",
        "email" => "E-mail",
        "registration_number" => "Registration number",
        "can_sign_in" => "User can sign-in",
        "can_edit_profile" => "User can edit own profile",
        "can_edit_email" => "User can edit own email",
        "can_see_salary" => "User can edit own salary information",
        "date.*" => "Date",
        "date" => "Date",
        "day_type" => "Day type",
        "status" => "Status",
        "users" => "Users",
        "users.*" => "Users",
        "absenceTypes.*.title" => "Permit type title",
        "absenceTypes.*.lang_code" => "Permit type language",
        "documentTypes.*.title" => "Permit type title",
        "documentTypes.*.lang_code" => "Permit type title language",
        "title" => "Title",
        "address" => "Address",
        "permittedUsers" => "Permitted users",
        "logo" => "Logo",
        "city_id" => "City",
        "mountly_holiday" => "Mounthly permit day count",
        "daily_work_hour" => "Daily work time",
        "overtime_rate" => "Overtime rate",
        "overtime_type" => "Overtime type",
        "food_fee_tax" => "Meal price includes VAT",
        "road_fee_tax" => "Road price incldes VAT",
        "permittedUsers.*" => "Permitted users",
        "employeer_title" => "Employeer title",
        "tax" => "Tax Administration",
        "tax_no" => "Tax number",
        "website" => "Website",
        "workplace_registration_number" => "Workplace registration number",
        "commercial_registration_number" => "Commercial registration number",
        "serial" => "Serie number",
        "zipcode" => "Zipcode",
        "phone" => "Phone",
        "fax" => "Fax",
        "registration_no" => "Registration number",
        "iban" => "IBAN",
        "positions" => "Positions",
        "positions.*.title" => "Position title",
        "positions.*.lang_code" => "Position lang code",
        "morning" => "Morning",
        "morning.start_time" => "Morning start time",
        "morning.end_time" => "Morning end time",
        "morning.break_time" => "Morning break time",
        "afternoon" => "Afternoon",
        "afternoon.start_time" => "Afternoon start time",
        "afternoon.end_time" => "Afternoon end time",
        "afternoon.break_time" => "Afternoon break time",
        "night" => "Night",
        "night.start_time" => "Night start time",
        "night.end_time" => "Night end time",
        "night.break_time" => "Night break time",
        "full" => "Tüm gün",
        "full.start_time" => "Tüm gün start time",
        "full.end_time" => "Tüm gün end time",
        "full.break_time" => "Tüm gün mola time",
        "report" => "Report",
        "report.start_time" => "Report start time",
        "report.end_time" => "Report end time",
        "report.break_time" => "Report break time",
        "annual" => "Annual permit",
        "annual.start_time" => "Annual permit start time",
        "annual.end_time" => "Annual permit end time",
        "annual.break_time" => "Annual permit break time",
        "permit" => "Permit",
        "permit.start_time" => "Permit start time",
        "permit.end_time" => "Permit end time",
        "permit.break_time" => "Permit breal time",
        "desc" => "Notes",
        "file" => "File",
        "price" => "Expense cost",
        "lines" => "Expense lines",
        "lines.*.date" => "Expense line date",
        "lines.*.desc" => "Expense line description",
        "lines.*.file" => "Expense line file",
        "lines.*.price" => "Expense cost",
        "lines.*.type_id" => "Expense type",
        "password" => "Password",
        "date.0" => "Start date",
        "date.1" => "End date",
        "contact_phone" => "Contact phone",
        "place" => "Vacation",
        "issuer" => "Issuer",
        "giving_date" => "Giving date",
        "finish_date" => "Finish date",
        "inventory_id" => "Inventory",
        "inventory_photo" => "Inventory photo",
        "is_see_document" => "User can see the file",
        "graduated_school" => "Graduated school",
        "department" => "Department",
        "start_year" => "Start year",
        "finish_year" => "End year",
        "cerifticate_grade" => "Certificate grade",
        "photo" => "Photo",
        "location_id" => "Location",
        "full_name" => "Full name",
        "work_place_name" => "Work place name",
        "experience" => "Experience",
        "current_password" => "Current password",
        "password_confirmation" => "Confirm password",
        "born_place_id" => "Born place",
        "gender" => "Gender",
        "nation_id" => "Nation",
        "licences" => "Licences",
        "work_days" => "Work days",
        "licence_date" => "Licence date",
        "military_status" => "Military status",
        "blood_grup" => "Blood group",
        "mariance_status" => "Marital status",
        "is_smoking" => "Smoking",
        "father_name" => "Father name",
        "mother_name" => "Mother name",
        "important_or_surgeon" => "Major illness/surgery",
        "home_phone" => "Home phone",
        "personal_phone" => "Personal phone",
        "work_phone" => "Work phone",
        "whatsapp_phone" => "WhatsApp phone",
        "pdks_id" => "Pdks",
        "exempt_rate" => "Exempt rate",
        "tgb_start_date" => "TGB start date",
        "leave_date" => "Leave date",
        "leave_reason" => "Leave reasons",
    ]
];
