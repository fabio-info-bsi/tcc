<?php
App::uses('AppModel', 'Model');
/**
 * Team Model
 *
 * @property Activity $Activity
 * @property Matriculation $Matriculation
 */
class Team extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'nm_team' => array(
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
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Activity' => array(
			'className' => 'Activity',
			'joinTable' => 'activities_teams',
			'foreignKey' => 'team_id',
			'associationForeignKey' => 'activity_id',
			'unique' => 'keepExisting',
			'conditions' => array('Activity.removed' => 'N','Activity.active' => 'S'),
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		),
		'Matriculation' => array(
			'className' => 'Matriculation',
			'joinTable' => 'matriculations_teams',
			'foreignKey' => 'team_id',
			'associationForeignKey' => 'matriculation_id',
			'unique' => 'keepExisting',
			'conditions' => array('Matriculation.removed' => 'N','Matriculation.active' => 'S'),
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		)
	);

}
