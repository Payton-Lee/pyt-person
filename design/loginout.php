<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="名人网MINGREN.COM-综合名人百科信息、让每个人都离名人更进一步！"/>
    <meta name="Keywords" content="名人,名人网,伟人,大人物,科研,教育,知识,了解名人,名人百科" />
    <title>名人网-综合名人百科信息、让每个人都离名人更进一步！</title>
    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/comm.css">
    <link rel="stylesheet" href="./css/loginout.css">
</head>
<body>
<!-- 顶部导航栏 -->
    <div class="shortcut">
        <div class="w">
            <div class="logo fl">
                <!-- h1提权 -->
                <!-- a返回首页 -->
                <h1>
                    <a href="./index.php" title="名人网">名人网</a>
                </h1>
            </div>
        </div>
    </div>
<?php 
    header('Content-type:text/html; charset=utf-8');
    // 注销后的操作
    session_start();
    // 清除Session
    $username = $_SESSION['username']; //用于后面的提示信息
    $_SESSION = array();
    session_destroy();
    
    // 清除Cookie
    setcookie('username', '', time()-99);
    setcookie('code', '', time()-99);
    
    // 提示信息
?>
    <div class="loginout">
        <div class="w">
            <div class="loginout_done">
                <div class="nav">
                    <h2>欢迎下次光临,<?php echo $username;?></h2>
                </div>
                <div class="content">
                    <div class="content-bd">
                        <div>
                            <p><a href='./login.php'>重新登录</a></p>
                        </div>
                        <div>
                            <p><a href='./discover.php'>返回首页</a></p>
                        </div>                  
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>
</html>