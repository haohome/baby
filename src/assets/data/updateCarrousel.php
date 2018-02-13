<?php
  header('Content-Type: application/json;charset=UTF-8');
  require_once("init.php");
  @$pid=$_REQUEST['pid'];
  @$count=$_REQUEST['count'];
  $sql="UPDATE w_photo SET count=$count WHERE pid=$pid"; 
  $result = mysqli_query($conn, $sql);
  if($result){
    echo '{"code":1}';
  }
  else {
    echo '{"code":0}';
  }
?>