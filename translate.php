<?php
/**
* For get a api key, contacme in telegram: @Mateodioev
* free api_key: senkku_bot_public
*/

header('content-type: application/json');
define('api_key', 'senkku_bot_public');

function sendPost($link_send, $data_post){
    $ch = curl_init($link_send);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_post);
    $res = curl_exec($ch);
    return $res;
}

$text = 'The single largest factor in predicting suicide, both at the individual and the national level, is the failure to belong in relationships with the opposite sex, family members, and society. A broad array of sources supports this conclusion. Not just any pain, but the pain of social rejection and failed belonging, causes suicide.';

$data = sendPost('https://tgneto-space.com/tr/?key='.api_key.'&sl=auto&tl=zh', 'text='.$text);

echo $data;

?>
