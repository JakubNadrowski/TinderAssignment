<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Swipe</title>
    <link href="./assets/css/style.css" rel="stylesheet" type="text/css">
    <style>
        img{
            height: 100px;
            width:100px;
            padding: 25px;
            }
        body{
            text-align: center;
        }
    </style>
</head>
<body>
<div class="topbar">
        <img src="./assets/img/log.png" class="logo" alt="logohere">
    </div>
    <div class="SPACEOUT">
    </div>
    <?php 
        $host = "ID386613_Tinder.db.webhosting.be";
        $user = "ID386613_Tinder";
        $pass = "Tinder123";
        $db = "ID386613_Tinder";
        $port = 3306;

        $conn = mysqli_connect($host, $user, $pass, $db, $port);

        IF ($conn == false){
            echo "bad connection";
            die();
        };
        

        $fname = $_POST['fname'];
        $gender = $_POST['gender'];
        $pgender = $_POST['Pgender'];

        $sql = "SELECT u.FName, u.LName, (2022 - YEAR(DoB)) as age, g.name as preffered_gender, gu.name as UserGender  FROM user as u
        INNER JOIN preffered_gender as pg on u.ID = pg.UserID
        INNER JOIN gender as g ON g.id = pg.GenderID
        INNER JOIN gender as gu ON gu.ID = u.GenderID
        WHERE g.ID = $gender AND gu.ID = $pgender;";

        $result = $conn->query($sql);

        $names = array();
        $ages = array();
        $genders = array();

        if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $names2 = array_push($names, $row['FName']);
            $ages2 = array_push($ages, $row['age']);
            $genders2 = array_push($genders, $row['UserGender']);     
        }
        }
        ?>

    <div class="card">
        <div class="picture">
            <img src="./assets/img/nonb.png" class="image" alt="person">
        </div>
        <div class="infobox">
        </div>
        <div class="buttons">
            <div class="js-left">
                <img src="./assets/img/x.png">
            </div>
            <div class="js-right">
                <img src="./assets/img/heart.png">
            </div>
        </div>
    </div>
        
    

        <script>
            const names = [];
            const Lnames = [];
            const ages = [];
            const genders = [];
            const liked=[];
            const disliked=[];
            var startingname = '<?php echo $fname ?>';
            <?php for ($x = 0; $x< count($names); $x++){
                ?>
                names.push('<?php echo $names[$x]; ?>');
                ages.push('<?php echo $ages[$x]; ?>');
                genders.push('<?php echo $genders[$x]; ?>');
                <?php
            }
            ?>
            
            var infoEl = document.querySelector(".infobox");
            var tickEl = document.querySelector(".js-right");
            var noEl = document.querySelector(".js-left");
            var bodyEl = document.querySelector("body");
            var cardEl = document.querySelector(".card");
            var pictureEl = document.querySelector(".picture");
            var i = 0;
            if (genders[i] == "Male"){
                pictureEl.querySelector("img").src = "./assets/img/male.png";
            }
            else{
                pictureEl.querySelector("img").src = "./assets/img/image.png";
            }
            infoEl.innerHTML = names[i] + ", " + ages[i] + "<br>" + genders[i];
            tickEl.addEventListener("click",function(){
                liked.push(names[i]);
                i++;
                infoEl.innerHTML = names[i] + ", " + ages[i] + "<br>" + genders[i];
                if (genders[i] == "Male"){
                    pictureEl.querySelector("img").src = "./assets/img/male.png";
                }
                else{
                    pictureEl.querySelector("img").src = "./assets/img/image.png";
                }
                
                if(i == names.length){
                    cardEl.innerHTML = "That's everyone " + startingname +"! <br> You liked:<br>";

                    for (var j = 0; j<liked.length;j++){
                        cardEl.innerHTML += liked[j] + "<br>";
                    }
                    cardEl.innerHTML += "You disliked: <br>";
                    for (var j = 0; j<disliked.length;j++){
                        cardEl.innerHTML += disliked[j] + "<br>";
                    }
                }
            })


            noEl.addEventListener("click",function(){
                disliked.push(names[i]);
                i++;
                infoEl.innerHTML = names[i] + ", " + ages[i] + "<br>" + genders[i];
                if(i == names.length){
                    cardEl.innerHTML = "That's everyone " + startingname +"! <br> You liked:<br>";

                    for (var j = 0; j<liked.length;j++){
                        cardEl.innerHTML += liked[j] + "<br>";
                    }
                    cardEl.innerHTML += "You disliked: <br>";
                    for (var j = 0; j<disliked.length;j++){
                        cardEl.innerHTML += disliked[j] + "<br>";
                    }
                    cardEl.innerHTML += "<a href='./index.html'> Go back </a>";

                }
            })


        </script>

</body>
</html>