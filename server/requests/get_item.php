<?
	require_once $_SERVER['DOCUMENT_ROOT'].'/server/db/collections_db.php';
	$json = file_get_contents('php://input');
	$body = json_decode($json, true);
	$col_id = $body['colId'];
	$item_id = $body['itemId'];

	$item = get_item($col_id, $item_id);
	$collection = get_collection($col_id);

	echo json_encode(["item" => $item, "collection" => $collection]);
?>