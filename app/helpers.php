<?php

function getFormatedDate($date = "", $format = 'd F, Y') {
    if ($date == "") {
        return "---";
    }
    return date($format, strtotime($date));
}

function getFormatedDateTime($date_time = "", $format = 'd F, Y, g:i A') {
    if ($date_time == "") {
        return "---";
    }
    return date($format, strtotime($date_time));
}

function getImage($id, $image) {
    $image = str_replace("_", "_cropped_", $image);
    $image_arr = explode(".", $image);
    $file_name = $image_arr[0] . ".png";

    $image_path = base_path() . '/public/uploads/users/' . $id . '/' . $file_name;
    if (is_file($image_path)) {
        $image_url = URL::to('/') . '/public/uploads/users/' . $id . '/' . $file_name;
    } else {
        $image_url = URL::to('/') . '/public/images/default-user.jpg';
    }

    return $image_url;
}

function replaceSpaceWithDash($title) {
    $title = strtolower(str_replace(" ", "-", $title));
    return $title;
}

function getPrice($amount, $currency_symbol = '£', $symbol = "Y") {
    $amount = number_format($amount, 2);
    $decimal = substr($amount, -2);
    if($decimal == "00") {
        $amount = substr($amount, 0, -3);
    }
    if($symbol == "Y") {
        return $currency_symbol . " " . $amount;
    }else {
        return $amount;
    }

}

function generateAccessToken(){
    $fields = "code=CBNCKBAAHBCAABAAg32_FZhYbEsHiBrNhyTAsgFjQWmwRbKr&client_id=CBJCHBCAABAAwlX-h4RJhOSvhRj7bYFTZzx87zowu5et&client_secret=Fc68NVVdtfFHhl8i2UkeqGXy6qZwfVc1&redirect_uri=https://avanis.co.uk/&grant_type=authorization_code";
    
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.eu1.adobesign.com/oauth/token",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 30000,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $fields,
        CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "content-type: application/x-www-form-urlencoded"
        ),
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    
    return json_decode($response);
}

function getIdentificationOptions() {
    $option['passport'] = "Certified copy of Current/Valid Passport";
    $option['eea_member_state_identity_card'] = "Certified copy of *Current/Valid EEA Member state identity card";
    $option['driving_licence'] = "Certified copy of *Current/Valid UK Driving Licence";
    $option['council_tax_utility_bill'] = "Certified copy of Council tax or utility bill";
    $option['credit_union_statement'] = "Certified copy of Bank, building society or credit union statement";
    $option['mortgage_statement'] = "Certified copy of Mortgage statement date";
    $option['motor_insurance_certificate'] = "Certified copy of House or motor insurance certificate";
    $option['residence_permit_by_home_office'] = "Certified copy of Current residence permit issued by the Home Office";
    $option['firearms_certificate_shortgun_licence'] = "Certified copy of Current firearms certificate or shortgun licence";
    
    return $option;
}