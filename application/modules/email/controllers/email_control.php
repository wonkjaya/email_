<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email_control extends CI_Controller {

	const FILE_PATH_UPLOADS="/var/www/uploads/email/";
	const MYUSERNAME="rohman";
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('html','url'));
		$this->load->model('email_model');
	}
	
	function index()
	 {
		$this->compose();
	 }
	
	function compose()
	 {
		$this->load->helper('form');
		//$data['messages']=$this->email_model->select_messages();
		$data['actn']=$this->email_model->get_all_account();
		$this->load->view('main/header');   
		$this->load->view('email/compose',$data);
	 }
	
	function view_mail()
	 {
		$this->load->helper('form');
		if($_POST){
		 $from=date_format(date_create($this->input->post('datefrom')),"Y-m-d");
		 $to=date_format(date_create($this->input->post('dateto')),"Y-m-d");
		}else{
		 $from='';
		 $to='';
		}
		$hasil=$this->get_email_account();
		$data['messages']=$this->email_model->select_messages($hasil,$from,$to);
		$this->load->view('main/header');
		$this->load->view('email/view_message',$data);
	 }
	
	function get_email_account()
	{
		$res=$this->email_model->get_all_account();
		$hasil='';
		foreach($res as $p){
			$hasil .= " and `pengirim` != ".$this->db->escape($p->email_pengirim);
		}
		return $hasil;
	}
	
	function send()
	 {
	   if($_POST){
			$u= $this->input->post('user_account');//static::MYUSERNAME;
			if($u ==""){echo "anda belum memilih user email";exit();}
			$fetch=$this->email_model->get_user_pengirim($u);
			$num=count($fetch);   
		   if ($num > 0){
				foreach($fetch as $r){
					$hostname = $r->smtp;
					$username = $r->email;
					$password = $r->password;
					$from= $r->email_pengirim;//'rohmamail@suseda.co.id';
					   $to=explode(';',$this->input->post('email'));//rohmanmail@gmail.com;
					   $subject=$this->input->post('subject');
					   $html_msg=$this->input->post('text_message');
					   $alt=$subject;
					   $attach=$_FILES['userfile'];
					   if($to != ''){
						   $upload=$this->do_upload();
						   if ($upload == ''){$attch='';}else{ $attch=$upload;}
					//echo '//'.$attch;   
						   $this->load->helper('mailer/phpmailerautoload');
						   $mail=new PHPMailer();
						foreach($to as $to){   
						   $send=$this->send_message($mail,$hostname,$username,$password,$from,$to,$subject,$html_msg,$alt,$attch);
						}
					   }else{$send='Error : Alamat tujuan Tidak Ada';}
				}
			}else{echo "s";}
		}else{echo 'none';}
	   ob_start();
	   if($send == 'sukses'){
		   redirect("email/email_control");
	   }else{
	   	echo $send;
	   }
	 }
	 
	function do_upload()
	{
		$folder_name="/var/www/uploads/email";
		if (!file_exists($folder_name)){
		  mkdir($folder_name, 0777);
		}
		$config['upload_path'] = $folder_name;
		$config['allowed_types'] = '*';
		$config['file_name'] = 'uploads_'.date('ymdgis');

		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
			echo var_dump($error);
			return 0;
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			$data['upload_data']['orig_name'];
			return $data['upload_data']['orig_name'];
		}
	}
	 
	function send_message($mail,$host,$user,$pass,$from,$to,$subject,$content,$alt,$attach='')
	{
	  	//Create a new PHPMailer instance
		
		$mail->isSMTP();
		$mail->SMTPDebug = 2;
		$mail->Debugoutput = 'html';
		$mail->Host = $host;
		$mail->Port = 587;
		$mail->SMTPSecure = 'tls';
		$mail->SMTPAuth = true;
		$mail->Username = $user;
		$mail->Password = $pass;
		$mail->setFrom($from, 'CS of suseda.com');
		//$mail->addReplyTo('rohman@suseda.com', 'First Last');
		$mail->addAddress($to, 'pelanggan');
		$mail->Subject = $subject;
		$mail->msgHTML($content);
		$mail->AltBody = $alt;
		if($attach != ''){
			$mail->addAttachment(static::FILE_PATH_UPLOADS.$attach);
			//$attach = $attach;
		}

		//send the message, check for errors
		if (!$mail->send()) {
		    return $mail->ErrorInfo;
		    $this->email_model->insert_new_out_box($subject,$content,$from,$to,$attach,'0');
		} else {
		    $this->email_model->insert_new_out_box($subject,$content,$from,$to,$attach,'1');
		    return 'sukses';
		}
	
}

