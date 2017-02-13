<div class="page-signin">

	<div class="signin-header" style="color: white;background-color: rgb(118, 17, 19);">
		<div class="container text-center">
			<section class="logo">
				<img width="199" src="<?php echo $this->base ?>/img/logo.svg" alt="" style="margin-bottom: 5px;">
			</section>
		</div>
	</div>

	<div class="signin-body">
		<div class="container">
			<div class="form-container">

				<?php echo $this->Form->create('User', array("class" => "form-horizontal"));?>
					<fieldset>
						<div class="form-group">
							<?php echo $this->Session->flash(); ?>
							
							<div class="input-group input-group-lg">
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-envelope"></span>
								</span>
								<input type="email" name="data[User][username]" class="form-control logpadding" placeholder="E-mail" required="" autofocus=""/>
							</div>
						</div>

						<div class="form-group">
							<div class="input-group input-group-lg">
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-lock"></span>
								</span>
								<input type="password" name="data[User][password]" class="form-control logpadding" placeholder="Senha" required=""/>
							</div>
						</div>
						<div class="form-group"></div>
						<div class="form-group">
							<button type="submit" class="btn btn-login btn-lg btn-block">Entrar</button>
						</div>
					</fieldset>
				</form>

				<section>
					<p class="text-center">
						<a href="<?php echo $this->base.'/users/forgot_password' ?>">Esqueceu sua senha?</a>
					</p>
				</section>

			</div> <!-- /form-container -->
		</div> <!-- /container -->
	</div> <!-- /signin-body -->
</div> <!-- /page-signin -->