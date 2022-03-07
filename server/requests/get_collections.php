<?
	require_once $_SERVER['DOCUMENT_ROOT'].'/server/db/collections_db.php';

	$collections = get_all_collections();

	echo json_encode(["collections" => $collections]);
?>