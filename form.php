<?php

// Create and include a configuration file with the database connection
include('config.php');

// Include functions for application
include('functions.php');

// Get type of form either add or edit from the URL (ex. form.php?action=add) using the newly written get function
$action = $_GET['action'];

$type = get('type');


$costumeID = get('costumeid');
$weaponID = get('weaponid');

$costume = null;
$weapon = null;





if(!empty($costumeID)) {
	$sql = file_get_contents('sql/getCostume.sql');
	$params = array(
		'costumeid' => $costumeID
	);
	$statement = $database->prepare($sql);
	$statement->execute($params);
	$costumes = $statement->fetchAll(PDO::FETCH_ASSOC);
	
	$costume = $costumes[0];

	}

if(!empty($weaponID)) {
    $sql = file_get_contents('sql/getWeapon.sql');
    $params = array(
        'weaponid' => $weaponID
    );
    $statement = $database->prepare($sql);
    $statement->execute($params);
    $weapons = $statement->fetchAll(PDO::FETCH_ASSOC);

    $weapon = $weapons[0];

}




// If form submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if($type == 'costume') {
        $name = $_POST['costume-name'];
        $artist = $_POST['costume-artist'];
        $price = $_POST['costume-price'];

        if ($action == 'add') {
            $sql = file_get_contents('sql/insertCostume.sql');
            $params = array(
                'name' => $name,
                'artist' => $artist,
                'price' => $price
            );

            $statement = $database->prepare($sql);
            $statement->execute($params);


        } elseif ($action == 'edit') {
            $sql = file_get_contents('sql/updateCostume.sql');
            $params = array(
                'costumeid' => $costumeID,
                'name' => $name,
                'artist' => $artist,
                'price' => $price
            );

            $statement = $database->prepare($sql);
            $statement->execute($params);

        }
    }
    elseif($type == 'weapon') {
        $name = $_POST['weapon-name'];
        $artist = $_POST['weapon-artist'];
        $price = $_POST['weapon-price'];

        if ($action == 'add') {

            $sql = file_get_contents('sql/insertWeapon.sql');
            $params = array(
                'name' => $name,
                'artist' => $artist,
                'price' => $price
            );

            $statement = $database->prepare($sql);
            $statement->execute($params);


        } elseif ($action == 'edit') {
            $sql = file_get_contents('sql/updateWeapon.sql');
            $params = array(
                'weaponid' => $weaponID,
                'name' => $name,
                'artist' => $artist,
                'price' => $price
            );

            $statement = $database->prepare($sql);
            $statement->execute($params);


            $statement = $database->prepare($sql);
            $statement->execute($params);

        }
    }

	header('location: index.php');
}



?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	
  	<title>Manage Products</title>
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
                <li><a href="form.php?action=add&type=weapon">Add Weapon</a></li>
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

            <form action="" method="POST">
                <?php if($type == 'costume') : ?>
                <div class="form-element">
                    <label>Costume Name:</label>
                    <input type="text" name="costume-name" class="textbox" value="<?php echo $costume['name'] ?>" />
                </div>
                <div class="form-element">
                    <label>Artist:</label>
                    <input type="text" name="costume-artist" class="textbox" value="<?php echo $costume['artist'] ?>" />
                </div>
                <div class="form-element">
                    <label>Price:</label>
                    <input type="number" step="any" name="costume-price" class="textbox" value="<?php echo $costume['price'] ?>" />
                </div>

                <?php elseif($type == 'weapon') : ?>
                <div class="form-element">
                    <label>Weapon Name:</label>
                    <input type="text" name="weapon-name" class="textbox" value="<?php echo $weapon['name'] ?>" />
                </div>
                <div class="form-element">
                    <label>Artist:</label>
                    <input type="text" name="weapon-artist" class="textbox" value="<?php echo $weapon['artist'] ?>" />
                </div>
                <div class="form-element">
                  <label>Price:</label>
                 <input type="number" step="any" name="weapon-price" class="textbox" value="<?php echo $weapon['price'] ?>" />
                </div>

                <?php endif ?>
                <div class="form-element">
                   <input type="submit" class="button" />&nbsp;
                  <input type="reset" class="button" />
                </div>
            </form>


        </main>

	</div>
</body>
</html>