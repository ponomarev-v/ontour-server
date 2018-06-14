<?php
require_once(dirname(__DIR__) . '/autoload.php');
$db = \Core::DB();
while(true) {
    $res = $db->where('date_send', 0)->get('sms');
    foreach($res as $sms) {
        $command = 'gammu --sendsms text +7' . $sms['phone'] . ' -text "' . $sms['message'] . '" -unicode';
        exec($command);
        $db->where('id', $sms['id'])->update('sms', array('date_send' => time()));
    }
    sleep(10);
}
