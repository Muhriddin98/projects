<?php
    include 'config.php';
    include 'libs.php';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles/bootstrap.css">
    <title>Create db</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="" method="post" class="form-control d-flex flex-column align-items-center formdb">
                    <label for="db" class="h4">DB name: </label>
                    <input type="text" name="dbname" id="db" class="form-control text-center" required>
                    <hr>
                    <input type="submit" name="senddb" value="Create DB" class="btn btn-primary senddb">
                    <hr>
                </form>
                <?php if (isset($_POST['senddb'])) :?>
                    <script>
                        let dbn = document.querySelector('#db');
                        let db = document.querySelector('.formdb');
                        let btndb = document.querySelector('.senddb');
                        btndb.addEventListener('click', (e)=>{
                            e.preventDefault();
                            btndb.disabled = true;
                            dbn.setAttribute("readonly", "");
                        })
                    </script>
                <?php
                    $dbname = strip_tags(addslashes($_POST['dbname']));
                    createDB($dbname);
                ?>
                    <form action="test.php" method="post" class="form-control d-flex align-items-center justify-content-center">
                        <div class="col-4">
                            <label for="tb" class="h5">Table name: </label>
                            <input type="text" name="tbname" id="tb" class="form-control text-center" required>
                            <hr>
                        </div>
                        <div class="col-4">
                            <label for="count" class="h5">Column count: </label>
                            <input type="number" name="count" id="count" class="form-control text-center" min="1" required>
                            <hr>
                        </div>
                        <input type="hidden" name="dbname" value="<?=$dbname; ?>">
                        <input type="submit" name="sendtb" value="Create table" class="btn btn-primary sendtb">
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>

