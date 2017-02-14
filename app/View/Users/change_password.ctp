<div class="box box-info">
  <!-- form start -->
  <?php echo $this->Form->create('User', array("id" => "js-form-submit", "class" => "form-horizontal", "url" => "/".$form_action."/", "method" => "post")); ?>
    <div class="box-body">
      <div class="form-group">
        <label for="inputPassword" class="col-xs-12 col-sm-3 col-md-2 control-label">Nova senha</label>
        <div class="col-sm-9">
          <?php echo $this->Form->input('password', array("div" => false, "label" => false, "id" => "inputPassword", "placeholder" => "Nova senha", "class" => "form-control"));?>
        </div>
      </div>

      <div class="form-group">
        <label for="inputConfPassword" class="col-xs-12 col-sm-3 col-md-2 control-label">Confirmar Senha</label>
        <div class="col-sm-9">
          <input type="password" class="form-control" id="inputConfPassword" placeholder="Confirmar Senha">
          <span class="help-block" style="display:none">As senhas devem coincidir</span>
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-9">
          <a href="<?php echo $this->base; ?>" class="btn btn-default">Voltar</a>
          <button type="submit" class="btn btn-success js-salvar" data-loading-text="Aguarde...">Salvar</button>
        </div>
      </div>
    </div><!-- /.box-body -->
  </form>
</div><!-- /.box -->

<script>
  $(document).ready(function(){
       
    $("#js-form-submit").on("submit", function(){
      $("#inputConfPassword").parent().find(".help-block").hide();

      if($("#inputPassword").val() != $("#inputConfPassword").val()){
        $("#inputConfPassword").parent().parent().addClass("has-error");

        $("#inputConfPassword").parent().find(".help-block").show();
        event.preventDefault();
      } else {
        var $el = $(".js-salvar");

        $el.button('loading');

        setTimeout(function(){$el.button('reset')},6000);
      }

    })
  })
</script>