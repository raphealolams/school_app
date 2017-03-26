<div class="row">
	<div class="col-md-12">

    	<!------CONTROL TABS START------>
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i>
					<?php echo 'Manage Reports';?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------>


            <!----TABLE LISTING STARTS-->
            <div class="tab-pane  <?php if(!isset($edit_data) && !isset($personal_profile) && !isset($academic_result) )echo 'active';?>" id="list">
				<center>
                <?php echo form_open(base_url() . 'index.php?teacher/reports');?>
                <table border="0" cellspacing="0" cellpadding="0" class="table table-bordered">
                	<tr>
                    <td>Select Section</td>
                    <td>Select Term</td>
                    <td>Select Class</td>
                    <td>Select Subject</td>
                        <td>&nbsp;</td>
                	</tr>
                	<tr>
                    <td>
                      <select name="section_id" class="form-control"  style="float:left;">
												<?php
												$section = $this->db->get('school_section')->result_array();
												foreach($section as $row):
												?>
														<option value="<?php echo $row['section_id'];?>"
																<?php if($section_id == $row['section_id'])echo 'selected';?>>
																		<?php echo $row['name'];?></option>
												<?php
												endforeach;
												?>
                      </section>
                    </td>
                    <td>
                      <select name="term_id" class="form-control"  style="float:left;">
												<?php
												$term = $this->db->get('term')->result_array();
												foreach($term as $row):
												?>
														<option value="<?php echo $row['term_id'];?>"
																<?php if($term_id == $row['term_id'])echo 'selected';?>>
																		<?php echo $row['name'];?></option>
												<?php
												endforeach;
												?>
                      </section>
                    </td>

                        <td>
                        	<select name="class_id" class="form-control"  onchange="show_subjects(this.value)"  style="float:left;">
                                <option value=""><?php echo get_phrase('select_a_class');?></option>
                                <?php
                                $classes = $this->db->get('class')->result_array();
                                foreach($classes as $row):
                                ?>
                                    <option value="<?php echo $row['class_id'];?>"
                                        <?php if($class_id == $row['class_id'])echo 'selected';?>>
                                            Class <?php echo $row['name'];?></option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                        </td>
                        <td>
                        	<!-----SELECT SUBJECT ACCORDING TO SELECTED CLASS-------->
							<?php
                                $classes	=	$this->crud_model->get_classes();
                                foreach($classes as $row): ?>

                                <select name="<?php if($class_id == $row['class_id'])echo 'subject_id';else echo 'temp';?>"
                                      id="subject_id_<?php echo $row['class_id'];?>"
                                          style="display:<?php if($class_id == $row['class_id'])echo 'block';else echo 'none';?>;" class="form-control"  style="float:left;">

                                    <option value="">Subject of class <?php echo $row['name'];?></option>

                                    <?php
                                    $subjects	=	$this->crud_model->get_subjects_by_class($row['class_id']);
                                    foreach($subjects as $row2): ?>
                                    <option value="<?php echo $row2['subject_id'];?>"
                                        <?php if(isset($subject_id) && $subject_id == $row2['subject_id'])
                                                echo 'selected="selected"';?>><?php echo $row2['name'];?>
                                    </option>
                                    <?php endforeach;?>


                                </select>
                            <?php endforeach;?>


                            <select name="temp" id="subject_id_0"
                              style="display:<?php if(isset($subject_id) && $subject_id >0)echo 'none';else echo 'block';?>;" class="form-control" style="float:left;">
                                    <option value="">Select a class first</option>
                            </select>
                        </td>
                        <td>
                        	<input type="hidden" name="operation" value="selection" />
                    		<input type="submit" value="<?php echo get_phrase('manage_marks');?>" class="btn btn-info" />
                        </td>
                	</tr>
                </table>
                </form>
                </center>


                <br /><br />


                <?php if($section_id >0 && $term_id >0 && $class_id >0 && $subject_id >0 ):?>
                <?php
						////CREATE THE MARK ENTRY ONLY IF NOT EXISTS////
						$students	=	$this->crud_model->get_students($class_id);
						foreach($students as $row):
							$verify_data	=	array(
														'section_id' => $section_id ,
														'term_id' => $term_id ,
														'class_id' => $class_id ,
														'subject_id' => $subject_id ,
														'student_id' => $row['student_id']);
							$query = $this->db->get_where('report' , $verify_data);

							if($query->num_rows() < 1)
								$this->db->insert('report' , $verify_data);
						 endforeach;
				?>
                <table class="table table-bordered" >
                    <thead>
                        <tr>
                            <td><?php echo get_phrase('student');?></td>
                            <td><?php echo 'Exam Score'; ?></td>
														<td><?php echo 'Assessment Score';?></td>
                            <td><?php echo get_phrase('comment');?></td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
						$students	=	$this->crud_model->get_students($class_id);
						foreach($students as $row):

							$verify_data	=	array(
																'section_id' => $section_id ,
																'term_id' => $term_id ,
																'class_id' => $class_id ,
																'subject_id' => $subject_id ,
																'student_id' => $row['student_id']);

							$query = $this->db->get_where('report' , $verify_data);
							$report	=	$query->result_array();
							foreach($report as $row2):
							?>
                            <?php echo form_open(base_url() . 'index.php?teacher/reports/' . $section_id . '/' . $term_id . '/' . $class_id .'/' . $subject_id );?>
							<tr>
                                <td>
                                    <?php echo $row['name'];?>
                                </td>
                                <td>
                                     <input type="number" value="<?php echo $row2['exam_score'];?>" name="exam_score_<?php echo $row['student_id'];?>" class="form-control" >

                                </td>

																<td>
                                     <input type="number" value="<?php echo $row2['assesment_score'];?>" name="assessment_score_<?php echo $row['student_id'];?>" class="form-control" >

                                </td>

                                <td>
                                    <textarea name="comment_<?php echo $row['student_id'];?>" class="form-control"><?php echo $row2['comment'];?></textarea>
                                </td>
                                    <input type="hidden" name="report_id_<?php echo $row['student_id'];?>" value="<?php echo $row2['report_id'];?>" />

                                    <input type="hidden" name="section_id" value="<?php echo $section_id;?>" />
																		<input type="hidden" name="term_id" value="<?php echo $term_id;?>" />
                                    <input type="hidden" name="class_id" value="<?php echo $class_id;?>" />
                                    <input type="hidden" name="subject_id" value="<?php echo $subject_id;?>" />

                                    <input type="hidden" name="operation" value="update" />
                             </tr>
                         	<?php
							endforeach;
						 endforeach;
						 ?>
                     </tbody>
                  </table>

                  <center>
                      <button type="submit" class="btn btn-primary"><?php echo get_phrase('update_marks');?></button>
                  </center>
                  <?php echo form_close();?>

            <?php endif;?>
			</div>
            <!----TABLE LISTING ENDS-->

		</div>
	</div>
</div>

<script type="text/javascript">
  function show_subjects(class_id)
  {
      for(i=0;i<=100;i++)
      {

          try
          {
              document.getElementById('subject_id_'+i).style.display = 'none' ;
	  		  document.getElementById('subject_id_'+i).setAttribute("name" , "temp");
          }
          catch(err){}
      }
      document.getElementById('subject_id_'+class_id).style.display = 'block' ;
	  document.getElementById('subject_id_'+class_id).setAttribute("name" , "subject_id");
  }

</script>
