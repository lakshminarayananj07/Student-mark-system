<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    .container{
        background-color: lightgoldenrodyellow;
    }
    .content{
        margin: 5% 20%;
        display: flex;
        flex-direction: column;
        justify-content: center;

        
        align-items: center;
        gap: 2rem;
    }
    table{
        height: 200px;
        width: 400px;
        background-color: burlywood;
        border: 5px solid black;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19) ;
    }
    table tr{
        text-align: center;
    }
    .ele{
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        gap: 2rem; 
        margin-left: 40px;
    }
    .details{
        background-color: white;
        width:500px;
        display: flex;
        flex-direction: column;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }
    input{
        border: none;
    }
    #data{
        font-size: 18px;
    }
</style>
<body style="background-color: lightgrey;">
<?php
    $stud_id = isset($_GET['id']) ? $_GET['id'] : '';
    $name = isset($_GET['name']) ? $_GET['name'] : '';
    $dept = isset($_GET['dept']) ? $_GET['dept'] : '';
    $year = isset($_GET['year']) ? $_GET['year'] : '';
    
    $servername = "localhost";
    $username = "root";
    $password = "Deepak2004";
    $dbname = "college";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT s.sub_name , g.grade from academics a join subject s on a.sub_id=s.sub_id JOIN grades g ON a.grade_id = g.grade_id where a.stud_id = $stud_id";
    $result = $conn->query($sql);
    ?>
<div class="container">
    <div class="content">
        <div class="details">
            <div class="ele">
                <p>STUDENT ID</p>
                <input type="text" id="data" name="data" value="<?php echo ": ". htmlspecialchars($stud_id); ?>" readonly>
            </div>
            <div class="ele">
                <p>STUDENT NAME</p>
                <input type="text" id="data" name="data" value="<?php echo ": ". htmlspecialchars($name); ?>" readonly>
            </div>
            <div class="ele">
                <p>STUDENT DEPARTMENT</p>
                <input type="text" id="data" name="data" value="<?php echo ": ". htmlspecialchars($dept); ?>" readonly>
            </div>
        </div>
        
        <table border="1">
            <tr>
                <th>SUBJECT</th>
                <th>GRADE</th>
            </tr>
            <?php   
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['sub_name'] . "</td>";
                        echo "<td>" . $row['grade'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "0 results";
                }

                $conn->close();
            ?>
        </table>
    </div>
</div>


</body>
</html>