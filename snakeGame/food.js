        // 自調用函數--食物方塊
        (function () {
            // 定義變量存儲小方塊
            let elements = []
            // 定義構造函數
            function Food(x, y, width, height, color) {
                // 食物屬性--位置寬高顏色
                // 預設值(0,0)20X20 yellow
                this.x = x || 0
                this.y = y || 0
                this.width = width || 20
                this.height = height || 20
                this.color = color || 'yellow'
            }
            // 食物在原型對象中(共享數據-節省空間)添加初始化(init)--作用--在頁面(map)顯示
            Food.prototype.init = function (map) {
                // 先清除
                remove()
                // 創建div(放小方塊)添加到map(父級元素)
                let div = document.createElement('div')
                map.appendChild(div)
                // 初始化寬高顏色
                div.style.width = this.width + 'px'
                div.style.height = this.height + 'px'
                div.style.backgroundColor = this.color
                // 脫離文檔流
                div.style.position = 'absolute'
                // 產生隨機座標
                this.x = parseInt(Math.random() * (map.offsetWidth / this.width)) * this.width
                this.y = parseInt(Math.random() * (map.offsetHeight / this.height)) * this.height
                // 初始化座標
                div.style.left = this.x + 'px'
                div.style.top = this.y + 'px'
                // 將div添加到element數組中
                elements.push(div)
            }
            // 私有函數--刪除方塊
            function remove() {
                // 遍歷數組找到方塊
                for (let i = 0; i < elements.length; i++) {
                    let ele = elements[i]
                    // 找到父級元素刪除子元素
                    ele.parentNode.removeChild(ele)
                    // 從數組中刪除
                    elements.splice(i, 1)
                }
            }
            // 暴露給全局使用
            window.Food = Food
        }())