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
    <link rel="stylesheet" href="./css/index.css">
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
            <div class="fl discover">
                <ul>
                    <li>
                        <a href="./discover.php">发现</a>
                    </li>
                    <?php
                    // 开启Session
                    session_start();  
                    // 首先判断Cookie是否有记住了用户信息
                    if (isset($_COOKIE['username'])) {
                        # 若记住了用户信息,则直接传给Session
                        $_SESSION['username'] = $_COOKIE['username'];
                        $_SESSION['islogin'] = 1;
                    }
                    if (isset($_SESSION['islogin'])) {

                        ?>
                        <li>
                            <a href="./write.php">撰写大赛</a>
                        </li>
                        <?php
                        } else {
                            echo "<li><a href='./login.php'>撰写大赛</a></li>";
                        }  
                    ?>
                    
                </ul>
                </ul>
            </div>
            <div class="fr login">
            <?php 
                if (isset($_SESSION['islogin'])) {

                ?>
                    <span><?php echo $_SESSION['username'];?>,欢迎您!</span>
                    <a href='./loginout.php'>注销</a>
                <?php
                    } else {
                    echo "<a href='./login.php'>登录/注册</a>";
                }  
            ?>
            </div>
        </div>
    </div>
    <!-- 副标题开始 -->
    <div class="w biaoti">
        <h2>
            名人网，距离名人更进一步
        </h2>
    </div>
    <!-- 搜索框开始 -->
    <div class="w search">
            <form action="./discover.php">
                <input type="text" class="text fl" name="search" placeholder="每天将会有更多的名人被知道" autofocus="autofocus" autocomplete="off" >
                <button class="btn fl" type="submit">搜索</button>
            </form>
    </div>
    
</body>
</html>