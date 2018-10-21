<! DOCTYPE html>
<charset meta = "UTF-8">

<!--ESTILOS-->
<style>
 path {
   stroke: white;
   stroke-width: 0.25px;
   fill: grey;
 }
</style>

<body>

<!--JAVASCRIPT-->
	<script type="text/javascript" src="http://d3js.org/d3.v3.min.js"></script>
	<script src="http://d3js.org/topojson.v0.min.js"></script>
	<script>
		<!--tamaño mapa-->
		var width = 1000,
			height = 500;
		<!--mapa en pantalla-->
		var projection = d3.geo.mercator()
			.center([0, 50 ])
			.scale(100)
			.rotate([0,0]);
		<!--fijar ventana svg-->
		var svg = d3.select("body").append("svg")
			.attr("width", width)
			.attr("height", height);
		<!--generador de ruta geo, especifica/define proyeccion-->
		var path = d3.geo.path()
			.projection(projection);
		<!--definimos variable como svg adjunto-->
		var g = svg.append ("g");
		<!--dibujamos el mapa-->
			<!--llamamos a nuestro archivo de coordenadas world-110m.json-->
		d3.json("world-110m.json", function(error, topology) {
			<!--declaramos que vamos a actuar en todos los elementos path en el graf-->
			g.selectAll("path") 
			<!--seleccionamos los datos deseados-->
				.data(topojson.object(topology, topology.objects.countries) 
			.geometries)
			<!--los anadimos como datos a visualizar-->
			.enter()
			<!--los anadimos como elementos path-->
				.append("path") 
				.attr("d", path) 
		});
		
</script>
</body>
</html>