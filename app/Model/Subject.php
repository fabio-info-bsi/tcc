<?php
App::uses('AppModel', 'Model');
/**
 * Subject Model
 *
 * @property Room $Room
 */
class Subject extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'nm_subject' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Room' => array(
			'className' => 'Room',
			'foreignKey' => 'subject_id',
			'dependent' => false,
			'conditions' => array('Room.removed' => 'N','Room.active' => 'S'),
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
