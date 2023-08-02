<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_content">

            <form method="post" action="<?php echo base_url('admin/updateProfile'); ?>"class="form-horizontal form-label-left" novalidate>
         
            
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">First Name <span class="required">*</span>
              </label>
              <div class="col-md-4 col-sm-4 col-xs-12">
                  <input name="firstName"  value="<?php if(isset($result)){echo $result['firstName'];}?>" id="name" class="form-control col-md-7 col-xs-12" required="required" type="text">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Last Name <span class="required">*</span>
              </label>
              <div class="col-md-4 col-sm-4 col-xs-12">
                <input name="lastName" value="<?php if(isset($result)){echo $result['lastName'];}?>" id="name" class="form-control col-md-7 col-xs-12"   required="required" type="text">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span>
              </label>
              <div class="col-md-4 col-sm-4 col-xs-12">
                <input name="email" value="<?php if(isset($result)){echo $result['email'];}?>" type="email" id="email"  required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Number <span class="required">*</span>
              </label>
              <div class="col-md-4 col-sm-4 col-xs-12">
                <input name="phone" value="<?php if(isset($result)){echo $result['phone'];}?>" type="number" id="number"  required="required"  class="form-control col-md-7 col-xs-12">
              </div>
            </div>
           
            <div class="clearfix"></div>
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