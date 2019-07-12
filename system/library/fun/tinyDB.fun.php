<?php
  define("NOtinyDB",FALSE);
  
function insertTb($tb,$data,$debug=false){
  global $dbCon;
  global $prefix;
  $query="insert into `{$prefix}{$tb}` ";
  
  $col="(";
  $val=" values (";
  $i=0;
  foreach($data as $k=>$v){
    if($i){$col.=","; $val.=",";}
    $col.=$k;
    $val.=$v;
    
    $i++;
          }
  
  $col.=")";
  $val.=");";
  
 $query.=$col.$val;
  
  if($debug)print $query;
  mysqli_query($dbCon,'SET foreign_key_checks = 0');
  if(mysqli_query($dbCon,$query))$insertID=mysqli_insert_id($dbCon);
  else $insertID=0;
  mysqli_query($dbCon,'SET foreign_key_checks = 1');
    
  return $insertID;   
 }
 
  function selectTb($tbname,$col=NULL,$where=NULL,$debug=false){
    global $dbCon;
    global $prefix;
    if(!$col)$col='*';
    $query="select {$col} from `{$prefix}{$tbname}`";
    if($where)$query.=" where ".$where;
    $data=mysqli_query($dbCon,$query);
    if($data){
    $res=array();
    if(mysqli_num_rows($data)){
    while($row=mysqli_fetch_assoc($data)){
      $res[]=$row;
    }
   }
 }
    if($debug)print $query;
    print mysqli_error($dbCon);
    return $res;
  }
  
  function updateTb($tbname,$data,$where=NULL,$debug=false){
    global $dbCon;
    global $prefix;
    
    $i=0;
    $query="update `".$prefix.$tbname."` set ";
      foreach($data as $k=>$v){
        if($i)$query.=",";
        $query.=$k."=".$v;
    
        $i++;
        }
    if($where)$query.=" where ".$where;
    if($debug)print($query);
    return mysqli_query($dbCon,$query);
   
  }
  
  function deleteTb($tbname,$where=NULL,$debug=false){
    global $dbCon;
    global $prefix;
    $query="delete from `{$prefix}{$tbname}`";
    if($where)$query.=" where ".$where;
    $data=mysqli_query($dbCon,$query);
    if($debug)print $query;
    return $data;
  }
  
  function getConfig($config_name,$col=NULL,$debug=false){
    global $dbCon;
    global $prefix;
    $query="select {$col} from `{$prefix}site_config` where config_name='".$config_name."' limit 1";
    if($debug)print $query;
    $result=mysqli_query($dbCon,$query);
    $config_data=mysqli_fetch_array($result);
    //print_r($config_data);
    $res=$config_data;
    return $res;
  
  }
