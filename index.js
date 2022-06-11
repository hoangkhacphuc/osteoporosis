const nameInput = document.getElementById('Name');
const yearInput = document.getElementById('Year');
const HeightInput = document.getElementById('Height');
const WeightInput = document.getElementById('Weight');
const CholesterolInput = document.getElementById('Cholesterol');
const sexInput = document.getElementsByName('Sex');
const btn = document.getElementById('btn');
const PrintResult = document.getElementById('result');

let year = '';
let name = '';
let Height = '';
let Weight = '';
let BMI = '';
let sex = 'Nam';
let Cholesterol = '';
let YearResult = '';

nameInput.addEventListener('change', (e) => {
  name = e.target.value;
});
yearInput.addEventListener('change', (e) => {
  year = e.target.value;
});
HeightInput.addEventListener('change', (e) => {
  Height = e.target.value;
});
WeightInput.addEventListener('change', (e) => {
  Weight = e.target.value;
});

btn.addEventListener('click', () => {
  if (name === '' || year === '' || Height === '' || Weight === '') {
    // alert('Vui lòng nhập đầy đủ thông tin');
    return;
  } else {
    let bmiTemp = Weight / ((Height / 100) * (Height / 100));
    if (bmiTemp >= 40) {
      BMI = 40;
    } else if (40 > bmiTemp && bmiTemp >= 35) {
      BMI = 23;
    } else if (35 > bmiTemp && bmiTemp >= 30) {
      BMI = 10;
    } else if (30 > bmiTemp && bmiTemp >= 25) {
      BMI = 1;
    } else if (bmiTemp < 10) {
      BMI = 50;
    } else if (10 <= bmiTemp && bmiTemp < 15) {
      BMI = 10;
    } else if (15 <= bmiTemp && bmiTemp < 18) {
      BMI = 1;
    } else {
      BMI = 0;
    }
    if (parseInt(year) >= 1973) {
      YearResult = 0;
    } else {
      YearResult = (1973 - parseInt(year)) * 2;
    }
    if (CholesterolInput.value == '240') {
      Cholesterol = 20;
    } else {
      Cholesterol = 0;
    }
    for (let i = 0; i < sexInput.length; i++) {
      if (sexInput[i].checked) {
        sex = sexInput[i].value;
      }
    }
    // console.log(parseInt(bmiTemp, 10), BMI, YearResult, Cholesterol);
    let result = (BMI + Cholesterol + YearResult);
    PrintResult.innerHTML = `<div style="text-align: center">
    <h2>Kết quả:</h2>
    <p>${name}, ${sex}</p>
    <p>BMI: ${bmiTemp.toFixed(3)}</p>
    <p>Tỉ lệ loãng xương: ${result}%</p>
  </div>`;
  }
});



$(document).ready(function () {
    $('#btn').click(function (e) { 
        e.preventDefault();

        let data = {
            Name: $('#Name').val(),
            Year: $('#Year').val(),
            Height: $('#Height').val(),
            Weight: $('#Weight').val(),
            Cholesterol: $('#Cholesterol').val() == "NoVal" ? 0 : ($('#Cholesterol').val() == 240 ? 2 : 1),
            Phone: $('#SDT').val(),
            Address: $('#Address').val(),
            Sex: $('input[name="Sex"]:checked').val() == "Nam" ? 1 : 0,
        };
        // POST request
        $.ajax({
            url: './index.php',
            type: 'POST',
            data: data
        })
        .done(function (data) {
            data = JSON.parse(data);
            alert(data.message);
        }
        )
        .fail(function () {
            alert("Có lỗi xảy ra");
        }
        );

        
    });
});