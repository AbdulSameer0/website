<?php require ("script.php") ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">

    <title>Web</title>
</head>

<body>
    <form action="" method="post">
        <h3>Add Details</h3>
        <div class="mb-3">
            <select class="form-select" name="type" aria-label="Default select example">
                <option selected>Select</option>
                <option value="1">Tenders</option>
                <option value="2">Circulars</option>
                <option value="3">EmpCriculars</option>
                <option value="4">Recruitments</option>
            </select>
        </div>
        <input type="title" name="title" value="" required>

        <label>Enter a Date</label>
        <input type="date" name="date" value="" required>

        <label for="formFileMultiple" class="form-label"></label>
        <input type="file" class="form-control" id="formFileMultiple" name="f1" multiple required>


        <input type="submit" name="submit" value="Send message" required>

        <p class="error"><?php echo @$error; ?></p>
        <p class="success"><?php echo @$success; ?></p>
    </form>

</body>

</html>