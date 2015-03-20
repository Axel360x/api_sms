<?php 
    
    //Przykladowe dane wyslane przez api 
    $id_pay = '1';
    $code = "asd123f4";
    $id_user = '1';
    $buyer = urlencode('MARVIN');
	$sumakontrolna = urlencode('nick');

    
   $check = file_get_contents('http://localhost/SMS-API/API/api.php?idsms='.$id_pay.'&code='.$code.'&iduser='.$id_user.'&buyer='.$buyer.'&controle='.$sumakontrolna); 
   
   echo $check; echo '&nbsp';
   
 
   /*
 if($check){ 
       if($check == '1'){ 
           echo 'Kod poprawny'; 
       }elseif($check == '2'){ 
           echo 'Błędny klucz api';
	   }elseif($check == '3'){ 
           echo '3'; 
	   }elseif($check == '4'){ 
           echo '4';  
	   }elseif($check == '5'){ 
           echo '5'; 
	   }elseif($check == '6'){ 
           echo '6';  
	   }elseif($check == '7'){ 
           echo '7';  
	   }elseif($check == '8'){ 
           echo '8'; 
	   }elseif($check == '9'){ 
           echo '9';  
       }elseif($check == '0'){ 
           echo 'Błędny kod sms'; 
       }else{ 
           echo 'Nieznany błąd'; 
       }    
   }else{ 
       echo 'Błąd połączenia z operatorem'; 
   } 
	*/
	
?>