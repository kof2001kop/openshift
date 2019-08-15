<?php

$sp = '<script type="text/javascript">
const accounts = [
    ["CCCAT", "https://cccat.io/user/login.php", "kof2001kopkpr@gmail.com", "nmpvvg"]
]
async function launch() 
{
    for (var i in accounts) 
    {
        let title = accounts[i][0]
        let url = accounts[i][1]
        let email = accounts[i][2]
        let password = accounts[i][3]
        await login(url, email, password, title)
    }
    $done();
}';

$out = '<!DOCTYPE html>
<html>
    <head>
        <title>登錄</title>
    </head>
    <body>'.'hjjjjh'.'</body>
</html>';

echo $out;
?>
