<?php
  header('Content-Type: application/json;charset=UTF-8');
  require_once("init.php");
  @$num=$_REQUEST['num'];
  if($num){
    $sql= "select * FROM w_msg ORDER BY cid DESC LIMIT $num";
  }
  else{
    $sql= "select * FROM w_msg ORDER BY cid DESC";
  }
  echo json_encode(sql_execute($sql));
?>