<?php
$input = file_get_contents ("lines.csv");

$asdf = explode("\n", $input);

$elements=array();

sleep(2);
echo("Parsing CSV\n");

foreach($asdf as $bsdf){
	$bsdf=explode(",", $bsdf);
	for($i=0;$i<3;$i++){
		$bsdf[$i]=str_replace('"','',$bsdf[$i]);
	}
	if(isset($bsdf[0]) && isset($bsdf[1]) && isset($bsdf[2])){
		$intensity = preg_replace(array('/[^\d,]/','/(?<=,),+/','/^,+/','/,+$/'),'',$bsdf[2]);

		if($intensity!='' && $bsdf){
			$out[0]=$bsdf[0];
			$out[1]=$bsdf[1];
			$out[2]=$intensity;
			array_push($elements,$out);
		}else
			echo("Dropped: ".$bsdf[0]."\n");
	}
}

echo("done\n");
sleep(2);
echo("Adding Elements: ");
sleep(2);
$outJSON=array();
foreach($elements as $element){
	$outJSON[$element[0]]=array($element[1],$element[2]);
	//$mysqli->query("INSERT INTO elements (element, wavelength, intensity) VALUES ('$element[0]',$element[1],$element[2])");
	echo("$element[0]".", ");
}
echo(json_encode($outJSON));

//$mysqli->close();

?>
