

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>


    <title>addProfile | Fetter</title>
</head>
<body>
        <div class="container">
            <h1 class="my-5">Add new profile</h1>
            <form action="" method="POST" enctype="multipart/form-data" class="mb-3">
                <div class="mb-3">
                    <label class="formlabel">Product Name</label>
                    <input type="text" name="profile_name" id="profile_name"
                    class="form-control form-control-lg">
                </div>
                <div class="mb-3">
                    <label class="formlabel">Product Desciption</label>
                    <textarea row="5" name="description" id="description" class="form-control">
                    </textarea>
                </div>
                <button type="submit" name="submit" class="bg-primary btn btn-lg my-4">Save</button>
            </form>
        </div>
</body>
</html>