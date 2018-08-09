<?php

?>

<html>
<head>
    <title>This is Error Page!</title>
    <link rel="stylesheet" type="text/css" href="view/css/header.css">
</head>
<body>
    <?php include "Header.php"; ?>
    <div class="container">
        <h2>Path '<?php echo $data; ?>' does not exist!</h2>
        <a href="/"><button>Go Home</button></a>
    </div>
</body>
</html>
