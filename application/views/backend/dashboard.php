<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  
    
            <!-- top tiles -->
          <div class="row tile_count">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-users"></i> Total Admin Users</span>
              <div class="count"><?php if(isset($totalUsers)){ echo $totalUsers["count"]; }else{ echo "No Data"; } ?></div>
             <!-- <span class="count_bottom"><i class="green">4% </i> From last Month</span> -->
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-suitcase"></i> Total Properties</span>
              <div class="count"><?php if(isset($totalProperties)){ echo $totalProperties["count"]; }else{ echo "No Data"; } ?></div>
            
            </div>
         
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-briefcase"></i> Active Properties</span>
              <div class="count green"><?php if(isset($activeProperties)){ echo $activeProperties["count"]; }else{ echo "No Data"; } ?></div>
             
            </div>
           
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-credit-card"></i> Agencies</span>
              <div class="count"><?php if(isset($totalAgencies)){ echo $totalAgencies["count"]; }else{ echo "No Data"; } ?></div>
             
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-building"></i> Projects</span>
              <div class="count"><?php if(isset($totalProjects)){ echo $totalProjects["count"]; }else{ echo "No Data"; } ?></div>
            
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-globe"></i> Maps</span>
              <div class="count"><?php if(isset($totalMaps)){ echo $totalMaps["count"]; }else{ echo "No Data"; } ?></div>
            
            </div>  
          </div> 
          <!-- /top tiles -->
   
   
     