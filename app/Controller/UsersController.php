<?php
class UsersController extends AppController {
	public $helpers = array('Html', 'Form', 'Session');
	public $components = array('Paginator', 'Permission', 'Email');
	public $uses = array('User', 'Status', 'Group');

	public $paginate = array(
			'limit' => 10,
			'order' => array(
					'User.name' => 'asc'
			)
	);

	public function beforeFilter() { 
		parent::beforeFilter(); 
		$this->Auth->allow('forgot_password'); 
	}

	public function index() {
		$this->Permission->check(1, "leitura")? "" : $this->redirect("/not_allowed");
		$this->Paginator->settings = $this->paginate;

		$condition = ["and" => [], "or" => []];

		if(isset($_GET['q']) and $_GET['q'] != ""){
			$condition['or'] = array_merge($condition['or'], ['User.name LIKE' => "%".$_GET['q']."%", 'User.username LIKE' => "%".$_GET['q']."%"]);
		}

		if(isset($_GET["t"]) and $_GET["t"] != ""){
			$condition['and'] = array_merge($condition['and'], ['Status.id' => $_GET['t']]);
		}

		// similar to findAll(), but fetches paged results
		$data = $this->Paginator->paginate('User', $condition);
		$this->set('data', $data);

		$status = $this->Status->find('all', array('conditions' => array('Status.categoria' => 1)));
		$this->set('status', $status);
	}

	public function add() {
		$this->Permission->check(1, "escrita")? "" : $this->redirect("/not_allowed");
		if ($this->request->is('post')) {
			$this->User->create();
			if($this->User->validates()){
				$this->request->data['User']['user_creator_id'] = CakeSession::read("Auth.User.id");
				if ($this->User->save($this->request->data)) {
					$id = $this->User->id;

					$this->envia_email($this->request->data);

					$this->Session->setFlash(__('O usuário foi salvo com sucesso'), 'default', array('class' => "alert alert-success"));
					$this->redirect(['action' => 'edit/'.$this->User->id]);
				} else {
					$this->Session->setFlash(__('O usuário não pode ser salvo, Por favor tente de novo.'), 'default', array('class' => "alert alert-danger"));
				}
			} else {
				$this->Session->setFlash(__('O usuário não pode ser salvo, Por favor tente de novo.'), 'default', array('class' => "alert alert-danger"));
			}
		}

		$statuses = $this->Status->find('list', array('conditions' => array('Status.categoria' => 1)));
		$groups = $this->Group->find('list');

		$senha = substr(sha1(time()), 0, 6);

		$this->set('senha', $senha);
		$this->set('statuses', $statuses);
		$this->set('groups', $groups);
		$this->set("action", "Novo usuário");
		$this->set("form_action", "add");
	}

