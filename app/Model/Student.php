<?php

App::uses('AppModel', 'Model');

/**
 * Student Model
 *
 * @property Matriculation $Matriculation
 */
class Student extends AppModel {

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'nm_student' => array(
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


    public $hasOne = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'id',
            'conditions' => '',
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
        'Matriculation' => array(
            'className' => 'Matriculation',
            'foreignKey' => 'student_id',
            'dependent' => false,
            'conditions' => array('Matriculation.removed' => 'N', 'Matriculation.active' => 'S'),
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
