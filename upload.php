<?php
$upload_dir = 'D:\\php-uploadfiles\\';
$upload_file = basename($_FILES['uploadedFile']['name']);
$upload_path = $upload_dir . $upload_file;
$api_url = "test-forum-api.herokuapp.com/api/file/";

$types = [
	"image/png" => "PNG",
	"image/jpeg" => "JPEG",
	"image/gif" => "GIF"
];

$fields = array ();

print '<pre>';

if (move_uploaded_file($_FILES['uploadedFile']['tmp_name'], $upload_path)) {
	$fields = [
		"extension" => $_FILES['uploadedFile']['type'],
		"path" => $upload_path,
	];

	$curl = curl_init($api_url);

	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $fields);

	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_HEADER, false);

	$curl_result = curl_exec($curl);
	if($curl_result === false) {
		die(curl_error($curl));
	}
	curl_close($curl);

	print_r($curl_result);

} /*else {
	echo "Возможная атака с помощью файловой загрузки!\n";
}*/


echo 'Некоторая отладочная информация:';
print_r($_FILES);


print '</pre>';