
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, max-scale=1">
        <title>Juke</title>
        <script src="js/jquery-1.11.3.min.js"></script>
        <script type="text/javascript" src="js/script.js"></script>
        <link rel="stylesheet" href="css/style.css" type="text/css" />
    </head>
    <body>
        <div id="vidget">
            <div class="button"></div>
            <div class="vform">
                <span class="cross"></span>
                <form action="" method="post" enctype="multipart/form-data">
                    <p>Опишите в двух словах суть ошибки</p>
                    <textarea name="descrip" maxlength="250" required></textarea>
                    <input name="myfile" maxlength="60" type="file" required>
                    <input name="typename" type="text" maxlength="30" required   placeholder="Тема обращения">
                    <input type="submit"  placeholder="Отправить">
                    <?php
                    $path = 'files/';
                    $ext = array_pop(explode('.',$_FILES['myfile']['name']));
                    $new_name = time().'.'.$ext;
                    $full_path = $path.$new_name;
                    $types = array('jpg', 'png', 'bmp', 'jpeg');

                    if($_FILES['myfile']['error'] == 0) {
                        if(in_array($ext, $types)){
                        if (move_uploaded_file($_FILES['myfile']['tmp_name'], $full_path)) {
                            $Description = $_POST['descrip'];
                            $Name = $_POST['typename'];
                            $a = mysqli_connect('localhost', 'root', '', 'JukeWeb') or die('connection error');
                            $q = "SELECT * FROM Bug;";
                            $r = mysqli_query($a, $q) or die('error:' . mysqli_error());
                            $w = "INSERT INTO Bug( Name, Description, Image)VALUES('$Name', '$Description', '$full_path');";
                            $r = mysqli_query($a, $w);
                        }
                    }
                    }?>
                </form>
                <p class="cop">Juke © 2018</p>
            </div>
        </div>

    </body>
</html>