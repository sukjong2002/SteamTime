function search() {
    document.getElementById("load").style.visibility = "visible";
    $id = document.getElementById("id").value;
    $dat = Array();
    $isrunned = false;
    
    var idType = document.querySelector('input[name="exampleRadios"]:checked').value;
    console.log(idType);

    if($isrunned == false) {
        $.ajax({
            url: "./test.php",
            type: "GET",
            cache: false,
            dataType: "json",
            data: "id=" + $id + '&type=' + idType,
            success: function (data) {
                //var data = JSON.parse('{"GNum":75,"comuName":"sukjong0406","photo":"https:\\/\\/steamcdn-a.akamaihd.net\\/steamcommunity\\/public\\/images\\/avatars\\/fe\\/fef49e7fa7e1997310d705b2a6158ff8dc1cdfeb_full.jpg","0":{"id":227300,"time":927,"name":"Euro Truck Simulator 2"},"1":{"id":271590,"time":1260,"name":"Grand Theft Auto V"},"2":{"id":444090,"time":39,"name":"Paladins"},"3":{"id":518030,"time":1163,"name":"Aim Hero"},"4":{"id":447040,"time":2542,"name":"Watch_Dogs 2"},"5":{"id":698780,"time":214,"name":"Doki Doki Literature Club"},"6":{"id":757240,"time":6,"name":"Aimtastic"},"7":{"id":823130,"time":17,"name":"Totally Accurate Battlegrounds"},"8":{"id":582010,"time":437,"name":"MONSTER HUNTER: WORLD"},"9":{"id":223850,"time":104,"name":"3DMark"},"tData":10}');
                if(data.code != 404) {
                document.getElementById("row").style.visibility = "visible";
                $dat = data;
                document.getElementById("load").style.display = "none";
                var count = data.GNum;
                var totTime = 0;
                $('#cnt').text(count + "개의 게임");
                $('#test1').attr('src', data.photo);
                $('#username1').append(data.comuName);
                document.getElementById("prof").style.visibility = "visible";
                for (var i = 0; i < data.tData; i++) {
                    console.log(data[i].name);
                    $('#tb>tbody:last').append('<tr><td>' + data[i].name + '</td><td>' + data[i].time + '분</td>');
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
                }else{
                    console.log('error');
                }
            },
            error: function (request, status, error) {
                var msg = "ERROR: " + request.status + "<br>" + "내용: " + request.responseText + "<br>" + error + "<br>" + $id;
                console.log(msg);
                document.getElementById("load").style.display = "none";
                alert('서버 오류 발생. 오류코드: ' + request.status + ' 잠시후에 다시 시도해 주세요.');
            }
        });
    }else{
        console.log('t');
        $isrunned = false;
        search();
    }

}
function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}