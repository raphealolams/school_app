<div class="row">
    <div class="col-md-12">
    
        <!------CONTROL TABS START------>
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
                    <?php echo get_phrase('exam_scores');?>
                        </a></li>
            <li>
                <a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('add_scores');?>
                        </a></li>
        </ul>
        <!------CONTROL TABS END------>
        <div class="tab-content">
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
                <table  class="table table-bordered datatable" id="table_export">
                    <thead>
                        <tr>
                            <th><div><?php echo get_phrase('exam_score');?></div></th>
                            <th><div><?php echo get_phrase('date_created');?></div></th>
                            <th><div><?php echo get_phrase('options');?></div></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $examscore = $this->db->get('examscore')->result_array();
                        foreach($examscore as $row):?>
                        <tr>
                            <td><?php echo $row['exam_score'];?></td>             
                            <td><?php echo $row['datecreated'];?></td>
                            <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                    Action <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                    
                                    <!-- EDITING LINK -->
                                    <li>
                                        <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_edit_exam/<?php echo $row['exam_id'];?>');">
                                            <i class="entypo-pencil"></i>
                                                <?php echo get_phrase('edit');?>
                                            </a>
                                                    </li>
                                    <li class="divider"></li>
                                    
                                    <!-- DELETION LINK -->
                                    <li>
                                        <a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/exam/delete/<?php echo $row['exam_id'];?>');">
                                            <i class="entypo-trash"></i>
                                                <?php echo get_phrase('delete');?>
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
            
            
            <!----CREATION FORM STARTS---->
            <div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                    <?php echo form_open(base_url() . 'index.php?admin/examscore/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                        
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('examscore');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="exam_score" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('date');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="datepicker form-control" name="datecreated"/>
                                </div>
                            </div>
                            
                            <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('please_choose student');?></label>
                        
                        <div class="col-sm-5">
                            <select name="student_id" class="form-control select2">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <?php 
                                $student = $this->db->get('student')->result_array();
                                foreach($student as $row):
                                    ?>
                                    <option value="<?php echo $row['student_id'];?>">
                                        <?php echo $row['name'];?>
                                    </option>
                                <?php
                                endforeach;
                              ?>
                          </select>
                        </div> 
                    </div>

                    <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('please_choose_term');?></label>
                        
                        <div class="col-sm-5">
                            <select name="term_id" class="form-control select2">
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
                        <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Please_choose_subject');?></label>
                        
                        <div class="col-sm-5">
                            <select name="subject_id" class="form-control select2">
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
                                  <button type="submit" class="btn btn-info"><?php echo get_phrase('add_score');?></button>
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