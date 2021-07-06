;
(function() {
    var Waterfall = function(opt) {
        this.el = document.getElementsByClassName(opt.el)[0];
        this.oItems = this.el.getElementsByTagName('div');
        this.colmun = opt.colmun;
        this.gap = opt.gap;
        this.itemWidth = (this.el.offsetWidth - (this.colmun - 1) * this.gap) / this.colmun;
        this.heightArr = [];
        this.init();
    }
    Waterfall.prototype.init = function() {
        this.render();
    }
    Waterfall.prototype.render = function() {
        var item = null,
            minIdx = -1;
        for (var i = 0; i < this.oItems.length; i++) {
            item = this.oItems[i];
            item.style.width = this.itemWidth + 'px';
            if (i < this.colmun) {
                item.style.top = '0px';
                item.style.left = i * (this.itemWidth + this.gap) + 'px';
                this.heightArr.push(item.offsetHeight);
            } else {
                var minIdx = getMinIdx(this.heightArr);
                item.style.left = this.oItems[minIdx].offsetLeft + 'px';
                item.style.top = this.heightArr[minIdx] + this.gap + 'px';
                console.log(this.heightArr);
                this.heightArr[minIdx] += item.offsetHeight + this.gap;
            }
        }
    }

    function getMinIdx(arr) {
        return arr.indexOf(Math.min.apply(null, arr));
    }
    window.Waterfall = Waterfall;
})();