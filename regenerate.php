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
                    $menu_id = 5;
                    require_once("menu.php");
                  ?>
                </div>
              </div><!--/span-->

              <div class="col-xs-12 col-sm-9">

                <div class="panel panel-info">
          				<div class="panel-heading">
          					<h4 align='center'>Regenerating Provisional Certificate</h4>
          				</div>

          				<div class="panel-body">
          					<form class="form-horizontal" role="form" action="regenerate2.php" method="post">
          					<div class="form-group">
          						<label for="inputHtno" class="col-sm-4 control-label">Enter Roll Number:</label>
          						<div class="col-sm-4">
          							<input type="text" class="form-control" name="sthtno" id="inputHtno" placeholder="Hall Ticket No." pattern="[a-zA-Z0-9]{10}" required="required" title="Only Alphabets, digits are allowed with a maximum of 10 characters" maxlength="10" />
          						</div>
          						<div class="col-sm-4">&nbsp;
          						</div>
          					</div>
                   
          					<div class="form-group">
          						<div class="col-sm-offset-7 col-sm-5">
          							<button type="submit" class="btn btn-default">Get Details</button>
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
else {
  header('Location: ./');
}
 ?>
