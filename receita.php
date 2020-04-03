<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Gerador de receita aleatoria</title>
</head>

<body>
<form method="POST" action="receita.php" align="center">
        <input type="submit" name='press'value="Gerar Receita">
</form>
<?php 
if(isset($_POST["press"])){
$link = "https://www.themealdb.com/api/json/v1/1/random.php";

$ch = curl_init($link);

curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,0);

$response = curl_exec($ch);

curl_close($ch);

$data = json_decode($response,true);

$receita=$data["meals"][0];

echo "<div style=' position: relative; width:40%; height:30%; float: left;'>";
echo "<img src=".$receita["strMealThumb"]." alt='some text' width=100% height=20%>";
echo "</div>";
echo "<div style='width:40%; height:50%; position: absolute; top: 30px; left: 41%; float: left;'>";
echo "<h1>".$receita["strMeal"]." </h1>";
echo "<p>".str_replace('. ', '.<br>', $receita["strInstructions"])."</p>";
echo "</div>";

echo "<div style='position: relative; width: 100%; float: left; '>";

echo "<h4>Category: ".$receita["strCategory"]."</h4>";
echo "<h3>Ingredients:</h3>";

echo "<ul>";

for($i=1; $i<20; $i++){

    if(isset($receita["strIngredient$i"]) && $receita["strIngredient$i"] !=''){
        echo "<li>".$receita["strIngredient$i"]." - ".$receita["strMeasure$i"]."</li>";
    }

}

echo "</div>";
$correto = "/embed"."/";

$video = str_replace('/watch?v=', $correto, $receita["strYoutube"]);

echo "</ul>";
echo "<div style='position: relative; width:850px; height:500px; left: 10px;'>";

echo "<iframe width='100%' height='100%' src=".$video." allowfullscreen></iframe>";

echo "</div>";
}
?>
</body>

</html>

