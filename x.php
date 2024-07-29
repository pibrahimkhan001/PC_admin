<?php
require("pcgs.php");
$a=new PCGS();
$x=$a->addUser("mah","508","generator");
var_dump($x);
if($x['status']==1){
echo "sucess";
}
$q=$a->deleteUser("sa");
if($q['status']==1){
  echo "sucess";
}
else {
  echo "error";
}
$r=$a->updatePwd("ma","mahi508");
if($r['status']==1){
  echo "sucess";
}
else {
  echo "error";
}

?>
