<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Static Login</title>
    <link rel="stylesheet" href="css/staticLogin.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
</head>
<body>
    <div class="container"><br><br>
    
    <?php
        $userLists = [
            'Admin' => [
                'admin' => 'Pass1234',
                'renmark' => 'Pogi1234'
            ],
            'Content Manager' => [
                'pepito' => 'manaloto',
                'juan' => 'delacruz'
            ],
            'System User' => [
                'pedro' => 'penduko'
            ]
        ];

        $profileImage = "//ssl.gstatic.com/accounts/ui/avatar_2x.png";

        if (isset($_POST['btn-signin'])) {
            $selectedType = $_POST['slctUserType'];
            $inputUsername = $_POST['inputUsername'];
            $inputPassword = $_POST['inputPassword'];
            
            $isValidUser = isset($userLists[$selectedType][$inputUsername]) && $userLists[$selectedType][$inputUsername] === $inputPassword;

            if ($isValidUser) {
            
                if (isset($_FILES['filImage']) && $_FILES['filImage']['error'] == 0) {
                    $arrErrors = array();
                    $filename = $_FILES['filImage']['name'];
                    $fileSize = $_FILES['filImage']['size'];
                    $fileTemp = $_FILES['filImage']['tmp_name'];

                    $fileExternalTemp = explode('.', $filename);
                    $fileExtension = strtolower(end($fileExternalTemp));

                    $arrAllowed = ['jpeg', 'jpg', 'png'];
                    $uploadDirectory = 'fileUploads/';

                    if (!in_array($fileExtension, $arrAllowed)) {
                        $arrErrors[] = "File extension is not allowed. Only JPEG, JPG, and PNG are allowed.";
                    }
                    if ($fileSize > 5000000) {
                        $arrErrors[] = "File size should be 5MB maximum.";
                    }

                    if (empty($arrErrors)) {
                        $filePath = $uploadDirectory . $filename;
                        move_uploaded_file($fileTemp, $filePath);
                        $profileImage = $filePath; 
                    } else {
                        echo '<b>File upload error:</b><br>';
                        foreach ($arrErrors as $error) {
                            echo $error . '<br>';
                        }
                    }
                }
                
                echo '<div class="alert alert-success alert-dismissible fade show" style="max-width: 350px; margin: auto;">';
                echo 'Welcome to the system, ' . htmlspecialchars($inputUsername) . '!';
                echo '</div>';
                
            } else {
                echo '<div class="alert alert-danger" style="max-width: 350px; margin: auto;">Invalid Username or Password.</div>';
            }
        }
    ?>


        <div class="card card-container">
            <img id="profile-img" class="profile-img-card" src="<?php echo htmlspecialchars($profileImage); ?>" />
            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin" method="post" enctype="multipart/form-data">
                <select name="slctUserType" id="slctUserType">
                    <option value="Admin">Admin</option>
                    <option value="Content Manager">Content Manager</option>
                    <option value="System User">System User</option>
                </select>

                <input type="text" name="inputUsername" id="inputUsername" class="form-control" placeholder="User Name" required autofocus>
                <input type="password" name="inputPassword" id="inputPassword" class="form-control" placeholder="Password" required>
                <input type="file" name="filImage">
                <br>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" name="btn-signin">Sign in</button>
            </form>
        </div>
    </div>

    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</body>
</html>



