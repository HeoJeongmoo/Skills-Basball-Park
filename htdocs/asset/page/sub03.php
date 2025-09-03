<?php
$sqlUser = fetchAll("SELECT * FROM `cart` WHERE name='$userName'");
if($userNumber == 3 || $userNumber == 1) {
    $thisyear = date("Y");
    $thismonth = date("m");
    $today = date("d");
    
    $year = isset($_GET['year']) ? $_GET['year'] : $thisyear;
    $month = isset($_GET['month']) ? $_GET['month'] : $thismonth;
    $day = isset($_GET['day']) ? $_GET['day'] : $today;
    
    $prev_month = $month - 1;
    $next_month = $month + 1;
    
    $prev_year = $next_year = $year;
    
    if($month == 1){
        $prev_month = 12;
        $prev_year = $year - 1;
    } else if($month == 12){
        $next_month = 1;
        $next_year = $year + 1;
    }
    
    $max_day = date("t", mktime(0, 0, 0, $month, 1, $year));
    $start_week = date("w", mktime(0, 0, 0, $month, 1, $year));
    
    $total_week = ceil(($max_day + $start_week) / 7);
    $end_week = date("w", mktime(0, 0, 0, $month, $max_day, $year));
    $sql = fetchAll("SELECT * FROM `reservation`"); 
} else if($userNumber == 2 || $userNumber == 6) {
    $sql = fetchAll("SELECT * FROM `reservation`"); 
}

