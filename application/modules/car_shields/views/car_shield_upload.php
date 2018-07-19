
<div class="row">
    <div class="col-md-12" >
        <div class="col-sm-4 col-md-3">
            <img style="margin-top: 20px; max-width:100%;"
                 src="<?= base_url() ?>public/images/shields/Shield_Law_NJ.jpg" />
        </div>

        <div class="col-sm-8 col-md-9">
            <p style="font-size: 1.2em;"><?= $fname ?>, please be sure to upload the items listed below in order to complete your application. We cannot process your Shield or ID Credentials until your membership is in compliance with our by-laws.</p> 
            <?= $this->load->view( 'site_upload/manage_uploads'); ?>

      </div>
    </div> <!-- //col-md-12 -->
</div> <!-- //row -->
        

