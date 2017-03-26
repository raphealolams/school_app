<?php
$class_name		 	= 	$this->db->get_where('class' , array('class_id' => $class_id))->row()->name;
$exam_name  		= 	$this->db->get_where('exam' , array('exam_id' => $exam_id))->row()->name;
$system_name        =	$this->db->get_where('settings' , array('type'=>'system_name'))->row()->description;
$address        =	$this->db->get_where('settings' , array('type'=>'address'))->row()->description;
$tel        =	$this->db->get_where('settings' , array('type'=>'phone'))->row()->description;

?>
<div id="print">
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css" media="print">
<div class="container">
	<div class="row">


			<script src="assets/js/jquery-1.11.0.min.js"></script>
			<style type="text/css">
			td {
				padding: 5px;
			}
			.space{
				padding: 10px;
				margin: 10px;
			}
			.name{
				font-size: 20px;
				line-height: 12px;
				font-weight: 300;
			}

			</style>

			<table style="width:100%; margin-top: 10px; padding-top:20px;" border="0">
					<td align="center" width="500px">
					<img src="uploads/logo.jpg">
					</td>
					<td>
						<h1 style="color: green; font-weight: bolder;"><?php echo $system_name;?></h3>
						<p style="color: red; font-weight: bold;"> Address: <?php echo $address;?></p>
						<p style="color: red; font-weight: bold;"> Phone Number: <?php echo $tel;?></p>
					</td>
			</table>


					<center><h3 style="font-weight: bolder;"><u>Student Report Card</u></h4></center><br/><br>
						<table style="width:100%; margin-top: 10px; padding-top:20px;" border="0">
						<td align="center" width="900px">
						<p class="name" style="font-weight: bolder;">
							<b>Name: </b><?php echo $this->db->get_where('student' , array('student_id' => $student_id))->row()->name;?><br>
						</p>
					</td>

						<td>
						<p class="name" style="font-weight: bolder;">
							<b>Class: </b><?php echo $class_name;?><br>
						</p>
					</td><br>

					</table>



				<br/>
				<div class="col-md-12">
					<table style="width:100%; border-collapse:collapse;border: 1px solid #ccc; margin-top: 10px; padding-top:20px;" border="1">
						<thead>
							<tr style="font-weight: bolder;">
								<td style="text-align: center;">Subject</td>
								<td style="text-align: center;">C.A</td>
								<td style="text-align: center;">Exam Score</td>
								<td style="text-align: center;">Total Score</td>
								<td style="text-align: center;">Grade</td>
								<td style="text-align: center;">Comment</td>
							</tr>
						</thead>
						<tbody>
							<?php
							$total_marks = 0;
							$total_grade_point = 0;
							$subjects = $this->db->get_where('subject' , array('class_id' => $class_id))->result_array();
							foreach ($subjects as $row3):
								?>
								<tr>
									<td style="text-align: center;"><?php echo $row3['name'];?></td>
									<td style="text-align: center;">
										<?php
										$assessment = $this->db->get_where('report' , array(
											'subject_id' => $row3['subject_id'],
											'class_id' => $class_id,
											'student_id' => $student_id))->result_array();

											foreach ($assessment as $score) {
												echo $score['assesment_score'];
												$total_marks += $score['exam_score'];
											}
											?>
										</td>
									<td style="text-align: center;">
										<?php
										$marks = $this->db->get_where('report' , array(
											'subject_id' => $row3['subject_id'],
											'class_id' => $class_id,
											'student_id' => $student_id))->result_array();

											foreach ($marks as $row4) {
												echo $row4['exam_score'];
												// $total_marks += $row4['exam_score'];
											}
											?>
										</td>
										<td style="text-align: center;">
											<?php

											$total_score = $row4['exam_score'] + $score['assesment_score'];
											echo $total_score;


											?>
										</td>
										<td style="text-align: center;">
											<?php
											if ($total_score >= 0 || $total_score != '') {
												$grade = $this->crud_model->get_grade($total_score);
												echo $grade['name'];
												$total_grade_point += $grade['grade_point'];
											}
											?>
										</td>
										<td style="text-align: center;"><?php echo $row4['comment'];?></td>
									</tr>
								<?php endforeach;?>
							</tbody>
						</table>

						<br>

						<center>
							<?php echo get_phrase('total_marks');?> : <?php echo $total_marks;?>
							<br>
							<?php echo get_phrase('average_grade_point');?> :
							<?php
							$this->db->where('class_id' , $class_id);
							$this->db->from('subject');
							$number_of_subjects = $this->db->count_all_results();
							echo ($total_grade_point / $number_of_subjects);
							?>
						</center>

					</div>
				</div>
			</div>
		</div>


		<script type="text/javascript">

		jQuery(document).ready(function($)
		{
			var elem = $('#print');
			PrintElem(elem);
			Popup(data);

		});

		function PrintElem(elem)
		{
			Popup($(elem).html());
		}

		function Popup(data)
		{
			var mywindow = window.open('', 'my div', 'height=700,width=1200');
			mywindow.document.write('<html><head><title></title>');
			//mywindow.document.write('<link rel="stylesheet" href="assets/css/print.css" type="text/css" />');
			mywindow.document.write('</head><body >');
			//mywindow.document.write('<style>.print{border : 1px;}</style>');
			mywindow.document.write(data);
			mywindow.document.write('</body></html>');

			mywindow.document.close(); // necessary for IE >= 10
			mywindow.focus(); // necessary for IE >= 10

			mywindow.print();
			mywindow.close();

			return true;
		}
		</script>
