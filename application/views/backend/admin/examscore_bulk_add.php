<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('add_multiple_exam_score');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?admin/examscore_bulk_add/import_excel/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
	
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('select_excel_file');?></label>
                        
						<div class="col-sm-5">
                        	<input type="file" name="userfile" class="form-control" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
                            <br>
                         <a href="<?php echo base_url();?>uploads/examscore_excel_file.xlsx" target="_blank" 
                         		class="btn btn-info btn-sm"><i class="entypo-download"></i> Download blank excel file</a>
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
							<button type="submit" class="btn btn-info"><?php echo get_phrase('upload_and_import');?></button>
						</div>
					</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>