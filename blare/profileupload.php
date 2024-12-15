<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>


    <title>Profileupload | Fetter</title>
</head>
<body>

    <form action="actions/profileupload_action.php" method="POST" enctype="multipart/form-data">
        <label for="file">Choose a photo to upload:</label>
        <input type="file" name="photo" id="file" required>
        <br><br>
        <input type="submit" value="Upload Photo">
    </form>

</body>
</html>