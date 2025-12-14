<?php


$settings = [
    [
        'id' => 1,
        'key' => 'library_name',
        'value' => 's:7:"Setiadi";',
    ],
    [
        'id' => 2,
        'key' => 'library_subname',
        'value' => 's:22:"Open Source ETD System";',
    ],
    [
        'id' => 5,
        'key' => 'default_lang',
        'value' => 's:2:"id";',
    ],
    [
        'id' => 6,
        'key' => 'opac_result_num',
        'value' => 's:2:"20";',
    ],
    [
        'id' => 7,
        'key' => 'enable_promote_titles',
        'value' => 's:1:"0";',
    ],
    [
        'id' => 8,
        'key' => 'quick_return',
        'value' => 'b:1;',
    ],
    [
        'id' => 9,
        'key' => 'allow_loan_date_change',
        'value' => 'b:0;',
    ],
    [
        'id' => 10,
        'key' => 'loan_limit_override',
        'value' => 'b:0;',
    ],
    [
        'id' => 11,
        'key' => 'enable_xml_detail',
        'value' => 's:1:"1";',
    ],
    [
        'id' => 12,
        'key' => 'enable_xml_result',
        'value' => 's:1:"1";',
    ],
    [
        'id' => 13,
        'key' => 'allow_file_download',
        'value' => 's:1:"1";',
    ],
    [
        'id' => 14,
        'key' => 'session_timeout',
        'value' => 's:4:"7200";',
    ],
    [
        'id' => 15,
        'key' => 'circulation_receipt',
        'value' => 'b:0;',
    ],
    [
        'id' => 16,
        'key' => 'barcode_encoding',
        'value' => 's:4:"128B";',
    ],
    [
        'id' => 17,
        'key' => 'ignore_holidays_fine_calc',
        'value' => 'b:0;',
    ],
    [
        'id' => 18,
        'key' => 'spellchecker_enabled',
        'value' => 'b:0;',
    ],
    [
        'id' => 19,
        'key' => 'ori',
        'value' => 'a:2:{s:5:"theme";s:7:"default";s:3:"css";s:32:"admin_template/default/style.css"',
    ],
    [
        'id' => 20,
        'key' => 'setiadi_shortcut_1',
        'value' => '',
    ],
    [
        'id' => 21,
        'key' => 'recaptcha',
        'value' => 'a:2:{s:3:"smc";i:0;s:6:"member";i:0;}',
    ],
];

$users = [
    [
        'user_id' => 1,
        'username' => 'admin',
        'realname' => 'Admin',
        'passwd' => '$2y$10$JXkd/SqnJmZc8RW5DbQNBOOYnFxtCvKfqhyvcOpmP6WFu/.nt3ndm',
        'email' => '',
        'user_type' => 1,
        'user_image' => null,
        'social_media' => null,
        'last_login' => '2020-09-12 22:34:52',
        'last_login_ip' => '125.160.113.2',
        'groups' => 'a:1:{i:0;s:1:"1";}',
        'input_date' => '2017-08-16',
        'last_update' => '2020-07-26',
    ],
];

$php_ext = ['mysqli', 'mbstring', 'curl', 'openssl', 'intl'];

$minPhpVersion = '8.1';

return [
    'settings' => $settings,
    'users' => $users,
    'php_ext' => $php_ext,
    '$minPhpVersion' => $minPhpVersion,
];
