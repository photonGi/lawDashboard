<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Control Panel | Truth Meter </title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>assets/backend/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url();?>assets/backend/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url();?>assets/backendnprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?php echo base_url();?>assets/backend/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url();?>assets/backend/build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
              <form method="POST" action="<?php echo base_url()?>restPassword">
              <h1>Reset Password</h1>
              <?php if(isset($errors)){?>
                    <div class="alert alert-danger">
                        
                        <?php echo $errors; ?>
                    </div>
                    <?php }
                    elseif(isset($success)){?>
                    <div class="alert alert-info">
                        
                        <?php echo $success; ?>
                    </div>
                <?php } ?>
              <div>
                  <input type="password" name="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                  <input type="password" name="conPassword" class="form-control" placeholder="Confirm Password" required="" />
              </div>
              <input type="hidden" name="userId" value="<?php echo $this->uri->segment(2);?>"/>
              <input type="hidden" name="token" value="<?php echo $this->uri->segment(3);?>"/>
              <div>
                <button type="submit" class="btn btn-default submit">Submit</button>
              </div>

              <div class="clearfix"></div>

              
            </form>
          </section>
        </div>

        
      </div>
    </div>
  </body>
</html>
