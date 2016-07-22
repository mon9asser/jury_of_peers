<?php
function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    
   
    return $ipaddress;
}
 
 
function getOS() { 
     global $user_agent;
     $os_platform    =   "Unknown OS Platform";
     $os_array       =   array(
                            '/windows nt 10/i'     =>  'Windows 10',
                            '/windows nt 6.3/i'     =>  'Windows 8.1',
                            '/windows nt 6.2/i'     =>  'Windows 8',
                            '/windows nt 6.1/i'     =>  'Windows 7',
                            '/windows nt 6.0/i'     =>  'Windows Vista',
                            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                            '/windows nt 5.1/i'     =>  'Windows XP',
                            '/windows xp/i'         =>  'Windows XP',
                            '/windows nt 5.0/i'     =>  'Windows 2000',
                            '/windows me/i'         =>  'Windows ME',
                            '/win98/i'              =>  'Windows 98',
                            '/win95/i'              =>  'Windows 95',
                            '/win16/i'              =>  'Windows 3.11',
                            '/macintosh|mac os x/i' =>  'Mac OS X',
                            '/mac_powerpc/i'        =>  'Mac OS 9',
                            '/linux/i'              =>  'Linux',
                            '/ubuntu/i'             =>  'Ubuntu',
                            '/iphone/i'             =>  'iPhone',
                            '/ipod/i'               =>  'iPod',
                            '/ipad/i'               =>  'iPad',
                            '/android/i'            =>  'Android',
                            '/blackberry/i'         =>  'BlackBerry',
                            '/webos/i'              =>  'Mobile'
                        );

    foreach ($os_array as $regex => $value) { 
         if (preg_match($regex, $user_agent)) {
            $os_platform    =   $value;
        }
     }   
     return $os_platform;
  }
function getBrowser() {
     global $user_agent;
     $browser        =   "Unknown Browser";
     $browser_array  =   array(
                            '/msie/i'       =>  'Internet Explorer',
                            '/firefox/i'    =>  'Firefox',
                            '/safari/i'     =>  'Safari',
                            '/chrome/i'     =>  'Chrome',
                            '/opera/i'      =>  'Opera',
                            '/netscape/i'   =>  'Netscape',
                            '/maxthon/i'    =>  'Maxthon',
                            '/konqueror/i'  =>  'Konqueror',
                            '/mobile/i'     =>  'Handheld Browser'
                        );
     foreach ($browser_array as $regex => $value) { 
         if (preg_match($regex, $user_agent)) {
            $browser    =   $value;
        }
     }
     return $browser;
 }



function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE) {
    $output = NULL;
    if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
        $ip = $_SERVER["REMOTE_ADDR"];
        if ($deep_detect) {
            if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
    }
    $purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
    $support    = array("country", "countrycode", "state", "region", "city", "location", "address");
    $continents = array(
        "AF" => "Africa",
        "AN" => "Antarctica",
        "AS" => "Asia",
        "EU" => "Europe",
        "OC" => "Australia (Oceania)",
        "NA" => "North America",
        "SA" => "South America"
    );
    if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
        $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
        if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
            switch ($purpose) {
                case "location":
                    $output = array(
                        "city"           => @$ipdat->geoplugin_city,
                        "state"          => @$ipdat->geoplugin_regionName,
                        "country"        => @$ipdat->geoplugin_countryName,
                        "country_code"   => @$ipdat->geoplugin_countryCode,
                        "continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                        "continent_code" => @$ipdat->geoplugin_continentCode
                    );
                    break;
                case "address":
                    $address = array($ipdat->geoplugin_countryName);
                    if (@strlen($ipdat->geoplugin_regionName) >= 1)
                        $address[] = $ipdat->geoplugin_regionName;
                    if (@strlen($ipdat->geoplugin_city) >= 1)
                        $address[] = $ipdat->geoplugin_city;
                    $output = implode(", ", array_reverse($address));
                    break;
                case "city":
                    $output = @$ipdat->geoplugin_city;
                    break;
                case "state":
                    $output = @$ipdat->geoplugin_regionName;
                    break;
                case "region":
                    $output = @$ipdat->geoplugin_regionName;
                    break;
                case "country":
                    $output = @$ipdat->geoplugin_countryName;
                    break;
                case "countrycode":
                    $output = @$ipdat->geoplugin_countryCode;
                    break;
            }
        }
    }
    return $output;
}




