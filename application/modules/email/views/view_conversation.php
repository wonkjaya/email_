<?php
if(!isset($count)){	$count=1;}
$awal=1;
$akhir=$count;
if($page + 1 < $akhir)$next=$page + 1; else $next=$akhir;
if($page - 1 > $awal)$pref=$page - 1; else $pref=$awal;
foreach($messages as $r)
 {
  $time=date_format(date_create($r->time),'d M Y');
  }
?>

<table border=1 width="100%">
	 <tr >
		<td class='td-kecil' style="text-align:right;width:40%">Tanggal Tampil: <?php echo "<b>$time</b>"; ?></td>
		<td class='td-kecil' style="text-align:center;width:160">
			<a class="button-link" style="float:left;" href="<?php echo site_url(uri_string().'?pg=1'); ?>"> Awal</a>
			<a class="button-link" style="float:left;" href="<?php echo site_url(uri_string().'?pg='.$pref); ?>"> < </a>
			<?php
			$opt=array('name'=>'pg','value'=>$page,'style'=>"text-align:center; width:30px; float:left;");
			echo form_open();
			echo form_input($opt);
			echo form_close();
			?>
			<a class="button-link" style="float:left;" href="<?php echo site_url(uri_string().'?pg='.$next); ?>"> > </a>
			<a class="button-link" style="float:left;" href="<?php echo site_url(uri_string().'?pg='.$akhir); ?>"> Akhir </a>
		</td>  
		<td class='td-kecil' style="text-align:left;"> <?php echo "Total: $count Halaman"; ?>	</td>
	 </tr>
</table> 

<table border=1 width="100%"> 
	<tr class='td-head'>
	  <td class='td-kecil' colspan='6'>View Messages<?php /*echo nbs(3).anchor('email/email_control/refresh','refresh'); */?></td>
	 </tr> 
	<tr bgcolor="#C4C4C4">
	  <td class='td-kecil' width=30>NO</td>	<td class='td-kecil' width=120>Tanggal</td>	<td class='td-kecil' colspan="3" style="text-align:center;">Message</td>	<td class='td-kecil' width=100>Attachment</td>
	 </tr>
	 <?php
	 $no=1;
	 foreach($messages as $r)
	 {
	  $time=$r->time;
	  $subject=$r->subject;
	  $c=$r->content;
	  $from=$r->pengirim;
	  $to=$r->tujuan;
	  $attach=$r->attach;
	  $state=$r->state;
	if ($from != $user){
		$tujuan=str_replace('@',':',$from);
		$to=str_replace('@',':',$to);
		$rep=anchor('email/email_control/reply/'.$tujuan ."?with=".$to,"reply");
		}else{
			$tujuan=str_replace('@','-',$to);
			$rep='';
		}
	$a=strpos($c,'</head>');
	$c1=substr($c,$a);
	$content=str_replace("<=\n",'<',$c1);
	  if($state==0){$sty="font-weight:bold;";}else{$sty="";}
		echo "<tr>";
		echo "<td class='td-kecil'>$no</td>";
		echo "<td class='td-kecil'>$time</td>";
		echo '<td class="td-kecil" width="20"><img src=""></td>';//http://192.168.100.215:88/adm/assets/images/status/smsm"alt= 
		echo "<td class='td-kecil' width='50'>$rep</td>";
		echo "<td class='td-kecil'><p style='font-weight:bold;'>$subject</p>$content</td>";
		echo "<td class='td-kecil'>$attach</td>";
		echo "</tr>";
		$no++;
	 }
	 ?>
</table>
