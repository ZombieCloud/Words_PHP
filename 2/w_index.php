<?php // query.php
    
require_once 'login.php';

$connection  =  new  mysqli($db_hostname,  $db_username,  $db_password,  $db_database);
if ($connection->connect_error) die($connection->connect_error);

?>




<form method = "post" enctype="multipart/form-data">
<table border="0" cellpadding="1" cellspacing="1" class="box">

    <tr>
        <td width="100">EN</td>
        <td width="1800px"><input style="height: 22px; width: 1000px" type="text" name="en"></td>
    </tr>
    
    <tr>
        <td width="100">RU</td>
        <td width="1800px"><input style="height: 22px; width: 1000px" type="text" name="ru"></td>        
    </tr>    
    
    <tr>
        <td width="100">NUM</td>
        <td width="1800px"><input style="height: 22px; width: 1000px" type="text" name="num"></td>        
    </tr>    
    
    <tr>
        <td width="100">EN SOUND</td>
        <td width="1800px">
            <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
            <input style="height: 22px; width: 1000px" name="en_sound" type="file" id="en_sound">
        </td>        
    </tr>
    
    <tr>
        <td width="100">RU SOUND</td>
        <td width="1800px">
            <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
            <input style="height: 22px; width: 1000px" name="ru_sound" type="file" id="ru_sound">
        </td>        
    </tr>
    
    <tr><td width="100"></td><td style="height: 22px; width: 1000px"></td></tr>
    
    <tr>
        <td width="100">GO</td>
        <td width="1800px">
            <input name="upload" type="submit" class="box" id="upload" value="Go" >
        </td>
    </tr>    
    
</table>
</form>





<?php
//Вставка
if (isset($_POST['en']) && isset($_POST['ru']) && isset($_POST['num']) && $_FILES['en_sound']['size'] > 0 && $_FILES['ru_sound']['size'] > 0)
{
    
    // en_sound
    $en_fileName = $_FILES['en_sound']['name'];
    $en_tmpName  = $_FILES['en_sound']['tmp_name'];
    $en_fileSize = $_FILES['en_sound']['size'];
    $en_fileType = $_FILES['en_sound']['type'];

    $fp      = fopen($en_tmpName, 'r');
    $en_content = fread($fp, filesize($en_tmpName));
    $en_content = addslashes($en_content);
    fclose($fp);

    if(!get_magic_quotes_gpc())
    {
        $en_fileName = addslashes($en_fileName);
    }

    
    // ru_sound
    $ru_fileName = $_FILES['ru_sound']['name'];
    $ru_tmpName  = $_FILES['ru_sound']['tmp_name'];
    $ru_fileSize = $_FILES['ru_sound']['size'];
    $ru_fileType = $_FILES['ru_sound']['type'];

    $fp      = fopen($ru_tmpName, 'r');
    $ru_content = fread($fp, filesize($ru_tmpName));
    $ru_content = addslashes($ru_content);
    fclose($fp);

    if(!get_magic_quotes_gpc())
    {
        $ru_fileName = addslashes($ru_fileName);
    }    
    
//    echo $en_fileName;
//    echo $en_fileType;
//    echo '<br>';
//    echo $ru_fileType;
//    echo $en_tmpName;    
    
    $en = get_post($connection, 'en');
    $ru = get_post($connection, 'ru');    
    $num = get_post($connection, 'num');    
    
    $query = "INSERT INTO jopp289_words1.tab_words1_test (en, ru, level, hit, num, en_sound, ru_sound, en_sound_type, ru_sound_type) VALUES" . "('$en', '$ru', '0', '0', '$num', '$en_content', '$ru_content', '$en_fileType', '$ru_fileType')";
//    echo $query;
    
    $result = $connection->query($query);
    if (!$result) die ($connection->error);
}

?>




<?php


