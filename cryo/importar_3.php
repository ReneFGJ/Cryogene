<?
		$nome_mae = substr($dd[1],strpos($dd[1],'COLETAS - ')+10,120);
		$nome_mae = trim(substr($nome_mae,0,strpos($nome_mae,'Procurar')));
		$c1 = extrair($dd[1],'Data de Nascimento:');
		$c2 = extrair($dd[1],'Temperatura:');
		$c3 = extrair($dd[1],'Tipo sanguíneo:');
		$c4 = extrair($dd[1],'Sangramento:');
		$c5 = extrair($dd[1],'Infecção:');
		$c6 = extrair($dd[1],'Antecedentes:');
		$c7 = extrair($dd[1],'Se teve aborto, de quantas semanas:');
		$c8 = extrair($dd[1],'Intercorrências nas outras gestações:');
		$c9 = extrair($dd[1],'Gestação atual Intercorrências:');
		$ca = extrair($dd[1],'Medicamentos que fez uso:');
		
		$c2 = trim(substr($c2,0,strpos($c2,' ')));
		
		if (strpos($c3,'neo') > 0)
			{ echo '<HR><font color=green >'.$c3.'<HR>'; $c3 = trim(substr($c3,strpos($c3,'neo')+5,10)); }
			
///////////////////////////////////////////////////////////
		$xsql = "update coleta set  ";
