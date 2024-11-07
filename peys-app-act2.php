<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peys App</title>
</head>
<body>
    <h1>Peys App</h1>
    
    <form method="post">
        <label for="rangeSize">Select Photo Size: </label>
        <input type="range" name="rangeSize" id="rangeSize"><br>
        <label for="slctColorBorder">Select Border Color:</label>
        <input type="color" name="slctColorBorder" id="slctColorBorder">
        <button type="submit" name="btnProcess">Process</button><br><br>

        <?php 
        if (isset($_POST['btnProcess'])) { 
            $borderColor = $_POST['slctColorBorder'];
            $imgSize = $_POST['rangeSize'];
            ?>
        <?php } ?>

        <img src="gueco.png" alt="img" width="<?php echo empty($imgSize) ? '10' : $imgSize; ?>%" height="<?php echo empty($imgSize) ? '10' : $imgSize; ?>%" style="border:3px solid <?php echo empty($borderColor) ? '#000000' : $borderColor; ?>;">
    </form>
</body>
</html>