$(document).ready(function () {
    join()
})

// 차트함수

// c
function join() {
    chekIn = false
    let tex = ""
    let label = ""
    let date = ""
    let price = ""
    let time = ""
    let inputValue = ""
    let first = false
    let year = ""
    let month = "" 
    let days = ""

    $('.id-check').on('click', function() {
        let id = $('#id').val()
        $.post('/asset/page/function/id-check.php', {id: id}, function(data) {
            da = data.trim()
            console.log(data)
            if(da == "success") {
                alert("사용 가능한 ID입니다")
                chekIn = true
            } else if(da == "fail") {
                alert("사용 중인 ID입니다.")
            } else if(da == "null") {
                alert("값을 입력해주시기 바랍니다")
            } else if(da == "non") {
                alert("아이디는 영문과 숫자의 조합만 가능합니다.");
            }
        })
    })

    $('join-modal').on('click', function() {
        $('#id').val('')
        $('#pass').val('')
        $('#name').val('')
    })

    $('.login').on('click', function() {
        $('.login-modal').show()
    })

    $('.close').on('click', function() {
        $('#login-modal').hide()
        $('.date-modal').hide()
    })

    $('.sub-vi label').on('click', function() {
        $('.sub-vi form input[name="label"]').remove()
        $('.sub-vi label').css('color', '#ff6600')
        $(this).css('color', '#fff')
        label = $(this).text()
        $('.sub-vi form').append(`
            <input type="hidden" name="label" value="${label}">
        `)
    
        if(label == "나이트리그") {
            $('.pick th').css('background-color', '#fff')
            $('.pick th:nth-child(2)').css('background-color', '#d7e9ff')
        } else if(label == "주말리그") {
            $('.pick th').css('background-color', '#fff')
            $('.pick th:nth-child(3)').css('background-color', '#d7e9ff')
        } else if(label == "새벽리그") {
            $('.pick th').css('background-color', '#fff')
            $('.pick th:nth-child(4)').css('background-color', '#d7e9ff')
        } 

        if(inputValue >= 20) {
            if(label == "주말리그") {
                price = 100000
            } else if(label == "새벽리그") {
                price = 30000
            } else if(label == "나이트리그") {
                price = 50000; 
            } else if(label == "") {
                alert("리그를 선택해주세요")
            }
            price += (inputValue - 20) * 1000;
            $('.price').text(`사용료 레코드 : ${price}원`)
        }
    })

    $('.pick th p').on('click', function() {
        $('.pick th p').css('color', "#0068ff")
        time = $(this).text()
        $(this).attr('date', tex)
    
        if (time === "휴일") {
            alert("해당 날짜는 휴일로 지정되었습니다.")
            return
        }
    
        if ((label === "나이트리그" && $(this).parent().index() === 1) ||
            (label === "주말리그" && $(this).parent().index() === 2) ||
            (label === "새벽리그" && $(this).parent().index() === 3)) {
            $(this).css('color', "#fff")
            $('input[name="time"]').remove()
            $('.form').append(`<input type="hidden" name="time" value="${time}">`)
        } else if(label == "") {
            alert(`리그를 선택해주세요`)
        } else {
            alert(`${label} 내에서 선택해주세요`)
        }

        $.post("/asset/page/function/send.php", {times:time, days:days}, function(data){
            if(data == "success"){
                $('input[name="time"]').remove()
                alert("해당 날짜는 이미 예약이 있는 날짜입니다")
                $('.form').append(`
                    <input type="hidden" name="time" value="full">
                `)
            }
        })
    })
    
    $('.pick .c1 th:nth-child(4) p').on('click', function() {
        if(first && label == "새벽리그") {
            alert(`매월 첫째주 월 새벽 04시는 예약이 불가능합니다`)
            time = "not"
            $('input[name="time"]').remove()
            $('.form').append(`
                <input type="hidden" name="time" value="${time}">
            `)
        }
    })

    $('.tb tbody td').on('click', function() {
        first = false
        $('.sub-vi form input[name="date"]').remove()
        $('.table tbody td').css('background-color', 'transparent')
        tex = $(this).text()
        date = $('.sub-vi .col-12 p.con').text()
        if(tex == "") {
            alert("날짜를 다시 설정해주세요")
        } else if(tex == "휴일") {
            alert("해당 날짜는 휴일로 지정되었습니다.")
        } else {
            year = date.slice(0,4)
            month = date.slice(5, 7).replace("월", "")
            if(tex < 10) {
                tex = '0' + tex
            }
            days = year + '년' + month + '월' + tex + '일'
            $('.pick').attr('idx', `${days}`)

            $(this).css('background-color', '#d7e9ff')
            $('.sub-vi form').append(`
                <input type="hidden" name="date" value="${days}">
            `)
        }
        days = year + '년' + month + '월' + tex + '일'
        $.post("/asset/page/function/send.php", {times:time, days:days}, function(data){
            if(data == "success"){
                $('input[name="date"]').remove()
                alert("해당 날짜는 이미 예약이 있는 날짜입니다")
                $('.sub-vi form').append(`
                <input type="hidden" name="date" value="full">
                `)
            }
        })
    })

    $('form #number').on('input', function() {
        inputValue = $(this).val()

        if(label != "") {
            if(!/^[0-9]+$/.test(inputValue)) {
                alert("숫자 외에는 입력할 수 없습니다")
                $(this).val("")
            }
            if(inputValue >= 20) {
                if(label == "주말리그") {
                    price = 100000
                } else if(label == "새벽리그") {
                    price = 30000
                } else if(label == "나이트리그") {
                    price = 50000; 
                } else if(label == "") {
                    alert("리그를 선택해주세요")
                }
                price += (inputValue - 20) * 1000;
                $('.price').text(`사용료 레코드 : ${price}원`)
                $('input[name="price"]').remove()
                $('.form').append(`
                    <input type="hidden" name="price" value="${price}">
                `)
            }
        } else {
            alert("리그를 선택하세요")
        }
    })

    function findFirstMonday() {
        let firstMonday = null
        $('.table tbody tr').each(function() {
            const $firstMondayCell = $(this).find('td').eq(1)
            if ($firstMondayCell.text() !== "") {
                firstMonday = $firstMondayCell
                return false
            }
        })
        return firstMonday
    }
    
    const firstMondayCell = findFirstMonday()
    if (firstMondayCell !== null) {
        console.log(firstMondayCell.text())
    }

    $(firstMondayCell).on('click', function() {
        first = true
    }) 

    let attr = []
    $('.my input[type=checkbox]').on('click', function() {
        attr.push($(this).attr('value'))
        attr.forEach(item => {
            $('.all').append(`
                <input type='hidden' name='delete[]' value='${item}'>      
            `)
        })
    })

    $('.chk-table tbody td').on('click', function() {
        let val = $(this).text()
        if(val != "휴일") {
            $('.admin-pick tbody th p').css('color', '#0086ff')
            $('.chk-table tbody td').css('color', '#0086ff')
            $(this).css('color', '#4f4f4f')
            $('.hue input[type="hidden"]').remove()
            $('.hue').append(`
                <input type="hidden" name='hue' value='${val}'>
            `)
        } else {
            alert("해당 날짜는 휴일로 지정되었습니다.")
        }
    })

    $('.admin-pick tbody th p').on('click', function() {
        let hue = $(this).text()
        if(hue != "휴일") {
            $('.chk-table tbody td').css('color', '#0086ff')
            $('.chk-table tbody td').css('background-color', '#fff')
            $('.admin-pick tbody th p').css('color', '#0086ff')
            $(this).css('color', '#4f4f4f')
            $('.hue input[type="hidden"]').remove()
            $('.hue').append(`
                <input type="hidden" name='time' value='${hue}'>
            `)
        } else {
            alert("휴일은 다시 지정을 못합니다")
        }
    })

    $('.list').on('click', function() {
        const idx = $(this).attr('idx')
        $(`input[idx=${idx}]`).click()
    })

    $('.page input').css('display', 'none')

    $('.page .interest').on('click', function() {
        $(`#interest input`).click()
    })

    $('.page .cart').on('click', function() {
        $(`#cart input`).click()
    })

    $('.page .buy').on('click', function() {
        $(`#buy input`).click()
    })

    $('.text input[name=number]').on('keyup', function() {
        number = $(this).val()
        let pri = $('.pri').attr('price')
        console.log(pri)
        pri = pri * number
        $('.buyIt .pri').text(pri)
        $('form[action="/mybuy"]').append(`
            <input type='hidden' name='price' value='${pri}'>
        `)
    })
}

$(document).ready(function() {
    let tbody = $('.sort')
    let rows = tbody.children('tr').get()

    rows.sort(function(a, b) {
        let idxA = parseInt($(a).attr('idx'))
        let idxB = parseInt($(b).attr('idx'))
        let timeA = parseInt($(a).attr('time'))
        let timeB = parseInt($(b).attr('time'))
        if (idxA !== idxB) {
            return idxB - idxA
        } else {
            return timeB - timeA
        }
    })

    $.each(rows, function(index, row) {
        tbody.append(row)
    })

    $('.sort td').each(function() {
        let text = $(this).text()
        if (text.includes('원')) {
            text.toLocaleString()
        }
    })
})

$(document).ready(function() {
    let tbody = $('.by-list tbody')
    let rows = tbody.children('tr').get()

    rows.sort(function(a, b) {
        let priceA = parseInt($(a).attr('atr'))
        let priceB = parseInt($(b).attr('atr'))
        if (priceA !== priceB) {
            return priceB - priceA
        } else {
            return priceB - priceA
        }
    })

    $.each(rows, function(index, row) {
        tbody.append(row)
    })
})

$(document).on('')
