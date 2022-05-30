<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><title>Form Login</title>
<style>
	#flogin {
		color:#ffffff;
		font-family: Tahoma;
		font-size: 11px;
	}
	.error {
		color:#ff0000;
		font-weight:bold;
	}
</style>
<script>
	function makemein() {
		var user = document.getElementById('userid').value;
		var pass = document.getElementById('passwd').value;
		if(user!='' && pass!='') {
		     return true;
		}
		else {
		     alert('Isi User ID dan Password terlebih dahulu');
		     return false;
		}
	}
</script>
</head>

<body>
<form name="flogin" id="flogin" method="post" 
onSubmit="return makemein()" action="actLogin.php">
<table width="100%" height="500">
<tr><td align="center" valign="middle">
<table border="0" align="center" cellpadding="0" cellspacing="0" 
width="400" bgcolor="#000000" height="150">
</tr>
  <tr>
    <td colspan="3" height="11" bgcolor="#000000"></td>
  </tr>
  <tr>
    <td width="12" background="images/tepi_kiri.jpg">&nbsp;</td>
    <td bgcolor="#3C3C3C">
   	  <table width="300" border="0" align="center" cellpadding="5" 
       cellspacing="0" height="130">
          <tr>
	      <td colspan="3" height="50" class="putih" align="center">
		<b>LOGIN AUTENTHICATION <br />
		Inventory Administration </b><br />
	      </td>
	     </tr>
          <tr>
            <td colspan="3" align="center" >			
		<div class="error"><$_GET['konfirmasi'];></div></td>
          </tr>
          <tr>
            <td class="putih">User ID</td>
            <td class="putih">:</td>
           <td><input type="text" name="userid" id="userid" /></td>
          </tr>
          <tr>
            <td class="putih">Password</td>
            <td class="putih">:</td>
       <td><input type="password" name="passwd" id="passwd" /></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><input type="submit" name="b_login" id="b_login" 
            value="Login" class="button" /></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
		</td>
    <td width="12">&nbsp;</td>
  </tr>
   <tr>
    <td colspan="3" height="11" bgcolor="#000000"></td>
  </tr>
</table>
</td></tr>
</table>
</form>
</body>
</html>
