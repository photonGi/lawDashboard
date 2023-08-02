<?php $this->load->view('backend/includes/top'); ?>
<?php $this->load->view('backend/includes/sideBar'); ?>

 
<!-- top navigation -->
<?php $this->load->view('backend/includes/header'); ?>
<!-- /top navigation -->

<!-- page content -->
<div class="right_col" role="main">
  <div class="page-title">
        <div class="title_left">
          <h3><?php echo $heading?></h3>
        </div>
      </div>
    
    <div class="clearfix"></div>
    <?php if(isset($errors)){?>
    <div class="alert alert-danger">
        <a href="" class="close" data-dismiss="Error"> &times; </a>
        <?php echo $errors; ?>
    </div>
    <?php }
    elseif(isset($success)){?>
    <div class="alert alert-info">
        <a href="" class="close" data-dismiss="Success"> &times; </a>
        <?php echo $success; ?>
    </div>
    <?php }?>

    <?php $this->load->view($page); ?>
</div>
<!-- /page content -->

<!-- footer content -->
 <?php $this->load->view('backend/includes/footer'); ?>