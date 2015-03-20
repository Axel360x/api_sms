<?php
include ("config.php");
class SQL{
	
	private $dbHandle = null;
	
	function __construct()
	{
		$dbHandle = mysql_connect($db_host, $db_user, $db_password);
	}
	
	function SetDatabase($database){
		mysql_select_db($database, $dbHandle);
		return true;
	}
	
	function Query($sql){
		return mysql_query($sql, $dbHandle);
	}
	//Depracted?
	function GetNumberOfRows($result){
		return mysql_num_rows($result);
	}
	
	function GetTable($result){
		return mysql_fetch_array($result);
	}
	
	function Wallet1Update($id_user,$cost){
		$wallet1 = $this->Query("SELECT `wallet1` FROM `konta` WHERE `id_user`=$id_user");
		$wallet1 += $cost;
		$this->Query("UPDATE 'konta' SET `wallet1`=$wallet1 WHERE `id_user`=$id_user");
	}
	
	function SmsHistory($id_user,$code,$cost,$buyer) {
		$this->Query("INSERT INTO 'sms_historia' ('id_user', 'code', 'buyer', 'cost') VALUES ($id_user, '$code', '$buyer', $cost)");
	}
	

	function __destruct() {
		mysql_close();
	}
}

?>