<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use App\Model\Entity\User;
use Cake\Auth\DefaultPasswordHasher;
use App\Utility\Mailer;
use Cake\Mailer\Email;
use Cake\Routing\Router;
use Cake\Datasource\EntityInterface;
/**
 * Accounts Controller
 *
 * @property \App\Model\Table\AccountsTable $Accounts
 */
class AccountsController extends AppController
{
    public function beforeFilter(Event $event)
    {
        $this->Auth->allow(['logout', 'register','login', 'resetPassword', 'passRecovery']);
    }
    
    public function initialize()
    {
        parent::initialize();
        // Добавили logout в список разрешенных экшенов.
        $this->Auth->allow(['logout']);
    }
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'conditions' =>[
                'Accounts.id' => $this->Auth->user('id')],
    
            //'contain' => ['Categories', 'Accounts']
        ];
        $accounts = $this->paginate($this->Accounts);
        $accounts->id = $this->Auth->user('id');
        $this->set(compact('accounts'));
        $this->set('_serialize', ['accounts']);
        
        
    }
    /**
     * View method
     *
     * @param string|null $id Account id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
      
        $account = $this->Accounts->get($id, [
            'contain' => ['Sites']
        ]);

        $this->set('account', $account);
        $this->set('_serialize', ['account']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $account = $this->Accounts->newEntity();
        if ($this->request->is('post')) {
            $account = $this->Accounts->patchEntity($account, $this->request->getData());
            $account->account_id = $this->Auth->user('id');
            if ($this->Accounts->save($account)) {
                $this->Flash->success(__('The account has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
            $this->Flash->error(__('The account could not be saved. Please, try again.'));
        }
        }
        $this->set(compact('account'));
        $this->set('_serialize', ['account']);
         
    }
    
    /**
     * Edit method
     *
     * @param string|null $id Account id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)//Изменение (редактирование)
    {
        $account = $this->Accounts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $account = $this->Accounts->patchEntity($account, $this->request->getData());
            $account->account_id = $this->Auth->user('id');
            if ($this->Accounts->save($account)) {
                $this->Flash->success(__('The account has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The account could not be saved. Please, try again.'));
        }
        
        $this->set(compact('account', $account));
        $this->set('_serialize', ['account']);
    
    }
    
    /**
     * Delete method
     *
     * @param string|null $id Account id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $account = $this->Accounts->get($id);
        if ($this->Accounts->delete($account)) {
            $this->Flash->success(__('The account has been deleted.'));
        } else {
            $this->Flash->error(__('The account could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
    
    
    public function logout()
    {
        $this->Flash->success('Вы вышли из своей учетной записи.');
        return $this->redirect($this->Auth->logout());
      
    }
 
  
    public function login()
    {
        if ($this->request->is('post')) {
             $account = $this->Auth->identify();
            if ( $account) {
                $this->Auth->setUser($account);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error('Ваше имя пользователя или пароль не верны.');
        }
    }
   
    public function register($type = '') 
    {
        $this->_register($type);
    }
    
    public function _register($type)
    {
        $account = $this->Accounts->newEntity();
        if ($this->request->is('post')) {
            $account = $this->Accounts->patchEntity($account, $this->request->getData());
            $account->type = $type;
            
            
            if ($this->Accounts->save($account)) {
               // $this->_setMessage('success', "Пользователь зарегистрирован");
               $this->Auth->setUser($account->toArray());
               return $this->redirect(['controller' => 'Sites', 'action' => 'index']);
            }
            
            $this->_setMessage('error', "Пользователь не зарегистрирован. Попробуйте снова");
        }
       
        if (!$this->request->is('post')) return;
        
        $data = $this->request->data;
       
        if (empty($data['email'])) {
            $this->_setMessage('error', __('У вас не указана электронная почта'));
            return;
        }
         
        $account = $this->Accounts->findByEmail($data['email'])->first();
        
        if ($account && !is_null($account->password)) {
            $this->_setMessage('error', "Пользователь с такой электронной почтой уже зарегистрирован");
            return;
        }
      
       if (!$this->checkPasswords($data)) return;

       if (null === $account) $account = $this->Accounts->newEntity($this->request->data);
       else  $account->set('password', $data['password']);
    }
    
    private function checkPasswords($data) {
        if (empty($data['password'])) {
            $this->_setMessage('error', 'Вы не указали пароль');
            return false;
       }
        //подтвердить пароль
        if (empty($data['password_confirm'])) {
            $this->_setMessage('error', 'Вы не повторили пароль');
            return false;
            // TODO: throw an exception
        }

        if ($data['password'] !== $data['password_confirm']) {
            $this->_setMessage('error', 'Пароли не совпадают');
            return false;
        }
        //TODO: add detecting as password strong

        return true;
    }
    
    protected function _setMessage($type, $message) 
    {
        if ($type === 'success') {
            $this->Flash->success($message);
        } else if ($type === 'error') {
            $this->Flash->error($message);
        } else {
            throw new \Exception("Error: undefined notification message type $type", 1);                
        }
        
    }
    
   //Востановление пароля
    public function passRecovery()
    {
        $this->_password();
    }
    
    public function _password()
    {
        if ($this->request->is('post')) {
               $account = $this->Accounts->findByEmail($this->request->data['email'])->first();
               if (is_null($account)) {
                   $this->Flash->error('Адрес эл. Почты не существует. Пожалуйста, попробуйте еще раз');
               } else {
                    $resetPasskeyUId = bin2hex(openssl_random_pseudo_bytes (15));
                    $url = Router::Url([
                       'controller' => 'accounts', 
                       'action' => 'resetPassword'
                    ], true) . '/' . $resetPasskeyUId;
                   
                    $resetRequest = $this->Accounts->PasswordsResets->newEntity([
                       'account_id' => $account->id,
                       'reset_passkey_uid' => $resetPasskeyUId
                    ]);
                    
                    if ($this->Accounts->PasswordsResets->save($resetRequest)) {
                        $this->sendResetEmail($url, $account);
                        $this->redirect(['action' => 'login']);
                    } else {
                       $this->Flash->error('Ошибка при создании запроса на восстановление пароля');
                   }
               }
           }
       }
    //Отправить Сброс электронной почты
    private function sendResetEmail($url, $account) 
    {
        $email = new Email();
        $email->template('resetpw');//шаблон
        $email->emailFormat('both');
        $email->from('no-reply@naidim.org');
        $email->to($account->email);
        $email->subject('Сброс пароля');
        $email->viewVars(['url' => $url, 'username' => $account->email]);
        if ($email->send()) {
            $this->Flash->success(__('Проверьте свою электронную почту для восстановления  пароля'));
        } else {
            $this->Flash->error(__('Ошибка при отправке электронной почты: ') . $email->smtpError);
        }
    }
    //сброс пароля
    public function resetPassword($resetPasskeyUId = null) 
    {
        $resetRequest = $this->Accounts->PasswordsResets
            ->find('all')
            ->where(['reset_passkey_uid' => $resetPasskeyUId, 'active' => true])
            ->contain(['Accounts'])
            ->last();
        
        if (!$resetRequest || empty($resetRequest->account)) {
            $this->Flash->error('Недопустимый или устаревший ключ доступа. Проверьте электронную почту или повторите попытку.');
            $this->redirect(['action' => 'pass_recovery']);
        } 
        
        if ($this->request->is('post')) {
            if ($resetPasskeyUId) {
                
                $password = $this->request->getData('password');
                // TODO: add trim password to login and register
                $passwordConfirm = $this->request->getData('password_confirm');
                
                if ($password !== $passwordConfirm) {
                    $this->Flash->error(__('Не совпадают пароли. Пожалуйста, попробуйте еще раз.'));

                    return;
                }

                $account = $resetRequest->account;
                $account->password = $password;

                if ($this->Accounts->save($account)) {
                    $this->Accounts->PasswordsResets->updateAll(
                        ['active' => false],
                        ['account_id' => $account->id]
                        );

                     
                 
                    $this->Flash->set(__('Ваш пароль был обновлен.'));
                    return $this->redirect(array('action' => 'login'));
                } else {
                    $this->Flash->error(__('Не удалось обновить пароль. Пожалуйста, попробуйте еще раз.'));
                }
                
                $this->set(compact('accounts'));
          
            } else {
                $this->redirect('/');
            }
        
        }
    }
    
    

    
    
    
    
    
}
