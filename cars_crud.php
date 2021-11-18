<head>
    <meta charset="utf-8">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <title>Page de modification de users</title>
  </head>
<?php
use App\Controllers\CarsController;
use App\Services\CarsService;

require __DIR__ . '/vendor/autoload.php';

$carsService = new CarsService();
$controller = new CarsController();
echo $controller->getCars();
echo $controller->createCar();
$cars = $carsService->getCars();

?>
<table id="first_table">
    <tr>
        <td>
            <p>Création d'une voiture</p>
            <form method="post" action="cars_crud.php" name ="carCreateForm">
                <table id="in_1">
                    <tr>
                        <td>
                            <label for="firstname">Prénom :</label>  
                        </td>
                        <td>
                            <input type="text" name="firstname">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="lastname">Nom :</label>
                        </td>
                        <td>
                            <input type="text" name="lastname">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="email">Email :</label>
                        </td>
                        <td>
                            <input type="text" name="email">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="birthday">Date d'anniversaire :</label>
                        </td>
                        <td>
                            <input type="text" name="birthday" placeholder="format dd-mm-yyyy :">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="cars">Voiture(s) :</label>
                        </td>
                        <td>
                            <?php foreach ($cars as $car): ?>
                                <?php $carName = $car->getBrand() . ' ' . $car->getModel() . ' ' . $car->getColor(). ' ' . $car->getNbrSlots(); ?>
                                <input type="checkbox" name="cars[]" value="<?php echo $car->getId(); ?>"><?php echo $carName; ?>
                                <br />
                            <?php endforeach; ?>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" value="Créer une voiture">
                        </td>
                    </tr>          
                </table>
            </form>
        </td>
<?php
//echo $controller->deleteCar();
?>
        <td>
            <p>Supression d'une voiture</p>
            <form method="post" action="cars_crud.php" name ="carDeleteForm">
                <table id='in_2'>
                    <tr>
                        <td>
                            <label for="id">Id :</label>
                        </td>
                        <td>
                            <input type="text" name="id">
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" value="Supprimer la voiture">
                        </td>
                    </tr>
                </table>
            </form>
        </td>

<?php
//echo $controller->updateCar();
?>
        <td>
            <p>Mise à jour d'une voiture</p>
            <form method="post" action="cars_crud.php" name ="carUpdateForm">
                <table id='in-3'>
                    <tr>
                        <td>
                            <label for="id">Id :</label>
                        </td>
                        <td>
                            <input type="text" name="id">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="firstname">Prénom :</label>
                        </td>
                        <td>
                            <input type="text" name="firstname">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="lastname">Nom :</label>
                        </td>
                        <td>
                            <input type="text" name="lastname">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="email">Email :</label>
                        </td>
                        <td>
                            <input type="text" name="email">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="birthday">Date d'anniversaire :</label>
                        </td>
                        <td>
                            <input type="text" name="birthday" placeholder="format dd-mm-yyyy :">
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" value="Modifier la voiture">
                        </td>
                    </tr>
                </table>
            </form>
        </td>
    </tr>
</table>
