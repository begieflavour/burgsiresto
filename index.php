<?php
    include 'dbconfig.php';
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CRUD Operation on SQLite3 Database using PHP</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
</head>
<body>
    <nav class="navbar" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a class="navbar-item" href="https://bulma.io">
      <img src="https://bulma.io/images/bulma-logo.png" width="112" height="28">
    </a>

  </div>

    <div class="navbar-end">
      <div class="navbar-item">
        <div class="buttons">
          <a href="logout.php" class="button is-danger">
            <strong>Log out</strong>
          </a>
          
        </div>
      </div>
    </div>
  </div>
</nav>


<div class="container has-text-centered">
        <?php if(isset($_SESSION['user_id'])) : ?>
            <h1 class="title">Welcome!</h1>
            <p class="subtitle">You are logged in.</p>
        <?php endif; ?>
    </div>
    

    <a href="add.php" class="button is-primary">Add</a>

    <div class="columns is-multiline">

    <?php
    
    
        include 'dbconfig.php';

        
        $sql = "SELECT rowid, name, price, address, description, gluten, vegan, vegetarian, spiciness  FROM members";
        $query = $db->query($sql);

        if ($query) {
            while ($row = $query->fetchArray()) {
                echo "
                <div class='column is-one-third'>
                    <div class='box'>
                        <p><strong>Nimi:</strong> ".$row['name']."</p>
                        <p><strong>Hind:</strong> ".$row['price']."</p>
                        <p><strong>Pilt:</strong> </p>
                        <img src='uploads/".$row['address']."' alt='Image' style='max-width: 100%; height: auto;'>
                        <p><strong>Kirjeldus:</strong> ".$row['description']."</p>
                        <p><strong>Gluteen:</strong> ".ucfirst($row['gluten'])."</p>
                        <p><strong>Vegan:</strong> ".ucfirst($row['vegan'])."</p>
                        <p><strong>Taimetoitlastele:</strong> ".ucfirst($row['vegetarian'])."</p>
                        <p><strong>Teravus(1-5):</strong> ".$row['spiciness']."</p>
                        <div class='buttons'>
                            <a href='edit.php?id=".$row['rowid']."' class='button is-warning'>Edit</a>
                            <a href='delete.php?id=".$row['rowid']."' class='button is-danger'>Delete</a>
                        </div>
                    </div>
                </div>
            ";
            }
        } else {
            die("Error executing the query: " . $db->lastErrorMsg());
        }
    ?>

    </div>

</body>
</html>
