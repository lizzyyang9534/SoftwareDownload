<?php
header("Content-Type: text/html;charset=utf-8");
require_once('include/DB.php');

//session不存在時，啟用session
if(!isset($_SESSION)) session_start();

if(empty($_POST) and isset($_SESSION['verifySso']) and trim($_SESSION['verifySso']) == 'Y'){
	//先用學生身分登入，失敗再用其他身分去登入，省去選擇身分的麻煩
	/* 存取學生登入資訊 */
	$account_sso = $_SESSION['sso_personid'];
	$result = getInformationStudent($account_sso);
	$rowResult = $result -> fetch();

	if($rowResult[0] != ''){
		$_SESSION['login_id'] = $account_sso;
		$_SESSION['login_date'] = date( 'Y/m/d-H:i:s' );
		$_SESSION['user_name'] = $rowResult[0];
		$_SESSION['user_type'] = 'student';

		header( 'Location: index.php' );
	}
	else{
		/* 存取行政人員登入資訊 */
		$account_sso = $_SESSION['sso_personid'];
		$result = getInformationOther($account_sso);
		$rowResult = $result -> fetch();
		
		if($rowResult[0] != '')
		{
			$_SESSION['login_id'] = $account_sso;
			$_SESSION['login_date'] = date( 'Y/m/d-H:i:s' );
			$_SESSION['user_name'] = $rowResult[0];
			$_SESSION['user_sex'] = $rowResult[1];
			$_SESSION['user_type'] = 'other';

			header( 'Location:index.php' );
		}
		else
		{
			//如果學生跟其他兩種身分都找不到，登入失敗的話，把verifySso清掉，導到index.php，之後又會進入login.php，此時會進入到底下的else的第一個if判斷
			$_SESSION['verifySso'] = '';
			header( 'Location: login.php' );
		}
	}
}
else{
	if(!isset($_SESSION['login_id'])){
		//sso代簽入失敗時會進入這裡，然後再這邊清掉$_SESSION['verifySso']確保重新整理之後不再判斷為是從sso端過來的
		if(isset($_SESSION['verifySso']) and trim($_SESSION['verifySso']) == 'N')
		{
			$_SESSION['verifySso'] = '';
			echo"error";//身分錯誤
		}
		
		$account = $_POST["account"];
		$password = $_POST["password"];
		$identity = $_POST["identity"];

		if($identity == "student"){
			$isGra = false;
			if(substr($account,0,1) == "5"){
				$isGra = true;
				$result = getPasswordStudentGra($account);
				$rowResult = $result -> fetch();
			}
			else{
				$result = getPasswordStudent($account);
				$rowResult = $result -> fetch();
			}
			
			/* 學生密碼小於4碼就擋掉 */
			if( strlen( $rowResult['pwd'] )< 4 ) {
				echo "error";
			}
			
			if($password == $rowResult["pwd"]){
				if($isGra){
					$result = getInformationStudentGra($account);
					$rowResult = $result -> fetch();
				}
				else{
					$result = getInformationStudent($account);
					$rowResult = $result -> fetch();
				}
				$_SESSION['login_id'] = $account;
				$_SESSION['login_date'] = date( 'Y/m/d-H:i:s' );
				$_SESSION['user_name'] = $rowResult['name'];
				$_SESSION['user_type'] = 'student';
				
				echo "success".$_SESSION['user_name'];
			}
			else{
				echo "error";
			}	
		}
		else if($identity == "other"){
			if( ereg( '[A-Z]{1}[0-9]{9}', $account ) || ereg( '[A-Z]{2}[0-9]{8}', $account ) ) {
				$result = getPasswordOther($account);
				$rowResult = $result -> fetch();
								
				$result = getPasswordOtherEncode($password);
				$decodePwd = $result -> fetch();

				/* 行政人員登入成功 */
				if( $rowResult && $decodePwd['encode'] == $rowResult[0] ) {
					/* 存取行政人員登入資訊 */
					$result = getInformationOther($account);
					$rowResult = $result -> fetch();

					$_SESSION['login_id'] = $account;
					$_SESSION['login_date'] = date( 'Y/m/d-H:i:s' );
					$_SESSION['user_name'] = $rowResult[0];
					$_SESSION['user_sex'] = $rowResult[1];
					$_SESSION['user_type'] = 'other';
					
					//header( 'Location:main.php' );
					echo "success".$_SESSION['user_name'];
				} 
				else {
					echo 'error';
				}
			} 
			else {
				echo 'error';
			}
		}
	}
}
?>