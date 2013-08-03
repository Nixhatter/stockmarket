/**
 * @author Dillon
 */
function getSymbol() {
	var symbol = document.getElementById("symbol").value;
	var startDate = document.getElementById("datepickerStart").value;
	var endDate =  document.getElementById("datepickerEnd").value;

	var Data;
	var xhr;
	if (window.XMLHttpRequest) { // Mozilla, Safari, ...
	    xhr = new XMLHttpRequest();
	} else if (window.ActiveXObject) { // IE 8 and older
	    xhr = new ActiveXObject("Microsoft.XMLHTTP");
	}
	if (symbol != null) data = "&symbol=" + symbol;
	if (startDate != null) data = data + "&startDate=" + startDate;
	if (endDate != null) data =  data +  "&endDate=" + endDate;
	     xhr.open("POST", "configuration.php", true); 
	     xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");                  
	     xhr.send(data);
		 xhr.onreadystatechange = display_data;
		function display_data() {
			if (xhr.readyState == 4) {
	    		if (xhr.status == 200) {
	       		//alert(xhr.responseText);	   
		  		document.getElementById("result").innerHTML = xhr.responseText;
	      		} else {
		        	alert('There was a problem with the request.');
		      	}
	     	}
		}
}
function toUpperCase(inputID) {
var input = document.getElementById(inputID);

input.onkeyup = function(){
    this.value = this.value.toUpperCase();
}
}
