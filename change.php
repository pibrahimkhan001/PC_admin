<?php
@session_start();
if(!empty($_SESSION['cert_user']) && !empty($_SESSION['priv']) && $_SESSION['priv']=="admin"){

require('header.php');
 ?>

<div class="container-fluid">
    <div class="row row-offcanvas row-offcanvas-left">

              <div class="col-xs-12 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
                <div class="list-group">
                  <?php
                    $menu_id = 4;
                    require_once("menu.php");
                  ?>
                </div>
              </div><!--/span-->

              <div class="col-xs-12 col-sm-9">

                <div class="panel panel-info">
          				<div class="panel-heading">
          					<h4 align='center'>Changing Password</h4>
          				</div>

          				<div class="panel-body">
          					<form class="form-horizontal" role="form" action="changedpwd.php" method="post">
          					<div class="form-group">
          						<label for="inputHtno" class="col-sm-4 control-label"> User Name:</label>
          						<div class="col-sm-4">
          							<input type="text" class="form-control" name="user" id="inputHtno" placeholder="user name" required="required"  />
          						</div>
          						<div class="col-sm-4">&nbsp;
          						</div>
          					</div>
							<div class="form-group">
          				     <label for="inputHtno" class="col-sm-4 control-label">Current Password:</label>
							 <div class="col-sm-4">
          				  <input type="password" class="form-control" placeholder="Password" name="pwd" required />
                             </div>
							 <div class="col-sm-4">&nbsp;
          						</div>
          				    </div>
							<div class="form-group">
          				     <label for="inputHtno" class="col-sm-4 control-label">New Password:</label>
							 <div class="col-sm-4">
          				  <input type="password" class="form-control" placeholder="new password" pattern="[a-zA-Z0-9.!@$#%^&*<>?_ ]{8,12}" name="newpwd" required="required" title="All Characters are allowed with a minimum length of 8 characters" maxlength="12" />
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
          							<button type="submit" class="btn btn-default">CHANGE</button>
          						</div>
          					</div>
          					</form>
                    
					          <div class="form-group">
							 <div class="col-sm-12" align="center">
							 <?php
							 if(!empty($_GET['id']) && $_GET['id']=="change"){
								 echo "Please Match The New Password With Confirm Password";
							 }
						     ?>
							 </div>
                             </div>
                    
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
