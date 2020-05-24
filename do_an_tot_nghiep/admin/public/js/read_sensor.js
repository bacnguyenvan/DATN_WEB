$(document).ready(function(){
	
      var temp = [];
      var humi = [];

      setInterval(function() {
       	// location.reload();
        getTemperatureData();
        // getHumidityData();
      }, 2000); 
      
      setInterval(function() {
       
        Time_Date();
      }, 1000); 

      function getTemperatureData() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
          	var tem = (this.responseText).split("_");
            document.getElementById("TemperatureValue").innerHTML = tem[0];
            ;
            document.getElementById("HumidityValue").innerHTML = tem[1];

            // temp.push(this.responseText);
          }
        };
        xhttp.open("GET", "readTemperature.php", true);
        xhttp.send();
      }

  
      function Time_Date() {
        var t = new Date();
        document.getElementById("time").innerHTML = t.toLocaleTimeString();
        var d = new Date();
        const dayNames = ["Chủ nhật", "Thứ hai", "Thứ ba", "Thứ tư", "Thứ năm", "Thứ sáu","Thứ 7"];
        const monthNames = ["01", "02", "03", "04", "05", "06","07", "08", "09", "10", "11", "12"];
        document.getElementById("date").innerHTML = dayNames[d.getDay()] + ", " + d.getDate() + "-" + monthNames[d.getMonth()] + "-" + d.getFullYear();
      }

     

})