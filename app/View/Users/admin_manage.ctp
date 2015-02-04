<!-- for fancybox Start -->
<?php
	echo $this->Html->Css('fancyboxcss/jquery.fancybox-1.3.4');
	echo $this->Html->Script('fancyboxjs/jquery.fancybox-1.3.4.pack.js');
	echo $this->Html->script('admin/jquery.dataTables');
?>
<script type="text/javascript">
	$(document).ready(function(){
		$("a.fancyclass").fancybox();
		$('#example').dataTable( {
					"aaSorting": [[ 0,"asc" ]],
					"iDisplayLength": 10,
					"bLengthChange": false
				} );
	});
 </script>
<!-- for fancybox End -->

<div class="rightMid">
	<!-- DISPLAY MESSAGE START -->
	<?php echo $this->Session->flash();?>
	<!-- DISPLAY MESSAGE END -->
	<div class="mainHd">Manage Users</div>

	<?php
		if(!empty($viewListing)){
	?>
	<div>
		<table cellpadding="0" cellspacing="0" width="100%" id='example'>
			<thead>
			<tr class="rpHd">
				<th width="5%">S.No.</th>
				<th width="10%">Name</th>
				<th width="10%">Email</th>
				<th width="5%">Gender</th>	
				<th width="10%">Date of Birth</th>
				<th width="5%" align="center">Status</th>
				<th width="10%">Registered On</th>
				<th width="10%" align="center">Options</th>
			</tr>
			</thead><tbody>
			<?php
				$counter = 0;
				$i=1;
				foreach($viewListing as $listing){ //pr($listing);die;
					if($counter%2 == 0)
						$tableClass = 'rpFirstRow';
					else
						$tableClass = 'rpSecRow';
			?>
			<tr class="<?php echo $tableClass;?>">
				<td><?php echo $i; ?></td>
				<td><strong><?php echo $listing['User']['name'] ?></td>
				<td><?php echo $listing['User']['email'];?></td>
				<td><?php echo $listing['User']['gender'];?></td>
				<td><?php if(empty($listing['User']['dob'])) echo 'N/A';else echo $listing['User']['dob'];?></td>
				<td align="center"><?php
					if($listing['User']['status'] == '1'){
						$statusImage = 'admin/success.png';
						$newStatus = '2';
						$message = 'Deactivate';
					}else{
						$statusImage = 'admin/error.png';
						$newStatus = '1';
						$message = 'Activate';
					}
					echo $this->Html->link($this->Html->image($statusImage, array('alt'=>'', 'border'=>0)), '/admin/users/status_update/'.$listing['User']['id'].'/'.$newStatus.'/User/users/', array('escape'=>false, 'title'=>$message), 'Do You Really Want to '.$message.' this User?');
				?></td>
				<td><?php echo date('d M, Y', strtotime($listing['User']['created']));?></td>
				<td align="center"><?php
					//View images
					echo $this->Html->link($this->Html->image('admin/gallery.jpg', array('alt'=>'', 'border'=>0)), '/admin/users/view_images/'.$listing['User']['id'].'/', array('escape'=>false, 'title'=>'View Image', 'class'=>'fancyclass'));
					//Event Pics
					echo $this->Html->link($this->Html->image('admin/gallery.jpg', array('alt'=>'', 'border'=>0)), '/admin/users/view_event_images/'.$listing['User']['id'].'/', array('escape'=>false, 'title'=>'View Images', 'class'=>'fancyclass'));
					//Event Listing
					echo $this->Html->link($this->Html->image('admin/event.jpg', array('alt'=>'', 'border'=>0)), '/admin/users/events/'.$listing['User']['id'].'/', array('escape'=>false, 'title'=>'Event Listing', 'style'=>'margin-left:5px;'));
					//view
					echo $this->Html->link($this->Html->image('admin/view_icon.gif', array('alt'=>'', 'border'=>0)), '/admin/users/view/'.$listing['User']['id'].'/', array('escape'=>false, 'title'=>'View', 'class'=>'fancyclass'));
					//edit
					echo $this->Html->link($this->Html->image('admin/edit_icon.gif', array('alt'=>'', 'border'=>0)), '/admin/users/edit/'.$listing['User']['id'].'/', array('escape'=>false, 'title'=>'Edit', 'style'=>'margin-left:5px;'));
					//delete
					echo $this->Html->link($this->Html->image('admin/delete_icon.gif', array('alt'=>'', 'border'=>0)), '/admin/users/delete/'.$listing['User']['id'].'/User/users/', array('escape'=>false, 'title'=>'Delete', 'style'=>'margin-left:5px;'), 'Do You Really Want to Delete this User?');
					//reset
					//echo $this->Html->link($this->Html->image('admin/reset.png', array('alt'=>'', 'border'=>0)), '/admin/users/reset_password/'.$listing['User']['id'].'/', array('escape'=>false, 'title'=>'Reset Passowrd', 'style'=>'margin-left:5px;'), 'Do You Really Want to Reset this User\'s Password?');
					//login info
					//echo $this->Html->link($this->Html->image('admin/login_info.png', array('alt'=>'', 'border'=>0)), '/admin/users/send_info/'.$listing['User']['id'].'/', array('escape'=>false, 'title'=>'Send Info', 'style'=>'margin-left:5px;'), 'Do You Really Want to Send login infor to user?');
					//login to front end
					//echo $this->Html->link($this->Html->image('admin/front_view.png', array('alt'=>'', 'border'=>0)), '/users/login_front/'.$listing['User']['id'].'/', array('escape'=>false, 'title'=>'Login To User Account', 'style'=>'margin-left:5px;','target'=>'_blank'));
				?></td>
			</tr>
			<?php
					$counter++;
					$i++;
				}
			?>
			</tbody></table>
	</div>
	<?php 
		echo $this->Element('admin/pagination');
	      }else{ ?>
		<div style="text-align:center; color:#FF0000;">No Users Addes Yet!!</div>
	<?php } ?><?php //echo $this->Html->link('Export',array('controller'=>'users','action'=>'export_csv'), array('div'=>false, 'label'=>false, 'class'=>'normalbtn','style'=>'padding:6px'));?>
	<div class="clr"></div>
</div>