?>
<section class="sub-vi">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="mini-vi w-100 position-relative">
                    <!-- 주소 -->
                    <p>HOME - RESERVATION</p>
                    <div class="vi-line w-100 position-absolute"></div>
                </div>
            </div>
            <?php if($userNumber == 3) { ?>
                <div class="col-12 mt-5">
                <p class="tit c1">리그선택</p>
            </div>
            <div class="col-12">
                <label for="league1 button">나이트리그</label>
                <label for="league2 button">주말리그</label>
                <label for="league3 button">새벽리그</label>
            </div>
            <div class="col-12 mt-5 ">
                <p class="tit c2">날짜선택</p>
            </div>
            <div class="col-12 d-flex justify-content-center">
                <a href="/sub03?year=<?php echo $prev_year ?>&month=<?php echo $prev_month ?>" class="btn3">이전달</a>
                <p class="mx-5 con mt-2"><?php echo $year.'년'.$month.'월'; ?></p>
                <a href="/sub03?year=<?php echo $next_year ?>&month=<?php echo $next_month ?>" class="btn3">다음달</a>
            </div>
            <div class="col-12 mt-5">
                <table class="table tb">
                    <thead>
                        <tr>
                            <td>일</td>
                            <td>월</td>
                            <td>화</td>
                            <td>수</td>
                            <td>목</td>
                            <td>금</td>
                            <td>토</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $days = 1;
                            $count = 1;
                            for($i=1; $i<=$total_week; $i++){
                                echo '<tr>';
                                for($k=0; $k<7; $k++){
                                    echo '<td class="position-relative">';
                                    if(!(($i == 1 && $k < $start_week) || ($i == $total_week && $k > $end_week))){
                                        $count++;
                                        if(fetchAll("SELECT * FROM `date` WHERE state=1 AND day=$count - 1")) {
                                            echo "휴일";
                                        } else {
                                            echo $days;
                                        }
                                        
                                        $day = substr('0'.$days, -2);
                                        $months = substr('0'.$month, -2);

                                        echo `<div class="box w-100 position-absolute">`;
                                        echo '</div>';

                                        $days++;
                                    }

                                    echo '</td>';
                                }

                                echo '</tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-12 pick mt-5">
                <p class="tit">시간</p>
                <table class="table">
                    <thead>
                        <tr>
                            <td></td>
                            <td><p>나이트리그</p></td>
                            <td><p>주말리그</p></td>
                            <td><p>새벽리그</p></td>
                        </tr>
                    </thead>
                    <tbody>
                    <tr class="c1">
                            <th><p>1경기</p></th>
                            <th><p><?php echo (fetchAll("SELECT * FROM `date` WHERE state=2 AND day='19시'")) ? "휴일" : '19시'; ?></p></th>
                            <th><p><?php echo (fetchAll("SELECT * FROM `date` WHERE state=2 AND day='09시'")) ? "휴일" : '09시'; ?></p></th>
                            <th><p><?php echo (fetchAll("SELECT * FROM `date` WHERE state=2 AND day='04시'")) ? "휴일" : '04시'; ?></p></th>
                        </tr>
                        <tr class="c2">
                            <th><p>2경기</p></th>
                            <th><p><?php echo (fetchAll("SELECT * FROM `date` WHERE state=2 AND day='23시'")) ? "휴일" : '23시'; ?></p></th>
                            <th><p><?php echo (fetchAll("SELECT * FROM `date` WHERE state=2 AND day='13시'")) ? "휴일" : '13시'; ?></p></th>
                            <th><p><?php echo (fetchAll("SELECT * FROM `date` WHERE state=2 AND day='07시'")) ? "휴일" : '07시'; ?></p></th>
                        </tr>
                        <tr class="c3">
                            <th><p>3경기</p></th>
                            <th></th>
                            <th><p><?php echo (fetchAll("SELECT * FROM `date` WHERE state=2 AND day='15시'")) ? "휴일" : '15시'; ?></p></th>
                            <th></th>
                        </tr>
                    </tbody>
                </table>
            </div>
            <form action="/asset/page/function/user_reser.php" method="post" class="form">
                <div class="col-12 mt-5">
                    <p class="tit c1">최소인원</p>
                    <input type="text" name="number" id="number">
                    <p class="price mt-4"></p>
                </div>
                <input type="submit" value="예약하기" class="mt-5">
            </form>
            <?php } else if($userNumber == 2) {
                if($sql > 1) { ?>
                <table class="mt-5 my">
                    <thead>
                        <tr>
                            <td>체크박스</td>
                            <td>예약자 ID</td>
                            <td>예약자 이름</td>
                            <td>리그</td>
                            <td>날짜</td>
                            <td>시간</td>
                            <td>최소인원</td>
                            <td>사용료</td>
                            <td>예약가능여부</td>
                            <td></td>
                            <td></td>
                        </tr>
                    </thead> 
                    <tbody>
                    <?php 
                        foreach($sql as $item) {
                            if($item->state == 1 || $item->state == 3 || $item->state == 2) {
                                echo 
                                "<tr idx='$item->count'>
                                    <td><input type='checkbox' value='$item->count'></td>
                                    <td>$item->id</td>
                                    <td>$item->name</td>
                                    <td>$item->league</td>
                                    <td>$item->date</td>
                                    <td>$item->time</td>
                                    <td>{$item->number}명</td>
                                    <td>{$item->price}원</td>";
                            }

                            if ($item->state == 1) {
                                echo "<td>예약가능</td>";
                                echo "<td><form action='/asset/page/function/res_ok.php' method='post'>
                                        <input type='hidden' name='count' value='$item->count'>
                                        <input type='submit' class='btn' value='예약 승인'>
                                    </form></td>";
                            } else if($item->state == 3) {
                                echo "<td>승인 불가</td>";
                                echo "<td><form action='/asset/page/function/delete.php' method='post'>
                                        <input type='hidden' name='count' value='$item->count'>
                                        <input type='submit' class='btn' value='삭제'>
                                    </form></td>";
                            } else if($item->state == 2) {
                                echo "<td>승인 완료</td>";
                            }

                            echo "</tr>";
                        }  
                    ?>
                    </tbody>
                </table>
                <form action="/asset/page/function/manager_delete.php" method="post" class="mt-3 all">
                    <input type="submit" value="선택삭제">
                </form>
            <?php } } else if($userNumber == 1) { ?>
            <div class="p-0 mt-5 col-12">
                <img src="./resouces/images/mypage.png" alt="my">
            </div>
            <div class="col-12 mt-5">
                <p class="tit">휴일지정</p>
            </div>
            <div class="col-12 chk-date d-flex justify-content-center mt-3">
                <a href="/sub03?year=<?php echo $prev_year ?>&month=<?php echo $prev_month ?>" class="btn3">이전달</a>
                <p class="mx-5 con mt-2"><?php echo $year.'년'.$month.'월'; ?></p>
                <a href="/sub03?year=<?php echo $next_year ?>&month=<?php echo $next_month ?>" class="btn3">다음달</a>
            </div>
            <div class="col-12 mt-5">
                <table class="table chk-table tb">
                    <thead>
                        <tr>
                            <td>일</td>
                            <td>월</td>
                            <td>화</td>
                            <td>수</td>
                            <td>목</td>
                            <td>금</td>
                            <td>토</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $days = 1;
                            $count = 1;
                            for($i=1; $i<=$total_week; $i++){
                                echo '<tr>';
                                for($k=0; $k<7; $k++){
                                    echo '<td class="position-relative">';
                                    if(!(($i == 1 && $k < $start_week) || ($i == $total_week && $k > $end_week))){
                                        $count++;
                                        if(fetchAll("SELECT * FROM `date` WHERE state=1 AND day=$count - 1")) {
                                            echo "휴일";
                                        } else {
                                            echo $days;
                                        }
                                        
                                        $day = substr('0'.$days, -2);
                                        $months = substr('0'.$month, -2);
                                        echo `<div class="box w-100 position-absolute">`;
                                        echo '</div>';
                                        $days++;
                                    }
                                    echo '</td>';
                                }
                                echo '</tr>';
                            }
                        ?>
                    </tbody>
                </table>
                <div class="col-12 admin-pick mt-5">
                <p class="tit">시간</p>
                <table class="table">
                    <thead>
                        <tr>
                            <td></td>
                            <td><p>나이트리그</p></td>
                            <td><p>주말리그</p></td>
                            <td><p>새벽리그</p></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="c1">
                            <th><p>1경기</p></th>
                            <th><p><?php echo (fetchAll("SELECT * FROM `date` WHERE state=2 AND day='19시'")) ? "휴일" : '19시'; ?></p></th>
                            <th><p><?php echo (fetchAll("SELECT * FROM `date` WHERE state=2 AND day='09시'")) ? "휴일" : '09시'; ?></p></th>
                            <th><p><?php echo (fetchAll("SELECT * FROM `date` WHERE state=2 AND day='04시'")) ? "휴일" : '04시'; ?></p></th>
                        </tr>
                        <tr class="c2">
                            <th><p>2경기</p></th>
                            <th><p><?php echo (fetchAll("SELECT * FROM `date` WHERE state=2 AND day='23시'")) ? "휴일" : '23시'; ?></p></th>
                            <th><p><?php echo (fetchAll("SELECT * FROM `date` WHERE state=2 AND day='13시'")) ? "휴일" : '13시'; ?></p></th>
                            <th><p><?php echo (fetchAll("SELECT * FROM `date` WHERE state=2 AND day='07시'")) ? "휴일" : '07시'; ?></p></th>
                        </tr>
                        <tr class="c3">
                            <th><p>3경기</p></th>
                            <th></th>
                            <th><p><?php echo (fetchAll("SELECT * FROM `date` WHERE state=2 AND day='15시'")) ? "휴일" : '15시'; ?></p></th>
                            <th></th>
                        </tr>
                    </tbody>
                </table>
            </div>
                <form action="/asset/page/function/admin_chk.php" class="hue mt-5" method="post">
                    <input type="submit" value="휴일지정" onclick="return confirm('휴일로 지정하시겠습니까?')">
                </form>
            </div>
            <div class="col-12 mt-5 pt-5">
                <img src="./resouces/images/ad01.png" alt="ad">
            </div>
            <div class="col-12 mt-5">
                <p class="tit">결제완료 상태</p>
            </div>
            <div class="col-12 mt-2">
                <table class="w-100 my">
                    <thead>
                        <tr>
                            <td>예약자 ID</td>
                            <td>예약자 이름</td>
                            <td>리그</td>
                            <td>날짜</td>
                            <td>시간</td>
                            <td>최소인원</td>
                            <td>사용료</td>
                            <td>결제상태</td>
                        </tr>
                    </thead> 
                    <tbody class="sort">
                        <?php 
                            foreach($sql as $item) {
                                if($item->state == 6) {
                                    echo 
                                    "<tr idx='$edDate' time='$edTime'>
                                        <td>$item->id</td>
                                        <td>$item->name</td>
                                        <td>$item->league</td>
                                        <td>$item->date</td>
                                        <td>$item->time</td>
                                        <td>{$item->number}명</td>
                                        <td>{$item->price}원</td>";
                                }
                                if($item->state == 6) {
                                    echo "<td>결제 완료</td></tr>";
                                }
                            } 
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-12 mt-5">
                <p class="tit">결제 진행중</p>
            </div>
            <div class="col-12 mt-2">
                <table class="w-100 my">
                    <thead>
                        <tr>
                            <td>예약자 ID</td>
                            <td>예약자 이름</td>
                            <td>리그</td>
                            <td>날짜</td>
                            <td>시간</td>
                            <td>최소인원</td>
                            <td>사용료</td>
                            <td>결제상태</td>
                        </tr>
                    </thead> 
                    <tbody>
                        <?php 
                            foreach($sql as $item) {
                                if($item->state == 2 || $item->state == 5) {
                                    echo "<tr idx='$item->count'>
                                        <td>$item->id</td>
                                        <td>$item->name</td>
                                        <td>$item->league</td>
                                        <td>$item->date</td>
                                        <td>$item->time</td>
                                        <td>{$item->number}명</td>
                                        <td>{$item->price}원</td>";
                                }
                                if($item->state == 2) {
                                    echo "<td> 결제전 </td>
                                        <td> 결제 승인 </td>
                                    </tr>";
                                } else if($item->state == 5) {
                                    echo "<td> 결제 요청 </td>
                                        <td> 
                                            <form action='/asset/page/function/admin_payment.php' method='post'>
                                                <input type='hidden' name='count' value='$item->count'>
                                                <input type='submit' value='결제 승인'>
                                            </form> 
                                        </td>
                                    </tr>";
                                }
                            } 
                        ?>
                    </tbody>
                </table>
            </div>
        <?php } else if ($userNumber == "") {
            $sql = fetchAll("SELECT * FROM `reservation`");
                if($sql > 1) { ?>
                <div class="p-0 mt-5 col-12">
                    <img src="./resouces/images/mypage.png" alt="my">
                </div>
                <table class="mt-5 my">
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
                            if($item->state == 1 || $item->state == 2 || $item->state == 3 || $item->state == 4 || $item->state == 5 || $item->state == 6 || $item->state == 7) {
                                echo 
                                "<tr idx='$item->date'>
                                <td>$item->id</td>
                                <td>$item->name</td>
                                <td>$item->league</td>
                                <td>$item->date</td>
                                <td>$item->time</td>
                                <td>{$item->number}명</td>
                                <td>{$item->price}원</td>";
                            }
                            if ($item->state == 1) {
                                echo "<td>예약 승인</td></tr>";
                            } else if($item->state == 2) {
                                echo "<td>승인 완료</td></tr>";
                            } else if($item->state == 3) {
                                echo "<td>승인 불가</td></tr>";
                            } else if($item->state == 4) {
                                echo "<td>승인 불가</td></tr>";
                            } else if($item->state == 6) {
                                echo "<td>결제 완료</td></tr>";
                            } else if($item->state == 7) {
                                echo "<td>결제 취소</td></tr>";
                            }
                        } 
                    ?>
                    </tbody>
                </table>
        <?php } 
        } ?>
        </div>
        </form>
    </div>
</section>
