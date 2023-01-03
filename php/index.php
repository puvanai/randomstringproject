
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>randomstr</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container my-5">
        <?php 
            $con =mysqli_connect("localhost","root","","strings"); //เชื่อมต่อฐานข้อมูล

            //สร้างฟังก์ชันสุ่มตัวอักษร 
            function generateRandomString() {
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
                $charactersLength = strlen($characters);
                $randomString = '';
                while (true) {//ลูปเพื่อเลือกอักษรสุ่มจากสตริงนี้ ลงในตัวแปร $randomString
                    $randomString= '';
                    for ($i = 0; $i < 10; $i++) {
                        $randomString .= $characters[rand(0, $charactersLength - 1)];//สุ่มจาก $characters ตัวอักษรที่เลือกจะถูกเพิ่มต่อท้ายสตริง $randomString ซึ่งจะสร้างสตริงที่มีตัวอักษรสุ่ม 10 ตัวครับ
                    }
                    return $randomString; //ฟังชันคืนค่า $randomString
                }
            }
            
            if (isset($_POST['submit'])) { //เช็คว่ามีการส่งค่าตัวแปร $_POST['submit'] มาหรือไม่
                if (!empty($_POST['number'])) {
                    $number = intval($_POST['number']);//return ค่า integer ของตัวแปรออกมาทีรับมากจาก <input type="text" id="number" name="number" class="form-control"><br>
                    $randomStrings = array();
                        for ($i = 0; $i < $number; $i++) {
                        $randomStrings[] = generateRandomString();//เพิ่มค่าสตริงที่สร้างขึ้นจากฟังชัน generateRandomString เข้าไปใน array $randomStringsตามจำนวนที่เราใส่ใน number
                }
                } else {
                    echo '<script>alert("กรุณากรอกข้อมูล!");</script>';
                }
              }
              
            
        ?>
        
        <!--สร้างฟอร์มไว้กรอกจำนวนตัวเลข-->
        <form method="post" >
        <div class="form'group">
        <div  class="text-center"><h2>กรอกจำนวนตามต้องการ</h2></div><br>
        <br>
          <input type="text" id="number" name="number" class="form-control"><br>
          <input type="submit" name="submit" value="Random strings" class="btn btn-success "> <!--พอกดปุ่ม มันก็จะวิ่งไปบรรทัดที่30 เพือเช็กเงือนไขตอไป-->
          </div> 
          <br>
          <br>
        </form>

        <!-- สร้างฟอร์มไว้เวลา กดส่งฟอร์มให้มันไปหน้า randonstr.php -->
        <form action="randomstr.php" method="post">
  
  <input type="hidden" name="random_strings" value="<?php echo htmlspecialchars(implode(',', $randomStrings)); ?>">
  <input type="submit" value="ส่งเข้าฐานข้อมูล" class="btn btn-primary"><!--action ไปยังหน้า randomsrt.php สำหรับส่งเข้าฐานข้อมูล -->
  <br>
  <br>

  <!-- ให้มันมาแสดงออกมาในรูปแบบตาราง -->
</form>
        <div id="result">
        <table class="table">
  <tr>
    <th>ลำดับ</th>
    <th>ข้อความที่สุ่มได้</th> 
  </tr>
    </div>
    
  <?php
    $i = 1;
    foreach ($randomStrings as $string) {
      echo '<tr>';
      echo '<td>' . $i . '</td>';
      echo '<td>' . $string . '</td>';
      echo '</tr>';
      $i++;
    }
  ?>
</table>



    
</body>
</html>