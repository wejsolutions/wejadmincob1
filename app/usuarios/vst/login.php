<?php require '../../../cfg/base.php'; ?>
<?php $cusuarios->redirectindex() ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>WEJ SOLUTIONS - Login</title>

		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="shortcut icon" href="../../../img/logo.png" type="image/x-icon">
		<?php require '../../../css/ace.php'; ?>
		<?php require '../../../js/ace.php'; ?>
	</head>

	<body class="login-layout" style="background:#C6F372">

		<script type="text/javascript">
			function show_box(id) {
			 jQuery('.widget-box.visible').removeClass('visible');
			 jQuery('#'+id).addClass('visible');
			}
		</script>
		
		<div class="col-sm-12" style="background:#006400">
			<div class="clearfix"></div>
			<div class="space-4"></div>
			<img src="img/logo.png" align="" class="pull-left" height="125 px">	
			<h1 class="pull-left" style="padding-left:30px">
				<span class="white"><?php echo "SOFTWARE ADMINISTRATIVO" ?></span>
				<span class="white"><?php echo "" ?></span>
				<div class="space-12"></div>
				<span class="blue"><?php echo "" ?></span>
				<span class="white"><?php echo "Gestión de Facturación e Inventario" ?></span>
			</h1>
			<img src="img/logo.png" align="" class="pull-right" height="125 px">	
			<div class="clearfix"></div>
			<div class="space-4"></div>
		</div>

		<div class="clearfix"></div>
		<div class="space-20"></div>
		<div class="main-container">
			<div class="main-content">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<div class="login-container">

							<div class="space-6"></div>

							<div class="position-relative">
								<div id="login-box" class="login-box visible widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header blue lighter bigger">
												<!--<i class="icon-coffee green"></i>-->
												Indique datos de acceso
											</h4>
											<div class="msj"></div>
											<div class="space-6"></div>
											
											<form class="loginform">

												
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control" placeholder="Usuario" name="usuario" />
															<i class="icon-user"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" class="form-control" placeholder="Clave" name="clave" />
															<i class="icon-lock"></i>
														</span>
													</label>

													<div class="space"></div>

													<div class="clearfix">
														<label class="inline">
															<input type="checkbox" class="ace" />
															<span class="lbl"> Recordarme</span>
														</label>

														<button type="submit" class="width-35 pull-right btn btn-sm btn-success">
															<i class="icon-key"></i>
															Entrar
														</button>
													</div>

													<div class="space-4"></div>
												</fieldset>
											</form>

										</div><!-- /widget-main -->

										<div class="toolbar clearfix" style="background:#64930D">
											<div>
											</div>
										</div>
									</div><!-- /widget-body -->
								</div><!-- /login-box -->

								<div id="forgot-box" class="forgot-box widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header red lighter bigger">
												<i class="icon-key"></i>
												Recuperar Clave de Acceso
											</h4>

											<div class="space-6"></div>
											<p>
												Indique corre eléctrónico y siga las instrucciones
											</p>

											<form class="recovery">
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="email" class="form-control" placeholder="Email" />
															<i class="icon-envelope"></i>
														</span>
													</label>

													<div class="clearfix">
														<button type="button" class="width-35 pull-right btn btn-sm btn-danger">
															<i class="icon-lightbulb"></i>
															Recuperar
														</button>
													</div>
												</fieldset>
											</form>
										</div><!-- /widget-main -->

										<div class="toolbar center">
											<a href="#" onclick="show_box('login-box'); return false;" class="back-to-login-link">
												Volver a login
												<i class="icon-arrow-right"></i>
											</a>
										</div>
									</div><!-- /widget-body -->
								</div><!-- /forgot-box -->
							</div><!-- /position-relative -->
						</div>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div>
		</div><!-- /.main-container -->

		<script>
			$(function(){
				var formulario = '.loginform';
				$(formulario).validate({
					errorElement: 'div',
					errorClass: 'help-block',
					focusInvalid: true,
					rules: {
						usuario: {
							required: true,
						},
						clave: {
							required: true,
						},
					},

					messages: {
						usuario: {
							required: 'Obligatorio',
						},
						clave: {
							required: 'Obligatorio',
						},
					},

					invalidHandler: function (event, validator) { //display error alert on form submit   
						$('.alert-danger', $(formulario)).show();
					},

					highlight: function (e) {
						$(e).closest('.form-group').removeClass('has-info').addClass('has-error');
					},

					success: function (e) {
						$(e).closest('.form-group').removeClass('has-error').addClass('has-info');
						$(e).remove();
					},

					submitHandler: function (form) {
						$.post('prc-cusuarios-clogin',$(formulario).serialize(),function(data){
							if(data==1) { 
								location.reload() 
							} else {
								alerta('.msj','danger',data);
							}
						})
					},
					invalidHandler: function (form) {
					}
				});
			})
		</script>
	</body>
</html>