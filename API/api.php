<?php 
	if($_GET){   
   // Filtracja przesłanych danych 
		include ("function.php");
		$db = new SQL();
		$db->SetDatabase($db_sms);
		
		if(isset($_GET['idsms']) && isset($_GET['code']) && isset($_GET['iduser']) && isset($_GET['buyer']) && isset($_GET['controle'])){
			$idsms = $_GET['idsms'];
			$code = $_GET['code'];
			$iduser = $_GET['iduser'];
			$buyer = $_GET['buyer'];
			$controle = $_GET['controle'];
			$rezultat = $db->Query("SELECT 'wallet1' FROM 'konta' WHERE 'id_user'=$iduser");
			
			if(GetNumberOfRows($rezultat) == 0) die("Niepoprawny numer ID!"); //podales zle id
			
			list($wallet1) = $db->GetTable($rezultat); // tworze smienna $wallet1 //autoryzacja zmiennej //!!PO CO TO?!!//	
			unset($rezultat); // czyszczenie tablicy
			
			if(!preg_match("/^[A-Za-z0-9]{8}$/",$code)) die("Błędny kod SMS!"); // bledny kod z sms
			
			$rezultat = $db->Query("SELECT * FROM 'sms_pay' WHERE 'id_pay'=$idsms");
			
			if(GetNumberOfRows($rezultat) == 0) die("Błąd 1471!"); //brak takiego id_pay - 1471
			
			list(, $acc_id, $sufix, $numer, $cost, $inter) = $db->GetTable($rezultat);
			unset($rezultat); // czyszczenie tablicy
						// 0 - HomePay 1 - CashBill
			switch ($inter) {
		    	case 0:
		      		unset($numer, $sufix);
								 /*KOD MA WYKONYWAC PO DOSTARCZENIU CODE*/
					$handle=fopen("http://homepay.pl/API/check_code.php?usr_id=".$config_homepay_usr_id."&acc_id=".$acc_id."&code=".$code,'r');
					$check=fgets($handle,8);
					fclose($handle);
						//$check=1; //debug
					switch($check){
						case 0:
							die("Niepoprawny kod!"); //Nieprawidlowy kod
							break;
						case 1:
														//TO DO //Prawidlowy kod
							$db->SmsHistory($iduser, $code, $cost, $buyer);
							$db->Wallet1Update($iduser,$cost);
							echo "SUCCESS!"; //powodzenie platnosci
							break;
						default:
							die("Niepowodzenie płatności"); //niepowodzenie platnosci
							break;
						}												
					break;
				case 1:
		      		unset($id_acc); 
							 /*KOD MA WYKONYWAC PO DOSTARCZENIU CODE*/						
		     		break;
			}
					
		} else {
			die("Błąd danych klienta!");
		}
	}
$db = null;
?>
