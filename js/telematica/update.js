
function updateTel(source) {

    // Compute the new tree layout.
    var nodesTel = this.treeTel.nodes(this.rootTel).reverse(),
        linksTel = this.treeTel.links(nodesTel);

    // Normalize for fixed-depth.
    nodesTel.forEach(function(d) { d.y = d.depth * 180; });

    // Update the nodes…
    var nodeTel = svgTel.selectAll("g.node")
        .data(nodesTel, function(d) { return d.id || (d.id = ++iTel); });

    // Enter any new nodes at the parent's previous position.
    var nodeEnterTel = nodeTel.enter().append("g")
        .attr("class", "node")
        // .style("stroke", d => d.colornodo)
        .attr("transform", function(d) { return "translate(" + source.y0 + "," + source.x0 + ")"; })
        .on("click", clickTel);

    nodeEnterTel.append("circle")
        .attr("r", 1e-6)
        .style("stroke", d => d.colornodo)
        .style("fill", d => d.colornodo);

    nodeEnterTel.each(function(d){
        var thisNodeTel = d3.select(this);
        // thisNodeTel.style("fill", function(d) { return d._children.colornodo; });
        thisNodeTel.style("fill", function(d) { return d.colornodo; });
        if (d.hasChildren === 0) {
            thisNodeTel.append("a")
                .attr("xlink:href", function(d) { return d.link; })
                .append("text")
                    .attr("x", -10)
                    .attr("dy", -15)
                    .attr("text-anchor", "start")
                    .text(function(d) { return d.name; });
        } else {
            thisNodeTel.append("text")
                .attr("x", "20")
                .attr("dy", -15)
                .attr("text-anchor", "end")
                .text(function(d) { return d.name; });      
        }
    });
    var nodeUpdateTel = nodeTel.transition()
        .duration(durationTel)
        .attr("transform", function(d) { return "translate(" + d.y + "," + d.x + ")"; });

    nodeUpdateTel.select("circle")
        .attr("r", 10)
        .style("fill", function(d) { return d._children ? "pink" : "#fff"; });

    nodeUpdateTel.select("text")
        .style("fill-opacity", 1);

    // Transition exiting nodes to the parent's new position.
    var nodeExitTel = nodeTel.exit().transition()
        .duration(durationTel)
        .attr("transform", function(d) { return "translate(" + source.y + "," + source.x + ")"; })
        .remove();

    nodeExitTel.select("circle")
        .attr("r", 1e-6);

    nodeExitTel.select("text")
        .style("fill-opacity", 1e-6);

    // Update the links…
    var linkTel = svgTel.selectAll("path.link")
        // .style("fill", d => d.colornodo)
        .data(linksTel, function(d) { return d.target.id; });

    // Enter any new links at the parent's previous position.
    linkTel.enter().insert("path", "g")
        .attr("class", "link")
        .style("stroke", d => d.colornodo)
        .attr("d", function(d) {
            var o = {x: source.x0, y: source.y0};
            return diagonalTel({source: o, target: o});
        });

    // Transition links to their new position.
    linkTel.transition()
        .duration(durationTel)
        .attr("d", diagonalTel);

    // Transition exiting nodes to the parent's new position.
    linkTel.exit().transition()
        .duration(durationTel)
        .attr("d", function(d) {
            var o = {x: source.x, y: source.y};
            return diagonalTel({source: o, target: o});
        })
        .remove();

    // Stash the old positions for transition.
    nodesTel.forEach(function(d) {
        d.x0 = d.x;
        d.y0 = d.y;
    });
}