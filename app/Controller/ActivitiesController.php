<?php

App::uses('AppController', 'Controller');

/**
 * Activities Controller
 *
 * @property Activity $Activity
 * @property PaginatorComponent $Paginator
 */
class ActivitiesController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');

    /**
     * index method
     * Powered by Frame2Days
     * @return void
     */
    public function index() {
        $conditions = array();

        if (($this->request->is('post') || $this->request->is('put')) && isset($this->data['Filter'])) {
            $filter_url['controller'] = $this->request->params['controller'];
            $filter_url['action'] = $this->request->params['action'];
            $filter_url['page'] = 1;

            foreach ($this->data['Filter'] as $name => $value) {
                if ($value) {
                    $filter_url[$name] = urlencode(urlencode($value));
                }
            }
            return $this->redirect($filter_url);
        } else {
            foreach ($this->params['named'] as $param_name => $value) {

                if (!in_array($param_name, array('page', 'sort', 'direction', 'limit'))) {
                    $conditions['Activity.' . $param_name . ' LIKE'] = '%' . urldecode(urldecode($value)) . '%';
                }
            }
        }

        $this->Activity->recursive = 0;
        $this->paginate = array(
            'limit' => 10,
            'conditions' => $conditions
        );
        $options = array('Activity.removed' => 'N');
        $this->set('activities', $this->Paginator->paginate($options));

        $rooms = $this->Activity->Room->find('list', array('conditions' => array('Room.removed' => 'N', 'Room.active' => 'S'), 'order' => 'Room.id'));
        //$teams = $this->Activity->Team->find('list', array('conditions' => array('Team.removed' => 'N', 'Team.active' => 'S'), 'order' => 'Team.name'));
        $matriculations = $this->Activity->Matriculation->find('list', array('conditions' => array('Matriculation.removed' => 'N', 'Matriculation.active' => 'S'), 'order' => 'Matriculation.name'));
        $this->set(compact('rooms', 'teams', 'matriculations'));
    }

    public function teacher_index() {
        $conditions = array();

        if (($this->request->is('post') || $this->request->is('put')) && isset($this->data['Filter'])) {
            $filter_url['controller'] = $this->request->params['controller'];
            $filter_url['action'] = $this->request->params['action'];
            $filter_url['page'] = 1;

            foreach ($this->data['Filter'] as $name => $value) {
                if ($value) {
                    $filter_url[$name] = urlencode(urlencode($value));
                }
            }
            return $this->redirect($filter_url);
        } else {
            foreach ($this->params['named'] as $param_name => $value) {

                if (!in_array($param_name, array('page', 'sort', 'direction', 'limit'))) {
                    $conditions['Activity.' . $param_name . ' LIKE'] = '%' . urldecode(urldecode($value)) . '%';
                }
            }
        }

        $this->Activity->recursive = 0;
        $this->paginate = array(
            'limit' => 10,
            'conditions' => $conditions
        );
        $options = array('Activity.removed' => 'N', "Activity.room_id" => $this->Session->read('Auth.User.SelectRoom.id'));
        $this->set('activities', $this->Paginator->paginate($options));


        $teams = $this->Activity->Team->find('list', array('conditions' => array('Team.removed' => 'N', 'Team.active' => 'S'), 'order' => 'Team.id'));
        $matriculations = $this->Activity->Matriculation->find('list', array('conditions' => array('Matriculation.removed' => 'N', 'Matriculation.active' => 'S'), 'order' => 'Matriculation.id'));
        $this->set(compact('teams', 'matriculations'));
    }

    /**
     * view method
     * Powered by Frame2Days
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Activity->exists($id)) {
            throw new NotFoundException(__('Invalid activity'));
        }
        $options = array('conditions' => array('Activity.' . $this->Activity->primaryKey => $id));
        $this->set('activity', $this->Activity->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Activity->create();
            if ($this->Activity->save($this->request->data)) {
                $this->Session->setFlash('<br><div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                        . __('activity') . ' ' . __('has been saved.') .
                        '</div>');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('<br><div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                        . __('activity') . ' ' . __('could not be saved. Please, try again.') .
                        '</div>');
            }
        }
        $rooms = $this->Activity->Room->find('list', array('conditions' => array('Room.removed' => 'N', 'Room.active' => 'S'), 'order' => 'Room.id'));
        $reward = $this->Activity->Reward->find('list', array('conditions' => array('Reward.removed' => 'N', 'Reward.active' => 'S'), 'order' => 'Reward.created'));
        $matriculations = $this->Activity->Matriculation->find('list', array('conditions' => array('Matriculation.removed' => 'N', 'Matriculation.active' => 'S'),
            'joins' => array(
                array(
                    'table' => 'students',
                    'alias' => 'Student',
                    'type' => 'INNER',
                    'conditions' => 'Matriculation.student_id = Student.id')
            ),
            'fields' => array(
                'Matriculation.id',
                'Student.nm_student',
            ),
            'order' => 'Matriculation.student_id'));
        $this->set(compact('rooms', 'reward', 'matriculations'));
    }

    public function teacher_add() {
        if ($this->request->is('post')) {
            $this->request->data['Activity']['room_id'] = $this->Session->read('Auth.User.SelectRoom.id');
            $this->Activity->create();
            if ($this->Activity->save($this->request->data)) {
                $this->Session->setFlash('<br><div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                        . __('activity') . ' ' . __('has been saved.') .
                        '</div>');
                return $this->redirect(array('action' => 'teacher_index'));
            } else {
                $this->Session->setFlash('<br><div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                        . __('activity') . ' ' . __('could not be saved. Please, try again.') .
                        '</div>');
            }
        }
        $rewards = $this->Activity->Reward->find('list', array(
            'conditions' => array(
                'Reward.removed' => 'N',
                'Reward.active' => 'S',
                'Reward.room_id' => $this->Session->read('Auth.User.SelectRoom.id')
            ),
            'fields' => array(
                'Reward.id',
                'Reward.nm_brinde',
            ),
            'order' => 'Reward.created'));
        $matriculations = $this->Activity->Matriculation->find('list', array(
            'conditions' => array('Matriculation.removed' => 'N',
                'Matriculation.active' => 'S',
                'Matriculation.room_id' => $this->Session->read('Auth.User.SelectRoom.id')),
            'joins' => array(
                array(
                    'table' => 'students',
                    'alias' => 'Student',
                    'type' => 'INNER',
                    'conditions' => 'Matriculation.student_id = Student.id')
            ),
            'fields' => array(
                'Matriculation.id',
                'Student.nm_student',
            ),
            'order' => 'Matriculation.student_id'));
        $this->set(compact('rooms', 'teams', 'rewards', 'matriculations'));
    }

    public function teacher_add_challenge() {
        if ($this->request->is('post')) {
            $this->request->data['Activity']['room_id'] = $this->Session->read('Auth.User.SelectRoom.id');
            $this->request->data['Activity']['type_activity'] = 'C';
            $this->Activity->create();
            if ($this->Activity->save($this->request->data)) {
                $this->Session->setFlash('<br><div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                        . __('activity') . ' ' . __('has been saved.') .
                        '</div>');
                return $this->redirect(array('action' => 'teacher_index'));
            } else {
                $this->Session->setFlash('<br><div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                        . __('activity') . ' ' . __('could not be saved. Please, try again.') .
                        '</div>');
            }
        }
        $rewards = $this->Activity->Reward->find('list', array(
            'conditions' => array(
                'Reward.removed' => 'N',
                'Reward.active' => 'S',
                'Reward.room_id' => $this->Session->read('Auth.User.SelectRoom.id')
            ),
            'fields' => array(
                'Reward.id',
                'Reward.nm_brinde',
            ),
            'order' => 'Reward.created'));
        $matriculations = $this->Activity->Matriculation->find('list', array(
            'conditions' => array('Matriculation.removed' => 'N',
                'Matriculation.active' => 'S',
                'Matriculation.room_id' => $this->Session->read('Auth.User.SelectRoom.id')),
            'joins' => array(
                array(
                    'table' => 'students',
                    'alias' => 'Student',
                    'type' => 'INNER',
                    'conditions' => 'Matriculation.student_id = Student.id')
            ),
            'fields' => array(
                'Matriculation.id',
                'Student.nm_student',
            ),
            'order' => 'Matriculation.student_id'));
        $this->set(compact('rooms', 'teams', 'rewards', 'matriculations'));
    }

    public function teacher_add_challenge_team() {
        if ($this->request->is('post')) {
            $this->request->data['Activity']['room_id'] = $this->Session->read('Auth.User.SelectRoom.id');
            $this->request->data['Activity']['type_activity'] = 'CT';
            $this->Activity->create();
            if ($this->Activity->save($this->request->data)) {
                $this->Session->setFlash('<br><div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                        . __('activity') . ' ' . __('has been saved.') .
                        '</div>');
                return $this->redirect(array('action' => 'teacher_index'));
            } else {
                $this->Session->setFlash('<br><div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                        . __('activity') . ' ' . __('could not be saved. Please, try again.') .
                        '</div>');
            }
        }
        $teams = $this->Activity->Team->find('list', array(
            'conditions' => array(
                'Team.removed' => 'N',
                'Team.active' => 'S',
                'Team.room_id' => $this->Session->read('Auth.User.SelectRoom.id')
            ),
            'order' => 'Team.created',
            'fields' => array(
                'Team.id',
                'Team.nm_team',
            ),
                )
        );
        $rewards = $this->Activity->Reward->find('list', array(
            'conditions' => array(
                'Reward.removed' => 'N',
                'Reward.active' => 'S',
                'Reward.room_id' => $this->Session->read('Auth.User.SelectRoom.id')
            ),
            'fields' => array(
                'Reward.id',
                'Reward.nm_brinde',
            ),
            'order' => 'Reward.created'));
        $matriculations = $this->Activity->Matriculation->find('list', array(
            'conditions' => array('Matriculation.removed' => 'N',
                'Matriculation.active' => 'S',
                'Matriculation.room_id' => $this->Session->read('Auth.User.SelectRoom.id')),
            'joins' => array(
                array(
                    'table' => 'students',
                    'alias' => 'Student',
                    'type' => 'INNER',
                    'conditions' => 'Matriculation.student_id = Student.id')
            ),
            'fields' => array(
                'Matriculation.id',
                'Student.nm_student',
            ),
            'order' => 'Matriculation.student_id'));
        $this->set(compact('rooms', 'teams', 'rewards', 'matriculations'));
    }

    /**
     * edit method
     * Powered by Frame2Days
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Activity->exists($id)) {
            throw new NotFoundException(__('Invalid activity'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Activity->save($this->request->data)) {
                $this->Session->setFlash('<br><div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                        . __('activity') . ' ' . __('has been saved.') .
                        '</div>');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('<br><div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                        . __('activity') . ' ' . __('could not be saved. Please, try again.') .
                        '</div>');
            }
        } else {
            $options = array('conditions' => array('Activity.' . $this->Activity->primaryKey => $id));
            $this->request->data = $this->Activity->find('first', $options);
        }
        $rooms = $this->Activity->Room->find('list', array('conditions' => array('Room.removed' => 'N', 'Room.active' => 'S'), 'order' => 'Room.id'));
        $teams = $this->Activity->Team->find('list', array('conditions' => array('Team.removed' => 'N', 'Team.active' => 'S'), 'order' => 'Team.id'));
        $matriculations = $this->Activity->Matriculation->find('list', array('conditions' => array('Matriculation.removed' => 'N', 'Matriculation.active' => 'S'), 'order' => 'Matriculation.id'));
        $this->set(compact('rooms', 'teams', 'matriculations'));
    }

    public function teacher_edit($id = null) {
        if (!$this->Activity->exists($id)) {
            throw new NotFoundException(__('Invalid activity'));
        }
        if ($this->request->is(array('post', 'put'))) {
            $this->request->data['Activity']['room_id'] = $this->Session->read('Auth.User.SelectRoom.id');
            if ($this->Activity->save($this->request->data)) {
                $this->Session->setFlash('<br><div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                        . __('activity') . ' ' . __('has been saved.') .
                        '</div>');
                return $this->redirect(array('action' => 'teacher_index'));
            } else {
                $this->Session->setFlash('<br><div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                        . __('activity') . ' ' . __('could not be saved. Please, try again.') .
                        '</div>');
            }
        } else {
            $options = array('conditions' => array('Activity.' . $this->Activity->primaryKey => $id));
            $this->request->data = $this->Activity->find('first', $options);
        }
        $rewards = $this->Activity->Reward->find('list', array(
            'conditions' => array(
                'Reward.removed' => 'N',
                'Reward.active' => 'S',
                'Reward.room_id' => $this->Session->read('Auth.User.SelectRoom.id')
            ),
            'fields' => array(
                'Reward.id',
                'Reward.nm_brinde',
            ),
            'order' => 'Reward.created'));
        $matriculations = $this->Activity->Matriculation->find('list', array(
            'conditions' => array('Matriculation.removed' => 'N',
                'Matriculation.active' => 'S',
                'Matriculation.room_id' => $this->Session->read('Auth.User.SelectRoom.id')),
            'joins' => array(
                array(
                    'table' => 'students',
                    'alias' => 'Student',
                    'type' => 'INNER',
                    'conditions' => 'Matriculation.student_id = Student.id')
            ),
            'fields' => array(
                'Matriculation.id',
                'Student.nm_student',
            ),
            'order' => 'Matriculation.student_id'));
        $this->set(compact('rooms', 'teams', 'rewards', 'matriculations'));
    }

    public function teacher_evaluation($id = null) {
        if (!$this->Activity->exists($id)) {
            throw new NotFoundException(__('Invalid activity'));
        }
        if ($this->request->is(array('post', 'put'))) {
            //Verifica se exstem pontos computados por essa atividade
            $idPoints = $this->Activity->Point->find('list', array('conditions' => array('activity_id'=> $id), 'fields' => array('Point.id')));
            
            //if()
            
            //Set Points
            for ($index = 0; $index < count($this->request->data['Matriculation']); $index++) {
                $idMatriculatioActivity = $this->request->data['Matriculation'][$index]['MatriculationsActivity']['matriculation_id'];
                $idActivity = $this->request->data['Activity']['id'];
                $pontForMatriculation = array('id'=> array_shift($idPoints),'vl_point' =>5.1, 'matriculation_id' => $idMatriculatioActivity, 'activity_id' => $idActivity);
                
                $this->request->data['Point'][$index] = $pontForMatriculation;
                $pontForMatriculation = null;
            }
            $this->request->data['Activity']['room_id'] = $this->Session->read('Auth.User.SelectRoom.id');
            debug($this->request->data)or die;
            if ($this->Activity->saveAll($this->request->data)) {
                $this->Session->setFlash('<br><div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                        . __('activity') . ' ' . __('has been saved.') .
                        '</div>');
                return $this->redirect(array('action' => 'teacher_index'));
            } else {
                $this->Session->setFlash('<br><div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                        . __('activity') . ' ' . __('could not be saved. Please, try again.') .
                        '</div>');
            }
        } else {
            $options = array('conditions' => array('Activity.' . $this->Activity->primaryKey => $id));
            $this->Activity->recursive = 2;
            $this->Activity->unbindModel(array('belongsTo' => array('Room')));
            $this->request->data = $this->Activity->find('first', array('conditions' => array('Activity.id' => $id)));
            //debug($this->request->data)or die;
        }
        $rewards = $this->Activity->Reward->find('list', array(
            'conditions' => array(
                'Reward.removed' => 'N',
                'Reward.active' => 'S',
                'Reward.room_id' => $this->Session->read('Auth.User.SelectRoom.id')
            ),
            'fields' => array(
                'Reward.id',
                'Reward.nm_brinde',
            ),
            'order' => 'Reward.created')
        );
        $matriculations = $this->Activity->Matriculation->find('list', array(
            'conditions' => array('Matriculation.removed' => 'N',
                'Matriculation.active' => 'S',
                'Matriculation.room_id' => $this->Session->read('Auth.User.SelectRoom.id')),
            'joins' => array(
                array(
                    'table' => 'students',
                    'alias' => 'Student',
                    'type' => 'INNER',
                    'conditions' => 'Matriculation.student_id = Student.id')
            ),
            'fields' => array(
                'Matriculation.id',
                'Student.nm_student',
            ),
            'order' => 'Matriculation.student_id'));
        $this->set(compact('rooms', 'teams', 'rewards', 'matriculations'));
    }

    /**
     * delete method
     * Powered by Frame2Days
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Activity->id = $id;
        if (!$this->Activity->exists()) {
            throw new NotFoundException(__('Invalid activity'));
        }
        $data = array('id' => $id, 'removed' => 'S');
        $this->request->allowMethod('post', 'delete');
        if ($this->Activity->save($data)) {
            $this->Session->setFlash('<br><div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                    . __('activity') . ' ' . __('has been deleted.') .
                    '</div>');
        } else {
            $this->Session->setFlash('<br><div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                    . __('activity') . ' ' . __('could not be deleted. Please, try again.') .
                    '</div>');
        }
        return $this->redirect(array('action' => 'index'));
    }

}
