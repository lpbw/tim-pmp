<%@page import="ChartDirector.*" %>
<%@ page import = "java.sql.*" %>
<%@ page import = "java.text.*" %>
<%@include file="libreria.jsp" %>
<%
// The data for the chart
String id=request.getParameter("id");
double[] data = {0, 0, 0, 0, 0};

// The labels for the chart
String[] labels = {"Jefe Directo", "Colaterales", "Colaboradores", "Clientes", "Autoevaluacion"};

Connection conn = null;
		try {
    	conn = DriverManager.getConnection(conexion,login,password);  
    	//Comienza ejecucion de SQL
    	Statement stmt = conn.createStatement();
		ResultSet lsDatos;
	    // Query the database for the problems.
 	    String listGStr = "";
	    ResultSet listGRst;	
		
	listGStr = "SELECT round(avg(tipo1s),1) as t1,round(avg(tipo2s),1) as t2,round(avg(tipo3s),1) as t3,round(avg(tipo4s),1) as t4,round(avg(tipo5s),1) as t5, round(avg(tipo1n)*150,1) as c1,round(avg(tipo2n)*150,1) as c2,round(avg(tipo3n)*150,1) as c3,round(avg(tipo4n)*150,1) as c4,round(avg(tipo5n)*150,1) as c5 FROM `tex_resultados` where id_evaluado="+id;
	//out.println(listGStr);
	lsDatos=stmt.executeQuery(listGStr);
	while(lsDatos.next())
	{		
		
		data[0]=Double.valueOf(lsDatos.getString("c1"));
		data[1]=Double.valueOf(lsDatos.getString("c3"));
		data[2]=Double.valueOf(lsDatos.getString("c2"));
		data[3]=Double.valueOf(lsDatos.getString("c4"));
		data[4]=Double.valueOf(lsDatos.getString("c5"));
		
	}
} catch(Exception e) {
        out.println(e.toString());
	}
	
conn.close();
// Create a PolarChart object of size 450 x 350 pixels
PolarChart c = new PolarChart(700, 450);

// Set center of plot area at (225, 185) with radius 150 pixels
c.setPlotArea(310, 185, 150);

// Add an area layer to the polar chart
c.addAreaLayer(data, 0x9999ff);

// Set the labels to the angular axis as spokes
c.angularAxis().setLabels(labels);

// Output the chart
String chart2URL = c.makeSession(request, "chart2");

// Include tool tip for the chart
String imageMap2 = c.getHTMLImageMap("", "", "title='{label}: score = {value}'");
Chart.setLicenseCode("DIST-0000-0581-ce23-988a");
%>
<html>
<body style="margin:5px 0px 0px 5px">


<img src='<%=response.encodeURL("getchart.jsp?"+chart2URL)%>'
    usemap="#map2" border="0">
<map name="map2"><%=imageMap2%></map>
</body>
</html>
