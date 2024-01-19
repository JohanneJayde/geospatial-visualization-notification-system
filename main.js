import "./style.css";
import EsriJSON from "ol/format/EsriJSON.js";
import Map from "ol/Map.js";
import VectorSource from "ol/source/Vector.js";
import View from "ol/View.js";
import { Circle, Fill, Stroke, Style } from "ol/style.js";
import Select from "ol/interaction/Select.js";
import { Tile as TileLayer, Vector as VectorLayer } from "ol/layer.js";
import { createXYZ } from "ol/tilegrid.js";
import { fromLonLat } from "ol/proj.js";
import { tile as tileStrategy } from "ol/loadingstrategy.js";
import Feature from "ol/Feature.js";
import OSM from "ol/source/OSM";
import Point from "ol/geom/Point.js";
import { click } from "ol/events/condition";
import { register } from "ol/proj/proj4";
import proj4 from "proj4";
import {getDistance} from "ol/sphere"

register(proj4);

/*
This is serviceUrl. It contains the live fire data that will be draw using open layers
*/
const serviceUrl =
  "https://services3.arcgis.com/T4QMspbfLg3qTGWY/arcgis/rest/services/" +
  "WFIGS_Incident_Locations_Current/FeatureServer/";
const layer = 0;

const vectorSource = new VectorSource({
  format: new EsriJSON(),
  url: function (extent, resolution, projection) {
    // ArcGIS Server only wants the numeric portion of the projection ID.
    const srid = projection
      .getCode()
      .split(/:(?=\d+$)/)
      .pop();

    const url =
      serviceUrl +
      layer +
      "/query/?f=json&" +
      "returnGeometry=true&spatialRel=esriSpatialRelIntersects&geometry=" +
      encodeURIComponent(
        '{"xmin":' +
          extent[0] +
          ',"ymin":' +
          extent[1] +
          ',"xmax":' +
          extent[2] +
          ',"ymax":' +
          extent[3] +
          ',"spatialReference":{"wkid":' +
          srid +
          "}}"
      ) +
      "&geometryType=esriGeometryEnvelope&inSR=" +
      srid +
      "&outFields=*" +
      "&outSR=" +
      srid;

    return url;
  },
  strategy: tileStrategy(
    createXYZ({
      tileSize: 512,
    })
  ),
  attributions: "National Interagency Fire Center",
});

const map = new Map({
  target: "map",
  layers: [
    new TileLayer({
      source: new OSM(),
      name: "Open Street Map",
    }),
    new VectorLayer({
      source: vectorSource,
      name: "Wildfire Data",
    }),
  ],
  view: new View({
    center: fromLonLat([-120.740135, 47.751076]),
    zoom: 7,
  }),
});

const addressPointStyle = new Style({
  image: new Circle({
    radius: 5,
    fill: new Fill({
      color: "#000000",
    }),
    stroke: new Stroke({
      color: "#00FF00",
      width: 1.25,
    }),
  }),
  zIndex: Infinity,
});

const wildfirePointStyle = new Style({
  image: new Circle({
    radius: 5,
    fill: new Fill({
      color: "#FFFFFF",
    }),
    stroke: new Stroke({
      color: "#FF0000",
      width: 1.25,
    }),
  }),
  zIndex: Infinity,
});

const selectedPoint = new Select({
  name: "wildfire-selct",
  style: null,
  condition: click,
  toggleCondition: click,
  layers: function (layer) {
    return layer.get("name") === "Wildfire Data";
  },
});

selectedPoint.on("select", function (e) {
  var selectCollection = selectedPoint.getFeatures().getArray();

  if (selectCollection.length === 2) {
    const old = selectCollection.shift();
    old.setStyle(null);
  }
  selectCollection[0].setStyle(wildfirePointStyle);

  document.getElementById("current-wildfire-selected").innerHTML =
    "Current Wilfire Selected: " + selectCollection[0].get("IncidentName");
});

map.addInteraction(selectedPoint);

