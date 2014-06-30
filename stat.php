<?php
require_once("config.php");
require_once("lib/init.php");
require_once("lib/lang.php");
include("header.php");
?>
<h2 class="top"><?php echo T_('Statistics'); ?></h2>
<?php
#"it,sl,jp,nb,ch"
function countSites() {
    $r = mysql_query("SELECT COUNT(DISTINCT referer) FROM updates") or die(mysql_error(). $q);
    list($num) = mysql_fetch_row($r);
    return $num;
}
function countUpdates() {
    $r = mysql_query("SELECT COUNT(*) FROM updates") or die(mysql_error(). $q);
    list($num) = mysql_fetch_row($r);
    return $num;
}

?>
<style>
    .numbs p {width: 360px;display: inline-block;text-align: center;}
    .numbs strong {display: block;
    font-size: 35px;
color: #E97A00;
margin-bottom: -13px;}
</style>
<div class="numbs">
<p>
    <?php
    echo sprintf(T_('<strong class="number">%d</strong> sites are using the Browser-Update.org script.'), number_format(floor(cache_output('countSites')),0,".", ""));
    ?>
</p>
<p>
    <?php
    echo sprintf(T_('<strong class="number">%d</strong> visitors have already upgraded their browser.'), number_format(floor(cache_output('countUpdates')),0,".", ""));
    ?>
</p>
</div>


<h1><?php echo T_('Browser updates'); ?></h1>

<?php
function getUpdatesJs() {
    $namesFrom = array("i"=>1,"f"=>2,"o"=>3,"s"=>4,"c"=>5,""=>0);
    $namesTo = array("i"=>1+6,"f"=>2+6,"o"=>3+6,"s"=>4+6,"c"=>5+6,""=>0+6);

    $q=mysql_query('SELECT fromn,ton,COUNT(*) as num FROM `updates` WHERE fromv<22 AND fromn!="n" AND ton!="n" AND time > UNIX_TIMESTAMP("2007-12-10") GROUP BY fromn, ton ORDER BY num DESC');
    $f=0;
    while ($a = mysql_fetch_assoc($q)) {
         if ($namesFrom[$a['fromn']]==0||$namesFrom[$a['fromn']]==0 || $a['num']<1000)
             continue;
         if ($f!=0) echo ",";
         $f=1;
         echo '{"source":'.$namesFrom[$a['fromn']].',"target":'.$namesTo[$a['ton']].',"value":'.$a['num'].'}';
     }

}
?>
<style>
.node rect {
  fill-opacity: .9;
  shape-rendering: crispEdges;
}
.link:hover {
  stroke-opacity: .5;
}
.node text {
  text-shadow: none;pointer-events: none;
  font-family: 'Open Sans', sans-serif;
}
.link {
  fill: none;
  stroke: #000;
  stroke: url(#grad1);
  stroke-opacity: 0.3;
}
.hnode {
  position: absolute;
  background-position: center center;
  background-repeat: no-repeat;
  opacity: 0.3;
  background-size: 120px;
    filter: url("data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\'><filter id=\'grayscale\'><feColorMatrix type=\'matrix\' values=\'0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0 0 0 1 0\'/></filter></svg>#grayscale"); /* Firefox 10+, Firefox on Android */
    filter: gray; /* IE6-9 */
    -webkit-filter: grayscale(100%); /* Chrome 19+, Safari 6+, Safari 6+ iOS */

}
#chart {
  height: 500px;
  position:relative;
}
</style>
<script>
var data={
"nodes":[
{"name":" "},{"name":"IE"},{"name":"Firefox"},{"name":"Opera"},{"name":"Safari"},{"name":"Chrome"},
{"name":" "},{"name":"IE"},{"name":"Firefox"},{"name":"Opera"},{"name":"Safari"},{"name":"Chrome"}
],
"links": [
    <?php echo cache_output('getUpdatesJs')?>
]
};
</script>
<div id="chart"></div>

<script src="http://d3js.org/d3.v2.min.js?2.9.1"></script>
<script src="sankey.js"></script>


<script>

var margin = {top: 1, right: 1, bottom: 6, left: 1},
    width = 700 - margin.left - margin.right,
    height = 500 - margin.top - margin.bottom;

