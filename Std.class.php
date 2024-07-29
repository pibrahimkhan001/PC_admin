<?php
require_once("dbcredentials.class.php");
require_once("logs.class.php");

/**
 * Developed by ,
 */
class Std extends DBCredentials
{
	private $classname = "Std";
	private $logs = "";
	private $myconn = "";
	private $myerr = 0;

	public function __construct()
	{
		$this->logs = new Logs();
		$this->myconn = new mysqli($this->getHost(),$this->getUser(),$this->getPass(),$this->getDb());

		if (mysqli_connect_errno()) {
			$this->myerr = mysqli_connect_errno();
		}
	}


	public function addStd($rollno,$name,$pwd){
		$myname = $this->classname." - addStd - ";
		$res = array();
		$res['status'] = 0;

		if($this->myerr==0 && !empty($this->myconn)){
		  $sqlqry = "INSERT INTO `std`(`rollno`, `name`, `pwd`) VALUES (?,?,?)";
			if ($stmt = $this->myconn->prepare($sqlqry)) {
				$stmt->bind_param("sss",$rollno,$name,$pwd);
				if($stmt->execute()){
					if($this->myconn->affected_rows){
					  $res['status'] = 1;
					  $res['rows_affected'] = $this->myconn->affected_rows;
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

	
	public function checkStd($rollno){
		$res = array();
		$res['status'] = 0;
        $myname = $this->classname." - checkStd - ";
		if($this->myerr==0 && !empty($this->myconn)){
			  $sqlqry = "select `name` from `std` where `rollno`=?";
			if ($stmt = $this->myconn->prepare($sqlqry)) {
				$stmt->bind_param("s",$rollno);
				if($stmt->execute()){
					$stmt->bind_result($name);
					while($stmt->fetch()){
						$res['status'] = 1;
						$res['name'] = $name;
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
	public function addtask($rollno,$task){
		$myname = $this->classname." - addtask - ";
		$res = array();
		$res['status'] = 0;
		$dt=date('Ymd');

		if($this->myerr==0 && !empty($this->myconn)){
		  $sqlqry = "INSERT INTO `mywork`(`rollno`,`date`,`tasks`) VALUES (?,?,?)";
			if ($stmt = $this->myconn->prepare($sqlqry)) {
				$stmt->bind_param("sds",$rollno,$dt,$task);
				if($stmt->execute()){
					if($this->myconn->affected_rows){
					  $res['status'] = 1;
					  $res['rows_affected'] = $this->myconn->affected_rows;
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
	
	public function login($rollno){
		$res = array();
		$res['status'] = 0;
        $myname = $this->classname." - login - ";
		if($this->myerr==0 && !empty($this->myconn)){
			  $sqlqry = "select `pwd` from `std` where `rollno`=?";
			if ($stmt = $this->myconn->prepare($sqlqry)) {
				$stmt->bind_param("s",$rollno);
				if($stmt->execute()){
					$stmt->bind_result($pwd);
					while($stmt->fetch()){
						$res['status'] = 1;
						$res['pwd'] = $pwd;
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
	
	public function checktask($rollno){
		$res = array();
		$res['status'] = 0;
		$dt=date('Ymd');
        $myname = $this->classname." - checktask - ";
		if($this->myerr==0 && !empty($this->myconn)){
			  $sqlqry = "select `tasks` from `mywork` where `rollno`=? and `date`=?";
			if ($stmt = $this->myconn->prepare($sqlqry)) {
				$stmt->bind_param("sd",$rollno,$dt);
				if($stmt->execute()){
					$stmt->bind_result($tasks);
					while($stmt->fetch()){
						$res['status'] = 1;
						$res['tasks'] = $tasks;
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
	
	public function getbyrollno($rollno){
		$res = array();
		$res[0]['status'] = 0;
		//$dt=date('Ymd');
        $myname = $this->classname." - getbyrollno - ";
		if($this->myerr==0 && !empty($this->myconn)){
			  $sqlqry = "select `rollno`,`date`,`tasks` from `mywork` where `rollno`=? order by `date` desc";
			if ($stmt = $this->myconn->prepare($sqlqry)) {
				$stmt->bind_param("s",$rollno);
				if($stmt->execute()){
					$stmt->bind_result($rollno,$date,$tasks);
					$i=0;
					while($stmt->fetch()){
						$res[0]['status'] = 1;
						$res[$i]['rollno']=$rollno;
						$res[$i]['date']=$date;
						$res[$i]['tasks'] = $tasks;
						$i++;
					}
					$res[0]['ival']=$i;
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
	
	public function getbydate($date){
		$res = array();
		$res[0]['status'] = 0;
		//$dt=date('Ymd');
        $myname = $this->classname." - getbydate - ";
		if($this->myerr==0 && !empty($this->myconn)){
			  $sqlqry = "select `rollno`,`tasks` from `mywork` where `date`=? order by `rollno` asc";
			if ($stmt = $this->myconn->prepare($sqlqry)) {
				$stmt->bind_param("d",$date);
				if($stmt->execute()){
					$stmt->bind_result($rollno,$tasks);
					$i=0;
					while($stmt->fetch()){
						$res[0]['status'] = 1;
						$res[$i]['rollno']=$rollno;
						$res[$i]['tasks'] = $tasks;
						$i++;
					}
					$res[0]['ival']=$i;
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
	public function getbyrollnodate($rollno,$date){
		$res = array();
		$res['status'] = 0;
		//$dt=date('Ymd');
        $myname = $this->classname." - getbyrollnodate - ";
		if($this->myerr==0 && !empty($this->myconn)){
			  $sqlqry = "select `tasks` from `mywork` where `rollno`=? and `date`=?";
			if ($stmt = $this->myconn->prepare($sqlqry)) {
				$stmt->bind_param("sd",$rollno,$date);
				if($stmt->execute()){
					$stmt->bind_result($tasks);
					while($stmt->fetch()){
						$res['status'] = 1;					
						$res['tasks'] = $tasks;						
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
	
		public function gettaskbyrollno($rollno){
		$res = array();
		$res['status'] = 0;
		$dt=date('Ymd');
        $myname = $this->classname." - gettaskbyrollno - ";
		if($this->myerr==0 && !empty($this->myconn)){
			  $sqlqry = "select `tasks` from `mywork` where `rollno`=? and `date`=?";
			if ($stmt = $this->myconn->prepare($sqlqry)) {
				$stmt->bind_param("sd",$rollno,$dt);
				if($stmt->execute()){
					$stmt->bind_result($tasks);
					while($stmt->fetch()){
						$res['status'] = 1;
						$res['tasks'] = $tasks;
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
	
	public function edittask($rollno,$tasknew){
		$res = array();
		$res['status'] = 0;
		$dt=date('Ymd');
        $myname = $this->classname." - edittask - ";
		if($this->myerr==0 && !empty($this->myconn)){
			  $sqlqry = "update `mywork` set `tasks`=? where `rollno`=? and `date`=?";
			if ($stmt = $this->myconn->prepare($sqlqry)) {
				$stmt->bind_param("ssd",$tasknew,$rollno,$dt);
				if($stmt->execute()){
					if($stmt->affected_rows){
					  $res['status'] = 1;
					  $res['rows_affected'] = $this->myconn->affected_rows;
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
