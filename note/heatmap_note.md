
For heatmap.js     data type: JSON

var data = {
  max: 100,
  min: 0,
  dataPoints: [
    dataPoint, dataPoint, dataPoint, dataPoint
  ]
};

var dataPoints = [dataPoint, dataPoint, dataPoint, dataPoint];

var dataPoint = { 
  x: 5, // x coordinate of the datapoint, a number 
  y: 5, // y coordinate of the datapoint, a number
  value: 100 // the value at datapoint(x, y)
};

/////////////////////////////////////////////////////
Functions:

1.// a single datapoint
var dataPoint = { 
  x: 5, // x coordinate of the datapoint, a number 
  y: 5, // y coordinate of the datapoint, a number
  value: 100 // the value at datapoint(x, y)
};

heatmapInstance.addData(dataPoint);

// multiple datapoints (for data initialization use setData!!)
var dataPoints = [dataPoint, dataPoint, dataPoint, dataPoint];
heatmapInstance.addData(dataPoints);


2.// set data
var data = {
  max: 100,
  min: 0,
  data: [
    dataPoint, dataPoint, dataPoint, dataPoint
  ]
};
heatmapInstance.setData(data);


3.// get data
var currentData = heatmapInstance.getData();

// now let's create a new instance and set the data
var heatmap2 = h337.create(config);
heatmap2.setData(currentData); // now both heatmap instances have the same





