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
                    <h2>注册</h2>
                </div>
                <div class="content">
                    <form action="./regist.php" method="post">
                        <div class="content-bd">
                            <div>
                                <i></i><input type="text" name="username" >
                            </div>
                            <div>
                                <i></i><input type="password" name="password" >
                            </div>
                            <div>
                                <i></i><input type="password" name="confirmpwd" >
                            </div>
                            <div class="regist">
                                <input type="submit" name="submit" value="注册">
                                <span>已拥有账号？<a href="./login.php">点击登录</a></span>
                            </div>                              
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php 
        include_once("conn.php");
        if(!empty($_POST['submit'])){
            $username = $_POST['username'];
            $password = $_POST['password'];
            $confirmpwd = $_POST['confirmpwd'];
            if($username == "" || $password == "" || $confirmpwd == ""){
                echo "<script>alert('请确认信息完整性！');history.go(-1);</script>";
            }else{
                if($password == $confirmpwd){
                    $sql_select = "SELECT `username` FROM `users` WHERE `username` = '$username';";
                    $result = $mySQLi -> query($sql_select);
                    $count = $result -> num_rows;
                    if($count){
                        echo "<script>alert('用户名已存在');history.go(-1);</script>";
                    }
                    else{
                        $insert_password = md5(md5($password));
                        $sql_insert = "INSERT INTO `users` (username,password) VALUES ('$username','$insert_password');";
                        $res_insert =$mySQLi -> query($sql_insert);
                        if($res_insert){
                            echo "<script>alert('注册成功，正在跳转至登录页面！');location.href='./login.php';</script>";
                        }else{
                            echo "<script>alert('系统繁忙，请稍后！');history.go(-1);</script>";
                        }
                    }
                }else{
                    echo "<script>alert('密码不一致！');history.go(-1);</script>";
                }
            }
        }
    ?>
</body>
</html>