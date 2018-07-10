<?php
include "header.php";/*подключение головы сайта*/
include "detect_coords.php";/*подключение тела сайта*/
include "footer.php";/*подключение ног сайта*/
echo "Your country is {$_SERVER['GEOIP_COUNTRY_NAME']} and your city is {$_SERVER['GEOIP_CITY']}.";