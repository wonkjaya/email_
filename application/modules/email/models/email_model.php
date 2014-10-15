<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email_model extends CI_Model
 {
private $prv="email_";
	function get_all_account()
	{
		$sql="SELECT nama,email_pengirim FROM ".$this->prv."user_alias WHERE 1";
		$q=$this->db->query($sql);
		$res=$q->result();
		return $res;
	}
	
	function get_email_count_pag($t1,$t2)
	{
		$user1=$this->db->escape($t1);
		$user2=$this->db->escape($t2);
		$where1="pengirim = $user1 AND tujuan = $user2 ";
		$where2="pengirim = $user2 AND tujuan = $user1 ";
	$sql="SELECT * FROM (
		SELECT LEFT(".$this->prv."messages.time,10) as tgl,".$this->prv."messages.* 
		FROM  ".$this->prv."messages 
		WHERE $where1 OR $where2 
		)t2
		GROUP BY tgl ";	
	$q=$this->db->query($sql);
	return $q->num_rows();
	}

	function get_email_tgl_pag($page)
	{
		$p=$page-1;
		$sql="SELECT * FROM (
		SELECT LEFT(".$this->prv."messages.time,10) as tgl,".$this->prv."messages.* 
		FROM  ".$this->prv."messages 
		WHERE 1 ORDER BY tgl DESC
		)t2 
		GROUP BY tgl LIMIT $p,$page";
	$q=$this->db->query($sql);
	$num_rows=$q->num_rows();
	$result=$q->result();
	if($num_rows = 0) return 0;
	foreach($result as $r){
		return $r->tgl;
		}
	}
	
	function get_unread()
	{
		$sql="SELECT * FROM ".$this->prv."messages WHERE state=0";
		return $this->db->query($sql);
	}
		
	function update_conversation($t1,$t2)
	{
	 $t1=$this->db->escape($t1);
	 $t2=$this->db->escape($t2); 
	 $sql="UPDATE ".$this->prv."messages SET state=1 WHERE pengirim=$t1 and tujuan=$t2 OR pengirim=$t2 and tujuan=$t1";
	 $this->db->query($sql); 
	}

	function get_user_account($user)
	{
		$user=$this->db->escape($user);
		$sql="SELECT * FROM email_account WHERE username=$user LIMIT 1";
		$q=$this->db->query($sql);
		$res=$q->result();
		return $res;
	}

	function get_user_pengirim($u)
	{
		$username=$this->db->escape($u);
		  $sql="SELECT ".$this->prv."user_alias.email_pengirim, email_account . * 
				FROM  ".$this->prv."user_alias 
				LEFT JOIN email_account ON ".$this->prv."user_alias.email_induk = email_account.email
				WHERE ".$this->prv."user_alias.email_pengirim =  $username LIMIT 1";
		$r=$this->db->query($sql);
		$result=$r->result();
		return $result;
	}

	function insert_new_out_box($subject,$content,$from,$to,$attach='no attachment',$state)
	{
       $subject=$this->db->escape($subject);
       $content=$this->db->escape($content);
       $from=$this->db->escape($from);
       $to=$this->db->escape($to);
       $attach=$this->db->escape($attach);
       $state=$this->db->escape($state);
       $sql="INSERT INTO ".$this->prv."messages (time,subject,content,pengirim,tujuan,attach,state) 
       		VALUES (NOW(),$subject,$content,$from,$to,$attach,$state)";
       $this->db->query($sql);
	}
	
	function select_messages($where,$from='',$to='')
	{
	if(!empty($from) or !empty($to)){
	 $from=$this->db->escape($from);
	 $to=$this->db->escape($to);
	 $where2 = "LEFT(t1.time,10) >= $from AND LEFT(t1.time,10) <= $to";
	}else{
	 $where2 = '1';
	}
        $sql="SELECT * FROM(SELECT * FROM ".$this->prv."messages where ID != 0 $where ORDER BY time DESC)t1 WHERE $where2 GROUP BY pengirim";
        return $this->db->query($sql);
	}
	  
	function insert_new_inbox($subject,$from,$date,$hasil,$username,$attach)
	{
		//echo "menyimpan";
		$subject=$this->db->escape($subject);
		$from=$this->db->escape($from);
		$date=$this->db->escape($date);
		$content=$this->db->escape($hasil);
		$attach=$this->db->escape($attach);
		$username=$this->db->escape($username);
		 $sql="INSERT INTO ".$this->prv."messages (time,subject,content,pengirim,tujuan,attach,state) 
				VALUES ($date,$subject,$content,$from,$username,$attach,0)";
		$this->db->query($sql);
	}
	
	function get_email_conversation($t1='',$t2='',$date)
	{
		$user1=$this->db->escape($t1);
		$user2=$this->db->escape($t2);
		$date=$this->db->escape($date.'%');
		$where1="pengirim = $user1 AND tujuan = $user2 and time LIKE $date";
		$where2="pengirim = $user2 AND tujuan = $user1 and time LIKE $date";
		$sql="SELECT * FROM ".$this->prv."messages WHERE $where1 OR $where2 ORDER BY time DESC";
		return $this->db->query($sql);
	}
	
	function select_sent_item(){
		$sql="SELECT email_messages.* FROM email_messages LEFT JOIN email_account ON email_messages.pengirim=email_account.username";
		$q=$this->db->query($sql);
		return $q;
	}
 }
//end of file
