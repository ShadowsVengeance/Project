<?php

// Create and include a configuration file with the database connection
include('config.php');

// Include functions for application
include('functions.php');

$costumeID = get('costumeid');
if(!empty($costumeID)) {
    $sql = file_get_contents('sql/getcostume.sql');
    $params = array(
        'costumeid' => $costumeID
    );
    $statement = $database->prepare($sql);
    $statement->execute($params);
    $costumes = $statement->fetchAll(PDO::FETCH_ASSOC);

    $costume = $costumes[0];

}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Books</title>
    <meta name="description" content="The HTML5 Herald">
    <meta name="author" content="SitePoint">

    <link rel="stylesheet" href="css/style.css">

    <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
    <![endif]-->
</head>
<body>

<div id="wrapper">
    <header><h1>The Con Shop</h1></header>

    <nav role="navigation">
        <ul>
            <li><a href="index.php">Index</a></li>
            <li><a href="form.php?action=add&type=costume">Add Costume</a></li>
            <li><a href="form.php?action=add&type=costume">Add Weapon</a></li>
            <?php if(!isset($_SESSION['customerID'])) : ?>
                <li><a href="login.php">Login</a></li>
            <?php else : ?>
                <li><a href="logout.php">Logout</a></li>
            <?php endif ?>
        </ul>
    </nav>
    <main role="main">
        <div id="rightcol">
            <?php if(rand(0, 100) > 50) : ?>
                <blockquote>"Don't let the name deceive you, Great service!"</blockquote>
            <?php else :?>
                <blockquote>"I go to the Con Shop for all my convention needs!"</blockquote>
                <br />
            <?php endif; if(rand(0, 100) > 50) : ?>
                <blockquote>"The name had me skeptical, but I was very happy with the service!"</blockquote>
                <br />
            <?php else : ?>
                <blockquote>"Whenever I have an upcoming convention, I trust the Con Shop!"</blockquote>
            <?php endif ?>
            <br/><br/><br/><br/><br/><br/><br/>

        </div>
        <h2><?php echo $costume['name'] ?></h2>
            <p>
                Artist: <?php echo $costume['artist']; ?> <br />
                Price: $<?php echo $costume['price']; ?> <br />
                <a href="https://www.google.com/#q=<?php echo $costume['name']?>">Search Costume</a><br />
            </p>
        <br/><br/><br/><br/>
    </main>
</div>
</body>
</html>