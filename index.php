<?php

// Create and include a configuration file with the database connection
include('config.php');

// Include functions for application
include('functions.php');

// Get search term from URL using the get function
$costumeTerm = get('costume-term');

$weaponTerm = get('weapon-term');


// Get a list of books using the searchBooks function
// Print the results of search results
// Add a link printed for each book to book.php with an passing the isbn
// Add a link printed for each book to form.php with an action of edit and passing the isbn
$costumes = searchCostumes($costumeTerm, $database);

$weapons = searchWeapons($weaponTerm, $database);
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
		<h1>Books</h1>
		<form method="GET">
			<input type="text" name="costume-term" placeholder="Search Costumes" />
            <input type="text" name="weapon-term" placeholder="Search Weapons" />
			<input type="submit" />
		</form>

		<h2>Costumes</h2>
            <?php foreach($costumes as $costume) : ?>
			<p>
				Costume: <?php echo $costume['name']; ?><br />
				Artist: <?php echo $costume['artist']; ?> <br />
				Price: $<?php echo $costume['price']; ?> <br />
				<a href="form.php?action=edit&type=costume&costumeid=<?php echo $costume['costumeid'] ?>">Edit Costume</a><br />
				<a href="costume.php?costumeid=<?php echo $costume['costumeid'] ?>">View Costume</a>
			</p>
		<?php endforeach; ?>

        <h2>Weapons</h2>
        <?php foreach($weapons as $weapon) : ?>
            <p>
                Weapon: <?php echo $weapon['name']; ?><br />
                Artist: <?php echo $weapon['artist']; ?> <br />
                Price: $<?php echo $weapon['price']; ?> <br />
                <a href="form.php?action=edit&type=weapon&weaponid=<?php echo $weapon['weaponid'] ?>">Edit Weapon</a><br />
                <a href="weapon.php?weaponid=<?php echo $weapon['weaponid'] ?>">View Weapon</a>
            </p>
        <?php endforeach; ?>

        <?php if(!empty($weaponTerm) && !empty($costumeTerm)) : ?>
        <a href="bundle.php?costumeid="




		
		<!-- print currently accessed by the current username -->
		<p>Currently logged in as: <?php echo $customer->getCustomerName() ?></p>
		
		<!-- A link to the logout.php file -->
		<p>
			<a href="logout.php">Log Out</a>
		</p>
    </main>
	</div>
</body>
</html>