<?php
// header("Content-Security-Policy: default-src 'none'; script-src 'self'; connect-src 'self'; img-src 'self'; style-src 'self';");
defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
\PhpOffice\PhpSpreadsheet\Shared\File::setUseUploadTempDirectory(true);
class Myir extends CI_Controller {

    public function __construct()
    {
            parent::__construct();
            // Your own constructor code
            $this->load->library('session');
            $this->load->model('myir_model');
    }

	public function index()
	{
        // $this->load->helper('url');
        // $this->load->view('login');  
        echo "pindah ke kawal.manjainsbu.com";
    }
    public function dologin()
    {
        
        // $this->load->model('myir_model');
        $data['query']=$this->myir_model->select_user($this->input->post());
        $username=$this->input->post('username');
        if ($data['query'] != NULL){ 
            $this->session->set_userdata('username',$data['query'][0]->login_username);
            $this->session->set_userdata('agency',$data['query'][0]->login_agency);
            $data['jmlinputan']=$this->myir_model->getJumlahSCBE();
            $data['jmlfua2']=$this->myir_model->getJumlahFuA2();
            $data['jmlfusc']=$this->myir_model->getJumlahFuSC();
            $data['ranking']=$this->myir_model->getRankingAgency();
            if ($data['jmlinputan'][0]->jml!=0)
                {$data['persenvalid']=($data['jmlfua2'][0]->jml/$data['jmlinputan'][0]->jml)*100;}
            else
                {$data['persenvalid']=0;}
            $this->load->view('dashboard',$data);
            // var_dump($data);
		}
		else{
            // echo "salah";
			return redirect()->to('login');
		}
	}

	public function logout(){
		// $this->session->unset_userdata($newdata);
		$this->session->sess_destroy();
		redirect('');
    }
    
    public function dashboard(){
        $user=$this->session->userdata('username');
        if(isset($user)){
            // $this->load->model('myir_model');
            $data['jmlinputan']=$this->myir_model->getJumlahSCBE();
            $data['jmlfua2']=$this->myir_model->getJumlahFuA2();
            $data['jmlfusc']=$this->myir_model->getJumlahFuSC();
            $data['ranking']=$this->myir_model->getRankingAgency();
            if ($data['jmlinputan'][0]->jml!=0)
                {$data['persenvalid']=($data['jmlfua2'][0]->jml/$data['jmlinputan'][0]->jml)*100;}
            else
                {$data['persenvalid']=0;}
            $this->load->view('dashboard',$data);
            // var_dump($data['jmlinputan']);
        }else{
            redirect('');
        }
        
    }
    
    //---------------------------------//
    //-------------INFO----------------//
    //............MENU A2..............//
    //---------------------------------//
    //---------------------------------//

    public function praorder(){
        $user=$this->session->userdata('username');
        if(isset($user)){
            // $this->load->model('myir_model');
            $data['query']=$this->myir_model->getDataScbe();
            $this->load->view('fua2',$data);
            // var_dump($data['query']);
            // echo date('Y-m-d',str);
        }else{
            redirect('');
        }
    }

    public function filtera2tanggal(){
        // $this->load->library('session');
        $user=$this->session->userdata('username');
        if(isset($user)){
            // $this->load->model('myir_model');
            $startdate=date('Y-m-d',strtotime($this->input->post('start')));
            $enddate=date('Y-m-d',strtotime($this->input->post('end')));
            $data['query']=$this->myir_model->getFilterA2($startdate,$enddate);
            $this->load->view('fua2',$data);
            // echo $enddate;
        }else{
            redirect('');
        }
    }

    public function followup(){
        $user=$this->session->userdata('username');
        if(isset($user)){
            $datamyir=$this->uri->segment(3);
            // $this->load->model('myir_model');
            // echo $datamyir;
            $data['query']=$this->myir_model->getDataFollowUp($datamyir);

            // echo $data['query'];
            // var_dump($data['query']);

            $this->load->view('followup',$data);
        }else{
            redirect('');
        }
    }

    public function dofollowup(){
        $user=$this->session->userdata('username');
        if(isset($user)){
            // $this->load->model('myir_model');
            $data=$this->input->post();
            $insert=$this->myir_model->insertFollowUp($data);
            $insert=$this->myir_model->insertNotifA2($data);
            $data['query']=$this->myir_model->getDataScbe();
            $this->load->view('fua2',$data);
            // var_dump($data);
        }else{
            redirect('');
        }
    }

