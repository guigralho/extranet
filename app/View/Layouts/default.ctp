<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'Extranet');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
	<head>
		<?php echo $this->Html->charset(); ?>
		<title>
			<?php echo $cakeDescription ?>:
			<?php echo $this->fetch('title'); ?>
		</title>
		<!-- Tell the browser to be responsive to screen width -->
	  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	  <!-- Bootstrap 3.3.5 -->
	  <?php echo $this->Html->css('bootstrap.min'); ?>
	  <!-- Font Awesome -->
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	  <!-- Ionicons -->
	  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	  <!-- Theme style -->
	  <?php echo $this->Html->css('AdminLTE.min')."\n\t"; ?>
	  <!-- AdminLTE Skins. Choose a skin from the css/skins
	       folder instead of downloading all of them to reduce the load. -->
	  <?php echo $this->Html->css('skin-blue')."\n\t"; ?>
	  <!--<link rel="stylesheet" href="dist/css/skins/_all-skins.min.css"> -->
	  <!-- iCheck -->
	  <?php echo $this->Html->css('blue')."\n\t"; ?>
	  <!-- Morris chart -->
	  <?php echo $this->Html->css('morris')."\n\t"; ?>
	  <!-- jvectormap -->
	  <?php echo $this->Html->css('jquery-jvectormap-1.2.2')."\n\t"; ?>
	  <!-- Date Picker -->
	  <?php echo $this->Html->css('datepicker3')."\n\t"; ?>
	  <!-- Daterange picker -->
	  <?php echo $this->Html->css('daterangepicker-bs3')."\n\t"; ?>
	  <?php echo $this->Html->css('bootstrap3-wysihtml5.min')."\n\t"; ?>

	  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	  <!--[if lt IE 9]>
	      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	  <![endif]-->
		<?php
			echo $this->Html->meta('icon');

			echo $this->fetch('meta');
			echo $this->fetch('css');
			echo $this->fetch('script');
		?>
	</head>
	<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
			<?php echo $this->element("header"); ?>

			<?php echo $this->element("sidebar"); ?>

			<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
      	<?php echo $this->fetch('content'); ?>
      </div>

      <?php echo $this->element("footer"); ?>

      <?php echo $this->element("right_sidebar"); ?>
		</div>

		<!-- jQuery 2.1.4 -->
		<?php echo $this->Html->script('jQuery-2.1.4.min')."\n\t"; ?>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.5 -->
    <?php echo $this->Html->script('bootstrap.min')."\n\t"; ?>
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <?php echo $this->Html->script('morris.min')."\n\t"; ?>
    <!-- Sparkline -->
    <?php echo $this->Html->script('jquery.sparkline.min')."\n\t"; ?>
    <!-- jvectormap -->
    <?php echo $this->Html->script('jquery-jvectormap-1.2.2.min')."\n\t"; ?>
    <?php echo $this->Html->script('jquery-jvectormap-world-mill-en')."\n\t"; ?>
    <!-- jQuery Knob Chart -->
    <?php echo $this->Html->script('jquery.knob')."\n\t"; ?>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <?php echo $this->Html->script('daterangepicker')."\n\t"; ?>
    <!-- datepicker -->
    <?php echo $this->Html->script('bootstrap-datepicker')."\n\t"; ?>
    <?php echo $this->Html->script('bootstrap-datepicker.pt')."\n\t"; ?>
    <!-- Bootstrap WYSIHTML5 -->
    <?php echo $this->Html->script('bootstrap3-wysihtml5.all.min')."\n\t"; ?>
    <!-- Slimscroll -->
    <?php echo $this->Html->script('jquery.slimscroll.min')."\n\t"; ?>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <?php echo $this->Html->script('app.min')."\n\t"; ?>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <?php echo $this->Html->script('dashboard')."\n\t"; ?>
    <!-- AdminLTE for demo purposes -->
    <?php //echo $this->Html->script('demo')."\n\t"; ?>
	</body>
</html>