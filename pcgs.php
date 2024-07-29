<?php

require("DBCredentials.php");
require("logs.class.php");

/**
 *
 */
class PCGS extends DBCredentials
{
  private $classname = "PCGS";
  public $myconn = "";
  private $myerr = 0;
  public $logs="";

  public function __construct()
  {
    $this->logs = new Logs();
    $this->myconn = new mysqli($this->getHost(),$this->getUser(),$this->getPass());

    if (mysqli_connect_errno()) {
      $this->myerr = mysqli_connect_errno();
    }

  }

public function addUser($user,$pwd,$priv){
  $myname = $this->classname." - addUser - ";
  $res['status']=0;
  if(!empty($this->myconn) && $this->myerr==0){
    if($stmt =$this->myconn->prepare("INSERT INTO pc_jntuacea.`logins`(`username`, `password`, `privilege`) VALUES (?,?,?)")){

    $stmt->bind_param("sss",$user,$pwd,$priv);
    if($stmt->execute()){
      $res['status']=1;
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

public function deleteUser($usr){
  $myname = $this->classname." - deleteUser - ";
  $re=0;
  if(!empty($this->myconn) && $this->myerr==0){
    if($stmt =$this->myconn->prepare("DELETE FROM pc_jntuacea.`logins` WHERE username=?")){
       $stmt->bind_param("s",$usr);

       if($stmt->execute()){
         $re=1;
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

return $re;
}


public function updatePwd($usr,$pwd){
  $myname = $this->classname." - updatePwd - ";
  $res=0;
  if(!empty($this->myconn) && $this->myerr==0){
    if($stmt =$this->myconn->prepare("UPDATE pc_jntuacea.`logins` SET `password`=? WHERE username=?")){
      $stmt->bind_param("ss",$pwd,$usr);
      if($stmt->execute()){
        $res=1;
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


public function checkPwd($usr,$pwd){
   $myname = $this->classname." - checkPwd - ";
 
 $res=0;
  if(!empty($this->myconn) && $this->myerr==0){
    if($stmt =$this->myconn->prepare("SELECT `password` FROM pc_jntuacea.`logins` WHERE username=?")){
		$stmt->bind_param("s",$usr);
		if($stmt->execute()){
			$stmt->bind_result($pwds);
			$resp = "";
			while($stmt->fetch()){
				$resp=$pwds;
			}
			if($resp==$pwd){
				$res=1;
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


  public function showUsers($priv){
     $myname = $this->classname." - showUsers - ";
 
	  $res=array();
	  $res['status']=0;
  if(!empty($this->myconn) && $this->myerr==0){
    if($stmt =$this->myconn->prepare("SELECT `password`,`username` FROM pc_jntuacea.`logins` WHERE privilege=?")){
		$stmt->bind_param("s",$priv);
	 if($stmt->execute()){
		 $stmt->bind_result($pwds,$users);
		 $i=1;
		 while($stmt->fetch()){
			 $res['user'][$i]=$users;
			 $res['pwd'][$i]=$pwds;
		      $i++;
		 }
		 $res['total']=$i;
		 $res['status']=1;
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
  public function deleteHtno($htnoa){
    $myname = $this->classname." - deleteHtno - ";
	  $htnoa = strtoupper($htnoa);
        $res = 0;
         if($this->myerr==0 && !empty($this->myconn)){
         $yr = substr($htnoa,0,2);
          if($stmt = $this->myconn->prepare("DELETE FROM pc_jntuacea.year".$yr." WHERE htno=?")) {
           $stmt->bind_param("s",$htnoa);
    		  if($stmt->execute()){
            if($this->myconn->affected_rows){
                     $res = 1;
            }
            else{
              $res = 0;
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

  public function dumpDetails($htno){
    $myname = $this->classname." - dumpDetails - ";
      $inres=0;
      if($this->myerr==0 && !empty($this->myconn)){
       $yr = substr($htno,0,2);
        if($stm = $this->myconn->prepare("INSERT INTO pc_jntuacea.`dump`(`htno`, `stname`, `fname`, `mname`, `gender`, `course`, `speccode`, `month`, `year`,`percentage`,`adharno`,`imgpath`, `classawd`, `pc_issued`,`bywhom`) SELECT `htno`, `stname`, `fname`, `mname`, `gender`, `course`, `speccode`, `month`, `year`,`percentage`,`adharno`,`imgpath`, `classawd`, `pc_issued`, `bywhom` FROM pc_jntuacea.year".$yr." WHERE htno=?")) {

            $stm->bind_param("s",$htno);
             if($stm->execute()){
              $inres=1;


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

      return $inres;
    }

   public function getCourse($htnoc){
     $myname = $this->classname." - getCourse - ";
 
    $course = "";
    if($this->myerr==0 && !empty($this->myconn)){
      $cr = substr($htnoc,5,1);
      if ($stmt = $this->myconn->prepare("SELECT longname FROM  st_details.coursenames WHERE  `coursecodes`=?")) {
          $stmt->bind_param("s",$cr);

           if($stmt->execute()){

            $stmt->bind_result($courses);
            while ($stmt->fetch()) {
              $course = $courses;
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

    return $course;
  }


  public function getSpec($htnos){
     $myname = $this->classname." - getSpec - ";
 
    $spe = array();
    if($this->myerr==0 && !empty($this->myconn)){
      $cr = substr($htnos,5,1);
      $sp = substr($htnos,6,2);
      if ($stmt = $this->myconn->prepare("SELECT `spec`,`dept` FROM  st_details.specializations WHERE  `spec_code`=? AND  `cr_code`=?")) {
          $stmt->bind_param("ss",$sp,$cr);

           if($stmt->execute()){

            $stmt->bind_result($specs,$depts);
            while ($stmt->fetch()) {
              $spe['spec'] = $specs;
              $spe['dept'] = $depts;

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

    return $spe;
  }


      public function add_details($htno,$stname,$fname,$mname,$gender,$course,$branch,$month,$year,$percentage,$class,$adharno,$imgpath,$pcissued,$bywhom){
        $myname = $this->classname." - add_details - ";
      $inres = array();
      $inres['status']=0;
      if($this->myerr==0 && !empty($this->myconn)){

        $yr = substr($htno,0,2);
        if($stm = $this->myconn->prepare("INSERT INTO pc_jntuacea.year".$yr." (`htno`, `stname`, `fname`, `mname`, `gender`, `course`, `speccode`, `month`, `year`,`percentage`, `classawd`,`adharno`,`imgpath`, `pc_issued`,`bywhom`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)")) {

            $stm->bind_param("sssssssssssssss",$htno,$stname,$fname,$mname,$gender,$course,$branch,$month,$year,$percentage,$class,$adharno,$imgpath,$pcissued,$bywhom);
             if($stm->execute()){
                $inres['status']=1;

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
      return $inres;
    }




     public function editStDetails($name,$gender,$fname,$mname,$aadhar,$img,$htnoa){
      $myname = $this->classname." - editStDetails - ";
        $htnoa = strtoupper($htnoa);
        $res = 0;
         if($this->myerr==0 && !empty($this->myconn)){
         $yr = substr($htnoa,0,2);

         if(!empty($img)){
           $sql = "UPDATE st_details.year".$yr." SET `stname`=?,`gender`=?,`fname`=?,`mname`=?,`adharno`=?,`imgpath`=? WHERE htno=?";
         }else{
           $sql = "UPDATE st_details.year".$yr." SET `stname`=?,`gender`=?,`fname`=?,`mname`=?,`adharno`=? WHERE htno=?";
         }

          if($stmt = $this->myconn->prepare($sql)) {
           if(!empty($img)){
             $stmt->bind_param("sssssss",$name,$gender,$fname,$mname,$aadhar,$img,$htnoa);
           }else {
             $stmt->bind_param("ssssss",$name,$gender,$fname,$mname,$aadhar,$htnoa);
           }

          if($stmt->execute()){
            $res=1;
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

    function imgupload($fname,$destfolder,$myfilename){
      $myname = $this->classname." - imgupload - ";
  $imglen = 513000;
  $res = array();
  $res['status'] = 0;
  if((!empty($_FILES[$fname])) && ($_FILES[$fname]['error'] == 0)) {
    $filename = basename($_FILES[$fname]['name']);
    $ext = strtolower(substr($filename, strrpos($filename, '.') + 1));



    if((($ext == "jpg" || $ext == "jpeg") && ($_FILES[$fname]["type"] == "image/jpeg" || $_FILES[$fname]["type"] == "image/pjpeg"))){
    if($_FILES[$fname]["size"] < $imglen){
        if (is_dir($destfolder) && is_writable($destfolder)) {

        $dest = $destfolder.'/'.date('mY');
          if(!file_exists($dest)){
            mkdir($dest,0777);
          }

          if(!empty($myfilename)){
            $filename = $myfilename."_".rand(0,100).".".$ext;
          }else{
            $filename = "a".time()."".rand(0,100).".".$ext;
          }
          $imgdest = $dest."/".$filename;

          if (move_uploaded_file($_FILES[$fname]['tmp_name'],$imgdest)) {
            $res['status'] = 1;
            $res['imgpath'] = $imgdest;
          } else {
            $res['errmsg'] = "File Not Uploaded. Please try again.";
          }

        } else {
          $res['errmsg'] = 'Please check destination.';
        }

      }else{
        $res['errmsg'] = "Image length cannot exceed 500KB.";
      }
    }else{
      $res['errmsg'] = "Only .jpg images are allowed.";
    }

  } else {
    $res['errmsg'] = "File not uploaded";
  }
  return $res;
}

	  public function showDetails($htno){
       $myname = $this->classname." - showDetails - ";
 
      $res = array();
      $res['status']=0;
      if($this->myerr==0 && !empty($this->myconn)){
        $yr = substr($htno,0,2);
        $query = "SELECT  `stname`, `fname`,`mname`, `gender`,`course`,`speccode`,`month`,`year`,`percentage`,`adharno`,`imgpath`, `classawd`, `pc_issued` FROM pc_jntuacea.year".$yr." WHERE htno=?";
  if ($stmt = $this->myconn->prepare($query)) {

       $stmt->bind_param("s",$htno);
       if($stmt->execute()){
           
         $stmt->bind_result($stnames,$fnames,$mnames,$genders,$courses,$speccodes,$months,$years,$percentages,$adharno,$imgpath,$classawds,$pcissued);
         /* fetch value */
         while ($stmt->fetch()) {
           $res['stname'] = $stnames;
           $res['fname'] = $fnames;
           $res['mname']=$mnames;
           $res['gender']=$genders;
           $res['month']=$months;
           $res['year']=$years;

           $res['percentage'] = $percentages;
           $res['aadhar'] = trim($adharno);
           $res['img'] = $imgpath;
           $res['status']=1;
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

}
?>
