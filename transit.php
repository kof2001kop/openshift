<?php
    
    if ($_POST['engine'] == "google")
    {
        $html = file_get_contents('https://kpr-flask-thankful-fox.mybluemix.net/?engine=google&translate='.base64_encode($_POST['translate']), 0, stream_context_create(["http"=>["timeout"=>60]]));
    }
    else
    {
        $html = file_get_contents('https://kpr-flask-thankful-fox.mybluemix.net/?engine=alibaba&translate='.base64_encode($_POST['translate']), 0, stream_context_create(["http"=>["timeout"=>60]]));
    }

    echo $html;
?>
