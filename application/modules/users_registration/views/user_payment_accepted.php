
<div class="col-md-2">&nbsp;</div>
<div  class="col-md-8">
    <h3>Successful Dues Payments Made and Received.<br>
    <small>Your Transaction Id: <?= $tranactionid ?></small></h3>

    An email has been sent to <span style="color: green; font-weight: bold;" ><?= $email ?>,</span> to confirm your payment has been received.</p>

    <p>You may now continue to the application section or exit. If you choose to exit at this point, in the email that was sent, a link has been provided to grant you access to the member area where you will be directed to the application.</p>
    <br>
    <p style="text-align: center"><u>Thank you for being a part of our family that we call</u><br><span STYLE="font-family: Comic Sans MS, serif; font-size: 16pt;">&ldquo;The brotherhood&rdquo;</span></p>    
    <br />
    <br />
    <ul class="list-inline pull-right">
      <li><a href="<?= base_url() ?>youraccount/logout"
             class="btn btn-default"
             role="button">Exit</a></li>
      <li><a href="<?= base_url() ?>users_application"
             class="btn btn-primary"
             role="button">Go to Application</a></li>

    </ul>
    <br />
</div>

<div class="clear"></div>
