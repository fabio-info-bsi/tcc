<?php

App::uses('AppController', 'Controller');

/**
 * Teachers Controller
 *
 * @property Teacher $Teacher
 * @property PaginatorComponent $Paginator
 */
class TeachersController extends AppController {

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
                    $conditions['Teacher.' . $param_name . ' LIKE'] = '%' . urldecode(urldecode($value)) . '%';
                }
            }
        }

        $this->Teacher->recursive = 0;
        $this->paginate = array(
            'limit' => 10,
            'conditions' => $conditions
        );
        $options = array('Teacher.removed' => 'N');
        $this->set('teachers', $this->Paginator->paginate($options));
    }

    /**
     * view method
     * Powered by Frame2Days
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Teacher->exists($id)) {
            throw new NotFoundException(__('Invalid teacher'));
        }
        $options = array('conditions' => array('Teacher.' . $this->Teacher->primaryKey => $id));
        $this->set('teacher', $this->Teacher->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->loadModel('User');
            $this->request->data['User']['group_id'] = 2;
            if ($this->User->saveAll($this->request->data)) {
                $this->Session->setFlash('<br><div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                        . __('teacher') . ' ' . __('has been saved.') .
                        '</div>');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('<br><div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                        . __('teacher') . ' ' . __('could not be saved. Please, try again.') .
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
            throw new NotFoundException(__('Invalid teacher'));
        }
        if ($this->request->is(array('post', 'put'))) {
            $this->request->data['User']['group_id'] = 2;
            if ($this->User->saveAll($this->request->data)) {
                $this->Session->setFlash('<br><div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                        . __('teacher') . ' ' . __('has been saved.') .
                        '</div>');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('<br><div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                        . __('teacher') . ' ' . __('could not be saved. Please, try again.') .
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
        $this->Teacher->id = $id;
        if (!$this->Teacher->exists()) {
            throw new NotFoundException(__('Invalid teacher'));
        }
        $data = array('id' => $id, 'removed' => 'S');
        $this->request->allowMethod('post', 'delete');
        if ($this->Teacher->save($data)) {
            $this->Session->setFlash('<br><div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                    . __('teacher') . ' ' . __('has been deleted.') .
                    '</div>');
        } else {
            $this->Session->setFlash('<br><div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                    . __('teacher') . ' ' . __('could not be deleted. Please, try again.') .
                    '</div>');
        }
        return $this->redirect(array('action' => 'index'));
    }

}
