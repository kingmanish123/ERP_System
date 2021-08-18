<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <title>Student Attendance</title>
</head>
<style>
.container-fluid {
    margin-top: 8%;
    padding: 20px;
}

.first {
    width: 250px;
    margin-left: 30px;
}

.second {
    width: 250px;
    margin-top: -34px;
    margin-left: 25rem;
}

.third {
    width: 250px;
    margin-top: -34px;
    margin-left: 50rem;
}

.fourth {
    width: 250px;
    margin-top: -34px;
    margin-left: 75rem;
}

.submit {
    width: 600px;
    margin-top: 20px;
    margin-left: 16rem;
}
</style>

<body>
    <?php include 'partials/faculty_sidebar.php'?>
    <form action="faculty_fill_attendance.php" method="post">
        <div class="container-fluid">
            <div class="first">
                <label>Courses:</label>
                <select name="course" id="course" class="form">
                    <option value="B.tech">B.tech</option>
                </select>
            </div>
            <div class="second">
                <label>Branch:</label>
                <select name='branch' id='branch' class='form'>
                    <?php 
            include 'partials/db.php';
            $existSql = "SELECT branch FROM `subject` WHERE full_name='{$_SESSION['full_name']}'";
              $result = mysqli_query($conn, $existSql);
              while($row = mysqli_fetch_assoc($result)){
            
            echo"<option value='".$row['branch']."'>".$row['branch']."</option>";
              }?>
                </select>
            </div>
            <div class="third">
                <label>Semester:</label>
                <select name="semester" id="semester" class="form">
                    <?php 
            include 'partials/db.php';
            $existSql = "SELECT semester FROM `subject` WHERE full_name='{$_SESSION['full_name']}'";
              $result = mysqli_query($conn, $existSql);
              while($row = mysqli_fetch_assoc($result)){
            
            echo"<option value='".$row['semester']."'>".$row['semester']."</option>";
              }?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary submit">Search</button>
        </div>
    </form>
    <div class="container">
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Roll No.</th>
                    <th scope="col">Lecture</th>
                    <!-- <th scope="col">Feculty Name</th> -->
                    <th scope="col">Attendance</th>
                </tr>
            </thead>
            <?php 
        include 'partials/db.php';
            if($_SERVER["REQUEST_METHOD"] == "POST"){
            $course    = $_POST["course"];
            $branch    = $_POST["branch"];
            $semester  = $_POST["semester"]; 
          $sql = "SELECT * FROM `admin_student_signup` WHERE semester = '$semester' AND branch = '$branch' ORDER BY rollno ";
          $result = mysqli_query($conn, $sql);
          $sno = 0;
          while($row = mysqli_fetch_assoc($result)){
            //   else{
            $sno = $sno + 1;
            echo "
            <tbody>
            
            <tr>
            <th scope='row'>". $sno . "</th>

            <form class='form-container'action='faculty_fill_attendance.php'method='get'>
            <td>
                <input type='text'value='". $row['name']."' id='name' name='name' required readonly>
            </td>

            <td>
                <input type='text' value='". $row['rollno']."'name='rollno' id='rollno' required readonly>
            </td>
            
            <td>
                <select name='lecture' id='lecture'>
                <option value='Ist' style='color: black;'>Ist</option>
                <option value='IInd' style='color: black;'>IInd</option>
                <option value='IIIrd' style='color: black;'>IIIrd</option>
                <option value='IVth' style='color: black;'>IVth</option>
                <option value='Vth' style='color: black;'>Vth</option>
                <option value='VIth' style='color: black;'>VIth</option>
                </select>
            </td>
            
            <td>
                <select name='attendance' id='attendance'class='form-control'>
                <option value='Present'style='color: black;'>Present</option>
                <option value='Absent' style='color: black;'>Absent</option>
                </select>
            </td>
            ";
        }
    }
              ?>
              
            
            

              </tr>
            </tbody>
          </table>
              <br>
            <button type='submit' class='btn btn-success'>Fill Attendance</button>
            </form>

    </div>
    <!-- <button class='btn-primary fill_attendance'data-id=".$row['id']."  type='button'>Fill Attendance</button> -->

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
    $('.fill_attendance').click(function() {
        window.open("manage_attendance.php?id=" + $(this).attr('data-id'), "_self")

    })
    </script>
</body>

</html>