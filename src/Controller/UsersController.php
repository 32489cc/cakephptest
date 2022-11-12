<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;


/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->addUnauthenticatedActions(['login']);
    }

    public function login(){
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();
        // POST, GETを問わず、ユーザーがログインしている場合はリダイレクトします
        if ($result->isValid()) {
            // ログインに成功した場合、打刻画面にリダイレクトします
            $redirect = $this->request->getQuery('redirect', [
                'controller' => 'Rosters',
                'action' => 'stamp',
            ]);

            return $this->redirect($redirect);
        }
        // ユーザーがsubmit後、認証失敗した場合は、エラーを表示します
        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error(__('Invalid username or password'));
        }
    }

    /**
     * logout method
     */
    public function logout(){
        $result = $this->Authentication->getResult();
        // POST, GETを問わず、ユーザーがログインしている場合はリダイレクトします
        if ($result->isValid()) {
            $this->request->getSession()->destroy();
            $this->Authentication->logout();
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }
    }
    public function index()
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('user'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->editInClosure($id);

    }
public function editInClosure($id){
    $user = $this->Users->get($id, [
        'contain' => [],
    ]);

    if ($this->request->is(['patch', 'post', 'put'])) {
        $result = true;
        //
        $identity = $this->request
            ->getAttribute('identity');
        // ユーザー変更履歴を生成する
        $this->UserChangeLogs=$this->fetchTable('UserChangeLogs');
        $userChangeLog = $this->UserChangeLogs->newEmptyEntity();
        $userChangeLog->action = 'edit';
        $userChangeLog->before_value = serialize($user);
        $userChangeLog->modified_user = $identity->get('username');
        $userChangeLog->created_user = $identity->get('username');

        $user = $this->Users->patchEntity($user, $this->request->getData());
        $userChangeLog->after_value = serialize($user);

        // トランザクション開始
        $conn = $this->Users->getConnection();
        $conn->begin();

        // ユーザーデータの保存
        if ($this->Users->save($user)) {
            $this->Flash->success(__('ユーザーを保存しました。'));
        } else {
            $this->Flash->error(__('ユーザーが保存できませんでした。'));
            $result = false;
        }

        // ユーザー変更ログの保存
        if ($this->UserChangeLogs->save($userChangeLog)) {
            $this->Flash->success(__('ユーザー変更ログを保存しました。'));
        } else {
            $this->Flash->error(__('ユーザー変更ログが保存できませんでした。'));
            $result = false;
        }

        // エラーが無ければ一覧画面に遷移する
        if ($result) {
            $conn->commit();
            return $this->redirect(['action' => 'index']);
        } else {
            $this->Flash->error(__('ユーザーとユーザー変更ログの両方の保存が成功しなかったためロールバックしました。'));
            $conn->rollback();
        }
    }
    $this->set(compact('user'));

}
    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
