<?php
@session_start();
if(!empty($_SESSION['cert_user']) && !empty($_SESSION['priv'])){
  unset($_SESSION['cert_user']);
  unset($_SESSION['priv']);
}
$_SESSION['loginid'] = rand(1,10000);
require('header.php');
 ?>
     <div class="container">
       <div class="row">
         <div class="col-md-4">&nbsp;
         </div>
           <div class="col-md-4">
               <form class="form-signin" role="form" action="usercheck.php" method="post"><br/><br/>
                 <h3 class="form-signin-heading">PC Generator</h3><br/>
          				<div class="input-group">
          				  <span class="input-group-addon" id="sizing-addon2"><i class="glyphicon glyphicon-user text-primary"></i></span>
          				  <input type="text" class="form-control" placeholder="Username" name="user" required autofocus />
          				</div><br/>
          				<div class="input-group">
          				  <span class="input-group-addon" id="sizing-addon2"><i class="glyphicon glyphicon-lock"></i></span>
          				  <input type="password" class="form-control" placeholder="Password" name="pwd" required />
                    <input type="hidden" name="sessvar" value="<?php echo $_SESSION['loginid']; ?>" />
          				</div>
                 <br/>
                 <button class="btn btn-md btn-primary btn-block" type="submit">Log in</button>
               </form>
            </div>
          <div class="col-md-4">&nbsp;
          </div>
        </div>
      </div> <!-- /container -->
<?php
require('footer.php');

 ?>
