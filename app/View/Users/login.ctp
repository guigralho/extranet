<div class="login-box">
  <div class="login-logo">
    <b>Extranet</b>
  </div><!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Form->create('User', array("class" => "form-horizontal"));?>
      <div class="form-group has-feedback">
        <input type="email" name="data[User][username]" class="form-control" placeholder="E-mail" required="" autofocus="">
        <span class="fa fa-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="data[User][password]" class="form-control" placeholder="Senha" required="">
        <span class="fa fa-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <a href="<?php echo $this->base.'/users/forgot_password' ?>">Esqueci minha senha</a><br>
        </div>
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div><!-- /.col -->
      </div>
    </form>

  </div><!-- /.login-box-body -->
</div>