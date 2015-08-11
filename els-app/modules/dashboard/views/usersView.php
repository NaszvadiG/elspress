<!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo base_url(); ?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Users</a> </div>
    <h1>Users</h1>
  </div>
<!--End-breadcrumbs-->

  <div class="container-fluid">
    <hr>

    <?php if( $this->session->flashdata('successMsg') ): ?>
        <div class="control-group successMsg">
            <div class="controls">
                <div class="alert alert-success alert-block">
                      <?php echo $this->session->flashdata('successMsg'); ?>
                </div>
            </div>
        </div>        
    <?php endif; $this->session->set_flashdata('successMsg', ''); ?> 

    <div class="row-fluid">
        <div class="span12">

          <div class="widget-box">

            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
              <h5>User Lists</h5>
            </div>

            <div class="dataTables_filter" id="example_filter"><label>Search: <input type="text" aria-controls="example"></label></div>
            
            <div class="widget-content nopadding">
              <table class="table table-bordered data-table">
                <thead>

                  <tr>
                    <th>Full Name</th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>

                  <?php if( isset($getAllUser) ) : 
                      foreach( $getAllUser as $user ): ?>
                        <tr class="gradeX">
                          <td><?php echo $user->display_name; ?></td>
                          <td class="center"><?php echo $user->user_name; ?></td>
                          <td class="center"><?php echo $user->user_email; ?></td>
                          <td class="center">
                            <?php echo ( $user->user_status == 1 ) ? '<span class="label label-success"><i class="icon-ok-circle"></i> Active</span>' : '<span class="label label-warning"><i class="icon-info-sign"></i> Inactive</span>'; ?>
                          </td>
                          <td class="center">
                            <button class="btn btn-success btn-mini">Edit</button>
                            <button class="btn btn-danger btn-mini">Delete</button>
                          </td>
                        </tr>
                  <?php endforeach; endif; ?>
                </tbody>
              </table>
            </div>
          </div>
    </div>
  </div>
</div>