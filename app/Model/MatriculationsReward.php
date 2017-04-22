<?php
App::uses('AppModel', 'Model');
/**
 * MatriculationsReward Model
 *
 * @property Matriculation $Matriculation
 * @property Reward $Reward
 * @property Activity $Activity
 */
class MatriculationsReward extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'active' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'removed' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
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
		'reward_id' => array(
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
		),
		'Reward' => array(
			'className' => 'Reward',
			'foreignKey' => 'reward_id',
			'conditions' => array('Reward.removed' => 'N','Reward.active' => 'S'),
			'fields' => '',
			'order' => ''
		),
		'Activity' => array(
			'className' => 'Activity',
			'foreignKey' => 'activity_id',
			'conditions' => array('Activity.removed' => 'N','Activity.active' => 'S'),
			'fields' => '',
			'order' => ''
		)
	);
}
