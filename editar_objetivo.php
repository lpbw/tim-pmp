<?
session_start();

include "checar_sesion_admin.php";
include "coneccion_i.php";
$idU=$_SESSION['idU'];
$id=$_GET["id"];


if($_POST["guarda"]=="1"){
		//$consulta  = "update planes set where id_empleado=$verobjetivos an revision=$revision)";
		//$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1:$consulta ". mysqli_error($enlace) );
		$objetivo=$_POST["objetivo"];
		$descripcion=$_POST["descripcion"];
		$estrategia=$_POST["estrategia"];
		$inicio=$_POST["inicio"];
		$limite=$_POST["limite"];
		if($inicio=="")
			$inicio="0000-00-00";
		if($limite=="")
			$limite="0000-00-00";
		$fechat = explode('-', $inicio);
		$finicio="$fechat[2]-$fechat[1]-$fechat[0]";
		$fechat = explode('-', $limite);
		$ffin="$fechat[2]-$fechat[1]-$fechat[0]";
		$consulta  = "update objetivos_new set  id_objetivo='$objetivo',id_estrategia='$estrategia', descripcion='$descripcion',inicio='$finicio', limite='$ffin' where id=$id ";
		$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: $consulta". mysqli_error($enlace) );
		$id_objetivo=mysqli_insert_id($enlace);
		$num=1;
		for($i=0 ; $i<10 ; $i++)
		{
			$id_accion=$_POST["id_accion".$num];
			$accion=$_POST["accion".$num];
			$inicio=$_POST["inicio".$num];
			$estatus=$_POST["estatus".$num];
			$comentario=$_POST["comentario".$num];
			$fin=$_POST["fin".$num];
			if($inicio=="")
				$inicio="0000-00-00";
			if($fin=="")
				$fin="0000-00-00";
			$fechat = explode('-', $inicio);
			$finicio="$fechat[2]-$fechat[1]-$fechat[0]";
			$fechat = explode('-', $fin);
			$ffin="$fechat[2]-$fechat[1]-$fechat[0]";
			
			
      if ($accion != "") {
        $consulta  = "update acciones_new set  accion='$accion',inicio='$finicio', limite='$ffin' where id=$id_accion"; //, estatus=$estatus, comentario=$comentario
			  $resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: $consulta". mysqli_error($enlace) );
      }
			$num++;
		}
		echo"<script>window.parent.location=\"objetivos_new.php\";</script>";

}
$query2 = "SELECT objetivos_new.id as id_obj, io_principies.id as n_obj, lags.id as n_lag, DATE_FORMAT(inicio,'%d-%m-%Y') as inicio, DATE_FORMAT(limite,'%d-%m-%Y') as limite, descripcion, evaluacion, comentario_e, comentario_j , objetivos_new.revision from objetivos_new inner join io_principies on objetivos_new.id_objetivo=io_principies.id inner join lags on objetivos_new.id_estrategia=lags.id where  objetivos_new.id=$id order by objetivos_new.id";						
$result2 = mysqli_query($enlace,$query2) or print("<option value=\"ERROR\">".mysqli_error($enlace)."</option>");
if($lista = mysqli_fetch_assoc($result2)){
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bell</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-image: url();
	background-color: #E5E5E5;
}
-->
</style>
<link href="images/textos.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="css/smoothness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />	
<link rel="stylesheet" href="colorbox.css" />
<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>


