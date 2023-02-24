
function clickSis(d) {
    if (d.children && !d._children) {
        d._children = d.children;
        d.children = null;
        updateSis(d);
    } else if(!d.children && d._children){
        d.children = d._children;
        d._children = null;
        updateSis(d);
    } else if(d.hasChildren === 1){
        d.children = getChildrenSis(d);
        if(d.children.length > 0){
            this.marginSis = {top: 20, right: 120, bottom: 20, left: 120};
            this.widthSis = 1200 - this.marginSis.right - this.marginSis.left;
            this.heightSis = 1500 - this.marginSis.top - this.marginSis.bottom;
            
            this.iSis = 0;
            this.durationSis = 750;
            this.rootSis;

            this.treeSis = d3.layout.tree()
                .size([this.heightSis, this.widthSis]);

            this.diagonalSis = d3.svg.diagonal()
                .projection(function(d) { return [d.y, d.x]; });

            this.svgSis = d3.select("#collapseSis").append("svg")
                .attr("width", this.widthSis + this.marginSis.right + this.marginSis.left)
                .attr("height", this.heightSis + this.marginSis.top + this.marginSis.bottom)
            .append("g")
                .attr("transform", "translate(" + this.marginSis.left + "," + this.marginSis.top + ")");
                
            this.rootSis = treeDataSis[0];
            this.rootSis.x0 = this.heightSis / 2;
            this.rootSis.y0 = 0;

            updateSis(this.rootSis);

            d3.select(self.frameElement).style("height", "600px");
        }
    }
}