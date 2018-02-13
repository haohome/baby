<?php
  header('Content-Type: application/json;charset=UTF-8');
  require_once("init.php");
  $userName=$_REQUEST['userName'];
  $msg=$_REQUEST['msg'];
  $time=$_REQUEST['time'];
  $sql= "INSERT INTO w_msg (userName,msg,time) VALUES('$userName','$msg','$time')"; 
  $result = mysqli_query($conn, $sql);
  if($result){
    echo '{"code":1}';
  }
  else {
    echo '{"code":0}';
  }
?>