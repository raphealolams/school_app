<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

    /*
     *	@author : WIlliams Isaac
     *  @emai   :<williamscalg@gmail.com>
     *	date	: 4 August, 2015
     *	M-School  Management Application
     *	http://www.meshable.com.ng
     */

class Install extends CI_Controller
{


    /***default functin, redirects to login page if no admin logged in yet***/
    public function index()
    {
        $this->load->view('backend/install');
    }



}
