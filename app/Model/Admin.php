<?php
App::uses('AppModel', 'Model');
/**
 * Admin Model
 *
 */
class Admin extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';
	
	

	/*  public $belongsTo = array(
        'Group' => array(
            'className' => 'Group',
            'foreignKey' => 'group_id',
            'conditions' => '', 
            'fields' => '', 
            'order' => ''
            )   
        );  */
	
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'password' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please Provide Password!!',
			),
			'between'=>array(
				'rule' => array('between',5, 15),
				'message' => 'Password more then 5 and less then 15!!',
			),
			'alpha' => array(
				'rule' => 'alphaNumeric',
				'message' => 'Password must be alphaNumeric!!',
				)
		),
		'email' => array(
			'isUnique' => array(
				'rule' => array('isUnique', 'email'),
				'message' => 'Please Use Another Email!!'
			),
			'email' => array(
				'rule' => array('email'),
				'message' => 'Please Provide Valid Email!!',
				'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please Provide Email!!',
				'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		)
	);
}?>