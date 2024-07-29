<?php
@session_start();
if(!empty($_SESSION['cert_user']) && !empty($_SESSION['priv']) && $_SESSION['priv']=="admin"){

require('header.php');
 ?>

<div class="container-fluid">
    <div class="row row-offcanvas row-offcanvas-left">

              <div class="col-xs-12 col-sm-3 "  role="navigation">
                <div class="list-group">
                  <?php
                    $menu_id = 1;
                    require_once("menu.php");
                  ?>
                </div>
              </div><!--/span-->

              <div class="col-xs-12 col-sm-9">
                <b>Certificate Generation System<br>
                Instructions will be added based on issue</b>
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
