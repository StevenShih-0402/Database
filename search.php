<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>搜尋聯絡人</title>
    <link rel="stylesheet" href="stylesearch.css">
</head>
<body>

    <h1>搜尋通訊錄</h1>
    <div class="center">
        <form action="search.php" method="post">
            <table>
                <tr>
                    <td>搜尋姓名:</td>
                    <td><input type="text" name="name"></td>
                </tr>
                <tr>
                    <td>搜尋電話:</td>
                    <td><input type="text" name="tel"></td>
                </tr>
            </table>

            <input type="submit" name="search" value="搜尋">
        </form>
        
        <?php
            if(isset($_POST["search"])){
                $db = mysqli_connect("localhost", "root", "A12345678");
                mysqli_select_db($db, "database");

                $sql = "SELECT * FROM address ";

                if(chop($_POST["name"]) != "")
                    $name = "name LIKE '%" . $_POST["name"] . "%' ";
                else
                    $name = "";

                if(chop($_POST["tel"]) != "")
                    $tel = "tel LIKE '%" . $_POST["tel"] . "%' ";
                else
                    $tel = "";

                if(chop($name) != "" && chop($tel) != "")
                    $sql .= "WHERE " . $name . " AND " . $tel;
                elseif(chop($name) != "")
                    $sql .= "WHERE " . $name;
                elseif(chop($tel) != "")
                    $sql .= "WHERE " . $tel;
                    
                $sql .= " ORDER BY name";
                $rows = mysqli_query($db, $sql);
                $num = mysqli_num_rows($rows);

                echo "<table border=1>\n<tr>\n<td>編號</td>\n";
                echo "<td>姓名</td>\n<td>電話</td>\n<td>功能</td>\n</tr>\n\n";

                if($num > 0){
                    while($row = mysqli_fetch_array($rows)){    /*以數值或欄位名稱搜尋陣列 */
                        $id = $row["id"];
                        echo "<tr>";
                        echo "<td>" . $id . "</td>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["tel"] . "</td>";
                        echo "<td><a href='edit.php?action=edit&id=";
                        echo $id . "'><b>編輯  </b>";
                        echo "<a href = 'edit.php?action=del&id=";
                        echo $id . "'><b>刪除  </b></td>";
                        echo "</tr>";
                    }
                    
                }
                echo "</table>\n";
                mysqli_free_result($rows);
                mysqli_close($db);
            }
        ?>

        

    </div>

    <ul>
        <li><a href="index.php">通訊錄首頁</a></li>
        <li><a href="add.php">新增聯絡人</a></li>
        <li><a href="search.php">搜尋通訊錄</a></li>
    </ul>

</body>
</html>