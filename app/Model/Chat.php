<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 * @property Country $Country
 * @property State $State
 * @property Suburb $Suburb
 */
class Chat extends AppModel {
	public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'send_to'
        )
    );

}?>