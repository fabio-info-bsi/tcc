<?php

App::uses('AppController', 'Controller');

/**
 * Points Controller
 *
 * @property Point $Point
 * @property PaginatorComponent $Paginator
 */
class PointsController extends AppController {

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
                    $conditions['Point.' . $param_name . ' LIKE'] = '%' . urldecode(urldecode($value)) . '%';
                }
            }
        }

        $this->Point->recursive = 0;
        $this->paginate = array(
            'limit' => 10,
            'conditions' => $conditions
        );
        $options = array('Point.removed' => 'N');
        $this->set('points', $this->Paginator->paginate($options));

        $matriculations = $this->Point->Matriculation->find('list', array('conditions' => array('Matriculation.removed' => 'N', 'Matriculation.active' => 'S'),
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
        $this->set(compact('matriculations'));
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
                    $conditions['Point.' . $param_name . ' LIKE'] = '%' . urldecode(urldecode($value)) . '%';
                }
            }
        }

        //$this->Point->recursive = 0;
        $this->paginate = array(
            'limit' => 10,
            'conditions' => $conditions,
            'joins' => array(
                array(
                    'table' => 'students',
                    'alias' => 'Student',
                    'type' => 'INNER',
                    'conditions' => 'Matriculation.student_id = Student.id')
            ),
            'order' => array('Point.created'=>'desc')
        );
        $options = array('Point.removed' => 'N', "Matriculation.room_id" => $this->Session->read('Auth.User.SelectRoom.id'));
        $this->set('points', $this->Paginator->paginate($options));
        
        $activities = $this->Point->Activity->find('list', array(
            'conditions'=> array(
                "Activity.room_id" => $this->Session->read('Auth.User.SelectRoom.id')
            ),
            'fields' => array(
                'Activity.id',
                'Activity.nm_activity',
            )
            )
                );

        $matriculations = $this->Point->Matriculation->find('list', array(
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
        $this->set(compact('matriculations', 'activities'));
    }

    /**
     * view method
     * Powered by Frame2Days
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Point->exists($id)) {
            throw new NotFoundException(__('Invalid point'));
        }
        $options = array('conditions' => array('Point.' . $this->Point->primaryKey => $id));
        $this->set('point', $this->Point->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Point->create();
            if ($this->Point->save($this->request->data)) {
                $this->Session->setFlash('<br><div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                        . __('point') . ' ' . __('has been saved.') .
                        '</div>');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('<br><div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                        . __('point') . ' ' . __('could not be saved. Please, try again.') .
                        '</div>');
            }
        }
        $matriculations = $this->Point->Matriculation->find('list', array('conditions' => array('Matriculation.removed' => 'N', 'Matriculation.active' => 'S'),
            'joins' => array(
                array(
                    'table' => 'students',
                    'alias' => 'Student',
                    'type' => 'INNER',
                    'conditions' => 'Matriculation.student_id = Student.id')
            ),
            'fields' => array(
                'Matriculation.id',
                'Student.id',
            ),
            'order' => 'Matriculation.student_id'));
        $this->set(compact('matriculations'));
    }

    
    public function teacher_add() {
        if ($this->request->is('post')) {
            $this->Point->create();
            if ($this->Point->save($this->request->data)) {
                $this->Session->setFlash('<br><div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                        . __('point') . ' ' . __('has been saved.') .
                        '</div>');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('<br><div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                        . __('point') . ' ' . __('could not be saved. Please, try again.') .
                        '</div>');
            }
        }
        $matriculations = $this->Point->Matriculation->find('list', array(
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
        $this->set(compact('matriculations'));
    }
    
    /**
     * edit method
     * Powered by Frame2Days
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Point->exists($id)) {
            throw new NotFoundException(__('Invalid point'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Point->save($this->request->data)) {
                $this->Session->setFlash('<br><div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                        . __('point') . ' ' . __('has been saved.') .
                        '</div>');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('<br><div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                        . __('point') . ' ' . __('could not be saved. Please, try again.') .
                        '</div>');
            }
        } else {
            $options = array('conditions' => array('Point.' . $this->Point->primaryKey => $id));
            $this->request->data = $this->Point->find('first', $options);
        }
        $matriculations = $this->Point->Matriculation->find('list', array('conditions' => array('Matriculation.removed' => 'N', 'Matriculation.active' => 'S'),
            'joins' => array(
                array(
                    'table' => 'students',
                    'alias' => 'Student',
                    'type' => 'INNER',
                    'conditions' => 'Matriculation.student_id = Student.id')
            ),
            'fields' => array(
                'Matriculation.id',
                'Student.id',
            ),
            'order' => 'Matriculation.student_id'));
        $this->set(compact('matriculations'));
    }

    public function teacher_edit($id = null) {
        if (!$this->Point->exists($id)) {
            throw new NotFoundException(__('Invalid point'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Point->save($this->request->data)) {
                $this->Session->setFlash('<br><div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                        . __('point') . ' ' . __('has been saved.') .
                        '</div>');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('<br><div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                        . __('point') . ' ' . __('could not be saved. Please, try again.') .
                        '</div>');
            }
        } else {
            $options = array('conditions' => array('Point.' . $this->Point->primaryKey => $id));
            $this->request->data = $this->Point->find('first', $options);
        }
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
        $this->set(compact('matriculations'));
    }
    
    /**
     * delete method
     * Powered by Frame2Days
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Point->id = $id;
        if (!$this->Point->exists()) {
            throw new NotFoundException(__('Invalid point'));
        }
        $data = array('id' => $id, 'removed' => 'S');
        $this->request->allowMethod('post', 'delete');
        if ($this->Point->save($data)) {
            $this->Session->setFlash('<br><div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                    . __('point') . ' ' . __('has been deleted.') .
                    '</div>');
        } else {
            $this->Session->setFlash('<br><div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                    . __('point') . ' ' . __('could not be deleted. Please, try again.') .
                    '</div>');
        }
        return $this->redirect(array('action' => 'index'));
    }

}
