<?php
require_once "./config.php";
require_once "./utils.php";
//require_once $snipPath ."utils.php";

// build weighted array from cards in selected set

$cards = array();
$chance = array();

$sql = "SELECT pa.playerAttributesID AS paID, cr.probability AS probs, cs.setCode, 
			   CONCAT(pa.position,' - ', pa.playerLastName,' (',cr.cardRarityDesc,')') AS cardLine
        FROM playerAttributes pa
		INNER JOIN cardSets cs ON pa.cardSetID = cs.cardSetID 
		INNER JOIN cardRarity cr ON pa.cardRarityID = cr.cardRarityID
		WHERE cs.setCode = 'UTB'";

$box = mysqli_query($link,$sql);
while($row = mysqli_fetch_assoc($box)) {

	array_push($cards,$row['cardLine']);
	array_push($chance,$row['prob']);

}

// set up the lookups
list($lookup, $totalProb) = calc_lookups($chance);

echo "<br /><hr><br />";

for ($x = 1; $x <= 10; $x++) {
	for ($y = 1; $y <= 5; $y++) {
		echo weighted_random($cards,$chance);
		echo '<br />';
	} 
	echo "<hr><br />";
}

?>