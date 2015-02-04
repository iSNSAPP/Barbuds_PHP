<?php $modelName = $UserPermissionModule; ?>
<table cellpadding="0" cellspacing="0" width="100%" id='example' >
		<thead>
		<tr class="thClass">
			<th width="10%">Module Name</th>
			<th width="18%">Add</th>
			<th width="18%">Edit</th>
			<th width="18%">View</th>
		</tr>
		</thead>
		<?php $i=1;foreach($permissionList as $moduleMasterList){
			if (strpos($moduleMasterList['ModuleMaster']['module_name'], '.') !== false) { 
			$moduleMasterList['ModuleMaster']['module_name'] = str_replace('.','',$moduleMasterList['ModuleMaster']['module_name']);
		}
		?>
		<tbody>
			<td><?php echo $this->Form->checkbox('UserPermissionModule.UserPermissionModule.'.$moduleMasterList['ModuleMaster']['module_name'].'.module_id', array(
										'div'=>false,
										'label'=>false,
										'class'=>'formInput',
										'maxlength'=>100,
										'error'=>false,
										'value' => $moduleMasterList['ModuleMaster']['id'],
										'default' => $moduleMasterList['ModuleMaster']['id'],
										'style'=>'width:0%;',
										'readonly' => 'readonly',
										'hiddenField' => false
									));
			echo $this->Form->label($moduleMasterList['ModuleMaster']['module_name']); ?>
			</td>
			
			<?php 
					if($actionName !='admin_add'){?>
			
				<input type="hidden" name="data[UserPermissionModule][UserPermissionModule][<?php echo $moduleMasterList['ModuleMaster']['module_name'];?>][id]" value="<?php echo $moduleMasterList[$modelName]['id'];?>"> 
			<?php 
			} ?>
			
			<td><?php echo $this->Form->checkbox('UserPermissionModule.UserPermissionModule.'.$moduleMasterList['ModuleMaster']['module_name'].'.add', array(
										'div'=>false,
										'label'=>false,
										'class'=>'formInput',
										'maxlength'=>100,
										'error'=>false,
										'style'=>'width:0%;',
										'default' => $moduleMasterList[$modelName]['add'],
										'hiddenField' => false
									)); 
		echo $this->Form->label('Add'); ?>
		</td>
		<td><?php 
		echo $this->Form->checkbox('UserPermissionModule.UserPermissionModule.'.$moduleMasterList['ModuleMaster']['module_name'].'.edit', array(
										'div'=>false,
										'label'=>false,
										'class'=>'formInput',
										'maxlength'=>100,
										'error'=>false,
										'default' => $moduleMasterList[$modelName]['edit'],
										'style'=>'width:0%;',
										'hiddenField' => false
									)); 
		echo $this->Form->label('Edit');
		?>
		<td><?php  echo $this->Form->checkbox('UserPermissionModule.UserPermissionModule.'.$moduleMasterList['ModuleMaster']['module_name'].'.view', array(
										'div'=>false,
										'label'=>false,
										'class'=>'formInput',
										'maxlength'=>100,
										'error'=>false,
										'style'=>'width:0%;',
										'default' => $moduleMasterList[$modelName]['view'],
										'hiddenField' => false
									)); 
		echo $this->Form->label('View');?>
			
		</td>
			
		</tbody>
		<?php $i++;} ?>
	</table>
