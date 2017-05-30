<?php

App::uses('AppController', 'Controller');
App::uses('User', 'Admin.Model');

/**
 * Students Controller
 *
 * @property Student $Student
 * @property PaginatorComponent $Paginator
 */
class StudentsController extends AppController {

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
                    $conditions['Student.' . $param_name . ' LIKE'] = '%' . urldecode(urldecode($value)) . '%';
                }
            }
        }

        $this->Student->recursive = 0;
        $this->paginate = array(
            'limit' => 10,
            'conditions' => $conditions
        );
        $options = array('Student.removed' => 'N');
        $this->set('students', $this->Paginator->paginate($options));
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
                    $conditions['Student.' . $param_name . ' LIKE'] = '%' . urldecode(urldecode($value)) . '%';
                }
            }
        }
        
        
        
        $this->Student->recursive = 0;
        $this->paginate = array(
            'limit' => 10,
            'conditions' => $conditions,
            'joins' => array(
                array(
                    'table' => 'matriculations',
                    'alias' => 'Matriculation',
                    'type' => 'INNER',
                    'conditions' => 'Matriculation.student_id = Student.id')
            )
        );
        $options = array('Student.removed' => 'N', 'Matriculation.room_id' => $this->Session->read('Auth.User.SelectRoom.id'));
        $this->set('students', $this->Paginator->paginate($options));
    }
    
    /**
     * view method
     * Powered by Frame2Days
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Student->exists($id)) {
            throw new NotFoundException(__('Invalid student'));
        }
        $options = array('conditions' => array('Student.' . $this->Student->primaryKey => $id));
        $this->set('student', $this->Student->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->loadModel('User');
            $this->request->data['User']['group_id'] = 3;
            if ($this->User->saveAll($this->request->data)) {
                $this->Session->setFlash('<br><div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                        . __('student') . ' ' . __('has been saved.') .
                        '</div>');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('<br><div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                        . __('student') . ' ' . __('could not be saved. Please, try again.') .
                        '</div>');
            }
        }
    }

    /**
     * edit method
     * Powered by Frame2Days
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        $this->loadModel('User');
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid student'));
        }
        if ($this->request->is(array('post', 'put'))) {
            
            $this->request->data['User']['group_id'] = 3;
            if ($this->User->saveAll($this->request->data)) {
                $this->Session->setFlash('<br><div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                        . __('student') . ' ' . __('has been saved.') .
                        '</div>');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('<br><div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                        . __('student') . ' ' . __('could not be saved. Please, try again.') .
                        '</div>');
            }
        } else {
            $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
            $this->request->data = $this->User->find('first', $options);
        }
    }

    /**
     * delete method
     * Powered by Frame2Days
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Student->id = $id;
        if (!$this->Student->exists()) {
            throw new NotFoundException(__('Invalid student'));
        }
        $data = array('id' => $id, 'removed' => 'S');
        $this->request->allowMethod('post', 'delete');
        if ($this->Student->save($data)) {
            $this->Session->setFlash('<br><div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                    . __('student') . ' ' . __('has been deleted.') .
                    '</div>');
        } else {
            $this->Session->setFlash('<br><div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                    . __('student') . ' ' . __('could not be deleted. Please, try again.') .
                    '</div>');
        }
        return $this->redirect(array('action' => 'index'));
    }

}
