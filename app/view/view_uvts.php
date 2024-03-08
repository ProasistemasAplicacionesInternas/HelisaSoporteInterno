<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/peticion.css" media="screen" type="text/css">
    <link rel="stylesheet" href="public/css/smoke.min.css">
</head>

<body>
    <div>
        <form id="formsUvts">
            <div class="row">
                <div class="">
                    <label for="yearUvt">Año Uvt</label>
                    <input type="number" id="yearUvt" name="yearUvt" class="form-control" required>
                </div>
                <div class="">
                    <label for="valueUvt">Valor Uvt</label>
                    <input type="number" id="valueUvt" name="valueUvt" class="form-control" required>
                </div>
                <div class="">
                    <input type="button" class="btn btn-success btn-sm" value="Guardar" name="saveYear" id="saveYear">
                </div>
            </div>
        </form>
    </div>
</body>
<script src="public/js/categoriesAssets.js"></script>
<script src="public/js/smoke.min.js"></script>
</html>