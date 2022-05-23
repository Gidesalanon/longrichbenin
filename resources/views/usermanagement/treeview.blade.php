<!DOCTYPE HTML>
<html>
<head>
<title>Longrich Bénin | Liste des Utilisateurs :: Admin</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Novus Admin Panel Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Bootstrap Core CSS -->
<link href="{{asset('css_admin/bootstrap.css')}}" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="{{asset('css_admin/style.css')}}" rel='stylesheet' type='text/css' />
<!-- font CSS -->
<!-- font-awesome icons -->
<link href="{{asset('css_admin/font-awesome.css')}}" rel="stylesheet">
<!-- //font-awesome icons -->
 <!-- js-->
<script src="{{asset('js_admin/jquery-1.11.1.min.js')}}"></script>
<script src="{{asset('js_admin/modernizr.custom.js')}}"></script>
<!--webfonts-->
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
<!--//webfonts-->
<!--animate-->
<link href="{{asset('css_admin/animate.css')}}" rel="stylesheet" type="text/css" media="all">
<script src="{{asset('js_admin/wow.min.js')}}"></script>
	<script>
		 new WOW().init();
	</script>
<!--//end-animate-->
<!-- Metis Menu -->
<script src="{{asset('js_admin/metisMenu.min.js')}}"></script>
<script src="{{asset('js_admin/custom.js')}}"></script>
<link href="{{asset('css_admin/custom.css')}}" rel="stylesheet">

<style>
	
.node {
    cursor: pointer;
}
.node circle {
    fill: #fff;
    stroke: steelblue;
    stroke-width: 1.5px;
}
.node text {
    font: 10px sans-serif;
}
.link {
    fill: none;
    stroke: #ccc;
    stroke-width: 1.5px;
}

</style>

<!--//Metis Menu -->
</head>
<body class="cbp-spmenu-push">
	<div class="main-content">
		<!--left-fixed -navigation-->
		@include('layouts.menu')
		<!--left-fixed -navigation-->
		<!-- header-starts -->
		@include('layouts.header')
		<!-- //header-ends -->
		<!-- main content start-->
		<div id="page-wrapper">
            <span class="col-md-10" style="text-align: left;">
                <h3 class="title1">Arbre généalogique de mon réseau</h3>
            </span>
            <span class="col-md-2" style="text-align: right;">
                <a href="/usermanagements" class="nav-badge-btm" title="Liste des utilisateurs">
                    <img src="{{asset('img/icons8-list.gif')}}" style="box-shadow: 5px 5px 5px gray; margin:0 5px; background-color: #fff; width: 30px; border-radius:20%"/>
                </a>
                <a href="{{ route('usermanagements.create') }}" class="nav-badge-btm" title="Ajouter un utilisateur">
                    <img src="{{asset('img/icons8-add.gif')}}" style="box-shadow: 5px 5px 5px gray; margin:0 5px; background-color: #fff; width: 30px; border-radius:20%"/>
                </a>
            </span>
			<div class="main-page">
				<div class="tables">
                    @if (session('message'))
                            <div class="alert alert-success" role="alert">
                                {{ session('message') }}
                            </div>
                    @endif
                    @forelse($enterprises as $enterprise)
					<div class="table-responsive bs-example widget-shadow" style="box-shadow: 5px 10px 10px gray; width: 100%;">
						<h4>{{$enterprise->designation}}</h4>
                
						<div id="treegraph"> </div>

					</div>
                    @empty
                        @include('usermanagement.ElseFile')
                    @endforelse

				</div>
			</div>
		</div>
		<!--footer-->
		@include('layouts.footer')
        <!--//footer-->
	</div>
	<!-- Classie -->
		<script src="{{asset('js_admin/classie.js')}}"></script>
	<!--scrolling js-->
	<script src="{{asset('js_admin/jquery.nicescroll.js')}}"></script>
	<script src="{{asset('js_admin/scripts.js')}}"></script>
	<!--//scrolling js-->
	<!-- Bootstrap Core JavaScript -->
	<script src="{{asset('js_admin/bootstrap.js')}}"> </script>
<script src="https://d3js.org/d3.v3.min.js" charset="utf-8"></script>

