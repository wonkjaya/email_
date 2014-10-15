<?php
	function hitung_lama($tgl){
		$d1 = new DateTime(date('Y-m-d H:i:s'));
		$d2 = new DateTime($tgl);
		$interval = $d1->diff($d2);
		$int = '';
		if ($interval->d > 0){
			$int .= $interval->d . ' hari ';
		}

		if ($interval->h > 0){
			$int .= $interval->h . ' jam ';
		}

		if ($interval->i > 0){
			$int .= $interval->i . ' menit ';
		}

		if (empty($int)){
			$int = 'Beberapa detik';
		}

		return $int;
	}


	function combo_tahun($nStart,$nEnd,$default=''){
		$n1 = date('Y') - $nStart;
		$n2 = date('Y') + $nEnd;
		if (empty($default)){
			$sekarang = date('Y');
		} else {
			$sekarang = $default;
		}
		$cmb =  '<select name="cmb_tahun">';
		for ($i = $n1; $i <= $n2; $i ++){
			$s = '';
			if ($sekarang == $i){
				$s = ' SELECTED ';
			}
			$cmb .= '<option value="' .$i. '" ' .$s. '>' .$i. '</option>';
		}
		$cmb .= '</select>';
		return $cmb;
	}

	function combo_bulan($default=''){
		$aBulan = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
		if (empty($default)){
			$sekarang = date('n');
		} else {
			$sekarang = $default;
		}
		$cmb =  '<select name="cmb_bulan">';
		for ($i = 0; $i <= 11; $i ++){
			$x = $i + 1;
			if ($x <= 9){$x =$x;}
			$s = '';
			if ($sekarang == $x){
				$s = ' SELECTED ';
			}
			$cmb .= '<option value="' . $x . '" ' .$s. '>' .$aBulan[$i]. '</option>';
		}
		$cmb .= '</select>';
		return $cmb;
	}

	function get_n_bulan($str){
	// mengambil numeric bulan dari format tahunbulan
		return substr($str,4,2) * 1;
	}

	function get_n_tahun($str){
	// mengambil numeric bulan dari format tahunbulan
		return substr($str,0,4) * 1;
	}

	function ambil_tanggal($default){
		$CI =& get_instance();
		$tgl1 = $CI->input->get('tgl1');
		$tgl2 = $CI->input->get('tgl2');
		if ($default == 'd'){
			$tgl1 = (empty($tgl1)?date('d-m-Y'):$tgl1);
		} else {
			$tgl1 = (empty($tgl1)?'1-' . date('m-Y'):$tgl1);
		}
		$tgl2 = (empty($tgl2)?date('d-m-Y'):$tgl2);
		$tgl1 = date('Y-m-d',strtotime($tgl1));
		$tgl2 = date('Y-m-d',strtotime($tgl2));
		$tgl = array($tgl1,$tgl2);
		return $tgl;
	}

	function ubah_tanggal($date,$var,$format){
		return date($format, strtotime($var, strtotime($date)));
	}

	function bulan_indo($n){
		$aBulan = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
		return $aBulan[$n-1];
	}

	function hitung_rentang($detik,$tanggal2,$tanggal1){
		if (empty($tanggal1)){
			$date1 = new DateTime(date('Y-m-d H:i:s'));
		} else {
			$date1 = new DateTime(date('Y-m-d H:i:s',strtotime($tanggal1)));
		}

		$date2 = new DateTime(date('Y-m-d H:i:s',strtotime($tanggal2)));
		$interval = $date1->diff($date2);

		$hasil = '';
		if ($interval->y > 0){
			$hasil .= $interval->y . ' tahun ';
		}

		if ($interval->m > 0){
			$hasil .= $interval->m . ' bulan ';
		}

		if ($interval->d > 0){
			$hasil .= $interval->d . ' hari';
		}

		if ($detik){
			$hasil .= ' ';
			if ($interval->h > 0){
				$hasil .= $interval->h . ' jam ';
			}

			if ($interval->i > 0){
				$hasil .= $interval->i . ' menit ';
			}

			if ($interval->s > 0){
				$hasil .= $interval->s . ' detik';
			}
		}

		return $hasil;
	}
?>
