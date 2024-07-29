<?php
@session_start();
if(!empty($_SESSION['cert_user']) && !empty($_SESSION['priv']) && $_SESSION['priv']=="admin" && !empty($_POST['sthtno'])){
$_POST['sthtno'] = strtoupper($_POST['sthtno']);
require('header.php');
require('pcgs.php');
$obj=new PCGS();
//$t=$obj->dumpDetails($_POST['sthtno']);
$t = 1;
if($t==1)
{
	//$b=$obj->deleteHtno($_POST['sthtno']);
	$det=$obj->showDetails($_POST['sthtno']);
	if($det['status']==1){
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
            <h4 align='center'> Regenerating Provisional Certificate </h4>
          </div>

          <div class="panel-body">
            <form class="form-horizontal" role="form" action="regenerate21.php" method="post" enctype="multipart/form-data">

                  <div class="form-group">
                    <label for="inputHtno" class="col-sm-5 control-label labelapply3">Hall Ticket Number:</label>
                    <div class="col-sm-4">
                      <?php echo $_POST['sthtno']; ?>
                    </div>
                    <div class="col-sm-3">
                    &nbsp;
                      </div>
                    </div>


                                <input type="hidden" name="htno" value="<?php echo $_POST['sthtno']?>">
                      <div class="form-group">

                  <label for="inputFName" class="col-sm-5 control-label labelapply3">Student Name:</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="stname" id="inputFName"
                        placeholder="student name" pattern="[a-zA-Z ]{1,60}" required="required" value="<?php echo $det['stname']?>" />
                    </div>
                    <div class="col-sm-3">

                      </div>
                    </div>
                    <div class="form-group">
                        <label for="adrno" class="col-sm-5 control-label labelapply3">Aadhar Number:</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" name="adhar" id="inputFName"
                            placeholder="Adhar Number" pattern="[0-9]{12}" title="12-digit aadhar number (without space)" maxlength="12"  value="<?php echo $det['aadhar'] ?>" />
                            
                        </div>
                        <div class="col-sm-3">
                               &nbsp;
                          </div>

                        </div>
                        
                        <?php  if(!empty($det['img'])){
                           ?>
                           <div class="form-group">
                             <label for="adrno" class="col-sm-5 control-label labelapply3">Existing Image:</label>
                             <div class="col-sm-4">
                               <img src="<?php echo '../pcgeneration_new/pcgeneration/'.$det['img']; ?>" height="120" width="100"/>
                               <input type="hidden" name="existingimg" value="<?php echo $det['img']; ?>" />
                             </div>
                             <div class="col-sm-3">
                                  &nbsp;
                             </div>
                           </div>

                           <div class="form-group">
                             <label for="adrno" class="col-sm-5 control-label labelapply3">Edit Image:</label>
                             <div class="col-sm-4">
                               <input type="file" class="form-control" name="image" id="InputImage" />
                             </div>
                             <div class="col-sm-3">
                                  &nbsp;
                             </div>
                           </div>
                        <?php
                        }else {
                        ?>
                           <div class="form-group">
                             <label for="adrno" class="col-sm-5 control-label labelapply3">Upload Image:</label>
                             <div class="col-sm-4">
                               <input type="file" class="form-control" name="image" id="InputImage" required="required" />
                             </div>
                             <div class="col-sm-3">
                                  &nbsp;
                             </div>
                           </div>
                           <?php
                         }
                        ?>
                    <div class="form-group">
                      <label for="inputFName" class="col-sm-5 control-label labelapply3">Father's Name:</label>
                      <div class="col-sm-4">
                        <input type="text" class="form-control" name="fname" id="inputFName"
                          placeholder="father name" pattern="[a-zA-Z ]{1,60}" required="required" value="<?php echo $det['fname']?>" />
                      </div>
                      <div class="col-sm-3">
                      &nbsp;
                        </div>

                      </div>
                      <div class="form-group">
                        <label for="inputFName" class="col-sm-5 control-label labelapply3">Mother's Name:</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" name="mname" id="inputFName"
                            placeholder="mother name" pattern="[a-zA-Z ]{1,60}" required="required" value="<?php echo $det['mname']?>" />
                        </div>
                        <div class="col-sm-3">
                               &nbsp;
                          </div>

                        </div>

												<div class="form-group">
							<label for="inputHtno" class="col-sm-5 control-label labelapply3">Gender:</label>
							<div class="col-sm-7">
								<?php
								if($det['gender']=='M' || $det['gender']=="MALE"){
										echo "<input type='radio' name='gender' value='M' checked />Male<br>";
										echo "<input type='radio' name='gender' value='F' />Female";
								}
								elseif($det['gender']=='F' || $det['gender']=="FEMALE"){
									echo "<input type='radio' name='gender' value='M' />Male<br>";
										echo "<input type='radio' name='gender' value='F' checked />Female";
								}
								else{
									echo "<span style='color:red'>Invalid</span>";
								}
								 ?>
							</div>
						</div>

                        <div class="form-group">
                  <label for="inputFName" class="col-sm-5 control-label labelapply3">Percentage:</label>

                <div class="col-sm-4">
				   <input type="number" name="percentage" min="1" max="100" step="0.01" placeholder="percentage"  required="required" value="<?php echo $det['percentage']?>" />
                      </div>
					  <div class="col-sm-3">
                         &nbsp;
                      </div>
                  </div>

									<div class="form-group">
						<label for="" class="col-sm-5 control-label labelapply3">Month & year Passed:</label>
						<div class="col-sm-2">
							<select class="form-control" name="month" required="required">
								<option value=""> --Select--</option>
								<option value="January" <?php if($det['month']=="January"){ echo "selected"; } ?> >January</option>
								<option value="February" <?php if($det['month']=="February"){ echo "selected"; } ?> >February</option>
								<option value="March" <?php if($det['month']=="March"){ echo "selected"; } ?> >March</option>
								<option value="April" <?php if($det['month']=="April"){ echo "selected"; } ?> >April</option>
								<option value="May" <?php if($det['month']=="May"){ echo "selected"; } ?> >May</option>
								<option value="June" <?php if($det['month']=="June"){ echo "selected"; } ?> >June</option>
								<option value="July" <?php if($det['month']=="July"){ echo "selected"; } ?> >July</option>
								<option value="August" <?php if($det['month']=="August"){ echo "selected"; } ?> >August</option>
								<option value="September" <?php if($det['month']=="September"){ echo "selected"; } ?> >September</option>
								<option value="October" <?php if($det['month']=="October"){ echo "selected"; } ?> >October</option>
								<option value="November" <?php if($det['month']=="November"){ echo "selected"; } ?> >November</option>
								<option value="December" <?php if($det['month']=="December"){ echo "selected"; } ?> >December</option>
								<option value="January/February" <?php if($det['month']=="January/February"){ echo "selected"; } ?> >January/February</option>
								<option value="February/March" <?php if($det['month']=="February/March"){ echo "selected"; } ?> >February/March</option>
								<option value="March/April" <?php if($det['month']=="March/April"){ echo "selected"; } ?> >March/April</option>
								<option value="April/May" <?php if($det['month']=="April/May"){ echo "selected"; } ?> >April/May</option>
								<option value="May/June" <?php if($det['month']=="May/June"){ echo "selected"; } ?> >May/June</option>
								<option value="June/July" <?php if($det['month']=="June/July"){ echo "selected"; } ?> >June/July</option>
								<option value="July/August" <?php if($det['month']=="July/August"){ echo "selected"; } ?> >July/August</option>
								<option value="August/September" <?php if($det['month']=="August/September"){ echo "selected"; } ?> >August/September</option>
								<option value="September/October" <?php if($det['month']=="September/October"){ echo "selected"; } ?> >September/October</option>
								<option value="October/November" <?php if($det['month']=="October/November"){ echo "selected"; } ?> >October/November</option>
								<option value="November/December" <?php if($det['month']=="November/December"){ echo "selected"; } ?> >November/December</option>
							</select>
						</div>
						<div class="col-sm-2">
							<select class="form-control" name="year" required="required">
								<option value=""> --Select--</option>
								<?php
								$yr1 = (int)"20".substr($_POST['sthtno'],0,2);
								$cr = substr($_POST['sthtno'],5,1);
								$cr1 = substr($_POST['sthtno'],4,1);
								$exp_yr = array('A'=>4,'F'=>3,'D'=>2);
								if($cr=='A' && $cr1=='5'){
									$exp_yr['A'] = 3;
								}
								$yr1 = $yr1+$exp_yr[$cr];
								$yr = (int)date('Y');
								for($i=$yr1;$i<=$yr;$i++){
									if($det['year']==$i){
										echo "<option value='".$i."' selected>".$i."</option>";
									}
									else{
										echo "<option value='".$i."'>".$i."</option>";
									}
								}
								 ?>
							</select>
						</div>
						<div class="col-sm-3">&nbsp;
						</div>
					</div>


                          <div class="form-group">
                            <label for="inputFName" class="col-sm-5 control-label labelapply3">Pc Issued:</label>
                            <div class="col-sm-7">
                              <?php
                              $dt = date('d-m-Y');
                              echo $dt;

                               ?>
                              <input type="hidden" class="form-control" name="pcissued" value="<?php echo $dt; ?>" required="required" />
                            </div>
                            </div>

                        <div class="form-group">
                          <div class="col-sm-4" align='right'>
                            &nbsp;
                          </div>
                          <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-default">Submit</button>
                          </div>
                        </div>



                        <input type='hidden' name='htno' value='<?php echo  strtoupper($_POST['sthtno'])?>' />
                      </form>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
        <?php
          require('footer.php');

      }
	  else{
		   header('Location:regenerate.php');
	  }
  }
	else{
		   header('Location:regenerate.php');
	  }
 }
         else{
          header('Location:./');
        }
?>
