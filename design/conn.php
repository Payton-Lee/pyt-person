<?php 
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $mySQLi = new MySQLi('localhost','root','123456','mingrenwang',3306);
    if($mySQLi -> connect_errno){
        die('连接错误' . $mySQLi -> connect_error);
    }
    $mySQLi -> set_charset('utf8');
?>
