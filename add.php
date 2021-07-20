<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新增聯絡人</title>
    <link rel="stylesheet" href="styleadd.css">
</head>
<body>
    <?php
        $result="";

        if(isset($_POST["name"]) && isset($_POST["tel"])){
            $name = $_POST["name"];
            $tel = $_POST["tel"];
        }

        if($name != "" && $tel != ""){
            $db = mysqli_connect("localhost", "root", "A12345678");
            mysqli_select_db($db, "database");
            
            $sql = "INSERT INTO `address`(`name`, `tel`) VALUES('";
            $sql .= $name . "', '" . $tel . "')";

            if(!mysqli_query($db, $sql)){
                $result = "新增聯絡人失敗...<br/>" . mysqli_error($db);
            }
            else
                $result = "新增聯絡人成功...<br/>";

            mysqli_close($db);
        }
    ?>
    

    <form action="add.php" method="post">
        <h1>新增聯絡人</h1>
        <table>
            <tr>
                <td>姓名：</td>
                <td><input type="text" name="name"/></td>
            </tr>
            <tr>
                <td>電話：</td>
                <td><input type="text" name="tel"/></td>
            </tr>
        </table>

        <input type="submit" value="新增"/>        
    </form>
    
    <ul>
        <li><a href="index.php">通訊錄首頁</a></li>
        <li><a href="add.php">新增聯絡人</a></li>
        <li><a href="search.php">搜尋通訊錄</a></li>
    </ul>
    
    <p><?php echo $result ?></p>
    
</body>
</html>