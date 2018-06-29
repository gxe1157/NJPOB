<div class="row">
    <div class="col-md-2" >
        <img src="<?= base_url().'upload/'.$user_avatar ?>"
             class="img-responsive img-thumbnail"
             style="width: 100%;"
             alt="avatar"  
             id="previewImg">
            <h2 style="margin-top: -5px;">
              <small><?= $fullname.' [ '.$member_id .' ]' ?></small>
            </h2>
    </div>     
    <div class="col-md-9" style="padding: 5x;">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.
        <div class="row">
            <div class="col-md-12 required_docs" style="margin-top: 100px; display: block;">
                    <?= $alert_mess ?>
            </div>    
        </div>    
    </div>   
</div>

