
<div class="col-md-2">&nbsp;</div>
<div  class="col-md-8">
    <h3>Successful Payment made and Received.<br>
    <small>Your Transaction Id: <?= $transactionid ?></small></h3>

    An email has been sent to <span style="color: green; font-weight: bold;" ><?= $email ?>,</span> to confirm your payment has been received.</p>

    <p>Thank you for your interest in receiving a Motor Vehicle Shield. Your payment has been received and your form has been forwarded to the processing department. Please make sure to login and go to the membership portal to upload your picture, thumb print & documents needed to complete this process in order for the shield committee to make your membership credentials. You will be notified when your shield and credentials are ready for pick up or you give us the authorization to ship said shield packet directly to the address we have on file.
    </p>
    <br>
    <p style="text-align: center;">
        <u>Thank you for your time and attention to this matter and helping us bring back the true meaning of unity back to all first responders. Welcome to our family that we call
        </u>
        <br>
        <span STYLE="font-family: Comic Sans MS, serif; font-size: 16pt;">&nbsp; &ldquo;The brotherhood&rdquo;!</span>
    </p>

    <br />
    <br />
    <ul class="list-inline pull-right">
      <li><a href="<?= base_url() ?>auth/logout"
             class="btn btn-default"
             role="button">Exit</a></li>
      <li><a href="<?= base_url() ?>car_shields/car_shield_upload/<?= $new_insert_id ?>"
             class="btn btn-primary"
             role="button">Upload Documents</a></li>

    </ul>
    <br />
</div>

<div class="clear"></div>