function refresh()
 {
	/*
	//$this->view_mail();*/
	$u= static::MYUSERNAME;
	$fetch=$this->email_model->get_user_account($u);
	$num=count($fetch);
	if ($num > 0){
		foreach($fetch as $r){
			$hostname = $r->imap;
			$username = $r->email;
			$password = $r->password;
			$inbox = imap_open($hostname,$username,$password) or die('Cannot connect to SERVER: ' . imap_last_error());
			$emails = imap_search($inbox,'UNSEEN');
			$this->get_inbox($emails,$inbox,$username);
		}
	}
}

function get_inbox($emails,$inbox,$username)
{
	if($emails) {
		$output = '';
		rsort($emails);
		foreach($emails as $email_number) {
			 $overview = imap_fetch_overview($inbox,$email_number,0);
			 $message = imap_fetchbody($inbox,$email_number,"1");
			 $structure = imap_fetchstructure($inbox,$email_number,0);
				$subject = $overview[0]->subject;
				$f = $overview[0]->from;
				$date = $this->get_date_me($overview[0]->date);
				$hasil=$this->getMessageBody($message);
				//echo "\n***".$hasil."***\n";
				$e=explode('<',$f);
				//echo var_dump($e);
					$t=$e[0];
				if(count($e) == 2)$t=$e[1];
					$a=array('<','>');
					$from=str_replace($a,'',$t);
					$attach=$this->get_attachment($emails,$structure,$inbox,$email_number);
				//echo $subject.'|'.$from.'|'.$date.'|'.$hasil.br();
				//echo "\n================================\n".var_dump($overview)."\n================================\n";
				//echo "\n================================\n".var_dump($message)."\n================================\n";
				//echo "\n================================\n".var_dump($structure)."\n================================\n";
				foreach ($overview as $p){
					$f= $p->to;
					$e=explode('<',$f);
					if (count($e) > 1){
						$to=str_replace('>','',$e[1]);
						}else{
						 $to=$f;
					}
				}
				
				$this->email_model->insert_new_inbox($subject,$from,$date,$hasil,$to,$attach);
		}
	}
	imap_close($inbox);
}

function get_attachment($emails,$structure,$inbox,$email_number)
{
	//foreach($structure as $r){echo var_dump($r)."===";}
   $attachments = array();
        /* if any attachments found... */
        if(isset($structure->parts) && count($structure->parts)) 
        {
            for($i = 0; $i < count($structure->parts); $i++) 
            {
                $attachments[$i] = array(
                    'is_attachment' => false,
                    'filename' => '',
                    'name' => '',
                    'attachment' => ''
                );
 
                if($structure->parts[$i]->ifdparameters) 
                {
                    foreach($structure->parts[$i]->dparameters as $object) 
                    {
                        if(strtolower($object->attribute) == 'filename') 
                        {
                            $attachments[$i]['is_attachment'] = true;
                            $attachments[$i]['filename'] = $object->value;
                        }
                    }
                }
 
                if($structure->parts[$i]->ifparameters) 
                {
                    foreach($structure->parts[$i]->parameters as $object) 
                    {
                        if(strtolower($object->attribute) == 'name') 
                        {
                            $attachments[$i]['is_attachment'] = true;
                            $attachments[$i]['name'] = $object->value;
                        }
                    }
                }
 
                if($attachments[$i]['is_attachment']) 
                {
                    $attachments[$i]['attachment'] = imap_fetchbody($inbox, $email_number, $i+1);
					//echo $attachments[$i]['attachment'];
                    /* 4 = QUOTED-PRINTABLE encoding */
                    if($structure->parts[$i]->encoding == 3) 
                    { 
                        $attachments[$i]['attachment'] = base64_decode($attachments[$i]['attachment']);
                    }
                    /* 3 = BASE64 encoding */
                    elseif($structure->parts[$i]->encoding == 4) 
                    { 
                        $attachments[$i]['attachment'] = quoted_printable_decode($attachments[$i]['attachment']);
                    }
                }
            }
        }
 
        /* iterate through each attachment and save it */
        foreach($attachments as $attachment)
        {
            if($attachment['is_attachment'] == 1)
            {
                $ori = $attachment['filename'];
				$ex=substr($ori,(strpos($ori,'.')-strlen($ori)));
				$filename = date('ymdgis').$ex;
                if(empty($filename)) $filename = $attachment['filename'];
 
                if(empty($filename)) $filename = time() . ".dat";
                /* prefix the email number to the filename in case two emails
                 * have the attachment with the same file name.
                 */
                $fp = fopen("/var/www/uploads/email/". $filename, "w+");
                fwrite($fp, $attachment['attachment']);
                fclose($fp);
				return $filename;
            }
 
        }
}