    public function editfua2(){
        $user=$this->session->userdata('username');
        if(isset($user)){
            $datamyir=$this->uri->segment(3);
            $data['query']=$this->myir_model->getDataFollowUpA2($datamyir);
            $this->load->view('editfua2',$data);
        }else{
            redirect('');
        }
    }

    public function doeditfua2(){
        $data=$this->input->post();
        $this->myir_model->editFuA2($data);
        $this->myir_model->insertNotifA2($data);
        $data['query']=$this->myir_model->getDataScbe();
        $this->load->view('fua2',$data);
    }

    public function rekapfu(){
        $user=$this->session->userdata('username');
        if(isset($user)){
            // $this->load->model('myir_model');
            // $this->load->library('session');
            $user=$this->session->userdata('username');
            $data['query']=$this->myir_model->getRekapFu($user);
            $this->load->view('rekapfu',$data);
        }else{
            redirect('');
        }
    }

    public function filterrekapa2(){
        $user=$this->session->userdata('username');
        if(isset($user)){
            // $this->load->model('myir_model');
            // $this->load->library('session');
            $user=$this->session->userdata('username');
            $startdate=date('Y-m-d',strtotime($this->input->post('start')));
            $enddate=date('Y-m-d',strtotime($this->input->post('end')));
            $data['query']=$this->myir_model->getFilterRekapA2($user,$startdate,$enddate);
            $this->load->view('rekapfu',$data);
        }else{
            redirect('');
        }
    }

    public function rekapallfu(){
        $user=$this->session->userdata('username');
        if(isset($user)){
            // $this->load->model('myir_model');
            // $this->load->library('session');
            $user=$this->session->userdata('username');
            $data['query']=$this->myir_model->getAllDataScbe();
            $this->load->view('rekapallfu',$data);
        }else{
            redirect('');
        }
    }

    public function filterrekapalla2(){
        $user=$this->session->userdata('username');
        if(isset($user)){
            // $this->load->model('myir_model');
            // $this->load->library('session');
            $user=$this->session->userdata('username');
            $startdate=date('Y-m-d',strtotime($this->input->post('start')));
            $enddate=date('Y-m-d',strtotime($this->input->post('end')));
            $data['query']=$this->myir_model->filterRekapDataScbe($startdate,$enddate);
            $this->load->view('rekapallfu',$data);
        }else{
            redirect('');
        }
    }

    public function cekdobelinput(){
        // $user=$this->session->userdata('username');
        // if(isset($user)){
            $ss=$this->input->post();
            // $this->load->model('myir_model');
            $dobelnama=$this->myir_model->cekDoubleNama($ss['trackid']);
            $dobeltelp=$this->myir_model->cekDoubleNotel($ss['cp']);
            
            if($dobelnama[0]->dobelnama=='0' && $dobeltelp[0]->dobelcp=='0'){
                echo '0';
            }else{
                // echo var_dump($dobelnama);
                echo '1';
            }
            // echo var_dump($dobeltelp);
            // echo $dobeltelp[0]->dobelcp;
        // }else{
        //     redirect('');
        // }
        
    }

    public function sudahterfeedback(){
        $user=$this->session->userdata('username');
        if(isset($user)){
            // $this->load->model('myir_model');
            // $this->load->library('session');
            $user=$this->session->userdata('username');
            $data['query']=$this->myir_model->getRekapFeedback($user);
            $this->myir_model->updateNotifA2($_SESSION['username']);
            $this->load->view('sudahterfeedback',$data);
        }else{
            redirect('');
        }
    }


    //---------------------------------//
    //-------------INFO----------------//
    //............MENU HS..............//
    //---------------------------------//
    //---------------------------------//


    public function followupsc(){
        $user=$this->session->userdata('username');
        if(isset($user)){
            // $this->load->model('myir_model');
            $data['query']=$this->myir_model->getDataFUSC();
            $this->myir_model->updateNotifConsumer($_SESSION['agency']);
            $this->load->view('followupsc',$data);
        }else{
            redirect('');
        }
    }

