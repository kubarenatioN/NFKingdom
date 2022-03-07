<?
	require_once $_SERVER['DOCUMENT_ROOT'].'/server/db/collections_db.php';
	$json = file_get_contents('php://input');
	$body = json_decode($json, true);
	$id = $body['id'];

	$items = get_collection_items($id);
	$collection = get_collection($id);

	echo json_encode(["items" => $items, "collection" => $collection]);
?>