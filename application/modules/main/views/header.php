<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/default.css'); ?>">
<link rel="stylesheet" type="text/css" href="http://192.168.100.215:88/adm/assets/css/default.css">
<link rel="stylesheet" type="text/css" href="http://192.168.100.215:88/adm/assets/css/blink.css">
<link href="http://192.168.100.215:88/adm/assets/css/adm.png" rel="shortcut icon">
<link rel="stylesheet" type="text/css" href="http://192.168.100.215:88/adm/assets/css/jquery-ui-1.8.9.custom.css">
<script src="http://192.168.100.215:88/adm/assets/js/jquery-1.5.js"></script>
<script src="http://192.168.100.215:88/adm/assets/js/jquery-ui-1.8.9.custom.min.js"></script>

<div style="background:#CADBFF;background1:pink;text-align:center;font-size;30px;font-weight:bold;width1:100%;vertical-align:center;padding:20px;border-bottom:1px dotted  #000000;">
<table width="100%">
	<tbody><tr>
		<td width="52px"></td>
		<td width="480px" style="padding-left:10px;">
			<a href="http://192.168.100.215:88/adm/index.php/"><b>CV. Surya Semesta Digital Media</b></a>			<br>
			Jl. Ikan Gurami Perum Little Kyoto Blok C no 1 Malang<br>
			Web : www.suseda.co.id Telp : 0341.488.511 SMS Center : 0852.55.88.2010
		</td>
		<td width="*" style="text-align:right;padding-right:10px;"></td>
		<td width="52" style="text-align:right;">
			</td>
	</tr>
</tbody></table>
</div>
<table border="1" cellspacing="1px" height="30px" align="center" width="100%">
	<tr>
	<?php
          echo "<td bgcolor='green'>".anchor('email/email_control/compose','tulis pesan')."</td> ";
          echo "<td bgcolor='green'>".anchor('email/email_control/view_mail','view pesan masuk')."</td>";
          echo "<td bgcolor='green'>".anchor('email/email_control/view_unread','Unread')."</td>";
          echo "<td bgcolor='green'>".anchor('email/email_control/sent_item','Sent')."</td>";
        ?>
		<td width=70%></td> 
	</tr>
</table>
