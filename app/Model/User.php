<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 * @property Country $Country
 * @property State $State
 * @property Suburb $Suburb
 */
class User extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';
	//var $actsAs = array('Multivalidatable'); 

/**
 * Validation rules
 *
 * @var array
 */
 
	public $validate = array(
		'first_name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please Provide First Name!!',
				
			),
		),
		'last_name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please Provide Last Name!!',
			),
		),
		'email' => array(
			'isUnique' => array(
				'rule' => array('isUnique', 'email'),
				'message' => 'Email already registred!!'
			),
			'email' => array(
				'rule' => array('email'),
				'message' => 'Please Provide Valid Email!!',
			),
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please Provide Email!!',
			),
		),
		'password' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please Provide Password!!',
			),
			/*'between'=>array(
				'rule' => array('between',5, 15),
				'message' => 'Password more then 5 and less then 15!!',
			),*/
			'alpha' => array(
				'rule' => 'alphaNumeric',
				'message' => 'Password must be alphaNumeric!!',
				)
		),
		'phone_code' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please Provide Phone Code!!',
			),
		),
		'latitude' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please Provide Latitude!!',
			),
		),
		'device_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please Provide Device Id!!',
			),
		),
		'relationship' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please Provide Relationship!!',
			),
		),
		'longitude' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please Provide Longitude!!',
			),
		),
		'phone_number' => array(
					array(
						'rule' => 'numeric',	
							'message' => 'Phone number must be Numberic.'
					),
					array('rule' => array('maxLength', 10),
						'message' => 'Phone number must be at least 10 digit.'
					),
					array('rule' => array('minLength', 10),
						'message' => 'Phone number must be at least 10 digit.'
					),
					array('rule'    => 'isUnique',
						'message' => 'This Phone number has already been taken.'
					)
				),
		'city' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please Provide City!!',
			),
		),
		'state' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please Provide State!!',
			),
		),
		'country' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please Provide Country!!',
			),
		),
		'gender' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please Provide Gender!!',
			),
		)
		
	);

	
	public $validationSets  = array(
	'change_password'=>array(
		'old_password' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please Provide Password!!',
			)
		),
		'new_password' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please Provide Password!!',
			),
			'between'=>array(
				'rule' => array('between',8, 15),
				'message' => 'Password more then 8 and less then 15!!',
			),
			'alpha' => array(
				'rule' => 'alphaNumeric',
				'message' => 'Password must be alphaNumeric!!',
				)
		),
		'confirm_new_password' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please Provide Confirm Password!!',
			),
			'identicalFieldValues' => array(
				'rule' => array('identicalFieldValues', 'new_password' ),
				'message' => 'Both new passowrd and confirm password to be same!!'
                ) 
		)
	),'forget_password'=>array(
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				'message' => 'Please Provide Valid Email!!',
			),
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please Provide Email!!',
			),
		),
		)
	);
	
	function identicalFieldValues($data, $compareField) {
    // $data array is passed using the form field name as the key
    // so let's just get the field name to compare
    $value = array_values($data);
    $comparewithvalue = $value[0];
    return ($this->data[$this->name][$compareField] == $comparewithvalue);
}
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array */
	
	
	/*public $hasOne = array(
		'UserProfile' => array(
			'className' => 'UserProfile',
			'foreignKey' => 'user_id',
			'dependent' => true
		),
	);
	*/

}?>