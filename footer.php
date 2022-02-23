<td>
    <table width="350" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
            <td width="145"><a href="cambia_pass.php?id=<?echo" $idU";?>" class="iframe2"
                    onmouseout="MM_swapImgRestore()"
                    onmouseover="MM_swapImage('Image21','','images/b_cambio.png',1)"><img src="images/b_cambio.png"
                        name="Image21" width="150" height="23" border="0" id="Image21" /></a></td>
            <td><img src="images/spacer.gif" width="16" height="20" /></td>
            <td width="114">
                <? if($_SESSION["idA"]=="1"){?>
                <a href="admin.php" onmouseout="MM_swapImgRestore()"
                    onmouseover="MM_swapImage('Image24','','images/b_administracion.png',1)"><img
                        src="images/b_administracion.png" name="Image24" width="150" height="23" border="0"
                        id="Image24" /></a>
                <? }?>            </td>
            <td><img src="images/spacer.gif" width="17" height="20" /></td>
            <td><a href="logout.php" onmouseout="MM_swapImgRestore()"
                    onmouseover="MM_swapImage('Image25','','images/b_log_out.png',1)"><img src="images/b_log_out.png"
                        name="Image25" width="150" height="23" border="0" id="Image25" /></a></td>
        </tr>
    </table>
</td>