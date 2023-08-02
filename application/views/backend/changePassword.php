<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_content">

            <form method="post" action="<?php  echo base_url('admin/changePassword');?>"class="form-horizontal form-label-left" novalidate>
                <div class="item form-group">
              <label for="password" class="control-label col-md-3">Old Password <span class="required">*</span></label>
              <div class="col-md-4 col-sm-4 col-xs-12">
                <input name="oldpass" id="password" type="password"  class="form-control col-md-7 col-xs-12" required="required">
              </div>
            </div>
            <div class="item form-group">
              <label for="password" class="control-label col-md-3">New Password <span class="required">*</span></label>
              <div class="col-md-4 col-sm-4 col-xs-12">
                <input name="password" id="password" type="password"  class="form-control col-md-7 col-xs-12" required="required">
              </div>
            </div>
            <div class="item form-group">
              <label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12">Repeat Password <span class="required">*</span></label>
              <div class="col-md-4 col-sm-4 col-xs-12">
                <input name="password2"  id="password2" type="password" data-validate-linked="password" class="form-control col-md-7 col-xs-12" required="required">
              </div>
            </div>
            
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-md-offset-3">
                <button id="send" type="submit" class="btn btn-success">Submit</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>