<?php
/**
* For get a api key, contacme in telegram: @Mateodioev
* free api_key: senkku_bot_public
*/

header('content-type: application/json');
define('api_key', 'enbusktok_721');

function sendPost($link_send, $data_post){
    $ch = curl_init($link_send);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_post);
    $res = curl_exec($ch);
    return $res;
}

$data = sendPost('https://tgneto-space.com/tr/?key='.api_key.'&sl=auto&tl=zh', 'text='.$_GET['translate']);

echo $data;

?>
