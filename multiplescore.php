function add_multiple_score($param1 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
            
        if ($param1 == 'import_excel')
        {
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/multiple_score_import.xlsx');
            // Importing excel sheet for bulk student uploads

            include 'simplexlsx.class.php';
            
            $xlsx = new SimpleXLSX('uploads/multiple_score_import.xlsx');
            
            list($num_cols, $num_rows) = $xlsx->dimension();
            $f = 0;
            foreach( $xlsx->rows() as $r ) 
            {
                // Ignore the inital name row of excel file
                if ($f == 0)
                {
                    $f++;
                    continue;
                }
                for( $i=0; $i < $num_cols; $i++ )
                {
                    if ($i == 0)        $data['student_name'] =   $r[$i];
                    else if ($i == 1)   $data['score']        =   $r[$i];
                    
                }
                $data['class_id']   =   $this->input->post('class_id');
                $data['term_id']   =   $this->input->post('term_id');
                $data['subject_id']   =   $this->input->post('subject_id');
                $data['assessmenttype_id']   =   $this->input->post('assessmenttype_id');
                
                $this->db->insert('assessmentscore' , $data);
                //print_r($data);
            }
            redirect(base_url() . 'index.php?admin/assessmentscore/' . $this->input->post('class_id') . $this->input->post('term_id') . $this->input->post('subject_id') . $this->input->post('assessmenttype_id'), 'refresh');
    
        $page_data['page_name']  = 'add_multiple_score';
        $page_data['page_title'] = get_phrase('add_student_score');
        $this->load->view('backend/index', $page_data);
    }