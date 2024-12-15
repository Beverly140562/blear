<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fetter | Update <?php echo $email;?> </title>
</head>
<body>
    
        <form action="process.php" method="post">
            <div class="form-group ">
                <input type="text" class="form-control" name="username" placeholder="Username">
            </div>
            <div class="form-group">
                Gender:<br>
                <select id="text" class="form-select form-control" name="gender">
                    <option>Male</option>
                    <option>Female</option>
                </select>
            </div>
            <div class="form-group">
            Birthdate:<br>
                <input type="date" id="birthday" class="form-control" name="birthdate" placeholder="Birthdate">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                <span class="show_hide_text cursor-pointer" id="show_hide_password">Show</span>
            </div>

            <div class="for-btn text-center rounded">
            <input type="submit" class="btn text-white fw-bold" value="Update" name="update">
            </div>
        </form>

</body>
</html>