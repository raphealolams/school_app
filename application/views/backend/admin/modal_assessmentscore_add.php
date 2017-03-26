<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title">
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('add_assessment_score');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?admin/assessmentscore/create/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
                    
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('assessment_score');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="assessment_score" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"  autofocus
                            	value="">
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('please_choose_assessment_type');?></label>
                        
						<div class="col-sm-5">
							<select name="assessmenttype_id" class="form-control select2">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <?php 
								$assessmenttype = $this->db->get('assessmenttype')->result_array();
								foreach($assessmenttype as $assessmenttyperow):
									?>
                            		<option value="<?php echo $assessmenttyperow['assessmenttype_id'];?>">
										<?php echo $assessmenttyperow['name'];?>
                                    </option>
                                <?php
								endforeach;
							  ?>
                          </select>
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
							<button type="submit" class="btn btn-default"><?php echo get_phrase('add_assessment_score');?></button>
						</div>
					</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>