<head>
    <meta charset="utf-8">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <title>Page de modification de users</title>
  </head>
<?php
use App\Controllers\CarsController;
use App\Services\CarsService;

require __DIR__ . '/vendor/autoload.php';

$controller = new CarsController();
echo $controller->getCars();

echo $controller->createCar();

$carsService = new CarsService();
$cars = $carsService->getCars();
?>

<p>Création d'un utilisateur</p>
<form method="post" action="cars_crud.php" name ="carCreateForm">
    <label for="firstname">Prénom :</label>
    <input type="text" name="brand">
    <br />
    <label for="lastname">Nom :</label>
    <input type="text" name="model">
    <br />
    <label for="email">Email :</label>
    <input type="text" name="color">
    <br />
    <label for="birthday">Date d'anniversaire au format dd-mm-yyyy :</label>
    <input type="text" name="nbrSlots">
    <br />
    <label for="cars">Voiture(s) :</label>
    <?php foreach ($cars as $car): ?>
        <?php $carName = $car->getBrand() . ' ' . $car->getModel() . ' ' . $car->getColor(). ' ' . $car->getNbrSlots(); ?>
        <input type="checkbox" name="cars[]" value="<?php echo $car->getId(); ?>"><?php echo $carName; ?>
        <br />
    <?php endforeach; ?>
    <br />
    <input type="submit" value="Créer un utilisateur">
</form>