    public function filterfusc(){
        $user=$this->session->userdata('username');
        if(isset($user)){
            // $this->load->model('myir_model');
            $startdate=date('Y-m-d',strtotime($this->input->post('start')));
            $enddate=date('Y-m-d',strtotime($this->input->post('end')));
            $data['query']=$this->myir_model->getFilterFUSC($startdate,$enddate);
            $this->load->view('followupsc',$data);
            // var_dump($data);
        }else{
            redirect('');
        }
    }

    public function dofollowupsc(){
        $user=$this->session->userdata('username');
        if(isset($user)){
            $datamyir=$this->uri->segment(3);
            // $this->load->model('myir_model');
            $data['query']=$this->myir_model->getDataFollowUpSC($datamyir);
            // var_dump($data['query']);
            $this->load->view('fusc',$data);
        }else{
            redirect('');
        }
    }

    public function editfusc(){
        $user=$this->session->userdata('username');
        if(isset($user)){
            $datamyir=$this->uri->segment(3);
            // $this->load->model('myir_model');
            $data['query']=$this->myir_model->getDataFollowUpSC($datamyir);
            // var_dump($data['query']);
            $this->load->view('editfusc',$data);
        }else{
            redirect('');
        }
    }

    public function updatefusc(){
        $user=$this->session->userdata('username');
        if(isset($user)){
            $data=$this->input->post();
            $insert=$this->myir_model->updateFollowUpSc($data);
            $this->myir_model->insertNotifConsumer($data);
            $data['query']=$this->myir_model->getDataFUSC();
            
            $this->load->view('rekapdatascbe',$data);
        }else{
            redirect('');
        }
    }

    public function insertsc(){
        $user=$this->session->userdata('username');
        if(isset($user)){
            // $this->load->model('myir_model');
            $data=$this->input->post();
            $insert=$this->myir_model->insertFollowUpSc($data);
            $this->myir_model->insertNotifConsumer($data);
            $data['query']=$this->myir_model->getDataFUSC();
            // var_dump($data['query']);
            $this->load->view('followupsc',$data);
        }else{
            redirect('');
        }
    }

    public function rekapdatascbe(){
        $user=$this->session->userdata('username');
        if(isset($user)){
            // $this->load->model('myir_model');
            $data['query']=$this->myir_model->getAllDataScbe();
            // var_dump($data['query']);
            $this->load->view('rekapdatascbe',$data);
        }else{
            redirect('');
        }

    }
    public function filterrekapscbe(){
        $user=$this->session->userdata('username');
        if(isset($user)){
            // $this->load->model('myir_model');
            $startdate=date('Y-m-d',strtotime($this->input->post('start')));
            $enddate=date('Y-m-d',strtotime($this->input->post('end')));
            $data['query']=$this->myir_model->filterRekapDataScbe($startdate,$enddate);
            // var_dump($startdate);
            // echo "<br>";
            // var_dump($enddate);
            $this->load->view('rekapdatascbe',$data);
        }else{
            redirect('');
        }

    }


    

    public function uploaddata(){
        $user=$this->session->userdata('username');
        if(isset($user)){
            $this->load->view('uploaddata');
        }else{
            redirect('');
        }
	}