<script>
	var margin = {
		top: 20,
		right: 120,
		bottom: 20,
		left: 120
	},
	width = 960 - margin.right - margin.left,
	height = 800 - margin.top - margin.bottom;

	var root = <?php echo json_encode($users) ?>
	;

	var i = 0,
		duration = 750,
		rectW = 60,
		rectH = 30;

	var tree = d3.layout.tree().nodeSize([70, 40]);
	var diagonal = d3.svg.diagonal()
		.projection(function (d) {
		return [d.x + rectW / 2, d.y + rectH / 2];
	});

	var svg = d3.select("#treegraph").append("svg").attr("width", 1000).attr("height", 1000)
		.call(zm = d3.behavior.zoom().scaleExtent([1,3]).on("zoom", redraw)).append("g")
		.attr("transform", "translate(" + 350 + "," + 20 + ")");

	//necessary so that zoom knows where to zoom and unzoom from
	zm.translate([350, 20]);

	root.x0 = 0;
	root.y0 = height / 2;

	function collapse(d) {
		if (d.children) {
			d._children = d.children;
			d._children.forEach(collapse);
			d.children = null;
		}
	}

	root.children.forEach(collapse);
	update(root);

	d3.select("#treegraph").style("height", "800px");

	function update(source) {

		// Compute the new tree layout.
		var nodes = tree.nodes(root).reverse(),
			links = tree.links(nodes);

		// Normalize for fixed-depth.
		nodes.forEach(function (d) {
			d.y = d.depth * 180;
		});

		// Update the nodes…
		var node = svg.selectAll("g.node")
			.data(nodes, function (d) {
			return d.id || (d.id = ++i);
		});

		// Enter any new nodes at the parent's previous position.
		var nodeEnter = node.enter().append("g")
			.attr("class", "node")
			.attr("transform", function (d) {
			return "translate(" + source.x0 + "," + source.y0 + ")";
		})
			.on("click", click);

		nodeEnter.append("rect")
			.attr("width", rectW)
			.attr("height", rectH)
			.attr("stroke", "black")
			.attr("stroke-width", 1)
			.style("fill", function (d) {
			return d._children ? "lightsteelblue" : "#fff";
		});

		nodeEnter.append("text")
			.attr("x", rectW / 2)
			.attr("y", rectH / 2)
			.attr("dy", ".35em")
			.attr("text-anchor", "middle")
			.text(function (d) {
			return d.code;
		});

		// Transition nodes to their new position.
		var nodeUpdate = node.transition()
			.duration(duration)
			.attr("transform", function (d) {
			return "translate(" + d.x + "," + d.y + ")";
		});

		nodeUpdate.select("rect")
			.attr("width", rectW)
			.attr("height", rectH)
			.attr("stroke", "black")
			.attr("stroke-width", 1)
			.style("fill", function (d) {
			return d._children ? "lightsteelblue" : "#fff";
		});

		nodeUpdate.select("text")
			.style("fill-opacity", 1);

		// Transition exiting nodes to the parent's new position.
		var nodeExit = node.exit().transition()
			.duration(duration)
			.attr("transform", function (d) {
			return "translate(" + source.x + "," + source.y + ")";
		})
			.remove();

		nodeExit.select("rect")
			.attr("width", rectW)
			.attr("height", rectH)
		//.attr("width", bbox.getBBox().width)""
		//.attr("height", bbox.getBBox().height)
		.attr("stroke", "black")
			.attr("stroke-width", 1);

		nodeExit.select("text");

		// Update the links…
		var link = svg.selectAll("path.link")
			.data(links, function (d) {
			return d.target.id;
		});

		// Enter any new links at the parent's previous position.
		link.enter().insert("path", "g")
			.attr("class", "link")
			.attr("x", rectW / 2)
			.attr("y", rectH / 2)
			.attr("d", function (d) {
			var o = {
				x: source.x0,
				y: source.y0
			};
			return diagonal({
				source: o,
				target: o
			});
		});

		// Transition links to their new position.
		link.transition()
			.duration(duration)
			.attr("d", diagonal);

		// Transition exiting nodes to the parent's new position.
		link.exit().transition()
			.duration(duration)
			.attr("d", function (d) {
			var o = {
				x: source.x,
				y: source.y
			};
			return diagonal({
				source: o,
				target: o
			});
		})
			.remove();

		// Stash the old positions for transition.
		nodes.forEach(function (d) {
			d.x0 = d.x;
			d.y0 = d.y;
		});
	}

	// Toggle children on click.
	function click(d) {
		if (d.children) {
			d._children = d.children;
			d.children = null;
		} else {
			d.children = d._children;
			d._children = null;
		}
		update(d);
	}

	//Redraw for zoom
	function redraw() {
	//console.log("here", d3.event.translate, d3.event.scale);
	svg.attr("transform",
		"translate(" + d3.event.translate + ")"
		+ " scale(" + d3.event.scale + ")");
	}

</script>
</body>
</html>
