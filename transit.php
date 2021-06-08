<?php

    $html = file_get_contents('https://kpr-translte.us-south.cf.appdomain.cloud/test.php?'.base64_encode($_POST['translate']));
    echo $html;
?>
