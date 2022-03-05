<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BahmanMotor Registration Form</title>
</head>
<body dir="rtl">
<input type="checkbox" placeholder="+18?" disabled>
<input type="checkbox" placeholder="agreement" disabled>
<?php
$inputs = [
    'first_name' => 'نام',
    'last_name' => 'نام خانوادگی',
    'fathers_name' => 'نام پدر',
    'national_code' => 'کدملی',
    'identity_code' => 'شماره شناسنامه',
    'identity_serial' => 'سریال شناسنامه',
    'birthday' => 'تاریخ تولد',
    'issuance_date' => 'تاریخ صدور شناسنامه',
    'street' => 'خیابان اصلی',
    'bystreet' => 'خیابان فرعی',
    'alley' => 'کوچه',
    'city_zone' => 'منطقه شهرداری',
    'no' => 'پلاک',
    'postal_code' => 'کدپستی',
    'bank_name' => 'نام بانک',
    'sheba' => 'شماره شبا',
    'mobile_number' => 'تلفن همراه',
    'phone_number' => 'تلفن ثابت',
    'email' => 'ایمیل',
    'certificate_number' => 'شماره گواهینامه',
];

$selects = [
    'issuance_place_province' => 'استان صدور شناسنامه',
    'issuance_place_city' => 'شهر صدور شناسنامه',
    'birth_place_province' => 'استان تولد',
    'birth_place_city' => 'شهر محل تولد',
    'sex' => 'جنسیت',
    'occupation' => 'شغل',
    'ashnaei' => 'نحوه آشنایی با شرایط فروش',
    'carPlaque' => 'نوع پلاک درخواستی',
    'address_province' => 'استان',
    'address_city' => 'شهر',
    'branch_province' => 'انتخاب استان',
    'branch_city' => 'انتخاب شهر',
    'branch_name' => 'انتخاب نمایندگی'
];

$options = [
    'sex' => [
        'مرد',
        'زن',
    ],
    'occupation' => [
        'آزاد',
        'خانه دار',
        'کارمند',
        'دانشجو',
        'فرهنگی',
        'خبرنگار',
        'پزشک',
        'هنرمند',
        'ورزشکار',
        'پرستار',
        'نظامی',
        'کارگر',
        'بازنشسته',
        'کشاورز و دامدار',
        'وکیل و حقوق دان',
        'سایر',
    ],
    'ashnaei' => [
        'تلویزیون',
        'رادیو',
        'روزنامه',
        'مجلات',
        'بیلبورد',
        'پیامک',
        'سایت بهمن',
        'سایر سایتهای اینترنتی',
        'شبکه های اجتماعی',
        'نمایندگیها',
        'سایر موارد',
    ],
    'carPlaque' => [
        'عمومی',
        'شخصی',
        'جانبازی',
    ]
];

foreach ($inputs as $key => $value) {
    echo "<label for='$key'>$value</label>";
    echo "<input id='$key' name='$key' value=''>";
    echo "<br>";
}

foreach ($selects as $key => $value) {
    echo "<label for='$key'>$value</label>";
    echo "<select id='$key' name='$key'>";
    foreach ($options[$key] as $option) {
        echo "<option>$option</option>";
    }
    echo "</select>";
    echo "<br>";
}

?>
<br><br>
<input name="captcha" placeholder="captcha">
<script>
    let inputs = document.getElementsByTagName('input');

    function makeEnable() {
        for (let index = 0; index < inputs.length; ++index) {
            inputs[index].removeAttribute('disabled')
        }
    }

    function makeEnableSecond() {
        for (let index = 0; index < inputs.length; ++index) {
            inputs[index].style.backgroundColor = 'black'
            inputs[index].style.color = 'white'
        }
    }
</script>
</body>
</html>
