<?php //pr($this->Session->read('Auth.Admin.User'));die;
	$controller = $this->params['controller'];
	$action = $this->params['action'];
?>
<div class="midLeft">
	<div class="logo"><?php echo $this->Html->image('admin/logo.png', array('alt'=>'', 'border'=>0,"width"=>"192px"));?></div>

	<div class="topLink"><strong><?php echo $this->Html->link('Logout', '/admin/admins/sign_out/', array('escape'=>false));?></strong></div>

	<div id="sidebar">
		<div id="sidebar-wrapper">
			<ul id="main-nav">
				<li><a href="javascript::void(0)" class="nav-top-item <?php if($controller == 'admins'){echo 'current';}?>">Settings</a>
					<ul>
						<li><a href="<?php echo SITE_PATH.'admin/admins/dashboard/';?>" <?php if($controller == 'admins' && $action=='admin_dashboard'){echo 'class="current"';}?>>Dashboard</a></li>
						<li><a href="<?php echo SITE_PATH.'admin/admins/change_email/';?>" <?php if($controller == 'admins' && $action=='admin_change_email'){echo 'class="current"';}?>>Change Email</a></li>
						<li><a href="<?php echo SITE_PATH.'admin/admins/change_password/';?>" <?php if($controller == 'users' && $action=='admin_change_password'){echo 'class="current"';}?>>Change Password</a></li>					
						
					</ul>
				</li>
				<li><a href="javascript::void(0)" class="nav-top-item <?php if($controller == 'users'){echo 'current';}?>">Users</a>
					<ul>
						<li><a href="<?php echo SITE_PATH.'admin/users/manage/';?>" <?php if(($controller == 'users' && $action=='admin_manage') || ($controller == 'users' && $action=='admin_edit')){echo 'class="current"';}?>>Manage</a></li>
						<li><a href="<?php echo SITE_PATH.'admin/users/add/';?>" <?php if($controller == 'users' && $action=='admin_add'){echo 'class="current"';}?>>Add</a></li> 
					</ul>
				</li> 				
			</ul>
		</div>
	</div>
</div>
