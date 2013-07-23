<!DOCTYPE html> 
<html lang="en"> 
    <head> 
        <meta charset="utf-8"> 
        <title>Stock Market Backtester V.02</title> 
        <meta name="description" content="Stock Market Backtester"> 
        <script src="/js/javascript.js"></script>
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
        <script>
          $(function() {
            $( "#datepickerStart" ).datepicker({ dateFormat: "yy-mm-dd" });
            $( "#datepickerEnd" ).datepicker({ dateFormat: "yy-mm-dd" });
          });
  </script>
    </head>
    <body>
                <label>Symbol</label>
                <input type="text" id="symbol">
                <p>Start Date: <input type="text" id="datepickerStart" /></p>
                <p>End Date: <input type="text" id="datepickerEnd" /></p>
                <button type="submit" onclick="getSymbol();">Submit</button>

                <div id="result"></div> 

    </body>
</html>
            