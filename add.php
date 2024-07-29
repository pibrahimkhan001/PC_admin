<?php
@session_start();
if(!empty($_SESSION['cert_user']) && !empty($_SESSION['priv']) && $_SESSION['priv']=="admin"){
if(!empty($_POST['user']) && !empty($_POST['pwd'])){

require('header.php');
require('pcgs.php');
$obj=new PCGS();
$a=$obj->addUser($_POST['user'],$_POST['pwd'],"generator");
if($a['status']==1){
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
          				      	<?php echo $_POST['pwd']; ?>
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
	header('Location: ./');
}
}
else{
	header('Location: ./');
}
}
 ?>
