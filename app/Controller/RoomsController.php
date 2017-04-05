<?php

App::uses('AppController', 'Controller');

/**
 * Rooms Controller
 *
 * @property Room $Room
 * @property PaginatorComponent $Paginator
 */
class RoomsController extends AppController {

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
                    $conditions['Room.' . $param_name . ' LIKE'] = '%' . urldecode(urldecode($value)) . '%';
                }
            }
        }

        $this->Room->recursive = 0;
        $this->paginate = array(
            'limit' => 10,
            'conditions' => $conditions
        );
        $options = array('Room.removed' => 'N');
        $this->set('rooms', $this->Paginator->paginate($options));

        $subjects = $this->Room->Subject->find('list', array('fields' => array('Subject.nm_subject'),'conditions' => array('Subject.removed' => 'N', 'Subject.active' => 'S'), 'order' => 'Subject.nm_subject'));
        $teachers = $this->Room->Teacher->find('list', array('fields' => array('Teacher.nm_teacher'),'conditions' => array('Teacher.removed' => 'N', 'Teacher.active' => 'S'), 'order' => 'Teacher.nm_teacher'));
        $this->set(compact('subjects', 'teachers'));
    }

    /**
     * view method
     * Powered by Frame2Days
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Room->exists($id)) {
            throw new NotFoundException(__('Invalid room'));
        }
        $options = array('conditions' => array('Room.' . $this->Room->primaryKey => $id));
        $this->set('room', $this->Room->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Room->create();
            if ($this->Room->save($this->request->data)) {
                $this->Session->setFlash('<br><div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                        . __('room') . ' ' . __('has been saved.') .
                        '</div>');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('<br><div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                        . __('room') . ' ' . __('could not be saved. Please, try again.') .
                        '</div>');
            }
        }
        $subjects = $this->Room->Subject->find('list', array('fields' => array('Subject.nm_subject'),'conditions' => array('Subject.removed' => 'N', 'Subject.active' => 'S'), 'order' => 'Subject.nm_subject'));
        $teachers = $this->Room->Teacher->find('list', array('fields' => array('Teacher.nm_teacher'),'conditions' => array('Teacher.removed' => 'N', 'Teacher.active' => 'S'), 'order' => 'Teacher.nm_teacher'));
        $this->set(compact('subjects', 'teachers'));
    }

    /**
     * edit method
     * Powered by Frame2Days
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Room->exists($id)) {
            throw new NotFoundException(__('Invalid room'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Room->save($this->request->data)) {
                $this->Session->setFlash('<br><div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                        . __('room') . ' ' . __('has been saved.') .
                        '</div>');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('<br><div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                        . __('room') . ' ' . __('could not be saved. Please, try again.') .
                        '</div>');
            }
        } else {
            $options = array('conditions' => array('Room.' . $this->Room->primaryKey => $id));
            $this->request->data = $this->Room->find('first', $options);
        }
        $subjects = $this->Room->Subject->find('list', array('fields' => array('Subject.nm_subject'),'conditions' => array('Subject.removed' => 'N', 'Subject.active' => 'S'), 'order' => 'Subject.nm_subject'));
        $teachers = $this->Room->Teacher->find('list', array('fields' => array('Teacher.nm_teacher'),'conditions' => array('Teacher.removed' => 'N', 'Teacher.active' => 'S'), 'order' => 'Teacher.nm_teacher'));
        $this->set(compact('subjects', 'teachers'));
    }

    /**
     * delete method
     * Powered by Frame2Days
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Room->id = $id;
        if (!$this->Room->exists()) {
            throw new NotFoundException(__('Invalid room'));
        }
        $data = array('id' => $id, 'removed' => 'S');
        $this->request->allowMethod('post', 'delete');
        if ($this->Room->save($data)) {
            $this->Session->setFlash('<br><div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                    . __('room') . ' ' . __('has been deleted.') .
                    '</div>');
        } else {
            $this->Session->setFlash('<br><div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                    . __('room') . ' ' . __('could not be deleted. Please, try again.') .
                    '</div>');
        }
        return $this->redirect(array('action' => 'index'));
    }

}
