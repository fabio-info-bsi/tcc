<?php

App::uses('AppController', 'Controller');

/**
 * Matriculations Controller
 *
 * @property Matriculation $Matriculation
 * @property PaginatorComponent $Paginator
 */
class MatriculationsController extends AppController {

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
                    $conditions['Matriculation.' . $param_name . ' LIKE'] = '%' . urldecode(urldecode($value)) . '%';
                }
            }
        }

        $this->Matriculation->recursive = 0;
        $this->paginate = array(
            'limit' => 10,
            'conditions' => $conditions
        );
        $options = array('Matriculation.removed' => 'N');
        $this->set('matriculations', $this->Paginator->paginate($options));

        $students = $this->Matriculation->Student->find('list', array('fields' => array('Student.id', 'Student.nm_student'), 'conditions' => array('Student.removed' => 'N', 'Student.active' => 'S'), 'order' => 'Student.nm_student'));
        $rooms = $this->Matriculation->Room->find('list', array('conditions' => array('Room.removed' => 'N', 'Room.active' => 'S'), 'order' => 'Room.ds_room'));
        $activities = $this->Matriculation->Activity->find('list', array('conditions' => array('Activity.removed' => 'N', 'Activity.active' => 'S'), 'order' => 'Activity.nm_activity'));
        $rewards = $this->Matriculation->Reward->find('list', array('conditions' => array('Reward.removed' => 'N', 'Reward.active' => 'S'), 'order' => 'Reward.nm_brinde'));
        $teams = $this->Matriculation->Team->find('list', array('conditions' => array('Team.removed' => 'N', 'Team.active' => 'S'), 'order' => 'Team.nm_team'));
        $this->set(compact('students', 'rooms', 'activities', 'rewards', 'teams'));
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
                    $conditions['Matriculation.' . $param_name . ' LIKE'] = '%' . urldecode(urldecode($value)) . '%';
                }
            }
        }

        $this->Matriculation->recursive = 0;
        $this->paginate = array(
            'limit' => 10,
            'conditions' => $conditions
        );
        $options = array('Matriculation.removed' => 'N', "Matriculation.room_id" => $this->Session->read('Auth.User.SelectRoom.id'));
        $this->set('matriculations', $this->Paginator->paginate($options));

        $students = $this->Matriculation->Student->find('list', array('fields' => array('Student.id', 'Student.nm_student'), 'conditions' => array('Student.removed' => 'N', 'Student.active' => 'S'), 'order' => 'Student.created'));
        //$rooms = $this->Matriculation->Room->find('list', array('conditions' => array('Room.removed' => 'N', 'Room.active' => 'S'), 'order' => 'Room.ds_room'));
        //$activities = $this->Matriculation->Activity->find('list', array('conditions' => array('Activity.removed' => 'N', 'Activity.active' => 'S'), 'order' => 'Activity.nm_activity'));
        //$rewards = $this->Matriculation->Reward->find('list', array('conditions' => array('Reward.removed' => 'N', 'Reward.active' => 'S'), 'order' => 'Reward.nm_brinde'));
        //$teams = $this->Matriculation->Team->find('list', array('conditions' => array('Team.removed' => 'N', 'Team.active' => 'S'), 'order' => 'Team.nm_team'));
        $this->set(compact('students', 'rooms', 'activities', 'rewards', 'teams'));
    }

    /**
     * view method
     * Powered by Frame2Days
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Matriculation->exists($id)) {
            throw new NotFoundException(__('Invalid matriculation'));
        }
        $options = array('conditions' => array('Matriculation.' . $this->Matriculation->primaryKey => $id));
        $this->set('matriculation', $this->Matriculation->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Matriculation->create();
            debug($this->request->data)or die;
            if ($this->Matriculation->save($this->request->data)) {
                $this->Session->setFlash('<br><div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                        . __('matriculation') . ' ' . __('has been saved.') .
                        '</div>');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('<br><div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                        . __('matriculation') . ' ' . __('could not be saved. Please, try again.') .
                        '</div>');
            }
        }
        $students = $this->Matriculation->Student->find('list', array('fields' => array('Student.id', 'Student.nm_student'), 'conditions' => array('Student.removed' => 'N', 'Student.active' => 'S'), 'order' => 'Student.nm_student'));
        $rooms = $this->Matriculation->Room->find('list', array('conditions' => array('Room.removed' => 'N', 'Room.active' => 'S'), 'order' => 'Room.ds_room'));
        $activities = $this->Matriculation->Activity->find('list', array('conditions' => array('Activity.removed' => 'N', 'Activity.active' => 'S'), 'order' => 'Activity.nm_activity'));
        $rewards = $this->Matriculation->Reward->find('list', array('conditions' => array('Reward.removed' => 'N', 'Reward.active' => 'S'), 'order' => 'Reward.nm_brinde'));
        $teams = $this->Matriculation->Team->find('list', array('conditions' => array('Team.removed' => 'N', 'Team.active' => 'S'), 'order' => 'Team.nm_team'));
        $this->set(compact('students', 'rooms', 'activities', 'rewards', 'teams'));
    }

    public function teacher_add() {
        if ($this->request->is('post')) {
            $this->request->data['Matriculation']['room_id'] = $this->Session->read('Auth.User.SelectRoom.id');
            if ($this->Matriculation->save($this->request->data)) {
                $this->Session->setFlash('<br><div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                        . __('matriculation') . ' ' . __('has been saved.') .
                        '</div>');
                return $this->redirect(array('action' => 'teacher_index'));
            } else {
                $this->Session->setFlash('<br><div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                        . __('matriculation') . ' ' . __('could not be saved. Please, try again.') .
                        '</div>');
            }
        }
        $students = $this->Matriculation->Student->find('list', array('fields' => array('Student.id', 'Student.nm_student'), 'conditions' => array('Student.removed' => 'N', 'Student.active' => 'S'), 'order' => 'Student.nm_student'));
        $rooms = $this->Matriculation->Room->find('list', array('conditions' => array('Room.removed' => 'N', 'Room.active' => 'S'), 'order' => 'Room.ds_room'));
        $activities = $this->Matriculation->Activity->find('list', array('conditions' => array('Activity.removed' => 'N', 'Activity.active' => 'S'), 'order' => 'Activity.nm_activity'));
        $rewards = $this->Matriculation->Reward->find('list', array('conditions' => array('Reward.removed' => 'N', 'Reward.active' => 'S'), 'order' => 'Reward.nm_brinde'));
        $teams = $this->Matriculation->Team->find('list', array('conditions' => array('Team.removed' => 'N', 'Team.active' => 'S'), 'order' => 'Team.nm_team'));
        $this->set(compact('students', 'rooms', 'activities', 'rewards', 'teams'));
    }

    /**
     * edit method
     * Powered by Frame2Days
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Matriculation->exists($id)) {
            throw new NotFoundException(__('Invalid matriculation'));
        }
        if ($this->request->is(array('post', 'put'))) {
            debug($this->request->data)or die;
            if ($this->Matriculation->save($this->request->data)) {
                $this->Session->setFlash('<br><div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                        . __('matriculation') . ' ' . __('has been saved.') .
                        '</div>');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('<br><div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                        . __('matriculation') . ' ' . __('could not be saved. Please, try again.') .
                        '</div>');
            }
        } else {
            $options = array('conditions' => array('Matriculation.' . $this->Matriculation->primaryKey => $id));
            $this->request->data = $this->Matriculation->find('first', $options);
        }
        $students = $this->Matriculation->Student->find('list', array('conditions' => array('Student.removed' => 'N', 'Student.active' => 'S'), 'order' => 'Student.nm_student'));
        $rooms = $this->Matriculation->Room->find('list', array('conditions' => array('Room.removed' => 'N', 'Room.active' => 'S'), 'order' => 'Room.ds_room'));
        $activities = $this->Matriculation->Activity->find('list', array('conditions' => array('Activity.removed' => 'N', 'Activity.active' => 'S'), 'order' => 'Activity.nm_activity'));
        $rewards = $this->Matriculation->Reward->find('list', array('conditions' => array('Reward.removed' => 'N', 'Reward.active' => 'S'), 'order' => 'Reward.nm_brinde'));
        $teams = $this->Matriculation->Team->find('list', array('conditions' => array('Team.removed' => 'N', 'Team.active' => 'S'), 'order' => 'Team.nm_team'));
        $this->set(compact('students', 'rooms', 'activities', 'rewards', 'teams'));
    }

    public function teacher_edit($id = null) {
        if (!$this->Matriculation->exists($id)) {
            throw new NotFoundException(__('Invalid matriculation'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Matriculation->save($this->request->data)) {
                $this->Session->setFlash('<br><div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                        . __('matriculation') . ' ' . __('has been saved.') .
                        '</div>');
                return $this->redirect(array('action' => 'teacher_index'));
            } else {
                $this->Session->setFlash('<br><div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                        . __('matriculation') . ' ' . __('could not be saved. Please, try again.') .
                        '</div>');
            }
        } else {
            $options = array('conditions' => array('Matriculation.' . $this->Matriculation->primaryKey => $id));
            $this->request->data = $this->Matriculation->find('first', $options);
        }
        $students = $this->Matriculation->Student->find('list', array('conditions' => array('Student.removed' => 'N', 'Student.active' => 'S'), 'order' => 'Student.nm_student'));
        $rooms = $this->Matriculation->Room->find('list', array('conditions' => array('Room.removed' => 'N', 'Room.active' => 'S'), 'order' => 'Room.ds_room'));
        $activities = $this->Matriculation->Activity->find('list', array('conditions' => array('Activity.removed' => 'N', 'Activity.active' => 'S'), 'order' => 'Activity.nm_activity'));
        $rewards = $this->Matriculation->Reward->find('list', array('conditions' => array('Reward.removed' => 'N', 'Reward.active' => 'S'), 'order' => 'Reward.nm_brinde'));
        $teams = $this->Matriculation->Team->find('list', array('conditions' => array('Team.removed' => 'N', 'Team.active' => 'S'), 'order' => 'Team.nm_team'));
        $this->set(compact('students', 'rooms', 'activities', 'rewards', 'teams'));
    }

    /**
     * delete method
     * Powered by Frame2Days
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Matriculation->id = $id;
        if (!$this->Matriculation->exists()) {
            throw new NotFoundException(__('Invalid matriculation'));
        }
        $data = array('id' => $id, 'removed' => 'S');
        $this->request->allowMethod('post', 'delete');
        if ($this->Matriculation->save($data)) {
            $this->Session->setFlash('<br><div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                    . __('matriculation') . ' ' . __('has been deleted.') .
                    '</div>');
        } else {
            $this->Session->setFlash('<br><div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                    . __('matriculation') . ' ' . __('could not be deleted. Please, try again.') .
                    '</div>');
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function update_select_matriculation() {
        if ($this->request->is('post')) {
            $room = $this->Matriculation->find('first', array('conditions' => array('Matriculation.id' => $this->request->data['matriculation_id']), 'fields' => array('Matriculation.room_id')));

            if (!empty($room)) {
                $this->Session->write(
                        'Auth.User.SelectMatriculation', array('id' => $room['Matriculation']['id'], 'room_id' => $room['Matriculation']['room_id'])
                );
            } else {
                $this->Session->setFlash('<br><div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                        . __('matriculation') . ' ' . __('Matriculation not existe. Please, try again.') .
                        '</div>');
            }
            return $this->redirect($this->request->referer());
        }
    }

    function student_ranking() {
        $rankingPoints = $this->Matriculation->find('all', array(
            'conditions' => array(
                'Matriculation.room_id' => $this->Session->read('Auth.User.SelectMatriculation.room_id'),
            ),
            'group' => array(
				'Student.nm_student'
                ,'Matriculation.id'
            ),
            'fields' => array(
                //'User.*',
                'Student.nm_student',
                'sum(Point.vl_point) as total_points',
                'sum(Point.vl_point_redeemable) as total_points_redeemable'
            ),
            'joins' => array(
                array(
                    'table' => 'points',
                    'alias' => 'Point',
                    'type' => 'LEFT',
                    'conditions' => 'Point.matriculation_id = Matriculation.id'),
                array(
                    'table' => 'users',
                    'alias' => 'User',
                    'type' => 'LEFT',
                    'conditions' => 'Student.user_id = User.id'),
            ),
            'order' => array('total_points' => 'desc'),
            'recursive' => 0
        ));
        $this->set(compact('rankingPoints'));
    }

}
