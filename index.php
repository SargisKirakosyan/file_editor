<?php 
$filename = realpath(__DIR__."/css/styles.css");
if (isset($_GET['action'])){
    $action = $_GET['action'];
} 
else {
    $action = "";
}
if($action == 'update') {
    $update = update();
    header("Location: index.php");
}

function update() {
    if(isset($_POST['ok'])){
        $text = $_POST['content'];
        global $filename;
        $handle = fopen($filename,"w");
        fwrite($handle, $text);
        fclose($handle);
    }
}
$handle = fopen($filename,"r");
if (file_exists($filename)) {
    $contents = fread($handle, filesize($filename));
}
else {
    echo "$filename file doesn't exist";
}
fclose($handle);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Simple file editor</title>
    <meta charset="UTF-8">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <?php include_once ('codemirror.php');?>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="./">Simple file editor</a>
            <div class="my-2 my-lg-0">
                <span class="navbar-text">&copy; Sargis Kirakosyan 2020</span>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <form method="POST" action="index.php?action=update">
            <textarea name="content" id="text" onkeydown="isKeyPressed(event)"><?php echo $contents;?></textarea>
            <input type="submit" class="btn btn-sm btn-success" name="ok" value="Save" id="save">
            <button class="btn btn-sm btn-info copying" onclick="copy('#text')">Copy</button>
            <button class="btn btn-sm btn-secondary" onclick="printList();">Print</button>
        </form>
    </div>
    <script>
        var editor = CodeMirror.fromTextArea(document.getElementById("text"), {
            lineNumbers: true,
            theme: "mdn-like",
            scrollbarStyle: "simple",
            extraKeys: {
                "Ctrl-Space": "autocomplete",
                "F11": function(cm) {
                    cm.setOption("fullScreen", !cm.getOption("fullScreen"));
                },
                "Esc": function(cm) {
                    if (cm.getOption("fullScreen")) cm.setOption("fullScreen", false);
                }
            },
            mode: "css",
            matchBrackets: true
        });
    </script>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/scripts.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>

</html>