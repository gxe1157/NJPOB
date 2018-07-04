
<div class="row">
  <div class="col-md-4 col-md-offset-4" style="height:420px;">
      <?= $this->session->flashdata('item'); ?>

      <form class="form-signin" action="<?= base_url() ?>auth/login" method="POST">
        <input type="hidden" name="mode" value="0" />
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputText" class="sr-only">Username or Email address</label>
        <input type="text" id="inputText" class="form-control"
               name="identity" placeholder="Username or Email address"
               autofocus>
        <!-- Show errors here -->
        <span><?= form_error('identity', '<div class="error" style="color: red;">', '</div>'); ?></span>

        <label for="inputPassword" class="sr-only">Password</label>
        <br />
        <input type="password" id="inputPassword" class="form-control"
               name = "password" placeholder="Password"
               autocomplete="new-password">
        <!-- Show errors here -->
        <span><?= form_error('password', '<div class="error" style="color: red;">', '</div>'); ?></span>

        <br />       
        <div class="col-xs-12 col-sm-12 col-md-12">
           <div class="col-xs-6 col-sm-6 col-md-6">
              <div class="form-group">
                  <input type="checkbox" value="remember-me"> Remember me
              </div>
           </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
              <div class="form-group">
                 <a href="<?= base_url() ?>youraccount/forgot_password"> Forgot Password? </a>
              </div>
           </div>
        </div>
        <button class="btn btn-lg btn-primary btn-block" 
                type="submit" name="submit" value="Submit">Sign in
        </button>

      </form>
  </div>
</div>

