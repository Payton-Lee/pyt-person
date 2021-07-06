<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        include_once("conn.php");
        if (!empty($_GET['id'])) {
            $id = $_GET['id'];
            $sql_1 = "SELECT `introduction`.`id` ,`introduction`.`name`,`birthday`,`work`,`introduction`,`image`,`content` FROM `introduction`,`images`,`content` WHERE `introduction`.name = `images`.name AND `introduction`.name = `content`.name AND `introduction`.id=$id;";
            $result = $mySQLi -> query($sql_1);
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            foreach($rows as $row){
                $mySQLi -> begin_transaction();
                try{
                    $name = $row['name'];
                    $sql_2 = "DELETE FROM `images` WHERE `name` = '$name';";
                    $sql_3 = "DELETE FROM `content` WHERE `name` = '$name';";
                    $sql_4 = "DELETE FROM `introduction` WHERE `name` = '$name';";
                    $result_2 = $mySQLi -> query($sql_2);
                    $result_3 = $mySQLi -> query($sql_3);
                    $result_4 = $mySQLi -> query($sql_4);
                    $mySQLi -> commit();
                    if ($result_2 && $result_3 && $result_4) {
                        echo "<script>alert('删除成功');location.href = './discover.php';</script>";
                    } else {
                        echo "<script>alert('删除失败');location.href = './discover.php';</script>";
                    }
                }catch(mysqli_sql_exception $exception){
                    $mySQLi -> rollback();
                    throw $exception;
                }
            }
            
        } else {
            echo "<script>location.href = './show.php?id=".$id."';</script>";
        }
    ?>
</body>
</html>