	public function doupload(){
        

        $filedata=$_FILES['datascbe'];
        $type=explode('.',$_FILES['datascbe']['name']);
		$fileName='tempscbe'.date('YmdHis').'.'.$type[1];
        
        
        $config['upload_path'] = './assets/'; 
        $config['file_name'] = $fileName;
        $config['allowed_types'] = 'xls|xlsx|csv';
		$config['max_size'] = 10000;
        $config['overwrite'] = TRUE;

        $this->load->library('upload');
        $this->upload->initialize($config);
        
        if(! $this->upload->do_upload('datascbe') )
            $this->upload->display_errors();

        $media = $this->upload->data('datascbe');
		$inputFileName = './assets/'.$fileName;

        $inputFileType= \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
        $reader= \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
        $spreadsheet=$reader->load($inputFileName);
        $sheet=$spreadsheet->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();
        
        // $this->load->model('myir_model');
		
		$datas['counter']=0;
		for ($row = 2; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
			$rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,NULL,TRUE,FALSE);
			$qry=$this->myir_model->select_sto($rowData[0][3]);
			
			if ($rowData[0][0]==NULL){
				$highestRow=$row;
				break;
            }else{
                if($qry==NULL){
                    $sto=NULL;
                }else{
                    $sto=$qry[0]->odp_sto;
                }
                $agent=explode(";",$rowData[0][9]);
                
                
                if (isset($agent[2])){
                    $kodesales=explode("-",$agent[2]);
                    if (array_key_exists(1,$kodesales)){
                        $mobi=$kodesales[1];
                    }else{
                        $mobi='';
                    }
                }else{
                    $kodesales[0]='';
                    $mobi='';
                    // echo $rowData[0][8];
                }
                if (isset($agent[4])){
                    $cp=$agent[4];
                }else{
                    $cp='';
                }
                // $cp=$agent[4];
                $data = array(
                    "trackid"=> $rowData[0][0],
                    // "orderdate"=> date('Y-m-d H:i:s'),
                    // "orderdate"=> date("Y-m-d", strtotime("+43732.544131944 month", $rowData[0][1])),
                    "orderdate"=>$rowData[0][14],
                    "custname"=> $rowData[0][2],
                    "alpro"=> $rowData[0][3],
                    "tnnumber"=> $rowData[0][4],
                    "orderstatus"=>$rowData[0][5],
                    "witel"=>$rowData[0][6],
                    "appointment"=>'0000-00-00 00:00:00',
                    "transaction"=>$rowData[0][8],
                    "kcontact"=>$rowData[0][9],
                    "cp"=>$cp,
                    "addressinst"=>$rowData[0][10],
                    "package"=>$rowData[0][11],
                    "sto"=>$sto,
                    "agent"=>strtoupper($kodesales[0]),
                    "mobi"=>$mobi,
                    "uploaddate"=>date('Y-m-d H:i:s')
                    // "agenta2"=>''
                );
                $insert=$this->myir_model->insert_scbe($data);
                
                $datas['counter']=$datas['counter']+$insert;
                // var_dump($data);
                // echo "<br><br><br>";
            }	 
		}
		unlink($inputFileName);
		
