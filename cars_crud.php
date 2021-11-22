<head>
    <meta charset="utf-8">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <title>Page de modification des voitures</title>
  </head>
<?php
use App\Controllers\CarsController;

require __DIR__ . '/vendor/autoload.php';
include_once 'menu/nav.php';
$controller = new CarsController();
echo $controller->getCars();
?>
<table id="first_table">
    <tr>
        <td>
            <p>Création d'une voiture</p>
            <form method="post" action="cars_crud.php" name ="carCreateForm">
                <table id="in_1">
                    <tr>
                        <td>
                            <label for="brand">Marque :</label>  
                        </td>
                        <td>
                            <input type="text" name="brand">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="model">Modèle :</label>
                        </td>
                        <td>
                            <input type="text" name="model">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="color">Couleur :</label>
                        </td>
                        <td>
                            <input type="text" name="color">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="nbrSlots">Places disponibles :</label>
                        </td>
                        <td>
                            <input type="text" name="nbrSlots">
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" value="Créer une voiture">
                        </td>
                    </tr>          
                </table>
                <?php echo $controller->createCar();?>
            </form>
        </td>

        <td>
        <p>Mise à jour d'une voiture</p>
            <form method="post" action="cars_crud.php" name ="carUpdateForm">
                <table id='in-3'>
                    <tr>
                        <td>
                            <label for="idup">Id :</label>
                        </td>
                        <td>
                            <input type="text" name="idup">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="brand">Marque :</label>
                        </td>
                        <td>
                            <input type="text" name="brandup">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="lastname">Modèle :</label>
                        </td>
                        <td>
                            <input type="text" name="model">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="color">Couleur :</label>
                        </td>
                        <td>
                            <input type="text" name="color">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="nbrSlots">Places disponibles :</label>
                        </td>
                        <td>
                            <input type="text" name="nbrSlots">
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" value="Modifier la voiture">
                        </td>
                    </tr>
                </table>
                <?php echo $controller->updateCar();?>
            </form>
        </td>
        <td>
            <p>Supression d'une voiture</p>
            <form method="post" action="cars_crud.php" name ="carDeleteForm">
                <table id='in_2'>
                    <tr>
                        <td>
                            <label for="iddel">Id :</label>
                        </td>
                        <td>
                            <input type="text" name="iddel">
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" value="Supprimer la voiture">
                        </td>
                    </tr>
                </table>
                <?php echo $controller->deleteCar();?>
            </form>
        </td>
    </tr>
</table>
