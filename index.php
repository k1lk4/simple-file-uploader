<!DOCTYPE html>
<html lang="ru">
<head>
	<title>PHP File Upload</title>
	<meta charset="UTF-8"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
<form method="POST" action="upload.php" enctype="multipart/form-data">
	<div>
		<span>Upload a File:</span>
        <br/>
        <div class="uploaders">
            <?php for($i = 0; $i <= 20; $i++) { ?>
		    <input class="uploader" type="file" name="uploadedFile" />
            <?php } ?>
        </div>
	</div>

    <br/>

	<input type="submit" name="uploadBtn" value="Upload" />
</form>
</body>
</html>