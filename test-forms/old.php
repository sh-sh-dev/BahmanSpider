<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BahmanMotor Registration Form (Before Dey)</title>
</head>
<body dir="rtl">
<button onclick="makeEnable()">فروش نقدی</button>
<button onclick="makeEnableSecond()">مبلغ قابل پرداخت</button>
<input type="checkbox" placeholder="+18?" disabled>
<input type="checkbox" placeholder="agreement" disabled>
<input name='first_name' placeholder='first_name' value='' disabled>
<input name='last_name' placeholder='last_name' value='' disabled>
<input name='fathers_name' placeholder='fathers_name' value='' disabled>
<input name='national_code' placeholder='national_code' value='' disabled>
<input name='identity_code' placeholder='identity_code' value='' disabled>
<input name='identity_serial' placeholder='identity_serial' value='' disabled>
<input name='birth_date_dd' placeholder='birth_date_dd' value='' disabled>
<input name='birth_date_mm' placeholder='birth_date_mm' value='' disabled>
<input name='birth_date_yy' placeholder='birth_date_yy' value='' disabled>
<input name='issuance_date_dd' placeholder='issuance_date_dd' value='' disabled>
<input name='issuance_date_mm' placeholder='issuance_date_mm' value='' disabled>
<input name='issuance_date_yy' placeholder='issuance_date_yy' value='' disabled>
<input name='issuance_place_province' placeholder='issuance_place_province' value='' disabled>
<input name='issuance_place_city' placeholder='issuance_place_city' value='' disabled>
<input name='birth_place_province' placeholder='birth_place_province' value='' disabled>
<input name='birth_place_city' placeholder='birth_place_city' value='' disabled>
<input name='sex' placeholder='sex' value='' disabled>
<input name='occupation' placeholder='occupation' value='' disabled>
<input name='ashnaei' placeholder='ashnaei' value='' disabled>
<input name='carPlaque' placeholder='carPlaque' value='' disabled>
<input name='address_province' placeholder='address_province' value='' disabled>
<input name='address_city' placeholder='address_city' value='' disabled>
<input name='street' placeholder='street' value='' disabled>
<input name='bystreet' placeholder='bystreet' value='' disabled>
<input name='alley' placeholder='alley' value='' disabled>
<input name='no' placeholder='no' value='' disabled>
<input name='postal_code' placeholder='postal_code' value='' disabled>
<input name='bank_name' placeholder='bank_name' value='' disabled>
<input name='sheba' placeholder='sheba' value='' disabled>
<input name='mobile_number' placeholder='mobile_number' value='' disabled>
<input name='phone_number' placeholder='phone_number' value='' disabled>
<input name='email' placeholder='email' value='' disabled>
<input name='certificate_number' placeholder='certificate_number' value='' disabled>
<input name='city_zone' placeholder='city_zone' value='' disabled>
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
