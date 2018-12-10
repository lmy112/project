        // 自調用函數--小蛇
        (function () {
            let elements = []
            // 小蛇構造函數
            function Snake(width, height, direction) {
                // 身體每個小方塊寬高
                this.width = width || 20
                this.height = height || 20
                // 小蛇身體 頭 身體 身體
                this.body = [{
                        x: 3,
                        y: 2,
                        color: 'red'
                    },
                    {
                        x: 2,
                        y: 2,
                        color: 'orange'
                    },
                    {
                        x: 1,
                        y: 2,
                        color: 'orange'
                    }
                ]
                // 方向預設值右
                this.direction = direction || 'right'
            }
            // 在原型對象中添加初始化
            Snake.prototype.init = function (map) {
                remove()
                // 循環遍歷產生div加到map中
                for (let i = 0; i < this.body.length; i++) {
                    // 數組中每個元素都是一個對象
                    let obj = this.body[i]
                    let div = document.createElement('div')
                    map.appendChild(div)
                    // 設置div樣式(脫離文檔流設置寬高)
                    div.style.position = 'absolute'
                    div.style.width = this.width + 'px'
                    div.style.height = this.height + 'px'
                    // 橫縱座標
                    div.style.left = obj.x * this.width + 'px'
                    div.style.top = obj.y * this.height + 'px'
                    // 背景顏色
                    div.style.backgroundColor = obj.color
                    // 存放到數組中
                    elements.push(div)
                }
            }
            // 在原型對象中添加移動
            Snake.prototype.move = function (food, map) {
                // 身體
                let i = this.body.length - 1 // 2
                for (; i > 0; i--) {
                    // 將身體往前一個
                    this.body[i].x = this.body[i - 1].x
                    this.body[i].y = this.body[i - 1].y
                }
                // 頭 判斷方向
                switch (this.direction) {
                    case 'right':
                        this.body[0].x += 1
                        break
                    case 'left':
                        this.body[0].x -= 1
                        break
                    case 'top':
                        this.body[0].y -= 1
                        break
                    case 'bottom':
                        this.body[0].y += 1
                        break
                }
                // 判斷有沒有吃到方塊
                // 獲取小蛇頭部及方塊橫縱座標
                var headX = this.body[0].x * this.width
                var headY = this.body[0].y * this.height
                // 判斷 小蛇頭座標是否與方塊一致
                if (headX === food.x && headY === food.y) {
                    // 初始化方塊
                    food.init(map)
                    // 取得身體最後一個方塊
                    var last = this.body[this.body.length - 1]
                    // 增長身體
                    this.body.push({
                        x: last.x,
                        y: last.y,
                        color: last.color
                    })
                }
            }
            // 刪除小蛇
            function remove() {
                // 獲取數組
                let i = elements.length - 1
                // 倒循環從尾巴開始刪除
                for (; i >= 0; i--) {
                    let ele = elements[i]
                    // 找到子元素父級再刪除子元素
                    ele.parentNode.removeChild(ele)
                    // 清除數組
                    elements.splice(i, 1)
                }
            };
            // 暴露給全局使用
            window.Snake = Snake
        }())