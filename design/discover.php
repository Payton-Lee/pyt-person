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
    <script src="./js/animate.js"></script>
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
                    <li class="now">
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
                    <a href='./loginout.php'>注销</a>
                <?php
                    } else {
                    echo "<a href='./login.php'>登录/注册</a>";
                }  
            ?>
            </div>
        </div>
    </div>
    <div class="w wrap" id="box">
        <ul id="navs" class="navs" style="left: -1200px">
            <li><a href="javascript:;"><img src="./img/bj.jpg"/></a></li>
            <li><a href="javascript:;"><img src="./img/bj.jpg"/></a></li>
            <li><a href="javascript:;"><img src="./img/bj.jpg"/></a></li>
            <li><a href="javascript:;"><img src="./img/bj.jpg"/></a></li>
            <li><a href="javascript:;"><img src="./img/bj.jpg"/></a></li>
            <li><a href="javascript:;"><img src="./img/bj.jpg"/></a></li>
            <li><a href="javascript:;"><img src="./img/bj.jpg"/></a></li>
        </ul>
        <a id="pre" class="left">&lt;</a>
        <a id="nex" class="right">&gt;</a>
        <ul id="bots">
        </ul>
    </div>
    <div id="main" class="w">
        <div class="waterfall J_waterfall">
        <?php 
        include_once("conn.php");
        $search_condition = "";
        if(!empty($_GET['search'])){
            $search = $_GET['search'];
            $search_condition = " AND `introduction`.`name` LIKE '%$search%' OR `introduction`.`work` LIKE '%$search%'";
        }
        $sql = "SELECT `introduction`.`id` ,`introduction`.`name`,`birthday`,`work`,`introduction`,`image`,`content` FROM `introduction`,`images`,`content` WHERE `introduction`.name = `images`.name AND `introduction`.name = `content`.name $search_condition;";
        $result = $mySQLi -> query($sql);
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        foreach($rows as $row){
            $imagedir=$row['image'];
    ?>
            <div class="wf-item">
                <a href="./show.php?id=<?php echo $row['id'];?>">
                        <img src="<?php echo $imagedir;?>" alt="" class="wf-img">
                        <h2><?php echo $row['name'];?></h2>
                        <span><?php echo $row['birthday'];?></span>
                        <p><?php echo $row['work'];?></p>
                        <p><?php echo $row['introduction'];?></p>
                </a>
            </div>
    <?php
        }
    ?>        
        </div>
    </div>
    <script type="text/javascript" src="./js/waterfall.js"></script>
    <script>
        new Waterfall({
            el: 'J_waterfall',
            colmun: 7,
            gap: 20
        })
    </script>
</body>
</html>