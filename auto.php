<?php
$xml=simplexml_load_file("auto.xml");
$autos=simplexml_load_file("auto.xml");
$bmws=$xml -> seria -> auto;
$volvos=$xml -> seriavo -> auto;
$merces=$xml -> seriame -> auto;
function searchByName($query){

    global $autos;
    $result=array();
    foreach ($autos->auto as $auto){
        if(substr(strtolower($auto->nimi), 0, strlen($query))==
            strtolower($query)){
            array_push($result, $auto);
        }
    }
    return $result;
}

//---------------------------Function Otsing----------------------
function searchbyMudel($searchWord){
    global $autos;
    $result=array();
    foreach ($autos->auto as $auto) {
        if(substr(strtolower($auto -> nimi), 0,
                strlen($searchWord))==strtolower($searchWord)){
            array_push($result, $auto);
        }
    }
    return $result;
}
function searchbyKeretyyp($searchWord){
    global $autos;
    $result=array();
    foreach ($autos->auto as $auto) {
        if(substr(strtolower($auto -> keretyyp), 0,
                strlen($searchWord))==strtolower($searchWord)){
            array_push($result, $auto);
        }
    }
    return $result;
}
function searchbyAasta($searchWord){
    global $autos;
    $result=array();
    foreach ($autos->auto as $auto) {
        if(substr(strtolower($auto -> aasta), 0,
                strlen($searchWord))==strtolower($searchWord)){
            array_push($result, $auto);
        }
    }
    return $result;
}

?>
<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <title>Auto kataloog</title>
</head>
<body>
    <h1>Auto kataloog</h1>
<form action="?" method="post">
    <input type="radio" name="searchBy" value="mark" id="mark" checked>
    <label for="mark">Mudel</label>
    <br>
    <input type="radio" name="searchBy" value="keretyyp" id="keretyyp">
    <label for="keretyyp">Keretüüp</label>
    <br>
    <input type="radio" name="searchBy" value="aasta" id="aasta">
    <label for="aasta">Aasta</label>
    <br>
    <input type="text" name="search" placeholder="search...">
    <button>Search</button>
    </form>
    <br><br>
<table border="1">
    <tr>
        <th>Mark</th>
        <th>Mudel</th>
        <th>Seria</th>
        <th>Keretüüp</th>
        <th>Aasta</th>
        <th>Mootor</th>
        <th>Kütus</th>
        <th>Käigukast</th>
    </tr>
    <?php
    if (!empty($_POST["search"])){
        $radiobutton=$_POST["searchBy"];
        if ($radiobutton== "mark"){
            $result=searchbyMudel($_POST["search"]);
        }else if($radiobutton== "keretyyp"){
            $result=searchbyKeretyyp($_POST["search"]);
        }else if($radiobutton== "aasta"){
            $result=searchbyAasta($_POST["search"]);
        }
        foreach ($result as $auto){
            echo '<tr>';
            echo '<td>'.($auto -> attributes() -> id).'</td>';
            echo '<td>'.($auto -> nimi).'</td>';
            echo '<td>'.($auto -> seria).'</td>';
            echo '<td>'.($auto -> keretyyp).'</td>';
            echo '<td>'.($auto -> aasta).'</td>';
            echo '<td>'.($auto -> mootor).'</td>';
            echo '<td>'.($auto -> kytus).'</td>';
            echo '<td>'.($auto -> kaigukast).'</td>';
            echo '</tr>';
        }
}else{
    foreach ($autos->auto  as $auto){
        echo '<tr>';
        echo '<td>'.($auto -> attributes() -> id).'</td>';
        echo '<td>'.($auto -> nimi).'</td>';
        echo '<td>'.($auto -> seria).'</td>';
        echo '<td>'.($auto -> keretyyp).'</td>';
        echo '<td>'.($auto -> aasta).'</td>';
        echo '<td>'.($auto -> mootor).'</td>';
        echo '<td>'.($auto -> kytus).'</td>';
        echo '<td>'.($auto -> kaigukast).'</td>';
        echo '</tr>';
    }
    }
    ?>
</table>
    <form action="auto.xml" target="_blank">
        <button>Переход по ссылке</button>
    </form>

</body>
</html>