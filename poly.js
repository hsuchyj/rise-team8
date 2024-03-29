/*********************************************************************\
*                                                                     *
* epolys.js                                          by Mike Williams *
*                                                                     *
* A Google Maps API Extension                                         *
*                                                                     *
* Adds various Methods to GPolygon and GPolyline                      *
*                                                                     *
* .Contains(latlng) returns true is the poly contains the specified   *
*                   GLatLng                                           *
*                                                                     *
* .Area()           returns the approximate area of a poly that is    *
*                   not self-intersecting                             *
*                                                                     *
* .Distance()       returns the length of the poly path               *
*                                                                     *
* .Bounds()         returns a GLatLngBounds that bounds the poly      *
*                                                                     *
* .GetPointAtDistance() returns a GLatLng at the specified distance   *
*                   along the path.                                   *
*                   The distance is specified in metres               *
*                   Reurns null if the path is shorter than that      *
*                                                                     *
* .GetPointsAtDistance() returns an array of GLatLngs at the          *
*                   specified interval along the path.                *
*                   The distance is specified in metres               *
*                                                                     *
* .GetIndexAtDistance() returns the vertex number at the specified    *
*                   distance along the path.                          *
*                   The distance is specified in metres               *
*                   Reurns null if the path is shorter than that      *
*                                                                     *
* .Bearing(v1?,v2?) returns the bearing between two vertices          *
*                   if v1 is null, returns bearing from first to last *
*                   if v2 is null, returns bearing from v1 to next    *
*                                                                     *
*                                                                     *
***********************************************************************
*                                                                     *
*   This Javascript is provided by Mike Williams                      *
*   Community Church Javascript Team                                  *
*   http://www.bisphamchurch.org.uk/                                  *
*   http://econym.org.uk/gmap/                                        *
*                                                                     *
*   This work is licenced under a Creative Commons Licence            *
*   http://creativecommons.org/licenses/by/2.0/uk/                    *
*                                                                     *
***********************************************************************
*                                                                     *
* Version 1.1       6-Jun-2007                                        *
* Version 1.2       1-Jul-2007 - fix: Bounds was omitting vertex zero *
*                                add: Bearing                         *
* Version 1.3       28-Nov-2008  add: GetPointsAtDistance()           *
* Version 1.4       12-Jan-2009  fix: GetPointsAtDistance()           *
*                                                                     *
* Version 2.0       6-Jun-2007   Go Faster (but use more memory)      *
* Version 2.1       26-Aug-2009  fix: GPOlyline.Store()               *
*                                                                     *
\*********************************************************************/

// === Store information that we often need
// === so that we don't keep recalculating it.
GPolygon.prototype.Store = function() {
  if (this._EPoly) {return;}
  this._EPoly = {};
  this._EPoly.Bounds = this.getBounds();
  this._EPoly.Lats = [];
  this._EPoly.Lngs = [];
  this._EPoly.Points = [];
  this._EPoly.Length = this.getVertexCount();
  for (var i=0; i<this._EPoly.Length; i++) {
    var p = this.getVertex(i);
    this._EPoly.Lats[i] = p.lat();
    this._EPoly.Lngs[i] = p.lng();
    this._EPoly.Points[i] = p;
  }
}

// === A method for testing if a point is inside a polygon
// === Returns true if poly contains point
// === Algorithm shamelessly stolen from http://alienryderflex.com/polygon/ 
GPolygon.prototype.Containz = function(point) {
  if (!this._EPoly) {this.Store();}
  if (!this._EPoly.Bounds.containsLatLng(point)) {return false;}
  var j=0;
  var oddNodes = false;
  var x = point.lng();
  var y = point.lat();
  for (var i=0; i < this._EPoly.Length; i++) {
    j++;
    if (j == this._EPoly.Length) {j = 0;}
    if (((this._EPoly.Lats[i] < y) && (this._EPoly.Lats[j] >= y))
    || ((this._EPoly.Lats[j] < y) && (this._EPoly.Lats[i] >= y))) {
      if ( this._EPoly.Lngs[i] + (y - this._EPoly.Lats[i])
      /  (this._EPoly.Lats[j]-this._EPoly.Lats[i])
      *  (this._EPoly.Lngs[j] - this._EPoly.Lngs[i])<x ) {
        oddNodes = !oddNodes
      }
    }
    }
    console.log("dog");
  return oddNodes;
}

// === A method which returns the approximate area of a non-intersecting polygon in square metres ===
// === It doesn't fully account for spherical geometry, so will be inaccurate for large polygons ===
// === The polygon must not intersect itself ===
GPolygon.prototype.Area = function() {
  if (!this._EPoly) {this.Store();}
  if (this._EPoly.Area) {return this._EPoly.Area;}
  var a = 0;
  var j = 0;
  var b = this.getBounds();
  var x0 = b.getSouthWest().lng();
  var y0 = b.getSouthWest().lat();
  for (var i=0; i < this.getVertexCount(); i++) {
    j++;
    if (j == this.getVertexCount()) {j = 0;}
    var x1 = this._EPoly.Points[i].distanceFrom(new GLatLng(this._EPoly.Lats[i],x0));
    var x2 = this._EPoly.Points[j].distanceFrom(new GLatLng(this._EPoly.Lats[j],x0));
    var y1 = this._EPoly.Points[i].distanceFrom(new GLatLng(y0,this._EPoly.Lngs[i]));
    var y2 = this._EPoly.Points[j].distanceFrom(new GLatLng(y0,this._EPoly.Lngs[j]));
    a += x1*y2 - x2*y1;
  }
  this._EPoly.Area = Math.abs(a * 0.5);
  return Math.abs(a * 0.5);
}

