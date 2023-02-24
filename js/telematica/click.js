
function clickTel(d) {
    if (d.children && !d._children) {
        d._children = d.children;
        d.children = null;
        updateTel(d);
    } else if(!d.children && d._children){
        d.children = d._children;
        d._children = null;
        updateTel(d);
    } else if(d.hasChildren === 1){
        d.children = getChildrenTel(d);
        if(d.children.length > 0){
            this.marginTel = {top: 20, right: 120, bottom: 20, left: 120};
            this.widthTel = 1200 - this.marginTel.right - this.marginTel.left;
            this.heightTel = 1500 - this.marginTel.top - this.marginTel.bottom;
            
            this.iTel = 0;
            this.durationTel = 750;
            this.rootTel;

            this.treeTel = d3.layout.tree()
                .size([this.heightTel, this.widthTel]);

            this.diagonalTel = d3.svg.diagonal()
                .projection(function(d) { return [d.y, d.x]; });

            this.svgTel = d3.select("#collapseTel").append("svg")
                .attr("width", this.widthTel + this.marginTel.right + this.marginTel.left)
                .attr("height", this.heightTel + this.marginTel.top + this.marginTel.bottom)
            .append("g")
                .attr("transform", "translate(" + this.marginTel.left + "," + this.marginTel.top + ")");
                
            this.rootTel = treeDataTel[0];
            this.rootTel.x0 = this.heightTel / 2;
            this.rootTel.y0 = 0;

            updateTel(this.rootTel);

            d3.select(self.frameElement).style("height", "600px");
        }
    }
}