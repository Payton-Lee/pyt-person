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
    <link rel="stylesheet" href="./css/login.css">
</head>
<body>
    <?php
        include_once("conn.php");
    ?>
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
    <!-- 登录开始 -->
    <div class="login">
        <div class="w">
            <div class="login_in">
                <div class="nav">
                    <h2>登录</h2>
                </div>
                <div class="content">
                    <form action="./login.php" method="post">
                        <div class="content-bd">
                            
                            <div>
                                <i></i><input type="text" name="username">
                            </div>
                            <div>
                                <i></i><input type="password" name="password">
                            </div>
                            <div class="yanzma">
                                <i></i><input type="text" name="captcha"><img src="checkcode.php" onclick="this.src='checkcode.php?a='+Math.random()" >
                            </div>
                            <div class="regist">
                                <input type="submit" name="submit" value="登录">
                                <span>没有账号？<a href="./regist.php">点击注册</a></span>    
                            </div>       
                                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
        if(!empty($_POST['submit'])){
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);
            $user_sql = " SELECT * FROM `users` WHERE `username` = '$username' ";
            $user_result = $mySQLi -> query($user_sql);
            $rows = $user_result->fetch_all(MYSQLI_ASSOC);
            var_dump($rows);
            foreach($rows as $row){
                if($user_result -> num_rows == 0){
                    echo "<script>alert('无此用户信息，请重新登录');location.href='./login.php';</script>";
                    exit;
                }elseif(($username == '') || ($password == '')){
                    echo "<script>alert('用户名密码不能为空！');location.href='./login.php';</script>";
                    exit;
                }elseif(($username != $row['username']) || (md5(md5($password)) != $row['password'])) {
                    // echo "<script>alert('用户名或密码错误');location.href='./login.php';</script>";
                    exit;
                }elseif (($username == $row['username']) && (md5(md5($password)) == $row['password'])){
                    if(!empty($_POST["captcha"])){
                        session_start();
                        $captcha = $_POST["captcha"];
                        if(strtolower($_SESSION["checkcode"]) == strtolower($captcha)){
                            $_SESSION['username'] = $username;
                            $_SESSION['islogin'] = 1;
                            setcookie('username', $username, time()+1*24*60*60);
                            setcookie('code', md5($username.md5($password)), time()+1*24*60*60);
                            $_SESSION["captcha"] = "";
                            echo "<script>alert('登录成功');location.href='./discover.php';</script>";   
                        }else{
                            echo "<script>alert('验证码错误');location.href='./login.php';</script>";
                        }
                   }
                    
                }
            }

        }      
    ?>
</body>
</html>