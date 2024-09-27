<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <title>Empleados</title>
</head>

<body>
    <div class="bg-dark text-center">
        <h1 class="text-white m-0 fs-2 py-2">Listado de Empleados</h1>
    </div>

    <div class="container pt-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="bg-primary py-2 px-3 d-flex justify-content-between align-items-center" id="contentTitle">
                        <h4 class="card-title m-0 text-white" id="titleForm">Crear Empleado</h4>
                        <button type="button" class="btn-close d-none" id="btnCancel" aria-label="Close"></button>
                    </div>
                    <div class="card-body insert-alert">
                        <form id="frmEmployee">
                            <input type="hidden" id="idEmployee" name="idEmployee">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Nombre">
                            </div>
                            <div class="mb-3">
                                <label for="lastname" class="form-label">Apellido</label>
                                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Apellido">
                            </div>
                            <div class="mb-3">
                                <label for="position" class="form-label">Puesto</label>
                                <input type="text" class="form-control" id="position" name="position" placeholder="Puesto">
                            </div>
                            <div class="mb-3">
                                <label for="salary" class="form-label">Salario</label>
                                <input type="number" class="form-control" id="salary" name="salary" min="0" placeholder="Salario">
                            </div>
                            <button class="btn btn-primary w-100 text-uppercase fw-bold fs-5" id="btnAction" type="submit">Crear Empleado</button>
                        </form>
                    </div>
                </div>

            </div>
            <div class="col-md-8">
                <div class="card">
                    <h4 class="card-title bg-primary text-center text-white m-0 py-2"><i class="bi bi-people-fill"></i> Listado de Empleados</h4>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-bordered align-middle" id="tblEmployee">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Puesto</th>
                                        <th>Salario</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script src="/assets/js/app.js"></script>
</body>

</html>