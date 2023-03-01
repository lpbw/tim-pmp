<?php
    include_once("../coneccion_i.php");
    $funcion = $_GET['funcion'];

    switch ($funcion) {
        case 'buscar_objetivos':
            $revision = $_POST['revision'];
            $opciones = "<option value=''>-- Seleccione objetivo --</option>";
            $consulta = "SELECT * FROM io_principies WHERE revision=$revision";
            $resultado = mysqli_query($enlace,$consulta) or die("Consulta: $consulta". mysqli_error($enlace));
            while ($res = mysqli_fetch_assoc($resultado)) {
                $opciones .= "<option value='".$res['id']."'>".$res['nombre']."</option>";
            }
            echo $opciones;
        break;
        case 'buscar_estrategias':
            $id_objetivo = $_POST['id_objetivo'];
            $opciones = "<option value=''>-- Seleccione Estrategia --</option>";
            $consulta = "SELECT * FROM lags WHERE id_io=$id_objetivo";
            $resultado = mysqli_query($enlace,$consulta) or die("Consulta: $consulta". mysqli_error($enlace));
            while ($res = mysqli_fetch_assoc($resultado)) {
                $opciones .= "<option value='".$res['id']."'>".$res['nombre']."</option>";
            }
            echo $opciones;
        break;
        case 'buscar_objetivos_acciones':
            $id_empleado = $_POST['empleado'];
            $revision = $_POST['revision'];
            $objetivo = "";
            $html = "";
            $consulta_objetivos = "SELECT objetivos_new.id as id_obj, io_principies.nombre as n_obj, lags.nombre as n_lag, DATE_FORMAT(inicio,'%d-%m-%Y') as inicio, DATE_FORMAT(limite,'%d-%m-%Y') as limite, descripcion, evaluacion, comentario_e, comentario_j, evaluacion_j, io_principies.meta from objetivos_new inner join io_principies on objetivos_new.id_objetivo=io_principies.id inner join lags on objetivos_new.id_estrategia=lags.id where objetivos_new.revision=$revision and objetivos_new.id_empleado=$id_empleado order by objetivos_new.id";
            $resultado_objetivos = mysqli_query($enlace,$consulta_objetivos) or die("Consulta: $consulta_objetivos". mysqli_error($enlace));
            while ($res_objetivos = mysqli_fetch_assoc($resultado_objetivos)) {
                
                $objetivo = "<label><b>ID: </b>".$res_objetivos['id_obj']."<b> Objetivo LAG: </b>".$res_objetivos['n_obj']."<b> Estrategia: </b>".$res_objetivos['n_lag']."</label>";
                $html .= $objetivo;
                $id_obj = $res_objetivos['id_obj'];
                $acciones = "<table class='table'><thead><tr><th>Inicio</th><th>Limite</th><th>Estatus</th><th>Acción</th><th>Comentario</th></tr></thead><tbody>";

                $consulta_acciones = "SELECT * FROM acciones_new WHERE revision=$revision AND id_empleado=$id_empleado AND id_objetivo=$id_obj";
                $resultado_acciones = mysqli_query($enlace,$consulta_acciones) or die("Consulta: $consulta_acciones". mysqli_error($enlace));
                while ($res_acciones = mysqli_fetch_assoc($resultado_acciones)) {
                    $id_accion = $res_acciones['id'];
                    $acciones .= "<tr><td><input class='form-control form-control-sm' type='hidden' name='accion[]' value='$id_accion'><input class='form-control form-control-sm' type='text' name='accion_inicio_$id_accion' id='accion_inicio_$id_accion' value='".$res_acciones['inicio']."'></td><td><input class='form-control form-control-sm' type='text' name='accion_limite_$id_accion' id='accion_limite_$id_accion' value='".$res_acciones['limite']."'></td><td><input class='form-control form-control-sm' type='text' name='estatus_$id_accion' id='estatus_$id_accion' value='".$res_acciones['estatus']."'></td><td><textarea class='form-control form-control-sm' name='accion_$id_accion' id='accion_$id_accion'>".$res_acciones['accion']."</textarea></td><td><textarea class='form-control form-control-sm' name='comentario_$id_accion' id='comentario_$id_accion'>".$res_acciones['comentario']."</textarea></td></tr>";
                }
                $acciones .= "</tbody></table>";
                $html .= $acciones;
            }
            $html .= "<input class='btn btn-primary' type='button' value='Guardar Acciones' onclick='guardar_acciones();'/>";
           echo $html;
        break;
        case 'guardar_objetivo':
            $id_empleado = $_POST['id_usuario'];
            $revision = $_POST['revision'];
            $id_objetivo = $_POST['objetivos'];
            $id_estrategia = $_POST['estrategias'];
            $descripcion = $_POST['descripcion'];
            $fecha_inicio = $_POST['fecha_inicio'];
            $fecha_limite = $_POST['fecha_limite'];
            $nuevo_id_objetivo = 0;

            $consulta_plan = "SELECT * FROM planes WHERE revision=$revision AND id_empleado=$id_empleado";
            $resultado_plan = mysqli_query($enlace,$consulta_plan) or die("La consulta:$consulta_plan ". mysqli_error($enlace));
            // var_dump(@mysqli_num_rows($resultado_plan));die();
            if (@mysqli_num_rows($resultado_plan) == 0) {
                $consulta  = "insert into planes(id_empleado, revision, estatus) value($id_empleado, $revision, 0)";
                $resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1:$consulta ". mysqli_error($enlace) );
            }

            $agregar_objetivo  = "INSERT INTO objetivos_new(id_empleado, numero, id_objetivo,id_estrategia, descripcion,inicio, limite, revision) VALUES($id_empleado, 1, '$id_objetivo', '$id_estrategia', '$descripcion', '$fecha_inicio', '$fecha_limite', '$revision')";
		    $resultado_agregar = mysqli_query($enlace,$agregar_objetivo) or die("consulta: $agregar_objetivo". mysqli_error($enlace) );
		    $nuevo_id_objetivo = mysqli_insert_id($enlace);

            // acciones
            for($i=0 ; $i<10 ; $i++){
                $agregar_accion  = "INSERT INTO acciones_new(id_empleado,  id_objetivo, accion,inicio, limite, revision, estatus, comentario) VALUES($id_empleado,  '$nuevo_id_objetivo', '',  '0000-00-00', '0000-00-00', $revision, 0, '')";
                $resultado_accion = mysqli_query($enlace,$agregar_accion) or die("consulta: $agregar_accion". mysqli_error($enlace) );
            }
            echo $nuevo_id_objetivo;
        break;
        case 'guardar_acciones':
            $accion = $_POST['accion'];
            foreach ($accion as $id_accion) {
                $accion_inicio = $_POST['accion_inicio_'.$id_accion];
                $accion_limite = $_POST['accion_limite_'.$id_accion];
                $estatus = $_POST['estatus_'.$id_accion];
                $accion = $_POST['accion_'.$id_accion];
                $comentario = $_POST['comentario_'.$id_accion];
                $actualiza_acciones = "UPDATE acciones_new SET inicio='$accion_inicio',limite='$accion_limite',estatus='$estatus',accion='$accion',comentario='$comentario' WHERE id=$id_accion";
                $resultado_actualiza_acciones = mysqli_query($enlace,$actualiza_acciones) or die("Consulta: $actualiza_acciones". mysqli_error($enlace));
            }
            echo 1;
        break;
        default:
            echo "";
        break;
    }
?>