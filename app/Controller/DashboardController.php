<?php
App::uses('AppController', 'Controller');
class DashboardController extends AppController {
	public $uses = array();

	public function index(){

		$this->set('action', 'Dashboard');
	}
}
