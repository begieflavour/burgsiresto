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
                        <input class="input" type="text" id="name" name="name" required>
                    </div>
                </div>
                <div class="field">
                    <label class="label" for="price">Hind:</label>
                    <div class="control">
                        <input class="input" type="text" id="price" name="price" required>
                    </div>
                </div>
                <div class="field">
                    <label class="label" for="image">Pilt:</label>
                    <div class="control">
                        <input class="input" type="file" id="address" name="address" accept="image/*">
                    </div>
                </div>
                <div class="field">
                    <label class="label" for="description">Kirjeldus:</label>
                    <div class="control">
                        <textarea class="textarea" id="description" name="description"></textarea>
                    </div>
                </div>
                <div class="field">
                    <label class="label">Gluteen:</label>
                <div class="control">
                        <label class="radio">
                            <input type="radio" name="gluten" value="no" checked>
                            No
                        </label>
                        <label class="radio">
                            <input type="radio" name="gluten" value="yes">
                            Yes
                        </label>
                </div>
            </div>
            <div class="field">
                    <label class="label">Vegan:</label>
                <div class="control">
                        <label class="radio">
                            <input type="radio" name="vegan" value="no" checked>
                            No
                        </label>
                        <label class="radio">
                            <input type="radio" name="vegan" value="yes">
                            Yes
                        </label>
                </div>
            </div>
            <div class="field">
                    <label class="label">Taimetoitlastele:</label>
                <div class="control">
                        <label class="radio">
                            <input type="radio" name="vegetarian" value="no" checked>
                            No
                        </label>
                        <label class="radio">
                            <input type="radio" name="vegetarian" value="yes">
                            Yes
                        </label>
                </div>
            </div>
            <div class="field">
                    <label class="label" for="spiciness">Teravus:</label>
                    <div class="control">
                        
                        <input id="sliderWithValue" class="slider has-output is-fullwidth" min="0" max="5" value="0" step="1" type="range" name="spiciness">
                        <output for="sliderWithValue">0</output>
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
            $uploadFile = ''; 
            include 'dbconfig.php'; 
        
            if (isset($_FILES['address']) && $_FILES['address']['error'] == 0) {
                $uploadDir = 'uploads/';
                $uploadFile = $uploadDir . basename($_FILES['address']['name']);
                move_uploaded_file($_FILES['address']['tmp_name'], $uploadFile);
            }
        
            $name = $_POST['name'];
            $price = $_POST['price'];
            $description = $_POST['description'];
            $gluten = $_POST['gluten'];
            $vegan = $_POST['vegan'];
            $vegetarian = $_POST['vegetarian'];
            $spiciness = $_POST['spiciness'];
        
            $sql = "INSERT INTO members (name, price, address, description, gluten, vegan, vegetarian, spiciness) VALUES ('$name', '$price', '$uploadFile', '$description', '$gluten', '$vegan', '$vegetarian','$spiciness')";
            $result = $db->exec($sql);
        
            if ($result) {
                echo "Record inserted successfully!";
                header('Location: index.php');
                exit();
            } else {
                die("Error executing the query: " . $db->lastErrorMsg());
            }
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
