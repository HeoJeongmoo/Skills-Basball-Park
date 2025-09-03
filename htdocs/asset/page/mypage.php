<section class="mypage">
    <div class="container">
        <div class="row">
            <div class="mini-vi w-100 position-relative">
                <!-- 주소 -->
                <p>HOME - MYPAGE</p>
                <div class="vi-line w-100 position-absolute"></div>
            </div>
            <?php 
            if($userNumber == 3) { ?>
                <div class="p-0 mt-5 col-12">
                    <img src="./resouces/images/mypage.png" alt="my">
                </div>
                <?php 
                $sql = fetchAll("SELECT * FROM `reservation`");
                if($sql > 1) { ?>
                <table class="mt-5 my table">
                    <thead>
                        <tr>
                            <td>예약자 ID</td>
                            <td>예약자 이름</td>
                            <td>리그</td>
                            <td>날짜</td>
                            <td>시간</td>
                            <td>최소인원</td>
                            <td>사용료</td>
                            <td>예약가능여부</td>
                        </tr>
                    </thead> 
                    <tbody>
                        <?php 
                            foreach($sql as $item) {
                                if($item->name == $userName && $item->id == $idx) {
                                    if($item->state == 1 || $item->state == 2 || $item->state == 4 || $item->state == 5 || $item->state == 6 || $item->state == 7) {
                                        echo "<tr idx='$item->date'> 
                                        <td>$item->id</td>
                                        <td>$item->name</td>
                                        <td>$item->league</td>
                                        <td>$item->date</td>
                                        <td>$item->time</td>
                                        <td>{$item->number}명</td>
                                        <td>{$item->price}원</td>";
                                    }
                                    if ($item->state == 1) {
                                        echo "<td>예약신청</td></tr>";
                                    } else if($item->state == 2) {
                                        $toDay = date("Ymd"); 
                                        $mai = date("Ymd", strtotime("-1 day", strtotime($toDay)));
                                        $chDay = $item->date;
                                        $repl = array("년", "월", "일");
                                        $chDay = str_replace($repl, "", $chDay);
                                        if($mai > $chDay) {
                                            query("UPDATE `reservation` SET state='7' WHERE count='$item->count'");
                                        } else {
                                            echo "<tr idx='$item->date'> 
                                            <td>$item->id</td>
                                            <td>$item->name</td>
                                            <td>$item->league</td>
                                            <td>$item->date</td>
                                            <td>$item->time</td>
                                            <td>{$item->number}명</td>
                                            <td>{$item->price}원</td>";

                                            echo "
                                            <td>
                                                <form action='./asset/page/function/my_res.php' method='post'> 
                                                    <input type='hidden' name='count'value='$item->count'>
                                                    <input type='submit' class='btn-a' value='결제승인'>
                                                </form>
                                            </td>
                                            </tr>
                                            ";
                                        }
                                    } else if($item->state == 4) {
                                        echo "<td>승인 불가</td></tr>";
                                    } else if($item->state == 5) {
                                        echo "<td>결제중</td></tr>";
                                    } else if($item->state == 6) {
                                        echo "<td>결제 완료</td></tr>";
                                    } else if($item->state == 7) {
                                        echo "<td>결제 취소</td></tr>";
                                    }
                                }
                            } 
                        ?>
                    </tbody>
                </table>
                <?php } 
            } ?>
        </div>
    </div>
</section>
<?php if($userNumber == 3) { ?>
    <section class='by-list' id='buy-list'>
    <div class="container">
        <div class="row">
            <div class="col col-12">
                <img src="./resouces/images/buylist.png" alt="list">
            </div>
            <div class="col col-12 mt-4">
                <table class='table tam'>
                    <thead>
                        <tr>
                            <th>사진 </th>
                            <th>goods명</th>
                            <th>goods상세설명</th>
                            <th>가격</th>
                            <th>수량</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $buy = fetchAll("SELECT * FROM `buy` WHERE state=2 ORDER BY price DESC"); 
                        foreach($buy as $item) {
                            echo "
                            <tr atr='$item->price'>
                                <td><img src='./asset/page/uploads/$item->img' width='100px' hight='100px'></td>
                                <td><p>$item->name</p></td>
                                <td><p>$item->content</p></td>
                                <td><p>{$item->price}원</p></td>
                                <td><p>{$item->number}개</p></td>
                            </tr>
                            ";
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<section class='inter' id='inter'>
    <div class="container">
        <div class="row">
            <div class="col col-12">
                <p class="tit">관심goods</p>
            </div>
            <div class="col-12">
                <?php $want = fetchAll("SELECT * FROM `reservation`"); ?>
                <table class='table tam'>
                    <thead>
                        <tr>
                            <th>사진 </th>
                            <th>goods명</th>
                            <th>가격</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $buy = fetchAll("SELECT * FROM `cart` WHERE inter=2"); 
                        foreach($buy as $item) {
                            echo "
                            <tr>
                                <td><img src='./asset/page/uploads/$item->img' width='100px' hight='100px'></td>
                                <td><label for='sub' class='w-100'>$item->name</label></td>
                                <td><p>{$item->price}원</p></td>
                            </tr>
                            <form action='/page' method='post' class='subm'>
                                <input type='hidden' name='count' value='$item->count'>
                                <input type='submit' id='sub'>
                            </form>
                            ";
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>  
    </div>
</section>
<section id="cartlist">
    <div class="container">
        <div class="row">
            <div class="col col-12">
                <p class="tit">장바구니</p>
                <table class='table tam'>300 
                    <thead>
                        <tr>
                            <th>사진 </th>
                            <th>goods명</th>
                            <th>가격</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                <?php
                    $in = fetchAll("SELECT * FROM `cart` WHERE state=1"); 
                    foreach($in as $item) {
                        echo "
                        <tr>
                            <td><img src='./asset/page/uploads/$item->img' width='100px' hight='100px'></td>
                            <td><p>$item->name</p></td>
                            <td><p>{$item->price}원</p></td>
                            <td><label for='gobuy' class='button'>구매하기</label></td>
                        </tr>
                        <form action='/buy' method='post' class='subm'>
                            <input type='hidden' name='count' value='$item->count'>
                            <input type='submit' id='gobuy'>
                        </form>
                        ";
                    }
                ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<?php }?>