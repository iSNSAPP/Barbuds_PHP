<?php
	$controller = $this->params['controller'];
	$action = $this->params['action'];
?>
<div class="midLeft">
	<div class="logo"><?php echo $this->Html->image('front_end/logo_1.png', array('alt'=>'', 'border'=>0));?></div>

	<div class="topLink"><?php echo $this->Html->link('Logout', '/admin/admins/sign_out/', array('escape'=>false));?></div>

	<div id="sidebar">
		<div id="sidebar-wrapper">
			<ul id="main-nav">
				<li><a href="javascript://void(0);" class="nav-top-item <?php if($controller == 'admins'){echo 'current';}?>">Admin Settings</a>
					<ul>
						<li><a href="<?php echo SITE_PATH.'admin/admins/dashboard/';?>" <?php if($controller == 'admins' && $action=='admin_dashboard'){echo 'class="current"';}?>>Dashboard</a></li>
						<li><a href="<?php echo SITE_PATH.'admin/admins/change_email/';?>" <?php if($controller == 'admins' && $action=='admin_change_email'){echo 'class="current"';}?>>Change Email</a></li>
						<li><a href="<?php echo SITE_PATH.'admin/admins/change_password/';?>" <?php if($controller == 'admins' && $action=='admin_change_password'){echo 'class="current"';}?>>Change Password</a></li>
					</ul>
				</li>

				<li><a href="javascript://void(0);" class="nav-top-item <?php if($controller == 'pages'){echo 'current';}?>">Content Management System</a>
					<ul>
						<li><a href="<?php echo SITE_PATH.'admin/pages/manage/';?>" <?php if($controller == 'pages' && $action=='admin_manage'){echo 'class="current"';}?>>Manage</a></li>
					</ul>
				</li>

				<li><a href="javascript://void(0);" class="nav-top-item <?php if($controller == 'faq_metas' || $controller == 'faqs'){echo 'current';}?>">Frequently Asked Questions</a>
					<ul>
						<li><a href="<?php echo SITE_PATH.'admin/faq_metas/manage/';?>" <?php if($controller == 'faq_metas' && $action=='admin_manage'){echo 'class="current"';}?>>Manage FAQ Meta Tags</a></li>
						<li><a href="<?php echo SITE_PATH.'admin/faqs/manage/';?>" <?php if($controller == 'faqs' && $action=='admin_manage'){echo 'class="current"';}?>>Manage FAQ's</a></li>
						<li><a href="<?php echo SITE_PATH.'admin/faqs/add/';?>" <?php if($controller == 'faqs' && $action=='admin_add'){echo 'class="current"';}?>>Add FAQ</a></li>
					</ul>
				</li>

				<li><a href="javascript://void(0);" class="nav-top-item <?php if($controller == 'categories'){echo 'current';}?>">Categories</a>
					<ul>
						<li><a href="<?php echo SITE_PATH.'admin/categories/manage/';?>" <?php if($controller == 'categories' && $action=='admin_manage'){echo 'class="current"';}?>>Manage Categories</a></li>
						<li><a href="<?php echo SITE_PATH.'admin/categories/add/';?>" <?php if($controller == 'categories' && $action=='admin_add'){echo 'class="current"';}?>>Add Category</a></li>
						<li><a href="<?php echo SITE_PATH.'admin/categories/add_sub_category/';?>" <?php if($controller == 'categories' && $action=='admin_add_sub_category'){echo 'class="current"';}?>>Add Sub-Category</a></li>
					</ul>
				</li>

				<li><a href="javascript://void(0);" class="nav-top-item <?php if($controller == 'enquiries'){echo 'current';}?>">Enquiries/ Contact Us</a>
					<ul>
						<li><a href="<?php echo SITE_PATH.'admin/enquiries/manage/';?>" <?php if($controller == 'enquiries' && $action=='admin_manage'){echo 'class="current"';}?>>Manage Enquiries</a></li>
					</ul>
				</li>

				<li><a href="javascript://void(0);" class="nav-top-item <?php if($controller == 'newsletters'){echo 'current';}?>">Newsletter</a>
					<ul>
						<li><a href="<?php echo SITE_PATH.'admin/newsletters/manage/';?>" <?php if($controller == 'newsletters' && $action=='admin_manage'){echo 'class="current"';}?>>Manage Subscribers</a></li>
						<li><a href="<?php echo SITE_PATH.'admin/newsletters/send/';?>" <?php if($controller == 'newsletters' && $action=='admin_send'){echo 'class="current"';}?>>Send Newsletter</a></li>
					</ul>
				</li>

				<li><a href="javascript://void(0);" class="nav-top-item <?php if($controller == 'users'){echo 'current';}?>">Users</a>
					<ul>
						<li><a href="<?php echo SITE_PATH.'admin/users/manage/';?>" <?php if($controller == 'users' && $action=='admin_manage'){echo 'class="current"';}?>>Manage</a></li>
					</ul>
				</li>

				<li><a href="javascript://void(0);" class="nav-top-item <?php if($controller == 'memberships'){echo 'current';}?>">Membership Plans</a>
					<ul>
						<li><a href="<?php echo SITE_PATH.'admin/memberships/manage/';?>" <?php if($controller == 'memberships' && $action=='admin_manage'){echo 'class="current"';}?>>Manage</a></li>
					</ul>
				</li>

				
			</ul>
		</div>
	</div>
</div>
