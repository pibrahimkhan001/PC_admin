<?php
@session_start();
if(!empty($_SESSION['cert_user']) && !empty($_SESSION['priv']) && $_SESSION['priv']=="admin" && !empty($_POST['user']) ){
require('pcgs.php');
$ob=new PCGS();
$a=$ob->deleteUser($_POST['user']);
if($a['status']==1){
header('Location:delete.php?id=empty');

}
else
{
	header('Location: ./');
}
}
else{
	header('Location: ./');
}
?>