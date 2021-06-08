<?php

    $html = file_get_contents('https://kpr-translte.us-south.cf.appdomain.cloud/translate_ibm.php?translate='.base64_encode($_POST['translate']));
    echo $html;
?>
