<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * UserChangeLogs Controller
 *
 * @property \App\Model\Table\UserChangeLogsTable $UserChangeLogs
 * @method \App\Model\Entity\UserChangeLog[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UserChangeLogsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $userChangeLogs = $this->paginate($this->UserChangeLogs);

        $this->set(compact('userChangeLogs'));
    }

    /**
     * View method
     *
     * @param string|null $id User Change Log id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $userChangeLog = $this->UserChangeLogs->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('userChangeLog'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $userChangeLog = $this->UserChangeLogs->newEmptyEntity();
        if ($this->request->is('post')) {
            $userChangeLog = $this->UserChangeLogs->patchEntity($userChangeLog, $this->request->getData());
            if ($this->UserChangeLogs->save($userChangeLog)) {
                $this->Flash->success(__('The user change log has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user change log could not be saved. Please, try again.'));
        }
        $this->set(compact('userChangeLog'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User Change Log id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $userChangeLog = $this->UserChangeLogs->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $userChangeLog = $this->UserChangeLogs->patchEntity($userChangeLog, $this->request->getData());
            if ($this->UserChangeLogs->save($userChangeLog)) {
                $this->Flash->success(__('The user change log has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user change log could not be saved. Please, try again.'));
        }
        $this->set(compact('userChangeLog'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User Change Log id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $userChangeLog = $this->UserChangeLogs->get($id);
        if ($this->UserChangeLogs->delete($userChangeLog)) {
            $this->Flash->success(__('The user change log has been deleted.'));
        } else {
            $this->Flash->error(__('The user change log could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
