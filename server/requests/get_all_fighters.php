<?
	require_once $_SERVER['DOCUMENT_ROOT'].'/server/requests/fighters.php';

	$fighters = get_all_warriors();

	echo json_encode(["fighters" => $fighters]);
?>