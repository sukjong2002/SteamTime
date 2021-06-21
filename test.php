<?php
    $key = 'ENTER_YOUR_STEAM_API_KEY';
        $sId = htmlspecialchars($_GET['id']);
$idType = $_GET['type'];


    if($sId != "" && $idType != "") {
        $getId = 'http://api.steampowered.com/ISteamUser/ResolveVanityURL/v0001/?key=' . $key . '&vanityurl=' . $sId;
        if($idType == 'option2') {
            $tmpIdJson = json_decode(file_get_contents($getId));
            $sId = htmlspecialchars($tmpIdJson->response->steamid);
        }
            $url = 'http://api.steampowered.com/IPlayerService/GetOwnedGames/v0001/?key=' . $key .'&steamid=' . $sId . '&format=json';
        $json = file_get_contents($url);
        $gList = json_decode(file_get_contents('http://api.steampowered.com/ISteamApps/GetAppList/v0002/'));
        $userProfile = json_decode(file_get_contents('http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=' . $key . '&steamids=' . $sId));
        $obj = json_decode($json);
//    print_r($obj);

        //   echo $obj->response->game_count . 'games.<br>';
        //  echo $json;
        if(!$obj->response->game_count == 0) {
            $games = array();
            $num = 0;
            $min_tot = 0;
            //$games['message'] = 'SUCCESS';
            //$games['code'] = 200;
            $games['GNum'] = $obj->response->game_count;
            $games['comuName'] = $userProfile->response->players[0]->personaname;
            $games['photo'] = $userProfile->response->players[0]->avatarfull;
            foreach ($obj->response->games as $r) {
                //echo $r->game_count;
//        echo $r->playtime_forever . "\n";
                if ($r->playtime_forever != '0') {
                    $games[$num]['id'] = $r->appid;
                    $games[$num]['time'] = $r->playtime_forever;
                    $min_tot += (int)$r->playtime_forever;

                    foreach ($gList->applist->apps as $gi) {
                        if ($gi->appid == $r->appid) {
                            $games[$num]['name'] = $gi->name;
                        }
                    }
                    $games[$num]['banner'] = 'http://cdn.akamai.steamstatic.com/steam/apps/'.strval($r->appid).'/header.jpg';
                    $num++;
                }
            }
            $games['tData'] = $num;
            //print_r($games);
            echo json_encode($games);
        }else{
            header('HTTP/1.1 500 Internal Server');
            header('Content-Type: application/json; charset=UTF-8');
            die(json_encode(array('message' => 'ERROR', 'code' => 404)));
        }
    }else{
        return 0;
    }

