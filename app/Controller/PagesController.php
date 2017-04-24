<?php

/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {

    /**
     * This controller does not use a model
     *
     * @var array
     */
    public $uses = array();

    /**
     * Displays a view
     *
     * @return \Cake\Network\Response|null
     * @throws ForbiddenException When a directory traversal attempt.
     * @throws NotFoundException When the view file could not be found
     *   or MissingViewException in debug mode.
     */
    public function display() {
        $path = func_get_args();

        $count = count($path);
        if (!$count) {
            return $this->redirect('/');
        }
        if (in_array('..', $path, true) || in_array('.', $path, true)) {
            throw new ForbiddenException();
        }
        $page = $subpage = $title_for_layout = null;

        if (!empty($path[0])) {
            $page = $path[0];
        }
        if (!empty($path[1])) {
            $subpage = $path[1];
        }
        if (!empty($path[$count - 1])) {
            $title_for_layout = Inflector::humanize($path[$count - 1]);
        }
        $this->set(compact('page', 'subpage', 'title_for_layout'));

        try {
            $this->render(implode('/', $path));
        } catch (MissingViewException $e) {
            if (Configure::read('debug')) {
                throw $e;
            }
            throw new NotFoundException();
        }

        //debug($this->Session->read('Auth.User'));
    }

    public function student_home() {

        $this->loadModel('Activity');
        $this->Activity->unbindModel(array('belongsTo' => array('Room', 'Reward'), 'hasMany' => array('Point')));
        //Activity
        //============================================================//
        $countTotalActivities = $this->Activity->find('count', array(
            'conditions' => array(
                'Activity.type_activity' => 'A',
                'MatriculationsActivity.matriculation_id' => $this->Session->read('Auth.User.SelectMatriculation.id')
            ),
            'joins' => array(
                array(
                    'table' => 'matriculations_activities',
                    'alias' => 'MatriculationsActivity',
                    'type' => 'INNER',
                    'conditions' => 'MatriculationsActivity.activity_id = Activity.id')
            ),
                )
        );
        $countActivitiesSucess = $this->Activity->find('count', array(
            'conditions' => array(
                'Activity.type_activity' => 'A',
                'MatriculationsActivity.matriculation_id' => $this->Session->read('Auth.User.SelectMatriculation.id'),
                'MatriculationsActivity.sts_activity' => 'S'
            ),
            'joins' => array(
                array(
                    'table' => 'matriculations_activities',
                    'alias' => 'MatriculationsActivity',
                    'type' => 'INNER',
                    'conditions' => 'MatriculationsActivity.activity_id = Activity.id')
            ),
                )
        );
        if(0 != $countTotalActivities){
            $percentageActivities = ($countActivitiesSucess/$countTotalActivities)*100;
        }else{
            $percentageActivities = 0;
        }
        
        $activityDetails['Activities'] = array('CountTotal'=> $countTotalActivities, 'CountActivitySucess'=> $countActivitiesSucess, 'Percentage'=> $percentageActivities);
        
        
        //ActivityChallenge
        //============================================================//
        $countTotalActivitiesChallenge = $this->Activity->find('count', array(
            'conditions' => array(
                'Activity.type_activity' => 'C',
                'MatriculationsActivity.matriculation_id' => $this->Session->read('Auth.User.SelectMatriculation.id')
            ),
            'joins' => array(
                array(
                    'table' => 'matriculations_activities',
                    'alias' => 'MatriculationsActivity',
                    'type' => 'INNER',
                    'conditions' => 'MatriculationsActivity.activity_id = Activity.id')
            ),
                )
        );
        $countActivitiesChallengeSucess = $this->Activity->find('count', array(
            'conditions' => array(
                'Activity.type_activity' => 'C',
                'MatriculationsActivity.matriculation_id' => $this->Session->read('Auth.User.SelectMatriculation.id'),
                'MatriculationsActivity.sts_activity' => 'S'
            ),
            'joins' => array(
                array(
                    'table' => 'matriculations_activities',
                    'alias' => 'MatriculationsActivity',
                    'type' => 'INNER',
                    'conditions' => 'MatriculationsActivity.activity_id = Activity.id')
            ),
                )
        );
        if(0 != $countTotalActivitiesChallenge){
            $percentageActivitiesChallenge = ($countActivitiesChallengeSucess/$countTotalActivitiesChallenge)*100;
        }else{
            $percentageActivitiesChallenge = 0;
        }
        $activityDetails['ActivitiesChallenge'] = array('CountTotal'=> $countTotalActivitiesChallenge, 'CountActivitySucess'=> $countActivitiesChallengeSucess, 'Percentage'=> $percentageActivitiesChallenge);
        
        //Activity For Team
        //============================================================//
        $countTotalActivitiesForTeam = $this->Activity->find('count', array(
            'conditions' => array(
                'Activity.type_activity' => 'AT',
                'MatriculationsTeam.matriculation_id' => $this->Session->read('Auth.User.SelectMatriculation.id')
            ),
            'joins' => array(
                array(
                    'table' => 'activities_teams',
                    'alias' => 'ActivitiesTeam',
                    'type' => 'INNER',
                    'conditions' => 'ActivitiesTeam.activity_id = Activity.id'),
                array(
                    'table' => 'teams',
                    'alias' => 'Team',
                    'type' => 'INNER',
                    'conditions' => 'ActivitiesTeam.team_id = Team.id'),
                array(
                    'table' => 'matriculations_teams',
                    'alias' => 'MatriculationsTeam',
                    'type' => 'INNER',
                    'conditions' => 'MatriculationsTeam.team_id = Team.id')
            ),
                )
        );
        
        $countTotalActivitiesForTeamWinner = $this->Activity->find('count', array(
            'conditions' => array(
                'Activity.type_activity' => 'AT',
                'MatriculationsTeam.matriculation_id' => $this->Session->read('Auth.User.SelectMatriculation.id'),
                'ActivitiesTeam.sts_activity_team' => 'W'
            ),
            'joins' => array(
                array(
                    'table' => 'activities_teams',
                    'alias' => 'ActivitiesTeam',
                    'type' => 'INNER',
                    'conditions' => 'ActivitiesTeam.activity_id = Activity.id'),
                array(
                    'table' => 'teams',
                    'alias' => 'Team',
                    'type' => 'INNER',
                    'conditions' => 'ActivitiesTeam.team_id = Team.id'),
                array(
                    'table' => 'matriculations_teams',
                    'alias' => 'MatriculationsTeam',
                    'type' => 'INNER',
                    'conditions' => 'MatriculationsTeam.team_id = Team.id')
            ),
                )
        );
        if(0 != $countTotalActivitiesForTeam){
            $percentageActivitiesForTeam = ($countTotalActivitiesForTeamWinner/$countTotalActivitiesForTeam)*100;
        }else{
            $percentageActivitiesForTeam = 0;
        }
        $activityDetails['ActivitiesForTeam'] = array('CountTotal'=> $countTotalActivitiesForTeam, 'CountActivitySucess'=> $countTotalActivitiesForTeamWinner, 'Percentage'=> $percentageActivitiesForTeam);
        
        //Challenge For Team
        //=======================================================//
        //Activity For Team
        //============================================================//
        $countTotalChallengeForTeam = $this->Activity->find('count', array(
            'conditions' => array(
                'Activity.type_activity' => 'CT',
                'MatriculationsTeam.matriculation_id' => $this->Session->read('Auth.User.SelectMatriculation.id')
            ),
            'joins' => array(
                array(
                    'table' => 'activities_teams',
                    'alias' => 'ActivitiesTeam',
                    'type' => 'INNER',
                    'conditions' => 'ActivitiesTeam.activity_id = Activity.id'),
                array(
                    'table' => 'teams',
                    'alias' => 'Team',
                    'type' => 'INNER',
                    'conditions' => 'ActivitiesTeam.team_id = Team.id'),
                array(
                    'table' => 'matriculations_teams',
                    'alias' => 'MatriculationsTeam',
                    'type' => 'INNER',
                    'conditions' => 'MatriculationsTeam.team_id = Team.id')
            ),
                )
        );
        
        $countTotalChallengeForTeamWinner = $this->Activity->find('count', array(
            'conditions' => array(
                'Activity.type_activity' => 'CT',
                'MatriculationsTeam.matriculation_id' => $this->Session->read('Auth.User.SelectMatriculation.id'),
                'ActivitiesTeam.sts_activity_team' => 'W'
            ),
            'joins' => array(
                array(
                    'table' => 'activities_teams',
                    'alias' => 'ActivitiesTeam',
                    'type' => 'INNER',
                    'conditions' => 'ActivitiesTeam.activity_id = Activity.id'),
                array(
                    'table' => 'teams',
                    'alias' => 'Team',
                    'type' => 'INNER',
                    'conditions' => 'ActivitiesTeam.team_id = Team.id'),
                array(
                    'table' => 'matriculations_teams',
                    'alias' => 'MatriculationsTeam',
                    'type' => 'INNER',
                    'conditions' => 'MatriculationsTeam.team_id = Team.id')
            ),
                )
        );
        if(0 != $countTotalChallengeForTeam){
            $percentageChallengeForTeam = ($countTotalChallengeForTeamWinner/$countTotalChallengeForTeam)*100;
        }else{
            $percentageChallengeForTeam = 0;
        }
        $activityDetails['ChallengeForTeam'] = array('CountTotal'=> $countTotalChallengeForTeam, 'CountActivitySucess'=> $countTotalChallengeForTeamWinner, 'Percentage'=> $percentageChallengeForTeam);
        $this->set(compact('activityDetails', 'matriculations'));
    }

}