	public function edit($id = null) {
		$this->Permission->check(1, "escrita") ? "" : $this->redirect("/not_allowed");
		$this->User->id = $id;
		if ($this->request->is('post')) {
			$this->User->validates();
			
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('O usuário foi alterado com sucesso'), 'default', array('class' => "alert alert-success"));
			} else {
				$this->Session->setFlash(__('O usuário não pode ser alterado, Por favor tente de novo.'), 'default', array('class' => "alert alert-danger"));
			}
		}

		$temp_errors = $this->User->validationErrors;
		$this->request->data = $this->User->read();
		$this->User->validationErrors = $temp_errors;

		$groups = $this->Group->find('list');
		$this->set('groups', $groups);
		
		$statuses = $this->Status->find('list', array('conditions' => array('Status.categoria' => 1)));
		$this->set('statuses', $statuses);

		$this->set("action", $this->request->data['User']['name']);
		$this->set("form_action", "edit");
		$this->set("id", $id);
		
		$this->render("add");
	}

	public function delete($id){
		$this->Permission->check(1, "excluir")? "" : $this->redirect("/not_allowed");
		$this->User->id = $id;
		$this->request->data = $this->User->read();

		$this->request->data['User']['data_cancel'] = date("Y-m-d H:i:s");
		$this->request->data['User']['usuario_id_cancel'] = CakeSession::read("Auth.User.id");

		if ($this->User->save($this->request->data)) {
			$this->Session->setFlash(__('O usuário foi excluído com sucesso'), 'default', array('class' => "alert alert-success"));
			$this->redirect(array('action' => 'index'));
		}
	}

	public function reenviar_senha($id) {

		$this->User->id = $id;
		$this->request->data = $this->User->read();

		$senha = substr(sha1(time()), 0, 6);

		$this->request->data['User']['password'] = $senha;
		$this->request->data['User']['primeiro_acesso'] = 1;
		
		if ($this->User->save($this->request->data)) {
			$this->envia_email($this->request->data);
			$this->Session->setFlash(__('Senha reenviada com sucesso'), 'default', array('class' => "alert alert-success"));
			$this->redirect(array('action' => 'index'));
		}
	}

	public function envia_email($data) {
		$dados = array('viewVars' => array('nome'  => $data['User']['name'],
																			 'email' => $data['User']['username'],
																			 'senha' => $data['User']['password'],
																			 'link'  => 'http://interaktiv.com.br/'
																			),
									 'template' => 'nova_senha',
									 'subject'  => '[TESTE] Nova Senha',
									 'config'   => 'default'
									);
		debug($dados);die(); 
		if (!$this->Email->send($dados)) {
			$this->Session->setFlash(__('Email não pôde ser enviado com sucesso'), 'default', array('class' => "alert alert-danger"));
			$this->redirect(array('action' => 'index'));
		}
	}

	public function change_password(){

		if ($this->request->is('post')) {
			$this->User->id = CakeSession::read("Auth.User.id");
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash('A senha foi alterada com sucesso.', 'default', array('class' => "alert alert-success"));
				$this->redirect(array('action' => 'index'));
			}
		}

		$this->set("action", "Alterar Senha");
		$this->set("form_action", "../users/change_password");
	}

	public function primeiro_acesso(){

		if ($this->request->is('post')) {
			$this->User->id = CakeSession::read("Auth.User.id");

			$this->request->data['User']['primeiro_acesso'] = 0;

			if ($this->User->save($this->request->data)) {
				CakeSession::write("Auth.User.primeiro_acesso", $this->request->data['User']['primeiro_acesso']);
				$this->Session->setFlash('A senha foi alterada com sucesso.', 'default', array('class' => "alert alert-success"));
				$this->redirect("/dashboard");
			}
		}

		$this->Session->setFlash('Este é o seu primeiro acesso! Altere sua senha para continuar.', 'default', array('class' => "alert alert-success"));

		$this->set("action", "Primeiro acesso");
		$this->set("form_action", "users/primeiro_acesso");
		$this->render("change_password");
	}

	public function login() {
		$this->layout = "login";

		if ($this->request->is('post')) { 
			$dados = $this->request->data;
			if ($this->Auth->login()) {
				$user = $this->User->find("first", array('conditions' => array('User.username' => $dados['User']['username'])));
				CakeSession::write("Auth.User.primeiro_acesso", $user['User']['primeiro_acesso']);
				if ($user['User']['primeiro_acesso'] == 1) {
					$this->redirect("/users/primeiro_acesso");
				} else {
					$this->redirect("/dashboard");
				}

			} else {
				$this->Session->setFlash(__('Usuário e senha incorretos'), "default", array("class" => "alert alert-danger"));
				$this->redirect("/");
			}
		}
	}

	public function logout() {
	 $this->redirect($this->Auth->logout());
	}

	public function forgot_password(){
		$this->layout = "login";

		if ($this->request->is('post')) {
			$user = $this->User->find("first", array('conditions' => array('User.username' => $this->request->data['User']['username'])));
			if ($user) {
				$this->reenviar_senha($user['User']['id']);
			} else {
				$this->Session->setFlash(__('Email não cadastrado'), 'default', array('class' => "alert alert-danger"));
			}
		}
	}
}