<SCRIPT>
$(document).ready(function(){

    $("#objetivo").change(function(){
        var deptid = $(this).val();

        $.ajax({
            url: 'busca_estrategia.php',
            type: 'post',
            data: {id_objetivo:deptid},
            dataType: 'json',
            success:function(response){

                var len = response.length;

                $("#estrategia").empty();
                for( var i = 0; i<len; i++){
                    var id = response[i]['id'];
                    var name = response[i]['name'];
                    
                    $("#estrategia").append("<option value='"+id+"'>"+name+"</option>");

                }
            }
        });
    });

});	
function buscar(valor, actual){

   
        var deptid = valor;

        $.ajax({
            url: 'busca_estrategia.php',
            type: 'post',
            data: {id_objetivo:deptid},
            dataType: 'json',
            success:function(response){

                var len = response.length;

                $("#estrategia").empty();
                for( var i = 0; i<len; i++){
                    var id = response[i]['id'];
                    var name = response[i]['name'];
                    
                    if(actual==id)
						$("#estrategia").append("<option value='"+id+"' selected>"+name+"</option>");
					else
						$("#estrategia").append("<option value='"+id+"'>"+name+"</option>");

                }
            }
        });
    

};	
	
	$(function() {
		
		$( "#inicio" ).datepicker({ dateFormat: 'dd-mm-yy' });
		$( "#limite" ).datepicker({ dateFormat: 'dd-mm-yy' });
		$( "#inicio1" ).datepicker({ dateFormat: 'dd-mm-yy' });
		$( "#fin1" ).datepicker({ dateFormat: 'dd-mm-yy' });
		$( "#inicio2" ).datepicker({ dateFormat: 'dd-mm-yy' });
		$( "#fin2" ).datepicker({ dateFormat: 'dd-mm-yy' });
		$( "#inicio3" ).datepicker({ dateFormat: 'dd-mm-yy' });
		$( "#fin3" ).datepicker({ dateFormat: 'dd-mm-yy' });
		$( "#inicio4" ).datepicker({ dateFormat: 'dd-mm-yy' });
		$( "#fin4" ).datepicker({ dateFormat: 'dd-mm-yy' });
		$( "#inicio5" ).datepicker({ dateFormat: 'dd-mm-yy' });
		$( "#fin5" ).datepicker({ dateFormat: 'dd-mm-yy' });
		$( "#inicio6" ).datepicker({ dateFormat: 'dd-mm-yy' });
		$( "#fin6" ).datepicker({ dateFormat: 'dd-mm-yy' });
		$( "#inicio7" ).datepicker({ dateFormat: 'dd-mm-yy' });
		$( "#fin67" ).datepicker({ dateFormat: 'dd-mm-yy' });
		$( "#inicio8" ).datepicker({ dateFormat: 'dd-mm-yy' });
		$( "#fin8" ).datepicker({ dateFormat: 'dd-mm-yy' });
		$( "#inicio9" ).datepicker({ dateFormat: 'dd-mm-yy' });
		$( "#fin9" ).datepicker({ dateFormat: 'dd-mm-yy' });
		$( "#inicio10" ).datepicker({ dateFormat: 'dd-mm-yy' });
		$( "#fin10" ).datepicker({ dateFormat: 'dd-mm-yy' });
	});
	</SCRIPT>
<script type="text/javascript">
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
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
function guardar(valor)
{
	if(valor=="1")
	{
		if(document.form1.objetivo.value=="0")
		{
			alert("Debe seleccionar un Objetivo");
			document.form1.objetivo.focus();
			return false;
		}else if(document.form1.estrategia.value=="0")
		{
			alert("Debe seleccionar una Estrategia");
			document.form1.estrategia.focus();
			return false;
		}else if(document.form1.descripcion.value=="0")
		{
			alert("Debe escribir una Descripcion");
			document.form1.descripcion.focus();
			return false;
		}else if(document.form1.inicio.value=="0")
		{
			alert("Debe seleccionar fecha de Inicio");
			document.form1.inicio.focus();
			return false;
		}
		else if(document.form1.accion1.value=="" && document.form1.accion2.value=="")
		{
			alert("Debe llenar al menos 2 acciones");
			document.form1.accion1.focus();
			return false;
		}else if(document.form1.limite.value=="0")
		{
			alert("Debe seleccionar fecha limite");
			document.form1.limite.focus();
			return false;
		}else
		{
		document.form1.guarda.value=valor; // 1 agregar, 2 guardar
		document.form1.submit();
		}
	}else
	{
	
	document.form1.guardar.value=valor; // 1 agregar, 2 guardar
	document.form1.submit();
	}
}
//-->
</script>
</head>

<body onload="MM_preloadImages('images/circulo_1_r.png','images/b_agregar_r.png')">
<form id="form1" name="form1" method="post" action="">

<table width="753" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"><table width="753" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="28" background="images/titulos_franjas.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="10" bgcolor="#333300"><img src="images/spacer.gif" width="15" height="28" /></td>
            <td bgcolor="#333300" class="text_mediano_blanco" style="color:#FFFFFF;">EDITAR OBJETIVO
              <input name="id" type="hidden" id="id" value="<?echo"$id";?>" />
              <span class="texto_tareas">
              <input name="guarda" type="hidden" id="guarda" />
              </span></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="410"><table width="100%" border="0" cellspacing="2" cellpadding="0">
          <tr>
            <td width="25%" height="20" bgcolor="#FFFFFF" class="usuario"><img src="images/spacer.gif" width="10" height="10" />Objetivo LAG:</td>
            <td width="75%" class="usuario"><select name="objetivo"  class="texto_tareas" style="width:350px" id="objetivo" >
              <option value="">--Selecciona--</option>
              <? 
						  	$query = "SELECT * from io_principies where revision=".$lista['revision']." order by id";
                            $result = mysqli_query($enlace,$query) or print("<option value=\"ERROR\">".mysqli_error($enlace)."</option>");
                            while($io = mysqli_fetch_assoc($result)){?>
              <option value="<? echo $io['id']?>" <? echo $lista['n_obj']==$io['id']?"selected":""; ?> ><? echo $io['nombre']?></option>
              <?
                            }
                          ?>
            </select></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="410"><table width="100%" border="0" cellspacing="2" cellpadding="0">
          <tr>
            <td width="25%" height="20" bgcolor="#FFFFFF" class="usuario"><img src="images/spacer.gif" width="10" height="10" /> Estrategia:</td>
            <td width="75%" class="usuario"><select name="estrategia"  class="texto_tareas" style="width:350px" id="estrategia" >
              <option value="">--Selecciona--</option>
            </select></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="2" cellpadding="0">
      <tr>
        <td width="25%" height="20" bgcolor="#FFFFFF" class="usuario"><p align="left"><img src="images/spacer.gif" alt="" width="10" height="10" />Objetivo SMART
          :<br />
            <img src="images/spacer.gif" alt="" width="10" height="10" />(Descripción)</p></td>
        <td width="75%" class="usuario"><textarea name="descripcion" cols="50" rows="4" class="texto_tareas" id="descripcion"><? echo $lista['descripcion'];?>
