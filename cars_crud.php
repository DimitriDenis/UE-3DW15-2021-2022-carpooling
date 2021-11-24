<head>
    <meta charset="utf-8">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <title>Page de modification des voitures</title>
  </head>
<?php
use App\Controllers\CarsController;
use App\Services\CarsService;

require __DIR__ . '/vendor/autoload.php';
include_once 'menu/nav.php';
$controller = new CarsController();
$carsService = new CarsService();
$cars = $carsService->getCars();
echo $controller->getCars();
?>
<br>
<table id="first_table">
    <tr>
        <td>
            <form method="post" action="cars_crud.php" name ="carCreateForm">
                <table class="form-control" id="in_1">
                    <tr>
                        <td colspan="2">
                            <h5>Création d'une voiture</h5>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="brand">Marque :</label>  
                        </td>
                        <td>
                            <input type="text" class="form-control" name="brand">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="model">Modèle :</label>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="model">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="color">Couleur :</label>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="color">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="nbrSlots">Places disponibles :</label>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="nbrSlots">
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <br>
                                <input type="submit" class="button" value="Créer">
                            <br>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <?php echo $controller->createCar();?>
                        </td>
                    </tr>          
                </table>
            </form>
        </td>

        <td>
            <form method="post" action="cars_crud.php" name ="carUpdateForm">
                <table class="form-control" id='in-3'>
                    <tr>
                        <td colspan="2">
                            <h5>Mise à jour d'une voiture</h5>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="idup">Voiture :</label>
                        </td>
                        <td>
                            <select name="idup" class="form-control" id="car-select">
                                <option value="" selected disabled>Choisir une voiture</option>
                                    <?php foreach ($cars as $car): ?>
                                        <?php $carName = $car->getBrand() . ' ' . $car->getModel() . ' - ' . $car->getNbrSlots().' place(s)'; ?>
                                        <option  value="<?php echo $car->getId(); ?>"><?php echo $carName; ?></option>
                                    <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="brand">Marque :</label>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="brandup">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="lastname">Modèle :</label>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="model">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="color">Couleur :</label>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="color">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="nbrSlots">Places disponibles :</label>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="nbrSlots">
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <br>
                                <input type="submit" class="button" value="Mise à jour">
                            <br>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <?php echo $controller->updateCar();?>
                        </td>
                    </tr>
                </table>
            </form>
        </td>
        <td>
            <form method="post" action="cars_crud.php" name ="carDeleteForm">
                <table class="form-control" id='in_2'>
                    <tr>
                        <td colspan="2">
                            <h5>Supression d'une voiture</h5>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="iddel">Voiture :</label>
                        </td>
                        <td>
                            <select name="iddel" class="form-control" id="car-select">
                                <option value="" selected disabled>Choisir une voiture</option>
                                    <?php foreach ($cars as $car): ?>
                                        <?php $carName = $car->getBrand() . ' ' . $car->getModel() . ' - ' . $car->getNbrSlots().' place(s)'; ?>
                                        <option  value="<?php echo $car->getId(); ?>"><?php echo $carName; ?></option>
                                    <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <br>
                                <input type="submit" class="button" value="Supprimer">
                            <br>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <?php echo $controller->deleteCar();?>
                        </td>
                    </tr>
                </table>
            </form>
        </td>
    </tr>
</table>
