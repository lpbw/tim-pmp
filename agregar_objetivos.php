<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar PMP</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <form action="" method="post" id="guardar_objetivos">
            <div class="row">
                <div class="col-md-3">
                    <label for="id_usuario" class="form-label"># usuario</label>
                    <input class="form-control form-control-sm" type="text" name="id_usuario" id="id_usuario">
                </div>
                <div class="col-md-3">
                    <label for="id_usuario" class="form-label">Revision</label>
                    <input class="form-control form-control-sm" type="text" name="revision" id="revision" onchange="cargar_objetivos(this.value);">
                </div>
                <div class="col-md-3">
                    <label for="objetivos" class="form-label">Objetivos</label>
                    <select class="form-control form-control-sm" name="objetivos" id="objetivos" onchange="cargar_estrategias(this.value);">
                        <option value="">-- Seleccione Objetivo --</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="estrategias" class="form-label">Estrategias</label>
                    <select class="form-control form-control-sm" name="estrategias" id="estrategias">
                        <option value="">-- Seleccione Estrategia --</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea class="form-control form-control-sm" rows="5" cols="50" name="descripcion" id="descripcion"></textarea>
                </div>
                <div class="col-md-3">
                    <label for="fecha_inico" class="form-label">Fecha Inicio</label>
                    <input class="form-control form-control-sm" type="text" name="fecha_inicio" id="fecha_inicio">
                </div>
                <div class="col-md-3">
                    <label for="fecha_limite" class="form-label">Fecha Limite</label>
                    <input class="form-control form-control-sm" type="text" name="fecha_limite" id="fecha_limite">
                </div>
                <div class="col-md-3">
                    <br>
                    <input class='btn btn-primary' type='button' value='Guardar' id='btn_guardar'/>
                </div>
            </div>
            <div class="row" id="obj_accion">
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="js/agregar_objetivos.js"></script>
</body>
</html>