<!DOCTYPE html>
<html lang="da">
    <?php
        //SET UP VARIABLS
        $server = "theravencsraft.com.mysql";
        $user = "theravencsraft_com_spjder";
        $pw = "ha.N45s";
        $db = "theravencsraft_com_spjder";
            
        //CONNECTION
        $conn = new mysqli($server, $user, $pw, $db);
        //CHECK CONNECTION
        if ($conn->connect_errno){
            die("Connection failed".$conn->connect_errno);
        }
    ?>
    <head>
        <title>Bliv Spejderledere</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="CSS/style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <header>
            <div id="logo"></div>
            
                <?php
                    //set headline to the same as currant page.
                    if(!isset($_GET['page'])){
                        echo '<h1> Slettefolket Otterup </h1>';
                    }else{
                        $page=$_GET['page'];
                        $head_sql="SELECT name FROM `menu` WHERE `menuId` = '$page'";
                        $head_quarry = mysqli_query($conn, $head_sql);
                        $head_arry = mysqli_fetch_array($head_quarry);
                        echo '<h1> '. $head_arry['name'] .'</h1>';
                    }
                ?>
            
            <a href="#info">
                <div id="more-info">
                    Mere Info
                </div>
            </a>
        </header>
        
        <?php
            
            //get menu options and place them in an array
            $menu_sql = "SELECT * FROM menu";
            $menu_quarry = mysqli_query($conn, $menu_sql);
            $menu_arry = mysqli_fetch_array($menu_quarry);
        ?>
        
        <div id="content">
            <?php
                //include pages and check if user has been on another page before the home page
                if(!isset($_GET['page'])){
                    include 'content/home.php';
                }else{
                    $page=$_GET['page'];
                    include ("content/$page.php");
                }
            ?>
        </div>
        
        <div id="menu-holder">
            <?php
                //display menu options
                do{
                    echo '<a href="index.php?page='. $menu_arry['menuId'] .'">';
                    echo '<div class="menu_option">';
                    echo $menu_arry['name'];
                    echo '</div>';
                    echo '<div class="menu_icon">';
                    echo '<img class="icon_img" src="img/'. $menu_arry['menuId'] .'.png">';
                    echo '</div>';
                    echo '</a>';
                } while ($menu_arry = mysqli_fetch_array($menu_quarry))
            ?>
        </div>
        
        <footer>
            <div id="conact_info">
                <p>
                Kontaktperson: Charlotte Petterson
                </br>
                Tlf: 24 98 88 72
                </br>
                Email: info@slettefolket.dk
                </p>
            </div>
            <a href="https://www.facebook.com/KFUMOtterup/">
                <img class="social" src="img/fb_logo.png">
            </a>
            
            <a href="https://www.youtube.com/channel/UCnq0v-F-bw8tLxNwMjmy_Ng">
                <img class="social" src="img/yt_logo.png">
            </a>
            
            <a href="https://www.instagram.com/kfumotterup/">
                <img class="social" src="img/ig_logo.png">
            </a>
            
        </footer>
    </body>
</html>
