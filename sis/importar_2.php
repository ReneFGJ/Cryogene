<?
//echo "PAI";
		$nome_mae = substr($dd[1],strpos($dd[1],'PARTOS - ')+8,120);
		$nome_mae = trim(substr($nome_mae,0,strpos($nome_mae,'Procurar')));
		$pai= extrair($dd[1],'Nome:');
		$rg = extrair($dd[1],'RG:');
		$cf = extrair($dd[1],'CPF:');
		$dn = extrair($dd[1],'Data de Nascimento:');
		$na = extrair($dd[1],'Nacionalidade:');
		$pr = extrair($dd[1],'Profissão:');
		$ec = extrair($dd[1],'Estado Civil:');
		$f1 = extrair($dd[1],'Telefone:');
		$f2 = extrair($dd[1],'Cel.:');
		$em = extrair($dd[1],'Email:');
		$en = extrair($dd[1],'Endereço:');
		$ba = extrair($dd[1],'Bairro:');
		$ci = extrair($dd[1],'de:');
		$uf = '';
		$cp = substr(sonumero(extrair($dd[1],'Cep:')),0,10);

		if (strpos($ci,'-') > 0) { $ci = trim(substr($ci,0,strpos($ci,'-'))); }
		if (strpos($f1,'Cel') > 0) {$f1 = trim(substr($f1,0,strpos($f1,'Cel')-5)); }

		$dd[1] = substr($dd[1],strpos($dd[1],'Contato'),strlen($dd[1]));
		$ccn = extrair($dd[1],'Nome:');
		$cce = extrair($dd[1],'Endereço:');
		$ccb = extrair($dd[1],'Bairro:');
		$ccc = extrair($dd[1],'Cidade:');
		$ccu = extrair($dd[1],'Estado:');
		$ccf = extrair($dd[1],'Telefone:');
		
		if (strpos($ccc,'-') > 0) { $ccc = trim(substr($ccc,0,strpos($ccc,'-'))); }

		$dd[1] = substr($dd[1],strpos($dd[1],'Dados do Parto'),strlen($dd[1]));
		$ca1 = extrair($dd[1],'Nome do filho:');
		$ca2 = extrair($dd[1],'Local Previsto :');
		$ca3 = extrair($dd[1],'Endereço previsto:');
		$ca4 = extrair($dd[1],'Cidade prevista:');
		$ca5 = extrair($dd[1],'Estado previsto:');
		$ca6 = extrair($dd[1],'Tipo de parto:');
		$ca7 = extrair($dd[1],'Observações:');
		$ca8 = extrair($dd[1],'Data Prevista:');
		$ca9 = extrair($dd[1],'Nome do médico:');
		$caa = extrair($dd[1],'Telefone do médico:');
		
//		echo '<BR>Nome do filho(a):'.$ca1;
//		echo '<BR>Local :'.$ca2;
		if (strlen($ca2) > 2) 
			{
			$sql = "select * from local_coleta where upper((lc_local)) = upper(('".$ca2."'))";
			$rlt = db_query($sql);
			if (!($line = db_read($rlt)))
				{
						echo '<FONT COLOR=RED><HR><B>Local de coleta não cadastrado : '.$ca2;
						exit;			
				}
				$cac = $line['lc_codigo'];
			} else { $cac = '00007'; }
//		echo '<BR>Local Codigo:'.$cac;

		$sql = "select * from cliente where (cl_nome) = ('".$nome_mae."')";
		$rlt = db_query($sql);
