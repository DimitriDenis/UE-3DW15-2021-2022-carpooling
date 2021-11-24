<head>
    <meta charset="utf-8">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <title>Page de modification des annonces</title>
</head>
<?php
use App\Controllers\AnsController;
use App\Services\AnsService;
use App\Services\CarsService;
use App\Services\ReservationsService;

require __DIR__ . '/vendor/autoload.php';
include_once 'menu/nav.php';
$controller = new AnsController();
$ansService = new AnsService();
$ans =  $ansService->getAns();
$carsService = new CarsService();
$cars = $carsService->getCars();
$reservationsService = new ReservationsService;
$reservations = $reservationsService->getReservations();
echo $controller->getAns();
?>
<br>
<table id="first_table">
    <tr>
        <td>
            <form method="post" action="ans_crud.php" name ="anCreateForm">
                <table class="form-control" id="in_1">
                    <tr>
                        <td colspan="2">
                            <h5>Création d'une annonce</h5>
                        </td>
                    </tr>

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
                            <select name="cars[]" class="form-control" id="car-select">
                                <option value="" selected disabled>Choisir une voiture</option>
                                    <?php foreach ($cars as $car): ?>
                                        <?php $carName = $car->getBrand() . ' ' . $car->getModel() . '' . $car->getColor(). ' - ' . $car->getNbrSlots().' place(s)'; ?>
                                        <!--<input type="checkbox" name="cars[]" value="<?php //echo $car->getId(); ?>"><?php // echo $carName; ?>-->
                                        <option  value="<?php echo $car->getId(); ?>"><?php echo $carName; ?></option>
                                    <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align:center" colspan="2">
                            <br><input type="submit" class="button" value="Créer une annonce">
                        </td>
                    </tr> 
                    
                    <tr>
                        <td colspan="2">
                            <?php echo $controller->createAn(); ?>
                        </td>
                    </tr>
                </table>
            </form>
        </td>

        <td>
            <form method="post" action="ans_crud.php" name ="anUpdateForm">
                <table class="form-control" id='in-3'>
                    <tr>
                        <td colspan='2'>
                            <h5>Mise à jour d'une annonce</h5>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <label for="id">Numéro :</label>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="idup">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="name">Prix :</label>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="priceup">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="departure">Départ :</label>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="departureup">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="destination">Arrivée :</label>
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
                            <select name="reservations[]" class="form-control" id="reservation-select">
                                <option value="" selected disabled>Choisir une Réservation</option>
                                <option value="0" >Aucune</option>
                                <?php foreach ($reservations as $reservation): ?>
                                        <?php $reservationName ='#'. $reservation->getId(). ' | ' . $reservation->getTitle() . ' Pour ' . $reservation->getnbrPassengers().' passager(s)'; ?>
                                        <!--<input type="checkbox" name="reservations[]" value="<?php //echo $reservation->getId(); ?>"><?php //echo $reservationName; ?>-->
                                        <option  value="<?php echo $reservation->getId(); ?>"><?php echo $reservationName; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align:center" colspan="2">
                            <br><input type="submit" class="button" value="Mise à jour">
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <?php echo $controller->updateAn(); ?>
                        </td>
                    </tr>
                </table>
            </form>
        </td>

        <td>
            
            <form method="post" action="ans_crud.php" name ="anDeleteForm">
                <table class="form-control" id='in_2'>
                    <tr>
                        <td colspan="2">
                            <h5>Supression d'une annonce</h5>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <label for="id">Numéro :</label>
                        </td>

                        <td>
                            <select name="iddel" class="form-control" id="an-select">
                                <option value="" selected disabled>Choisir une Réservation</option>
                                <?php foreach ($ans as $an): ?>
                                        <?php $anName ='#'. $an->getId(). ' | ' . $an->getPrice() . '€ ' . $an->getDeparture().'➔'. $an->getDestination(); ?>
                                        <!--<input type="checkbox" name="reservations[]" value="<?php //echo $reservation->getId(); ?>"><?php //echo $reservationName; ?>-->
                                        <option  value="<?php echo $an->getId(); ?>"><?php echo $anName; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align:center" colspan="2">
                            <br>
                                <input type="submit" class="button" value="SUPPRIMER">
                            <br>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <?php echo $controller->deleteAn(); ?>
                        </td>
                    </tr>
                </table>
            </form>
        </td>
    </tr>
</table>