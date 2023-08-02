 <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
                <a href="<?php echo base_url('admin/dashboard');?>" ><img class="img-responsive"src="<?php echo base_url('frontend/img/logo.png');?>" /> <span></span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?php echo base_url('assets/backend/profileImage.png'); ?>" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo $this->session->userdata('ft_firstName')." ".$this->session->userdata('ft_lastName');?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />
<?php 
$this->load->helper('module_helper');
$modulesArr = getModules();

?>
            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu">
                <?php
                if($modulesArr){
                  foreach($modulesArr as $module) {
                      if($module["has_dropDown"] == 0) {   
                ?>
                  <li><a href="<?php echo base_url().$module["functionName"]; ?>">
                    <i class="fa <?php echo $module["moduleIcon"]; ?>"></i> 
                    <?php echo $module["moduleName"];?> </a></li>
                <?php }
                else
                {    ?>
                  <li><a><i class="fa <?php echo $module["moduleIcon"]; ?>"></i> <?php echo $module["moduleName"];?> <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                    <?php
                    $subModules=getSubModules($module["id"]);
                    foreach($subModules as $sbModule)
                    {        ?>   
                      <li><a href="<?php echo base_url().$sbModule["functionName"]; ?>"><?php echo $sbModule["moduleName"];?></a></li>
                    <?php }?>
                    </ul>
                  </li>
                <?php 
                            }
                        }
                    }
                  ?>
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
                <a data-toggle="tooltip" data-placement="top" title="Change Password" href="<?php echo base_url('admin/editPassword');?>">
                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
              </a>
                <a data-toggle="tooltip" data-placement="top" title="Edit Profile" href="<?php echo base_url('admin/editProfile');?>">
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="<?php echo base_url()."admin/userlogout"?>">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>
