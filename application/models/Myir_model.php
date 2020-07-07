<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Myir_model extends CI_Model{
    
    public function select_user($array){
        $query = $this->db->query("SELECT * FROM myir_login where login_username='".$array['username']."' and login_passwd=md5('".($array['passwd'])."') ");
        return $query->result();
    }

    public function getJumlahSCBE(){
        $query=$this->db->query("SELECT COUNT(s.scbe_trackid) as jml 
        
        FROM myir_scbe s
        LEFT JOIN myir_sto st ON st.sto_name=s.scbe_sto
        
        WHERE s.scbe_uploaddate LIKE '".date('Y-m-d')."%' 
        AND st.sto_datel='SURABAYA UTARA' ");
        return $query->result();
    }

    public function getJumlahFuA2(){
        $query=$this->db->query("SELECT COUNT(fu_trackid) as jml FROM myir_fua2 
        WHERE fu_fudate LIKE '".date('Y-m-d')."%' 
        AND fu_needfeedback='VAL016' ");
        return $query->result();
    }

    public function getJumlahFuSC(){
        $query=$this->db->query("SELECT COUNT(fusc_trackid) as jml FROM myir_fusc WHERE fusc_fudate LIKE '".date('Y-m-d')."%' ");
        return $query->result();

    }

    public function getRankingAgency(){
        $date=date('Y-m-d');
        $query=$this->db->query("SELECT count(a.agn_id) as jmlinputscbe, count(f.fu_trackid) as jmlvalid, 
        count(f.fu_trackid)/count(a.agn_id)*100 as persen, a.agn_name,count(p.ps_trackid) as jmlps,
        (count(a.agn_id)*2)+(count(f.fu_trackid)/count(a.agn_id)*100) as poinjmlinput, 
        count(p.ps_trackid)/count(f.fu_trackid)*100 as persenps
        -- jmlps/jmlvalid*100 as persenps
        
        FROM myir_scbe s 
        LEFT JOIN myir_sto st ON st.sto_name=s.scbe_sto
        LEFT JOIN myir_kcontact k ON k.kc_id=s.scbe_agent 
        LEFT JOIN myir_agency a ON a.agn_id=k.kc_agency 
        LEFT JOIN myir_fua2 f ON f.fu_trackid=s.scbe_trackid AND f.fu_oknok='VAL000'
        LEFT JOIN myir_dataps p ON p.ps_trackid=s.scbe_trackid
        WHERE DATE(s.scbe_orderdate) >= '".date('Y-m-01')."%'
        AND DATE(s.scbe_orderdate) <= '".date('Y-m-d')."%'
        AND st.sto_datel='SURABAYA UTARA'
        
        group by a.agn_id order by poinjmlinput DESC, persen ");
        return $query->result();

    }

    public function select_sto($data){
        $query=$this->db->query("SELECT odp_sto FROM myir_odp WHERE odp_name='".$data."'");
        return $query->result();
        //echo $data;
    }

    public function insert_scbe($array){
        $this->db->where('scbe_trackid',$array['trackid']);
        $this->db->from('myir_scbe');
        $count = $this->db->count_all_results();
        
        if ($count==0) {
            //some logics here, you may create some string here to alert user
            $this->db->query("INSERT INTO myir_scbe VALUES('".$array['trackid']."','".$array['orderdate']."','".$this->db->escape_str($array['custname'])."','".$array['alpro']."',
            '".$array['tnnumber']."', '".$array['orderstatus']."','".$array['witel']."','".$array['appointment']."','".$array['transaction']."',
            '".$this->db->escape_str($array['kcontact'])."','".$array['cp']."','".$this->db->escape_str($array['addressinst'])."','".$this->db->escape_str($array['package'])."',
            '".$array['sto']."','".$array['agent']."','".$array['mobi']."','".$array['uploaddate']."' )");
            return 1;
        } else {
            //other logics here
            return 0;
        }
    }

    public function insertps($array){
        $this->db->where('ps_trackid',$array['trackid']);
        $this->db->from('myir_dataps');
        $count = $this->db->count_all_results();
        
        if ($count==0) {
            $this->db->query("INSERT INTO myir_dataps VALUES('".$array['trackid']."','".$array['psdate']."','".$array['psstatus']."')");
            return 1;
        }else{
            $this->db->query("UPDATE myir_dataps SET 
            ps_psdate='".$array['psdate']."',
            ps_status='".$array['psstatus']."' 
            WHERE ps_trackid='".$array['trackid']."' ");
            return 1;
        }
    }

    public function insertkcontact($array){
        $this->db->where('kc_id',$array['kc_id']);
        $this->db->from('myir_kcontact');
        $count = $this->db->count_all_results();
        
        if ($count==0) {
            $this->db->query("INSERT INTO myir_kcontact VALUES('".$array['kc_id']."','".$array['kc_name']."','".$array['kc_cp']."','".$array['kc_cp2']."',
            '".$array['kc_email']."','".$array['kc_alamat']."','".$array['kc_agency']."',NULL)");
            return 1;
        }else{
            $this->db->query("UPDATE myir_kcontact SET 
            kc_name='".$array['kc_name']."',
            kc_cp='".$array['kc_cp']."',
            kc_cp2='".$array['kc_cp2']."',
            kc_email='".$array['kc_email']."',
            kc_alamat='".$array['kc_alamat']."',
            kc_agency='".$array['kc_agency']."'
            WHERE kc_id='".$array['kc_id']."' ");
            return 1;
        }
    }

    public function getAllKcontact(){
        $query=$this->db->query("SELECT * FROM myir_kcontact k
        LEFT JOIN myir_agency a ON k.kc_agency=a.agn_id");
        return $query->result();
    }

    public function getDataScbe(){
        $query=$this->db->query("SELECT * FROM myir_scbe s 
        LEFT JOIN myir_fua2 f ON s.scbe_trackid=f.fu_trackid 
        LEFT JOIN myir_kcontact k ON k.kc_id=s.scbe_agent
        LEFT JOIN myir_agency a ON a.agn_id=k.kc_agency
        WHERE f.fu_trackid IS NULL 
        AND DATE(s.scbe_uploaddate) >= '".date('Y-m-d',strtotime("-1 day"))."%'
        AND DATE(s.scbe_uploaddate) <= '".date('Y-m-d')."%'
        ORDER BY s.scbe_orderdate ASC");
        return $query->result();
    }

    public function getFilterA2($start,$end){
        $query=$this->db->query("SELECT * FROM myir_scbe s 
        LEFT JOIN myir_fua2 f ON s.scbe_trackid=f.fu_trackid 
        LEFT JOIN myir_kcontact k ON k.kc_id=s.scbe_agent
        LEFT JOIN myir_agency a ON a.agn_id=k.kc_agency
        WHERE f.fu_trackid IS NULL AND DATE(s.scbe_orderdate) >= '".$start."' AND DATE(s.scbe_orderdate) <='".$end."' 
        ORDER BY s.scbe_orderdate ASC");
        return $query->result();
    }

    public function getDataFollowUp($array){
        $query=$this->db->query("SELECT * FROM myir_scbe s 
        LEFT JOIN myir_kcontact k ON s.scbe_agent=k.kc_id
        WHERE s.scbe_trackid='".$array."' ");
        return $query->result();
    }

    public function getDataFollowUpA2($array){
        $query=$this->db->query("SELECT * FROM myir_fua2 f 
        LEFT JOIN myir_scbe s ON s.scbe_trackid=f.fu_trackid
        LEFT JOIN myir_kcontact k ON k.kc_id=s.scbe_agent
        LEFT JOIN myir_feedbackagency fd ON fd.feed_trackid=f.fu_trackid
        WHERE f.fu_trackid='".$array."' ");
        return $query->result();
    }

    public function insertFollowUp($array){
        $this->load->library('session');
        $agenta2=$this->session->userdata('username');
        // var_dump($agenta2);
        $this->db->where('fu_trackid',$array['trackid']);
        $this->db->from('myir_fua2');
        $count = $this->db->count_all_results();
        
        if ($count==0){
            $this->db->query("INSERT INTO myir_fua2 VALUES('".$array['trackid']."','".$array['isvalidcp']."','".$array['cp']."',
            '".$array['isvalidalamat']."','".$this->db->escape_str($array['alamat'])."','".$this->db->escape_str($array['acuanalamat'])."','".$array['manja']."','".$agenta2."',
            '".date('Y-m-d H:i:s')."','".$array['keterangana2']."','".$array['sto']."','".$array['isvalidsto']."','".$array['detilketa2']."',
            '".$array['oknok']."','".$array['actioninputan']."','".$array['doubleinput']."' )");
            // echo "masuk";
            return 1;
            
        }else{
            // echo "masukkkkk";
            return 0;
        }
        
    }

    public function editFuA2($array){
        $this->load->library('session');
        $agenta2=$this->session->userdata('username');
        $this->db->query("UPDATE myir_fua2 SET 
        fu_isvalidcp='".$array['isvalidcp']."',
        fu_validcp='".$array['cp']."',
        fu_isvalidalamat='".$array['isvalidalamat']."',
        fu_alamat='".$this->db->escape_str($array['alamat'])."',
        fu_acuanalamat='".$this->db->escape_str($array['acuanalamat'])."',
        fu_manja='".$array['manja']."',
        fu_agenta2='".$agenta2."',
        fu_fudate='".date('Y-m-d H:i:s')."',
        fu_keterangana2='".$array['keterangana2']."',
        fu_sto='".$array['sto']."',
        fu_isvalidsto='".$array['isvalidsto']."',
        fu_detilketerangan='".$array['detilketa2']."',
        fu_oknok='".$array['oknok']."',
        fu_needfeedback='".$array['actioninputan']."',
        fu_doubleinput='".$array['doubleinput']."'
        WHERE fu_trackid='".$array['trackid']."'
        ");
        return 1;
    }

    public function getDataFUSC(){
        $query=$this->db->query("SELECT s.*,f.*,c.*, ps.*,
        (SELECT v.val_detail FROM myir_validasi v WHERE f.fu_keterangana2=v.val_id) AS keterangana2,
        (SELECT v.val_detail FROM myir_validasi v WHERE f.fu_isvalidcp=v.val_id) AS isvalidcp,
        (SELECT v.val_detail FROM myir_validasi v WHERE f.fu_isvalidalamat=v.val_id) AS isvalidalamat,
        (SELECT v.val_detail FROM myir_validasi v WHERE f.fu_needfeedback=v.val_id) AS feedback
        FROM myir_scbe s 
        INNER JOIN myir_fua2 f ON s.scbe_trackid=f.fu_trackid 
        LEFT JOIN myir_fusc c ON c.fusc_trackid=f.fu_trackid 
        LEFT JOIN myir_dataps ps ON ps.ps_trackid=s.scbe_trackid
        
        where c.fusc_trackid IS NULL 
        AND f.fu_oknok='VAL000' 
        AND f.fu_needfeedback='VAL016'
        AND f.fu_fudate LIKE '".date('Y-m-d')."%' ");
        return $query->result();
    }

    public function getFilterFUSC($start,$end){
        $query=$this->db->query("SELECT s.*,f.*,c.*, ps.*,
        (SELECT v.val_detail FROM myir_validasi v WHERE f.fu_keterangana2=v.val_id) AS keterangana2,
        (SELECT v.val_detail FROM myir_validasi v WHERE f.fu_isvalidcp=v.val_id) AS isvalidcp,
        (SELECT v.val_detail FROM myir_validasi v WHERE f.fu_isvalidalamat=v.val_id) AS isvalidalamat,
        (SELECT v.val_detail FROM myir_validasi v WHERE f.fu_needfeedback=v.val_id) AS feedback
        FROM myir_scbe s 
        INNER JOIN myir_fua2 f ON s.scbe_trackid=f.fu_trackid 
        LEFT JOIN myir_fusc c ON c.fusc_trackid=f.fu_trackid 
        LEFT JOIN myir_dataps ps ON ps.ps_trackid=s.scbe_trackid

        where c.fusc_trackid IS NULL 
        AND f.fu_oknok='VAL000'
        AND f.fu_needfeedback='VAL016'
        AND DATE(f.fu_fudate) >= '".$start."' AND DATE(f.fu_fudate)<='".$end."' ");
        return $query->result();
    }

    public function getDataFollowUpSC($array){
        $query=$this->db->query("SELECT * FROM myir_scbe s 
        JOIN myir_fua2 f ON s.scbe_trackid=f.fu_trackid 
        LEFT JOIN myir_kcontact k ON k.kc_id=s.scbe_agent
        LEFT JOIN myir_fusc fc ON fc.fusc_trackid=f.fu_trackid
        where scbe_trackid='".$array."' ");
        return $query->result();
    }

    public function insertFollowUpSc($array){
        $this->load->library('session');
        $agentsc=$this->session->userdata('username');
        $this->db->where('fusc_trackid',$array['trackid']);
        $this->db->from('myir_fusc');
        $count = $this->db->count_all_results();
        // var_dump($array);
        if ($count==0){
            $this->db->query("INSERT INTO myir_fusc VALUES('".$array['trackid']."','".$array['scid']."','".$agentsc."','".date('Y-m-d H:i:s')."')");
            // echo "masuk";
            return 1;
        }else{
            // echo "tidak masuk";
            return 0;
        }

    }

    public function updateFollowUpSc($array){
        $this->load->library('session');
        $agent=$this->session->userdata('username');
        $this->db->query("UPDATE myir_fusc SET
        fusc_scid='".$array['scid']."',
        fusc_agent='".$agent."',
        fusc_fudate='".date('Y-m-d H:i:s')."'
        where fusc_trackid='".$array['trackid']."'
        ");
        return 1;
    }

    public function getAllDataScbe(){
        $query=$this->db->query("SELECT s.*,f.*,c.*, a.*,agn.*,ps.*,
        (SELECT v.val_detail FROM myir_validasi v WHERE f.fu_keterangana2=v.val_id) AS keterangana2,
        (SELECT v.val_detail FROM myir_validasi v WHERE f.fu_oknok=v.val_id) AS oknok,
        (SELECT v.val_detail FROM myir_validasi v WHERE f.fu_isvalidcp=v.val_id) AS isvalidcp,
        (SELECT v.val_detail FROM myir_validasi v WHERE f.fu_isvalidalamat=v.val_id) AS isvalidalamat,
        (SELECT v.val_detail FROM myir_validasi v WHERE f.fu_needfeedback=v.val_id) AS feedback
        FROM myir_scbe s 
        LEFT JOIN myir_fua2 f ON s.scbe_trackid=f.fu_trackid 
        LEFT JOIN myir_fusc c ON c.fusc_trackid=f.fu_trackid 
        LEFT JOIN myir_kcontact kc ON kc.kc_id=s.scbe_agent
        LEFT JOIN myir_agency agn ON agn.agn_id=kc.kc_agency
        LEFT JOIN myir_dataps ps ON ps.ps_trackid=s.scbe_trackid

        LEFT JOIN myir_feedbackagency a ON a.feed_trackid=f.fu_trackid
        WHERE DATE(s.scbe_uploaddate) >= '".date('Y-m-d',strtotime("-1 day"))."%' 
        AND DATE(s.scbe_uploaddate) <= '".date('Y-m-d')."%' ");
        return $query->result();

    }

    public function filterRekapDataScbe($start,$end){
        $query=$this->db->query("SELECT s.*,f.*,c.*,  a.*,agn.*,ps.*,
        (SELECT v.val_detail FROM myir_validasi v WHERE f.fu_keterangana2=v.val_id) AS keterangana2,
        (SELECT v.val_detail FROM myir_validasi v WHERE f.fu_oknok=v.val_id) AS oknok,
        (SELECT v.val_detail FROM myir_validasi v WHERE f.fu_isvalidcp=v.val_id) AS isvalidcp,
        (SELECT v.val_detail FROM myir_validasi v WHERE f.fu_isvalidalamat=v.val_id) AS isvalidalamat,
        (SELECT v.val_detail FROM myir_validasi v WHERE f.fu_needfeedback=v.val_id) AS feedback
        FROM myir_scbe s 
        LEFT JOIN myir_fua2 f ON s.scbe_trackid=f.fu_trackid 
        LEFT JOIN myir_fusc c ON c.fusc_trackid=f.fu_trackid 
        LEFT JOIN myir_kcontact kc ON kc.kc_id=s.scbe_agent
        LEFT JOIN myir_agency agn ON agn.agn_id=kc.kc_agency
        LEFT JOIN myir_feedbackagency a ON a.feed_trackid=f.fu_trackid
        LEFT JOIN myir_dataps ps ON ps.ps_trackid=s.scbe_trackid

        WHERE DATE(s.scbe_orderdate) >= '".date('Y-m-d', strtotime($start))."%' 
        AND DATE(s.scbe_orderdate) <= '".date('Y-m-d', strtotime($end))."%' ");
        return $query->result();

    }

    public function getRekapFu($array){
        $query=$this->db->query("SELECT s.*,f.*,c.*, a.*,ag.*,ps.*,
        (SELECT v.val_detail FROM myir_validasi v WHERE f.fu_oknok=v.val_id) AS oknok,
        (SELECT v.val_detail FROM myir_validasi v WHERE f.fu_keterangana2=v.val_id) AS keterangana2,
        (SELECT v.val_detail FROM myir_validasi v WHERE f.fu_needfeedback=v.val_id) AS feedback
        
        FROM myir_scbe s 
        INNER JOIN myir_fua2 f ON s.scbe_trackid=f.fu_trackid 
        LEFT JOIN myir_fusc c ON c.fusc_trackid=f.fu_trackid 
        LEFT JOIN myir_feedbackagency a ON a.feed_trackid=f.fu_trackid
        LEFT JOIN myir_kcontact k ON k.kc_id=s.scbe_agent
        LEFT JOIN myir_agency ag ON ag.agn_id=k.kc_agency
        LEFT JOIN myir_dataps ps ON ps.ps_trackid=s.scbe_trackid

        WHERE f.fu_agenta2='".$array."' 
        AND f.fu_fudate LIKE '".date('Y-m-d')."%' ");
        return $query->result();
    }

    public function getFilterRekapA2($user,$start,$end){
        $query=$this->db->query("SELECT s.*,f.*,c.*,ag.*,a.*,ps.*,
        (SELECT v.val_detail FROM myir_validasi v WHERE f.fu_oknok=v.val_id) AS oknok,
        (SELECT v.val_detail FROM myir_validasi v WHERE f.fu_keterangana2=v.val_id) AS keterangana2,
        (SELECT v.val_detail FROM myir_validasi v WHERE f.fu_needfeedback=v.val_id) AS feedback
        
        FROM myir_scbe s 
        INNER JOIN myir_fua2 f ON s.scbe_trackid=f.fu_trackid 
        LEFT JOIN myir_fusc c ON c.fusc_trackid=f.fu_trackid 
        LEFT JOIN myir_feedbackagency a ON a.feed_trackid=f.fu_trackid
        LEFT JOIN myir_kcontact k ON k.kc_id=s.scbe_agent
        LEFT JOIN myir_agency ag ON ag.agn_id=k.kc_agency
        LEFT JOIN myir_dataps ps ON ps.ps_trackid=s.scbe_trackid

        WHERE f.fu_agenta2='".$user."' 
        AND DATE(f.fu_fudate) >= '".$start."' AND DATE(f.fu_fudate) <= '".$end."' ");
        return $query->result();
    }

    public function getFeedbackAgency($array){
        $query=$this->db->query("SELECT * FROM myir_login l LEFT JOIN myir_agency a ON l.login_agency=a.agn_id
        WHERE l.login_username='".$array."' ");
        $data=$query->result();
        // var_dump( $data);
        $agnid=$data[0]->agn_id;
        $query=$this->db->query("SELECT *, 
        (SELECT v.val_detail FROM myir_validasi v WHERE a.fu_oknok=v.val_id) AS oknok,
        (SELECT v.val_detail FROM myir_validasi v WHERE a.fu_keterangana2=v.val_id) AS keterangana2
        -- (SELECT fd.feed_status FROM myir_feedbackagency fd WHERE fd.feed_trackid=s.scbe_trackid) AS ketfeedback
        FROM myir_scbe s 
        LEFT JOIN myir_kcontact k ON s.scbe_agent=k.kc_id
        LEFT JOIN myir_fua2 a ON s.scbe_trackid=a.fu_trackid 
        LEFT JOIN myir_fusc f ON s.scbe_trackid=f.fusc_trackid 
        LEFT JOIN myir_feedbackagency fd ON fd.feed_trackid=a.fu_trackid
        WHERE k.kc_agency='".$agnid."' 
        AND a.fu_needfeedback='VAL018'
        AND (fd.feed_feedback IS NULL OR fd.feed_status='NOK')
         ");

        // var_dump($query->result());
        return $query->result();
    }

    public function getFilterFeedbackAgency($array,$start,$end){
        $query=$this->db->query("SELECT * FROM myir_login l LEFT JOIN myir_agency a ON l.login_agency=a.agn_id
        WHERE l.login_username='".$array."' ");
        $data=$query->result();
        // var_dump( $data);
        $agnid=$data[0]->agn_id;
        $query=$this->db->query("SELECT *, 
        (SELECT v.val_detail FROM myir_validasi v WHERE a.fu_oknok=v.val_id) AS oknok,
        (SELECT v.val_detail FROM myir_validasi v WHERE a.fu_keterangana2=v.val_id) AS keterangana2
        -- (SELECT fd.feed_status FROM myir_feedbackagency fd WHERE fd.feed_trackid=s.scbe_trackid) AS ketfeedback
        FROM myir_scbe s 
        LEFT JOIN myir_kcontact k ON s.scbe_agent=k.kc_id
        LEFT JOIN myir_fua2 a ON s.scbe_trackid=a.fu_trackid 
        LEFT JOIN myir_fusc f ON s.scbe_trackid=f.fusc_trackid 
        LEFT JOIN myir_feedbackagency fd ON fd.feed_trackid=a.fu_trackid
        WHERE k.kc_agency='".$agnid."' 
        AND a.fu_needfeedback='VAL018'
        AND DATE(a.fu_fudate) >= '".date('Y-m-d', strtotime($start))."%' 
        AND DATE(a.fu_fudate) <= '".date('Y-m-d', strtotime($end))."%'
         ");

        // var_dump($query->result());
        return $query->result();
    }


    public function getRekapAgency($array){
        
        $query=$this->db->query("SELECT * FROM myir_login l LEFT JOIN myir_agency a ON l.login_agency=a.agn_id
        WHERE l.login_username='".$array."' ");
        $data=$query->result();
        // var_dump( $data);
        $agnid=$data[0]->agn_id;
        $query=$this->db->query("SELECT *, 
        (SELECT v.val_detail FROM myir_validasi v WHERE a.fu_oknok=v.val_id) AS oknok,
        (SELECT v.val_detail FROM myir_validasi v WHERE a.fu_keterangana2=v.val_id) AS keterangana2,
        -- (SELECT fd.feed_status FROM myir_feedbackagency fd WHERE fd.feed_trackid=s.scbe_trackid) AS ketfeedback,
        (SELECT v.val_detail FROM myir_validasi v WHERE a.fu_needfeedback=v.val_id) AS feedback
        FROM myir_scbe s 
        LEFT JOIN myir_kcontact k ON s.scbe_agent=k.kc_id
        LEFT JOIN myir_fua2 a ON s.scbe_trackid=a.fu_trackid 
        LEFT JOIN myir_fusc f ON s.scbe_trackid=f.fusc_trackid 
        LEFT JOIN myir_agency agn ON agn.agn_id=k.kc_agency
        LEFT JOIN myir_dataps ps ON ps.ps_trackid=s.scbe_trackid
        LEFT JOIN myir_feedbackagency fe ON fe.feed_trackid=a.fu_trackid
        WHERE k.kc_agency='".$agnid."' 
        AND DATE(s.scbe_orderdate) >= '".date('Y-m-d',strtotime("-1 day"))."%'
        AND DATE(s.scbe_orderdate) <= '".date('Y-m-d')."%'");

        // var_dump($query->result());
        return $query->result();
    }

    public function getFilterRekapAgency($user,$start,$end){
        $query=$this->db->query("SELECT * FROM myir_login l LEFT JOIN myir_agency a ON l.login_agency=a.agn_id
        WHERE l.login_username='".$user."' ");
        $data=$query->result();
        // var_dump( $data);
        $agnid=$data[0]->agn_id;
        $query=$this->db->query("SELECT *, 
        (SELECT v.val_detail FROM myir_validasi v WHERE a.fu_oknok=v.val_id) AS oknok,
        (SELECT v.val_detail FROM myir_validasi v WHERE a.fu_needfeedback=v.val_id) AS feedback,
        (SELECT v.val_detail FROM myir_validasi v WHERE a.fu_keterangana2=v.val_id) AS keterangana2
        -- (SELECT fd.feed_status FROM myir_feedbackagency fd WHERE fd.feed_trackid=s.scbe_trackid) AS ketfeedback
        FROM myir_scbe s 
        LEFT JOIN myir_kcontact k ON s.scbe_agent=k.kc_id
        LEFT JOIN myir_fua2 a ON s.scbe_trackid=a.fu_trackid 
        LEFT JOIN myir_fusc f ON s.scbe_trackid=f.fusc_trackid 
        LEFT JOIN myir_agency agn ON agn.agn_id=k.kc_agency
        LEFT JOIN myir_dataps ps ON ps.ps_trackid=s.scbe_trackid
        LEFT JOIN myir_feedbackagency fe ON fe.feed_trackid=a.fu_trackid
        WHERE k.kc_agency='".$agnid."' 
        AND DATE(s.scbe_orderdate) >= '".$start."%' 
        AND DATE(s.scbe_orderdate) <= '".$end."%' ");

        // var_dump($query->result());
        return $query->result();
    }

    public function insertFeedbackAgency($array){
        $this->db->where('feed_trackid',$array['trackid']);
        $this->db->from('myir_feedbackagency');
        $count = $this->db->count_all_results();
        if($count==0){
            $this->db->query("INSERT INTO myir_feedbackagency VALUES('".$array['trackid']."','".$array['feedback']."','".$array['isvalidfeedback']."')");
            // var_dump($array);
            return 1;
        }else{
            $this->db->query("UPDATE myir_feedbackagency SET feed_feedback='".$array['feedback']."',feed_status='".$array['isvalidfeedback']."' 
            WHERE feed_trackid='".$array['trackid']."' ");
        }
    }

    public function getDataFeedbackAgency($array){
        $query=$this->db->query("SELECT * FROM myir_scbe s 
        JOIN myir_fua2 f ON s.scbe_trackid=f.fu_trackid 
        LEFT JOIN myir_feedbackagency fd ON fd.feed_trackid=s.scbe_trackid
        where scbe_trackid='".$array."' 
        ");
        return $query->result();
    }

    public function getAgency(){
        $query=$this->db->query("SELECT * FROM myir_agency");
        return $query->result();
    }

    public function insertUser($username,$passwd,$nama,$agency){
        $this->db->where('login_username',$username);
        $this->db->from('myir_login');
        $count=$this->db->count_all_results();
        // var_dump($count);
        if ($count==1){
            return 0;
        }else{
            $this->db->query("INSERT INTO myir_login VALUES('".$username."','".$passwd."','".$nama."','".$agency."') ");
            return 1;
        }

    }

    public function cekDoubleNama($array){
        $lastdata=$this->db->query("SELECT s.scbe_orderdate as tgl FROM myir_scbe s
        LEFT join myir_fua2 f
        ON f.fu_trackid=s.scbe_trackid
        where f.fu_doubleinput='NO'
        ORDER BY s.scbe_orderdate DESC limit 1");
        $tglakhir=$lastdata->result();
        $tgl=$tglakhir[0]->tgl;
        // var_dump($tglakhir);
        if ($tgl==NULL || $tgl==''){
            return "NO";
        }else{
            $tgl30=date('Y-m-d',strtotime("+1 month"));
            $query=$this->db->query("SELECT COUNT(scbe_custname) as dobelnama 
            FROM myir_scbe 
            WHERE scbe_custname LIKE '%".$array."%' 
            AND DATE(scbe_orderdate) >= '".$tgl."'
            AND DATE(scbe_orderdate) <= '".$tgl30."' ");
            // echo $tgl30;
            return $query->result();
        }
    }

    public function cekDoubleNotel($array){
        // $arrtel=str_split($array,1);
        // $digit=count($arrtel);
        // $kurangi=$digit-11;
        $lastdata=$this->db->query("SELECT s.scbe_orderdate as tgl FROM myir_scbe s
        LEFT join myir_fua2 f
        ON f.fu_trackid=s.scbe_trackid
        where f.fu_doubleinput='NO'
        ORDER BY s.scbe_orderdate DESC limit 1");
        $tglakhir=$lastdata->result();
        $tgl=$tglakhir[0]->tgl;
        // var_dump($tglakhir);
        if ($tgl==NULL || $tgl==''){
            return "NO";
        }else{
            $cektelp=substr($array,0,11);
            $tgl30=date('Y-m-d',strtotime("+1 month"));
            $query=$this->db->query("SELECT COUNT(scbe_cp) as dobelcp 
            FROM myir_scbe 
            WHERE scbe_cp LIKE '%".$cektelp."%' 
            AND DATE(scbe_orderdate) >= '".$tgl."'
            AND DATE(scbe_orderdate) <= '".$tgl30."'
            ");

            // $query=$this->db->query("SELECT COUNT(scbe_custname) as dobelnama 
            // FROM myir_scbe 
            // WHERE scbe_custname LIKE '%".$array."%' 
            // AND DATE(scbe_orderdate) >= '".$tgl."'
            // AND DATE(scbe_orderdate) <= '".$tgl30."' ");
            // echo $tgl30;
            return $query->result();
        }

        // $cektelp=substr($array,0,11);
        // $query=$this->db->query("SELECT COUNT(scbe_cp) as dobelcp FROM myir_scbe WHERE scbe_cp LIKE '%".$cektelp."%' ");
        // return $query->result();
        // var_dump($query);
    }




    public function insertNotifAgency($array){
        $this->load->library('session');
        $user=$this->session->userdata('username');
        $query=$this->db->query("SELECT fu_agenta2 FROM myir_fua2 WHERE fu_trackid='".$array['trackid']."' ");
        $usera2=$query->result();
        $this->db->query("INSERT INTO myir_notification VALUES(0,'".$array['trackid']."','".$usera2[0]->fu_agenta2."','0','0','1','".$_SESSION['agency']."','')");
        return 1;
    }

    public function getNotifAgency(){
        $query=$this->db->query("SELECT * FROM myir_notification WHERE notif_isreadagency='0' AND notif_agencyid='".$_SESSION['agency']."' ");
        return $query->result();
    }

    public function updateNotifAgency($array){
        $this->db->query("UPDATE myir_notification SET notif_isreadagency='1' WHERE notif_agencyid='".$array."' ");
        return 1;
    }



    public function insertNotifA2($array){
        $this->load->library('session');
        $user=$this->session->userdata('username');
        $this->db->query("INSERT INTO myir_notification VALUES(0,'".$array['trackid']."','".$user."','0','1','0','".$array['agency']."','')");
        return 1;
    }
    public function getNotifA2(){
        $this->load->library('session');
        $user=$this->session->userdata('username');
        $query=$this->db->query("SELECT * FROM myir_notification WHERE notif_isreada2='0' AND notif_usera2='".$_SESSION['username']."'  ");

        return $query->result();
    }

    public function updateNotifA2($array){
        $this->db->query("UPDATE myir_notification SET notif_isreada2='1' WHERE notif_usera2='".$_SESSION['username']."' ");
        return 1;
    }





    public function insertNotifConsumer($array){
        $this->load->library('session');
        $user=$this->session->userdata('username');
        $this->db->query("INSERT INTO myir_notification VALUES(0,'".$array['trackid']."','".$array['agenta2']."','1','0','0','".$array['agency']."','".$user."')");
        return 1;
    }

    public function getNotifConsumer(){
        $query=$this->db->query("SELECT * FROM myir_notification WHERE notif_isreadcons='0'");
        return $query->result();
    }

    public function updateNotifConsumer($array){
        $this->db->query("UPDATE myir_notification SET notif_isreadcons='1' ");
        return 1;
    }



    public function insertNotifWitel($array){
        $this->load->library('session');
        $user=$this->session->userdata('username');
        $this->db->query("INSERT INTO myir_notification VALUES(0,'".$array['trackid']."','".$user."','1','0','0')");
        return 1;
    }

    public function getNotifWitel(){
        $query=$this->db->query("SELECT * FROM myir_notification WHERE notif_isreadcons='0'");
        return $query->result();
    }

    public function updateNotifWitel($array){
        $this->db->query("UPDATE myir_notification SET notif_isreadcons='1' WHERE notif_id='".$array."' ");
        return 1;
    }

    public function selectPass($array){
        $query=$this->db->query("SELECT 1 FROM myir_login WHERE login_passwd='".$array."' ");
        // var_dump($query->result());
        if ($query->result()==NULL){
            return 0;
        }else{
            return 1;
        }
    }

    public function updatePassword($user,$passwd){
        $this->db->query("UPDATE myir_login SET login_passwd='".$passwd."' WHERE login_username='".$user."' ");
        return 1;
    }

    public function getRekapFeedback($array){
        $query=$this->db->query("SELECT s.*,f.*,c.*, a.*,ag.*,ps.*,
        (SELECT v.val_detail FROM myir_validasi v WHERE f.fu_oknok=v.val_id) AS oknok,
        (SELECT v.val_detail FROM myir_validasi v WHERE f.fu_keterangana2=v.val_id) AS keterangana2,
        (SELECT v.val_detail FROM myir_validasi v WHERE f.fu_needfeedback=v.val_id) AS feedback
        
        FROM myir_scbe s 
        INNER JOIN myir_fua2 f ON s.scbe_trackid=f.fu_trackid 
        LEFT JOIN myir_fusc c ON c.fusc_trackid=f.fu_trackid 
        LEFT JOIN myir_feedbackagency a ON a.feed_trackid=f.fu_trackid
        LEFT JOIN myir_kcontact k ON k.kc_id=s.scbe_agent
        LEFT JOIN myir_agency ag ON ag.agn_id=k.kc_agency
        LEFT JOIN myir_dataps ps ON ps.ps_trackid=s.scbe_trackid

        WHERE f.fu_agenta2='".$array."' 
        AND f.fu_needfeedback='VAL018' 
        AND a.feed_status='VAL000' ");
        return $query->result();
    }

    public function getUserAgency($user){
        $query=$this->db->query("SELECT l.login_agency FROM myir_login l 
        WHERE l.login_username='".$user."' ");
        return $query->result();
    }

    public function insertAgency($array){
        $query=$this->db->query("SELECT max(agn_id) as agn_id FROM myir_agency ");
        $agnmax=$query->result();
        $sub=substr($agnmax[0]->agn_id,3,5);
        $sub="AGN".str_pad($sub+1,5,"0",STR_PAD_LEFT);
        $query=$this->db->query("INSERT INTO myir_agency VALUES('".$sub."','".$array."')");
        return 1;
    }

    public function getAllAgency(){
        $query=$this->db->query("SELECT * FROM myir_agency");
        return $query->result();
    }

    public function deleteAgency($array){
        $query=$this->db->query("SELECT COUNT(kc_id) AS kc FROM myir_kcontact WHERE kc_agency='".$array."' ");
        $query2=$this->db->query("SELECT COUNT(login_username) AS username FROM myir_login WHERE login_agency='".$array."' ");
        // var_dump($query->result());
        $data=$query->result();
        $data2=$query2->result();
        // echo $data[0]->kc;
        if($data[0]->kc==0 && $data2[0]->username==0){
            $query=$this->db->query("DELETE FROM myir_agency WHERE agn_id='".$array."'"); 
            return 1;
        }else{
            return 0;
        }
    }

    public function getAllUser(){
        $query=$this->db->query("SELECT * FROM myir_login l LEFT JOIN myir_agency a ON a.agn_id=l.login_agency");
        return $query->result();
    }

    public function deleteUser($array){
        $query=$this->db->query("DELETE FROM myir_login WHERE login_username='".$array."' ");
        return 1;
    }

    public function getGrafikSO(){
        $query=$this->db->query("SELECT COUNT(s.scbe_trackid) as input,
        SUM(IF(f.fu_oknok='VAL000',1,0)) as valid,
        f.fu_sto
        FROM myir_scbe s 
        LEFT JOIN myir_fua2 f ON s.scbe_trackid=f.fu_trackid 
        LEFT JOIN myir_fusc c ON c.fusc_trackid=s.scbe_trackid
        LEFT JOIN myir_sto o ON o.sto_name=f.fu_sto
        WHERE o.sto_datel='SURABAYA UTARA' 
        AND s.scbe_uploaddate LIKE '".date('Y-m-d')."%'
        GROUP BY f.fu_sto");
        return $query->result();
    }
}
?>