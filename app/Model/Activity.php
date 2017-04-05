<?php
App::uses('AppModel', 'Model');
/**
 * Activity Model
 *
 * @property Room $Room
 * @property Team $Team
 * @property Matriculation $Matriculation
 */
class Activity extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'ds_activity' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'vl_activity' => array(
			'decimal' => array(
				'rule' => array('decimal'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'room_id' => array(
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
		'Room' => array(
			'className' => 'Room',
			'foreignKey' => 'room_id',
			'conditions' => array('Room.removed' => 'N','Room.active' => 'S'),
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Team' => array(
			'className' => 'Team',
			'joinTable' => 'activities_teams',
			'foreignKey' => 'activity_id',
			'associationForeignKey' => 'team_id',
			'unique' => 'keepExisting',
			'conditions' => array('Team.removed' => 'N','Team.active' => 'S'),
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		),
		'Matriculation' => array(
			'className' => 'Matriculation',
			'joinTable' => 'matriculations_activities',
			'foreignKey' => 'activity_id',
			'associationForeignKey' => 'matriculation_id',
			'unique' => 'keepExisting',
			'conditions' => array(),//'Matriculation.removed' => 'N','Matriculation.active' => 'S'
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		)
	);

}
