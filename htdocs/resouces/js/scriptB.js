$(document).ready(function () {
    goodArr = []
    chartObj = {}
    chartData()
    goods()
    edit()
})

function chartData() {
    fetch('./resouces/json/visitors.json')
    .then(response => response.json())
    .then(data => {
        chartObj = data.data
        cha()
    })
    .catch(error => console.error(error))
}

function cha() {
    const canvas = document.querySelector('#chart')
    const ctx = canvas.getContext('2d')
    let league = '나이트리그'
    let widthAndHeight = '세로로 보기'
    let day = '월'
    date()
    line()

    $('#day').on('change', function () {
        day = $('#day').val()
        date()
        line()
    })

    const handleClick = (target) => {
        return () => {
            league = target
            date()
            line()
        }
    }

    const viewClick = (target) => {
        return () => {
            widthAndHeight = target
            date()
            line()
        }
    }

    $('#night').on('click', handleClick('나이트리그'))
    $('#weekend').on('click', handleClick('주말리그'))
    $('#dawn').on('click', handleClick('새벽리그'))

    $('#length').on('click', viewClick('세로로 보기'))
    $('#width').on('click', viewClick('가로로 보기'))

    $('#length').click()

    function date() {
        let vis = chartObj.find((item) => item.name == league).visitors
        let vir = vis.find((item) => item.day == day).visitor
        let key = Object.keys(vir)
        let val = Object.values(vir)
        inText(key, val)
    }

    function line() {
        ctx.moveTo(80, 0)
        ctx.lineTo(80, canvas.height - 80)
        ctx.moveTo(canvas.width, canvas.height)
        ctx.stroke()
        ctx.moveTo(80, canvas.height - 80)
        ctx.lineTo(canvas.width, canvas.height - 80)
        ctx.stroke()
    }

    function inText(key, val) {
        ctx.clearRect(0, 0, canvas.width, canvas.height)
        val.forEach((item, index) => {
            if (widthAndHeight == '세로로 보기') {
                ctx.fillStyle = '#ff6600'
                height(150 * (index + 1), canvas.width - item - 80, 100, item, 1000)
            } else if (widthAndHeight == '가로로 보기') {
                ctx.fillStyle = '#4f4f4f'
                if (canvas.width - item - 80 == -130) {
                    width(80, 120 * (index + 1), canvas.width, 100, 1000)
                } else {
                    width(80, 120 * (index + 1), canvas.width - canvas.width + item + 10, 100, 1000)
                }
            }
        })

        key.forEach((item, index) => {
            if (widthAndHeight == '세로로 보기') {
                ctx.font = 'bold 18px "맑은 고딕", sans-serif'
                ctx.fillStyle = '#4f4f4f'
                ctx.fillText(item, (index += 1) * 180, canvas.height - 30)
            } else if (widthAndHeight == '가로로 보기') {
                ctx.font = 'bold 15px "맑은 고딕", sans-serif'
                ctx.fillStyle = '#4f4f4f'
                ctx.fillText(item, 40, (index += 1) * 150)
            }
        })

        if (widthAndHeight == '세로로 보기') {
            let top = 30
            for (i = 0; i <= 500; i += 50) {
                ctx.textAlign = 'center'
                ctx.fillText(i, 30, canvas.height - top - 45)
                top += 50
            }
        } else if (widthAndHeight == '가로로 보기') {
            let top = 30
            for (i = 0; i <= 500; i += 50) {
                ctx.fillText(i, top + 50, canvas.height - 30)
                top += 50
            }
        }
    }

    function height(x, y, width, height, duration) {
        let current = 0
        const step = height / (duration / 16)
        function animate() {
            ctx.fillRect(x, y + (height - current), width, current)
            current += step
            if (current < height) {
                requestAnimationFrame(animate)
            }
        }
        animate()
    }

    function width(x, y, width, height, duration) {
        let current = 0
        const step = width / (duration / 16)
        function animate() {
            ctx.fillRect(x, y, current, height)
            current += step
            if (current < width) {
                requestAnimationFrame(animate)
            }
        }
        animate()
    }
}

// 데이터 뿌리기
function goods() {
    fetch('./resouces/json/goods.json')
    .then(response => response.json())
    .then(data => {
        data.data.forEach(item => {
            goodArr.push(item)
        })
        sale()
    })
    .catch(error => console.error('Error:', error))
}

