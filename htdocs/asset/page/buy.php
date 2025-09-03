<?php
$count = $_POST['count'];
$sql = fetch("SELECT * FROM `cart` WHERE count='$count'");
?>

<section class='buyIt pt-5'>
    <div class="container">
        <div class="row">
            <div class="col col-12 d-flex">
                <?php echo "
                <img src='./asset/page/uploads/$sql->img'>
                <div class='text mx-5'>
                    <p class='w-100 tit'>제품명 : {$sql->name}</p>
                    <div class='w-100 mt-3'>상세설명 : {$sql->detail}</div>
                    <div class='block mt-3 mb-3'>
                        <span>가격 :</span><span class='pri' price='$sql->price'>{$sql->price}</span><span>원</span>
                    </div>
                    <form action='/mybuy' method='post'>
                        <input type='hidden' name='count' value='$sql->count'>
                        <div class='d-flex'>
                            <input type='text' name='number' value='1'>개
                        </div>
                        <input type='submit' class='mt-4' value='구매하기'>
                    </form>
                </div>
                " ?>
            </div>
        </div>
    </div>
</section>