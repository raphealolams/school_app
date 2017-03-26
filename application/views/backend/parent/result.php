<?php
    $child_of_parent = $this->db->get_where('student' , array(
        'student_id' => $student_id, 'parent_id' => $_SESSION['parent_id']
    ))->result_array();
    foreach ($child_of_parent as $row):
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo "Result (<span class='text-danger pull-right'>Please note that Scratch Card can only be used 5 times</spen>)";?>
            	</div>
            </div>
			<div class="panel-body">

                <?php echo form_open(base_url() . 'index.php?parents/marks/'.$student_id , array('class' => 'form-horizontal form-groups-bordered validate'));?>


                <div class="form-group">
                  <label class="col-sm-3 control-label">Academic Section</label>
                  <div class="col-sm-5">
                    <select name="section_id" class="form-control"  style="float:left;">
                      <?php
                      $sections = $this->db->get('school_section')->result_array();
                      foreach($sections as $section):
                      ?>
                          <option value="<?php echo $section['section_id'];?>"
                              <?php if($section_id == $section['section_id'])echo 'selected';?>>
                                  <?php echo $section['name'];?></option>
                      <?php
                      endforeach;
                      ?>
                    </select>
                </div>
      					</div>

					<div class="form-group">
            <label class="col-sm-3 control-label">Choose Term</label>
            <div class="col-sm-5">
              <select name="term_id" class="form-control"  style="float:left;">
                <?php
                $terms = $this->db->get('term')->result_array();
                foreach($terms as $term):
                ?>
                    <option value="<?php echo $term['term_id'];?>"
                        <?php if($term_id == $term['term_id'])echo 'selected';?>>
                            <?php echo $term['name'];?></option>
                <?php
                endforeach;
                ?>
              </select>
          </div>
					</div>



          <div class="form-group">
            <label class="col-sm-3 control-label">Pin</label>
            <div class="col-sm-5">
            <input type="text" name="card_pin" placeholder="Enter Pin Number" class="form-control">
          </div>
					</div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Serial Number</label>
            <div class="col-sm-5">
            <input type="text" name="card_serial" placeholder="Enter Serial Number" class="form-control">
          </div>
					</div>


                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info">View <?php echo $row['name'];?>'s Result</button>
						</div>
					</div>
                <?php echo form_close();?>

            </div>
        </div>
    </div>
</div>
<?php endforeach;?>
<?php if(count($child_of_parent) < 1): ?>
  <div class="row">
  	<div class="col-md-12">
      <div class="alert alert-danger">
        <p>
          Dear Parent, The Requested Child is Not Your Child
        </p>
      </div>
    </div>
  </div>
  <?php endif; ?>
