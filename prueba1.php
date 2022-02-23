
<?
$html="
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />

<title>Bell</title>

<link href=\"images/textos.css\" rel=\"stylesheet\" type=\"text/css\" />
<link type=\"text/css\" href=\"css/smoothness/jquery-ui-1.8.16.custom.css\" rel=\"stylesheet\" /> 
<link rel=\"stylesheet\" href=\"colorbox.css\" />
<script type=\"text/javascript\" src=\"js/jquery-1.6.2.min.js\"></script>
<script type=\"text/javascript\" src=\"js/jquery-ui-1.8.16.custom.min.js\"></script>
<script src=\"colorbox/jquery.colorbox-min.js\"></script>

<style type=\"text/css\">
  <!--
  body {
  	margin-left: 0px;
  	margin-top: 0px;
  	margin-right: 0px;
  	margin-bottom: 0px;
  	background-image: url();
  }
  -->
</style>



<style type=\"text/css\">
  <!--
  .style1 {font-size: 24px}
  .column {
  	text-align: right;
  	float:left;
    width:28%;
    margin: 5px;
  }
    .column2 {
  	text-align: right;
  	float:left;
    width:30%;
    margin: 5px;
  }
    .column3 {
  	text-align: right;
  	float:left;
    width:32%;
    margin: 5px;
  }
  .column4 {
  	
  	float:left;
    width:40%;
    margin: 5px;
  }
  .fixColumn {
  	text-align: left;
  	padding: 3px;
  	float:left;
  }
  .btnAgregar{
    float: right;
	width: 100px;
  }
     .ancho{
    height:21px;
  }
  .date{
    width:10%;
  }
   .date2{
    width:18%;
  }
  .text{
    width:10%;
  } 
  .tinyText{
    width:10%;
  }
  .tinyText2{
    width:11%;
  }
  .row{
    width: 99%;
  	float: left;
	padding: 5px;
  }
  .title{
	  background-color:#00475c}
.title2{
	  background-color:#E26F36}	  

  .topic{
  	margin-bottom:30px;
  }
  .infoRow{
	  background-color:#FFFFFF;
	  width:100%;
  }
.style11 {color: #999999}
  -->
</style>
</head>

<body onload=\"MM_preloadImages('images/b_cambio_r.png','images/b_administracion_r.png','images/b_log_out_r.png')\">

<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
  <tr>
    <td height=\"698\" valign=\"top\" background=\"\"><table width=\"85%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
      <tr>
        <td><img src=\"images/spacer.gif\" width=\"10\" height=\"20\" /></td>
      </tr>
      <tr>
        <td><div align=\"center\">
          <table width=\"850\" border=\"0\" cellspacing=\"7\" cellpadding=\"0\">
            <tr>
              <td><div align=\"center\" class=\"text_grande style1\">{$usuario['nombre']}</div></td>
            </tr>
            <tr>
              <td><div align=\"center\" class=\"text_mediano\">Career File</div></td>
            </tr>
          </table>
        </div></td>
      </tr>
      <tr>
        <td><img src=\"images/spacer.gif\" width=\"10\" height=\"20\" /></td>
      </tr>
      <tr>
        <td><img src=\"images/spacer.gif\" width=\"10\" height=\"10\" /></td>
      </tr>
	   <tr>
        <td><img src=\"images/spacer.gif\" width=\"10\" height=\"10\" /></td>
      </tr>
	  <tr>
        <td bgcolor=\"#eeeeee\"><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
  <tr>
    <td width=\"65%\"><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
  <tr>
    <td width=\"25%\" rowspan=\"3\"><img src=\"empleados/$id.jpg\" height=\"300\" width=\"200\"/></td>
    <td width=\"75%\">&nbsp;</td>
  </tr>
  <tr>
    <td valign=\"top\">&emsp;<b>{$direct['direct']}</b> Direct Reports<br/>&emsp;<b>{$team['team']}</b> Total Team</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table></td>
    <td width=\"35%\" valign=\"top\"><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"right\">
  <tr>
    <td colspan=\"2\" align=\"left\" height=\"25\" class=\"text_mediano_blanco title\">&nbsp;Personal Information </td>
    </tr>
  <tr>
    <td align=\"right\" valign=\"top\"><B>First Name</B></td>
    <td>&nbsp;{$usuario['nombre']}</td>
  </tr>
  <tr>
    <td align=\"right\"><B>Middle Name</B></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align=\"right\"><b>Title</b></td>
    <td>&nbsp;{$usuario['puesto']}</td>
  </tr>
  <tr>
    <td align=\"right\"><b>Division</b></td>
    <td>&nbsp;Bell Division</td>
  </tr>
  <tr>
    <td align=\"right\"><b>Deparment</b></td>
    <td>&nbsp;{ $dep['nombre']}</td>
  </tr>
  <tr>
    <td align=\"right\" valign=\"top\"><b>Supervisor</b></td>
    <td>&nbsp;{$sup['nombre']}</td>
  </tr>
  <tr>
    <td align=\"right\" valign=\"top\"><b>HR Business Partner</b></td>
    <td>&nbsp;{$sup['nombre']}</td>
  </tr>
  <tr>
    <td align=\"right\" valign=\"top\"><b>Location</b></td>
    <td> &nbsp;T.I.M. - Bell Helicopter plant (BHMBU-BC777) </td>
  </tr>
  <tr>
    <td align=\"right\"><b>City, State, Country</b></td>
    <td> &nbsp;MEX-Mexico</td>
  </tr>
  <tr>
    <td align=\"right\"><b>Hire Date</b></td>
    <td>&nbsp;{ $usuario['fecha_contratacion']}</td>
  </tr>
  <tr>
    <td align=\"right\"><b>Years of Service (Not to be used for benefit calculations)</b></td>
    <td valign=\"top\">&nbsp;{  $usuario['servicio']}</td>
  </tr>
  <tr>
    <td align=\"right\"><b>Years</b></td>
    <td>&nbsp;{  $usuario['edad']}</td>
  </tr>
  <tr>
    <td align=\"right\"><b>Gender</b></td>
    <td>&nbsp;";  if($usuario['sexo']=="1"){ echo "Female"; } else { echo "Male"; } html.="</td>
  </tr>
</table></td>
  </tr>
  <tr>
        <td align=\"right\">&nbsp;</td>
      </tr>
  <tr>
        <td colspan=\"2\" bgcolor=\"#eeeeee\">&nbsp;</td>
  </tr>
		 <tr>
        <td align=\"right\">&nbsp;</td>
      </tr>
		<tr>
          <td colspan=\"2\" bgcolor=\"#eeeeee\">&nbsp;</td>
		</tr>
</table>
</td>
      </tr>
	  <tr>
        <td><img src=\"images/spacer.gif\" width=\"10\" height=\"10\" /></td>
      </tr>
      <tr>
        <td bgcolor=\"#eeeeee\"><table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
          <tr>
            <td height=\"250\" valign=\"top\">
			<div class=\"row topic\">
              <form id=\"form1\" name=\"form1\" method=\"post\" action=\"\">
                <div class=\"row text_mediano_blanco title\">Textron Job History </div>
              <div class=\"row\">
                <div class=\"fixColumn date\"><strong>Start Date</strong></div>
                <div class=\"fixColumn date\"><strong>End Date</strong></div>
				 <div class=\"fixColumn tinyText\"><strong>Title</strong></div>
                <div class=\"fixColumn tinyText\"><strong>Business Unit</strong></div>
                <div class=\"fixColumn tinyText\"><strong>City, State</strong></div>
                <div class=\"fixColumn tinyText\"><strong>Country</strong></div>
				<div class=\"fixColumn tinyText\"><strong>Function</strong></div>
              </div>
			  ";
			  
             while ($row=mysqli_fetch_assoc($job_history_textron)) { 
			  html.="
              <div class=\"row infoRow\" id=\"divJH0\">
                <div class=\"fixColumn date\">{ $row['from_date']}</div>
                <div class=\"fixColumn date\">{$row['to_date']}</div>
                <div class=\"fixColumn tinyText\">{$row['position']}</div>
                <div class=\"fixColumn tinyText\">{$row['business_unit']}</div>
                <div class=\"fixColumn tinyText\">{$row['city_state']}</div>
				<div class=\"fixColumn tinyText\">{$row['country']}</div>
				<div class=\"fixColumn tinyText\">{$row['function']}</div>
              </div>
			  ";
               } 
			  html.="
              </form>
            </div>
			
			
			 <div class=\"row topic\">
              <form id=\"form5\" name=\"form5\" method=\"post\" action=\"\">
                <div class=\"row text_mediano_blanco title\">Early Textron Job History not Reflected in Textron Job History Above </div> 
                <div class=\"row\">
                  <div class=\"fixColumn date\"><strong>Start Date</strong></div>
                  <div class=\"fixColumn date\"><strong>End Date</strong></div>
                  <div class=\"fixColumn tinyText\"><strong>Title</strong></div>
                  <div class=\"fixColumn tinyText\"><strong>Business Unit</strong></div>
                  <div class=\"fixColumn tinyText\"><strong>City, State</strong></div>
				  <div class=\"fixColumn tinyText\"><strong>Country</strong></div>
				  <div class=\"fixColumn tinyText\"><strong>Function</strong></div>
                </div>
				";
               while ($row=mysqli_fetch_assoc($job_history_early)) { 
			  html.="
                <div class=\"row infoRow\" id=\"divJH\">
                <div class=\"fixColumn date\">{ $row['from_date']}</div>
                <div class=\"fixColumn date\">{$row['to_date']}</div>
                <div class=\"fixColumn tinyText\">{$row['position']}</div>
                <div class=\"fixColumn tinyText\">{$row['business_unit']}</div>
                <div class=\"fixColumn tinyText\">{$row['city_state']}</div>
				<div class=\"fixColumn tinyText\">{$row['country']}</div>
				<div class=\"fixColumn tinyText\">{$row['function']}</div>
                </div>
				";
              } 
			  html.="
			   </form>
              </div>
			  
			  
              <div class=\"row topic\">
              <form id=\"form2\" name=\"form2\" method=\"post\" action=\"\">
                <div class=\"row text_mediano_blanco title\">Non - Textron Job History </div>    
                <div class=\"row\">
                  <div class=\"fixColumn date\"><strong>Start Date</strong></div>
                  <div class=\"fixColumn date\"><strong>End Date</strong></div>
                  <div class=\"fixColumn tinyText\"><strong>Title</strong></div>
                  <div class=\"fixColumn tinyText\"><strong>Company Name</strong></div>
                  <div class=\"fixColumn tinyText\"><strong>Type of Business</strong></div>
				  <div class=\"fixColumn tinyText\"><strong>City, State</strong></div>
				  <div class=\"fixColumn tinyText\"><strong>Country</strong></div>
				  <div class=\"fixColumn tinyText\"><strong>Function</strong></div>
				  <div class=\"fixColumn tinyText\"><strong>Type of Role</strong></div>
                </div>
				";
               while ($row=mysqli_fetch_assoc($job_history)) { 
			  html.="
                <div class=\"row infoRow\" id=\"divJH\">
                <div class=\"fixColumn date\">{$row['from_date']}</div>
                <div class=\"fixColumn date\">{$row['to_date']}</div>
                <div class=\"fixColumn tinyText\">{$row['position']}</div>
				<div class=\"fixColumn tinyText\">{$row['business_unit']}</div>
                <div class=\"fixColumn tinyText\">{$row['type_business']}</div>
                <div class=\"fixColumn tinyText\">{$row['city_state']}</div>
				<div class=\"fixColumn tinyText\">{$row['country']}</div>
				<div class=\"fixColumn tinyText\">{$row['function']}</div>
				<div class=\"fixColumn tinyText\">{$row['type_role']}</div>
                </div>
				";
               }  
			  html.="
			  </form>
              </div>
			  
			  
			  <div class=\"row topic\">
              <form id=\"form4\" name=\"form4\" method=\"post\" action=\"\">
                <div class=\"row text_mediano_blanco title\">Career Highlights </div>
				<span class=\"style11\">Example. This section provides the opportunity to share highlights of your career. While this is not intended to be a resume or Curriculum Vita (CV), you may enter specific accomplishments or experiences to illustrate the most important aspects of your career. The Date, Job Title and Company Name must match a record in either the Textron Job History or Non-Textron Job History sections above.</span>  
                <div class=\"row\">
                  <div class=\"fixColumn date2\"><strong>Year</strong></div>
                  <div class=\"fixColumn date2\"><strong>Job Title</strong></div>
                  <div class=\"fixColumn date2\"><strong>Company Name</strong></div>
                  <div class=\"fixColumn date2\"><strong>Career Highlight</strong></div>
                </div>
				";
                 while ($row=mysqli_fetch_assoc($carrer_highlights)) { 
				html.="
                <div class=\"row infoRow\" id=\"divJH2\">
                  <div class=\"fixColumn date2\">{ $row['to_date']}</div>
                  <div class=\"fixColumn date2\">{$row['job_title']}</div>
                  <div class=\"fixColumn date2\">{$row['company']}</div>
                  <div class=\"fixColumn date2\">{$row['achievement']}</div>
                </div>
				";
                 }  
				html.="
              </form>
              </div>
			  
			  
			   <div class=\"row topic\">  
			<form name=\"formIE\" method=\"post\" id=\"formIE\" action=\"\">
                 <div class=\"row text_mediano_blanco title\">International Experience </div>
				  <span class=\"style11\">Example. Talent Management Summit (M�xico, DF), Wealthness Coaching Summit (US), Stress Management (M�xico), Human Resources Management, Coaching.</span>
			 <div class=\"row\">
                  <div class=\"fixColumn date2\"><strong>Country</strong></div>
                  <div class=\"fixColumn date2\"><strong>Type of Experince</strong></div>
                  <div class=\"fixColumn date2\"><strong>Years of Experience</strong></div>
                  <div class=\"fixColumn date2\"><strong>Company Name</strong></div>
				  <div class=\"fixColumn date2\"><strong>Comments</strong></div>
                </div>
				";
                
                while ($row=mysqli_fetch_assoc($career)) { 
				html.="
           <div class=\"row infoRow\" id=\"divJH2\">
                  <div class=\"fixColumn date2\">{ $row['country']}</div>
				  <div class=\"fixColumn date2\">{$row['type_experience']}</div>
				  <div class=\"fixColumn date2\">{$row['years']}</div>
				  <div class=\"fixColumn date2\">{$row['company']}</div>
				  <div class=\"fixColumn date2\">{$row['coments']}</div>
             </div>
			 ";
			     } 
				html.="
              </form>
              </div>
			  
			  
              <div class=\"row topic\">
              <form id=\"form3\" name=\"form3\" method=\"post\" action=\"\">
                <div class=\"row text_mediano_blanco title\">Education History </div>
				<span class=\"style11\">Example. This section should reflect your formal education history such as high school, compulsory, or university degrees completed or currently pursuing. Do not record Textron University courses, or other certifications, licenses or certificates of completion in this section. Note: Select the first day of the month if you do not remember the actual Graduation Date (e.g. 05-01-1997).</span>
                <div class=\"row\">
                  <div class=\"fixColumn tinyText2\"><strong>Degree</strong></div>
				   <div class=\"fixColumn tinyText2\"><strong>Major</strong></div>
				    <div class=\"fixColumn tinyText2\"><strong>Country</strong></div>
                  <div class=\"fixColumn tinyText2\"><strong>School</strong></div>
                  <div class=\"fixColumn tinyText2\"><strong>Location</strong></div>
				   <div class=\"fixColumn tinyText2\"><strong>Graduation Date</strong></div>
				    <div class=\"fixColumn tinyText2\"><strong>Comments</strong></div>
                </div>
				";
               while ($row=mysqli_fetch_assoc($education_history)) { 
			  html.="
                <div class=\"row infoRow\" id=\"divJH\">
                <div class=\"fixColumn tinyText2\">{$row['degree']}</div>
				<div class=\"fixColumn tinyText2\">{$row['major']}</div>
				<div class=\"fixColumn tinyText2\">{$row['country']}</div>
                <div class=\"fixColumn tinyText2\">{$row['school']}</div>
                <div class=\"fixColumn tinyText2\">{$row['location']}></div>
				<div class=\"fixColumn tinyText2\">{$row['to_date']}</div>
				<div class=\"fixColumn tinyText2\">{$row['coments']}</div>
                </div>
				";
               } 
			  html.="
			  </form>
              </div>

 
<div class=\"row topic\">  
			<form name=\"formTLD\" method=\"post\">
                <div class=\"row text_mediano_blanco title\">Textron Leadership Development</div>
            <div class=\"row\">
                  <div class=\"fixColumn date2\"><strong>Course Name</strong></div>
                  <div class=\"fixColumn date2\"><strong>Institution Name</strong></div>
                  <div class=\"fixColumn date2\"><strong>Status</strong></div>
                  <div class=\"fixColumn date2\"><strong>Date Completed</strong></div>
                </div>
				";
             
                while ($row=mysqli_fetch_assoc($career5)) { 
				html.="
                <div class=\"row infoRow\" id=\"divJH2\">
                  <div class=\"fixColumn date2\">{$row['course']}</div>
				  <div class=\"fixColumn date2\">{$row['institution']}</div>
				  <div class=\"fixColumn date2\">{$row['status']}</div>
				  <div class=\"fixColumn date2\">{$row['date']}</div>
            </div>
			";
                 } 
				html.="
              </form>
              </div>
            
			  
		<div class=\"row topic\">  
			<form name=\"formLC\" method=\"post\" action=\"\" id=\"formLC\">
                <div class=\"row text_mediano_blanco title\">Language Capability </div>
				<span class=\"style11\">Example. English 800 points TOEIC tool</span>
			  <div class=\"row\">
                  <div class=\"fixColumn date2\"><strong>Language</strong></div>
                  <div class=\"fixColumn date2\"><strong>Speaking Proficiency</strong></div>
                  <div class=\"fixColumn date2\"><strong>Reading Proficiency</strong></div>
                  <div class=\"fixColumn date2\"><strong>Writing Proficiency</strong></div>
				  <div class=\"fixColumn date2\"><strong>Comments</strong></div>
                </div>
				";
                 while ($row=mysqli_fetch_assoc($career2)) { 
				 html.="
                <div class=\"row infoRow\" id=\"divJH2\">
                  <div class=\"fixColumn date2\">{$row['language']}</div>
				  <div class=\"fixColumn date2\">{$row['speaking']}</div>
				  <div class=\"fixColumn date2\">{$row['reading']}</div>
				  <div class=\"fixColumn date2\">{$row['writing']}</div>
				  <div class=\"fixColumn date2\">{$row['coments']}</div>
             </div>
			 ";
			  } 
			 html.="
              </form>
              </div>
			 
		
			 
			 <div class=\"row topic\">  
			<form name=\"formPERFOR\" method=\"post\" action=\"\" id=\"formPERFOR\">
                <div class=\"row text_mediano_blanco title\">Performance History </div>
			  <div class=\"row\">
                  <div class=\"fixColumn date2\"><strong>Start Date</strong></div>
                  <div class=\"fixColumn date2\"><strong>End Date</strong></div>
                  <div class=\"fixColumn date2\"><strong>Rating</strong></div>
                </div>
				";
                 while ($row=mysqli_fetch_assoc($performance_history)) { 
				 html.="
                <div class=\"row infoRow\" id=\"divJH2\">
                  <div class=\"fixColumn date2\">{$row['start_date']}</div>
				  <div class=\"fixColumn date2\">{$row['end_date']}</div>
				  <div class=\"fixColumn date2\">{$row['rating']}</div>
             </div>
			 ";
			  } 
			  html.=" 
              </form>
              </div>

			 
			  
			  <div class=\"row topic\">  
			<form name=\"formCA\" method=\"post\">
                <div class=\"row text_mediano_blanco title\">Career Aspirations </div>
             <div class=\"row\">
                  <div class=\"fixColumn date2\"><strong>Level</strong></div>
                  <div class=\"fixColumn date2\"><strong>Function</strong></div>
                  <div class=\"fixColumn date2\"><strong>Business Unit</strong></div>
                  <div class=\"fixColumn date2\"><strong>Comments</strong></div>
				  <div class=\"fixColumn date2\"><strong>Date Entered</strong></div>
                </div>
				";
                 while ($row=mysqli_fetch_assoc($career4)) { 
				html.="
                <div class=\"row infoRow\" id=\"divJH2\">
                  <div class=\"fixColumn date2\">{$row['level']}</div>
				  <div class=\"fixColumn date2\">{$row['function']}</div>
				  <div class=\"fixColumn date2\">{$row['business_unit']}</div>
				  <div class=\"fixColumn date2\">{$row['career']}</div>
				  <div class=\"fixColumn date2\">{$row['date']}</div>
            </div>
			";
			  } 
			 html.=" 
              </form>
              </div>
			  
			<div class=\"row topic\">  
			<form name=\"formGM\" method=\"post\">
              <div class=\"row topic\">
                <div class=\"row text_mediano_blanco title\">Geographic Mobility </div>
				<span class=\"style11\">Example. Yes.</span>
				";
				  $rowGM=mysqli_fetch_assoc($career3); 
				  html.=" 
                <div class=\"row\" style=\"background:#eeeeee\">
                    <div class=\"column4\"  align=\"right\">
                    <div class=\"ancho\">Willing to Relocate</div>
					<div class=\"ancho\">Comments</div>
					<div class=\"ancho\">Date Entered</div>
					</div>
					<div class=\"column4\" align=\"left\">
					<div><input type=\"text\" name=\"willingGM\" id=\"willingGM\" value=\"{$rowGM['willing']}\"/></div>
					<div> 
					  <textarea name=\"comenstGM\" cols=\"50\" rows=\"3\" id=\"comenstGM\">{ $rowGM['coments']}</textarea>
					</div>
                      <div><input type=\"text\" name=\"toGM\" id=\"toGM\" value=\"{ $rowGM['date']}\"/></div>
                    </div>
                </div>
                  
              </div>
              </form>
              </div>
			  
		
	
			<div class=\"row topic\">
			<form name=\"formStre\" method=\"post\">
                <div class=\"row text_mediano_blanco title2\">Strengths</div>
				<span class=\"style11\">Example. Use this section to document the employee�s strengths.</span>
                <div class=\"row\">
                  <div class=\"fixColumn date2\"><strong>Competency</strong></div>
                  <div class=\"fixColumn date2\"><strong>Comments</strong></div>
                  <div class=\"fixColumn date2\"><strong>Date Entered</strong></div>
                </div>
				";
                while ($row=mysqli_fetch_assoc($career8)) { 
				html.="
                <div class=\"row infoRow\" id=\"divJH2\">
                  <div class=\"fixColumn date2\">{ $row['competency']}</div>
				  <div class=\"fixColumn date2\">{$row['coments']}</div>
				  <div class=\"fixColumn date2\">{$row['date']}</div>
             </div>
			 ";
			 }
			 html.="
              </form>
              </div>
			
			  
			<div class=\"row topic\">
			<form name=\"formDevN\" method=\"post\"> 
                <div class=\"row text_mediano_blanco title2\">Development Needs</div>
				<span class=\"style11\">Example. Use this section to document the employee�s development needs.</span>
                <div class=\"row\">
                  <div class=\"fixColumn date2\"><strong>Competency</strong></div>
                  <div class=\"fixColumn date2\"><strong>Comments</strong></div>
                  <div class=\"fixColumn date2\"><strong>Date Entered</strong></div>
                </div>
				";
                 while ($row=mysqli_fetch_assoc($career9)) { 
				 html.="
                <div class=\"row infoRow\" id=\"divJH2\">
                 <div class=\"fixColumn date2\">{ $row['competency']}</div>
				  <div class=\"fixColumn date2\">{$row['coments']}</div>
				  <div class=\"fixColumn date2\">{$row['date']}</div>
             </div>
			 ";
			   } 
			   html.=" 
              </form>
              </div>
			   
			   
			  
        <div class=\"row topic\">
			<form name=\"formDevNeed\" method=\"post\">
                <div class=\"row text_mediano_blanco title2\">Development Plan</div>
				<span class=\"style11\">Example. Use this section to document the employee�s development plan. List at least 2 action items. Avoid limiting development actions to classroom training only.</span>
               <div class=\"row\">
                  <div class=\"fixColumn date2\"><strong>Focus</strong></div>
                  <div class=\"fixColumn date2\"><strong>Description</strong></div>
                  <div class=\"fixColumn date2\"><strong>Date Entered</strong></div>
                </div>
				";
                while ($row=mysqli_fetch_assoc($career10)) { 
				html.="
                <div class=\"row infoRow\" id=\"divJH2\">
                  <div class=\"fixColumn date2\">{$row['focus']}</div>
                  <div class=\"fixColumn date2\">{$row['description']}</div>
                  <div class=\"fixColumn date2\">{$row['date']}</div>
                </div>
				";
                 } 
				html.="
              </form>
              </div>
			
			<br /> 
            <br />			</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><img src=\"images/spacer.gif\" width=\"10\" height=\"50\" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>


";
?>