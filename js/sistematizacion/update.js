
function updateSis(source) {

    // Compute the new tree layout.
    var nodes = this.treeSis.nodes(this.rootSis).reverse(),
        links = this.treeSis.links(nodes);

    // Normalize for fixed-depth.
    nodes.forEach(function(d) { d.y = d.depth * 180; });

    // Update the nodes…
    var node = svgSis.selectAll("g.node")
        .data(nodes, function(d) { return d.id || (d.id = ++iSis); });

    // Enter any new nodes at the parent's previous position.
    var nodeEnter = node.enter().append("g")
        .attr("class", "node")
        // .style("stroke", d => d.colornodo)
        .attr("transform", function(d) { return "translate(" + source.y0 + "," + source.x0 + ")"; })
        .on("click", clickSis);

    nodeEnter.append("circle")
        .attr("r", 1e-6)
        .style("stroke", d => d.colornodo)
        .style("fill", d => d.colornodo);




    nodeEnter.each(function(d){
        var thisNode = d3.select(this);
        // thisNode.style("fill", function(d) { return d._children.colornodo; });
        thisNode.style("fill", function(d) { return d.colornodo; });
        if (d.hasChildren === 0) {
            thisNode.append("a")
                .attr("xlink:href", function(d) { return d.link; })
                .append("text")
                    .attr("x", -10)
                    .attr("dy", -15)
                    .attr("text-anchor", "start")
                    .text(function(d) { return d.name; });
        } else {
            thisNode.append("text")
                .attr("x", "20")
                .attr("dy", -15)
                .attr("text-anchor", "end")
                .text(function(d) { return d.name; });      
        }
    });
    var nodeUpdate = node.transition()
        .duration(durationSis)
        .attr("transform", function(d) { return "translate(" + d.y + "," + d.x + ")"; });

    nodeUpdate.select("circle")
        .attr("r", 10)
        .style("fill", function(d) { return d._children ? "pink" : "#fff"; });

    nodeUpdate.select("text")
        .style("fill-opacity", 1);

    // Transition exiting nodes to the parent's new position.
    var nodeExit = node.exit().transition()
        .duration(durationSis)
        .attr("transform", function(d) { return "translate(" + source.y + "," + source.x + ")"; })
        .remove();

    nodeExit.select("circle")
        .attr("r", 1e-6);

    nodeExit.select("text")
        .style("fill-opacity", 1e-6);

    // Update the links…
    var link = svgSis.selectAll("path.link")
        // .style("fill", d => d.colornodo)
        .data(links, function(d) { return d.target.id; });

    // Enter any new links at the parent's previous position.
    link.enter().insert("path", "g")
        .attr("class", "link")
        .style("stroke", d => d.colornodo)
        .attr("d", function(d) {
            var o = {x: source.x0, y: source.y0};
            return diagonalSis({source: o, target: o});
        });

    // Transition links to their new position.
    link.transition()
        .duration(durationSis)
        .attr("d", diagonalSis);

    // Transition exiting nodes to the parent's new position.
    link.exit().transition()
        .duration(durationSis)
        .attr("d", function(d) {
            var o = {x: source.x, y: source.y};
            return diagonalSis({source: o, target: o});
        })
        .remove();

    // Stash the old positions for transition.
    nodes.forEach(function(d) {
        d.x0 = d.x;
        d.y0 = d.y;
    });
}