<script type="text/javascript">
	function refresh_captcha(){
    var x = (new Date()).getTime()
		document.getElementById("capt_img").src="./asset/page/captcha.php?waste="+ x; 
	}
</script>
<?php 
    if($userNumber == "") {
?>
<div class="modal join-modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="join_ok" method='post'>
        <div class="modal-body">
            <img src="./resouces/images/c1.png" class="m-4" alt="c1">
            <div class="px-5 pb-5">
                <div class="input mb-3">
                    <label for="name">이름</label>
                    <input type="text" class="input-text" name="name" id="name" placeholder="이름을 입력해주세요" required>
                </div>
                <div class="input mb-3">
                    <label for="id">아이디</label>
                    <div class="d-flex">
                    <input type="text" class="input-text" name="id" id="id" placeholder="아이디를 입력해주세요" required>
                    <div class="id-check button">아이디중복확인</div>
                    </div>
                  </div>
                <div class="input d-flex flex-wrap mt-3">
                  <label for="captcha">자동가입방지문구 입력</label>
                    <div class="d-flex mb-3">
                    <img src="./asset/page/captcha.php" alt="captcha" title="captcha" id="capt_img">
                    <input type="text" name="capt" id="captcha" required>
	                <div class="new" onclick="refresh_captcha();">새로고침</div>
                    </div>
                </div>
                <div class="input mb-3">
                    <label for="pass">비밀번호</label>
                    <input type="password" class="input-text" name="pass" id="pass" required>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a href="/index" class="close pt-2">닫기</a>
            <button class="join-ok">가입하기</button>
        </div>
        </form>
    </div>
  </div>
</div>
<section class='blank'></section>
<?php } else {
    alert("로그인한 회원은 접근할 수 없습니다.");
    back();
} ?>