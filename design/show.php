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
    <link rel="stylesheet" href="./css/discover.css">
    <link rel="stylesheet" href="./css/show.css">
</head>
<body>
    <div class="to_top">
        <a href="#"><p><i></i></p></a>
    </div>
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
                        <a href="./discover.php" class="now">发现</a>
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
            </div>
            <div class="search">
                <form action="./discover.php">
                    <input type="text" class="text fl" name="search" value="<?php if (!empty($_GET['search'])) echo $_GET['search'];?>">
                    <button class="btn fl" type="submit">搜索</button>
                </form>
            </div>
            <div class="fr login">
            <?php 
                if (isset($_SESSION['islogin'])) {

                ?>
                    <span><?php echo $_SESSION['username'];?>,欢迎您!</span>
                    <a href='loginout.php'>注销</a>
                    <!-- $_SESSION['username'].' ,欢迎您!' -->
                <?php
                    } else {
                    echo "<a href='./login.php'>登录/注册</a>";
                }  
            ?>
                
            </div>
        </div>
    </div>
    <div class="w introduce">
        <div class="nav">
        <?php
        include_once("conn.php");
        if (!empty($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT `introduction`.`id` ,`introduction`.`name`,`birthday`,`work`,`introduction`,`image`,`content` FROM `introduction`,`images`,`content` WHERE `introduction`.name = `images`.name AND `introduction`.name = `content`.name AND `introduction`.id=$id;";
            $result = $mySQLi -> query($sql);
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            foreach($rows as $row){
                $imagedir=$row['image'];
    ?>
            <img src="<?php echo $imagedir;?>" alt="">
            <div class="top">
                <h3>
                    <?php echo $row['name'];?>
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
                        <a href="./edit.php?id=<?php echo $row['id']; ?>">编辑</a>
                        <a href="./delete.php?id=<?php echo $row['id']; ?>">删除</a>
                        <?php
                        } 
                    ?>         
                </h3>
            </div>
            <div class="bottom">
                <p><?php echo $row['introduction'];?></p>
            </div>
        </div>
        <div class="content">
            <div class="content-hd">
                <h3><span><?php echo $row['name'];?></span>-人物简介</h3>
            </div>
            <div class="content-bd">
                <?php echo $row['content'];?>
            </div>
            <?php
            }
        } else {
            echo "<script>location.href = './discover.php';</script>";
        }
    ?>
        </div>
    </div>
</body>
</html>