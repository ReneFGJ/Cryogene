<?
		$nome_mae = substr($dd[1],strpos($dd[1],'MÃE - ')+5,120);
		$nome_mae = trim(substr($nome_mae,0,strpos($nome_mae,'Procurar')));
		$rg = extrair($dd[1],'RG:');
		$cf = extrair($dd[1],'CPF:');
		$dn = extrair($dd[1],'Data de Nascimento:');
		$na = extrair($dd[1],'Nacionalidade:');
		$pr = extrair($dd[1],'Profissão:');
		$ec = extrair($dd[1],'Estado Civil:');
		$f1 = extrair($dd[1],'Telefone:');
		$f2 = extrair($dd[1],'Celular:');
		$em = extrair($dd[1],'Email:');
		$en = extrair($dd[1],'Endereço:');
		$ba = extrair($dd[1],'Bairro:');
		$ci = extrair($dd[1],'Cidade:');
		$uf = extrair($dd[1],'Estado:');
		$cp = substr(sonumero(extrair($dd[1],'Cep:')),0,10);
		
		$dd[1] = substr($dd[1],strpos($dd[1],'Contato da M'),strlen($dd[1]));
//		echo '<HR><TT>'.$dd[1].'<HR>';
//		$rg = extrair($dd[1],'Email:');
		$ccn = extrair($dd[1],'Nome:');
		$cce = extrair($dd[1],'Endereço:');
		$ccb = extrair($dd[1],'Bairro:');
		$ccc = extrair($dd[1],'Cidade: :');
		$ccu = extrair($dd[1],'Estado:');
		$ccf = extrair($dd[1],'Telefone:');
			
		$sql = "select * from cliente where asc7(cl_nome) = ('".$nome_mae."')";
		$rlt = db_query($sql);
//		echo $sql;
		if ($line = db_read($rlt))
			{
			if (strlen($dn) == 10) { $dn = substr($dn,6,4).substr($dn,3,2).substr($dn,0,2); } else { $dn = '19000101'; }
			$cod =  $line['cl_codigo'];
//			echo '<TABLE width="700" class="lt0"><TR><TD>';
//			echo '<HR>'.$nome_mae;
//			echo '<BR>Codigo : ';
	//		echo $cod;
//			echo '<BR>RG:'.$rg;
//			echo '<BR>CPF:'.$cf;
//			echo '<BR>Data de Nascimento:'.$dn;
//			echo '<BR>Nacionalidade:'.$na;
//			echo '<BR>Profissão:'.$pr;
//			echo '<BR>Estado Civil:'.$ec;
//			echo '<BR>Telefone:'.$f1;
//			echo '<BR>Celular:'.$f2;
//			echo '<BR>Email:'.$em;
//			echo '<BR>Endereço:'.$en;
//			echo '<BR>Bairro:'.$ba;
//			echo '<BR>Cidade:'.$ci.' - '.$uf;
//			echo '<BR>Cep:'.$cp;
//			echo '<BR>Contato :'.$ccn;
			$sql = "select * from estado_civil where (upper(ec_descricao)) = asc7('".strtoupper($ec)."')";
			$rec = db_query($sql);
			if ($esline = db_read($rec))
				{
				$ec = $esline['ec_tipo'];
				} else {
					echo '<FONT COLOR=RED><HR><B>Estado civil não cadastrado : '.$ec;
					exit;
				}
				
			////////////////////////////// Cidade
			$sql = "select * from cidade where upper((upper(c_cidade))) = upper(asc7('".$ci."'))";
			$rec = db_query($sql);
			if ($esline = db_read($rec))
				{
				$ci = $esline['c_codigo'];
				} else {
					echo '<FONT COLOR=RED><HR><B>Cidade não cadastrado : '.$ci;
					exit;
				}
				
			if (strlen($cod) == 7)
				{
				$sql = "update cliente set ";
				$sql = $sql . " cl_rg = '".$rg."',";
				$sql = $sql . " cl_cpf = '".$cf."',";
				$sql = $sql . " cl_dt_nasc = '".$dn."',";
				$sql = $sql . " cl_profissao = '".$pr."',";
				$sql = $sql . " cl_est_civil = '".$ec."',";
				$sql = $sql . " cl_fone_2 = '".$f1."',";
				$sql = $sql . " cl_fone_3 = '".$f2."',";
				$sql = $sql . " cl_nacionalidade = '".$na."',";
				$sql = $sql . " cl_email = '".strtolower($em)."',";
				$sql = $sql . " cl_endereco = '".$en."',";
				$sql = $sql . " cl_bairro = '".$ba."',";
				$sql = $sql . " cl_cidade = '".$ci."',";
				$sql = $sql . " cl_dt_cadastro = '".date('Ymd')."',";
				$sql = $sql . " cl_lastupdate = '".date('Ymd')."',";
				$sql = $sql . " cl_cep = '".$cp."'";
				$sql = $sql . " where cl_codigo = '".$cod."'";
				$rlt = db_query($sql);
				}
				
			/////////////////// CONTATO DA MAE
				if (strlen($ccn) > 0)
					{
//					echo '<HR>Contato da mãe : '.$ccn.'<HR>';
						////////////////////////////// Cidade
						if (strlen($ccc) == 0)
							{
							$ccc = '003';
							} else {
								$sql = "select * from cidade where (c_cidade) = asc7('".$ccc."')";
								$rec = db_query($sql);
								if ($esline = db_read($rec))
									{
									$ccc = $esline['c_codigo'];
									} else {
										echo '<FONT COLOR=RED><HR><B>Cidade do contato não cadastrado : '.$ccc;
										exit;
									}
							}

					
					$sql = "select * from cliente_contato where clc_cliente='".$cod."' and asc7(clc_nome) = asc7('".$ccn."')";
					$rlt = db_query($sql);
					if (!($line = db_read($rlt)))
						{
						$sql = "insert into cliente_contato (clc_bairro,clc_cliente,clc_nome,clc_lastupdate,clc_parentesto,clc_endereco,clc_cidade,clc_fone_1,clc_ddd,clc_email) values ";
						$sql = $sql . "('".$ccb."','".$cod."','".$ccn."','".date("Ymd")."','','".$cce."','".$ccc."','".$ccf."','','');";
						$rlt = db_query($sql);
						} else {
						$sql = "update cliente_contato set ";
						$sql = $sql . " clc_endereco = '".$cce."',";
						$sql = $sql . " clc_bairro = '".$ccb."',";
						$sql = $sql . " clc_cidade = '".$ccc."',";
						$sql = $sql . " clc_fone_1 = '".$ccf."' ";
						$sql = $sql . " where clc_cliente='".$cod."' and (clc_nome) = ('".$ccn."')";
						$rlt = db_query($sql);
						}
					}
//					echo '<TR><TD class="lt1"><TT>'.$sql.'</TD>';
//					echo '</TD></TR></TABLE>';
			}
echo '<CENTER><FONT CLASS="lt4">IMPORTAÇÃO (1) OK!</FONT></CENTER>';			
		?>