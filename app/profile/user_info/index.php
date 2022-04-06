<?php
include('../../../includes/global.php'); include('../../../includes/auth.php'); 
?>
<!DOCTYPE html>
<html lang="en">

  <head>
    <title>Update Your Information - Profile: Account Ledger | Loqbox</title>
	<?php include('../../../includes/meta.php'); ?>
    
  </head>

  <body>
  
    <!-- ########## START: LEFT PANEL ########## -->
	  <?php include('../../../includes/left-panel.php'); ?>
    <!-- ########## END: LEFT PANEL ########## -->

    <!-- ########## START: HEAD PANEL ########## -->
	  <?php include('../../../includes/head-panel.php'); ?>
    <!-- ########## END: HEAD PANEL ########## -->

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
    
      <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="<?php echo $server; ?>/app">Dashboard</a>
          <a class="breadcrumb-item" href="javascript:">My Profile</a>
          <span class="breadcrumb-item active">Information</span>
        </nav>
      </div><!-- br-pageheader -->
      <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
        <h4 class="tx-gray-800 mg-b-5">Update Your Information</h4>
        <p class="mg-b-0">Update your profile information</p>
      </div>

      <div class="br-pagebody">
        <div class="br-section-wrapper">
          <form name="form" id="form" action="process/" method="post">
              <div class="form-layout form-layout-6">
              
                <div class="row no-gutters">
                  <div class="col-5 col-sm-3">
                    First Name: <span class="tx-danger">*</span>
                  </div><!-- col-4 -->
                  <div class="col-7 col-sm-9">
	                  <input class="form-control" type="text" id="first_name" name="first_name" maxlength="18" value="<?php echo $row['first_name']; ?>" required>
                  </div><!-- col-8 -->
                </div><!-- row -->

                <div class="row no-gutters">
                  <div class="col-5 col-sm-3">
                    Last Name: <span class="tx-danger">*</span>
                  </div><!-- col-4 -->
                  <div class="col-7 col-sm-9">
	                  <input class="form-control" type="text" id="last_name" name="last_name" maxlength="18" value="<?php echo $row['last_name']; ?>" required>
                  </div><!-- col-8 -->
                </div><!-- row -->
                
                <div class="row no-gutters">
                  <div class="col-5 col-sm-3">
                    Email: <span class="tx-danger">*</span>
                  </div><!-- col-4 -->
                  <div class="col-7 col-sm-9">
	                  <input class="form-control" type="text" id="email" name="email" maxlength="60" value="<?php echo $row['email']; ?>" required>
                  </div><!-- col-8 -->
                </div><!-- row -->
                
                <div class="row no-gutters">
                  <div class="col-5 col-sm-3">
                    Phone Number: <span class="tx-danger">*</span>
                  </div><!-- col-4 -->
                  <div class="col-7 col-sm-9">
                    <input class="form-control" type="text" id="phone" name="phone" maxlength="15" value="<?php echo $row['phone']; ?>" required>
                  </div><!-- col-8 -->
                </div><!-- row -->
                
                <div class="row no-gutters">
                  <div class="col-sm-12" style="background-color:#FFF; border-left:none">
                  </div><!-- col-8 -->
                </div><!-- row -->
                                
                <div class="row no-gutters">
                  <div class="col-5 col-sm-3">
                    Occupation: <span class="tx-danger">*</span>
                  </div><!-- col-4 -->
                  <div class="col-7 col-sm-9">
                    <input class="form-control" type="text" id="occupation" name="occupation" maxlength="45" value="<?php echo $row['occupation']; ?>" required>
                  </div><!-- col-8 -->
                </div><!-- row -->
                
                <div class="row no-gutters">
                  <div class="col-sm-12" style="background-color:#FFF; border-left:none">
                  </div><!-- col-8 -->
                </div><!-- row -->
                                
                <div class="row no-gutters">
                  <div class="col-sm-12" style="background-color:#FFF; border-left:none">
                  </div><!-- col-8 -->
                </div><!-- row -->
                
                <div class="row no-gutters">
                  <div class="col-5 col-sm-3">
                    Security: <span class="tx-danger">*</span>
                  </div><!-- col-4 -->
                  <div class="col-7 col-sm-9">
                    <input class="form-control" type="password" id="password" name="password" placeholder="Enter Account Password" maxlength="15">
                  </div><!-- col-8 -->
                </div><!-- row -->
                                
                <div class="row no-gutters">
                  <div class="col-5 col-sm-3">
                    &nbsp;
                  </div><!-- col-4 -->
                  <div class="form-layout-footer col-7 col-sm-9 bd pd-20 bd-t-0">
                    <input class="btn btn-primary" id="submit" type="submit" style="cursor:pointer" value="Update Information"> 
                  </div><!-- col-8 -->
                </div><!-- row -->
                
              </div><!-- form-layout -->
		      </form>
          <div id="message"></div>
          
          <p class="tx-11 tx-uppercase tx-spacing-2 mg-t-40 mg-b-10 tx-gray-600">Notes</p>
          <pre><code class="javascript pd-20">This will update the user information your account ledger. All fields with <span class="tx-danger">*</span> are mandatory</code></pre>
          
        </div><!-- br-section-wrapper -->
      </div><!-- br-pagebody -->
      
	<?php include('../../../includes/footer.php'); ?>
    </div><!-- br-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
    
	<?php include('../../../includes/scripts.php'); ?>
  </body>
</html>
