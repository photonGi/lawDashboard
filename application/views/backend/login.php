<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Control Panel | IRCA	 </title>
<!-- <link rel="icon" href="<?php echo base_url();?>assets/logo.png" type="image/gif" sizes="16x16"> -->
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
              <form method="POST" action="<?php echo base_url()?>admin/getlogin">
              <h1>IRCA	 Login</h1>
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
                  <input type="email" name="email" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
                  <input type="password" name="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <button type="submit" class="btn btn-default submit">Log In</button>
                <a class="reset_pass" href="#signup">Lost your password?</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <div class="clearfix"></div>
                <br />

                <div>
                    <p>Powered By</p>
                  <h1><i class="fa fa-globe"></i> Cyan Business Solutions</h1>
                  <p>©2020 All Rights Reserved.</p>
                </div>
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
              
            <form action="<?php echo base_url(); ?>admin/mailPassword" method="post">
              <h1>Lost Password</h1>
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
                  <input type="email" name="email" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
                <button type="submit" class="btn btn-default submit">Send Mail</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                  <a href="#signin" class="to_register"> Back </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <p>Powered By</p>
                  <h1><i class="fa fa-globe"></i> Cyan Business Solutions</h1>
                  <p>©2020 All Rights Reserved</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
