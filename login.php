<?php
    session_start();
    echo $_SESSION['User_ID'];
    if(isset($_SESSION['User_ID'])){
        header('Location: index.php');
        return;
    }
    include './database.php';
    if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        if (!isset($_POST['username']) || !isset($_POST['password']))
        {
            ?>
            <script>
                alert('Vui lòng nhập đầy đủ thông tin');
            </script>
            <?php
        }
        else {
            $username = $_POST['username'];
            $password = md5($_POST['password']);
            $sql = "SELECT * FROM `member` WHERE `username` = '$username' AND `password` = '$password'";
            $result = mysqli_query($conn, $sql);
            if (!$result)
            {
                ?>
                <script>
                    alert('Lỗi kết nối !');
                </script>
                <?php
            }
            else {
                $row = mysqli_num_rows($result);
                if ($row == 0)
                {
                    ?>
                    <script>
                        alert('Tài khoản hoặc mật khẩu không đúng !');
                    </script>
                    <?php
                }
                else {
                    $row = mysqli_fetch_assoc($result);
                    $_SESSION['User_ID'] = $row['id'];
                    header('Location: index.php');
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <form action="./login.php" method="POST" class="col-md-6 offset-md-3" style="margin-top: 30px">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="text-center">Đăng nhập</h3>
                        </div>
                        <div class="card-body">
                            <form action="login.php" method="POST">
                                <div class="form-group">
                                    <label for="username">Tên đăng nhập</label>
                                    <input type="text" class="form-control" name="username" id="username" placeholder="Tên đăng nhập">
                                </div>
                                <div class="form-group">
                                    <label for="password">Mật khẩu</label>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Mật khẩu">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Đăng nhập</button>
                                </div>
                            </form>
                        </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>