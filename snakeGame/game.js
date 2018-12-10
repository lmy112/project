// 自調用函數--遊戲
(function () {
    let that = null
    // 遊戲構造函數
    function Game(map) {
        // 創建對象食物 小蛇 地圖
        this.food = new Food
        this.snake = new Snake
        this.map = map
        that = this
    }
    // 新增原型方法--初始化遊戲
    Game.prototype.init = function () {
        // 初始化食物 小蛇
        this.food.init(this.map)
        this.snake.init(this.map)
        this.runSnake(this.food, this.map)
        this.bindKey()
    }

    // 新增原型方法--小蛇自動移動
    Game.prototype.runSnake = function (food, map) {
        // 設置定時器
        let timeId = setInterval(function () {
            // 調用小蛇移動初始化方法
            this.snake.move(food, map)
            this.snake.init(map)

            // 設置地圖範圍
            let maxX = this.map.offsetWidth / this.snake.width
            let maxY = this.map.offsetHeight / this.snake.height

            // 獲取小蛇頭部座標
            let headX = this.snake.body[0].x
            let headY = this.snake.body[0].y

            // 判斷小蛇是否超出地圖
            if (headX < 0 || headX >= maxX) {
                // X超出地圖範圍 停止定時器
                clearInterval(timeId)
                alert('Game Over')
            }
            if (headY < 0 || headY >= maxY) {
                clearInterval(timeId)
                alert('Game Over')
            }
        }.bind(that), 150)
    }

    // 新增原型方法--用戶控制小蛇移動方向
    Game.prototype.bindKey = function () {
        // 註冊keydown事件
        document.addEventListener('keydown', function (e) {
            // 獲取用戶按下值
            switch (e.keyCode) {
                case 37:
                    this.snake.direction = 'left'
                    break
                case 38:
                    this.snake.direction = 'top'
                    break
                case 39:
                    this.snake.direction = 'right'
                    break
                case 40:
                    this.snake.direction = 'bottom'
                    break
            }
        }.bind(that), false)
    }
    window.Game = Game
}())