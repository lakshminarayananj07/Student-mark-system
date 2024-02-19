<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $servername = "localhost";
        $username = "root";
        $password = "Deepak2004";
        $dbname = "college";

        $conn = new mysqli($servername, $username, $password, $dbname);


        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $dept = $_POST["dept"];
        $year = $_POST["year"];

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        $sql = "SELECT
        s.stud_id,
        s.stud_name,
        s.dob,
        s.year 
    FROM
        student s
        JOIN department d on s.dept_id = d.dept_id where d.dept_name = '$dept' and s.year = '$year';";
        $result = $conn->query($sql);
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/02efb2ab5d.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Roboto:ital,wght@0,300;0,500;1,300&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,500;1,300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css">
    <title>Document</title>
    <style>
        .container{
            width: 100%;
            height: 100%;
            background-color: lightgrey;
        }
        nav{
            width: 100%;
            background-color: white;
            text-align: center;
        }
        .content{
            margin: 5% 15%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 2rem;
        }
        table{
            width: 400px;
            background-color: white;
            border: 2px solid black;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19) ;
        }
        form{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 2rem;
        }
        form input{
            width: 200px;
            height: 30px;
            border-radius: 10px;
            border: 1px solid black;
        }
        #data{
            text-align: center;
        }
        form button{
            height: 30px;
            width: 65px;
            border-radius: 20px;
        }
        table td{
            text-align: center;
            height: 40px;
        }
    </style>
</head>
<body style="background-color: lightgrey;">
    <div class="container">
        <nav>
            <h1>EXAM RESULT</h1>
        </nav>
        <div class="content">
            <form id="myform" method="post" action="">
                <input type="text" id="data" placeholder="ENTER DEPARTMENT" name="dept">
                <input type="number" id="data" placeholder="ENTER YEAR" name="year" min="1" max="4">
                <button type="submit">SUBMIT</button>
            </form>
            <table border="1">
                <tr style="height: 40px;">
                    <th>ID</th>
                    <th>NAME </th>
                    <th>DOB</th>
                    <th>YEAR</th>
                    <th>VIEW GRADE</th>
                </tr>
                <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['stud_id'] . "</td>";
                            echo "<td>" . $row['stud_name'] . "</td>";
                            echo "<td>" . $row['dob'] . "</td>";
                            echo "<td>" . $row['year'] . "</td>";
                            $id = $row['stud_id']; 
                            $name = $row['stud_name'];
                            echo "<td><a href='mark.php?id=$id&name=$name&dept=" . urlencode($dept) . "&year=$year'><i class='fa-regular fa-eye'></i></a></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "no such department";
                    }
                    
                    
                ?>
            </table>
        </div>
        
    </div>
</body>
</html>