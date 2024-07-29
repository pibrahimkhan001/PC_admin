<?php

require("DBCredentials.php");
require("logs.class.php");
/**
 * Developed by Anil, Maheswari, Sarika
 */
class Logins extends DBCredentials
{
  private $classname = "Logins";
  private $myconn = "";
  private $myerr = 0;
  public $logs="";
  

  public function __construct()
  {
    $this->logs = new Logs(); 
    $this->myconn = new mysqli($this->getHost(),$this->getUser(),$this->getPass(),$this->getDb());

    if (mysqli_connect_errno()) {
      $this->myerr = mysqli_connect_errno();
    }

  }


  public function checkLogin($user,$pwd){
     $myname = $this->classname." - checkLogin - ";
 
    $res = array();
    $res['status'] = 0;

    if($this->myerr==0 && !empty($this->myconn)){

      if ($stmt = $this->myconn->prepare("SELECT privilege FROM logins WHERE username=? and password=?")) {
          $stmt->bind_param("ss",$user,$pwd);

           if($stmt->execute()){
            /* bind result variables */
            $stmt->bind_result($privileges);
            while ($stmt->fetch()) {
              $privilege = $privileges;
            }

            if(!empty($privilege)){
              $res['status'] = 1;
              $res['user'] = $user;
              $res['priv'] = $privileges;
            }

           }
            else{
          $this->logs->errLog($myname."Statement not executed".$this->myconn->error);
        }
       }
      else{
        $this->logs->errLog($myname."Not prepared");
      }
    }
    else{
      $this->logs->errLog($myname."Mysqli Error or else");
    }


    return $res;
  }

  public function __destruct(){
    if(!empty($this->myconn)){
      $this->myconn->close();
    }
  }

}

 ?>