		$this->load->view('uploaddata',$datas);
    }

    public function uploaddataps(){
        $user=$this->session->userdata('username');
        if(isset($user)){
            $this->load->view('uploaddataps');
        }else{
            redirect('');
        }
    }

    public function douploadps(){
        require 'vendor/autoload.php';

        $filedata=$_FILES['datascbe'];
        $type=explode('.',$_FILES['datascbe']['name']);
		$fileName='tempps'.date('YmdHis').'.'.$type[1];
        
        
        $config['upload_path'] = './assets/'; 
        $config['file_name'] = $fileName;
        $config['allowed_types'] = 'xls|xlsx|csv';
		$config['max_size'] = 10000;
        $config['overwrite'] = TRUE;

        $this->load->library('upload');
        $this->upload->initialize($config);
        
        if(! $this->upload->do_upload('datascbe') )
            $this->upload->display_errors();

        $media = $this->upload->data('datascbe');
		$inputFileName = './assets/'.$fileName;

        $inputFileType= \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
        $reader= \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
        $spreadsheet=$reader->load($inputFileName);
        $sheet=$spreadsheet->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();
        
        // $this->load->model('myir_model');
        // echo $highestRow;
		
		$datas['counter']=0;
		for ($row = 2; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,NULL,TRUE,FALSE);
            if ($rowData[0][0]==NULL){
				$highestRow=$row;
				break;
            }else{
                $data = array(
                    "trackid"=> $rowData[0][0],
                    "psdate"=>$rowData[0][3],
                    "psstatus"=>$rowData[0][2],
                );
                $insert=$this->myir_model->insertps($data);
                
                $datas['counter']=$datas['counter']+$insert;
            }
            // var_dump($data);
            // echo "<br><br><br>";
            
		}
		unlink($inputFileName);
		
		$this->load->view('uploaddataps',$datas);
    }


    //---------------------------------//
    //-------------INFO----------------//
    //..........MENU AGENCY............//
    //---------------------------------//
    //---------------------------------//


    public function feedbackagency(){
        $user=$this->session->userdata('username');
        if(isset($user)){
            // $this->load->model('myir_model');
            // $this->load->library('session');
            $user=$this->session->userdata('username');
            $data['query']=$this->myir_model->getFeedbackAgency($user);
            $this->myir_model->updateNotifAgency($_SESSION['agency']);
            $this->load->view('feedbackagency',$data);
        }else{
            redirect('');
        }
    }

    public function filterfeedbackagency(){
        $user=$this->session->userdata('username');
        if(isset($user)){
            // $this->load->model('myir_model');
            // $this->load->library('session');
            $user=$this->session->userdata('username');
            $startdate=date('Y-m-d',strtotime($this->input->post('start')));
            $enddate=date('Y-m-d',strtotime($this->input->post('end')));
            $data['query']=$this->myir_model->getFilterFeedbackAgency($user,$startdate,$enddate);
            $this->load->view('feedbackagency',$data);
        }else{
            redirect('');
        }
    }

    public function rekapagency(){
        $user=$this->session->userdata('username');
        if(isset($user)){
            // $this->load->model('myir_model');
            // $this->load->library('session');
            $user=$this->session->userdata('username');
            $data['query']=$this->myir_model->getRekapAgency($user);
            $this->load->view('rekapagency',$data);
        }else{
            redirect('');
        }
    }

    public function dofeedbackagency($array){
        $user=$this->session->userdata('username');
        if(isset($user)){
            // $this->load->model('myir_model');
            $data['query']=$this->myir_model->getDataFeedbackAgency($array);
            // var_dump($data['query']);
            $this->load->view('inputfeedback',$data);
        }else{
            redirect('');
        }
        
    }

    public function insertfeedback(){
        $user=$this->session->userdata('username');
        if(isset($user)){
            $input=$this->input->post();
            // $this->load->model('myir_model');
            // $this->load->library('session');
            $user=$this->session->userdata('username');
            $query=$this->myir_model->insertFeedbackAgency($input);
            $query=$this->myir_model->insertNotifAgency($input);
            $data['query']=$this->myir_model->getRekapAgency($user);
            // var_dump($data);
            $this->load->view('feedbackagency',$data);
        }else{
            redirect('');
        }
    }

    

    public function filterrekapagency(){
        $user=$this->session->userdata('username');
        if(isset($user)){
            $startdate=date('Y-m-d',strtotime($this->input->post('start')));
            $enddate=date('Y-m-d',strtotime($this->input->post('end')));
            // $this->load->library('session');
            // $this->load->model('myir_model');
            
            $user=$this->session->userdata('username');
            $data['query']=$this->myir_model->getFilterRekapAgency($user,$startdate,$enddate);
            $this->load->view('rekapagency',$data);
        }else{
            redirect('');
        }
    }


    //---------------------------------//
    //-------------INFO----------------//
    //..........MENU ADMIN.............//
    //---------------------------------//
    //---------------------------------//


    public function adduser(){
        $user=$this->session->userdata('username');
        if(isset($user)){
            // $this->load->model('myir_model');
            $data['query']=$this->myir_model->getAgency();
            $this->load->view('adduser',$data);
        }else{
            redirect('');
        }

    }

    public function insertuser(){
        $user=$this->session->userdata('username');
        if(isset($user)){
            // $this->load->model('myir_model');
            $username=$this->input->post('username');
            $passwd=md5($this->input->post('passwd'));
            $nama=$this->input->post('nama');
            $agency=$this->input->post('agency');
            // echo $agency;
            $data['result']=$this->myir_model->insertUser($username,$passwd,$nama,$agency);
            $data['query']=$this->myir_model->getAgency();
            $this->load->view('adduser',$data);
            // var_dump($data);
        }else{
            redirect('');
        }

    }

    public function edituser(){
        $user=$this->session->userdata('username');
        if(isset($user)){
            $data['query']=$this->myir_model->getAllUser();
            $this->load->view('edituser',$data);
            // var_dump($data);
        }else{
            redirect('');
        }
    }

    public function deleteuser(){
        $user=$this->session->userdata('username');
        if(isset($user)){
            $userid=$this->uri->segment(3);
            $data['result']=$this->myir_model->deleteUser($userid);
            $data['query']=$this->myir_model->getAllUser();
            $this->load->view('edituser',$data);
        }else{
            redirect('');
        }
    }

    public function addkcontact(){
        $user=$this->session->userdata('username');
        if(isset($user)){
            $this->load->view('uploadkcontact');
        }else{
            redirect('');
        }
    }

    public function douploadkcontact(){
        require 'vendor/autoload.php';

        $filedata=$_FILES['datakcontact'];
        $type=explode('.',$_FILES['datakcontact']['name']);
		$fileName='tempkcontact'.date('YmdHis').'.'.$type[1];
        
        
        $config['upload_path'] = './assets/'; 
        $config['file_name'] = $fileName;
        $config['allowed_types'] = 'xls|xlsx|csv';
		$config['max_size'] = 10000;
        $config['overwrite'] = TRUE;

        $this->load->library('upload');
        $this->upload->initialize($config);
        
        if(! $this->upload->do_upload('datakcontact') )
            $this->upload->display_errors();

        $media = $this->upload->data('datakcontact');
		$inputFileName = './assets/'.$fileName;

        $inputFileType= \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
        $reader= \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
        $spreadsheet=$reader->load($inputFileName);
        $sheet=$spreadsheet->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();
        
        // $this->load->model('myir_model');
        // echo $highestRow;
		
		$datas['counter']=0;
		for ($row = 2; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,NULL,TRUE,FALSE);
            if ($rowData[0][0]==NULL){
				$highestRow=$row;
				break;
            }else{
                $data = array(
                    "kc_id"=> $rowData[0][0],
                    "kc_name"=>$rowData[0][1],
                    "kc_cp"=>$rowData[0][2],
                    "kc_cp2"=>$rowData[0][3],
                    "kc_email"=>$rowData[0][4],
                    "kc_alamat"=>$rowData[0][5],
                    "kc_agency"=>$rowData[0][6]
                );
                $insert=$this->myir_model->insertkcontact($data);
                
                $datas['counter']=$datas['counter']+$insert;
            }
            // var_dump($data);
            // echo "<br><br><br>";
            
		}
		unlink($inputFileName);
		
		$this->load->view('uploadkcontact',$datas);
    }

    public function editkcontact(){
        $user=$this->session->userdata('username');
        if(isset($user)){
            $data['query']=$this->myir_model->getAllKcontact();
            $this->load->view('editkcontact',$data);
        }else{
            redirect('');
        }
    }

    public function addagency(){
        $user=$this->session->userdata('username');
        if(isset($user)){
            
            $this->load->view('addagency');
        }else{
            redirect('');
        }
    }

    public function insertagency(){
        $user=$this->session->userdata('username');
        if(isset($user)){
            $agencyname=$this->input->post('agencyname');
            $data['result']=$this->myir_model->insertAgency($agencyname);
            $this->load->view('addagency',$data);
        }else{
            redirect('');
        }
    }

    public function editagency(){
        $user=$this->session->userdata('username');
        if(isset($user)){
            $data['query']=$this->myir_model->getAllAgency();
            $this->load->view('editagency',$data);
        }else{
            redirect('');
        }
    }

    public function deleteagency(){
        $user=$this->session->userdata('username');
        if(isset($user)){
            $agnid=$this->uri->segment(3);
            $data['result']=$this->myir_model->deleteAgency($agnid);
            $data['query']=$this->myir_model->getAllAgency();
            $this->load->view('editagency',$data);
            // return redirect()->to('editagency');
        }else{
            redirect('');
        }
        
    }
    
    //---------------------------------//
    //-------------INFO----------------//
    //..........MENU NOTIF.............//
    //---------------------------------//
    //---------------------------------//
    
    public function getdataperso(){
        $user=$this->session->userdata('username');
        if(isset($user)){
            $query=$this->myir_model->getGrafikSO();
            // $data['trackid']=$query[0]->notif_trackid;
            // $data['user']=$query[0]->notif_userid;
            echo json_encode($query);
            // var_dump($query);
            // echo "'labels' : ['BBE', 'GSK', 'KBL', 'KJR', 'KLN', 'KNN', 'KPS', 'KRP', 'LKI', 'LMG', 'MGO', 'TNS'], ".
            //     "'series': [[";
            // $data=$query->result();
            // var_dump($data);
            // echo count($query);
            // for($i=0;$i<count($query);$i++){
            //     if ($i<count($query)-1){
            //         echo $query[$i]->input.', ';
            //     }else{
            //         echo $query[$i]->input;
            //     }
            // }
            // // echo '],[';
            // for($i=0;$i<count($query);$i++){
            //     if ($i<count($query)-1){
            //         echo $query[$i]->valid.', ';
            //     }else{
            //         echo $query[$i]->valid;
            //     }
            // }
            // echo ']]';
            // foreach($query as $row){
            //     echo $row->input.', ';
            // }
            // echo json_encode("tes");
            // var_dump($query);
            // return $data;
        }else{
            redirect('');
        }
    }

    public function getnotifagency(){
        $user=$this->session->userdata('username');
        if(isset($user)){
            $query=$this->myir_model->getNotifAgency();
            $data['trackid']=$query[0]->notif_trackid;
            // $data['user']=$query[0]->notif_userid;
            echo json_encode($query);
            // echo json_encode("tes");
            // var_dump($query);
            // return $data;
        }else{
            redirect('');
        }
    }

    public function clearnotif(){
        $user=$this->session->userdata('username');
        if(isset($user)){
            $data=$this->input->post();
            if ($data['agency']=='AGN00075' || $data['agency']=='AGN00001' || $data['agency']=='AGN00002'){
                $q=$this->myir_model->updateNotifWitel($data['agency']);
            }else if($data['agency']=='AGN00074'){
                $q=$this->myir_model->updateNotifConsumer($data['agency']);
            }else if ($data['agency']=='AGN00073'){
                $q=$this->myir_model->updateNotifA2($_SESSION['username']);
            }else{
                $q=$this->myir_model->updateNotifAgency($data['agency']);
            }
        }else{
            redirect('');
        }
        
    }

    public function getnotifa2(){
        $user=$this->session->userdata('username');
        if(isset($user)){
            $query=$this->myir_model->getNotifA2();
            // $data['trackid']=$query[0]->notif_trackid;
            // $data['user']=$query[0]->notif_userid;
            // echo $_SESSION['username'];
            echo json_encode($query);
        }else{
            redirect('');
        }
    }

    public function getnotifcons(){
        $user=$this->session->userdata('username');
        if(isset($user)){
            $query=$this->myir_model->getNotifConsumer();
            // $data['trackid']=$query[0]->notif_trackid;
            // $data['user']=$query[0]->notif_userid;
            echo json_encode($query);
        }else{
            redirect('');
        }
    }

    public function lihatNotif(){
        $user=$this->session->userdata('username');
        if(isset($user)){
            if($_SESSION['agency']=='AGN00073'){

            }else if ($_SESSION['agency']=='AGN00074'){

            }else if ($_SESSION['agency']=='AGN00075'||$_SESSION['agency']=='AGN00001'||$_SESSION['agency']=='AGN00002'){

            }else{
                
            }
        }else{
            redirect('');
        }
    }

    public function getnotifwitel(){

    }


    //---------------------------------//
    //-------------INFO----------------//
    //...........DOWNLOAD..............//
    //---------------------------------//
    //---------------------------------//

    public function downloaddata(){
        // Create new Spreadsheet object
        ini_set("max_execution_time", 'time_limit');


        ini_set('memory_limit', '-1');
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        // Set document properties
        $spreadsheet->getProperties()->setCreator('telkom.co.id')
        ->setLastModifiedBy('Telkom Witel Surabaya Utara')
        ->setTitle('Data SCBE Sumber manjainsbu.com')
        ->setSubject('950039')
        ->setDescription('950039');
        // add style to the header
        $styleArray = array(
        'font' => array(
            'bold' => true,
        ),
        'alignment' => array(
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        ),
        'borders' => array(
            'bottom' => array(
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                'color' => array('rgb' => '333333'),
            ),
        ),
        'fill' => array(
            'type'       => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
            'rotation'   => 90,
            'startcolor' => array('rgb' => '0d0d0d'),
            'endColor'   => array('rgb' => 'f2f2f2'),
        ),
        );
        $spreadsheet->getActiveSheet()->getStyle('A1:G1')->applyFromArray($styleArray);
        // auto fit column to content
        foreach(range('A', 'R') as $columnID) {
            $spreadsheet->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
        }
        // set the names of header cells
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Track ID');
        $sheet->setCellValue('C1', 'Order Date');
        $sheet->setCellValue('D1', 'Customer Name');
        $sheet->setCellValue('E1', 'Witel');
        $sheet->setCellValue('F1', 'CP Valid');
        $sheet->setCellValue('G1', 'Alamat Valid');
        $sheet->setCellValue('H1', 'K-Contact');
        $sheet->setCellValue('I1', 'Agency');
        $sheet->setCellValue('J1', 'STO');
        $sheet->setCellValue('K1', 'OK/NOK');
        $sheet->setCellValue('L1', 'Keterangan Verifikasi');
        $sheet->setCellValue('M1', 'Detail Verifikasi');
        $sheet->setCellValue('N1', 'Manja');
        $sheet->setCellValue('O1', 'Tindak Lanjut');
        $sheet->setCellValue('P1', 'Feedback Agency');
        $sheet->setCellValue('Q1', 'SCID');
        $sheet->setCellValue('R1', 'Status PS');
        
        $startdate=date('Y-m-d',strtotime($this->input->post('start')));
        $enddate=date('Y-m-d',strtotime($this->input->post('end')));
        
        // $agency=$this->myir_model->getUserAgency($_SESSION['username']);
        // $agn=$agency[0]->login_agency;
        if($_SESSION['agency']=='AGN00073'){
            // echo "A2";
            $getdata=$this->myir_model->getFilterRekapA2($_SESSION['username'],$startdate,$enddate);
        }else if($_SESSION['agency']=='AGN00001' || $_SESSION['agency']=='AGN00074' || $_SESSION['agency']=='AGN00075'){
            // echo "inputter";
            $getdata=$this->myir_model->filterRekapDataScbe($startdate,$enddate);
        }else{
            // echo "else";
            $getdata = $this->myir_model->getFilterRekapAgency($_SESSION['username'],$startdate,$enddate);
        }
        
        // var_dump($agn);
        // echo $agency[0]->login_agency;
        // Add some data
        $x = 2;
        $n=1;
        foreach($getdata as $get){
            $sheet->setCellValue('A'.$x, $n);
            $sheet->setCellValue('B'.$x, $get->scbe_trackid);
            $sheet->setCellValue('C'.$x, $get->scbe_orderdate);
            $sheet->setCellValue('D'.$x, $get->scbe_custname);
            $sheet->setCellValue('E'.$x, $get->scbe_witel);
            $sheet->setCellValue('F'.$x, $get->fu_validcp);
            $sheet->setCellValue('G'.$x, $get->fu_alamat);
            $sheet->setCellValue('H'.$x, $get->scbe_kcontact);
            $sheet->setCellValue('I'.$x, $get->agn_name);
            $sheet->setCellValue('J'.$x, $get->fu_sto);
            $sheet->setCellValue('K'.$x, $get->oknok);
            $sheet->setCellValue('L'.$x, $get->keterangana2);
            $sheet->setCellValue('M'.$x, $get->fu_detilketerangan);
            $sheet->setCellValue('N'.$x, $get->fu_manja);
            $sheet->setCellValue('O'.$x, $get->feedback);
            $sheet->setCellValue('P'.$x, $get->feed_feedback);
            $sheet->setCellValue('Q'.$x, $get->fusc_scid);
            $sheet->setCellValue('R'.$x, '');
            $x++;
            $n++;
        }
        
        $writer = new Xlsx($spreadsheet);
        
        header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="praorder.xlsx"'); 
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        // var_dump($getdata);
    }


    public function gantipassword(){
        $user=$this->session->userdata('username');
        if(isset($user)){
            $data['username']=$this->session->userdata('username');
            $this->load->view('gantipassword',$data);
        }else{
            redirect('');
        }
    }

    public function dogantipassword(){
        $input=$this->input->post();
        $pass=$this->myir_model->selectPass(md5($input['passwordlama']));
        if ($pass==1){
            if(md5($input['passwordbaru1'])==md5($input['passwordbaru2'])){
                $this->myir_model->updatePassword($this->session->userdata('username'),md5($input['passwordbaru1']));
                $data['flag']='1';
                $data['pesan']='Password baru tidak sama';
            }else{
                $data['flag']='0';
                $data['pesan']='Password baru tidak sama';
            }
        }else{
            $data['flag']='0';
            $data['pesan']='Password lama tidak sesuai';
            
        }
        $this->load->view('gantipassword',$data);
        // var_dump($pass);
    }
}
