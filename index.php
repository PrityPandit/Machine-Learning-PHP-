<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Precision Agriculture</title>
     <!-- link with CSS-->
     <!--link rel="stylesheet" href="css/style.css"/-->
     <style type="text/css">
        @import url('https://fonts.googleapis.com/css2?family=Raleway:wght@100;200;300;400;500;600;700&display=swap');
html {
    font-family: Arial, Helvetica;
    display: inline-block;
    text-align: center;
}
.topnav {
    overflow: hidden;
    background-color: yellow;
}

body{
    margin: 0;
    font-family: 'Raleway', sans-serif;  
}
.content {
    padding: 50px;
}
.card-grid {
    max-width: 800px;
    margin: 0 auto;
    display: grid;
    grid-gap: 2rem;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
}
.card {
    background-color: white;
    box-shadow: 2px 2px 12px 1px rgba(140,140,140,.5);
}
.card-title {
    font-size: 1.2rem;
    font-weight: bold;
    color: #034078
}
.reading {
    font-size: 1.2rem;
    color: #1282A2;
}
.button span {
    cursor: pointer;
    display: inline-block;
    position: relative;
    transition: 0.5s;
  }
  
  .button span:after {
    content: '\00bb';
    position: absolute;
    opacity: 0;
    top: 0;
    right: -20px;
    transition: 0.5s;
  }
  
  .button:hover span {
    padding-right: 25px;
  }
  
  .button:hover span:after {
    opacity: 1;
    right: 0;
  }
        </style>
</head>
<body>

    <div class="topnav">
        <h1>Monitoring Precision Agriculture</h1>
    </div>
    <div class="content">
        <div class="card-grid">
             <div class="card">
                <p class="card-title"><i class="fas fa-thermometer-threequarters" style="color:#059e8a;"></i> Temperature</p>
                <p class="reading"><span id="temperature"></span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp &deg;C</p>
             </div>
             <div class="card">
                    <p class="card-title"> Humidity</p>
                    <p class="reading"><span id="humidity"></span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp &percnt;</p>
             </div>
             <br><br>
     <a href="showdata.php" target="_blank"><button class="button"><span>Table</span></button></a>
     <div id="loader" class="center"></div>
    <script src="script.js"></script>
    <a href="show.php" target="_blank"><button id="get-data-button"><span>Display Dataframe</span></button></a>

 </div>  
</div>

<script src="script1.js"></script>


   
   
 
</body>
</html>
      