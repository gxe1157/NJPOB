<?php 

    if($mess) {
      $show_mess = "<p style='text-align: center;'>We could activate your account.<br>Click below to receive a new activation<br>code by email.</p>";
      $btn_value = "Send New Activate Account Code";
    }else{
      $show_mess = "<h3 style='text-align: center;'>Forgot Password?</h3><p>You can reset your password here.</h3>";
      $btn_value = "Send My Password.";
    }                  

    $message = '<div class="alert alert-danger" role="alert">'.$show_mess.'</div>';
    $div_style= ( isset($flash) && !empty($flash) ) ? "display: none; " : " display: block; ";

?>

<div class="row">
  <div class="col-md-4 col-md-offset-4" style="height:420px; text-align: left;">
      <?= $message ?> 

      <div style='<?= $div_style ?>' >
      <form class="form-signin"
            action="<?= base_url() ?>youraccount/forgot_password"
            method="POST">
        <input type="hidden" name="mess" value="<?= $mess ?>">

        <fieldset>
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon">
              <i class="glyphicon glyphicon-envelope color-blue"></i></span>
              
              <input id="emailInput" name="email" placeholder="email address"
                     class="form-control" type="text">
            </div>
            <?= validation_errors("<p style='color: red;'>", "</p>"); ?>            
          </div>
          <div class="form-group">
            <input type="submit" class="btn btn-lg btn-primary btn-block" name="submit"
                   value="<?= $btn_value ?>">
          </div>
        </fieldset>
      </form>
      </div>

      <?php if( isset($flash) ) echo $flash; ?>

  </div>
</div>

