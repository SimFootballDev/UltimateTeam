<?php

// this will produce a set of five random selected card rarities
// need to build from here

// check the content of the "drawn set"
	// if 5 x N, remove one N and add a B

// then, for each rarity, draw a relevant card

	// NOTE: there is no weighting required for this, as there should be 
	//       equal chance of drawing any specific card within a specific rarity. 
	//       i.e. same chance of drawing any specific GOLD card

require_once "./config.php";
require_once "./utils.php";

$cards = array('G','S','B','N');
$chance = array(1,2,4,12);

if (!isset($_GET['packs'])) { $packs = 50; } else { $packs = $_GET['packs']; }
if (!isset($_GET['packSize'])) { $packSize = 5; } else { $packSize = $_GET['packSize']; }

for ($x = 1; $x <= $packs; $x++) {
	
	$val = 0;
	$pack = array();
	
	for ($y = 1; $y <= $packSize; $y++) {
		$drawn = weighted_random($cards,$chance);
		
		switch($drawn) {
			
			case 'G':
				$val += 12;
			break;
			case 'S':
				$val += 6;
			break;
			case 'B':
				$val += 3;
			break;
			case 'N':
				$val += 1;
			break;
			
		}
		
		array_push($pack,$drawn);
	} 
	echo join($pack,' ') . " -- Total value: " . $val . "<br />";
}

?>