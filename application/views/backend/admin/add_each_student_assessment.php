<div class="row">
    <div class="col-md-12">
    
        <!------CONTROL TABS START------>
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
                    <?php echo get_phrase('Student_list');?>
                        </a></li>
            
        </ul>
        <!------CONTROL TABS END------>
        <div class="tab-content">
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
            <form action="<?php echo base_url();?>index.php?admin/sort_assessment_score" class="form-horizontal form-groups-bordered validate" method="post" enctype="multippart/form-data">
            <div class="form-group">

                    

                <table  class="table table-bordered datatable" id="table_export">
                    
					<thead>
					
                        <tr>
                            <th><div><?php echo get_phrase('Student ID');?></div></th>
                            <th><div><?php echo get_phrase('name');?></div></th>
                            <th><div><?php echo get_phrase('Scores');?></div></th>
                            
                        </tr>
                    </thead>
                    
                    <tbody>
                    <?php  

                        $student   =   $this->db->query("SELECT * FROM student WHERE class_id = ". $_POST['class_id']);
                        $count = 1;
                            foreach($student->result() as $row) 
                            {  
                               ?>
                        
                        <tr>
                            
                            <td><?php echo $count++;?></td>
                            <td><?php echo $row->name; ?></td>
                            <td>

                            <div class="form-group">
                                <?php $student_id = "<?php echo $row->student_id; ?>" ?>
                            <input type="text" class="form-control" name="<?php echo $student_id; ?>" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
                            </td>
                            <td></td>
                            
                    </div>
                            
                        </tr>
                        <?php } ?>
                         


                        
                            <input type="hidden" name="term_id" value="<?php echo $_POST['class_id'] ?>" >
                            <input type="hidden" name="assessmenttype_id" value="<?php  echo $_POST['assessment_id'] ?>">
                            <input type="hidden" name="subject_id" value="<?php echo $_POST['subject_id'] ?>">
                            <?php 
                          if (is_null($student_id)){
                            $this->session->set_flashdata('flash_message', get_phrase('invalid_or_empty_input'));
                          }
                          else { ?>
                     <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-default"><?php echo get_phrase('submit_assessment_score');?></button>
                        </div>

                        <?php } ?>
                    </tbody>
                </table>
                </form>
            </div>
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