<?php

App::uses('AppController', 'Controller');

/**
 * Teams Controller
 *
 * @property Team $Team
 * @property PaginatorComponent $Paginator
 */
class TeamsController extends AppController {

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
                    $conditions['Team.' . $param_name . ' LIKE'] = '%' . urldecode(urldecode($value)) . '%';
                }
            }
        }

        $this->Team->recursive = 0;
        $this->paginate = array(
            'limit' => 10,
            'conditions' => $conditions
        );
        $options = array('Team.removed' => 'N');
        $this->set('teams', $this->Paginator->paginate($options));

        $rooms = $this->Team->Room->find('list', array('conditions' => array('Room.removed' => 'N', 'Room.active' => 'S'), 'order' => 'Room.created'));
        $activities = $this->Team->Activity->find('list', array('conditions' => array('Activity.removed' => 'N', 'Activity.active' => 'S'), 'order' => 'Activity.created'));
        $matriculations = $this->Team->Matriculation->find('list', array('conditions' => array('Matriculation.removed' => 'N', 'Matriculation.active' => 'S'), 'order' => 'Matriculation.created'));
        $this->set(compact('rooms', 'activities', 'matriculations'));
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
                    $conditions['Team.' . $param_name . ' LIKE'] = '%' . urldecode(urldecode($value)) . '%';
                }
            }
        }

        $this->Team->recursive = 0;
        $this->paginate = array(
            'limit' => 10,
            'conditions' => $conditions
        );
        $options = array('Team.removed' => 'N', "Team.room_id" => $this->Session->read('Auth.User.SelectRoom.id'));
        $this->set('teams', $this->Paginator->paginate($options));

        //$rooms = $this->Team->Room->find('list', array('conditions' => array('Room.removed' => 'N', 'Room.active' => 'S'), 'order' => 'Room.created'));
        $activities = $this->Team->Activity->find('list', array('conditions' => array('Activity.removed' => 'N', 'Activity.active' => 'S', "Activity.room_id" => $this->Session->read('Auth.User.SelectRoom.id')), 'order' => 'Activity.created'));
        $matriculations = $this->Team->Matriculation->find('list', array(
            'conditions' => array(
                'Matriculation.removed' => 'N',
                'Matriculation.active' => 'S',
                "Matriculation.room_id" => $this->Session->read('Auth.User.SelectRoom.id')
            ),
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
        $this->set(compact('rooms', 'activities', 'matriculations'));
    }

    /**
     * view method
     * Powered by Frame2Days
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Team->exists($id)) {
            throw new NotFoundException(__('Invalid team'));
        }
        $options = array('conditions' => array('Team.' . $this->Team->primaryKey => $id));
        $this->set('team', $this->Team->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Team->create();
            if ($this->Team->save($this->request->data)) {
                $this->Session->setFlash('<br><div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                        . __('team') . ' ' . __('has been saved.') .
                        '</div>');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('<br><div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                        . __('team') . ' ' . __('could not be saved. Please, try again.') .
                        '</div>');
            }
        }
        $rooms = $this->Team->Room->find('list', array('conditions' => array('Room.removed' => 'N', 'Room.active' => 'S'), 'order' => 'Room.created'));
        $activities = $this->Team->Activity->find('list', array('conditions' => array('Activity.removed' => 'N', 'Activity.active' => 'S'), 'order' => 'Activity.created'));
        $matriculations = $this->Team->Matriculation->find('list', array('conditions' => array('Matriculation.removed' => 'N', 'Matriculation.active' => 'S'), 'order' => 'Matriculation.created'));
        $this->set(compact('rooms', 'activities', 'matriculations'));
    }

    public function teacher_add() {
        if ($this->request->is('post')) {
            $this->request->data['Team']['room_id'] = $this->Session->read('Auth.User.SelectRoom.id');
            if ($this->Team->save($this->request->data)) {
                $this->Session->setFlash('<br><div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                        . __('team') . ' ' . __('has been saved.') .
                        '</div>');
                return $this->redirect(array('action' => 'teacher_index'));
            } else {
                $this->Session->setFlash('<br><div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                        . __('team') . ' ' . __('could not be saved. Please, try again.') .
                        '</div>');
            }
        }
        //$rooms = $this->Team->Room->find('list', array('conditions' => array('Room.removed' => 'N', 'Room.active' => 'S'), 'order' => 'Room.created'));
        $activities = $this->Team->Activity->find('list', array(
            'conditions' => array('Activity.removed' => 'N', 'Activity.active' => 'S', "Activity.room_id" => $this->Session->read('Auth.User.SelectRoom.id')),
            'fields' => array(
                'Activity.id',
                'Activity.nm_activity'
            ),
            'order' => 'Activity.created')
        );
        $matriculations = $this->Team->Matriculation->find('list', array(
            'conditions' => array(
                'Matriculation.removed' => 'N',
                'Matriculation.active' => 'S',
                "Matriculation.room_id" => $this->Session->read('Auth.User.SelectRoom.id')
            ),
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
            'order' => 'Matriculation.student_id')
        );
        $this->set(compact('rooms', 'activities', 'matriculations'));
    }

    /**
     * edit method
     * Powered by Frame2Days
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Team->exists($id)) {
            throw new NotFoundException(__('Invalid team'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Team->save($this->request->data)) {
                $this->Session->setFlash('<br><div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                        . __('team') . ' ' . __('has been saved.') .
                        '</div>');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('<br><div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                        . __('team') . ' ' . __('could not be saved. Please, try again.') .
                        '</div>');
            }
        } else {
            $options = array('conditions' => array('Team.' . $this->Team->primaryKey => $id));
            $this->request->data = $this->Team->find('first', $options);
        }
        $rooms = $this->Team->Room->find('list', array('conditions' => array('Room.removed' => 'N', 'Room.active' => 'S'), 'order' => 'Room.created'));
        $activities = $this->Team->Activity->find('list', array('conditions' => array('Activity.removed' => 'N', 'Activity.active' => 'S'), 'order' => 'Activity.created'));
        $matriculations = $this->Team->Matriculation->find('list', array('conditions' => array('Matriculation.removed' => 'N', 'Matriculation.active' => 'S'), 'order' => 'Matriculation.created'));
        $this->set(compact('rooms', 'activities', 'matriculations'));
    }

    public function teacher_edit($id = null) {
        if (!$this->Team->exists($id)) {
            throw new NotFoundException(__('Invalid team'));
        }
        if ($this->request->is(array('post', 'put'))) {
            $this->request->data['Team']['room_id'] = $this->Session->read('Auth.User.SelectRoom.id');
            if ($this->Team->save($this->request->data)) {
                $this->Session->setFlash('<br><div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                        . __('team') . ' ' . __('has been saved.') .
                        '</div>');
                return $this->redirect(array('action' => 'teacher_index'));
            } else {
                $this->Session->setFlash('<br><div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                        . __('team') . ' ' . __('could not be saved. Please, try again.') .
                        '</div>');
            }
        } else {
            $options = array('conditions' => array('Team.' . $this->Team->primaryKey => $id));
            $this->request->data = $this->Team->find('first', $options);
        }
        
        $activities = $this->Team->Activity->find('list', array(
            'conditions' => array('Activity.removed' => 'N', 'Activity.active' => 'S', "Activity.room_id" => $this->Session->read('Auth.User.SelectRoom.id')),
            'fields' => array(
                'Activity.id',
                'Activity.nm_activity'
            ),
            'order' => 'Activity.created')
        );
        $matriculations = $this->Team->Matriculation->find('list', array(
            'conditions' => array(
                'Matriculation.removed' => 'N',
                'Matriculation.active' => 'S',
                "Matriculation.room_id" => $this->Session->read('Auth.User.SelectRoom.id')
            ),
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
            'order' => 'Matriculation.student_id')
        );
        $this->set(compact('rooms', 'activities', 'matriculations'));
    }

    /**
     * delete method
     * Powered by Frame2Days
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Team->id = $id;
        if (!$this->Team->exists()) {
            throw new NotFoundException(__('Invalid team'));
        }
        $data = array('id' => $id, 'removed' => 'S');
        $this->request->allowMethod('post', 'delete');
        if ($this->Team->save($data)) {
            $this->Session->setFlash('<br><div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                    . __('team') . ' ' . __('has been deleted.') .
                    '</div>');
        } else {
            $this->Session->setFlash('<br><div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                    . __('team') . ' ' . __('could not be deleted. Please, try again.') .
                    '</div>');
        }
        return $this->redirect(array('action' => 'index'));
    }

}
