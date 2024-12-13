<?php
// Initialize session
session_start();

if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== false) {
    header('location: login.php');
    exit;
}

$img_response = $img_url = '';
$prompt_err = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $prompt = htmlspecialchars($_POST['prompt']);
    if (empty($prompt)) {
        $prompt_err = 'Blank text cannot be processed';
    } else {
        $ch = curl_init();
        $url = 'http://localhost:5000/generate'; //Python FLASK SERVICE URL
        curl_setopt($ch, CURLOPT_URL, $url);
        $payload = json_encode(array("input" => $prompt));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $resp = curl_exec($ch);

        if ($e = curl_error($ch)) {
            echo $e;
        } else {
            $img_response = json_decode($resp);
            $img_url = $img_response->image;
        }
        curl_close($ch);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Welcome to TextToImg</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
    <link href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/cosmo/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-qdQEsAI45WFCO5QwXBelBe1rR9Nwiss4rGEqiszC+9olH1ScrLrMQr1KmDR964uZ" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-dark bg-dark border border-bottom">
        <div class="container-fluid">
            <a class="navbar-brand">Text2Img</a>
            <div class="d-flex g-3 mb-4">
                <h6 class="text-white" accordion>Logged user : <b>
                        <?php echo $_SESSION['username']; ?>
                    </b></h6>
                <a href="logout.php" class="btn btn-block btn-outline-danger">Sign Out</a>
            </div>
        </div>
    </nav>
    <main>
        <section class="welcome container wrapper">
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                <div class="form-group <?php (!empty($prompt_err)) ? 'has_error' : ''; ?>">
                    <input class="form-control form-control-lg mb-2 w-100" type="text" name="prompt"
                        placeholder="Enter your text to generate">
                    <span class="help-block">
                        <?php echo $prompt_err; ?>
                    </span>
                </div>
                <input type="submit" class="btn btn-block btn-primary" value="login">
            </form>
            <div class=" d-flex flex-column align-items-center my-4">
                <img src="data:image/png;base64,<?php echo $img_url ?>" alt="" width="400" />
            </div>
        </section>
    </main>
</body>

</html>