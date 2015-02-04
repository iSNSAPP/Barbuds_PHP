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
	<div class="mainHd">Event Management</div>
	<?php
		if(!empty($viewListing)){
	?>
	<div>
		<table cellpadding="0" cellspacing="0" width="100%" id='example'>
			<thead>
			<tr class="rpHd">
				<th width="5%">S.No.</th>
				<th width="10%">Event Name</th>
				<th width="10%">Event Location :</th>
				<th width="5%">Event Address :</th>	
				<th width="10%">Event Date :</th>
				<th width="10%">Event Time :</th>
				<th width="10%">Event Details :</th>
				<th width="5%" align="center">Status</th>
				<th width="10%">Registered On</th>
				<th width="10%" align="center">Options</th>
			</tr>
			</thead><tbody>
			<?php
				$counter = 0;
				$i=1;
				foreach($viewListing as $listing){ 
					if($counter%2 == 0)
						$tableClass = 'rpFirstRow';
					else
						$tableClass = 'rpSecRow';
			?>
			<tr class="<?php echo $tableClass;?>">
				<td><?php echo $i; ?></td>
				<td><strong><?php echo $listing['Event']['name'] ?></td>
				<td><?php echo $listing['Event']['location'];?></td>
				<td><?php echo $listing['Event']['address'];?></td>
				<td><?php if(empty($listing['Event']['date'])) echo 'N/A';else echo $listing['Event']['date'];?></td>
				<td><?php echo $listing['Event']['time'];?></td>
				<td><?php echo $listing['Event']['event_details'];?></td>
				<td align="center"><?php
					if($listing['Event']['status'] == '1'){
						$statusImage = 'admin/success.png';
						$newStatus = '2';
						$message = 'Deactivate';
					}else{
						$statusImage = 'admin/error.png';
						$newStatus = '1';
						$message = 'Activate';
					}
					echo $this->Html->link($this->Html->image($statusImage, array('alt'=>'', 'border'=>0)), '/admin/users/status_update/'.$listing['Event']['id'].'/'.$newStatus.'/Event/events/', array('escape'=>false, 'title'=>$message), 'Do You Really Want to '.$message.' this Event?');
				?></td>
				<td><?php echo date('d M, Y', strtotime($listing['Event']['created']));?></td>
				<td align="center"><?php
					//view
					echo $this->Html->link($this->Html->image('admin/view_icon.gif', array('alt'=>'', 'border'=>0)), '/admin/users/view_event/'.$listing['Event']['id'].'/', array('escape'=>false, 'title'=>'View', 'class'=>'fancyclass'));
					//Delete
					echo $this->Html->link($this->Html->image('admin/delete_icon.gif', array('alt'=>'', 'border'=>0)), '/admin/users/delete/'.$listing['Event']['id'].'/Event/events/', array('escape'=>false, 'title'=>'Delete', 'style'=>'margin-left:5px;'), 'Do You Really Want to Delete this Event?');
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
		<div style="text-align:center; color:#FF0000;">No Event Addes Yet!!</div>
	<?php } ?><?php //echo $this->Html->link('Export',array('controller'=>'users','action'=>'export_csv'), array('div'=>false, 'label'=>false, 'class'=>'normalbtn','style'=>'padding:6px'));?>
	<div class="clr"></div>
</div>