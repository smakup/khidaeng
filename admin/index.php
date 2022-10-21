<?php
require_once('../connections/mysqli.php');

if ($_SESSION == NULL) {
  header("location:../login.php");
  exit();
}elseif ($_SESSION["user_level"] != "admin") {
  header("location:../index.php");
  exit();
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/dashboard.css">
    <title>แอดมิน</title>
  </head>
  <body>
    <?php include 'include/header.php'; ?>
    <div class="container-fluid">
      <div class="row">
        <?php include 'include/sidebarMenu.php'; ?>
        <h2><b>บริการเสริม</b></h2>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary addser" style="background-color: #EF774B; border:#EF774B;" data-bs-toggle="modal" data-bs-target="#addser">
        เพิ่มบริการเสริม
    </button>

    <table id="myTable" class="display" style="width: 100%;">
        <thead>
            <tr>
                <th>ลำดับ</th>
                <th>บริการเสริม</th>
                <th>ราคา</th>
                <th>จัดการ</th>
            </tr>
        </thead>
        <tbody>
        <?Php
            require_once('../fuction/connectDB.php');
            $result = $dbconn->prepare("SELECT * FROM onservice");
            $result->execute();
            for($i=0; $row = $result->fetch(); $i++){
        ?>
            <tr>
                <td><?php echo $row['SV_ID']; ?></td>
                <td><?php echo $row['SV_Name']; ?></td>
                <td><?php echo $row['SV_Price']; ?></td>
                <td>
                    <div class="edit-delete">
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editser"><i class='bx bx-edit-alt'></i>แก้ไข</button>
                        <a type="button"  href="../fuction/deleteservice.php=<?php echo $row['SV_ID'] ?>" onclick="return confirm('คุณต้องการลบบริการเสริมนี้ใช่หรือไม่')" class="btn btn-danger"  style="background-color: #DB1414 ; border-radius :10px; height: 5vh;"><span class="bx bx-trash"></i>ลบ</a>
                    </div>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
      </div>
    </div>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <?php mysqli_close($Connection); ?>
  </body>
</html>
