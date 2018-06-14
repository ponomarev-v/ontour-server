<?php
require_once(dirname(__DIR__). '/autoload.php');
$db = \Core::DB();
while(true) {
    $res = $db->where('date_send', 0)->get('sms');
    foreach($res as $sms) {
        exec('gammu --sendsms text +7'+$sms['phone']+' -text "'.$sms['message'].'" -unicode');
    }
    sleep(10);
}
