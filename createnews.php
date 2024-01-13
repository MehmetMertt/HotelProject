<?php

session_start();
define('SECURE', true);
require_once('inc/connect.php');
$admin = $_SESSION['isAdmin'];
if(isset($_SESSION['id']) == FALSE || $_SESSION['isAdmin'] == 0) {
    header('location: login.php');
    exit();
}

$id = $_SESSION['id'];


if(isset($_POST['uploadnews']) && isset($_POST['body']) && isset($_POST['title']) && is_uploaded_file($_FILES['titlepic']['tmp_name'])) {

    $checkIfError = TRUE;
    
    $body = trim(htmlspecialchars($_POST['body']));
    $title = trim(htmlspecialchars($_POST['title']));

    if(!empty($body) && !empty($title)) {
        if(strlen($body) < 250 || strlen($title) < 20) {
            $message = "Your title must be atleast 20 characters and your body must be atleast 250 characters!";
            $checkIfError = FALSE;
        } else {
            
        }
    } else{
        $message = "Your title or body is empty";
        $checkIfError = FALSE;
    }


    if($checkIfError == TRUE) {
        $body = preg_replace('/&[^;]+;/', '', $body);
        $body = preg_replace('/(?<!#)#([^#]+)#(?!#)/', '<h1>$1</h1>', $body);
        $body = preg_replace('/##([^#]+)##/', '<h3>$1</h3>', $body);        
        $body = preg_replace('/\*\*([^*]+)\*\*/', '<b>$1</b>', $body);

    
    }

    if($checkIfError == TRUE) {
       $titlepic = $_FILES["titlepic"];
        $checkIfError = TRUE;
    
        if($titlepic["size"] > 5000000) { //5 MB
             $message = "Sorry, your uploaded image is too large!";
             $checkIfError = FALSE;
    
        }
    
        if(strtolower($titlepic["type"]) != "image/jpeg" && strtolower($titlepic["type"]) != "image/png") {
            $message = "Sorry, Please only upload jpeg/png Files!";
            $checkIfError = FALSE;
        } 
    
    
        if($checkIfError == TRUE) {
    
            $path = 'upload/news';
            $filename = $_FILES['titlepic']['name'];
    
            $tempnam = tempnam($path,'');
            $fileExtension = '.' . pathinfo($_FILES['titlepic']['name'], PATHINFO_EXTENSION);
            
            $img = $tempnam . $fileExtension;
            
            if($fileExtension == ".png") {
                $image = imagecreatefrompng($_FILES["titlepic"]["tmp_name"]);
                if($image != false ) {
                    $Resize = imagescale($image, 250, 150);
                    imagepng($Resize, $_FILES["titlepic"]["tmp_name"]);
                } else {
                    $message = "Sorry, There is a error with your picture!";
                    $checkIfError = FALSE;
                }
            } else if($fileExtension == ".jpg" || $fileExtension == ".jpeg" ) {
                $image = imagecreatefromjpeg($_FILES["titlepic"]["tmp_name"]);
                if($image != false) {
                    $Resize = imagescale($image, 250, 150);
                    imagejpeg($Resize, $_FILES["titlepic"]["tmp_name"]);
                } else {
                    $message = "Sorry, There is a error with your picture!";
                    $checkIfError = FALSE;
                }

            }
    
    
            if($checkIfError == TRUE) {
                if(move_uploaded_file($_FILES['titlepic']['tmp_name'],$tempnam . $fileExtension)){

                         $filePathDatabase = basename($tempnam . $fileExtension);

                         
                    $query = $db->prepare('INSERT INTO hotel.news
                    (title, `image`, author_id, body)
                    VALUES(?, ?, ?, ?);');
                    $date = date("Y-m-d");
                    $datapath = $path . "/" . $filePathDatabase;
                    $query->bind_param('ssss',$title,$datapath, $id, $body);
                    $query->execute();
                    if($query->affected_rows > 0 ) {
                        $message = "You file was successfully uploaded!";
                    } else {
                        $message = "There was a error while uploading your file!";
                        unlink($tempnam);
                        $checkIfError = FALSE;
                    }
         
                 } else {
                     $message = "There was a error while uploading your file!";
                     unlink($tempnam);
                     $checkIfError = FALSE;
                 }
            }

 

        }
    }
   

    //img php done

      
}

?>

<!DOCTYPE html>
<html lang="en">


<?php include 'inc/head.php'; ?>


<body>

    <?php
    include 'inc/navbar.php';
    ?>

    <div class="container">

        <?php if(isset($message) && $checkIfError == FALSE): ?>
        <div class="container">
            <div class="alert alert-danger alert-dismissible fade show">
                <strong>Error!</strong> <?php echo $message; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
        <?php endif; ?>

        <?php if(isset($message) && $checkIfError == TRUE): ?>
        <div class="container">
            <div class="alert alert-success  alert-dismissible fade show">
                <strong>Success!</strong> <?php echo $message; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
        <?php endif; ?>

        <form action="createnews.php" method="post" enctype="multipart/form-data">
            <div class=" row g-3">
                <!--- g3-spacing ---->
                <div class="col-md-6">
                    <label for="title" class="form-label">Title</label>
                    <input name="title" type="text" class="form-control" id="title" placeholder="Wonderful Titel"
                        required>
                </div>
                <div class="col-md-6">
                    <label for="titlepic" class="form-label">Picture</label>
                    <input name="titlepic" class="form-control" type="file" id="titlepic" accept="image/png, image/jpeg"
                        required>
                </div>

                <div class="col-md-6">

                    <input class="btn btn-primary" onclick="bold()" type="button" value="Bold">
                    <input class="btn btn-primary" onclick="header1()" type="button" value="Header 1">
                    <input class="btn btn-primary" onclick="header2()" type="button" value="Header 2">
                    <input class="btn btn-primary" onclick="chatgpt()" type="button" value="ChatGPT Prompt">
                </div>

                <br><br>
                <div class="mb-3">
                    <label for="body" class="form-label">Body</label>
                    <textarea class="form-control" name="body" id="body" rows="16" required></textarea>
                </div>
                <div class="col-12">
                    <button type="submit" name="uploadnews" class="btn btn-primary">Upload</button>
                </div>

            </div>

        </form>
    </div>


    <?php
    include 'inc/footer.php';
    ?>

    <script>
    function bold() {
        document.getElementById('body').value += "\n** **\n";
    }

    function header1() {
        document.getElementById('body').value += "\n# #\n";
    }

    function header2() {
        document.getElementById('body').value += "\n## ##\n";
    }

    function chatgpt() {
        var prompt =
            "User Hey. You are a hotel news blog/news specialist. You have 50 years of experience in this business. When I give you a topic, you will give me a news article/blog. It should be more than 500 Words and go into detail. Use # for Header 1 e.g: # Example # ## for Header 2 e.g: ## Example ## ** for Bold e.g: ** Example **. Try to write like a native and do not include the title again in your blog post/news. And do not use any special characters like @, #, dont use ' ` and ;. Dont use apostrophes! (everthing that will be escaped when u use htmlspecialchars in php) and so on. Use ae for ä, ue for ü and so on. My topic is: " +
            document.getElementById('title').value;
        navigator.clipboard.writeText(prompt);
        alert("OpenAI will open in 2s!");
        setTimeout(() => {
            window.open("https://chat.openai.com", "_blank");
        }, 2000);
    }
    </script>

</body>


</html>