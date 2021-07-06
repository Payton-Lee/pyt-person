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
    <link rel="stylesheet" href="./css/write.css">
    <script src="https://cdn.jsdelivr.net/npm/tinymce@5.8.1/tinymce.min.js"></script>
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
                    <li>
                        <a href="./write.php">撰写大赛</a>
                    </li>
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
    <?php 
        include_once("conn.php");
        if(!empty($_POST['submit'])){
            $name = $_POST['sname'];
            $age = $_POST['age'];
            $work = $_POST['work'];
            $introduce = $_POST['introduce'];
            $content = $_POST['content'];
            $mySQLi -> begin_transaction();
            if($_FILES["photo"]["error"]) {
                echo $_FILES["photo"]["error"];
            }else{
                if(($_FILES["photo"]["type"]=="image/jpeg" || $_FILES["photo"]["type"]=="image/png") && $_FILES["photo"]["size"]<10240000){
                    $filename = "upload/".date("YmdHis").$_FILES["photo"]["name"];
                    $filename1 = iconv("UTF-8","gb2312",$filename);
                    if(!file_exists($filename1)){
                        move_uploaded_file($_FILES["photo"]["tmp_name"],$filename);
                        try {
                            $sql_1 = "UPDATE introduction SET name='$name', birthday='$age',work='$work',introduction='$introduce' WHERE id=$id;";
                            // $sql_2 = "UPDATE `content` SET `name`='$name',`content`='$content' WHERE `introduction`.name = `content`.name;";
                            // $sql_3 = "UPDATE `images` SET `image`=$filename,`name`='$name' WHERE `introduction`.name = `images`.name;";
                            $result_1 = $mySQLi -> query($sql_1);
                            // $result_2 = $mySQLi -> query($sql_2);
                            // $result_3 = $mySQLi -> query($sql_3);
                            $mySQLi -> commit();
                            if($result_1){
                                echo "<script>alert('编辑成功');location.href = './discover.php';</script>";
                            }else{
                                echo "<script>alert('编辑失败');location.href = './write.php';</script>";
                            }
                        }catch (mysqli_sql_exception $exception) {
                            $mySQLi->rollback();
                            throw $exception;
                        }
                    }
                }
            }
        }else{
            if (!empty($_GET['id'])) {
                $id = $_GET['id'];
                $sql= "SELECT `introduction`.`id` ,`introduction`.`name`,`birthday`,`work`,`introduction`,`image`,`content` FROM `introduction`,`images`,`content` WHERE `introduction`.name = `images`.name AND `introduction`.name = `content`.name AND `introduction`.id=$id;";
                $result = $mySQLi -> query($sql);
                $rows = $result->fetch_all(MYSQLI_ASSOC);
                foreach($rows as $row){
            ?>
                <div class="w write">
                    <form action="edit.php" method="post" enctype="multipart/form-data">
                        <div><span>姓名:</span><input type="text" name="sname" value="<?php echo $row['name']?>"></div>
                        <div><span>年龄:</span><input type="text" name="age" value="<?php echo $row['birthday']?>"></div>
                        <div><span>定位:</span><input type="text" name="work" value="<?php echo $row['work']?>"></div>
                        <div><span>照片:</span><input type="file" name="photo" class="file"></div>
                        <div><span>介绍:</span><input type="text" name="introduce" value="<?php echo $row['introduction']?>"></div>
                        <div><span>简介:</span><textarea name="content" id="content" cols=80 rows=5><?php echo $row['content']?></textarea></div>
                        <div><input type="submit" name="submit" value="提交" class="submit"></div>
                    </form>
                </div>
            <?php
                }
            }else{
                echo "<script>location.href = './write.php';</script>";
            }
        }
    ?>
<script type="text/javascript">
    tinymce.init({
        "selector": "#content"
    })
</script>
</body>
</html>