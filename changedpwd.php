<?php
@session_start();
if(!empty($_SESSION['cert_user']) && !empty($_SESSION['priv']) && $_SESSION['priv']=="admin"){
 if(!empty($_POST['user']) && !empty($_POST['pwd']) && !empty($_POST['newpwd']) && !empty($_POST['confirmpwd'])){
require('header.php');
require("pcgs.php");
$t=new PCGS();
$r=$t->checkPwd($_POST['user'],$_POST['pwd']);
if($_POST['newpwd']==$_POST['confirmpwd'] && $r==1 ){
$x=$t->updatePwd($_POST['user'],$_POST['newpwd']);
if( $x==1){
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
                       <h4 align='center'>New User Details</h4>
                        </div>


          				<div class="panel-body">
						<form class="form-horizontal" role="form" >

          					<div class="form-group">
          						<label for="inputHtno" class="col-sm-6 control-label labelapply3"> User Name:</label>
          						<div class="col-sm-6">
          							<?php echo $_POST['user']; ?>
          						</div>

          					</div>
							<div class="form-group ">
          				     <label for="inputHtno" class="col-sm-6 control-label labelapply3"> Password:</label>
							 <div class="col-sm-6">
          				      	<?php echo $_POST['newpwd']; ?>
                             </div>

          				    </div>
							</form>

          				</div><!--panel body-->
          			</div><!--panel info-->

              </div>
    </div>

</div>
<?php
require('footer.php');
}
else{
	header('Location: change.php');
}

}
else{
	header('Location: change.php?id=change');
}
}
else{
	header('Location: change.php');
}
}else{
	header('Location: ./');
}
?>
