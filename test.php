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
}

launch()

function login(url, email, password, title) {
    let loginPath = url.indexOf("auth/login") != -1 ? "auth/login" : "user/_login.php"
    let table = {
        url: url.replace(/(auth|user)\/login(.php)*/g, "") + loginPath,
        header: {

        },
        body: {
            "email": email,
            "passwd": password,
            "rumber-me": "week"
        }
    }
    $httpClient.post(table, async function (error, response, data) {
        if (error) {
            console.log(error);
            $notification.post(title + '登录失败', error, "");
        } else {
            if (JSON.parse(data).msg == "邮箱或者密码错误") {
                $notification.post(title + '邮箱或者密码错误', "", "");
            } else {
                await checkin(url, title)
            }
        }
    }
    );
}
';

$out = '<!DOCTYPE html>
<html>
    <head>
        <title>登錄</title>
    </head>
    <body>'.'hjjjjh'.'</body>
</html>';

echo $out;
?>
