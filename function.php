<?php
  // insert関数
  function insert_into($cn,$table_name,$columns,$values){
    $sql = 
    "INSERT INTO ".$table_name."(" .implode(',', $columns). ")
     VALUES(" . "'".implode("','", $values)."'" . ");";
    mysqli_query($cn, $sql);
    return;
  }

  // update関数
  function update($cn,$table_name,$columns,$values,$conditions){
    $sql = "UPDATE ".$table_name."";
    $sql .= " SET ";
    // columnsが配列=複数であるか
    if(is_array($columns)){
      for ($i=0; $i < count($columns); $i++) { 
        $sql .= $columns[$i]." = '".$values[$i]."'".($i != count($columns)-1?',':'')."";
      }
    }else{
      $sql .= $columns." = '".$values."'";
    }
    $sql .= ' '.$conditions.';';
    mysqli_query($cn, $sql);
    return;
  }

  // select関数出力複数
  function select_rows($cn,$table_name,$columns,$conditions){
    $sql = "SELECT ".implode(',', $columns)."";
    $sql .= " FROM ".$table_name." ";
    $sql .= $conditions.';';
    $result = mysqli_query($cn, $sql);
    mysqli_close($cn);
    $rows=[];
    while ($row = mysqli_fetch_assoc($result)) {
      $rows[] = $row;
    }
    return $rows;
  }

  // select関数出力
  function select_row($cn,$table_name,$columns,$conditions){
    $sql = "SELECT ".implode(',', $columns)."";
    $sql .= " FROM ".$table_name." ";
    $sql .= $conditions.';';
    $result = mysqli_query($cn, $sql);
    mysqli_close($cn);
    $row = mysqli_fetch_assoc($result);
    return $row;
  }

  // id割り当て関数
  function id_allotment($cn,$table_name){
    $sql = "SELECT MAX(id) FROM ".$table_name.";";
    $result = mysqli_query($cn, $sql);
    $row = mysqli_fetch_assoc($result);
    if (!empty($row['MAX(id)'])) {
      $id = $row['MAX(id)'] + 1;
    } else {
      $id = 1;
    }
    return $id;
  }
  
  // 削除フラグ関数
  function delete_flag($cn,$table_name,$del_id){
    $sql = "UPDATE ".$table_name." SET del_flg = 1 WHERE id = ".$del_id.";";
    mysqli_query($cn, $sql);
    return;
  }

  // 半角英数チェック関数
  function preg_check($text){
    return !preg_match("/^[a-zA-Z0-9]+$/", $text);
  }

  // メアドチェック関数
  function mail_check($text){
    return !preg_match("/[^\s]@[^\s]/", $text);
  }
  //改行対応関数
  function indention($text){
    $text = str_replace("\r\n", "<br>", $text);
    $text = str_replace("\r", "<br>", $text);
    $text = str_replace("\n", "<br>", $text);
    return $text;
  }