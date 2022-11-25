<?
session_start();
include "checar_sesion_admin.php";
include "coneccion_i.php";

$id = $_GET["id"];
$id_sup = $_POST["id_sup"];

$consulta  = "SELECT revision, etapa from etapa where id=1";
	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1:$consulta ". mysqli_error($enlace) );//. mysqli_error($enlace)	
	if(@mysqli_num_rows($resultado)>=1)
	{
		$res=mysqli_fetch_row($resultado);
		$revision=$res[0];
		$etapa=$res[1];
	}


if ($_POST["agregar"] == "Agregar") {
    $eva = $_POST["eva"];
    $id = $_POST["id"];
	$revision = $_POST["revision"];
    if (sizeof($eva) > 0)
        foreach ($eva as $na) {
			
				$consulta = "insert into grupo_empleado(id_grupo, id_empleado, revision) values($id, $na, $revision)";
				$resultado = mysqli_query($enlace,$consulta) or die("Error en operacion registro:02 " . mysqli_error($enlace));

         } 

}
if ($_POST["borrar"] == "Borrar") {
    $grupo = $_POST["grupo"];
    $id = $_POST["id"];
    if (sizeof($grupo) > 0)
        foreach ($grupo as $na) {
			
				$consulta = "delete from grupo_empleado where id_grupo=$id and id_empleado=$na and revision=$revision";
				$resultado = mysqli_query($enlace,$consulta) or die("Error en operacion registro:02 " . mysqli_error($enlace));

         } 

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
       <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Bell</title>
        <link rel="stylesheet" href="colorbox.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
        <script src="colorbox/jquery.colorbox-min.js"></script>
        <link type="text/css" href="css/smoothness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />	
        <script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>
        <SCRIPT>
            $(function() {
                $( "#hasta" ).datepicker({ dateFormat: 'yy-mm-dd' });
                $( "#desde" ).datepicker({ dateFormat: 'yy-mm-dd' });
            });
        </SCRIPT>
        <style type="text/css">
            body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-image: url();
	background-color: #E5E5E5;
}
        </style>
        <link href="images/textos.css" rel="stylesheet" type="text/css" />
        <script>
            $(document).ready(function(){
                $(".iframe2").colorbox({iframe:true,width:"450", height:"320",transition:"fade", scrolling:false, opacity:0.1});
                $("#click").click(function(){ 
                    $('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
                    return false;
                });
            });
        </script>
        <script type="text/javascript">
            <!--
            function MM_swapImgRestore() { //v3.0
                var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
            }
            function MM_preloadImages() { //v3.0
                var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
                    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
                    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
            }

            function MM_findObj(n, d) { //v4.01
                var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
                    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
                if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
                for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
                if(!x && d.getElementById) x=d.getElementById(n); return x;
            }

            function MM_swapImage() { //v3.0
                var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
                if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
			}
			
            function verev(dato, esContrato, nivel)
            {
                document.form1.verev.value=dato;
				if(esContrato){
    	            document.form1.action="evaluacionContrato.php";
					document.form1.target="blank";
                	document.form1.submit();
				}else{
				
					if(nivel == "1B"){
		   			document.form1.action='evaluacion1B.php';
					document.form1.target="blank";
                	document.form1.submit();
					}else{
					
	                document.form1.action="evaluacion.php";
               		document.form1.target="blank";
                	document.form1.submit();
            }}
			}
			
            function busca(){
                document.form1.submit();
            }
            //-->
        </script>
        <style type="text/css">
            <!--
            .style1 {font-size: 24px}
            .style10 {font-family: Geneva, Arial, Helvetica, sans-serif; font-size: 16px; color: #104352; }
            .style17 {font-family: Arial, Helvetica, sans-serif; color: #999999; font-size: 12px; font-weight: bold; }
            -->
        </style>
    </head>

    <body onload="MM_preloadImages('images/b_cambio_r.png','images/b_administracion_r.png','images/b_log_out_r.png')">
        <form id="form1" name="form1" method="post" action="">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                <?
        include_once("header.php");
      ?>
                </tr>
                <tr>
                    <td height="698" valign="top" background=""><table width="1041" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                                <td><img src="images/spacer.gif" width="10" height="20" /></td>
                            </tr>
                            <tr>
                                <td><div align="center">
                                        <table width="850" border="0" cellspacing="7" cellpadding="0">

                                            <tr>
                                                <td><div align="center" class="text_mediano">(Grupo de Calibración)</div></td>
                                            </tr>
                                        </table>
                                    </div></td>
                            </tr>
                            <tr>
                                <td><div align="right"><img src="images/spacer.gif" width="10" height="20" /><a href="grupos_calibracion.php" class="text_mediano">Grupos</a></div></td>
                            </tr>
                            <tr>
                                <td><img src="images/spacer.gif" width="10" height="10" /></td>
                            </tr>
                            <tr>
                                <td><table width="1041" border="0" align="center" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td height="250" valign="top" bgcolor="#eeeeee"><table width="1033" border="0" align="center" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td><table width="414" border="0" cellspacing="3" cellpadding="0">
                                                                <tr>
                                                                    <td colspan="2" class="text_mediano">Selecciona el supervisor</td>
                                                                </tr>
                                                                <tr>
                                                                    <td width="349">
                                                                        <span class="style10">
                                                                            <select name="id_sup" class="texto_verde" id="id_sup" >
                                                                                <option value="0">--Selecciona--</option>
                                                                                <?
                                                                                $consulta = "SELECT id,nombre FROM usuarios where (tipo=2 or tipo=3)  and activo=1 ORDER BY nombre";
                                                                                $resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: " . mysqli_error($enlace));
                                                                                $count = 1;
                                                                                while (@mysqli_num_rows($resultado) >= $count) {
                                                                                    $res2 = mysqli_fetch_row($resultado);
                                                                                    if ($id_sup == $res2[0])
                                                                                        echo"<option value=\"$res2[0]\" selected>$res2[1]</option>";
                                                                                    else
                                                                                        echo"<option value=\"$res2[0]\" >$res2[1]</option>";
                                                                                    $count = $count + 1;
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                    </span></td>
                                                                  
                                                                    <td width="56">
                                                                        <input name="buscar" type="submit" id="buscar" value="Buscar"/>                                                                    </td>
                                                                </tr>
                                                            </table>                  </td>
                                                    </tr>
                                                    <tr>
                                                        <td><img src="images/franja.jpg" width="753" height="12" /></td>
                                                    </tr>
                                                    <tr>
                                                        <td><img src="images/spacer.gif" width="10" height="10" /></td>
                                                    </tr>
                                                    <tr>
                                                        <td valign="top"><table width="100%" border="0" cellspacing="2" cellpadding="0">
                                                          <tr>
                                                            <td width="48%" bgcolor="#00475c" class="text_mediano_blanco">Empleados a agregar </td>
                                                            <td width="52%" bgcolor="#00475c" class="text_mediano_blanco">Empleados en el grupo </td>
                                                          </tr>
                                                          <tr>
                                                            <td valign="top"><table width="444" border="0" cellspacing="2" cellpadding="0">
                                                              <tr>
                                                                <td width="26%"><input name="id" type="hidden" id="id" value="<? echo"$id";?>" />
                                                                <input name="revision" type="hidden" id="revision" value="<? echo"$revision";?>" /></td>
                                                                <td colspan="2"><div align="right">
                                                                  <input name="agregar" type="submit" id="agregar" value="Agregar"/>
                                                                </div></td>
                                                              </tr>
                                                              <tr>
                                                                <td bgcolor="#00475c" class="text_mediano_blanco">No.</td>
                                                                <td width="57%" bgcolor="#00475c" class="text_mediano_blanco">Nombre</td>
                                                                <td width="17%" bgcolor="#00475c" class="text_mediano_blanco">&nbsp;</td>
                                                              </tr>
             <?
                if (isset($_POST["buscar"])) {
                   
                            
                  $consulta = "SELECT usuarios.id, usuarios.nombre from usuarios where id_jefe=$id_sup and activo=1 and  id not in (select id_empleado from grupo_empleado where id_grupo=$id and revision=$revision)";
                  //echo"$consulta";
				  $resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: $consulta " . mysqli_error($enlace)); //. mysqli_error($enlace)	
                  $count = 0;
                  $color = "FFFFFF";      
                  while (@mysqli_num_rows($resultado) > $count) {
                     $res = mysqli_fetch_array($resultado);
                            ?>
							  <tr bgcolor="#<? echo"$color"; ?>">
								<td  class="texto_tareas"><div align="center"><? echo" $res[0]"; ?></div></td>
								<td  class="texto_tareas"><? echo"$res[1]"; ?> </a></td>
								<td  class="texto_chico"><div align="center">
                               <input name="eva[]" type="checkbox" id="eva[]" value="<? echo"$res[0]"; ?>" checked="checked" />
								</div></td>
                              </tr>
						  <?
									if ($color == "CCCCCC")
										$color = "FFFFFF";
									else
										$color = "CCCCCC";
									$count++;
								}
							}
							?>
                                                              <tr>
                                                                <td bgcolor="#FFFFFF" class="texto_tareas">&nbsp;</td>
                                                                <td bgcolor="#FFFFFF" class="texto_tareas">&nbsp;</td>
                                                                <td bgcolor="#FFFFFF" class="texto_chico">&nbsp;</td>
                                                              </tr>
                                                            </table></td>
                                                            <td valign="top"><table width="444" border="0" cellspacing="2" cellpadding="0">
                                                              <tr>
                                                                <td width="24%">&nbsp;</td>
                                                                <td colspan="2"><div align="right">
                                                                  <input name="borrar" type="submit" id="borrar" value="Borrar"/>
                                                                </div></td>
                                                              </tr>
                                                              <tr>
                                                                <td bgcolor="#00475c" class="text_mediano_blanco">No.</td>
                                                                <td width="59%" bgcolor="#00475c" class="text_mediano_blanco">Nombre</td>
                                                                <td width="17%" bgcolor="#00475c" class="text_mediano_blanco">&nbsp;</td>
                                                              </tr>
                                                               <?
               
                    $consulta = "SELECT usuarios.id, usuarios.nombre from usuarios inner join  grupo_empleado on usuarios.id=grupo_empleado.id_empleado where id_grupo=$id and revision=$revision";
                       // echo"$consulta";
						$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: $consulta " . mysqli_error($enlace)); //. mysqli_error($enlace)	
                        $count = 0;
                        $color = "FFFFFF";
                        while (@mysqli_num_rows($resultado) > $count) {
                            $res = mysqli_fetch_array($resultado);
                            ?>
							  <tr bgcolor="#<? echo"$color"; ?>">
								<td  class="texto_tareas"><div align="center"><? echo" $res[0]"; ?></div></td>
								<td  class="texto_tareas"><? echo"$res[1]"; ?> </a></td>
								<td  class="texto_chico"><div align="center">
                               <input type="checkbox" name="grupo[]" id="grupo[]" value="<? echo"$res[0]"; ?>" /></div></td>
                              </tr>
						  <?
									if ($color == "CCCCCC")
										$color = "FFFFFF";
									else
										$color = "CCCCCC";
									$count++;
								}
							
							?>
                                                              <tr>
                                                                <td bgcolor="#FFFFFF" class="texto_tareas">&nbsp;</td>
                                                                <td bgcolor="#FFFFFF" class="texto_tareas">&nbsp;</td>
                                                                <td bgcolor="#FFFFFF" class="texto_chico">&nbsp;</td>
                                                              </tr>
                                                            </table></td>
                                                          </tr>
                                                        </table>
                                                        <p>&nbsp;</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><div align="center"><img src="images/spacer.gif" width="10" height="20" />
                                                               
                                                                    <input name="enviar" type="submit" id="enviar" value="Cerrar grupo" />
                                                              
                                                            </div></td>
                                                    </tr>

                                                </table></td>
                                        </tr>
                                    </table></td>
                            </tr>
                            <tr>
                                <td><img src="images/spacer.gif" width="10" height="50" /></td>
                            </tr>
                            <tr>
                            <?
        include_once("footer.php");
      ?>
                            </tr>
                        </table></td>
                </tr>
            </table>

        </form>
    </body>
</html>