///////////////////////////////////////////////////////////
		$xsql = $xsql . "col_mae_tp_1='".$c2."', ";
		$xsql = $xsql . "col_mae_sangue='".$c3."', ";
		$xsql = $xsql . "col_mae_sangra='".$c4."', ";
		$xsql = $xsql . "col_mae_infecao='".$c5."', ";
		

		$c6 = '  '.$c6;
		$c6a = round('0'.trim(extrair($dd[1],'G:')));
		$c6b = round('0'.trim(extrair($dd[1],'P:')));
		$c6c = round('0'.trim(extrair($dd[1],'PN:')));
		$c6d = round('0'.trim(extrair($dd[1],'F:')));
		$c6e = round('0'.trim(extrair($dd[1],'C:')));
		$c6f = round('0'.trim(extrair($dd[1],'A:')));
		$c6a = substr($c6a,0,strpos($c6a,' '));
		$c6b = substr($c6b,0,strpos($c6b,' '));
		$c6c = substr($c6c,0,strpos($c6c,','));
		$c6d = substr($c6d,0,strpos($c6d,','));
		$c6e = substr($c6e,0,strpos($c6e,','));
		$c6f = substr($c6f,0,strpos($c6f,')'));
		$xsql = $xsql . "col_pn_g='0".$c6a."', ";
		$xsql = $xsql . "col_pn_p='0".$c6b."', ";
		$xsql = $xsql . "col_pn_pn='0".$c6c."', ";
		$xsql = $xsql . "col_pn_f='0".$c6d."', ";
		$xsql = $xsql . "col_pn_c='0".$c6e."', ";
		$xsql = $xsql . "col_pn_a='0".$c6f."', ";

		/////////////////////////////////
		$c7 = '0'.substr($c7,0,strpos($c7,' '));
		$xsql = $xsql . "col_pn_aborto='".sonumero($c7)."', ";


		/////////////////////////////////
		$xsql = $xsql . "col_pn_ig='".$c8."', ";

		/////////////////////////////////
		$xsql = $xsql . "col_pn_ga='".$c9."', ";

		/////////////////////////////////
		$xsql = $xsql . "col_pn_medicamento='".$ca."', ";

		
		
		$dd[1] = substr($dd[1],strpos($dd[1],'Dados do Parto'),strlen($dd[1]));
		$cc1 = extrair($dd[1],'Tipo:');
		$cc2 = extrair($dd[1],'Data:');
		$cc3 = extrair($dd[1],'Bolsa rota:');
		$cc4 = extrair($dd[1],'Trabalho de parto:');
		$cc5 = extrair($dd[1],'Local de coleta:');
			
		$sql = "select * from cliente where (cl_nome) = ('".$nome_mae."')";
		$rlt = db_query($sql);

		if ($line = db_read($rlt))
			{
			if (strlen($dn) == 10) { $dn = substr($dn,6,4).substr($dn,3,2).substr($dn,0,2); } else { $dn = '19000101'; }
			$cod =  $line['cl_codigo'];
			$contrato =  trim($line['cl_old_id']);
			while (strlen($contrato) < 6) { $contrato = '0'.$contrato; }
			$cc2d = $cc2;
			$ccd = substr($cc2,0,strpos($cc2,' '));
			$contrato = '1'.$contrato;
			$cc2a = trim(substr($cc2,strpos($cc2d,':')-2,5));
			if (strlen($cc2a) == 4) { $cc2a = '0'.$cc2a; }
			if (strpos($ccd,'/') == 0)
				{
				$cc2 = substr($cc2,0,4).substr($cc2,5,2).substr($cc2,8,2);
				} else {
					if (strlen($ccd) == 10) 
						{
							$cc2 = substr($cc2,6,4).substr($cc2,3,2).substr($cc2,0,2);
						} else {
							$cc2 = '20'.substr($cc2,6,2).substr($cc2,3,2).substr($cc2,0,2);
						}
				}
//			echo '<TABLE width="700" class="lt0"><TR><TD>';
//			echo '<HR>'.$nome_mae;
//			echo '<HR><FONT CLASS="lt1"><CENTER>Dados do Parto</CENTER></FONT><HR>';
//			echo 'Tipo :'.$cc1;
//			echo '<BR>Data :'.$cc2.' == '.$cc2d.' -- '.$ccd;
//			echo '<BR>Hora :'.$cc2a;
//			echo '<BR>Bolsa rota :'.$cc3;
//			echo '<BR>Trabalho de parto :'.$cc4;
//			echo '<BR>Local de coleta :'.$cc5;
//			echo '<HR><FONT CLASS="lt1"><CENTER>Contrato</CENTER></FONT><HR>';
			$sql = "select * from contrato where ctr_responsavel = '".$cod."' ";
//			$sql = $sql . " and ctr_parto_data = '".$cc2."' and ctr_parto_hora='".$cc2a."' ";
			$rtt = db_query($sql);
			if (!($cline = db_read($rtt)))
				{
				$sql = "insert into contrato (ctr_numero,ctr_dt_assinatura,ctr_dt_renuncia,ctr_status,";
				$sql = $sql . "ctr_responsavel,ctr_responsavel_nome,ctr_cobranca,";
				$sql = $sql . "ctr_vencimento_dia,ctr_tipo_1,ctr_tipo_2,ctr_tipo_3,ctr_tipo_4,";
				$sql = $sql . "ctr_parto_data,ctr_parto_hora,ctr_cobranca_tipo) values (";
				$sql = $sql . "'".$contrato."','".$cc2."',";
				$sql = $sql . "'19000101',";
				$sql = $sql . "'Z',";
				$sql = $sql . "'".$cod."',";
				$sql = $sql . "'".$nome_mae."',";
				$sql = $sql . "'".$cod."',";
				$sql = $sql . "'".substr($cc2,4,2)."',";
				$sql = $sql . "'0000',";
				$sql = $sql . "'0000',";
				$sql = $sql . "'0000',";
				$sql = $sql . "'0000',";
				$sql = $sql . "'".$cc2."',";
				$sql = $sql . "'".$cc2a."',";
				$sql = $sql . "'B1'";
				$sql = $sql . ");";
				$sql = $sql . "update contrato set ctr_numero = lpad(id_ctr,7,'0') ";
				$sql = $sql . " where length(ctr_numero) = 0";
				$rlt = db_query($sql);
				}

		$dd[1] = substr($dd[1],strpos($dd[1],'Dados do RN'),strlen($dd[1]));
//		echo '<HR><TT>'.$dd[1].'<HR>';
		$ce2 = extrair($dd[1],'Idade gestacional:');
		$ce1 = extrair($dd[1],'Nome do RN');
		$ce3 = extrair($dd[1],'Peso:');
		$ce4 = extrair($dd[1],'Sexo:');
		$ce5 = strtoupper(extrair($dd[1],'Sofrimento:'));
		$ce2 = substr($ce2,0,strpos($ce2,' '));				
		$ce3 = substr($ce3,0,strpos($ce3,' '));				
		$ce4 = substr($ce4,0,1);				
		if (substr($ce5,0,1) == 'S') { $ce5 = 1; } else { $ce5 = 0; }
//		$xsql = $xsql . "col_rn_nome = '".$ce1."' , ";
		$xsql = $xsql . "col_rn_ig = '".$ce2."' , ";
		$xsql = $xsql . "col_rn_peso = '".$ce3."' , ";
		$xsql = $xsql . "col_rn_sexo = '".$ce4."' , ";
		$xsql = $xsql . "col_rn_sf = '".$ce5."' , ";

////////////////////////////////////////////////////////////////////////////////
		$dd[1] = substr($dd[1],strpos($dd[1],'Dados da coleta'),strlen($dd[1]));
		$cf1 = extrair($dd[1],'Sangue');
		$cf2 = extrair($dd[1],'Cordão');
		$cf3 = extrair($dd[1],'Anticoagulante utilizado:');
		$cf4 = extrair($dd[1],'Observações:');

		$cf1 = substr($cf1,0,strpos($cf1,'Cord'));				
		if (strpos($cf1,'X') > 0) { $cf1=1; } else { $cf1=0; }
		if (strpos($cf2,'X') > 0) { $cf2=1; } else { $cf2=0; }
		$xsql = $xsql . "col_dc_sangue = '".$cf1."' , ";
		$xsql = $xsql . "col_dc_placenta = '".$cf2."' , ";
		$xsql = $xsql . "col_dc_au = '".$cf3."' , ";
////////////////////////////////////////////////////////////////////////////////
		$dd[1] = substr($dd[1],strpos($dd[1],'Dados do transporte'),strlen($dd[1]));
//				echo '<HR><TT><font color=blue>'.$dd[1].'<HR></font>';
		$cg1 = extrair($dd[1],'cio:');
		$cg2 = '0';
		$cg3 = extrair($dd[1],'xima: Início:');
		$cg4 = '0';
		$cg5 = extrair($dd[1],'materna transportada');
		$cg6 = extrair($dd[1],'SCUP transportadas');

		$cg1 = substr($cg1,0,strpos($cg1,' '));				
		$cg3 = substr($cg3,0,strpos($cg3,' '));				
		$xsql = $xsql . "col_dt_tp_1 = '".$cg1."' , ";
		$xsql = $xsql . "col_dt_tp_2 = '".$cg2."' , ";
		$xsql = $xsql . "col_dt_tp_3 = '".$cg3."' , ";
		$xsql = $xsql . "col_dt_tp_4 = '".$cg4."' , ";
		$xsql = $xsql . "col_dt_nat = '0".$cg5."' , ";
		$xsql = $xsql . "col_dt_nu = '0".$cg6."' , ";

////////////////////////////////////////////////////////////////////////////////
		$dd[1] = substr($dd[1],strpos($dd[1],'Responsável pela coleta'),strlen($dd[1]));
//				echo '<HR><TT><font color=blue>'.$dd[1].'<HR></font>';
		$ch1 = extrair($dd[1],'dico:');
		$ch2 = extrair($dd[1],'CRM:');
		$ch3 = extrair($dd[1],'Enfermeira');
		$ch4 = extrair($dd[1],'COREN');

		$ch1 = substr($ch1,0,strpos($ch1,' '));				
		$ch3 = substr($ch3,0,strpos($ch3,','));				

		$xsql = $xsql . "col_rc_med = '".substr($ch1,0,7)."' , ";
		$xsql = $xsql . "col_rc_enf = '".substr($ch3,0,7)."', ";

		$xsql = $xsql . "col_dc_obs = '".$cf4.chr(13).chr(10).$ch1.chr(13).chr(10).$ch3."' , ";
		
		
		///////////////////////////////////	DATA DO PARTO
		$xsql = $xsql . "col_dp_tipo = '".$cc1."', ";
		$xsql = $xsql . "col_dp_tp = '".$cc4."'," ;
		$xsql = $xsql . "col_dp_br = '".sonumero(substr($cc3,0,3))."'," ;
		$xsql = $xsql . "col_dp_hora = '".$cc2a."'," ;
		$xsql = $xsql . "col_dp_data = '".$cc2."', " ;
		

		$sql = "select * from coleta where col_mae = '".$cod."' and col_contrato = '".$contrato."' ";
		$rlt = db_query($sql);
		
		if (!($line = db_read($rlt)))
			{ $sql = "insert into coleta (col_mae,col_contrato) values ('".$cod."','".$contrato."') ";
				$rlt = db_query($sql);
				}
				
		echo '<HR>';
		
		/////////////////////////////  Busca nome do RN
		$sql = "select * from cliente where cl_parceira = '".$cod."' and cl_profissao = 'RN'";
		$rlt = db_query($sql);
		if ($line = db_read($rlt))
			{
			$rn = $line['cl_nome'];
			}
		
		////////////////////////////////
		$xsql = $xsql . "col_rn_nome = '".$rn."' " ;


		///////////////// FINALMENTE
		$xsql = $xsql . " where col_mae ='".$cod."' and col_contrato = '".$contrato."' ";
		
		$rlt = db_query($xsql);
		}
		
		echo '<CENTER><FONT CLASS="lt4">IMPORTAÇÃO (3) OK!</FONT></CENTER>';
		?>