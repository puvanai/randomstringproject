
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
  <div class="container my-5"> 
  <div  class="text-center">รายชื่อข้อมูลที่ส่งเข้าไปในฐานข้อมูล</div><br>
    <?php

$con =mysqli_connect("localhost","root","","mystring");

// รับข้อมูลของข้อความสุ่มจากหน้าindex.phpจากบรรทัด60
$randomStrings = explode(',', $_POST['random_strings']);

// นำข้อมูลของข้อความสุ่มไปแสดง
echo '<ol>';
$submitted = false;
$duplicate = false;
foreach ($randomStrings as $string) {//ฟังก์ชันนี้จะทำการวนลูปอาร์เรย์
    $sql = "SELECT * FROM strings WHERE string = '$string'"; //ค้นหาข้อมูลในฐานข้อมูล หากมีข้อมูลซ้ำในฐานข้อมูลจะแสดงข้อความ 'ข้อมูลซ้ำถ้าไมซ้ำก็ให้มันเอาเข้าในฐานข้อมูล
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) > 0) {
        $duplicate = true;
        echo '<li>' . $string . ' (ข้อมูลซ้ำ)</li>';//ถ้าซ้ำจะให้มันบอกวาซ้ำพร้อมแสดงรายการทีซ้ำ
    } else {
        $sql = "INSERT INTO strings (string) VALUES ('" . $string . "')";
        $result = mysqli_query($con, $sql);
        if ($result) {
            $submitted = true;
            echo '<li>' . $string . '</li>';//แสดงรายการสุมขึ้นมา
        }
    }
}
//alert ผมยังหาวิธีใสสียังไมได้ 
if ($submitted) {
    echo '<script>alert("Insert ข้อมูลเรียบร้อย");</script>';
} else if ($duplicate) {
    echo '<script>alert("มีข้อมูลซ้ำในฐานข้อมูล!");</script>';
}

?>
<br>
<br>
<div>
<div  class="text-center"><a href="index.php">กลับไปสุ่ม</a></div><br>
</div>
</div> 
</body>
</html>