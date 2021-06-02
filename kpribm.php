<?php

$url = "https://api.us-east.language-translator.watson.cloud.ibm.com/v3/translate?version=2018-05-01";
$user = "cz4U3Ax2-Q4Gl3x10q-0_beN6xjOP-JjHcdtSUu_VoWP";
$pass = "cz4U3Ax2-Q4Gl3x10q-0_beN6xjOP-JjHcdtSUu_VoWP";
$options = array (
    CURLOPT_RETURNTRANSFER =>true,
    CURLOPT_FOLLOWLOCATION =>true,
    CURLOPT_AUTOREFERER =>true,
);
$data = [
  'text' =>[
    'Hello, world!',
    'How are you?'
  ],
  'model_id' =>'en-es'
];
$ch = curl_init ();
curl_setopt ($ch, CURLOPT_URL, $url);
curl_setopt ($ch, CURLOPT_USERPWD, $user. ":". $pass);
curl_setopt ($ch, CURLOPT_HTTPHEADER, array ('Content-Type: application/json'));
curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt ($ch, CURLOPT_VERBOSE, true);
curl_setopt ($ch, CURLOPT_POSTFIELDS, json_encode ($data));
curl_setopt ($ch, CURLOPT_POST, true);
curl_setopt_array ($ch, $options);
$result = curl_exec ($ch);
curl_close ($ch);

?>
