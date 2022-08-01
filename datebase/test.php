<?php
    include 'config.php';
    include 'libs.php';
    if (isset($_POST['sendtb'])) {
        $count = $_POST['count'];
        $tbname = strip_tags(addslashes($_POST['tbname']));
        $dbname = $_POST['dbname'];
    } 
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles/bootstrap.css">
    <title>Document</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row ">
            <div class="col-12 pt-1 pb-1">
                <form action="save.php" method="post">
                    <input type="hidden" name="dbname" value="<?=$dbname; ?>">
                    <input type="hidden" name="count" value="<?=$count; ?>">
                    <input type="hidden" name="tbname" value="<?=$tbname; ?>">
                    <table class="table table-bordered table-hover" style="background: #9fcdff">
                        <thead>
                        <th>#</th>
                        <th>Name: </th>
                        <th>Type: </th>
                        <th>Length: </th>
                        <th>Attribute: </th>
                        <th>Not Null: </th>
                        <th>Index: </th>
                        <th>A_I: </th>
                        </thead>
                        <?php for ($i=1; $i<=$count; $i++): ?>
                            <tr>
                                <td><?=$i; ?></td>
                                <td>
                                    <input type="text" name="name<?=$i; ?>" class="form-control" required>
                                </td>
                                <td>
                                    <select name="type<?=$i; ?>" class="form-control" id="">
                                        <option>INT</option>
                                        <option>VARCHAR</option>
                                        <option>TEXT</option>
                                        <option>ENUM</option>
                                        <option>DATE</option>
                                        <option>DATETIME</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" name="length<?=$i; ?>" class="form-control">
                                </td>
                                <td>
                                    <select name="attr<?=$i; ?>" class="form-control" id="">
                                        <option> </option>
                                        <option>BINARY</option>
                                        <option>UNSIGNED</option>
                                        <option>UNSIGNED ZEROFILL</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="checkbox" name="null<?=$i; ?>" class="form-control" value="NOT NULL">
                                </td>
                                <td>
                                    <select name="index<?=$i; ?>" class="form-control" id="">
                                        <option> </option>
                                        <option value="PRIMARY KEY">PRIMARY</option>
                                        <option>UNIQUE</option>
                                        <option>INDEX</option>
                                        <option>FULLTEXT</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="checkbox" name="auto<?=$i; ?>" class="form-control" value="AUTO_INCREMENT">
                                </td>
                            </tr>
                        <?php endfor; ?>
                    </table>
                    <input type="submit" name="ok" value="Create table" class="btn btn-info d-block m-auto">
                </form>
            </div>
        </div>
    </div>
</body>
</html>