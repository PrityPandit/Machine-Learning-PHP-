document.onreadystatechange = function() { 
	if (document.readyState !== "complete") { 
		document.querySelector("body").style.visibility = "hidden"; 
		document.querySelector("#loader").style.visibility = "visible"; 
	} else { 
		document.querySelector("#loader").style.display = "none"; 
		document.querySelector("body").style.visibility = "visible";
		setInterval(autoUpdate, 1000);
	}
};

function autoUpdate()
{
	var xmlhttp = new XMLHttpRequest(); 
   
	xmlhttp.onreadystatechange = function() { 
    if (this.readyState == 4 && this.status == 200) { 
        myObj = JSON.parse(this.responseText); 
        document.getElementById("temperature").innerHTML = myObj.temp; 
        document.getElementById("humidity").innerHTML = myObj.hum; 
    } 
}; 
xmlhttp.open("GET", "showdata.php", true); 
xmlhttp.send();
}

