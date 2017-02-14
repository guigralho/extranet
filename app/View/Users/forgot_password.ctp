<div class="login-box">
  <div class="login-logo">
    <b>Extranet</b>
  </div><!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Esqueci minha senha</p>
    <?php echo $this->Form->create('User');?>
      <?php echo $this->Session->flash(); ?>
      <div class="form-group has-feedback">
        <input type="email" name="data[User][username]" class="form-control" placeholder="E-mail" required="" autofocus=""/>
        <span class="fa fa-envelope form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Reenviar</button>
        </div><!-- /.col -->
      </div>
    </form>

  </div><!-- /.login-box-body -->
</div><!-- /.login-box -->