// 카테고리 정렬함수
function sale() {
    let changeSelect = "all"
    let sortName = "all"
    let sortBy = ""
    let best = goodArr.sort((a, b) => b.sale - a.sale).slice(0,3) 

    $('.sell > div').remove()
    goodArr.sort((a, b) => b.sale - a.sale).forEach(item => {
        $('.sell').append(`
            <div class="box mb-5 d-flex" attr="${item.attr}" sale="${item.sale}">
                <div class="tri1 w-100 h-100 position-absolute"></div>
                <img src="./resouces/images/${item.img}">
                <div class="content ms-4">
                    <p class="tit mt-4">${item.title}</p> 
                    <p class="price con mt-3">가격 : ₩${item.price}</p>
                    <p class="sale">판매량 : ${item.sale}개</p>
                    <p class="cate">카테고리 : ${item.group}</p>
                </div>
            </div>
        `)

        best = goodArr.sort((a, b) => b.sale - a.sale).slice(0,3)
        best.forEach(item => {
            $(`.sell .box[sale="${item.sale}"]`).append('<div class="position-absolute top">best</div>')
        })
    })
    
    $(document).on('click', '.sub3 .btn-a', function() {
        $('.all .btn-a').removeClass('click')
        $(this).addClass('click')
        switch ($(this).attr('attr')) {
            case 'all': 
                sortBy = (a, b) => b.sale - a.sale
                sortName = 'all'
                break
            case 'sale-up':
                sortBy = (a, b) => a.sale - b.sale
                sortName = 'sale-up'
                break
            case 'sale-down':
                sortBy = (a, b) => b.sale - a.sale
                sortName = 'sale-down'
                break
            case 'price-up':
                sortBy = (a, b) => a.price.replace(',', '') - b.price.replace(',', '')
                sortName = 'price-up'
                break
            case 'price-down':
                sortBy = (a, b) => b.price.replace(',', '') - a.price.replace(',', '')
                sortName = 'price-down'
                break
        }

        if(changeSelect == "all") {
            sortedArr = goodArr.sort(sortBy)
        } else {
            sortedArr = goodArr.sort(sortBy).filter(item => item.group == changeSelect)
        }
         
        $('.sell > div').remove()
        sortedArr.forEach(item => {
            $('.sell').append(`
                <div class="box mb-5 d-flex" attr="${item.attr}" sale="${item.sale}">
                    <div class="tri1 w-100 h-100 position-absolute"></div>
                    <img src="./resouces/images/${item.img}">
                    <div class="content ms-4">
                        <p class="tit mt-4">${item.title}</p> 
                        <p class="price con mt-3">가격 : ₩${item.price}</p>
                        <p class="sale">판매량 : ${item.sale}개</p>
                        <p class="cate">카테고리 : ${item.group}</p>
                    </div>
                </div>
            `)
        })
        best.forEach(item => {
            $(`.sell .box[sale="${item.sale}"]`).append('<div class="position-absolute top">best</div>')
        })
    })
    
    $('#category').on('change', function() {
        let filterArr = ""
        changeSelect = $(this).val() 
        if(sortName == 'all' && changeSelect == 'all') {
            filterArr = goodArr
        } else if(sortName != 'all' && changeSelect == 'all') {
            filterArr = goodArr
        } else if(sortName == 'all' && changeSelect != 'all') {
            filterArr = goodArr.filter(item => item.group == changeSelect)
        } else if(sortName == 'sale-up') {
            filterArr = goodArr.sort((a,b) => a.sale - b.sale).filter(item => item.group == changeSelect)
        } else if(sortName == 'sale-down') {
            filterArr = goodArr.sort((a,b) => b.sale - a.sale).filter(item => item.group == changeSelect)
        } else if(sortName == 'price-up') {
            filterArr = goodArr.sort((a,b) => a.price.replace(',', '') - b.price.replace(',', '')).filter(item => item.group == changeSelect)
        } else if(sortName == 'price-down') {
            filterArr = goodArr.sort((a,b) => b.price.replace(',', '') - a.price.replace(',', '')).filter(item => item.group == changeSelect)
        }

        $('.sell > div').remove()
        filterArr.forEach(item => {
            $('.sell').append(`
                <div class="box mb-5 d-flex" attr="${item.attr}" sale="${item.sale}">
                    <div class="tri1 w-100 h-100 position-absolute"></div>
                    <img src="./resouces/images/${item.img}">
                    <div class="content ms-4">
                        <p class="tit mt-4">${item.title}</p> 
                        <p class="price con mt-3">가격 : ₩${item.price}</p>
                        <p class="sale">판매량 : ${item.sale}개</p>
                        <p class="cate">카테고리 : ${item.group}</p>
                    </div>
                </div>
            `)
        })
        best.forEach(item => {
            $(`.sell .box[sale="${item.sale}"]`).append('<div class="position-absolute top">best</div>')
        })
    })
}

