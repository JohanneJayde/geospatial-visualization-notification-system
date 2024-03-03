<?php
  include('config.php');
  include("database.php"); 
  ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Fairchild Wildfire Notification System</title>
    <style>
      @import "node_modules/ol/ol.css";
    </style>
  <link rel="stylesheet" href="./map.css">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Libre+Franklin:ital,wght@0,100..900;1,100..900&display=swap');
  </style>
  </head>
  <body>
    <nav>
      <h1>Fairchild Airforce Base Wildfire Notification System Demo</h1>
    </nav>
    <div id="content">
      <div id="side-bar">
        <div id="user-info">
          <button id="plot-button">Plot Service Members</button>
          <button id="get-distance">Get Distances</button>
          <h3 id="selected-point-name">Name:</h3>

        </div>
        <div id="distance-report"></div>
      </div>
      <div id="map">
        <div id="info"></div>
      </div>
    </div>
    <script src="./map.js"></script>
  </body>
</html>
