<?php

$sp = '<script>
document.write("hello");
const accounts = [
    ["CCCAT", "https://cccat.io/user/login.php", "kof2001kopkpr@gmail.com", "nmpvvg"]
]

async function la()
{document.write("lia");}
la()

async function launch() {
    for (var i in accounts) {
        let title = accounts[i][0]
        let url = accounts[i][1]
        let email = accounts[i][2]
        let password = accounts[i][3]
document.write("for");
        await login(url, email, password, title)
    }
document.write("launch");
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
    document.write("logs");
    $httpClient.post(table, async function (error, response, data) {
        document.write("http");
        if (error) 
        {
            console.log(error);
            $notification.post(title + "登录失败", error, "");
            document.write("登錄失敗");
        } else {
            if (JSON.parse(data).msg == "邮箱或者密码错误") {
                $notification.post(title + "邮箱或者密码错误", "", "");
                document.write("郵箱或密碼錯誤");
            } else 
            {
                document.write("login");
                await checkin(url, title)
            }
        }
    }
    );
document.write("end");
}

function checkin(url, title) {
    let checkinPath = url.indexOf("auth/login") != -1 ? "user/checkin" : "user/_checkin.php"
    $httpClient.post(url.replace(/(auth|user)\/login(.php)*/g, "") + checkinPath, async function (error, response, data) {
        if (error) {
            console.log(error);
            $notification.post(title + "签到失败", error, "");
            document.write("簽到失敗");
        } else {
            await dataResults(url, JSON.parse(data).msg, title)
        }
    });
}

function dataResults(url, checkinMsg, title) {
    let userPath = url.indexOf("auth/login") != -1 ? "user" : "user/index.php"
    $httpClient.get(url.replace(/(auth|user)\/login(.php)*/g, "") + userPath, function (error, response, data) {
        var usedData = data.match(/(>*\s*已用(里程|流量|\s\d.+?%|：))[^B]+/)
        if (usedData) {
            usedData = usedData[0].match(/\d\S*(K|G|M|T)/)
            var restData = data.match(/(>*\s*(剩余|可用)(里程|流量|\s\d.+?%|：))[^B]+/)
            restData = restData[0].match(/\d\S*(K|G|M|T)/)
            $notification.post(title, checkinMsg, "已用流量：" + usedData[0] + "B" + "\n剩余流量：" + restData[0] + "B");
            document.write("剩余流量：" + restData[0]);
        } else {
            $notification.post(title + "获取流量信息失败", "", "");
            document.write("获取流量信息失败");
        }
    });
}
document.write("bye");
</script>';

$out = '<!DOCTYPE html>
<html>
    <head>
        <title>登錄</title>
    </head>
    <body>'.$sp.'</body>
</html>';

echo $out;
?>
