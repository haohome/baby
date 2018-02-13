<?php
  header('Content-Type: application/json;charset=UTF-8');
  require_once("init.php");
  @$num=$_REQUEST['num'];
  @$order=$_REQUEST['order'];
  if($num){
    if($order==1){
      $sql= "SELECT * FROM w_photo ORDER BY pid DESC LIMIT $num";   
    }
    else{
      $sql= "SELECT * FROM w_photo ORDER BY pid LIMIT $num";   
    }
  }
  
  else{
    $sql= "SELECT * FROM w_photo GROUP BY day ORDER BY pid";   //每天取一个
  }
  echo json_encode(sql_execute($sql));
?>