<div class="row">
	<div class="col-md-12">

    	<!------CONTROL TABS START------>
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i>
					<?php echo 'Registered Term List';?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
					<?php echo 'Add Term';?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------>
		<div class="tab-content">
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">

                <table class="table table-bordered datatable" id="table_export">
                	<thead>
                		<tr>
                    		<th><div><?php echo 'Term Name';?></div></th>
                    		<th><div><?php echo 'Alias';?></div></th>
                    		<th><div><?php echo 'Date Created';?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php
                            foreach($term as $row):
                              ?>
                        <tr>

                          <td><?php echo $row['name'];?></td>
                          <td><?php echo $row['alias'];?></td>
                          <td><?php echo $row['date_created'];?></td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
			</div>
            <!----TABLE LISTING ENDS--->


			<!----CREATION FORM STARTS---->
			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                	<?php echo form_open(base_url() . 'index.php?admin/school_term/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                        <div class="padded">
                          <div class="form-group">
                              <label class="col-sm-3 control-label">Section Name</label>
                              <div class="col-sm-5">
                                  <input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-3 control-label">Alias</label>
                              <div class="col-sm-5">
                                  <input type="text" class="form-control" name="alias" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                              </div>
                          </div>


                        <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info">Add Term</button>
                              </div>
						   </div>
                    </form>
                </div>
			</div>
			<!----CREATION FORM ENDS-->

		</div>
	</div>
</div>


<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->
<script type="text/javascript">

	jQuery(document).ready(function($)
	{


		var datatable = $("#table_export").dataTable();

		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});

</script>
