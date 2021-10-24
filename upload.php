<?php
$types = [
	"image/png" => "png",
	"image/jpeg" => "jpg",
	"image/gif" => "gif"
];
$upload_dir = './pictures/';
$upload_file = md5(date(DATE_ATOM, time()) . basename($_FILES['uploaded_file']['name']))
. '.' . $types[$_FILES['uploaded_file']['type']];
$upload_path = $upload_dir . $upload_file;
$api_url = "test-forum-api.herokuapp.com/api/file/";

$fields = array ();

$data = [];

print '<pre>';

if (move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $upload_path)) {
	$fields = [
		"url" => $upload_path,
	];

	$data = json_encode($fields);

	$curl = curl_init($api_url);

	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_HEADER, false);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Content-Length: ' . strlen($data))
	);

	$curl_result = curl_exec($curl);
	if($curl_result === false) {
		die(curl_error($curl));
	}
	curl_close($curl);

} /*else {
	echo "Возможная атака с помощью файловой загрузки!\n";
}*/


echo 'Некоторая отладочная информация:';
print_r($_FILES);
// print_r($headers);


print '</pre>';


print '</pre>';
