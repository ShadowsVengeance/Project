<?php

function searchCostumes($term, $database) {

	$term = $term . '%';
	$sql = file_get_contents('sql/getCostumes.sql');
	$params = array(
		'term' => $term
	);
	$statement = $database->prepare($sql);
	$statement->execute($params);
	$costumes = $statement->fetchAll(PDO::FETCH_ASSOC);
	return $costumes;
}
function searchWeapons($term, $database) {

    $term = $term . '%';
    $sql = file_get_contents('sql/getWeapons.sql');
    $params = array(
        'term' => $term
    );
    $statement = $database->prepare($sql);
    $statement->execute($params);
    $costumes = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $costumes;
}

function get($key) {
	if(isset($_GET[$key])) {
		return $_GET[$key];
	}
	
	else {
		return '';
	}
}