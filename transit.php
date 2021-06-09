<?php

    $html = file_get_contents();
    file_get_contents('https://kpr-translte.us-south.cf.appdomain.cloud/translate_ibm.php?translate='.base64_encode($_POST['translate']), 0, stream_context_create(["http"=>["timeout"=>60]]));
    echo $html;
?>
