<div class="row">
    <div class="col-md-12">
        <?php echo form_open(base_url() . 'index.php?admin/assessmentscore');?>
            <div class="col-md-4">
                <div class="form-group">
                    <select name="class_id" class="form-control selectboxit">
                        <option value=""><?php echo get_phrase('select_a_class');?></option>
                        <?php 
                        $classes = $this->db->get('class')->result_array();
                        foreach($classes as $row):
                        ?>
                            <option value="<?php echo $row['class_id'];?>"
                                <?php if ($class_id == $row['class_id']) echo 'selected';?>>
                                    <?php echo $row['name'];?>
                            </option>
                        <?php
                        endforeach;
                        ?>
                    </select>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <select name="subject_id" class="form-control selectboxit">
                        <option value=""><?php echo get_phrase('select_a_subject');?></option>
                        <?php 
                        $subject = $this->db->get('subject')->result_array();
                        foreach($subject as $row):
                        ?>
                            <option value="<?php echo $row['subject_id'];?>"
                                <?php if ($subject_id == $row['subject_id']) echo 'selected';?>>
                                    <?php echo $row['name'];?>
                            </option>
                        <?php
                        endforeach;
                        ?>
                    </select>
                </div>
            </div>
            <input type="hidden" name="operation" value="selection">
            <div class="col-md-4">
                <button type="submit" class="btn btn-info"><?php echo get_phrase('view_score_sheet');?></button>
            </div>
        <?php echo form_close();?>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
    
        <!------CONTROL TABS START------>
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
                    <?php echo get_phrase('assessment_scores');?>
                        </a></li>
                        <?php print_r($row); ?>
                        <li>
                <a href="#multiple" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('add_assessment_scores');?>
                        </a></li>
        </ul>
        <!------CONTROL TABS END------>
        <div class="tab-content">
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
                <table  class="table table-bordered datatable" id="table_export">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><div><?php echo get_phrase('assessment_score');?></div></th>
                            <th><div><?php echo get_phrase('term');?></div></th>
                            <th><div><?php echo get_phrase('subject');?></div></th>
                            <th><div><?php echo get_phrase('class');?></div></th>
                            <th><div><?php echo get_phrase('options');?></div></th>
                            
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $count = 1; 

                            $assessmenttype   =   $this->db->get('assessmentscore' )->result_array();
                            foreach($assessmenttype as $row):?>
                            <?php 
                            $student_id = $this->db->query("SELECT * FROM student WHERE student_id = ". $row['student_id'])->result_array();
                            print_r("$row['class_id']");
                            ?>
                        <tr>
                            <td><?php echo $count++;?></td>
                            <td><?php echo $row['assessment_score'];?></td>
                            <td><?php echo $this->crud_model->get_type_name_by_id('term',$row['term_id']);?></td>
                            <td><?php echo $this->crud_model->get_type_name_by_id('subject',$row['subject_id']);?></td>
                            <td><?php echo $this->crud_model->get_type_name_by_id('class',1);?></td>

                            <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                    Action <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                    
                                    <!-- EDITING LINK -->
                                    <li>
                                        <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_edit_assessmentscore/<?php echo $row['assessmentscore_id'];?>');">
                                            <i class="entypo-pencil"></i>
                                                <?php echo get_phrase('Edit');?>
                                            </a>
                                                    </li>
                                    <li class="divider"></li>
                                    
                                    <!-- DELETION LINK -->
                                    <li>
                                        <a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/assessmentscore/delete/<?php echo $row['assessmentscore_id'];?>');">
                                            <i class="entypo-trash"></i>
                                                <?php echo get_phrase('Delete');?>
                                            </a>
                                                    </li>
                                </ul>
                            </div>
                            </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
            <!----TABLE LISTING ENDS--->
            
            
         
            <!-- MULTIPLE STARTS -->

            <div class="tab-pane box" id="multiple" style="padding: 5px">
            
                <div class="box-content">

                <form action="<?php echo base_url();?>index.php?admin/add_each_student_assessment/" class="form-horizontal form-groups-bordered validate" method="post" enctype="multippart/form-data" >
                
                    
                    
                    <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('choose_class');?></label>
                        
                        <div class="col-sm-5">
                            <select name="class_id" class="form-control" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <?php 
                                        $classes = $this->db->get('class')->result_array();
                                        foreach($classes as $row):
                                            ?>
                                            <option value="<?php echo $row['class_id'];?>">
                                                    <?php echo $row['name'];?>
                                                    </option>
                                        <?php
                                        endforeach;
                                  ?>
                          </select>
                        </div> 
                    </div>
                    <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('assessment_type');?></label>
                        
                        <div class="col-sm-5">
                            <select name="assessment_id" class="form-control" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <?php 
                                        $ass_type = $this->db->get('assessmenttype')->result_array();
                                        foreach($ass_type as $row):
                                            ?>
                                            <option value="<?php echo $row['assessment_id'];?>">
                                                    <?php echo $row['name'];?>
                                                    </option>
                                        <?php
                                        endforeach;
                                  ?>
                          </select>
                        </div> 
                    </div>
                    <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('term');?></label>
                        
                        <div class="col-sm-5">
                            <select name="term_id" class="form-control" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <?php 
                                        $term = $this->db->get('term')->result_array();
                                        foreach($term as $row):
                                            ?>
                                            <option value="<?php echo $row['term_id'];?>">
                                                    <?php echo $row['name'];?>
                                                    </option>
                                        <?php
                                        endforeach;
                                  ?>
                          </select>
                        </div> 
                    </div>
                    <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('subject');?></label>
                        
                        <div class="col-sm-5">
                            <select name="subject_id" class="form-control" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <?php 
                                        $subject = $this->db->get('subject')->result_array();
                                        foreach($subject as $row):
                                            ?>
                                            <option value="<?php echo $row['subject_id'];?>">
                                                    <?php echo $row['name'];?>
                                                    </option>
                                        <?php
                                        endforeach;
                                  ?>
                          </select>
                        </div> 
                    </div>
                    
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-info"><?php echo get_phrase('Add_scores');?></button>
                        </div>
                    </div>
                </form>
                           
                </div>                
            </div>

            <!-- MULTIPLE ENDS -->
            
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