//		echo $sql;
		if ($line = db_read($rlt))
			{
			if (strlen($dn) == 10) { $dn = substr($dn,6,4).substr($dn,3,2).substr($dn,0,2); } else { $dn = '19000101'; }
			$cod =  $line['cl_codigo'];
///			echo '<TABLE width="700" class="lt0"><TR><TD>';
//			echo '<HR>'.$nome_mae;
//			echo '<BR>Codigo : ';
//			echo $cod;
//			echo '<BR>Pai:'.$pai;
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
			$sql = "select * from estado_civil where (upper(ec_descricao)) = ('".strtoupper($ec)."')";
			$rec = db_query($sql);
			if ($esline = db_read($rec))
				{
				$ec = $esline['ec_tipo'];
				} else {
					echo '<FONT COLOR=RED><HR><B>Estado civil não cadastrado : '.$ec;
					exit;
				}
				
			////////////////////////////// Cidade
			$sql = "select * from cidade where upper((upper(c_cidade))) = upper(('".$ci."'))";
			$rec = db_query($sql);
			if ($esline = db_read($rec))
				{
				$ci = $esline['c_codigo'];
				} else {
					echo '<FONT COLOR=RED><HR><B>Cidade não cadastrado : '.$ci;
					exit;
				}
				
//////////////////////////////////////////// FILHO / FILHA
			if ((strlen($cod) == 7) and (strlen($ca1) > 0))
				{
				$sql = "select * from cliente where (cl_nome) = ('".$ca1."')";
				$rlt = db_query($sql);
//				echo '----------';
				if (!($line = db_read($rlt)))
					{
					$sql = "insert into cliente (cl_parceira,cl_nome,cl_codigo) values ('".$cod."','".$ca1."','')";
					$rlt = db_query($sql);
					$sql = "update cliente set cl_codigo = lpad(id_cl,7,'0') where cl_codigo = ''";
					$rlt = db_query($sql);
					$sql = "select * from cliente where asc7(cl_nome) = asc7('".$ca1."')";
					$rlt = db_query($sql);
					$line = db_read($rlt);
					$codp = $line['cl_codigo'];
					}
				$sql = "update cliente set ";
				$sql = $sql . " cl_rg = '',";
				$sql = $sql . " cl_cpf = '',";
				$sql = $sql . " cl_dt_nasc = '19000131',";
				$sql = $sql . " cl_profissao = 'RN',";
				$sql = $sql . " cl_est_civil = 'S',";
				$sql = $sql . " cl_fone_2 = '".substr($f1,0,15)."',";
				$sql = $sql . " cl_fone_3 = '".substr($f2,0,15)."',";
				$sql = $sql . " cl_nacionalidade = '',";
				$sql = $sql . " cl_email = '".strtolower($em)."',";
				$sql = $sql . " cl_endereco = '".$en."',";
				$sql = $sql . " cl_bairro = '".$ba."',";
				$sql = $sql . " cl_cidade = '".$ci."',";
				$sql = $sql . " cl_dt_cadastro = '".date('Ymd')."',";
				$sql = $sql . " cl_lastupdate = '".date('Ymd')."',";
				$sql = $sql . " cl_cep = '' ,";
				$sql = $sql . " cl_sexo = '' ";
				$sql = $sql . " where cl_nome = '".$ca1."' and cl_parceira = '".$cod."'";
				$rlt = db_query($sql);
				}

			if (strlen($cod) == 7)
				{
				$sql = "select * from cliente where (cl_nome) = ('".$pai."')";
				$rlt = db_query($sql);
//				echo '----------';
				if (!($line = db_read($rlt)))
					{
					$sql = "insert into cliente (cl_cpf,cl_nome,cl_codigo) values ('".$cpf."','".$pai."','')";
					$rlt = db_query($sql);
					$sql = "update cliente set cl_codigo = lpad(id_cl,7,'0') where cl_codigo = ''";
					$rlt = db_query($sql);
					$sql = "select * from cliente where (cl_nome) = asc7('".$pai."')";
					$rlt = db_query($sql);
					$line = db_read($rlt);
					$codp = $line['cl_codigo'];
					}
				$sql = "update cliente set ";
				$sql = $sql . " cl_rg = '".$rg."',";
				$sql = $sql . " cl_cpf = '".$cf."',";
				$sql = $sql . " cl_dt_nasc = '".$dn."',";
				$sql = $sql . " cl_profissao = '".$pr."',";
				$sql = $sql . " cl_est_civil = '".$ec."',";
				$sql = $sql . " cl_fone_2 = '".substr($f1,0,15)."',";
				$sql = $sql . " cl_fone_3 = '".substr($f2,0,15)."',";
				$sql = $sql . " cl_nacionalidade = '".$na."',";
				$sql = $sql . " cl_email = '".strtolower($em)."',";
				$sql = $sql . " cl_endereco = '".$en."',";
				$sql = $sql . " cl_bairro = '".$ba."',";
				$sql = $sql . " cl_cidade = '".$ci."',";
				$sql = $sql . " cl_dt_cadastro = '".date('Ymd')."',";
				$sql = $sql . " cl_lastupdate = '".date('Ymd')."',";
				$sql = $sql . " cl_cep = '".$cp."' ,";
				$sql = $sql . " cl_sexo = 'M',";
				$sql = $sql . " cl_parceira = '".$cod."' ";
				$sql = $sql . " where cl_nome = '".$pai."' and cl_cpf = '".$cpf."'";
				$rlt = db_query($sql);
				}
				
			/////////////////// CONTATO DA MAE
				if (strlen($ccn) > 0)
					{
//					echo '<HR>Contato do pai : '.$ccn.'<HR>';
						////////////////////////////// Cidade
						if ((strlen($ccc) == 0) or ($ccc=='-'))
							{
							$ccc = '003';
							} else {
								$sql = "select * from cidade where (c_cidade) = ('".$ccc."')";
								$rec = db_query($sql);
								if ($esline = db_read($rec))
									{
									$ccc = $esline['c_codigo'];
									} else {
										echo '<FONT COLOR=RED><HR><B>Cidade do contato não cadastrado : '.$ccc.' (1)';
										exit;
									}
							}

					
					$sql = "select * from cliente_contato where clc_cliente='".$codp."' and (clc_nome) = ('".$ccn."')";
					$rlt = db_query($sql);
					if (!($line = db_read($rlt)))
						{
						$sql = "insert into cliente_contato (clc_bairro,clc_cliente,clc_nome,clc_lastupdate,clc_parentesto,clc_endereco,clc_cidade,clc_fone_1,clc_ddd,clc_email) values ";
						$sql = $sql . "('".$ccb."','".$codp."','".$ccn."','".date("Ymd")."','','".$cce."','".$ccc."','".substr($ccf,0,15)."','','');";
						$rlt = db_query($sql);
						} else {
						$sql = "update cliente_contato set ";
						$sql = $sql . " clc_endereco = '".$cce."',";
						$sql = $sql . " clc_bairro = '".$ccb."',";
						$sql = $sql . " clc_cidade = '".$ccc."',";
						$sql = $sql . " clc_fone_1 = '".substr($ccf,0,15)."' ";
						$sql = $sql . " where clc_cliente='".$codp."' and (clc_nome) = ('".$ccn."')";
						$rlt = db_query($sql);
						}
					}
//					echo '<TR><TD class="lt1"><TT>'.$sql.'</TD>';
//					echo '</TD></TR></TABLE>';
			}
			echo '<CENTER><FONT CLASS="lt4">IMPORTAÇÃO (2) OK!</FONT></CENTER>';	
			
			
		?>