// === A method which returns the length of a path in metres ===
GPolygon.prototype.Distance = function() {
  if (!this._EPoly) {this.Store();}
  var dist = 0;
  for (var i=1; i < this.getVertexCount(); i++) {
    dist += this._EPoly.Points[i].distanceFrom(this.getVertex(i-1));
  }
  return dist;
}

// === A method which returns the bounds as a GLatLngBounds ===
// === Use the API call, which is faster ===
GPolygon.prototype.Bounds = function() {
  return this.getBounds();
}



// === A method which returns a GLatLng of a point a given distance along the path ===
// === Returns null if the path is shorter than the specified distance ===
GPolygon.prototype.GetPointAtDistance = function(metres) {
  if (!this._EPoly) {this.Store();}
  // some awkward special cases
  if (metres == 0) return this._EPoly.Points[0];
  if (metres < 0) return null;
  var dist=0;
  var olddist=0;
  for (var i=1; (i < this._EPoly.Length && dist < metres); i++) {
    olddist = dist;
    dist += this._EPoly.Points[i].distanceFrom(this._EPoly.Points[i-1]);
  }
  if (dist < metres) {return null;}
  var p1= this._EPoly.Points[i-2];
  var p2= this._EPoly.Points[i-1];
  var m = (metres-olddist)/(dist-olddist);
  return new GLatLng( p1.lat() + (p2.lat()-p1.lat())*m, p1.lng() + (p2.lng()-p1.lng())*m);
}

// === A method which returns an array of GLatLngs of points a given interval along the path ===
GPolygon.prototype.GetPointsAtDistance = function(metres) {
  if (!this._EPoly) {this.Store();}
  var next = metres;
  var points = [];
  // some awkward special cases
  if (metres <= 0) return points;
  var dist=0;
  var olddist=0;
  for (var i=1; (i < this._EPoly.Length); i++) {
    olddist = dist;
    dist += this._EPoly.Points[i].distanceFrom(this.getVertex(i-1));
    while (dist > next) {
      var p1= this._EPoly.Points[i-1];
      var p2= this._EPoly.Points[i];
      var m = (next-olddist)/(dist-olddist);
      points.push(new GLatLng( p1.lat() + (p2.lat()-p1.lat())*m, p1.lng() + (p2.lng()-p1.lng())*m));
      next += metres;    
    }
  }
  return points;
}

// === A method which returns the Vertex number at a given distance along the path ===
// === Returns null if the path is shorter than the specified distance ===
GPolygon.prototype.GetIndexAtDistance = function(metres) {
  if (!this._EPoly) {this.Store();}
  // some awkward special cases
  if (metres == 0) return this.getVertex(0);
  if (metres < 0) return null;
  var dist=0;
  var olddist=0;
  for (var i=1; (i < this._EPoly.Length && dist < metres); i++) {
    olddist = dist;
    dist += this._EPoly.Points[i].distanceFrom(this._EPoly.Points[i-1]);
  }
  if (dist < metres) {return null;}
  return i;
}

// === A function which returns the bearing between two vertices in decgrees from 0 to 360===
// === If v1 is null, it returns the bearing between the first and last vertex ===
// === If v1 is present but v2 is null, returns the bearing from v1 to the next vertex ===
// === If either vertex is out of range, returns void ===
GPolygon.prototype.Bearing = function(v1,v2) {
  if (v1 == null) {
    v1 = 0;
    v2 = this.getVertexCount()-1;
  } else if (v2 ==  null) {
    v2 = v1+1;
  }
  if ((v1 < 0) || (v1 >= this.getVertexCount()) || (v2 < 0) || (v2 >= this.getVertexCount())) {
    return;
  }
  var from = this.getVertex(v1);
  var to = this.getVertex(v2);
  if (from.equals(to)) {
    return 0;
  }
  var lat1 = from.latRadians();
  var lon1 = from.lngRadians();
  var lat2 = to.latRadians();
  var lon2 = to.lngRadians();
  var angle = - Math.atan2( Math.sin( lon1 - lon2 ) * Math.cos( lat2 ), Math.cos( lat1 ) * Math.sin( lat2 ) - Math.sin( lat1 ) * Math.cos( lat2 ) * Math.cos( lon1 - lon2 ) );
  if ( angle < 0.0 ) angle  += Math.PI * 2.0;
    angle = angle * 180.0 / Math.PI;

  return parseFloat(angle.toFixed(1));
}


GPolygon.prototype.changeColor = function (wow) {
    this.a.fillColor = "red";
    //myPolygon.setOptions({ strokeWeight: 6.0 });
		console.log(this);
}




// === Copy all the above functions to GPolyline ===
GPolyline.prototype.Store                = GPolygon.prototype.Store;
GPolyline.prototype.Containz             = GPolygon.prototype.Containz;
GPolyline.prototype.Area                 = GPolygon.prototype.Area;
GPolyline.prototype.Distance             = GPolygon.prototype.Distance;
GPolyline.prototype.Bounds               = GPolygon.prototype.Bounds;
GPolyline.prototype.GetPointAtDistance   = GPolygon.prototype.GetPointAtDistance;
GPolyline.prototype.GetPointsAtDistance  = GPolygon.prototype.GetPointsAtDistance;
GPolyline.prototype.GetIndexAtDistance   = GPolygon.prototype.GetIndexAtDistance;
GPolyline.prototype.Bearing              = GPolygon.prototype.Bearing;
GPolyline.prototype.changeColor = GPolygon.prototype.changeColor;