function get_date_me($date)
{
	date_default_timezone_set('asia/jakarta');
	return date("Y-m-d G:i:s", strtotime($date));
}

function getMessageBody($message)
{
	//echo $message.'<br>======================<br>';
	//$message='<div dir="ltr">langsung saja bicara gan jangan banyajk acara</div>';
	/*if ($message != ''){
	$message=str_replace(array('<','>'),':',$message);
	$ex=explode(':',$message);
	echo var_dump($ex);
	if (count($ex) > 3){
		$msg=$ex[2];
		}else{
			$msg="Tidak Ada Text";
			}
	
	$jml=strlen($msg);
	//$hasil=substr($msg,2,$jml);
	
	return $message;
	}*/
	
	$p=strpos($message,'\n Pada');
	//echo "\n";
	if($p != ''){
		$message=substr($message,0,$p);
	}else{
	$c1=strpos($message,'<p>');
	$c2=strpos($message,'</p>')-$c1+4 ;
	
	if($c1!='' or $p != ''){
		$message=substr($message,$c1,$c2);
		}
	}
	return $message;
}

function view_conversation()
{
	$this->load->helper('form');
	$t1=str_replace(':','@',$this->uri->segment(4));
	$t2=str_replace(':','@',$this->uri->segment(5));
	//pagging
	$page=$this->email_model->get_email_count_pag($t1,$t2);
	if($_GET) $page=$this->input->get('pg');
	if($_POST) $page=$this->input->post('pg');
		$data['count']=$this->email_model->get_email_count_pag($t1,$t2);
		$tgl=$this->email_model->get_email_tgl_pag($page);
		if($page <= $data['count'])  $data['page']=$page; else $data['page']=$data['count'];
	$query=$this->email_model->get_email_conversation($t1,$t2,$tgl);
	$data['messages']=$query->result();
	$data['user']=$t2;
	$this->email_model->update_conversation($t1,$t2);
	$this->load->view('main/header'); 
	$this->load->view('view_conversation',$data);
}

function reply()
{
	$data['user']=static::MYUSERNAME;
	$data['t1']=str_replace(':','@',$this->uri->segment(4));
	$data['pengirim']=str_replace(':','@',$this->input->get('with'));
	$this->load->helper('form');
	$data['actn']=$this->email_model->get_all_account();
	$this->load->view('main/header');   
	$this->load->view('email/compose',$data);
}

function view_unread()
{
	$data['user']=static::MYUSERNAME;
	$data['unread']=$this->email_model->get_unread();
	$this->load->view('main/header');   
	$this->load->view('email/unread',$data);
}

function sent_item()
{
	$data['sent']=$this->email_model->select_sent_item();
	$this->load->view('main/header',$data);
	$this->load->view('email/sent_item',$data);
}





}

