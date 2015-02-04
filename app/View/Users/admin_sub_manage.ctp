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
	<div class="mainHd">Manage Sub Admin</div>

	<?php
		if(!empty($viewListing)){
	?>
	<div>
		<table cellpadding="0" cellspacing="0" width="100%" id='example'>
			<thead>
			<tr class="rpHd">
				<th width="10%">S.No.</th>
				<th width="18%">Email</th>
				<th width="18%">Username</th>				
				<th width="12%" align="center">Status</th>
				<th width="14%">Created On</th>
				<th width="12%" align="center">Options</th>
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
				<td><strong><?php echo $listing['Admin']['email'];?></strong></td>
				<td><strong><?php echo $listing['Admin']['username'];?></strong></td>
				<td align="center"><?php
					if($listing['Admin']['status'] == '1'){
						$statusImage = 'admin/success.png';
						$newStatus = '0';
						$message = 'Deactivate';
					}else{
						$statusImage = 'admin/error.png';
						$newStatus = '1';
						$message = 'Activate';
					}
					echo $this->Html->link($this->Html->image($statusImage, array('alt'=>'', 'border'=>0)), '/admin/admins/status_update/'.$listing['Admin']['id'].'/'.$newStatus.'/', array('escape'=>false, 'title'=>$message), 'Do You Really Want to '.$message.' this User?');
				?></td>
				<td><?php echo date('d M, Y', strtotime($listing['Admin']['created']));?></td>
				<td align="center"><?php
					//view
					echo $this->Html->link($this->Html->image('admin/view_icon.gif', array('alt'=>'', 'border'=>0)), '/admin/admins/view/'.$listing['Admin']['id'].'/', array('escape'=>false, 'title'=>'View', 'class'=>'fancyclass'));
					//edit
					echo $this->Html->link($this->Html->image('admin/edit_icon.gif', array('alt'=>'', 'border'=>0)), '/admin/admins/edit/'.$listing['Admin']['id'].'/', array('escape'=>false, 'title'=>'Edit', 'style'=>'margin-left:5px;'));
					//delete
					echo $this->Html->link($this->Html->image('admin/delete_icon.gif', array('alt'=>'', 'border'=>0)), '/admin/admins/delete/'.$listing['Admin']['id'].'/', array('escape'=>false, 'title'=>'Delete', 'style'=>'margin-left:5px;'), 'Do You Really Want to Delete this User?');
					//reset
					echo $this->Html->link($this->Html->image('admin/reset.png', array('alt'=>'', 'border'=>0)), '/admin/admins/reset_password/'.$listing['Admin']['id'].'/', array('escape'=>false, 'title'=>'Reset Passowrd', 'style'=>'margin-left:5px;'), 'Do You Really Want to Reset this User\'s Password?');
					
					echo $this->Html->link($this->Html->image('admin/add.png', array('alt'=>'', 'border'=>0,'width'=>'15px')), '/admin/permissions/set/'.$listing['Admin']['id'].'/', array('escape'=>false, 'title'=>'Permission', 'style'=>'margin-left:5px;'));
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
		<div style="text-align:center; color:#FF0000;">No Sub Admin Created Yet!!</div>
	<?php } ?><?php echo $this->Html->link('Add New',array('controller'=>'admins','action'=>'add'), array('div'=>false, 'label'=>false, 'class'=>'normalbtn','style'=>'padding:6px'));?>
	<?php echo $this->Html->link('Export',array('controller'=>'admins','action'=>'export_csv'), array('div'=>false, 'label'=>false, 'class'=>'normalbtn','style'=>'padding:6px'));?>
	<div class="clr"></div>
</div>