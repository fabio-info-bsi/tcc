<?php

App::uses('AppModel', 'Model');

/**
 * Room Model
 *
 * @property Subject $Subject
 * @property Teacher $Teacher
 * @property Activity $Activity
 * @property Matriculation $Matriculation
 * @property Reward $Reward
 */
class Room extends AppModel {

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'subject_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'teacher_id' => array(
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
        'Subject' => array(
            'className' => 'Subject',
            'foreignKey' => 'subject_id',
            'conditions' => array('Subject.removed' => 'N', 'Subject.active' => 'S'),
            'fields' => '',
            'order' => ''
        ),
        'Teacher' => array(
            'className' => 'Teacher',
            'foreignKey' => 'teacher_id',
            'conditions' => array('Teacher.removed' => 'N', 'Teacher.active' => 'S'),
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
        'Activity' => array(
            'className' => 'Activity',
            'foreignKey' => 'room_id',
            'dependent' => false,
            'conditions' => array('Activity.removed' => 'N', 'Activity.active' => 'S'),
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'Team' => array(
            'className' => 'Team',
            'foreignKey' => 'room_id',
            'dependent' => false,
            'conditions' => array('Team.removed' => 'N', 'Team.active' => 'S'),
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'Matriculation' => array(
            'className' => 'Matriculation',
            'foreignKey' => 'room_id',
            'dependent' => false,
            'conditions' => array('Matriculation.removed' => 'N', 'Matriculation.active' => 'S'),
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'Reward' => array(
            'className' => 'Reward',
            'foreignKey' => 'room_id',
            'dependent' => false,
            'conditions' => array('Reward.removed' => 'N', 'Reward.active' => 'S'),
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
