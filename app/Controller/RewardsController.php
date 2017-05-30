<?php

App::uses('AppController', 'Controller');

/**
 * Rewards Controller
 *
 * @property Reward $Reward
 * @property PaginatorComponent $Paginator
 */
class RewardsController extends AppController {

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
                    $conditions['Reward.' . $param_name . ' LIKE'] = '%' . urldecode(urldecode($value)) . '%';
                }
            }
        }

        $this->Reward->recursive = 0;
        $this->paginate = array(
            'limit' => 10,
            'conditions' => $conditions
        );
        $options = array('Reward.removed' => 'N');
        $this->set('rewards', $this->Paginator->paginate($options));

        $rooms = $this->Reward->Room->find('list', array('conditions' => array('Room.removed' => 'N', 'Room.active' => 'S'), 'order' => 'Room.name'));
        $matriculations = $this->Reward->Matriculation->find('list', array('conditions' => array('Matriculation.removed' => 'N', 'Matriculation.active' => 'S'), 'order' => 'Matriculation.name'));
        $this->set(compact('rooms', 'matriculations'));
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
                    $conditions['Reward.' . $param_name . ' LIKE'] = '%' . urldecode(urldecode($value)) . '%';
                }
            }
        }

        $this->Reward->recursive = 1;
        $this->paginate = array(
            'limit' => 10,
            'conditions' => $conditions
        );
        $options = array('Reward.removed' => 'N', "Reward.room_id" => $this->Session->read('Auth.User.SelectRoom.id'));
        $this->set('rewards', $this->Paginator->paginate($options));
        
        //$rooms = $this->Reward->Room->find('list', array('conditions' => array('Room.removed' => 'N', 'Room.active' => 'S'), 'order' => 'Room.created'));
        
        $this->set(compact('rooms', 'matriculations'));
    }

    /**
     * view method
     * Powered by Frame2Days
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Reward->exists($id)) {
            throw new NotFoundException(__('Invalid reward'));
        }
        $options = array('conditions' => array('Reward.' . $this->Reward->primaryKey => $id));
        $this->set('reward', $this->Reward->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Reward->create();
            if ($this->Reward->save($this->request->data)) {
                $this->Session->setFlash('<br><div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                        . __('reward') . ' ' . __('has been saved.') .
                        '</div>');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('<br><div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                        . __('reward') . ' ' . __('could not be saved. Please, try again.') .
                        '</div>');
            }
        }
        $rooms = $this->Reward->Room->find('list', array('conditions' => array('Room.removed' => 'N', 'Room.active' => 'S'), 'order' => 'Room.name'));
        $matriculations = $this->Reward->Matriculation->find('list', array('conditions' => array('Matriculation.removed' => 'N', 'Matriculation.active' => 'S'), 'order' => 'Matriculation.name'));
        $this->set(compact('rooms', 'matriculations'));
    }

    public function teacher_add() {
        if ($this->request->is('post')) {
            $this->request->data['Reward']['room_id'] = $this->Session->read('Auth.User.SelectRoom.id');
            if ($this->Reward->save($this->request->data)) {
                $this->Session->setFlash('<br><div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                        . __('reward') . ' ' . __('has been saved.') .
                        '</div>');
                return $this->redirect(array('action' => 'teacher_index'));
            } else {
                $this->Session->setFlash('<br><div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                        . __('reward') . ' ' . __('could not be saved. Please, try again.') .
                        '</div>');
            }
        }
        //$rooms = $this->Reward->Room->find('list', array('conditions' => array('Room.removed' => 'N', 'Room.active' => 'S'), 'order' => 'Room.name'));
        $matriculations = $this->Reward->Matriculation->find('list', array(
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
        $this->set(compact('rooms', 'matriculations'));
    }

    /**
     * edit method
     * Powered by Frame2Days
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Reward->exists($id)) {
            throw new NotFoundException(__('Invalid reward'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Reward->save($this->request->data)) {
                $this->Session->setFlash('<br><div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                        . __('reward') . ' ' . __('has been saved.') .
                        '</div>');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('<br><div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                        . __('reward') . ' ' . __('could not be saved. Please, try again.') .
                        '</div>');
            }
        } else {
            $options = array('conditions' => array('Reward.' . $this->Reward->primaryKey => $id));
            $this->request->data = $this->Reward->find('first', $options);
        }
        $rooms = $this->Reward->Room->find('list', array('conditions' => array('Room.removed' => 'N', 'Room.active' => 'S'), 'order' => 'Room.name'));
        $matriculations = $this->Reward->Matriculation->find('list', array('conditions' => array('Matriculation.removed' => 'N', 'Matriculation.active' => 'S'), 'order' => 'Matriculation.name'));
        $this->set(compact('rooms', 'matriculations'));
    }

    public function teacher_edit($id = null) {
        if (!$this->Reward->exists($id)) {
            throw new NotFoundException(__('Invalid reward'));
        }
        if ($this->request->is(array('post', 'put'))) {
            $this->request->data['Reward']['room_id'] = $this->Session->read('Auth.User.SelectRoom.id');
            if ($this->Reward->save($this->request->data)) {
                $this->Session->setFlash('<br><div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                        . __('reward') . ' ' . __('has been saved.') .
                        '</div>');
                return $this->redirect(array('action' => 'teacher_index'));
            } else {
                $this->Session->setFlash('<br><div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                        . __('reward') . ' ' . __('could not be saved. Please, try again.') .
                        '</div>');
            }
        } else {
            $options = array('conditions' => array('Reward.' . $this->Reward->primaryKey => $id));
            $this->request->data = $this->Reward->find('first', $options);
        }
        
        $matriculations = $this->Reward->Matriculation->find('list', array(
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
        $this->set(compact('rooms', 'matriculations'));
    }

    /**
     * delete method
     * Powered by Frame2Days
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Reward->id = $id;
        if (!$this->Reward->exists()) {
            throw new NotFoundException(__('Invalid reward'));
        }
        $data = array('id' => $id, 'removed' => 'S');
        $this->request->allowMethod('post', 'delete');
        if ($this->Reward->save($data)) {
            $this->Session->setFlash('<br><div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                    . __('reward') . ' ' . __('has been deleted.') .
                    '</div>');
        } else {
            $this->Session->setFlash('<br><div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                    . __('reward') . ' ' . __('could not be deleted. Please, try again.') .
                    '</div>');
        }
        return $this->redirect(array('action' => 'index'));
    }

}