var format = function(d) { return d; };
var    colors = {"IE":"#6D95B9"/*"#00CCFF"*/,"Firefox":"#F2951F","Opera":"#CC0F16",Safari: "#2abce0","Chrome":"#4CB849"};
var    bs = {"IE":"ie","Firefox":"ff","Opera":"op",Safari:"sa","Chrome":"ch"};

var svg = d3.select("#chart").append("svg")
    .attr("width", width + margin.left + margin.right)
    .attr("height", height + margin.top + margin.bottom)
  .append("g")
    .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

var defs = svg.append( 'defs' );
var grad = defs.append( 'linearGradient' )
                                   .attr( 'id', 'grad1' )
                                   .attr( 'x1', '0' )
                                   .attr( 'x2', '1' )
                                   .attr( 'y1', '0' )
                                   .attr( 'y2', '0' );
grad.append( 'stop' ).attr( 'class', 'grad1Stop1' ).attr( 'offset', '1%' );
grad.append( 'stop' ).attr( 'class', 'grad1Stop2' ).attr( 'offset', '100%' );


var elc = d3.select("#chart");

var sankey = d3.sankey()
    .nodeWidth(55)
    .nodePadding(10)
    .size([width, height]);

var path = sankey.link();


function run(data) {
  sankey
      .nodes(data.nodes)
      .links(data.links)
      .layout(32);

  var link = svg.append("g").selectAll(".link")
      .data(data.links)
    .enter().append("path")
      .attr("class", "link")
      .attr("d", path)
      .style("stroke-width", function(d) { return Math.max(1, d.dy); })
      .style("stroke", function(d) { return d.color = colors[d.source.name]; })
      //.style("stroke","url(#grad1)")
      //.style("stroke","")
      .style("stroke-opacity", "")
      .sort(function(a, b) { return b.dy - a.dy; });

  link.append("title")
      .text(function(d) { return d.source.name + " → " + d.target.name + "\n" + format(d.value); });

  var node = svg.append("g").selectAll(".node")
      .data(data.nodes)
    .enter().append("g")
      .attr("class", "node")
      .attr("transform", function(d) { return "translate(" + d.x + "," + d.y + ")"; });

  node.append("rect")
      .attr("height", function(d) { return d.dy; })
      .attr("width", sankey.nodeWidth())
      .style("fill", function(d) { return d.color = colors[d.name]; })      
    .append("title")
      .text(function(d) { return d.name + " "+ d.value; });
      
 /* var hnode = elc.selectAll(".hnode")
      .data(data.nodes)
      .enter().append("div")
      .attr("class", "hnode")
      .style("left", function(d) { return d.x +"px";})      
      .style("top", function(d) { return d.y+"px";})
      .style("height", function(d) { return d.dy+"px"; })
      .style("width", sankey.nodeWidth()+"px");
      //.style("background-color", function(d) { return d.color = colors[d.name]; })      
      //.style("background-image", function(d) { if (d.dy>50) return "url(../img/big/"+bs[d.name]+ ".png)"})      
*/
  node.append("text")
      .attr("x", -6)
      .attr("y", function(d) { return d.dy / 2; })
      .attr("dy", ".45em")
      .attr("text-anchor", "end")
      .attr("transform", null)
      .text(function(d) { return d.name; })
    .filter(function(d) { return d.x < width / 2; })
      .attr("x", 6 + sankey.nodeWidth())
      .attr("text-anchor", "start");
}
run(data);

</script>














<div style="height: 40px"></div>
<table>
    <thead><tr><td><?php echo T_('From'); ?></td><td><?php echo T_('To'); ?></td><td></td></tr></thead>
    <tbody>
<?php
function browserMigration() {
    $names = array(
            "i"=>'Internet Explorer',
            "f"=>'Firefox',
            "o"=>'Opera',
            "s"=>'Safari',
            "n"=>'Netscape',
            "c"=>'Chrome',
            ""=>'?'
    );
    $q=mysql_query('SELECT fromn,ton,COUNT(*) as num FROM `updates` WHERE fromv<22 GROUP BY fromn, ton HAVING num>1000 ORDER BY num DESC');
     while ($a = mysql_fetch_assoc($q)) {
         if ($names[$a['fromn']]==""||$names[$a['fromn']]=="?")
             continue;
         echo '<tr><td>'.$names[$a['fromn']].'</td><td>'.$names[$a['ton']].'</td><td>'.$a['num'].'</td></tr>';
     }
}
echo cache_output('browserMigration');
?>
    </tbody>
</table>


<?php include("footer.php");?>
