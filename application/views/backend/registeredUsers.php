

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <ul class="nav navbar-left panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
          <div class="x_content">
           <?php if(isset($dataArr) && !empty($dataArr)){?>
            <table id="datatable-fixed-header" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Actions</th>
                </tr>
              </thead>
                <tbody>
                    <?php foreach($dataArr as $data){?>
                <tr>
                
                  <td><?php echo $data['firstName']." ".$data['lastName']?></td>
                  <td><?php echo $data['email'];?></td>
                  <td>
                      <ul class="nav navbar-left panel_toolbox">
                       <li><a href="<?php echo base_url('admin/deleteRegUser/').encode_url($data["id"])?>" onclick="return confirm('Are you sure you want to delete this user?');"data-toggle="tooltip" title="Delete" class="close-link"><i class="fa fa-trash"></i></a></li>
                      </ul>
                  </td>
                
                </tr>
                <?php }?>
                </tbody>
            </table>
              <?php }else{echo 'No Data';}?>
          </div>
        </div>
      </div>
    </div>
