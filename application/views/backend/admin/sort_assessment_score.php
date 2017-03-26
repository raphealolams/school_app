<div class="row">
  <div class="col-md-12">
    <!------CONTROL TABS START------>
    <ul class="nav nav-tabs bordered">
      <li class="active"> <a href="#list" data-toggle="tab"><i class="entypo-menu"></i> <?php echo get_phrase('Student_list');?> </a></li>
    </ul>
    <!------CONTROL TABS END------>
    <div class="tab-content">
      <!----TABLE LISTING STARTS-->
      <div class="tab-pane box active" id="list">
        <form action="" method="post">

          <div class="form-group">
          <table  class="table table-bordered datatable" id="table_export">
            <caption>
            </caption>
            <thead>
              <tr>
                <th><div><?php echo get_phrase('Student ID');?></div></th>
                <th><div><?php echo get_phrase('name');?></div></th>
                <th><div><?php echo get_phrase('Scores');?></div></th>
              </tr>
            </thead>
            <tbody>
              <?php  
                       $count = 1; 
                       $date = date('Y-m-d');
					   print_r($_POST);
                        foreach ($_POST as $key => $value) {  
						   if(is_int($value)) { 
						   
                            $assessment_id = $_POST['assessmenttype_id'];
                            $term_id = $_POST['term_id'];
                            $subject_id = $_POST['subject_id'];
							$student   =   $this->db->query("SELECT name FROM student WHERE student_id = ". $key);


                                $this->db->query("INSERT INTO assessmentscore (assessmenttype_id, student_id, term_id, subject_id, assessment_score, datecreate) VALUES ( '$assessment_id', $key, '$term_id','$subject_id', $value, $date);")
								 
                        ?>
						
								          		 <?php $this->session->set_flashdata('flash_message' , get_phrase('Successfully Inserted')); ?>

              <tr>
                <td><?php echo $count++;?></td>
                <td><?php echo $student['name']; ?></td>
                <td><?php echo $key; ?></td>
            </div>
            
            </tr>
            
            <?php } } ?>
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
