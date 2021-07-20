<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>更新通訊錄</title>
    <link rel="stylesheet" href="styleedit.css">
</head>
<body>
    <?php
        $id = $_GET["id"];
        $action = $_GET["action"];

        $db = mysqli_connect("localhost", "root", "A12345678");
        mysqli_select_db($db, "database");

        switch($action){
            case "update":
                $name = $_POST["name"];
                $tel = $_POST["tel"];
                $sql = "UPDATE address SET name='" . $name . "', tel='" . $tel . "' WHERE id=" . $id;
                
                mysqli_query($db, $sql);        /*執行SQL指令 */
                header("Location:search.php");
                break;
            
            case "del":
                $sql = "DELETE FROM address WHERE id=" . $id;
                mysqli_query($db, $sql);
                header("Location:search.php");
                break;

            case "edit":
                $sql = "SELECT * FROM address WHERE id=" . $id;
                $rows = mysqli_query($db, $sql);
                $row = mysqli_fetch_array($rows);
                $name = $row["name"];
                $tel = $row["tel"];
    ?>
    
    <h1>更新通訊錄</h1>

    <form action="edit.php?action=update&id=<?php echo $id ?>" method="post">
        <table>
            <tr>
                <td>姓名：</td>
                <td><input type="text" name="name"></td>
            </tr>
            <tr>
                <td>電話：</td>
                <td><input type="text" name="tel"></td>
            </tr>      
        </table>

        <input type="submit" value="更新">      <!--submit:送出表單的按鈕(找了超久!!🤬)-->
    </form>
    <br/>

    <?php
            break;
        }
        mysqli_close($db);
    ?>

    <ul>
        <li><a href="index.php">通訊錄首頁</a></li>
        <li><a href="add.php">新增聯絡人</a></li>
        <li><a href="search.php">搜尋通訊錄</a></li>
    </ul>
</body>
</html>