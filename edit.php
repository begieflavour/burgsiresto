<?php

include 'dbconfig.php';

$sql = "SELECT rowid, * FROM members WHERE rowid = '" . $_GET['id'] . "'";
$query = $db->query($sql);
$row = $query->fetchArray();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>CRUD Operation on SQLite3 Database using PHP</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
</head>
<body>

<div class="card">
    <div class="card-content">
        <form method="POST" enctype="multipart/form-data">
            <a href="index.php" class="button is-primary">Back</a>
            <div class="field">
                <label class="label" for="name">Nimi:</label>
                <div class="control">
                    <input class="input" type="text" id="name" name="name" value="<?php echo $row['name']; ?>" required>
                </div>
            </div>
            <div class="field">
                <label class="label" for="price">Hind:</label>
                <div class="control">
                    <input class="input" type="text" id="price" name="price" value="<?php echo $row['price']; ?>" required>
                </div>
            </div>
            <div class="field">
                <label class="label" for="address">Pilt:</label>
                <div class="control">
                    <input class="input" type="file" id="address" name="address" accept="image/*">
                    <p class="help">Current Image: <img src="<?php echo $row['address']; ?>" alt="Current Image" style="max-width: 100%; height: auto;"></p>
                </div>
                <div class="field">
                    <label class="label" for="description">Kirjeldus:</label>
                        <div class="control">
                            <textarea class="textarea" id="description" name="description"><?php echo $row['description']; ?></textarea>
                        </div>
            </div>
            <div class="field">
                <label class="label" for="gluten">Gluteen:</label>
                <div class="control">
                    <label class="radio">
                        <input type="radio" name="gluten" value="yes" <?php echo ($row['gluten'] == 'yes') ? 'checked' : ''; ?>>
                        Yes
                    </label>
                    <label class="radio">
                        <input type="radio" name="gluten" value="no" <?php echo ($row['gluten'] == 'no') ? 'checked' : ''; ?>>
                        No
                    </label>
                </div>
            </div>
            <div class="field">
                <label class="label" for="vegan">Vegan:</label>
                <div class="control">
                    <label class="radio">
                        <input type="radio" name="vegan" value="yes" <?php echo ($row['vegan'] == 'yes') ? 'checked' : ''; ?>>
                        Yes
                    </label>
                    <label class="radio">
                        <input type="radio" name="vegan" value="no" <?php echo ($row['vegan'] == 'no') ? 'checked' : ''; ?>>
                        No
                    </label>
                </div>
            </div>
            <div class="field">
                <label class="label" for="vegetarian">Taimetoitlastele:</label>
                <div class="control">
                    <label class="radio">
                        <input type="radio" name="vegetarian" value="yes" <?php echo ($row['vegetarian'] == 'yes') ? 'checked' : ''; ?>>
                        Yes
                    </label>
                    <label class="radio">
                        <input type="radio" name="vegetarian" value="no" <?php echo ($row['vegetarian'] == 'no') ? 'checked' : ''; ?>>
                        No
                    </label>
                </div>
            </div>
            <div class="field">
                <label class="label" for="spiciness">Spiciness Level:</label>
                <div class="control">
                    <input id="sliderWithValue" class="slider has-output is-fullwidth" min="0" max="5" value="<?php echo $row['spiciness']; ?>" step="1" type="range" name="spiciness">
                    <output for="sliderWithValue"><?php echo $row['spiciness']; ?></output>
                </div>
            </div>

            </div>
            <div class="field is-grouped">
                <div class="control">
                    <input class="button is-link" type="submit" name="save" value="Save">
                </div>
            </div>
        </form>

        <?php
        if (isset($_POST['save'])) {
            $name = $_POST['name'];
            $price = $_POST['price'];

            if (isset($_FILES['address']) && $_FILES['address']['error'] == 0) {
                $uploadDir = 'uploads/';
                $uploadFile = $uploadDir . basename($_FILES['address']['name']);
                move_uploaded_file($_FILES['address']['tmp_name'], $uploadFile);
            } else {
                $uploadFile = $row['address'];
            }
            $description = $_POST['description'];
            $gluten = $_POST['gluten'];
            $vegan = $_POST['vegan'];
            $vegetarian = $_POST['vegetarian'];
            $spiciness = $_POST['spiciness'];





            $sql = "UPDATE members SET name = '$name', price = '$price', address = '$uploadFile', description = '$description', gluten = '$gluten', vegan = '$vegan', vegetarian = '$vegetarian', spiciness = '$spiciness' WHERE rowid = '" . $_GET['id'] . "'";
            $db->exec($sql);

            header('location: index.php');
        }
        ?>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bulma-slider/dist/bulma-slider.min.js"></script>
            <script>
             
                bulmaSlider.attach('#sliderWithValue', {
                    output: '#sliderWithValue + output',
                });
            </script>
</body>
</html>
