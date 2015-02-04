<?php
App::uses('Component', 'Controller');
class GeneralComponent extends Component{
   public $components = array('Session');
	/************** Thses are common function to update status ******************/
	public function updateStateForAllFunction($id,$newStatus,$model,$controller_name) {
		Controller::loadModel($controller_name);
		App::import('Model', $model);
		$new_model = new $model();
		if(($id != '')&&($newStatus !='')&&($model !='')){
			$userArr = $new_model->findById($id);
			if(!empty($userArr)){
				$saveData['id'] = $id;
				$saveData['status'] = $newStatus;
					if($newStatus == '1'){
						$message = 'Activated';
					}
					else
					$message = 'Deactivated';
						if($new_model->save($saveData, false))
						return $message;
						else
						return 'not';
			}
		}else{
			return 'not';
		}	
	}
	/************** This is common function to update status ******************/
}
?>