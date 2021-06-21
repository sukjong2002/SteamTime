<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>SteamTime</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="./mainstyle.css">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@4.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css">
    <script src="https://unpkg.com/jquery@3.4.1/dist/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="./main.js"></script>
</head>

<body>
    <div id="container" style="margin: 30px;">
        <div class="album py-5 bg-light">
            <center style="font-weight: bold;"><a href="./index.php" id="mTitle">스팀에 낭비한 시간은?</a></center>
            <div id="input">
                <form action="./detail.php" method="get">
                    <div class="input-group mb-3">
                        <a style="font-size: 20px; margin-right: 5px;">https://steamcommunity.com/id/</a>
                        <input type="text" class="form-control" placeholder="Steam ID" aria-label="Steam ID" aria-describedby="button-addon2" name="id" id="id">
                        <div class="input-group-append">
                            <input type="submit" class="btn btn-outline-primary" value="검색">
                        </div>
                    </div>
                    <!-- <div class="form-check">
  <input class="form-check-input radio-inline" type="radio" name="type" id="defId" value="option1" checked>
  <label class="form-check-label" for="exampleRadios1">
    스팀 기본ID(숫자로만 구성)
  </label>
</div>
<div class="form-check">
  <input class="form-check-input btn btn-primary" type="radio" name="type" id="cusId" value="option2">
  <label class="form-check-label" for="exampleRadios2">
    스팀 사용자 설정 ID
  </label>
</div> -->
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-outline-primary">
                            <input type="radio" name="type" id="defId" autocomplete="off" value="option1"> 스팀 기본ID(숫자로만
                            구성)
                        </label>
                        <label class="btn btn-outline-primary">
                            <input type="radio" name="type" id="cusId" autocomplete="off" value="option2"> 스팀 사용자 설정 ID
                        </label>
                    </div>

                </form>
            </div>
            <center><a href="https://steamcommunity.com/" target="_blank">스팀커뮤니티 바로가기</a></center>
            <center>
                <p>© 2019 smaroid.tk | Data based on Steam, Valve Inc.</p>
            </center>
        </div>
    </div>
</body>

</html>