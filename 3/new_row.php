<?php


require_once 'login.php';

$connection  =  new  mysqli($db_hostname,  $db_username,  $db_password,  $db_database);
if ($connection->connect_error) die($connection->connect_error);
?>





<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>New row</title>

    <link rel="stylesheet" href="assets/demo.css">
    <link rel="stylesheet" href="assets/form-login.css">
</head>




<div class="main-content-new-row">
    <form class="form-login-new-row" method = "post" enctype="multipart/form-data">
        <div class="form-log-in-with-email-new-row">
            <div class="form-white-background-new-row">
                
                
                <div class="form-title-row-new-row">
                        <h1>New row</h1>
                </div>


                <div class="form-row-new-row">
                        <label>
                            <span>EN</span>
                            <input type="text" name="en">
                        </label>
                </div>           


                <div class="form-row-new-row">
                        <label>
                            <span>RU</span>
                            <input type="text" name="ru">
                        </label>
                </div>           


                <div class="form-row-new-row">
                        <label>
                            <span>NUM</span>
                            <input type="text" name="num">
                        </label>
                </div>            


                <div class="form-row-new-row">
                        <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
                        <label>                        
                            <span>EN SOUND</span>
                            <input type="file" name="en_sound" id="en_sound">
                        </label>
                </div>           


                <div class="form-row-new-row">
                        <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
                        <label>                        
                            <span>RU SOUND</span>
                            <input type="file" name="ru_sound" id="ru_sound">
                        </label>
                </div>           


                <div class="form-row-new-row">
                        <button type="submit" name="upload" id="upload">GO</button>
                </div>

            </div>
        </div>
    </form>
</div>






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

else
{
    echo 'Херня какая-то';    
}




$result->close();
$connection->close();


function get_post($connection, $var)
{
    return $connection->real_escape_string($_POST[$var]);
}

?>