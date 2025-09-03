<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./resouces/bootstrap-5.2.0-dist/css/bootstrap.css">
    <link rel="stylesheet" href="./resouces/fontawesome-free-6.4.0-web/css/all.css">
    <link rel="stylesheet" href="./resouces/css/style.css">
    <title>Document</title>
</head>
<body>
<div class="modal login-modal" id="login-modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/asset/page/users/login.php" method="post">
        <div class="modal-body px-5">
        <img src="./resouces/images/login.png" class="m-4" alt="c1">
        <div class="input mb-3">
            <label for="id">아이디</label>
            <div class="d-flex">
            <input type="text" class="input-text" name="id" id="login-id" placeholder="아이디를 입력해주세요">
          </div>
        </div>
        <div class="input mb-3">
            <label for="pass">비밀번호</label>
            <input type="password" class="input-text" name="pass" id="login-pass">
        </div>
        <label for="user">회원구분</label>
        <div class="input user mb-3 mt-4">
            <input type="radio" name="user" id="ad" value="1">
            <input type="radio" name="user" id="man" value="2">
            <input type="radio" name="user" id="us" value="3">
            <select name="user" id="user" class='w-100 form-select'>
              <option value="not">-----------회원구분-----------</option>
              <option value="1">관리자</option>
              <option value="2">담당자</option>
              <option value="3">일반회원</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="close" data-bs-dismiss="modal">닫기</button>
          <input type="submit" value="로그인" class="login">
        </div>
      </form>
    </div>
  </div>
</div>
<header class="fixed-top w-100 pt-3">
    <div class="container">
        <div class="row">
            <div class="col-2 pt-2 mt-3">
                <a href="./index" class="overflow-hidden position-relative  mx-2 logo img">LOGO</a>
            </div>
            <div class="col-5 pt-2 mt-3 justify-content-around d-flex">
                <a href="./sub01" class="btn-a position-relative overflow-hidden tran">information</a>
                <a href="./sub02" class="btn-a position-relative overflow-hidden tran">statistics</a>
                <a href="./sub03" class="btn-a position-relative overflow-hidden tran">reservation</a>
                <a href="./sub04" class="btn-a position-relative overflow-hidden tran">goods</a>
            </div>
            <div class="col-2"></div>
            <div class="col-3 d-flex justify-content-end pt-2 mt-3">
                <?php if($idx == "") {?>
                  <div class="btn-a position-relative overflow-hidden tran login">로그인</div>
                  <?php } else {?>
                    <a href="/asset/page/users/logout.php" class="btn-a position-relative overflow-hidden tran login-out">로그아웃</a>
                  <?php }?>
                 <?php if($idx == "") {?>
                 <a href="/join" class="btn-a position-relative overflow-hidden tran mx-4 join">회원가입</a>
                 <?php } else { ?>
                    <a href="/mypage" class="btn-a position-relative overflow-hidden tran mx-4 mypage">마이페이지</a>
                  <?php }?>
            </div>
        </div>
    </div>
</header>