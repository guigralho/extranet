<?php
App::uses('CakeEmail', 'Network/Email');

class EmailComponent extends Component {

  public function send($dados){
    $email = new CakeEmail();

    $email->config($dados['config']);

    $email->to($dados['viewVars']['email']);
    $email->subject($dados['subject']);
    $email->viewVars($dados['viewVars']);
    $email->template($dados['template']);
    $email->emailFormat('html');

    if ($email->send()) {
      return true;
    } else {
      return false;
    }
  }
}
?>
