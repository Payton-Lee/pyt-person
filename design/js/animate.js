window.onload = function () {
    var pre = document.getElementById('pre'); // 上一张
    var nex = document.getElementById('nex'); // 下一张
    var list = document.getElementById('navs'); // 轮播图
    var bots = document.getElementById('bots'); // 小圆点
    var box = document.getElementById('box'); // 最外层容器用来判断鼠标移入移除停止自动轮播
    var index = 0; // 记录当前小圆点下标
    var isanimate = true; // 是否自动播放
    var interval; // 自动播放定时器
    var disable = true; // 用来控制快速点击导致页面错乱
    //初始化小圆点
    for (let i = 0; i < list.children.length - 2; i++) {
        let li = document.createElement('li')
        bots.appendChild(li)
    }
    bots.children[0].className = 'active' // 默认第一个为初始圆点高亮
    // 上一张
    pre.onclick = function () {
        if(disable){
            disable = false // 这里设置为false表示进入切换动画未完成时就不能点击
            index--;  // 小圆点下标--
            changebots() //改变高亮
            animate(1200) // 切换轮播图动画
        }

    }
    // 下一张
    nex.onclick = function () {
        if(disable){
            disable = false
            index++;
            changebots()
            animate(-1200)
        }
    }
    // 改变圆点高亮
    function changebots() {
        if (index < 0) {  // 如果小于0图片到最后一张高亮也对应到最后一个圆点
            index = 4
        }
        else if (index > 4) { // 如果大于于4图片到第一张一张高亮也对应到第一个圆点
            index = 0
        }
        for (let i = 0; i < bots.children.length; i++) {
            bots.children[i].className = ''
        }
        bots.children[index].className = 'active'
    }
    // 图片切换动画
    function animate(offset) {
        let newLeft = parseInt(list.style.left) + offset;  // 下一张轮播图应该位移到的位置
        let interval = 10;  // 图片位移的时间
        let speed = (offset / 10) / 3 //每10ms移动的位置这里是设置20px 这里可以根据自己需求改动
        // 自动轮播小圆点自动切换
        if (isanimate) {
            index++;
            changebots(index)
        }

        // 利用定时器递归的模拟动画效果切换图片
        function change() {
            if (parseInt(list.style.left) === -7200) {
                list.style.left = -1200 + 'px'
                newLeft = -2400
            }
            if (parseInt(list.style.left) > 0) {
                list.style.left = -6000 + 'px'
                newLeft = -4800
            }
            this.timer = setTimeout(() => {
                list.style.left = list.offsetLeft + speed + 'px'
                if (parseInt(list.style.left) != newLeft) { // 判断是否到了应该到的位移位置，到达就清除计时器停止递归
                    change()
                } else {
                    clearTimeout(this.timer)
                    disable = true //动画完成进行下一次点击
                    console.log(disable)
                    console.log(list.style.left)
                }
            }, interval)
        }
        change()

    }

    // 小圆点切换
    bots.onclick = function (ev) {
        var ev = ev || window.event;
        let target = ev.target || ev.srcElement;
        if (target.nodeName.toLowerCase() == 'li') {
            for (let i = 0; i < bots.children.length; i++) {
                if (bots.children[i] === target) {
                    index = i;
                    console.log(index)
                    break;
                }
            }
            changebots() // 切换下标
            list.style.left = ((index + 1) * -1200) + 'px' // 切换轮播图
        }

    }
    // 自动轮播
    function autoplay() {
        interval = setInterval(() => {
            animate(-1200)
        }, 2000)
    }

    // 鼠标移入停止自动轮播
    box.onmouseover = function () {
        isanimate = false
        console.log('in')
        clearInterval(interval)
    }
    //鼠标移出开始轮播
    box.onmouseleave = function () {
        isanimate = true
        autoplay()
        console.log('out')
    }
    autoplay()
}