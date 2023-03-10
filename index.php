<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <title>PhpDataPractice</title>
</head>
<body style="background-color: #EDF1D6; color: #40513B">

    <div class="header">
        <header>
            <h3 class="text-center mx-auto mt-2">Todo Php Practice</h3>
            <hr class="mb-2">
        </header>
    </div>
    <div class="form-group mx-auto text-center mt-4 mb-5" style="display:flex;flex-direction: column;">
        <form action="index.php" method="post">
            <input class="form-control col-4" name="content" autofocus placeholder="Write the 'to do' job here. (Max 51 characters)" style="width: 31%; display: inline; color: #40513B; border-color: #40513B;">
            <input type="submit" name="btnSbmt" value="Add" class="btn-success btn" style="background-color: #9DC08B; color: #40513B;">
        </form>
    </div>

<?php
try{
    $baglanti=new PDO("mysql:host=localhost;dbname=practice;charset=utf8","root","");

    $oku=$baglanti->query("SELECT * FROM practice",PDO::FETCH_ASSOC);

    if($oku != false && !empty($oku)){

        foreach($oku as $veriler){
            $content=$veriler["content"];
            echo '<div class="alert col-4 mx-auto text-center" style="background-color:#9DC08B;color:40513B;" role="alert">
                     <p class="mb-0" style="color:40513B;">'.$content.'</p>
                 </div>';
        }
    }

}catch(PDOExpection $e)
{
    echo $e->getMessage();
    exit();
}

if(isset($_POST['content'])){
    $_content=trim(filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING));
    if(empty($_content)){
        die("<p> Lütfen boş yer bırakmayın!");
    }
    $sorgu = $baglanti->prepare("INSERT INTO practice (content) VALUES('".$_content."')");
    $sorgu->execute();
    header("Refresh:0; url=index.php");
}

?>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>