<?php

App::uses('AppController', 'Controller');

/**
 * MatriculationsRewards Controller
 *
 * @property MatriculationsReward $MatriculationsReward
 * @property PaginatorComponent $Paginator
 */
class MatriculationsRewardsController extends AppController {

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
                    $conditions['MatriculationsReward.' . $param_name . ' LIKE'] = '%' . urldecode(urldecode($value)) . '%';
                }
            }
        }

        $this->MatriculationsReward->recursive = 0;
        $this->paginate = array(
            'limit' => 10,
            'conditions' => $conditions
        );
        $options = array('MatriculationsReward.removed' => 'N');
        $this->set('matriculationsRewards', $this->Paginator->paginate($options));

        $matriculations = $this->MatriculationsReward->Matriculation->find('list', array('conditions' => array('Matriculation.removed' => 'N', 'Matriculation.active' => 'S'), 'order' => 'Matriculation.created'));
        $rewards = $this->MatriculationsReward->Reward->find('list', array('conditions' => array('Reward.removed' => 'N', 'Reward.active' => 'S'), 'order' => 'Reward.created'));
        $activities = $this->MatriculationsReward->Activity->find('list', array('conditions' => array('Activity.removed' => 'N', 'Activity.active' => 'S'), 'order' => 'Activity.created'));
        $this->set(compact('matriculations', 'rewards', 'activities'));
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
                    $conditions['MatriculationsReward.' . $param_name . ' LIKE'] = '%' . urldecode(urldecode($value)) . '%';
                }
            }
        }
        //List of matriculations in classe of teacher
        $idMatriculationsInRoom = $this->MatriculationsReward->Matriculation->find('list', array('conditions' => array('room_id' => $this->Session->read('Auth.User.SelectRoom.id'))));

        $this->MatriculationsReward->recursive = 0;
        $this->paginate = array(
            'limit' => 10,
            'conditions' => $conditions
        );
        $options = array('MatriculationsReward.removed' => 'N', 'MatriculationsReward.matriculation_id' => $idMatriculationsInRoom);
        $this->set('matriculationsRewards', $this->Paginator->paginate($options));

        $matriculations = $this->MatriculationsReward->Matriculation->find('list', array(
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
            'order' => 'Matriculation.student_id')
        );
        $rewards = $this->MatriculationsReward->Reward->find('list', array(
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
        $activities = $this->MatriculationsReward->Activity->find('list', array(
            'conditions' => array(
                'Activity.removed' => 'N',
                'Activity.active' => 'S',
                'Activity.room_id' => $this->Session->read('Auth.User.SelectRoom.id')
            ),
            'fields' => array(
                'Activity.id',
                'Activity.nm_activity',
            ),
            'order' => 'Activity.created')
        );
        $this->set(compact('matriculations', 'rewards', 'activities'));
    }

    /**
     * view method
     * Powered by Frame2Days
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->MatriculationsReward->exists($id)) {
            throw new NotFoundException(__('Invalid matriculations reward'));
        }
        $options = array('conditions' => array('MatriculationsReward.' . $this->MatriculationsReward->primaryKey => $id));
        $this->set('matriculationsReward', $this->MatriculationsReward->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->MatriculationsReward->create();
            if ($this->MatriculationsReward->save($this->request->data)) {
                $this->Session->setFlash('<br><div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                        . __('matriculations reward') . ' ' . __('has been saved.') .
                        '</div>');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('<br><div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                        . __('matriculations reward') . ' ' . __('could not be saved. Please, try again.') .
                        '</div>');
            }
        }
        $matriculations = $this->MatriculationsReward->Matriculation->find('list', array('conditions' => array('Matriculation.removed' => 'N', 'Matriculation.active' => 'S'), 'order' => 'Matriculation.name'));
        $rewards = $this->MatriculationsReward->Reward->find('list', array('conditions' => array('Reward.removed' => 'N', 'Reward.active' => 'S'), 'order' => 'Reward.name'));
        $activities = $this->MatriculationsReward->Activity->find('list', array('conditions' => array('Activity.removed' => 'N', 'Activity.active' => 'S'), 'order' => 'Activity.name'));
        $this->set(compact('matriculations', 'rewards', 'activities'));
    }

    public function teacher_add() {
        if ($this->request->is('post')) {
            $this->MatriculationsReward->create();
            if ($this->MatriculationsReward->save($this->request->data)) {
                $this->Session->setFlash('<br><div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                        . __('matriculations reward') . ' ' . __('has been saved.') .
                        '</div>');
                return $this->redirect(array('action' => 'teacher_index'));
            } else {
                $this->Session->setFlash('<br><div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                        . __('matriculations reward') . ' ' . __('could not be saved. Please, try again.') .
                        '</div>');
            }
        }
        $matriculations = $this->MatriculationsReward->Matriculation->find('list', array(
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
            'order' => 'Matriculation.student_id')
        );
        $rewards = $this->MatriculationsReward->Reward->find('list', array(
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
        $activities = $this->MatriculationsReward->Activity->find('list', array(
            'conditions' => array(
                'Activity.removed' => 'N',
                'Activity.active' => 'S',
                'Activity.room_id' => $this->Session->read('Auth.User.SelectRoom.id')
            ),
            'fields' => array(
                'Activity.id',
                'Activity.nm_activity',
            ),
            'order' => 'Activity.created')
        );
        $this->set(compact('matriculations', 'rewards', 'activities'));
    }

    /**
     * edit method
     * Powered by Frame2Days
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->MatriculationsReward->exists($id)) {
            throw new NotFoundException(__('Invalid matriculations reward'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->MatriculationsReward->save($this->request->data)) {
                $this->Session->setFlash('<br><div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                        . __('matriculations reward') . ' ' . __('has been saved.') .
                        '</div>');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('<br><div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                        . __('matriculations reward') . ' ' . __('could not be saved. Please, try again.') .
                        '</div>');
            }
        } else {
            $options = array('conditions' => array('MatriculationsReward.' . $this->MatriculationsReward->primaryKey => $id));
            $this->request->data = $this->MatriculationsReward->find('first', $options);
        }
        $matriculations = $this->MatriculationsReward->Matriculation->find('list', array('conditions' => array('Matriculation.removed' => 'N', 'Matriculation.active' => 'S'), 'order' => 'Matriculation.name'));
        $rewards = $this->MatriculationsReward->Reward->find('list', array('conditions' => array('Reward.removed' => 'N', 'Reward.active' => 'S'), 'order' => 'Reward.name'));
        $activities = $this->MatriculationsReward->Activity->find('list', array('conditions' => array('Activity.removed' => 'N', 'Activity.active' => 'S'), 'order' => 'Activity.name'));
        $this->set(compact('matriculations', 'rewards', 'activities'));
    }

    public function teacher_edit($id = null) {
        if (!$this->MatriculationsReward->exists($id)) {
            throw new NotFoundException(__('Invalid matriculations reward'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->MatriculationsReward->save($this->request->data)) {
                $this->Session->setFlash('<br><div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                        . __('matriculations reward') . ' ' . __('has been saved.') .
                        '</div>');
                return $this->redirect(array('action' => 'teacher_index'));
            } else {
                $this->Session->setFlash('<br><div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                        . __('matriculations reward') . ' ' . __('could not be saved. Please, try again.') .
                        '</div>');
            }
        } else {
            $options = array('conditions' => array('MatriculationsReward.' . $this->MatriculationsReward->primaryKey => $id));
            $this->request->data = $this->MatriculationsReward->find('first', $options);
        }
        $matriculations = $this->MatriculationsReward->Matriculation->find('list', array(
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
            'order' => 'Matriculation.student_id')
        );
        $rewards = $this->MatriculationsReward->Reward->find('list', array(
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
        $activities = $this->MatriculationsReward->Activity->find('list', array(
            'conditions' => array(
                'Activity.removed' => 'N',
                'Activity.active' => 'S',
                'Activity.room_id' => $this->Session->read('Auth.User.SelectRoom.id')
            ),
            'fields' => array(
                'Activity.id',
                'Activity.nm_activity',
            ),
            'order' => 'Activity.created')
        );
        $this->set(compact('matriculations', 'rewards', 'activities'));
    }

    /**
     * delete method
     * Powered by Frame2Days
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->MatriculationsReward->id = $id;
        if (!$this->MatriculationsReward->exists()) {
            throw new NotFoundException(__('Invalid matriculations reward'));
        }
        $data = array('id' => $id, 'removed' => 'S');
        $this->request->allowMethod('post', 'delete');
        if ($this->MatriculationsReward->save($data)) {
            $this->Session->setFlash('<br><div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                    . __('matriculations reward') . ' ' . __('has been deleted.') .
                    '</div>');
        } else {
            $this->Session->setFlash('<br><div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>' . __("Alert!") . ' </b>'
                    . __('matriculations reward') . ' ' . __('could not be deleted. Please, try again.') .
                    '</div>');
        }
        return $this->redirect(array('action' => 'index'));
    }

}
