<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Flat UI Kit - HTML/PSD Design Framework</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Loading Bootstrap -->
    <link href="<?php echo asset('bootstrap/css/bootstrap.css') ?>" rel="stylesheet">

    <!-- Loading Flat UI -->
    <link href="<?php echo asset('css/flat-ui.css') ?>" rel="stylesheet">

    <link rel="shortcut icon" href="<?php asset('images/favicon.ico') ?>">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>
    <script src="<?php echo asset('js/html5shiv.js') ?>"></script>
    <![endif]-->
</head>
<body>
<div class="container">
    <h1>Cálculo de Bioritmos</h1>

<?php echo $contenidoPlantilla ?>
</div> <!-- /container -->


<!-- Load JS here for greater good =============================-->
<script src="<?php echo asset('js/jquery-1.8.3.min.js') ?>"></script>
<script src="<?php echo asset('js/jquery-ui-1.10.3.custom.min.js') ?>"></script>
<script src="<?php echo asset('js/jquery.ui.touch-punch.min.js') ?>"></script>
<script src="<?php echo asset('js/bootstrap.min.js') ?>"></script>
<script src="js/bootstrap-select.js"></script>
<script src="js/bootstrap-switch.js"></script>
<script src="js/flatui-checkbox.js"></script>
<script src="js/flatui-radio.js"></script>
<script src="js/jquery.tagsinput.js"></script>
<script src="js/jquery.placeholder.js"></script>
<script src="js/jquery.stacktable.js"></script>
<script src="http://vjs.zencdn.net/c/video.js"></script>
<script src="js/application.js"></script>
</body>
</html>
