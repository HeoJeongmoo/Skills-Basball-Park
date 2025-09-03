<script src="./resouces/js/scriptB.js"></script>
<div class="modal date-modal" id="date-modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <h5 class="modal-title"><?php echo "'$userName'님 반갑습니다"?></h5>
      <?php $memo = fetch("SELECT * FROM `users` WHERE date='0000-00-00'"); ?>
      <p><?php if($memo && isset($memo->date)) {
        echo "처음으로 계정에 로그인 하셨습니다";
      } else {
        $sliceDate = date('Y-m-d', strtotime($date));
        echo "이전에 {$sliceDate}에 로그인 하셨습니다";
        $day = date("Ymd");
        $_SESSION['date'] = $day;
        query("UPDATE `users` SET `date`='$day' WHERE `name`='$userName'");
      } ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="close" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<section class="vi">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex">
                    <div class="gr">
                        <div class="triangle triangle1 position-relative">
                            <div class="tri1 w-100 h-100 position-absolute"></div>
                            <div class="tri2 w-100 h-100 position-absolute"></div>
                        </div>
                        <div class="triangle triangle2 position-relative">
                            <div class="tri3 w-100 h-100 position-absolute"></div>
                            <div class="tri4 w-100 h-100 position-absolute"></div>
                        </div>
                    </div>
                    <div class="block h-100 position-relative pt-5 px-3">
                        <img src="./resouces/images/vi.png" alt="vi" class="position-relative">
                        <div class="w-100 tex-slide mt-5 overflow-hidden position-relative">
                            <div class="text-slides position-absolute d-flex">
                                <div class="w-100 ko">스킬스 베이스볼 파크에 오신것을 환영합니다. <br>
                                    굿즈와 함께, 응원과 함께!
                                </div>
                                <div class="w-100">No limits amazing skills baseball park! <br>
                                Lorem ipsum dolor sit amet, consectetur.
                                </div>
                                <div class="w-100">New Champion, New Challenge,  <br> Skills Baseball Park
                                </div>
                                <div class="w-100 ko">
                                    스킬스베이스볼 파크를 응원해주시는 모든 분께 <br> 
                                    감사드립니다. - 스킬스베이스볼 파크
                                </div>
                                <div class="w-100 ko">스킬스 베이스볼 파크에 오신것을 환영합니다. <br>
                                    굿즈와 함께, 응원과 함께!
                                </div>
                            </div>
                        </div>
                        <button class="button mt-5">Learn more</button>
                        <div class="ball"></div>
                        <div class="line h-100 position-absolute"></div>
                    </div>
                    <div class="radius h-100 position-relative overflow-hidden">
                        <div class="tri tri1 position-absolute h-100 w-100 overflow-hidden">
                            <div class="tri-slides tri-slides1 h-100 position-absolute d-flex">
                                <div class="img img1 w-100 h-100"></div>
                                <div class="img img2 w-100 h-100"></div>
                                <div class="img img3 w-100 h-100"></div>
                                <div class="img img4 w-100 h-100"></div>
                                <div class="img img1 w-100 h-100"></div>
                            </div>
                        </div>
                        <div class="tri tri2 position-absolute h-100 w-100 overflow-hidden">
                            <div class="tri-slides tri-slides2 h-100 position-absolute d-flex">
                                <div class="img img1 w-100 h-100"></div>
                                <div class="img img2 w-100 h-100"></div>
                                <div class="img img3 w-100 h-100"></div>
                                <div class="img img4 w-100 h-100"></div>
                                <div class="img img1 w-100 h-100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- 차트영역 -->
    <section class="sub2 mg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <img src="./resouces/images/sub2.png" alt="sub2">
                </div>
                <div class="col-5">    
                    <div class="d-flex mt-5 league2">
                        <button class="btn mx-3" id="width">가로로 보기</button>
                        <button class="btn mx-3" id="length">세로로 보기</button>
                        <select name="day" id="day" class="btn mx-3">
                            <option value="월">월</option>
                            <option value="화">화</option>
                            <option value="수">수</option>
                            <option value="목">목</option>
                            <option value="금">금</option>
                            <option value="토">토</option>
                            <option value="일">일</option>
                        </select>
                    </div>
                    <div class="d-flex mt-5 league3">
                        <button id="night" class="btn mx-3">나이트리그</button>
                        <button id="weekend" class="btn mx-3">주말리그</button>
                        <button id="dawn" class="btn mx-3">새벽리그</button>
                    </div>
                </div>
                <div class="col-7">
                    <canvas id="chart" width="620px" height="620px" class="mt-5"></canvas>
                </div>
            </div>
        </div>
    </section>
    <!-- 굿즈 판매영역 -->
    <section class="sub3 mg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <img src="./resouces/images/sub3.png" alt="sell">
                </div>
                <div class="col-12 check-list mt-5 d-flex justify-content-between">
                    <div class="all">
                        <div class="d-flex">
                            <button class="btn-a mx-3" attr="sale-down">판매량 내림차순</button>
                            <button class="btn-a mx-3" attr="sale-up">판매량 오름차순</button>
                        </div>
                        <div class="d-flex">
                            <button class="btn-a mx-3 mt-3" attr="price-down">가격 내림차순</button>
                            <button class="btn-a mx-3 mt-3" attr="price-up">가격 오름차순</button>
                        </div>
                    </div>
                    <div class="list-box">
                        <select name="category" id="category" class="mt-4">
                            <option value="all" selected>전체상품</option>
                            <option value="응원도구">응원도구</option>
                            <option value="야구용품">야구용품</option>
                            <option value="의류">의류</option>
                            <option value="악세사리">악세사리</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 title mt-5 pt-3 mb-3">
                    <p class="tit">GOODS판매량</p>
                </div>
                <div class="col-12 sell d-flex justify-content-between flex-wrap"></div>
                <div class="col-6">
                    <p class="tit">GOODS수정제안</p>
                    <div class="d-flex mt-5 pt-3">
                        <button class="button mx-3 start">원래대로</button>
                        <button class="button mx-3 delete">삭제</button>
                        <button class="button mx-3 plus p-0"><label for="file" class="w-100">추가</label></button>
                        <input type="file" name="file" id="file" accept="image/gif, image/jpeg, image/png">
                    </div>
                    <div class="d-flex mt-4">
                        <button class="button mx-3 down">다운로드</button>
                        <button class="button mx-3 text-box">글상자</button>
                        <button class="button mx-3 move-text-box">글상자 이동 및 회전</button>
                    </div>
                    <div class="canvas-text">
                        <div class="d-flex mt-5">
                            <input type="text" name="text" id="canvas-text" placeholder="글상자에 입력할 내용을 적으세요">
                            <button class="button in mx-3">작성</button>
                        </div>
                    </div>
                </div>
                <div class="col-6 edit mt-5">
                    <canvas id="edit-canvas" width="660px" height="500px"></canvas>
                </div>
            </div>
        </div>
    </section>
    <?php
        if($idx == "") {
            echo "<script>document.getElementById('date-modal').style.display = 'none';</script>";
        } else {
            echo "<script>document.getElementById('date-modal').style.display = 'block';</script>";
        }
    ?>