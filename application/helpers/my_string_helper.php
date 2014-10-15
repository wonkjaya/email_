<?php
	function ascii_to_hex($ascii){
		$hex = '';

		for($i = 0; $i < strlen($ascii); $i++)
		 $hex .= str_pad(base_convert(ord($ascii[$i]), 10, 16), 2, '0', STR_PAD_LEFT);

		return $hex;
	}

	function add_nol($char,$n){
		if (empty($char)){
			return '';
		}
		$char = substr((str_repeat('0',$n) . $char),-$n);
		return $char;
	}

	function get_char_html($data,$awal,$akhir){
		$html = explode($awal, $data);
		$batas_akhir = strpos($html[1],$akhir);
		$konten = substr($html[1],0,$batas_akhir);
		return $konten;
	}

	function display_error($ci,$title,$msg){
		$data['title'] = 'Form Pengajuan Ijin';
		$ci->load->view('main/header.php',$data);
		$data['pesan'] = $msg;
		$ci->load->view('notif/n.php',$data);
		$ci->load->view('footer',$data);
	}
?>
