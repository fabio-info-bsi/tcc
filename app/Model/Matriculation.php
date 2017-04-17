<?php
App::uses('AppModel', 'Model');
/**
 * Matriculation Model
 *
 * @property Student $Student
 * @property Room $Room
 * @property Point $Point
 * @property Activity $Activity
 * @property Reward $Reward
 * @property Team $Team
 */
class Matriculation extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'student_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
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
		'Student' => array(
			'className' => 'Student',
			'foreignKey' => 'student_id',
			'conditions' => array('Student.removed' => 'N','Student.active' => 'S'),
			'fields' => '',
			'order' => ''
		),
		'Room' => array(
			'className' => 'Room',
			'foreignKey' => 'room_id',
			'conditions' => array('Room.removed' => 'N','Room.active' => 'S'),
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Point' => array(
			'className' => 'Point',
			'foreignKey' => 'matriculation_id',
			'dependent' => false,
			'conditions' => array('Point.removed' => 'N','Point.active' => 'S'),
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);


/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Activity' => array(
			'className' => 'Activity',
			'joinTable' => 'matriculations_activities',
			'foreignKey' => 'matriculation_id',
			'associationForeignKey' => 'activity_id',
			'unique' => 'keepExisting',
			'conditions' => array('Activity.removed' => 'N','Activity.active' => 'S'),
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		),
		'Reward' => array(
			'className' => 'Reward',
			'joinTable' => 'matriculations_rewards',
			'foreignKey' => 'matriculation_id',
			'associationForeignKey' => 'reward_id',
			'unique' => '',//'keepExisting',
			'conditions' => array(),//array('Reward.removed' => 'N','Reward.active' => 'S'),
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		),
		'Team' => array(
			'className' => 'Team',
			'joinTable' => 'matriculations_teams',
			'foreignKey' => 'matriculation_id',
			'associationForeignKey' => 'team_id',
			'unique' => 'keepExisting',
			'conditions' => array('Team.removed' => 'N','Team.active' => 'S'),
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		)
	);

}
