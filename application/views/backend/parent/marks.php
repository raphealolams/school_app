<?php
    $child_of_parent = $this->db->get_where('student' , array(
        'student_id' => $student_id
    ))->result_array();
    foreach ($child_of_parent as $row):
?>
<hr />
    <div class="label label-primary pull-right" style="font-size: 14px;">
        <i class="entypo-user"></i> <?php echo $row['name'];?>
    </div>
<br><br>
<div class="row">
    <div class="col-md-12">

            <?php
                    $this->db->where('student_id', $student_id);
                    $this->db->where('section_id', $section_id);
                    $this->db->where('term_id', $term_id);

                    /*** Check if The report card is ready for viewing ****/
                    // $this->db->where('status', '1');
                    $marks = $this->db->get('report')->result_array();
            ?>
                <div class="tab-pane" id="<?php echo $exam['exam_id'];?>">
                    <table class="table table-bordered responsive">
                        <thead>
                            <tr>
                                <th>Subject</th>
                                <th>Exam Score</th>
                                <th>Assessment Score </th>
                                <th width="33%"><?php echo get_phrase('comment');?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($marks as $mark):?>
                                <td>
                                    <?php echo $this->db->get_where('subject' , array(
                                        'subject_id' => $mark['subject_id']
                                    ))->row()->name;?>
                                </td>
                                <td><?php echo $mark['exam_score'];?></td>
                                <td><?php echo $mark['assesment_score'];?></td>
                                <td><?php echo $mark['comment'];?></td>
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                    <a href="<?php echo base_url();?>index.php?parents/student_marksheet_print_view/<?php echo $student_id;?>/<?php echo $exam['exam_id'];?>"
                        class="btn btn-primary" target="_blank">
                        <?php echo 'Print Result';?>
                    </a>
                </div>

            </div>

        </div>

<?php endforeach;?>
