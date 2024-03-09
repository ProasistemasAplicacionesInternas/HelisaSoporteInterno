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
    <style>
        .section {
            padding: 14px;
        }

        .label {
            padding: 5px 5px;
        }

        .custom-font{
            font-size: 20px;
        }

        #editarModal {
  z-index: 1050; /* Puedes ajustar este valor según sea necesario */
}
    </style>
    <div class="section">
        <form id="formsUvts">
            <div class="row">
                <div class="label">
                    <label for="yearUvt"> <b>Año Uvt</b></label>
                    <input type="number" id="yearUvt" name="yearUvt" class="form-control" placeholder="Ingrese el año"
                        required>
                </div>
                <div class="label ">
                    <label for="valueUvt"><b>Valor Uvt</b></label>
                    <input type="number" id="valueUvt" name="valueUvt" class="form-control"
                        placeholder="Ingrese el Valor" required>
                </div>
                <div class="label">
                    <br>
                    <input type="button" class="form-control btn btn-success btn-sm" value="Guardar" name="saveYear"
                        id="saveYear">
                </div>
            </div>
        </form>

    </div>
    <div class="">
        <div id="tablaResultados">

        </div>
    </div>

    <div class="modal fade" id="editarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar UVT</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="modalId">
                    <div class="form-group">
                        <label for="modalYear">Año UVT:</label>
                        <input type="number" class="form-control" id="modalYear" disabled required>
                    </div>
                    <div class="form-group">
                        <label for="modalValue">Valor UVT:</label>
                        <input type="number" class="form-control" id="modalValue" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="actualizarUvt()">Actualizar</button>
                </div>
            </div>
        </div>
    </div>

</body>
<script src="public/js/categoriesAssets.js"></script>
<script src="public/js/smoke.min.js"></script>

</html>