function get_lat_info ($ip){
      $address =  ip_info($ip, "Country Code");
        $url = "http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);
        curl_close($ch);
        $response_a = json_decode($response);
        $lat = $response_a->results[0]->geometry->location->lat;
        return $lat ;
 }
  function get_lng_info ($ip){
      $address =  ip_info($ip, "Country Code");
        $url = "http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);
        curl_close($ch);
        $response_a = json_decode($response);
        $long = $response_a->results[0]->geometry->location->lng;
        return $long ;
 }
 
 
 
 
 
    function get_lat_via_address($address){
            $address = str_replace(" ", "+", $address);
            $json = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false");
            $json = json_decode($json);
            $lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
            $long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
            return $lat ;
        }
   function get_lng_via_address($address){
            $address = str_replace(" ", "+", $address);
            $json = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false");
            $json = json_decode($json);
            $lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
            $long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
            return $long ;
        }     

?>
 <?php
                                    $Countries = [
                                                    [ 'code' => 'US', 'name' => 'United States'],
                                                    [ 'code' => 'CA', 'name' => 'Canada'],
                                                    [ 'code' => 'AU', 'name' => 'Australia'],
                                                    [ 'code' => 'FR', 'name' => 'France'],
                                                    [ 'code' => 'DE', 'name' => 'Germany'],
                                                    [ 'code' => 'IS', 'name' => 'Iceland'],
                                                    [ 'code' => 'IE', 'name' => 'Ireland'],
                                                    [ 'code' => 'IT', 'name' => 'Italy'],
                                                    [ 'code' => 'ES', 'name' => 'Spain'],
                                                    [ 'code' => 'SE', 'name' => 'Sweden'],
                                                    [ 'code' => 'AT', 'name' => 'Austria'],
                                                    [ 'code' => 'BE', 'name' => 'Belgium'],
                                                    [ 'code' => 'FI', 'name' => 'Finland'],
                                                    [ 'code' => 'CZ', 'name' => 'Czech Republic'],
                                                    [ 'code' => 'DK', 'name' => 'Denmark'],
                                                    [ 'code' => 'NO', 'name' => 'Norway'],
                                                    [ 'code' => 'GB', 'name' => 'United Kingdom'],
                                                    [ 'code' => 'CH', 'name' => 'Switzerland'],
                                                    [ 'code' => 'NZ', 'name' => 'New Zealand'],
                                                    [ 'code' => 'RU', 'name' => 'Russian Federation'],
                                                    [ 'code' => 'PT', 'name' => 'Portugal'],
                                                    [ 'code' => 'NL', 'name' => 'Netherlands'],
                                                    [ 'code' => 'IM', 'name' => 'Isle of Man'],
                                                    [ 'code' => 'AF', 'name' => 'Afghanistan'],
                                                    [ 'code' => 'AX', 'name' => 'Aland Islands '],
                                                    [ 'code' => 'AL', 'name' => 'Albania'],
                                                    [ 'code' => 'DZ', 'name' => 'Algeria'],
                                                    [ 'code' => 'AS', 'name' => 'American Samoa'],
                                                    [ 'code' => 'AD', 'name' => 'Andorra'],
                                                    [ 'code' => 'AO', 'name' => 'Angola'],
                                                    [ 'code' => 'AI', 'name' => 'Anguilla'],
                                                    [ 'code' => 'AQ', 'name' => 'Antarctica'],
                                                    [ 'code' => 'AG', 'name' => 'Antigua and Barbuda'],
                                                    [ 'code' => 'AR', 'name' => 'Argentina'],
                                                    [ 'code' => 'AM', 'name' => 'Armenia'],
                                                    [ 'code' => 'AW', 'name' => 'Aruba'],
                                                    [ 'code' => 'AZ', 'name' => 'Azerbaijan'],
                                                    [ 'code' => 'BS', 'name' => 'Bahamas'],
                                                    [ 'code' => 'BH', 'name' => 'Bahrain'],
                                                    [ 'code' => 'BD', 'name' => 'Bangladesh'],
                                                    [ 'code' => 'BB', 'name' => 'Barbados'],
                                                    [ 'code' => 'BY', 'name' => 'Belarus'],
                                                    [ 'code' => 'BZ', 'name' => 'Belize'],
                                                    [ 'code' => 'BJ', 'name' => 'Benin'],
                                                    [ 'code' => 'BM', 'name' => 'Bermuda'],
                                                    [ 'code' => 'BT', 'name' => 'Bhutan'],
                                                    [ 'code' => 'BO', 'name' => 'Bolivia, Plurinational State of'],
                                                    [ 'code' => 'BQ', 'name' => 'Bonaire, Sint Eustatius and Saba'],
                                                    [ 'code' => 'BA', 'name' => 'Bosnia and Herzegovina'],
                                                    [ 'code' => 'BW', 'name' => 'Botswana'],
                                                    [ 'code' => 'BV', 'name' => 'Bouvet Island'],
                                                    [ 'code' => 'BR', 'name' => 'Brazil'],
                                                    [ 'code' => 'IO', 'name' => 'British Indian Ocean Territory'],
                                                    [ 'code' => 'BN', 'name' => 'Brunei Darussalam'],
                                                    [ 'code' => 'BG', 'name' => 'Bulgaria'],
                                                    [ 'code' => 'BF', 'name' => 'Burkina Faso'],
                                                    [ 'code' => 'BI', 'name' => 'Burundi'],
                                                    [ 'code' => 'KH', 'name' => 'Cambodia'],
                                                    [ 'code' => 'CM', 'name' => 'Cameroon'],
                                                    [ 'code' => 'CV', 'name' => 'Cape Verde'],
                                                    [ 'code' => 'KY', 'name' => 'Cayman Islands'],
                                                    [ 'code' => 'CF', 'name' => 'Central African Republic'],
                                                    [ 'code' => 'TD', 'name' => 'Chad'],
                                                    [ 'code' => 'CL', 'name' => 'Chile'],
                                                    [ 'code' => 'CN', 'name' => 'China'],
                                                    [ 'code' => 'CX', 'name' => 'Christmas Island'],
                                                    [ 'code' => 'CC', 'name' => 'Cocos (Keeling) Islands'],
                                                    [ 'code' => 'CO', 'name' => 'Colombia'],
                                                    [ 'code' => 'KM', 'name' => 'Comoros'],
                                                    [ 'code' => 'CG', 'name' => 'Congo'],
                                                    [ 'code' => 'CD', 'name' => 'Congo, the Democratic Republic of the'],
                                                    [ 'code' => 'CK', 'name' => 'Cook Islands'],
                                                    [ 'code' => 'CR', 'name' => 'Costa Rica'],
                                                    [ 'code' => 'CI', 'name' => 'Cote d\'Ivoire'],
                                                    [ 'code' => 'HR', 'name' => 'Croatia'],
                                                    [ 'code' => 'CU', 'name' => 'Cuba'],
                                                    [ 'code' => 'CW', 'name' => 'Curaçao'],
                                                    [ 'code' => 'CY', 'name' => 'Cyprus'],
                                                    [ 'code' => 'DJ', 'name' => 'Djibouti'],
                                                    [ 'code' => 'DM', 'name' => 'Dominica'],
                                                    [ 'code' => 'DO', 'name' => 'Dominican Republic'],
                                                    [ 'code' => 'EC', 'name' => 'Ecuador'],
                                                    [ 'code' => 'EG', 'name' => 'Egypt'],
                                                    [ 'code' => 'SV', 'name' => 'El Salvador'],
                                                    [ 'code' => 'GQ', 'name' => 'Equatorial Guinea'],
                                                    [ 'code' => 'ER', 'name' => 'Eritrea'],
                                                    [ 'code' => 'EE', 'name' => 'Estonia'],
                                                    [ 'code' => 'ET', 'name' => 'Ethiopia'],
                                                    [ 'code' => 'FK', 'name' => 'Falkland Islands (Malvinas)'],
                                                    [ 'code' => 'FO', 'name' => 'Faroe Islands'],
                                                    [ 'code' => 'FJ', 'name' => 'Fiji'],
                                                    [ 'code' => 'GF', 'name' => 'French Guiana'],
                                                    [ 'code' => 'PF', 'name' => 'French Polynesia'],
                                                    [ 'code' => 'TF', 'name' => 'French Southern Territories'],
                                                    [ 'code' => 'GA', 'name' => 'Gabon'],
                                                    [ 'code' => 'GM', 'name' => 'Gambia'],
                                                    [ 'code' => 'GE', 'name' => 'Georgia'],
                                                    [ 'code' => 'GH', 'name' => 'Ghana'],
                                                    [ 'code' => 'GI', 'name' => 'Gibraltar'],
                                                    [ 'code' => 'GR', 'name' => 'Greece'],
                                                    [ 'code' => 'GL', 'name' => 'Greenland'],
                                                    [ 'code' => 'GD', 'name' => 'Grenada'],
                                                    [ 'code' => 'GP', 'name' => 'Guadeloupe'],
                                                    [ 'code' => 'GU', 'name' => 'Guam'],
                                                    [ 'code' => 'GT', 'name' => 'Guatemala'],
                                                    [ 'code' => 'GG', 'name' => 'Guernsey'],
                                                    [ 'code' => 'GN', 'name' => 'Guinea'],
                                                    [ 'code' => 'GW', 'name' => 'Guinea-Bissau'],
                                                    [ 'code' => 'GY', 'name' => 'Guyana'],
                                                    [ 'code' => 'HT', 'name' => 'Haiti'],
                                                    [ 'code' => 'HM', 'name' => 'Heard Island and McDonald Islands'],
                                                    [ 'code' => 'VA', 'name' => 'Holy See (Vatican City State)'],
                                                    [ 'code' => 'HN', 'name' => 'Honduras'],
                                                    [ 'code' => 'HK', 'name' => 'Hong Kong'],
                                                    [ 'code' => 'HU', 'name' => 'Hungary'],
                                                    [ 'code' => 'IN', 'name' => 'India'],
                                                    [ 'code' => 'ID', 'name' => 'Indonesia'],
                                                    [ 'code' => 'IR', 'name' => 'Iran, Islamic Republic of'],
                                                    [ 'code' => 'IQ', 'name' => 'Iraq'],
                                                    [ 'code' => 'IL', 'name' => 'Israel'],
                                                    [ 'code' => 'JM', 'name' => 'Jamaica'],
                                                    [ 'code' => 'JP', 'name' => 'Japan'],
                                                    [ 'code' => 'JE', 'name' => 'Jersey'],
                                                    [ 'code' => 'JO', 'name' => 'Jordan'],
                                                    [ 'code' => 'KZ', 'name' => 'Kazakhstan'],
                                                    [ 'code' => 'KE', 'name' => 'Kenya'],
                                                    [ 'code' => 'KI', 'name' => 'Kiribati'],
                                                    [ 'code' => 'KP', 'name' => 'Korea, Democratic People\'s Republic of'],
                                                    [ 'code' => 'KR', 'name' => 'Korea, Republic of'],
                                                    [ 'code' => 'KW', 'name' => 'Kuwait'],
                                                    [ 'code' => 'KG', 'name' => 'Kyrgyzstan'],
                                                    [ 'code' => 'LA', 'name' => 'Lao People\'s Democratic Republic'],
                                                    [ 'code' => 'LV', 'name' => 'Latvia'],
                                                    [ 'code' => 'LB', 'name' => 'Lebanon'],
                                                    [ 'code' => 'LS', 'name' => 'Lesotho'],
                                                    [ 'code' => 'LR', 'name' => 'Liberia'],
                                                    [ 'code' => 'LY', 'name' => 'Libyan Arab Jamahiriya'],
                                                    [ 'code' => 'LI', 'name' => 'Liechtenstein'],
                                                    [ 'code' => 'LT', 'name' => 'Lithuania'],
                                                    [ 'code' => 'LU', 'name' => 'Luxembourg'],
                                                    [ 'code' => 'MO', 'name' => 'Macao'],
                                                    [ 'code' => 'MK', 'name' => 'Macedonia'],
                                                    [ 'code' => 'MG', 'name' => 'Madagascar'],
                                                    [ 'code' => 'MW', 'name' => 'Malawi'],
                                                    [ 'code' => 'MY', 'name' => 'Malaysia'],
                                                    [ 'code' => 'MV', 'name' => 'Maldives'],
                                                    [ 'code' => 'ML', 'name' => 'Mali'],
                                                    [ 'code' => 'MT', 'name' => 'Malta'],
                                                    [ 'code' => 'MH', 'name' => 'Marshall Islands'],
                                                    [ 'code' => 'MQ', 'name' => 'Martinique'],
                                                    [ 'code' => 'MR', 'name' => 'Mauritania'],
                                                    [ 'code' => 'MU', 'name' => 'Mauritius'],
                                                    [ 'code' => 'YT', 'name' => 'Mayotte'],
                                                    [ 'code' => 'MX', 'name' => 'Mexico'],
                                                    [ 'code' => 'FM', 'name' => 'Micronesia, Federated States of'],
                                                    [ 'code' => 'MD', 'name' => 'Moldova, Republic of'],
                                                    [ 'code' => 'MC', 'name' => 'Monaco'],
                                                    [ 'code' => 'MN', 'name' => 'Mongolia'],
                                                    [ 'code' => 'ME', 'name' => 'Montenegro'],
                                                    [ 'code' => 'MS', 'name' => 'Montserrat'],
                                                    [ 'code' => 'MA', 'name' => 'Morocco'],
                                                    [ 'code' => 'MZ', 'name' => 'Mozambique'],
                                                    [ 'code' => 'MM', 'name' => 'Myanmar'],
                                                    [ 'code' => 'NA', 'name' => 'Namibia'],
                                                    [ 'code' => 'NR', 'name' => 'Nauru'],
                                                    [ 'code' => 'NP', 'name' => 'Nepal'],
                                                    [ 'code' => 'NC', 'name' => 'New Caledonia'],
                                                    [ 'code' => 'NI', 'name' => 'Nicaragua'],
                                                    [ 'code' => 'NE', 'name' => 'Niger'],
                                                    [ 'code' => 'NG', 'name' => 'Nigeria'],
                                                    [ 'code' => 'NU', 'name' => 'Niue'],
                                                    [ 'code' => 'NF', 'name' => 'Norfolk Island'],
                                                    [ 'code' => 'MP', 'name' => 'Northern Mariana Islands'],
                                                    [ 'code' => 'OM', 'name' => 'Oman'],
                                                    [ 'code' => 'PK', 'name' => 'Pakistan'],
                                                    [ 'code' => 'PW', 'name' => 'Palau'],
                                                    [ 'code' => 'PS', 'name' => 'Palestinian Territory, Occupied'],
                                                    [ 'code' => 'PA', 'name' => 'Panama'],
                                                    [ 'code' => 'PG', 'name' => 'Papua New Guinea'],
                                                    [ 'code' => 'PY', 'name' => 'Paraguay'],
                                                    [ 'code' => 'PE', 'name' => 'Peru'],
                                                    [ 'code' => 'PH', 'name' => 'Philippines'],
                                                    [ 'code' => 'PN', 'name' => 'Pitcairn'],
                                                    [ 'code' => 'PL', 'name' => 'Poland'],
                                                    [ 'code' => 'PR', 'name' => 'Puerto Rico'],
                                                    [ 'code' => 'QA', 'name' => 'Qatar'],
                                                    [ 'code' => 'RE', 'name' => 'Reunion'],
                                                    [ 'code' => 'RO', 'name' => 'Romania'],
                                                    [ 'code' => 'RW', 'name' => 'Rwanda'],
                                                    [ 'code' => 'BL', 'name' => 'Saint Barthélemy'],
                                                    [ 'code' => 'SH', 'name' => 'Saint Helena'],
                                                    [ 'code' => 'KN', 'name' => 'Saint Kitts and Nevis'],
                                                    [ 'code' => 'LC', 'name' => 'Saint Lucia'],
                                                    [ 'code' => 'MF', 'name' => 'Saint Martin (French part)'],
                                                    [ 'code' => 'PM', 'name' => 'Saint Pierre and Miquelon'],
                                                    [ 'code' => 'VC', 'name' => 'Saint Vincent and the Grenadines'],
                                                    [ 'code' => 'WS', 'name' => 'Samoa'],
                                                    [ 'code' => 'SM', 'name' => 'San Marino'],
                                                    [ 'code' => 'ST', 'name' => 'Sao Tome and Principe'],
                                                    [ 'code' => 'SA', 'name' => 'Saudi Arabia'],
                                                    [ 'code' => 'SN', 'name' => 'Senegal'],
                                                    [ 'code' => 'RS', 'name' => 'Serbia'],
                                                    [ 'code' => 'SC', 'name' => 'Seychelles'],
                                                    [ 'code' => 'SL', 'name' => 'Sierra Leone'],
                                                    [ 'code' => 'SG', 'name' => 'Singapore'],
                                                    [ 'code' => 'SX', 'name' => 'Sint Maarten (Dutch part)'],
                                                    [ 'code' => 'SK', 'name' => 'Slovakia'],
                                                    [ 'code' => 'SI', 'name' => 'Slovenia'],
                                                    [ 'code' => 'SB', 'name' => 'Solomon Islands'],
                                                    [ 'code' => 'SO', 'name' => 'Somalia'],
                                                    [ 'code' => 'ZA', 'name' => 'South Africa'],
                                                    [ 'code' => 'GS', 'name' => 'South Georgia and the South Sandwich Islands'],
                                                    [ 'code' => 'LK', 'name' => 'Sri Lanka'],
                                                    [ 'code' => 'SD', 'name' => 'Sudan'],
                                                    [ 'code' => 'SR', 'name' => 'Suriname'],
                                                    [ 'code' => 'SJ', 'name' => 'Svalbard and Jan Mayen'],
                                                    [ 'code' => 'SZ', 'name' => 'Swaziland'],
                                                    [ 'code' => 'SY', 'name' => 'Syrian Arab Republic'],
                                                    [ 'code' => 'TW', 'name' => 'Taiwan, Province of China'],
                                                    [ 'code' => 'TJ', 'name' => 'Tajikistan'],
                                                    [ 'code' => 'TZ', 'name' => 'Tanzania, United Republic of'],
                                                    [ 'code' => 'TH', 'name' => 'Thailand'],
                                                    [ 'code' => 'TL', 'name' => 'Timor-Leste'],
                                                    [ 'code' => 'TG', 'name' => 'Togo'],
                                                    [ 'code' => 'TK', 'name' => 'Tokelau'],
                                                    [ 'code' => 'TO', 'name' => 'Tonga'],
                                                    [ 'code' => 'TT', 'name' => 'Trinidad and Tobago'],
                                                    [ 'code' => 'TN', 'name' => 'Tunisia'],
                                                    [ 'code' => 'TR', 'name' => 'Turkey'],
                                                    [ 'code' => 'TM', 'name' => 'Turkmenistan'],
                                                    [ 'code' => 'TC', 'name' => 'Turks and Caicos Islands'],
                                                    [ 'code' => 'TV', 'name' => 'Tuvalu'],
                                                    [ 'code' => 'UG', 'name' => 'Uganda'],
                                                    [ 'code' => 'UA', 'name' => 'Ukraine'],
                                                    [ 'code' => 'AE', 'name' => 'United Arab Emirates'],
                                                    [ 'code' => 'UM', 'name' => 'United States Minor Outlying Islands'],
                                                    [ 'code' => 'UY', 'name' => 'Uruguay'],
                                                    [ 'code' => 'UZ', 'name' => 'Uzbekistan'],
                                                    [ 'code' => 'VU', 'name' => 'Vanuatu'],
                                                    [ 'code' => 'VE', 'name' => 'Venezuela, Bolivarian Republic of'],
                                                    [ 'code' => 'VN', 'name' => 'Viet Nam'],
                                                    [ 'code' => 'VG', 'name' => 'Virgin Islands, British'],
                                                    [ 'code' => 'VI', 'name' => 'Virgin Islands, U.S.'],
                                                    [ 'code' => 'WF', 'name' => 'Wallis and Futuna'],
                                                    [ 'code' => 'EH', 'name' => 'Western Sahara'],
                                                    [ 'code' => 'YE', 'name' => 'Yemen'],
                                                    [ 'code' => 'ZM', 'name' => 'Zambia'],
                                                    [ 'code' => 'ZW', 'name' => 'Zimbabwe']
                                    ];
?>