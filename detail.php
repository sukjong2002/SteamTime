<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SteamTime</title>
    <link rel="stylesheet" type="text/css" href="./mainstyle.css">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@4.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css">
    <script src="https://unpkg.com/jquery@3.4.1/dist/jquery.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>

<body>
    <div id="container" style="margin: 30px;">
        <div class="album py-5 bg-light">
            <center style="font-weight: bold;"><a href="./index.php" id="mTitle">스팀에 낭비한 시간은?</a></center>
            <div id="input">
                <form action="./detail.php" method="get">
                    <div class="input-group mb-3">
                        <a style="font-size: 20px; margin-right: 5px;">https://steamcommunity.com/id/</a>
                        <input type="text" class="form-control" placeholder="Steam ID" aria-label="Steam ID" aria-describedby="button-addon2" name="id" id="id" value=<? echo $_GET['id'] ?>>
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
                            <input type="radio" name="type" id="defId" autocomplete="off" value="option1" <?if($_GET['type']=='option1' ) echo 'checked="checked"' ?>> 스팀 기본ID(숫자로만
                            구성)
                        </label>
                        <label class="btn btn-outline-primary">
                            <input type="radio" name="type" id="cusId" autocomplete="off" value="option2" <?if($_GET['type']=='option2' ) echo 'checked="checked"' ?>> 스팀 사용자 설정 ID
                        </label>
                    </div>
            </div>
            <img src="./ajax-loading-icon-2.jpg" id="load">
            <div class="row" id="row">
                <div id="topattr" style="width: 100%" class="col-md-5">
                    <div style="visibility: hidden;" id="prof" class="card mb-3 shadow-sm">
                        <img class="bd-placeholder-img card-img-top" id="test1" width="100%" height="50%" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail" style="max-width: 250px;">
                        <title>
                            Placeholder</title>
                        <div class="card-body">
                            <p class="card-text" id="username1" style="font-size: 30px;"></p>
                        </div>
                    </div>
                    <div class="card mb-3 shadow-sm">
                        <p style="padding: 10px;">총 보유 게임</p>
                        <p id="cnt" style="font-size: 30px; font-weight: bold;"></p>
                    </div>
                    <div id="tab">
                        <div class="card mb-3 shadow-sm" style="height: 250px;">
                            <table id="tb">
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-7" style="width: 100%;" id="tab1">
                    <p id="uname"></p>
                    <table id="timetable" style="width: 100%;">
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<script>
    <?php
    $tmpId = $_GET['id'];
    $tmpId = str_replace('<', '*', $tmpId);
    $tmpId = str_replace('>', '*', $tmpId);
    $tmpId = str_replace(')', '*', $tmpId);
    $tmpId = str_replace('(', '*', $tmpId);
    ?>
    document.getElementById("load").style.visibility = "visible";
    $id = <?php echo ("'" . $tmpId . "';"); ?>
    $dat = Array();
    $isrunned = false;

    var idType = <?php echo ("'" . $_GET['type'] . "';"); ?>
    console.log(idType);

    if ($isrunned == false) {
        $.ajax({
            url: "./test.php",
            type: "GET",
            cache: false,
            dataType: "json",
            data: "id=" + $id + '&type=' + idType,
            success: function(data) {
                //var data = JSON.parse('{"GNum":75,"comuName":"sukjong0406","photo":"https:\\/\\/steamcdn-a.akamaihd.net\\/steamcommunity\\/public\\/images\\/avatars\\/fe\\/fef49e7fa7e1997310d705b2a6158ff8dc1cdfeb_full.jpg","0":{"id":227300,"time":927,"name":"Euro Truck Simulator 2"},"1":{"id":271590,"time":1260,"name":"Grand Theft Auto V"},"2":{"id":444090,"time":39,"name":"Paladins"},"3":{"id":518030,"time":1163,"name":"Aim Hero"},"4":{"id":447040,"time":2542,"name":"Watch_Dogs 2"},"5":{"id":698780,"time":214,"name":"Doki Doki Literature Club"},"6":{"id":757240,"time":6,"name":"Aimtastic"},"7":{"id":823130,"time":17,"name":"Totally Accurate Battlegrounds"},"8":{"id":582010,"time":437,"name":"MONSTER HUNTER: WORLD"},"9":{"id":223850,"time":104,"name":"3DMark"},"tData":10}');
                if (data.code != 404) {
                    document.getElementById("row").style.visibility = "visible";
                    $dat = data;
                    document.getElementById("load").style.display = "none";
                    var count = data.GNum;
                    var totTime = 0;
                    $('#cnt').text(count + "개");
                    $('#test1').attr('src', data.photo);
                    $('#username1').append(data.comuName);
                    document.getElementById("prof").style.visibility = "visible";
                    //플탐 높은 순 정렬
                    var pMax; //[1,2,3]
                    for (let i = 0; i < data.tData - 1; i++) {
                        pMax = i
                        for (let j = i + 1; j < data.tData; j++) {
                            if (data[j].time > data[pMax].time) {
                                pMax = j;
                            }
                        }
                        tmp = data[i];
                        data[i] = data[pMax];
                        data[pMax] = tmp;

                    }
                    for (var i = 0; i < data.tData; i++) {
                        console.log(data[i].name);
                        $('#tb>tbody:last').append('<tr><td><img class="banner" src="'+data[i].banner+'"></td><td><a href="https://store.steampowered.com/app/'+ data[i].id +'">'+ data[i].name + '</td><td>' + data[i].time + '분</td>');
                        if (data[i].time >= 60) {
                            $('#tb>tbody>tr:last').append('<td>' + Math.round(data[i].time / 60 * 10) / 10 + '시간</td></tr>');
                        } else {
                            $('#tb>tbody>tr:last').append('</tr>');
                        }
                        totTime += data[i].time;
                    }
                    console.log(totTime);
                    $('#uname').append(data.comuName + '님이 지금까지 스팀에 쓴 시간은');
                    $('#timetable>tbody:last').append('<div class="card mb-3 shadow-sm" id="tcard1"><tr><td><p style="font-size: 40px; font-weight: bold;"> ' + Math.round(totTime / 60 * 10) / 10 + '시간</p>입니다.</td></tr></div>');
                    $('#timetable>tbody:last').append('<div class="card mb-3 shadow-sm" id="tcard1"><tr><td><p id="tdesc1">최저임금 8590원 기준</p></td></tr><tr><td><div style="overflow: hidden;"> <p id="tdesc2"><i class="fas fa-wallet"></i> ' + numberWithCommas(Math.round(totTime * 143.17)) + '원</p> 벌 수 있었습니다.</div></td></tr></div>');
                    $('#timetable>tbody:last').append('<div class="card mb-3 shadow-sm" id="tcard1"><tr><td><p id="tdesc1">3분카레를 무려</p></td></tr><tr><td><div style="overflow: hidden;"> <p id="tdesc2"><i class="fas fa-utensils"></i> ' + numberWithCommas(Math.floor(totTime / 3)) + '개</p>를 끓일 수 있습니다' + '</div></td></tr></div>');
                    $('#timetable>tbody:last').append('<div class="card mb-3 shadow-sm" id="tcard1"><tr><td><p id="tdesc1">축구경기를</p></td></tr><tr><td><div style="overflow: hidden;"> <p id="tdesc2"><i class="fas fa-futbol"></i> ' + Math.floor(totTime / 90) + '판</p>할 수 있습니다.</div></td></tr></div>');
                    $('#timetable>tbody:last').append('<div class="card mb-3 shadow-sm" id="tcard1"><tr><td><p id="tdesc1">서울에서 부산까지 KTX로</p></td></tr><tr><td><div style="overflow: hidden;"> <p id="tdesc2"><i class="fas fa-train"></i> ' + Math.floor(totTime / 165) + '번</p>갈 수 있습니다.</div></td></tr></div>');
                    console.log(data);
                    $isrunned = true;
                } else {
                    console.log('error');
                }
            },
            error: function(request, status, error) {
                var msg = "ERROR: " + request.status + "<br>" + "내용: " + request.responseText + "<br>" + error + "<br>" + $id;
                console.log(msg);
                document.getElementById("load").style.display = "none";
                alert('서버 오류 발생. 오류코드: ' + request.status + ' 잠시후에 다시 시도해 주세요.');
            }
        });
    } else {
        console.log('t');
        $isrunned = false;
        search();
    }

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
</script>