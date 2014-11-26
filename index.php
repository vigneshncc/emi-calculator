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
			print "<tr style='font:14px arial;background-color:#C0C0C0;color:#FFF'><td>".$arrSno[$i]."</td><td>".number_format($arrLoanOutStanding[$i], 2, '.', '')."</td><td>".number_format($arrInterest[$i], 2, '.', '')."</td><td>".number_format($arrPrincipal[$i], 2, '.', '')."</td></tr>";
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

	$json1 = json_decode($json,true);

	echo "Your IP  :".getenv('REMOTE_ADDR')."<br/>";
	echo "Your City:".$json1['cityName']."<br/>";
	echo "Time     :".$json1['localTime']."<br/>";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title> EMI Calculator </title>
		<script type="text/javascript" src="jquery.js"></script>
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

		</script>
		<script type="text/javascript">
			function Validate()
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
							var EmiCal = '<table border="1" cellpadding="5" cellpadding="4" style="border-collapse:collapse;"><th style="font:14px arial;background-color:#69AA00;color:#FFF">Sno</th><th style="font:14px arial;background-color:#69AA00;color:#FFF">Loan Outstanding</th><th style="font:14px arial;background-color:#69AA00;color:#FFF">Interest</th><th style="font:14px arial;background-color:#69AA00;color:#FFF">Capital</th>'+responseText+'</table>'
							$('#EmiCalci').html(EmiCal);
						},
						"html"
					);
			}
				
		</script>
	
	</head>
	<body bgcolor="#E1E1E1">
	<center>
		<table>
			<tr><b><h1> EMI CALCULATOR </h1></b></tr>
			
			<tr>
			<td>Loan Amount</td>
			<td>:</td>
			<td> <input type="text" name="txtLoanAmount" id="txtLoanAmount"></td>
			</tr>
			
			<tr>
			<td>Rate of Interest (%)</td>
			<td>:</td>
			<td> <input type="text" name="txtRateOfInterest" id="txtRateOfInterest"></td>
			</tr>
			
			<tr>
			<td>Term of Loan (Years)</td>
			<td>:</td>
			<td> <input type="text" name="txtTerm" id="txtTerm"></td>
			</tr>
			
			<tr>
			<td align="right"><img src="emi.png" name="btnCalculateEmi" id="btnCalculateEmi" value="Calculate EMI" onclick="Validate()" style="cursor:pointer;"></td>
			
			<td>:</td>
			<td><input type="text" name="txtShowEmi" id="txtShowEmi" disabled="true"></td>
			</tr>
		</table>
		
			<div id="EmiCalci">

			</div>
	</center>	
	</body> 
</html>