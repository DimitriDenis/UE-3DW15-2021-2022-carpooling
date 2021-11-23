<head>
    <meta charset="utf-8">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <title>Page de modification des annonces</title>
</head>
<?php
use App\Controllers\AnsController;
use App\Services\CarsService;
use App\Services\ReservationsService;

require __DIR__ . '/vendor/autoload.php';
include_once 'menu/nav.php';
$controller = new AnsController();
$carsService = new CarsService();
$cars = $carsService->getCars();
$reservationsService = new ReservationsService;
$reservations = $reservationsService->getReservations();
echo $controller->getAns();
?>
<table id="first_table">
    <tr>
        <td>
            <p>Création d'une annonce</p>
            <form method="post" action="ans_crud.php" name ="anCreateForm">
                <table id="in_1">
                    <tr>
                        <td>
                            <label for="price">Prix :</label>  
                        </td>
                        <td>
                            <input type="text" class="form-control" name="price">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="departure">Départ :</label>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="departure">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="destination">Arrivée :</label>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="destination">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="date">Date de départ :</label>
                        </td>
                        <td>
                            <input type="text" name="datea" class="form-control" placeholder="format dd-mm-yyyy :">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="cars">Voiture :</label>
                        </td>
                        <td>
                            <?php foreach ($cars as $car): ?>
                                <?php $carName = $car->getBrand() . ' ' . $car->getModel() . '' . $car->getColor(). ' - ' . $car->getNbrSlots().' place(s)'; ?>
                                <input type="checkbox" name="cars[]" value="<?php echo $car->getId(); ?>"><?php echo $carName; ?>
                                <br />
                            <?php endforeach; ?>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" class="form-control" value="Créer une annonce">
                        </td>
                    </tr>          
                </table>
                <?php echo $controller->createAn(); ?>
            </form>
        </td>

        <td>
            <p>Mise à jour d'une annonce</p>
            <form method="post" action="ans_crud.php" name ="anUpdateForm">
                <table id='in-3'>
                    <tr>
                        <td>
                            <label for="id">Id :</label>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="idup">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="name">Nom :</label>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="titleup">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="departure">Departure :</label>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="departureup">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="destination">Destination :</label>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="destinationup">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="date">Date :</label>
                        </td>
                        <td>
                            <input type="text" name="dateup" class="form-control" placeholder="format dd-mm-yyyy :">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="reservation">Réservation :</label>
                        </td>
                        <td>
                        <?php foreach ($reservations as $reservation): ?>
                                <?php $reservationName ='#'. $reservation->getId() . ' Nombre de passager(s) ' . $reservation->getnbrPassengers(); ?>
                                <input type="checkbox" name="reservations[]" value="<?php echo $reservation->getId(); ?>"><?php echo $reservationName; ?>
                                <br />
                            <?php endforeach; ?>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" class="form-control" value="Modifier l'utilisateur">
                        </td>
                    </tr>
                </table>
                <?php echo $controller->updateAn(); ?>
            </form>
        </td>

        <td>
            <p>Supression d'une annonce</p>
            <form method="post" action="ans_crud.php" name ="anDeleteForm">
                <table id='in_2'>
                    <tr>
                        <td>
                            <label for="id">Id :</label>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="iddel">
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" class="form-control" value="Supprimer un utilisateur">
                        </td>
                    </tr>
                </table>
                <?php echo $controller->deleteAn(); ?>
            </form>
        </td>
    </tr>
</table>