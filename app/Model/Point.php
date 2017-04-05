<?php
App::uses('AppModel', 'Model');
/**
 * Point Model
 *
 * @property Matriculation $Matriculation
 */
class Point extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'vl_point' => array(
			'decimal' => array(
				'rule' => array('decimal'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'matriculation_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
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
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Matriculation' => array(
			'className' => 'Matriculation',
			'foreignKey' => 'matriculation_id',
			'conditions' => array('Matriculation.removed' => 'N','Matriculation.active' => 'S'),
			'fields' => '',
			'order' => ''
		)
	);
}
