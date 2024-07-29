<?php
@session_start();
if(!empty($_SESSION['cert_user']) && !empty($_SESSION['priv']) && $_SESSION['priv']=="admin"){

	require('header.php');
	require("pcgs.php");
	$ob=new PCGS();
	
	$delres = 9;
	if(!empty($_POST['deluser'])){
		$delres = $ob->deleteUser($_POST['deluser']);
	}
	
$c=$ob->showUsers("generator");
if($c['status']==1){
?>
<div class="container-fluid">
    <div class="row row-offcanvas row-offcanvas-left">
	 <div class="col-xs-12 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
                <div class="list-group">
                  <?php
                    $menu_id = 2;
                    require_once("menu.php");
                  ?>
                </div>
              </div><!--/span-->


             
              <div class="col-xs-12 col-sm-9">
				<ul class="nav nav-tabs">
				<li><a href="create.php">Add User</a></li>
				<li><a href="display.php">Display User</a></li>
				</ul>
                <div class="panel panel-info">
				         <div class="panel-heading">
                       <h4 align='center'>Users Details</h4>
                        </div>

          				
          				<div class="panel-body">
						
							          					<div class="row">
          						<div class="col-sm-3" >
								<label>s.no</label>
								</div>
          						<div class="col-sm-3" >
          							<label>Username</label>
          						</div>
                                  <div class="col-sm-3" >
          							<label>Password</label>
          						</div>
                                 <div class="col-sm-3" >
          							<label>Option</label>
          						</div>

          					</div>

							 
							  <?php
							  for($s=1;$s<$c['total'];$s++){
							  ?>
          				     <form class="form-horizontal" role="form" action="display.php" method="post">
							  <div class="form-group">
          						<div class="col-sm-3" >
								<?php echo $s;?>
								</div>
          						<div class="col-sm-3" >
          							<?php echo $c['user'][$s];?>
          						</div>
                                  <div class="col-sm-3" >
          							<?php echo $c['pwd'][$s];?>
          						</div>
                                 <div class="col-sm-3" >
									<input type="hidden" name="deluser" value="<?php echo $c['user'][$s];?>" />
          							<button type="submit" class="btn btn-default">Delete </button>

          						</div>

          			 		</div>
				          </form>
							
						<?php
						   }
						?>
							<?php
								if($delres==1){
									echo "deleted";
								}
								elseif($delres==0){
									echo "Not deleted";
								}
								else{
									//echo "";
								}
							?>



						
          				</div><!--panel body-->
          			</div><!--panel info-->

              </div>
    </div>

</div>
<?php
require('footer.php');
}
else{
	header('Location: ./');
}
}
else{
	header('Location: ./');
}
?>