<?php
session_start();
if (!isset($_SESSION['User_ID'])) {
    header('Location: login.php');
    return;
}
include './database.php';

$sql = "SELECT * FROM `member` WHERE `id` = '$_SESSION[User_ID]' AND `user_type` = 1";
$result = mysqli_query($conn, $sql);
$result = mysqli_num_rows($result);
if ($result == 0) {
    header('Location: admin.php');
    return;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <style>
        body {
            min-height: 100vh;
            background: url('./assets/bg.jpg') no-repeat center center fixed;
            background-size: cover;
        }
        .logout {
            width: 100%;
            text-align: end;
            position: absolute;
            top : 0;
            text-decoration: none;
            color: #79be73;
            right: 20px;
            padding: 10px;
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="logout"><a href="./logout.php">Đăng xuất</a></div>
            <div class="col-md-12">
                <h1>Danh sách thông tin</h1>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Họ tên</th>
                            <th>Năm sinh</th>
                            <th>Giới tính</th>
                            <th>Chiều cao</th>
                            <th>Cân nặng</th>
                            <th>Cholesterol</th>
                            <th>Số điện thoại</th>
                            <th>Địa chỉ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM `calculate` ORDER BY `calculate`.`created_at` DESC";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['name'] . "</td>";
                                echo "<td>" . $row['birth'] . "</td>";
                                echo "<td>" . ($row['gender'] == 0 ? 'Nữ' : 'Nam'). "</td>";
                                echo "<td>" . $row['height'] . "cm</td>";
                                echo "<td>" . $row['weight'] . "kg</td>";
                                echo "<td>" . ($row['cholesterol'] == 0 ? 'Không rõ' : ($row['cholesterol'] == 1 ? 'Dưới 200ml/dl' : 'Trên 240ml/dl')) . "</td>";
                                echo "<td>" . $row['phone'] . "</td>";
                                echo "<td>" . $row['address'] . "</td>";
                                echo "</tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>