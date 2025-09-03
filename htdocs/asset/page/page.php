<?php
$sql = fetch("SELECT * FROM `cart` WHERE count='$count'");

if($sql) {
        echo "
        <div class='mt-200 page'>
        <div class='container'>
        <div class='row'>
        <div class='d-flex'>
        <img src='./asset/page/uploads/$sql->img'>
        <div class='text'>
        <p class='w-100 tit'>제품명 : {$sql->name}</p>
        <div class='w-100 mt-3'>상세설명 : {$sql->detail}</div>
        <div class='w-100 mt-3'>가격 : {$sql->price}원</div>
    ";
    if($userNumber == 3) {
        echo "<div class='d-flex'>
        <div class='interest button pt-2 mt-3' attr='$sql->count'>관심goods등록</div>
        <div class='buy button pt-2 mt-3 mx-3' attr='$sql->count'>바로구매</div>
        </div>
        <div class='cart button pt-2 mt-3' attr='$sql->count'>장바구니</div>
        </div>
        </div>
        </div>
        </div> ";
    } else if($userNumber != 3) {
        echo "</div>
            </div>
            </div>
            </div>"; 
    }
    if($userNumber = 3) {
        echo "
        <form action='/inter' method='post' id='interest' idx='$sql->count'>
        <input type='hidden' name='count' value='$sql->count'>
        <input type='submit' idx='$sql->count'>
    </form>
    <form action='/cart' method='post' id='cart' idx='$sql->count'>
        <input type='hidden' name='count' value='$sql->count'>
        <input type='submit' idx='$sql->count'>
    </form>
    <form action='/buy' method='post' id='buy' idx='$sql->count'>
        <input type='hidden' name='count' value='$sql->count'>
        <input type='submit' idx='$sql->count'>
    </form>
    </div> ";
    } else {
       echo "</div>";
    }

}