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
if ($result > 0) {
    header('Location: admin.php');
    return;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['Name']) || !isset($_POST['Year']) || !isset($_POST['Sex']) || !isset($_POST['Height']) || !isset($_POST['Weight']) || !isset($_POST['Cholesterol']))
    {
        echo json_encode(array('message' => 'Thiếu thông tin'));
        return;
    }
    // Gán giá trị
    $Name = $_POST['Name'];
    $Year = $_POST['Year'];
    $Sex = $_POST['Sex'];
    $Height = $_POST['Height'];
    $Weight = $_POST['Weight'];
    $Cholesterol = $_POST['Cholesterol'];
    $member_id = $_SESSION['User_ID'];

    $phone = '';
    $address = '';
    if (isset($_POST['Phone'])) {
        $phone = $_POST['Phone'];
    }
    if (isset($_POST['Address'])) {
        $address = $_POST['Address'];
    }

    if (!is_numeric($Year) || !is_numeric($Sex) || !is_numeric($Height) || !is_numeric($Weight) || !is_numeric($Cholesterol))
    {
        echo json_encode(array('message' => 'Thông tin không hợp lệ'));
        return;
    }

    // Insert to table calculate : member_id, name, birth, gender, height, weight, cholesterol, phone, address
    $sql = "INSERT INTO `calculate` (`member_id`, `name`, `birth`, `gender`, `height`, `weight`, `cholesterol`, `phone`, `address`) VALUES ('$member_id', '$Name', '$Year', '$Sex', '$Height', '$Weight', '$Cholesterol', '$phone', '$address')";
    $result = mysqli_query($conn, $sql);
    if (!$result)
    {
        echo json_encode(array('message' => 'Có lỗi xảy ra'));
        return; 
    }
    echo json_encode(array('message' => 'Thành công'));
    return;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./index.css" />
    <title>Form</title>

</head>

<body>
    <div class="logout"><a href="./logout.php">Đăng xuất</a></div>
    <img src="./assets/Logo-DH-Phenikaa-V-Wh.png" alt="Phenikaa" class="Logo" />
    <div class="Main">
        <h1>Tính toán tỉ lệ loãng xương của bạn</h1>
        <div class="Form">
            <div class="MainForm">
                <div class="name">
                    <p>Họ và tên:</p>
                    <input style="width: 100%" type="text" name="name" id="Name" />
                </div>
                <div class="sex">
                    <div>
                        <p>Năm sinh:</p>
                        <input type="text" name="year" id="Year" />
                    </div>
                    <div>
                        <p>Giới tính:</p>
                        <input type="radio" id="Nam" name="Sex" value="Nam" checked="checked" />
                        <label for="Nam">Nam</label>
                        <input type="radio" id="Nu" name="Sex" value="Nữ" />
                        <label for="Nu">Nữ</label>
                    </div>
                </div>
                <div class="sex">
                    <div>
                        <p>Chiều cao: (Cm)</p>
                        <input type="text" name="Height" id="Height" />
                    </div>
                    <div>
                        <p>Cân nặng: (Kg)</p>
                        <input type="text" name="weight" id="Weight" />
                    </div>
                </div>
                <div>
                    <p>Nồng độ Cholesterol trong máu:</p>
                    <select style="width: 100%; margin-bottom: 10px" name="Cholesterol" id="Cholesterol">
                        <option value="NoVal" default>Không rõ</option>
                        <option value="240">Trên 240mg/dl</option>
                        <option value="200">Dưới 200mg/dl</option>
                    </select>
                </div>
                <p>SDT:</p>
                <input style="width: 100%; margin-bottom: 10px" type="text" name="SDT" id="SDT" />
                <p>Địa chỉ:</p>
                <input style="width: 100%; margin-bottom: 10px" type="text" name="Address" id="Address" />
                <div style="display: flex; width: 100%; justify-content: center">
                    <button style="width: 60px; cursor: pointer; height: 30px" id="btn">
                        Tính
                    </button>
                </div>
            </div>
            <div class="Line"></div>
            <div id="result"></div>
        </div>
    </div>
    <div class="note">
        <h2 style="color: white">Chú thích:</h2>
        <p>Từ kết quả kiểm định 5 mô hình : Decision Tree (DT), Random Forest (RF),
            Support Vector Machine (SVM), K-Nearest Neighbors (KNN), Neural Network (NN) và Logistic Regression
            (LoR) , nhóm nhận thấy tuổi và cân nặng là các yếu tố quan trọng trong dự đoán nguy cơ loãng xương. Bên
            cạnh đó, nhóm nhận thấy mô hình LoR cho kết quả khá tốt và có thể dễ dàng xây dựng công thức hồi quy đơn
            giản mà hiệu quả từ tuổi và cân nặng để tính toán nguy cơ loãng xương. Vì thế, mô hình hồi quy logistic
            được huấn luyện trên bộ dữ liệu với các trường dữ liệu tuổi và cân nặng. Đầu ra của mô hình là nguy cơ
            loãng xương của bệnh nhân dựa trên T-score cổ xương đùi.</p>
    </div>
    <div class="footer"></div>
    <!-- aJax cdn -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="./index.js"></script>
</body>

</html>