<?
	require_once $_SERVER['DOCUMENT_ROOT'].'/server/db/fighters_db.php';

	$fighters = get_all_warriors();

	echo json_encode(["fighters" => $fighters]);
?>