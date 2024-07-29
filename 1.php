public function deleteUser($usr){
  $re['status']=0;
  if(!empty($this->myconn) && $this->myerr==0){
    if($stmt =$this->myconn->prepare("DELETE FROM `logins` WHERE username=?")){
       $stmt->bind_param("s",$usr);

       if($stmt->execute()){
         $re['status']=1;
       }
  }
}
return $re;
}
