<script src='http://tinymce.cachefly.net/4.0/tinymce.min.js'></script>
<script>
        tinymce.init({selector:'textarea'});
</script>
<?php
$opt_account=array();
foreach($actn as $r_acc){
		$opt_account['']="Pilih Pengirim";
		$opt_account[$r_acc->email_pengirim]=$r_acc->nama;
}
if(!isset($pengirim))$pengirim="";
if (!isset($t1)){$t1='';}
$email=array('name'=>'email','value'=>"$t1",'placeholder'=>"masukkan email pisah dengan tanda ':'",'size'=>'100');
$subject=array('name'=>'subject','placeholder'=>"masukkan Subject ",'size'=>'70');
$pesan=array('name'=>'text_message','placeholder'=>'Isi text','cols'=>'22','rows'=>'3');
	echo form_open_multipart("email/email_control/send");
	echo "<center><table border='0' width='700' style='margin:50px;' id='f'>";
	echo "<tr class='td-head'>
		<td colspan=3 class='td-kecil'>Kirim Pesan</td>
		</tr>";
	echo "<tr>
		<td class='td-kecil'>From</td>
		<td class='td-kecil'>:</td>
		<td class='td-kecil'>".form_dropdown('user_account',$opt_account,$pengirim)."</td>
		</tr>";
	echo "<tr>
		<td class='td-kecil'>Tujuan</td>
		<td class='td-kecil'>:</td>
		<td class='td-kecil'>".form_input($email)."</td>
		</tr>";
	echo "<tr>
		<td class='td-kecil'>subject</td>
		<td class='td-kecil'>:</td>
		<td class='td-kecil'>".form_input($subject)."</td>
		</tr>";
	echo "<tr>
		<td class='td-kecil'>Pesan</td>
		<td class='td-kecil'>:</td>
		<td class='td-kecil'>".form_textarea($pesan)."</td>
		</tr>";
	echo "<tr>
		<td class='td-kecil'>Lampiran</td>
		<td class='td-kecil'>:</td>
		<td class='td-kecil'>".form_upload('userfile')."</td>
		</tr>";
	echo "<tr>
		<td class='td-kecil'></td>
		<td class='td-kecil'></td>
		<td class='td-kecil'>".form_submit('submit','Kirim').form_reset('reset','Kosong').form_close().
		"</td>
		</tr>";	
	echo "</table></center>";
	
?>
