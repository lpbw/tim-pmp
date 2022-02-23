<%@page import="ChartDirector.*" %>
<%@ page import = "java.sql.*" %>
<%@ page import = "java.text.*" %>
<%@include file="libreria.jsp" %>
<%
// The data for the chart
String id=request.getParameter("id");
double[] data = {0, 0, 0, 0, 0, 0};

// The labels for the chart
String[] labels = {"Speed", "Reliability", "Comfort", "Safety", "Efficiency", "Otro"};

Connection conn = null;
		try {
    	conn = DriverManager.getConnection(conexion,login,password);  
    	//Comienza ejecucion de SQL
    	Statement stmt = conn.createStatement();
		ResultSet lsDatos;
	    // Query the database for the problems.
 	    String listGStr = "";
	    ResultSet listGRst;	
		int i=0;
	listGStr = "SELECT fa1.nombre, avg(calificacion) as cal,round(avg(normalizado)*150,1) as pun FROM `tex_calificaciones`  as ca1 inner join tex_competencias as co1 on ca1.id_competencia=co1.id inner join tex_expectativas as fa1 on co1.id_expectativa=fa1.id where ca1.id_evaluado="+id+" group by fa1.id";
	//out.println(listGStr);
	lsDatos=stmt.executeQuery(listGStr);
	while(lsDatos.next())
	{		
		labels[i]=lsDatos.getString("nombre");
		data[i]=Double.valueOf(lsDatos.getString("pun"));
		i++;
	}
} catch(Exception e) {
        out.println(e.toString());
	}
	
conn.close();
// Create a PolarChart object of size 450 x 350 pixels
PolarChart c = new PolarChart(700, 450);

// Set center of plot area at (225, 185) with radius 150 pixels
c.setPlotArea(310, 185, 120);

// Add an area layer to the polar chart
c.addAreaLayer(data, 0x9999ff);

// Set the labels to the angular axis as spokes
c.angularAxis().setLabels(labels);

// Output the chart
String chart1URL = c.makeSession(request, "chart1");

// Include tool tip for the chart
String imageMap1 = c.getHTMLImageMap("", "", "title='{label}: score = {value}'");
Chart.setLicenseCode("DIST-0000-0581-ce23-988a");
%>
<html>
<body style="margin:5px 0px 0px 5px">


<img src='<%=response.encodeURL("getchart.jsp?"+chart1URL)%>'
    usemap="#map1" border="0">
<map name="map1"><%=imageMap1%></map>
</body>
</html>
