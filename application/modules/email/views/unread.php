<table border=1 width="100%">
 <tr class='td-head'>
  <td class='td-kecil' colspan='6'>View Messages<?php echo nbs(3).anchor('email/email_control/refresh','refresh'); ?></td>
 </tr>
<tr bgcolor="#C4C4C4">
  <td class='td-kecil'>NO</td>	<td class='td-kecil'>Tanggal</td>	<td class='td-kecil'>From</td>	<td class='td-kecil'>To</td>	<td class='td-kecil'>Message</td>	<td class='td-kecil'>Attachment</td>
 </tr>
 <?php
 $no=1;
 $un=$unread->result();
 foreach($un as $r)
 {
  $time=$r->time;
  $subject=$r->subject;
  $content=$r->content;
  $from=$r->pengirim;
  $to=$r->tujuan;
  $attach=$r->attach;
  $state=$r->state; 
  if($state==0){$sty="font-weight:bold;";}else{$sty="";}
	echo "<tr>";
	echo "<td class='td-kecil'>$no</td>";
	echo "<td class='td-kecil'>$time</td>";
	echo "<td class='td-kecil'>".anchor('email/email_control/view_conversation/'.str_replace('@',':',$from).'/'.str_replace('@',':',$to),"<p style=$sty>".$from."</p>")."</td>";
	echo "<td class='td-kecil'>$to</td>";
	echo "<td class='td-kecil'>$subject</td>";
	echo "<td class='td-kecil'>$attach</td>";
	echo "</tr>";
	$no++;
 }
 ?>
</table>