</textarea></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td width="350" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="2" cellpadding="0">
      <tr>
        <td width="185" height="20" bgcolor="#FFFFFF" class="usuario"><img src="images/spacer.gif" width="10" height="10" /> Fecha Inicio: </td>
        <td width="159" class="usuario"><input name="inicio" type="text" class="texto_tareas" id="inicio" value="<? echo $lista['inicio'];?>" size="15" readonly="readonly"/>
              <div align="left" class="texto_tareas"></div></td>
      </tr>
    </table></td>
    <td width="403" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="2" cellpadding="0">
      <tr>
        <td width="207" height="20" bgcolor="#FFFFFF" class="usuario"><img src="images/spacer.gif" width="10" height="10" /> Fecha Límite:</td>
        <td width="190" class="usuario"><input name="limite" type="text" class="texto_tareas" id="limite" value="<? echo $lista['limite'];?>" size="15" readonly="readonly"/></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#FFFFFF"><img src="images/spacer.gif" width="10" height="20" />
        <table width="100%" border="0" cellspacing="2" cellpadding="0">
          <tr>
            <td height="20" bgcolor="#ced0d1" class="usuario"><img src="images/spacer.gif" width="10" height="10" /> Plan de Acción: </td>
          </tr>
          <tr>
            <td height="20" class="usuario"><table width="100%" border="0">
                <tr>
                  <td width="46%">Accion</td>
                  <td width="16%">Fecha Inicio </td>
                  <td width="12%">Fecha Límite </td>
                  <td width="6%">&nbsp;</td>
                  <td width="20%">&nbsp;</td>
                </tr>
                <? 
				$i=1;
				$query3 = "SELECT id,accion, estatus, DATE_FORMAT(inicio,'%d-%m-%Y') as inicio, DATE_FORMAT(limite,'%d-%m-%Y') as limite, comentario  from acciones_new  where id_objetivo=".$lista['id_obj']."  order by id";						
$result3 = mysqli_query($enlace,$query3) or print("<option value=\"ERROR\">".mysqli_error($enlace)."</option>");
while($lista3 = mysqli_fetch_assoc($result3)){
				?>
                <tr>
                  <td><input name="accion<? echo $i?>" type="text" class="texto_tareas" id="accion<? echo $i?>" value="<? echo $lista3['accion'];?>" size="50" /></td>
                  <td><input name="inicio<? echo $i?>" type="text" class="texto_tareas" id="inicio<? echo $i?>" value="<? echo $lista3['inicio'];?>" size="15" readonly="readonly"/></td>
                  <td><input name="fin<? echo $i?>" type="text" class="texto_tareas" id="fin<? echo $i?>" value="<? echo $lista3['limite'];?>" size="15" readonly="readonly"/></td>
                  <td><input name="id_accion<? echo $i?>" type="hidden" id="id_accion<? echo $i?>" value="<? echo $lista3['id'];?>" /></td>
                  <td>&nbsp;</td>
                </tr>
                <? $i++;
				}?>
            </table></td>
          </tr>
      </table></td>
  </tr>
  <tr>
    <td colspan="2"><div align="center"><img src="images/spacer.gif" width="10" height="20" /><a href="javascript:guardar('1');" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image31<?echo"$i";?>','','images/b_guardarn_r.png',1)"><img src="images/b_guardarn.png" name="Image31<?echo"$i";?>" width="150" height="23" border="0" id="Image31<?echo"$i";?>" /></a></div></td>
  </tr>
</table>
<script>
var temp=buscar(<? echo $lista['n_obj']?>, <? echo $lista['n_lag']?>);
</script>
</form>
</body>
</html>
