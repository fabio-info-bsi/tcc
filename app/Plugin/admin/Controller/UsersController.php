<?php

/**
 * Users Controller
 *
 * @author Luis Fred G S <luis.fred.gs@gmail.com>
 * @category Controller
 * @package Plugin.Admin
 */
App::uses('AdminAppController', 'Admin.Controller');

class UsersController extends AdminAppController {

    /**
     * Models
     *
     * @var array
     * */
    public $uses = array('Admin.User', 'Admin.Group');

    /**
     * Controller callback - beforeFilter()
     * 
     * @return void
     */
    public function beforeFilter() {
        parent::beforeFilter();
        $this->set('title_for_layout', __d('admin', 'Users'));
    }

    /**
     * admin_index
     * 
     * @return void
     */
    public function admin_index() {
        $this->paginate['User']['order'] = 'User.id Desc';
        $this->set('users', $this->paginate('User'));
    }

    /**
     * admin_add
     * 
     * @return void
     */
    public function admin_add() {
        if (!empty($this->request->data)) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__d('admin', 'User saved.'), 'flash_success');
                $this->redirect(array('action' => 'index'));
            }
        }
        $groups = $this->Group->find('list');
        $this->set(compact('groups'));
    }

    /**
     * admin_edit
     * 
     * @param $id User ID
     * @return void
     */
    public function admin_edit($id = null) {
        if (!$id) {
            $this->Session->setFlash(__d('admin', 'Invalid ID'), 'flash_error');
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->request->data)) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__d('admin', 'User was saved.'), 'flash_success');
            }
        }
        $this->request->data = $this->User->read(null, $id);
        $groups = $this->Group->find('list');
        $this->set(compact('groups'));
    }

    /**
     * admin_login
     * 
     * @return void
     */
    public function admin_login() {
        $this->layout = 'admin_login';
        if ($this->request->is('post')) {

            if ($this->Auth->login()) {
                $this->loadModel("User");
                $this->User->recursive = 2;

                switch ($this->Session->read('Auth.User.group_id')) {
                    case 1:
                        $this->redirect(array('plugin' => NULL, 'admin' => FALSE, 'controller' => '', 'action' => '/'));
                        break;
                    case 2 :
                        //Reescrevendo na session 
                        $this->Session->write('Auth.User.Rooms', $this->User->Teacher->Room->find('list', array(
                                    'conditions' => array(
                                        'Room.teacher_id' => $this->Session->read('Auth.User.Teacher.id')
                                    ), 'fields' => array(
                                        'Room.id',
                                        'Subject.nm_subject',
                                    ),
                                    'joins' => array(
                                        array(
                                            'table' => 'teachers',
                                            'alias' => 'Teacher',
                                            'type' => 'INNER',
                                            'conditions' => 'Room.teacher_id = Teacher.id'
                                        ),
                                        array(
                                            'table' => 'subjects',
                                            'alias' => 'Subject',
                                            'type' => 'INNER',
                                            'conditions' => 'Room.subject_id = Subject.id')
                                    )
                                        )
                                )
                        );
                        $this->Session->write(
                                'Auth.User.SelectRoom', array('id' => key($this->Session->read('Auth.User.Rooms')))
                        );
                        $this->redirect(array('plugin' => NULL, 'admin' => FALSE, 'controller' => '', 'action' => '/'));
                        break;
                    case 3 :
                        $this->Session->write('Auth.User.Matriculations', $this->User->Student->Matriculation->find('list', array(
                                    'conditions' => array(
                                        'Matriculation.student_id' => $this->Session->read('Auth.User.Student.id')
                                    ), 'fields' => array(
                                        'Matriculation.id',
                                        'Subject.nm_subject',
                                        'Matriculation.room_id'
                                    ),
                                    'joins' => array(
                                        array(
                                            'table' => 'rooms',
                                            'alias' => 'Room',
                                            'type' => 'INNER',
                                            'conditions' => 'Matriculation.room_id = Room.id'),
                                        array(
                                            'table' => 'subjects',
                                            'alias' => 'Subject',
                                            'type' => 'INNER',
                                            'conditions' => 'Room.subject_id = Subject.id'),
                                    ),
                                        )
                                )
                        );
//                        $this->Session->write(
//                                'Auth.User.SelectMatriculation', array(
//                            'id' => key($this->Session->read('Auth.User.Matriculations')),
//                            'room_id' => array_shift($this->Session->read('Auth.User.Matriculations'))
//                                )
//                        );
                        $this->Session->write('Auth.User.SelectMatriculation', array(
                            'id' => key(current($this->Session->read('Auth.User.Matriculations'))),
                            //'nm_subject' => array_shift(current($this->Session->read('Auth.User.Matriculations'))),
                            'room_id' => key($this->Session->read('Auth.User.Matriculations'))
                                )
                        );
                        $this->redirect(array('plugin' => NULL, 'admin' => FALSE, 'controller' => 'Pages', 'action' => 'student_home'));
                        break;
                }


                //return $this->redirect($this->Auth->redirect('/'));
            } else {
                return $this->redirect($this->Auth->redirect());
            }
        }
    }

    /**
     * admin_logout
     * 
     * @return void
     */
    public function admin_logout() {
        if ($this->Auth->logout()) {
            return $this->redirect($this->Auth->redirect());
        }
    }

    /**
     * admin_reset_password
     * 
     * @param  $id User ID
     * @return void
     */
    public function admin_reset_password($id = null) {
        if (!$id) {
            $this->Session->setFlash(__d('admin', 'Invalid ID'), 'flash_error');
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->request->data)) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__d('admin', 'password was saved.'), 'flash_success');
                $this->redirect(array('action' => 'index'));
            }
        }
    }

    /**
     * admin_delete
     * 
     * @param $id User ID
     * @return void
     */
    public function admin_delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__d('admin', 'Invalid ID!'), 'flash_error');
            $this->redirect(array('action' => 'index'));
        }
        if ($this->User->delete($id)) {
            $this->Session->setFlash(__d('admin', 'User was deleted.'), 'flash_success');
            $this->redirect(array('action' => 'index'));
        }
    }

}

?>
