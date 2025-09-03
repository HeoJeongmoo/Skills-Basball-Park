<?php 
    $sql = fetchAll("SELECT * FROM `cart`");
?>
<section class="sub-vi">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="mini-vi w-100 position-relative">
                    <!-- 굿즈영역 -->
                    <p>HOME - GOODS</p>
                    <div class="vi-line w-100 position-absolute"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="sub04">
    <div class="container">
        <div class="row">
        <div class="col-12">
            <img src="./resouces/images/con5.png" alt="con5">
        </div>
        <?php if($userNumber == 2) { ?>
            <p class="tit mt-5">goods 리스트</p> 
            <div class="col-12  flex-wrap d-flex justify-content-around hidden">
            <?php 
                foreach($sql as $item) {
                    echo "
                        <div class='mt-4 list position-relative d-flex flex-wrap 'idx='$item->count'>
                            <div class='tri1 tri w-100 h-100'></div>
                            <div class='w-100 d-flex'>
                                <img src='./asset/page/uploads/$item->img'>
                                <div class='tex flex-wrap'>
                                    <p class='con'>$item->name</p> <br>
                                    <p class='pr mt-4'>{$item->price}원</p>
                                </div>
                            </div>
                        </div>
                        <form action='/page' method='post'idx='$item->count'>
                            <input type='hidden' name='count' value='$item->count'>
                            <input type='submit' idx='$item->count'>
                        </form>
                    ";
                }    
            ?>
            </div>
            <p class="tit mt-5">상품등록영역</p>
            <div class="col-12">
                <form action="./asset/page/function/upload.php" method="post" class="upload" enctype="multipart/form-data">
                    <div class="d-flex">
                        <label for="upload">사진 등록</label>
                        <input type="file" name="file">
                        <label for="name">상품명</label>
                        <input type="text" name="name">
                    </div>
                    <div class="d-flex">
                        <label for="detail">goods상세설명</label>
                        <input type="text" name="detail">
                        <label for="detail">가격</label>
                        <input type="text" name="price">
                        <input type="submit" value="goods등록" class="btn">
                    </div>
                </form>
            </div>
        <?php } else if($userNumber == 3) {?>
            <div class="col-12 justify-content-around d-flex flex-wrap">
                <?php 
                    foreach($sql as $item) {
                        echo "
                        <div class='mt-4 list position-relative d-flex flex-wrap 'idx='$item->count'>
                            <div class='tri1 tri w-100 h-100'></div>
                            <div class='w-100 d-flex'>
                                <img src='./asset/page/uploads/$item->img'>
                                <div class='tex flex-wrap'>
                                    <p class='con'>$item->name</p>
                                    <p class='pr mt-4'>{$item->price}원</p>
                                    <div class='btn mt-4'>관심goods</div>
                                    <div class='btn mt-4'>장바구니</div>
                                </div>
                            </div>
                        </div>
                        <form action='/page' method='post'idx='$item->count'>
                            <input type='hidden' name='count' value='$item->count'>
                            <input type='submit' idx='$item->count'>
                        </form>
                    ";
                    }    
                ?>
            </div>
        <?php } else if($userNumber == "") { ?>
            <div class="col-12 d-flex justify-content-around flex-wrap">
                <?php 
                    foreach($sql as $item) {
                        echo "
                        <div class='mt-4 list position-relative d-flex flex-wrap 'idx='$item->count'>
                            <div class='tri1 tri w-100 h-100'></div>
                            <div class='w-100 d-flex'>
                                <img src='./asset/page/uploads/$item->img'>
                                <div class='tex flex-wrap'>
                                    <p class='con'>$item->name</p>
                                    <p class='pr mt-4'>{$item->price}원</p>
                                </div>
                            </div>
                        </div>
                        <form action='/page' method='post'idx='$item->count'>
                            <input type='hidden' name='count' value='$item->count'>
                            <input type='submit' idx='$item->count'>
                        </form>
                    ";
                    }    
                ?>
            </div>
        <?php }?>
    </div>
</section>