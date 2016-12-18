<?php require_once "form-data.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Andres Duarte M.">

  <title>Evaluación de empleos</title>

  <link href="/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="/bower_components/sweetalert/dist/sweetalert.css" rel="stylesheet">
  <link href="/css/app.css?v=<?php echo time(); ?>" rel="stylesheet">


  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body>

  <div class="container">
    <h3>Evaluación de Empleos</h3>
    <p>Herramienta de ayuda para evaluar si conviene cambiarse a otro empleo.</p>
    <hr>
    <form>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th></th>
            <th><input type="text" value="" class="form-control" placeholder="EMPRESA 1"></th>
            <th class="text-center">%</th>
            <th><input type="text" value="" class="form-control" placeholder="EMPRESA 2"></th>
            <th class="text-center">%</th>
            <th class="text-center" style="width: 5%;">FACTOR</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($items as $key => $item): ?>
          <tr>
            <td><span data-tooltip title="<?= $item['description'] ?>"><?= $item['nombre'] ?></span></td>
            <td>
              <input type="text" name="nota-empresa1[]" id="nota<?= $key ?>-empresa1" value="" class="form-control nota-empresa1 solo-decimales-y-enteros" data-correlativo="<?= $key ?>" placeholder="Nota <?= $item['nombre'] ?>">
            </td>
            <td class="text-center padding-top ponderacion<?= $key ?>-empresa1"></td>
            <td>
              <input type="text" name="nota-empresa2[]" id="nota<?= $key ?>-empresa2" value="" class="form-control nota-empresa2 solo-decimales-y-enteros" data-correlativo="<?= $key ?>" placeholder="Nota <?= $item['nombre'] ?>">
            </td>
            <td class="text-center padding-top ponderacion<?= $key ?>-empresa2"></td>
            <td >
              <input type="text" name="factor[]" id="factor<?= $key ?>" value="" class="form-control factor solo-numeros pull-right" data-correlativo="<?= $key ?>">
            </td>
            <input type="hidden" name="ponderacion-empresa1[]" value="" id="ponderacion<?= $key ?>-empresa1">
            <input type="hidden" name="ponderacion-empresa2[]" value="" id="ponderacion<?= $key ?>-empresa2">
          </tr>
          <?php endforeach; ?>
          <tr>
            <td><strong>Total</strong></td>
            <td></td>
            <td class="text-center text-bold" id="resultE1"></td>
            <td></td>
            <td class="text-center text-bold" id="resultE2"></td>
            <td class="text-center text-bold" id="sumaFactores"></td>
          </tr>
        </tbody>
      </table>
    </form>
    <button type="button" class="btn btn-primary pull-right" id="btnGetResult">Calcular Total</button>

    <p>Ingrese una nota para cada empresa (del 1 al 7 o del 1 al 10) e ingrese el factor de cada item.</p>

  </div>

  <script src="/bower_components/jquery/dist/jquery.min.js" type="text/javascript"></script>
  <script src="/bower_components/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
  <script src="/bower_components/sweetalert/dist/sweetalert.min.js" type="text/javascript"></script>
  <script src="/js/index.js?v=<?php echo time(); ?>" type="text/javascript"></script>
</body>
</html>