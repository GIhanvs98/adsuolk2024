<?php 

return [
    'accepted' => '您必须接受 :attribute。',
    'active_url' => ':attribute 不是一个有效的网址。',
    'after' => ':attribute 必须要晚于 :date。',
    'after_or_equal' => ':attribute 必须要等于 :date 或更晚。',
    'alpha' => ':attribute 只能由字母组成。',
    'alpha_dash' => ':attribute 只能由字母、数字、短划线(-)和下划线(_)组成。',
    'alpha_num' => ':attribute 只能由字母和数字组成。',
    'array' => ':attribute 必须是一个数组。',
    'before' => ':attribute 必须要早于 :date。',
    'before_or_equal' => ':attribute 必须要等于 :date 或更早。',
    'between' => [
        'numeric' => ':attribute 必须介于 :min - :max 之间。',
        'file' => ':attribute 必须介于 :min - :max KB 之间。',
        'string' => ':attribute 必须介于 :min - :max 个字符之间。',
        'array' => ':attribute 必须只有 :min - :max 个单元。',
    ],
    'boolean' => ':attribute 必须为布尔值。',
    'confirmed' => ':attribute 两次输入不一致。',
    'date' => ':attribute 不是一个有效的日期。',
    'date_equals' => ':attribute 必须要等于 :date。',
    'date_format' => ':attribute 的格式必须为 :format。',
    'different' => ':attribute 和 :other 必须不同。',
    'digits' => ':attribute 必须是 :digits 位的数字。',
    'digits_between' => ':attribute 必须是介于 :min 和 :max 位的数字。',
    'dimensions' => ':attribute 图片尺寸不正确。',
    'distinct' => ':attribute 已经存在。',
    'email' => ':attribute 不是一个合法的邮箱。',
    'exists' => ':attribute 不存在。',
    'file' => ':attribute 必须是文件。',
    'filled' => ':attribute 不能为空。',
    'gt' => [
        'numeric' => ':attribute 必须大于 :value。',
        'file' => ':attribute 必须大于 :value KB。',
        'string' => ':attribute 必须多于 :value 个字符。',
        'array' => ':attribute 必须多于 :value 个元素。',
    ],
    'gte' => [
        'numeric' => ':attribute 必须大于或等于 :value。',
        'file' => ':attribute 必须大于或等于 :value KB。',
        'string' => ':attribute 必须多于或等于 :value 个字符。',
        'array' => ':attribute 必须多于或等于 :value 个元素。',
    ],
    'image' => ':attribute 必须是图片。',
    'in' => '已选的属性 :attribute 非法。',
    'in_array' => ':attribute 没有在 :other 中。',
    'integer' => ':attribute 必须是整数。',
    'ip' => ':attribute 必须是有效的 IP 地址。',
    'ipv4' => ':attribute 必须是有效的 IPv4 地址。',
    'ipv6' => ':attribute 必须是有效的 IPv6 地址。',
    'json' => ':attribute 必须是正确的 JSON 格式。',
    'lt' => [
        'numeric' => ':attribute 必须小于 :value。',
        'file' => ':attribute 必须小于 :value KB。',
        'string' => ':attribute 必须少于 :value 个字符。',
        'array' => ':attribute 必须少于 :value 个元素。',
    ],
    'lte' => [
        'numeric' => ':attribute 必须小于或等于 :value。',
        'file' => ':attribute 必须小于或等于 :value KB。',
        'string' => ':attribute 必须少于或等于 :value 个字符。',
        'array' => ':attribute 必须少于或等于 :value 个元素。',
    ],
    'max' => [
        'numeric' => ':attribute 不能大于 :max。',
        'file' => ':attribute 不能大于 :max KB。',
        'string' => ':attribute 不能大于 :max 个字符。',
        'array' => ':attribute 最多只有 :max 个单元。',
    ],
    'mimes' => ':attribute 必须是一个 :values 类型的文件。',
    'mimetypes' => ':attribute 必须是一个 :values 类型的文件。',
    'min' => [
        'numeric' => ':attribute 必须大于等于 :min。',
        'file' => ':attribute 大小不能小于 :min KB。',
        'string' => ':attribute 至少为 :min 个字符。',
        'array' => ':attribute 至少有 :min 个单元。',
    ],
    'not_in' => '已选的属性 :attribute 非法。',
    'not_regex' => ':attribute 的格式错误。',
    'numeric' => ':attribute 必须是一个数字。',
    'present' => ':attribute 必须存在。',
    'regex' => ':attribute 格式不正确。',
    'required' => ':attribute 不能为空。',
    'required_if' => '当 :other 为 :value 时 :attribute 不能为空。',
    'required_unless' => '当 :other 不为 :values 时 :attribute 不能为空。',
    'required_with' => '当 :values 存在时 :attribute 不能为空。',
    'required_with_all' => '当 :values 存在时 :attribute 不能为空。',
    'required_without' => '当 :values 不存在时 :attribute 不能为空。',
    'required_without_all' => '当 :values 都不存在时 :attribute 不能为空。',
    'same' => ':attribute 和 :other 必须相同。',
    'size' => [
        'numeric' => ':attribute 大小必须为 :size。',
        'file' => ':attribute 大小必须为 :size KB。',
        'string' => ':attribute 必须是 :size 个字符。',
        'array' => ':attribute 必须为 :size 个单元。',
    ],
    'starts_with' => ':attribute 必须以 :values 为开头。',
    'string' => ':attribute 必须是一个字符串。',
    'timezone' => ':attribute 必须是一个合法的时区值。',
    'unique' => ':attribute 已经存在。',
    'uploaded' => ':attribute 上传失败。',
    'url' => ':attribute 格式不正确。',
    'uuid' => ':attribute 必须是有效的 UUID。',
    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
        'database_connection' => [
            'required' => '无法连接到MySQL服务器',
        ],
        'database_not_empty' => [
            'required' => '数据库不为空。 请清空数据库或指定 <a href="./database">另一个数据库</a>。',
        ],
        'promo_code_not_valid' => [
            'required' => '促销代码无效',
        ],
        'smtp_valid' => [
            'required' => '无法连接到SMTP服务器',
        ],
        'yaml_parse_error' => [
            'required' => '无法解析yaml。 请检查语法',
        ],
        'file_not_found' => [
            'required' => '文件未找到。',
        ],
        'not_zip_archive' => [
            'required' => '该文件不是zip包。',
        ],
        'zip_archive_unvalid' => [
            'required' => '无法阅读包裹。',
        ],
        'custom_criteria_empty' => [
            'required' => '自定义条件不能为空',
        ],
        'php_bin_path_invalid' => [
            'required' => '无效的PHP可执行文件。 请再检查一次。',
        ],
        'can_not_empty_database' => [
            'required' => '无法删除某些表，请手动清理数据库，然后重试。',
        ],
        'can_not_create_database_tables' => [
            'required' => 'Cannot create certain tables. Please make sure you have full privileges on the database and try again.',
        ],
        'can_not_import_database_data' => [
            'required' => 'Cannot import all the app required data. Please try again.',
        ],
        'recaptcha_invalid' => [
            'required' => '无效的reCAPTCHA检查。',
        ],
        'payment_method_not_valid' => [
            'required' => '付款方式设置出了问题。 请再检查一次。',
        ],
        'listings_limit' => [
            'gte' => 'The package\'s :attribute must be greater than or equal to :value which represents the website\'s global :attribute value set in the "Admin panel → Settings → General → Listing Form → Listings Limit per User".',
        ],
        'pictures_limit' => [
            'gte' => 'The package\'s :attribute must be greater than or equal to :value which represents the website\'s global :attribute value set in the "Admin panel → Settings → General → Listing Form → Pictures Limit per Listing".',
        ],
        'expiration_time' => [
            'gte' => 'The package\'s :attribute must be greater than or equal to :value which represents the website\'s global :attribute value set in the "Admin panel → Settings → General → Cron → Activated Listings Expiration".',
        ],
    ],
    'attributes' => [
        'name' => '名称',
        'username' => '用户名',
        'email' => '邮箱',
        'first_name' => '名',
        'last_name' => '姓',
        'password' => '密码',
        'password_confirmation' => '确认密码',
        'city' => '城市',
        'country' => '国家',
        'address' => '地址',
        'phone' => '电话',
        'mobile' => '手机',
        'age' => '年龄',
        'sex' => '性别',
        'gender' => '性别',
        'day' => '天',
        'month' => '月',
        'year' => '年',
        'hour' => '时',
        'minute' => '分',
        'second' => '秒',
        'title' => '标题',
        'content' => '内容',
        'description' => '描述',
        'excerpt' => '摘要',
        'date' => '日期',
        'time' => '时间',
        'available' => '可用的',
        'size' => '大小',
        'gender_id' => '性别',
        'user_type' => '用户类型',
        'user_type_id' => '用户类型',
        'country_code' => '国家',
        'g-recaptcha-response' => '验证码',
        'accept_terms' => '条款',
        'category' => '类别',
        'category_id' => '类别',
        'post_type' => '广告类型',
        'post_type_id' => '广告类型',
        'body' => '身体',
        'price' => '价钱',
        'salary' => '薪水',
        'contact_name' => '名称',
        'location' => '地点',
        'admin_code' => '地点',
        'city_id' => '市',
        'package' => '包',
        'package_id' => '包',
        'payment_method' => '付款方法',
        'payment_method_id' => '付款方法',
        'sender_name' => '名称',
        'subject' => '学科',
        'message' => '信息',
        'report_type' => '报告类型',
        'report_type_id' => '报告类型',
        'file' => '文件',
        'filename' => '文件名',
        'picture' => '图片',
        'resume' => '恢复',
        'login' => '登录',
        'code' => '码',
        'token' => '代币',
        'comment' => '评论',
        'rating' => '评分',
        'locale' => '现场',
        'currencies' => '货币',
        'captcha' => '安全码',
        'tags' => 'Tags',
        'from_name' => 'name',
        'from_email' => 'email',
        'from_phone' => 'phone',
    ],
    'captcha' => ':attribute 字段不正确。',
    'recaptcha' => ':attribute 字段不正确。',
    'phone' => ':attribute 字段包含无效的数字。',
    'phone_number' => '您的电话号码无效。',
    'required_package_id' => '您必须选择高级广告选项才能继续。',
    'required_payment_method_id' => '您必须选择付款方式才能继续。',
    'blacklist_unique' => 'The :attribute field value is already banned for :type.',
    'blacklist_email_rule' => '此电子邮件地址已列入黑名单。',
    'blacklist_phone_rule' => '此电话号码已列入黑名单。',
    'blacklist_domain_rule' => '您的电子邮件地址的域名已列入黑名单。',
    'blacklist_ip_rule' => ':attribute 必须是有效的IP地址。',
    'blacklist_word_rule' => ':attribute 包含禁止的单词或短语。',
    'blacklist_title_rule' => ':attribute 包含禁止的单词或短语。',
    'between_rule' => ':attribute 必须介于 :min 到 :max 个字符之间。',
    'username_is_valid_rule' => ':attribute 字段必须是字母数字字符串。',
    'username_is_allowed_rule' => ':attribute 不允许使用。',
    'locale_of_language_rule' => ':attribute 字段无效。',
    'locale_of_country_rule' => ':attribute 字段无效。',
    'currencies_codes_are_valid_rule' => ':attribute 字段无效。',
    'custom_field_unique_rule' => ':field_1 分配了此 :field_2 已经。',
    'custom_field_unique_rule_field' => ':field_1 已分配给此 :field_2 已经。',
    'custom_field_unique_children_rule' => 'A child :field_1 of the :field_1 have this :field_2 assigned already.',
    'custom_field_unique_children_rule_field' => 'The :field_1 is already assign to one :field_2 of this :field_2.',
    'custom_field_unique_parent_rule' => 'The parent :field_1 of the :field_1 have this :field_2 assigned already.',
    'custom_field_unique_parent_rule_field' => 'The :field_1 is already assign to the parent :field_2 of this :field_2.',
    'mb_alphanumeric_rule' => 'Please enter a valid content in the :attribute field.',
    'date_is_valid_rule' => 'The :attribute field does not contain a valid date.',
    'date_future_is_valid_rule' => 'The date of :attribute field need to be in the future.',
    'date_past_is_valid_rule' => 'The date of :attribute field need to be in the past.',
    'video_link_is_valid_rule' => 'The :attribute field does not contain a valid (Youtube or Vimeo) video link.',
    'sluggable_rule' => 'The :attribute field contains invalid characters only.',
    'uniqueness_of_listing_rule' => 'You\'ve already posted this listing. It cannot be duplicated.',
    'uniqueness_of_unverified_listing_rule' => 'You\'ve already posted this listing. Please check your email address or SMS to follow the instructions for validation.',
    'accepted_if' => 'The :attribute must be accepted when :other is :value.',
    'current_password' => '密码不正确。',
    'declined' => 'The :attribute must be declined.',
    'declined_if' => 'The :attribute must be declined when :other is :value.',
    'ends_with' => 'The :attribute must end with one of the following: :values.',
    'enum' => 'The selected :attribute is invalid.',
    'mac_address' => 'The :attribute must be a valid MAC address.',
    'multiple_of' => 'The :attribute must be a multiple of :value.',
    'password' => [
        'letters' => ':attribute 必须至少包含一个字母。',
        'mixed' => ':attribute 必须至少包含一个大写字母和一个小写字母。',
        'numbers' => ':attribute 必须包含至少一个数字。',
        'symbols' => ':attribute 必须包含至少一个符号。',
        'uncompromised' => '给定的 :attribute 出现在数据泄漏中。 请选择不同的 :attribute。',
    ],
    'prohibited' => 'The :attribute field is prohibited.',
    'prohibited_if' => 'The :attribute field is prohibited when :other is :value.',
    'prohibited_unless' => 'The :attribute field is prohibited unless :other is in :values.',
    'prohibits' => 'The :attribute field prohibits :other from being present.',
    'required_array_keys' => 'The :attribute field must contain entries for: :values.',
    'ascii' => 'The :attribute field must only contain single-byte alphanumeric characters and symbols.',
    'can' => 'The :attribute field contains an unauthorized value.',
    'decimal' => 'The :attribute field must have :decimal decimal places.',
    'doesnt_end_with' => 'The :attribute field must not end with one of the following: :values.',
    'doesnt_start_with' => 'The :attribute field must not start with one of the following: :values.',
    'lowercase' => 'The :attribute field must be lowercase.',
    'max_digits' => 'The :attribute field must not have more than :max digits.',
    'min_digits' => 'The :attribute field must have at least :min digits.',
    'missing' => 'The :attribute field must be missing.',
    'missing_if' => 'The :attribute field must be missing when :other is :value.',
    'missing_unless' => 'The :attribute field must be missing unless :other is :value.',
    'missing_with' => 'The :attribute field must be missing when :values is present.',
    'missing_with_all' => 'The :attribute field must be missing when :values are present.',
    'required_if_accepted' => 'The :attribute field is required when :other is accepted.',
    'uppercase' => 'The :attribute field must be uppercase.',
    'ulid' => 'The :attribute field must be a valid ULID.',
    'present_if' => 'The :attribute field must be present when :other is :value.',
    'present_unless' => 'The :attribute field must be present unless :other is :value.',
    'present_with' => 'The :attribute field must be present when :values is present.',
    'present_with_all' => 'The :attribute field must be present when :values are present.',
    'contains' => 'The :attribute field is missing a required value.',
    'extensions' => 'The :attribute field must have one of the following extensions: :values.',
    'hex_color' => 'The :attribute field must be a valid hexadecimal color.',
    'list' => 'The :attribute field must be a list.',
    'required_if_declined' => 'The :attribute field is required when :other is declined.',
];