var keys;
var pointContent = document.getElementById("selected-point-content");
var pointName = document.getElementById("selected-point-name");

//create function for getting wildfire details from clicking points on maps
var displayWildfireInfo = function (pixel) {
  var feature = map.forEachFeatureAtPixel(
    pixel,
    function (feature, layer) {
      return feature;
    },
    {
      layerFilter: function (layer) {
        return layer.get("name") === "Wildfire Data";
      },
    }
  );

  if (feature) {
    pointContent.innerHTML = "";
    pointName.innerHTML = "Name: ";
    keys = feature.getKeys();

    pointName.innerHTML += " " + feature.get("IncidentName");
    for (let i = 0; i < keys.length; i++) {
      pointContent.innerHTML += keys[i] + ": " + feature.get(keys[i]) + "<br>";
    }
  }
};

var displayAddressInfo = function (pixel) {
  var feature = map.forEachFeatureAtPixel(
    pixel,
    function (feature, layer) {
      return feature;
    },
    {
      layerFilter: function (layer) {
        return layer.get("name") === "plotted-points";
      },
    }
  );

  if (feature) {
    pointContent.innerHTML = "";
    keys = Object.entries(feature.get("data"));

    for (let [attribute, value] of keys) {
      pointContent.innerHTML += attribute + ": " + value + "<br>";
    }

    pointName.innerHTML = "Name: " + feature.get("data")["display_name"];
  }
};

var nonLayerPointDisplay = function (pixel) {
  var feature = map.forEachFeatureAtPixel(pixel, function (feature, layer) {
    return feature;
  });

  if (!feature) {
    pointContent.innerHTML = "NA";
    pointName.innerHTML = "Name: NA";
  }
};

map.on("singleclick", function (evt) {
  var pixel = evt.pixel;
  nonLayerPointDisplay(pixel);
  displayWildfireInfo(pixel);
  displayAddressInfo(pixel);
});

//create layers where adress points are used
const vectorLayer = new VectorLayer({
  name: "plotted-points",
  style: addressPointStyle,
});
vectorLayer.setSource(new VectorSource({}));

map.addLayer(vectorLayer);

var addAddressPoint = async function (event) {
  event.preventDefault();
  const formData = new FormData(event.target);
  const asString = new URLSearchParams(formData).toString();

  const data = await fetch(
    "https://nominatim.openstreetmap.org/search?" +
      asString +
      "&format=json&limit=1"
  )
    .then((response) => response.json())
    .then((json) => {
      return json;
    });

  if (data.length === 0) {
    return;
  }

  let plottedPoints = getMapLayer("plotted-points");

  plottedPoints.getSource().addFeature(
    new Feature({
      geometry: new Point(fromLonLat([data[0].lon, data[0].lat])),
      data: data[0],
    })
  );
};

// var structuredQueryForm = document.getElementById(
//   "structured-address-lookup-form"
// );
// structuredQueryForm.addEventListener("submit", addAddressPoint, true);

var freeFormQueryForm = document.getElementById(
  "free-form-address-lookup-form"
);
freeFormQueryForm.addEventListener("submit", addAddressPoint, true);

var calculateDistance = function () {
  const featureAddresses = getMapLayer("plotted-points").getSource()
  .getFeatures();

  const selectedWildfire = selectedPoint.getFeatures().getArray()[0];

  const wfCoords = getFeatureLonLat(selectedWildfire);


  featureAddresses.forEach((feature) => {
     const featCoords = getFeatureLonLat(feature);

    console.log(getDistance(wfCoords, featCoords ) * 0.00062137);
  }
      
  );
};

function getMapLayer(layerName){
  return map
  .getLayers()
  .getArray()
  .find((layer) => layer.get("name") == layerName)
}

function getFeatureLonLat(feature){
 return feature
    .getGeometry()
    .clone()
    .transform("EPSG:3857", "EPSG:4269")
    .getCoordinates();
}

document
  .getElementById("get-distance")
  .addEventListener("click", calculateDistance);
