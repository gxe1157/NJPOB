<style>
  .form-style-fake{position:absolute;top:0px;}
  .form-style-base{position:absolute;top:0px;z-index: 999;opacity: 0;}
  .fake-styled-btn{
      background: #006cad;
      padding: 10px;
      color: #fff; }
</style>

<div class="col-sm-2" style="min-height: 450px;">
    <div class="text-center" style="margin-top: 6px;">
       <form id="upload-image-avatar" enctype="multipart/form-data">
          <input type="hidden" id="user_avatar" value ="<?= $user_avatar ?>" >
          <input type="hidden" id="update_id" name="update_id" value ="<?= $update_id ?>" >

          <!-- "../public/images/annon_user.png"  -->
          <img src="<?= base_url() ?>upload/avatars/<?= $user_avatar ?>";
               class="avatar img-thumbnail"
               style="width: 200px; height:150px;"
               alt="avatar"
               id="previewImg">

          <!-- upload file input  -->
          <div class="col-sm-12"
               id="pre_upload"
               style="display: block">

              <input type="file"
                     id="avatar"
                     name="file"
                     class="form-control form-input form-style-base">

              <h5 id="fake-btn" class="form-input fake-styled-btn text-center">
              <span class="margin">Choose File</span></h5>
          </div>
          <!-- upload file input  -->

          <div class="caption" id="confirm_upload"
               style="display: none; margin-top: 8px; padding-bottom: 0px;">
                <a href="#" >
                    <button class="btn btn-md btn-success btn-sm" id="upload-button"
                            type="submit">Upload image</button>
                </a>
                <a href="#" >
                   <button type="button" id='cancelImg'
                           class="btn btn-default btn-sm">Cancel</button>
                </a>
          </div>

          <div id="message"></div>
       </form>
    </div>
  

    <div class="profile-usermenu" id="profile_div"  style="margin-top: -20px;">
        <center><h2><small><?= $fullname ?></small></h2></center>
        <ul class="nav">
          <li class="active">
            <a id ='profile'
               href="<?= base_url() ?>member_profile">
               <i class="glyphicon glyphicon-user"></i> Overview </a>
          </li>
          <li>
            <!-- site_users/member_upload -->
            <a id ='Upload'
               href="<?= base_url() ?>site_users/member_upload">
               <i class="glyphicon glyphicon-upload"></i> Upload Files </a>
          </li>
          <li>
            <a id ='remove_avatar'
               href="#">
               <i class="fa fa-eraser" aria-hidden="true"></i> Avatar Reset</a>
          </li>
          <li>
            <a id ='change_password'
               href="<?= base_url() ?>password_reset">
               <i class="fa fa-key fa-lg" aria-hidden="true"></i> Change Password</a>
          </li>
          <li>
            <a id ='car_shields'
               href="<?= base_url() ?>car_shields/member_manage">
               <i class="fa fa-shield fa-lg" aria-hidden="true"></i>  Car Shields</a>
          </li>
          <li>
            <a id ='link4'
               href="<?= base_url() ?>legislative_outreach/member_manage">
               <i class="fa fa-thumbs-up fa-lg" aria-hidden="true"></i> Legislative OutReach Program</a>
          </li>
          <li>
            <a id ='link4'
               href="<?= base_url() ?>business_listings/member_manage">
               <i class="fa fa-briefcase fa-lg" aria-hidden="true"></i> Business Network </a>
          </li>
          <br>
      </ul>
  </div>

</div>
