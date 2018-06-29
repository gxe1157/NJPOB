
<div  class="col-md-10">
<div class="table-container">
    <h3>Your Order has Been Placed.</h3>
    <table width="100%" cellpadding="3">
        <?PHP foreach($result_set as $flds=>$values){ if($flds=='email') $email = $values; ?>
            <tr>
                <th><?php echo $flds ?></th><td><?php echo $values ?></td>
            </tr>
        <?php } ?>
    </table>

    <p><br><b>Thanks you for placing your ad with us.</b><br><br>
    An email has been sent to <span class="hilite-green" ><?= $email; ?>,</span> to confirm your payment
    has been received along with a temporary USER ID and PASSWORD.
    Please use the assigned Userid and Password to login and upload your ad artwork by accessing the upload panel on the top right.<br /><br />

    <ul style="list-style:none;">
    <li>
    <a href="<?= base_url() ?>">Home Page</a>
    </li>
    </ul>
</div>
</div>


<div class="clear"></div>