/*
//Удаление
if (isset($_POST['delete']) && isset($_POST['num']))
{
    $num = get_post($connection, 'num');

    $query = "DELETE FROM tab_words1 WHERE num='$num'";

    $result = $connection->query($query);
    if (!$result) die ($connection->error);
}


//Вставка
if (isset($_POST['en']) && isset($_POST['ru']) && isset($_POST['level']) && isset($_POST['hit']) && isset($_POST['num']))
{
    $en = get_post($connection, 'en');
    $ru = get_post($connection, 'ru');
    $level = get_post($connection, 'level');
    $hit = get_post($connection, 'hit');
    $num = get_post($connection, 'num');
    $query = "INSERT INTO tab_words1 (en, ru, level, hit, num) VALUES" . "('$en', '$ru', '$level', '$hit', '$num')";

    $result = $connection->query($query);
    if (!$result) die ($connection->error);
}
*/




/*
?>

<form action="index.php" method="GET">
    <pre>
        First word <input type="text" name="W_FIRST_WORD">
        Last word <input type="text" name="W_LAST_WORD">
        Level <input type="text" name="W_LEVEL">     
        
        <textarea name="W_TEXT" rows="5" cols="100">
            <?php echo '' ?>
        </textarea>
              
        <button type='submit' name='W_NEXT'>Next</button>
        <button type='submit' name='W_TRANSLATE'>Translate</button>
        <button type='submit' name='W_UP'>Up</button>
        <button type='submit' name='W_DOWN'>Down</button>        
    </pre>
</form>

<?php



if (isset($_GET['W_FIRST_WORD']))
{
    echo 'Privet1: <br>';
    $num = get_post($connection, 'W_FIRST_WORD');
    $query = "SELECT * FROM tab_words1 WHERE num='$num'";
//    $query = "SELECT * FROM tab_words1 WHERE num=1";
    $result = $connection->query($query);
    if (!$result) die ($connection->error);
    
//    echo 'Privet2: <br>';
    $result->data_seek(0);
    $row = $result->fetch_array(MYSQLI_ASSOC);
//    $row = $result->fetch_array(MYSQLI_NUM);
    
    echo 'en: ' . $row['en'] . '<br>';
//    echo 'en: ' . $row[1] . '<br>';
} else {
    echo 'Not set <br>';
}
*/


/*
        <input type="submit" name="W_NEXT" value="Next">     
        <input type="submit" name="W_TRANSLATE" value="Translate">        
        <input type="submit" name="W_UP" value="Up">
        <input type="submit" name="W_DOWN" value="Down">
 */
 


/*
//Вывод таблицы
$query = "SELECT * FROM tab_words1";
$result = $connection->query($query);
if (!$result) die ($connection->error);
*/


/*
$rows = $result->num_rows;
for ($j = 0 ; $j < $rows ; ++$j)
{
    $result->data_seek($j);
    $row = $result->fetch_array(MYSQLI_ASSOC);
//    $row = $result->fetch_array(MYSQLI_NUM);    
    echo 'en: ' . $row['en'] . '<br>';
    echo 'ru: ' . $row['ru'] . '<br>';
    echo 'level: ' . $row['level'] . '<br>';
    echo 'hit: ' . $row['hit'] . '<br>';
    echo 'num: ' . $row['num'] . '<br><br>';
    
    
    echo '<form action="index.php" method="post">';
    echo '<input type="hidden" name="delete" value="yes">';
    echo '<input type="hidden" name="num" value="'. $row['num'] .'">';
    echo '<input type="submit" value="DELETE RECORD">';
    echo '</form>';    
/*    
    echo <<<_END
    <form action="index.php" method="post">   
        <input type="hidden" name="delete" value="yes">
        <input type="hidden" name="num" value="$row['num']">
        <input type="submit" value="DELETE RECORD">            
    </form>
*/            
//_END;
//}



$result->close();
$connection->close();




function get_post($connection, $var)
{
    return $connection->real_escape_string($_POST[$var]);
}

?>