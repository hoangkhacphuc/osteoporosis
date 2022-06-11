<?php
session_start();
if (!isset($_SESSION['User_ID'])) {
    header('Location: login.php');
    return;
}
include './database.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

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
    <script type="text/javascript" src="./index.js"></script>
</body>

</html>