// 편집 함수
function edit() {
    let imgText = ""
    let inText = ""
    let canvas = document.querySelector('#edit-canvas')
    let ctx = canvas.getContext('2d')
    $('.canvas-text').css('display', 'none')
    let isDragging = false
    let offsetX, offsetY
    let text = {
        x: 100,
        y: 100
    }
    let check = false
    let angle = 0

    $('#file').on('change', function () {
        $('.move-text-box').removeClass('click')
        const selectedFile = this.files[0]
        let img = new Image()
        img.src = `./resouces/images/${selectedFile.name}`
        imgText = selectedFile.name
        img.onload = function () {
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height)
            if (inText !== "") {
                ctx.fillText(inText, text.x, text.y)
            }
        }

        if (check) {
            check = false
            $('.move-text-box').removeClass('click')
        }
    })

    $('.start').on('click', function () {
        ctx.clearRect(0, 0, canvas.width, canvas.height)
        if (imgText.length > 0) {
            let img = new Image()
            img.src = `./resouces/images/${imgText}`
            img.onload = function () {
                ctx.drawImage(img, 0, 0, canvas.width, canvas.height)
            }
        }

        if (check) {
            check = false
            $('.move-text-box').removeClass('click')
        }

        inText = ""
        $('#canvas-text').val('')
    })

    $('.text-box').on('click', function () {
        $('.canvas-text').css('display', 'block')
        $('.text-box').removeClass('click')
        $('.move-text-box').removeClass('click')
    })

    $('.move-text-box').on('click', function () {
        check = true
        $('.move-text-box').addClass('click')
    })

    $('.in').on('click', function () {
        check = false
        $('.move-text-box').removeClass('click')
        let textValue = $('#canvas-text').val()
        inText = textValue
        ctx.font = 'bold 24px "맑은 고딕", sans-serif'
        ctx.fillStyle = '#00a4ff'

        ctx.clearRect(0, 0, canvas.width, canvas.height)
        let img = new Image()
        img.src = `./resouces/images/${imgText}`
        ctx.drawImage(img, 0, 0, canvas.width, canvas.height)
        ctx.fillText(textValue, text.x, text.y)
        $('.canvas-text').css('display', 'none')
    })

    $('#edit-canvas').on('mousedown', function (e) {
        if (check) {
            const mouseX = e.clientX - canvas.offsetLeft
            const mouseY = e.clientY - canvas.offsetTop
            if (mouseX > text.x && mouseY > text.y) {
                isDragging = true
                offsetX = mouseX - text.x
                offsetY = mouseY - text.y
            }
        }
    })

    $('#edit-canvas').on('mousemove', function (e) {
        if (check && isDragging) {
            const mouseX = e.clientX - canvas.offsetLeft
            const mouseY = e.clientY - canvas.offsetTop

            text.x = mouseX - offsetX
            text.y = mouseY - offsetY

            clear()
            draw()
        }
    })

    $(document).on('keydown', function (e) {
        if (!check) return

        if (inText !== "") {
            let img = new Image()
            img.src = `./resouces/images/${imgText}`
            if (e.key == 37 || e.key == "ArrowLeft") {
                text.x -= 10
            } else if (e.key == 39 || e.key == "ArrowRight") {
                if (e.ctrlKey) {
                    angle += 90
                } else {
                    text.x += 10
                }
            } else if (e.key == 38 || e.key == "ArrowUp") {
                text.y -= 10
                e.preventDefault()
            } else if (e.key == 40 || e.key == "ArrowDown") {
                text.y += 10
                e.preventDefault()
            }

            clear()
            draw()
        }
    })

    $('#edit-canvas').on('mouseup', function () {
        isDragging = false
    })

    $('.down').on('click', function () {
        const link = document.createElement('a')
        link.href = canvas.toDataURL()
        link.download = `${imgText}`
        link.click()
        if (check) {
            check = false
            $('.move-text-box').removeClass('click')
        }
    })

    $('.delete').on('click', function () {
        ctx.clearRect(0, 0, canvas.width, canvas.height)
        imgText = ""
        let img = new Image()
        img.src = `./resouces/images/${imgText}`
        ctx.drawImage(img, 0, 0, canvas.width, canvas.height)
        if (check) {
            check = false
            $('.move-text-box').removeClass('click')
        }
    })

    function draw() {
        ctx.save()
        if (angle !== 0) {
            ctx.translate(text.x, text.y)
            ctx.rotate((Math.PI / 180) * angle)
            ctx.translate(-text.x, -text.y)
        }

        ctx.font = 'bold 24px "맑은 고딕", sans-serif'
        ctx.fillStyle = '#00a4ff'
        ctx.fillText(inText, text.x, text.y)

        ctx.restore()
    }

    function clear() {
        ctx.clearRect(0, 0, canvas.width, canvas.height)
        let img = new Image()
        img.src = `./resouces/images/${imgText}`
        ctx.drawImage(img, 0, 0, canvas.width, canvas.height)
    }
}