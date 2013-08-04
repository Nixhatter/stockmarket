<html lang="en"> 
    <head> 
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Stock Market Backtester V.02</title> 
        <meta name="description" content="Stock Market Backtester"> 
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
        <!--[if IE 8]><script language="javascript" type="text/javascript" src="../excanvas.min.js"></script><![endif]-->
        <script language="javascript" type="text/javascript" src="js/jquery.flot.js"></script>
        <script src="js/javascript.js"></script>
	 <script>
          $(function() {
            $( "#datepickerStart" ).datepicker({ dateFormat: "yy-mm-dd" });
            $( "#datepickerEnd" ).datepicker({ dateFormat: "yy-mm-dd" });
          });
  </script>
    </head>
    <body>
                <label>Symbol</label>
                <input type="text" id="symbol" onBlur="toUpperCase('symbol');" >
                <p>Start Date: <input type="text" id="datepickerStart" /></p>
                <p>End Date: <input type="text" id="datepickerEnd" /></p>
                <button type="submit" onclick="getSymbol();">Submit</button>
                
                <div id="placeholder" style="width:600px;height:300px;"></div>
                
                <div id="result"></div> 
        <script type="text/javascript">
        $(function () {
            var dataset1 = <?php echo json_encode($dataset1); ?>;
        
            $.plot($("#placeholder"), [ dataset1 ]);
        });
        </script>
    </body>
</html>
            
   

    

<?php

$server = "localhost";
    $user="user";
    $password="password";  
    $database = "some_database";

    $connection = mysql_connect($server,$user,$password);
    $db = mysql_select_db($database,$connection);

    $query = "SELECT x_axis_values, y_axis_values FROM some_table";
    $result = mysql_query($query);        

    while($row = mysql_fetch_assoc($result))
    {
        $dataset1[] = array($row['x_axis_value'],$row['y_axis_value']);
    }

?>