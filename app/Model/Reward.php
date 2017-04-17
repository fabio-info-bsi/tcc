<?php

App::uses('AppModel', 'Model');

/**
 * Reward Model
 *
 * @property Room $Room
 * @property Activity $Activity
 * @property Matriculation $Matriculation
 */
class Reward extends AppModel {

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'ds_brinde' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'vl_pontos_brinde' => array(
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
            'conditions' => array('Room.removed' => 'N', 'Room.active' => 'S'),
            'fields' => '',
            'order' => ''
        )
    );
    
    
    public $hasMany = array(
		'Activity' => array(
			'className' => 'Activity',
			'foreignKey' => 'reward_id',
			'dependent' => false,
			'conditions' => array('Activity.removed' => 'N','Activity.active' => 'S'),
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
        'Matriculation' => array(
            'className' => 'Matriculation',
            'joinTable' => 'matriculations_rewards',
            'foreignKey' => 'reward_id',
            'associationForeignKey' => 'matriculation_id',
            'unique' => 'keepExisting',
            'conditions' => array(),//array('Matriculation.removed' => 'N', 'Matriculation.active' => 'S'),
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'finderQuery' => '',
        )
    );

}
