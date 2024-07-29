<?php
@session_start();
if(!empty($_SESSION['cert_user']) && !empty($_SESSION['priv']) && $_SESSION['priv']=="admin"){
$_SESSION['create']=rand(0,100);
require('header.php');
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
          					<h4 align='center'>Adding User</h4>
          				</div>

          				<div class="panel-body">
          					<form class="form-horizontal" role="form" action="create.php" method="post">
          					<div class="form-group">
          						<label for="inputHtno" class="col-sm-4 control-label"> User Name:</label>
          						<div class="col-sm-4">
          							<input type="text" class="form-control" name="user" id="inputHtno" placeholder="user name" required="required"  />
          						</div>
          						<div class="col-sm-4">&nbsp;
          						</div>
          					</div>
							<div class="form-group">
          				     <label for="inputHtno" class="col-sm-4 control-label"> Password:</label>
							 <div class="col-sm-4">
          				  <input type="password" class="form-control" placeholder="Password" pattern="[a-zA-Z0-9.!@$#%^&*<>?_ ]{8,12}"  name="pwd" required="required" title="All Characters are allowed with a minimum length of 8 characters" maxlength="12" />
                             </div>
							 <div class="col-sm-4">&nbsp;
          						</div>
          				    </div>
							<div class="form-group">
          				     <label for="inputHtno" class="col-sm-4 control-label">Confirm Password:</label>
							 <div class="col-sm-4">
          				  <input type="password" class="form-control" placeholder="confirm Password" name="confirmpwd" required />
                             </div>
							 <div class="col-sm-4">&nbsp;
          						</div>
          				    </div>

          					<div class="form-group">
          						<div class="col-sm-offset-7 col-sm-5">
          							<button type="submit" class="btn btn-default">ADD </button>
          						</div>
          					</div>
          					</form>
							<?php
							if(!empty($_POST['user']) && !empty($_POST['pwd']) && !empty($_POST['confirmpwd'])){
								require('pcgs.php');
                                 $obj=new PCGS();
                               $a=$obj->addUser($_POST['user'],$_POST['pwd'],"generator");
                                  if($a['status']==1){

							?>
							 <div class="form-group">
							 <div class="col-sm-12" align="center">
							 <?php echo "user added sucessfully";?>
							 </div>
							 </div>
							 <?php
								  }else{
									  echo "Not successful";
								       }
							    }else{
								     /**/
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
else {
  header('Location: ./');
}
 ?>
