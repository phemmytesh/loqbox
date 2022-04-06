<div class="br-logo pd-l-40">
	<a href="<?php echo $server; ?>/app"><img src="<?php echo $server; ?>/img/logo.png" width="90%" /></a>
</div>

<div class="br-sideleft overflow-y-auto">

	<label class="sidebar-label pd-x-15 mg-t-20">Navigation</label>
    
    <div class="br-sideleft-menu">
    
    	<a href="<?php echo $server; ?>/app" class="br-menu-link <?php if($filename2 == "app" || $filename2 == "notifications") { echo "active"; } ?>">
        	<div class="br-menu-item">
            	<i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
            	<span class="menu-item-label">Dashboard</span>
          	</div><!-- menu-item -->
		</a><!-- br-menu-link -->
        
        <a href="javascript:" class="br-menu-link <?php if($filename3=="profile") { echo "active show-sub"; } ?>">
			<div class="br-menu-item">
            	<i class="menu-item-icon icon ion-person tx-22"></i>
            	<span class="menu-item-label">My Profile</span>
            	<i class="menu-item-arrow fa fa-angle-down"></i>
          	</div><!-- menu-item -->
		</a><!-- br-menu-link -->
        <ul class="br-menu-sub nav flex-column" style="list-style:none">
        	<li class="nav-item"><a href="<?php echo $server; ?>/app/profile/user_info" class="nav-link <?php if($filename2=="user_info") { echo "active"; } ?>">Update Profile</a></li>
        	<li class="nav-item"><a href="<?php echo $server; ?>/app/profile/change_password" class="nav-link <?php if($filename2=="change_password") { echo "active"; } ?>">Change Password</a></li>
        </ul>

        <a href="<?php echo $server; ?>/app/transactions" class="br-menu-link <?php if($filename2=="transactions") { echo "active show-sub"; } ?>">
			<div class="br-menu-item">
            	<i class="menu-item-icon icon ion-grid tx-22"></i>
            	<span class="menu-item-label">Transactions</span>
          	</div><!-- menu-item -->
		</a><!-- br-menu-link -->
        
    	<a href="<?php echo $server; ?>/sign_out" class="br-menu-link">
        	<div class="br-menu-item">
            	<i class="menu-item-icon icon ion-power tx-22"></i>
            	<span class="menu-item-label">Sign Out</span>
          	</div><!-- menu-item -->
		</a><!-- br-menu-link -->
        
	</div><!-- br-sideleft-menu -->
                
    <div class="info-list">
    	
        <div class="d-flex align-items-center justify-content-between pd-x-15 pd-15">
        	<div>
            	<p class="tx-10 tx-roboto tx-uppercase tx-spacing-1 tx-white op-3 mg-b-2 space-nowrap">Version</p>
            	<p class="tx-10 tx-roboto tx-uppercase tx-spacing-1 tx-white op-5 mg-b-2 space-nowrap">1.0.0</p>
            	<!-- <h5 class="tx-lato tx-white tx-normal mg-b-0">1.0.1.1</h5> -->
          	</div>
        </div><!-- d-flex -->
        
	</div>

</div><!-- br-sideleft -->
