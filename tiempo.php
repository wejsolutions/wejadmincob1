 <?php
/*if(isset($_SESSION['tiempo'])) {
		$segundos = 10; //si pasa este tiempo se detecta la inactividad del usuario en el sitio
		if(($_SESSION['tiempo']+$segundos) < time()){
		   session_unset();
		   session_destroy();
		   echo'<script type="text/javascript">alert("Su sesion ha expirado por inactividad';
		   echo', vuelva a logearse para continuar");window.location.href="index.php";</script>';

		}else{
		?>
		<script type="text/javascript">
		   var valor=<?php echo $_SESSION['tiempo']; ?>;
		   var valor2=<?php echo time(); ?>;
		   alert(valor+' '+valor2);
		</script>

		<?php
		   $_SESSION['tiempo']=time();
		}
}*/
require 'cfg/base.php';
session_unset();
session_destroy();
echo'<script type="text/javascript">alert("Su sesion ha expirado por inactividad';
echo', vuelva a logearse para continuar");window.location.href="index.php";</script>';
//header('location: index.php');
?>
