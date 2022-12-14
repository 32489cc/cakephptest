<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\I18n\FrozenTime;

/**
 * Rosters Controller
 *
 * @property \App\Model\Table\RostersTable $Rosters
 * @method \App\Model\Entity\Roster[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RostersController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->addUnauthenticatedActions(['stamp']);
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
       $auth=$this->request->getSession()->read('Auth');

       if(!$auth){
           return $this->$this->redirect(['Controller'=>'Users','action'=>'logout']);
       }
       $rosters=$this->Rosters->find()
           ->select(['id','start_time','end_time','status','reason'])
           ->where(['Rosters.users_id'=>$auth->id])
           ->order(['Rosters.created'=>'asc']);
       $this->set(compact('rosters'));
    }

    /**
     * View method
     *
     * @param string|null $id Roster id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $roster = $this->Rosters->get($id, [
            'contain' => ['Users'],
        ]);

        $this->set(compact('roster'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $roster = $this->Rosters->newEmptyEntity();
        if ($this->request->is('post')) {
            $roster = $this->Rosters->patchEntity($roster, $this->request->getData());
            if ($this->Rosters->save($roster)) {
                $this->Flash->success(__('The roster has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The roster could not be saved. Please, try again.'));
        }
        $users = $this->Rosters->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('roster', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Roster id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $roster = $this->Rosters->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $roster = $this->Rosters->patchEntity($roster, $this->request->getData());
            if ($this->Rosters->save($roster)) {
                $this->Flash->success(__('The roster has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The roster could not be saved. Please, try again.'));
        }
        $users = $this->Rosters->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('roster', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Roster id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $roster = $this->Rosters->get($id);
        if ($this->Rosters->delete($roster)) {
            $this->Flash->success(__('The roster has been deleted.'));
        } else {
            $this->Flash->error(__('The roster could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    /**
     * ??????
     */
    public function stamp()
    {
        // Layout?????????
        $this->viewBuilder()->setLayout('roster');

        if ($this->request->is(['patch', 'post', 'put'])) {
            // ?????????????????????
            $username = $this->request->getData('username');
            $kubun = $this->request->getData('kubun');

            // account??????????????????ID??????
            $this->Users = $this->fetchTable('Users');
            $user = $this->Users->find()->where(['username' => $username])->first();

            if (!$user) {
                $this->Flash->error('??????????????????????????????????????????????????????');
                return;
            }

            // ???????????????????????????
            $now = new FrozenTime();
            $roster = $this->Rosters->find()
                ->where(['users_id' => $user->id])
                ->where(['start_time >=' =>  $now->i18nFormat('yyyy-MM-dd') . ' 00:00:00'])
                ->where(['start_time <' =>  $now->addDay(1)->i18nFormat('yyyy-MM-dd') . ' 00:00:00'])
                ->order(['created' => 'desc'])
                ->first();

            // ????????????????????????????????????????????????????????????????????????
            if (isset($roster)) {
                if ($roster->start_time != NULL and $roster->end_time != NULL) {
                    $this->Flash->error('??????????????????????????????');
                    return;
                }
            }

            // ?????????????????????patch?????????????????????
            $tmpArr = array();
            $msg = '';

            // ????????????ID????????????
            $tmpArr['users_id'] = $user->id;

            // ?????????????????????????????????????????????????????????????????????
            if ($kubun === 'sta') {
                if (isset($roster)) {
                    $this->Flash->error('??????????????????????????????');
                    return;
                } else {
                    $tmpArr['start_time'] = $now;
                    $msg = '??????????????????????????????';
                    $roster = $this->Rosters->newEmptyEntity();
                }
            } elseif ($kubun === 'end') {
                if (isset($roster)) {
                    $tmpArr['end_time'] = $now;
                    $msg = '???????????????????????????';
                } else {
                    $this->Flash->error('?????????????????????????????????');
                    return;
                }
            }

            // ?????????????????????????????????????????????
            $roster = $this->Rosters->patchEntity($roster, $tmpArr);
            if ($this->Rosters->save($roster)) {
                $this->Flash->success($msg);
            } else {
                $this->Flash->error('??????????????????????????????????????????');
            }
        }
    }
}
