<?
$dx01 = DateAdd('m',-1,$dd[0]);
$dx02 = DateAdd('d',-7,$dd[0]);
$dx03 = DateAdd('d',-1,$dd[0]);
$dx04 = date("Ymd");
$dx05 = DateAdd('d',1,$dd[0]);
$dx06 = DateAdd('d',7,$dd[0]);
$dx07 = DateAdd('m',1,$dd[0]);
$link01='<A HREF="'.$pg.'?dd0='.$dx01.'">&nbsp;<<<&nbsp;</A>';
$link02='<A HREF="'.$pg.'?dd0='.$dx02.'">&nbsp;<<&nbsp;</A>';
$link03='<A HREF="'.$pg.'?dd0='.$dx03.'">&nbsp;<&nbsp;';
$link04='<A HREF="'.$pg.'?dd0='.$dx04.'">&nbsp;HOJE&nbsp;';
$link05='<A HREF="'.$pg.'?dd0='.$dx05.'">&nbsp;></A>&nbsp;';
$link06='<A HREF="'.$pg.'?dd0='.$dx06.'">&nbsp;>></A>&nbsp;';
$link07='<A HREF="'.$pg.'?dd0='.$dx07.'">&nbsp;>>></A>&nbsp;';
$link11='<A HREF="#" onclick="newwin('.chr(39).$pg_edit."?dd7=".$dd[0]."');".'">&nbsp;+&nbsp;';
$link12='<A HREF="'.$pg_search.'?dd0='.$dx11.'">&nbsp;busca&nbsp;';
$link13='<A HREF="'.$pg.'?dd0='.$dd[0].'">&nbsp;refresh&nbsp;';
$link14='<A HREF="'.$pg_cal.'?dd0='.$dd[0].'">&nbsp;calendário&nbsp;';
$link15='<A HREF="'.$pg.'?dd0='.$dd[0].'&dd1=V">&nbsp;V+&nbsp;';
$link16='<A HREF="'.$pg.'?dd0='.$dd[0].'&dd1=N" title="ordena por nome">&nbsp;N+&nbsp;';
?>
<TABLE class="lt1" align="center">
<TR>
<TD><TABLE class="lt1" border="1" cellspacing="0"><TR><TD><?=$link01;?></TD></TD></TR></TABLE>
<TD><TABLE class="lt1" border="1" cellspacing="0"><TR><TD><?=$link02;?></TD></TD></TR></TABLE>
<TD><TABLE class="lt1" border="1" cellspacing="0"><TR><TD><?=$link03;?></TD></TD></TR></TABLE>
<TD><TABLE class="lt1" border="1" cellspacing="0"><TR><TD><?=$link04;?></TD></TD></TR></TABLE>
<TD><TABLE class="lt1" border="1" cellspacing="0"><TR><TD><?=$link05;?></TD></TD></TR></TABLE>
<TD><TABLE class="lt1" border="1" cellspacing="0"><TR><TD><?=$link06;?></TD></TD></TR></TABLE>
<TD><TABLE class="lt1" border="1" cellspacing="0"><TR><TD><?=$link07;?></TD></TD></TR></TABLE>
</TR>
</TABLE>

<TABLE class="lt1" align="center">
<TR>
<TD><TABLE class="lt1" border="1" cellspacing="0"><TR><TD><?=$link11;?></TD></TD></TR></TABLE>
<TD><TABLE class="lt1" border="1" cellspacing="0"><TR><TD><?=$link12;?></TD></TD></TR></TABLE>
<TD><TABLE class="lt1" border="1" cellspacing="0"><TR><TD><?=$link13;?></TD></TD></TR></TABLE>
<TD><TABLE class="lt1" border="1" cellspacing="0"><TR><TD><?=$link14;?></TD></TD></TR></TABLE>
<TD><TABLE class="lt1" border="1" cellspacing="0"><TR><TD><?=$link15;?></TD></TD></TR></TABLE>
<TD><TABLE class="lt1" border="1" cellspacing="0"><TR><TD><?=$link16;?></TD></TD></TR></TABLE>
</TR>

</TABLE>