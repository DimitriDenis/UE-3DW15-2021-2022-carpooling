<head>
    <meta charset="utf-8">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <title>Page de modification des réservations</title>
</head>
<?php
use App\Controllers\ReservationsController;
use App\Services\ReservationsService;

require __DIR__ . '/vendor/autoload.php';
include_once 'menu/nav.php';
$controller = new ReservationsController();
echo $controller->getReservations();

$reservationsService = new ReservationsService();
$reservations = $reservationsService->getReservations();
?>
<br>
<table id="first_table">
    <tr>
        <td>
            <form method="post" action="reservations_crud.php" name ="reservationCreateForm">
                <table class="form-control" id="in_1">
                    <tr>
                        <td colspan="2">
                            <h5>Création d'une réservation</h5>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="name">Nom :</label>  
                        </td>
                        <td>
                            <input type="text" class="form-control" name="title">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="nbrPassengers">Nombre de passagers :</label>  
                        </td>
                        <td>
                            <input type="text" class="form-control" name="nbrPassengers">
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
                            <?php echo $controller->createReservation();?>
                        </td>
                    </tr>          
                </table>
            </form>
        </td>

        <td>
            <form method="post" action="reservations_crud.php" name ="reservationUpdateForm">
                <table class="form-control" id='in-3'>
                    <tr>
                        <td colspan="2">
                            <h5>Mise à jour d'une réservation</h5>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="idup">Réservation :</label>
                        </td>
                        <td>
                            <select name="idup" class="form-control" id="reservation-select">
                                <option value="" selected disabled>Choisir une réservation</option>
                                <?php foreach ($reservations as $reservation): ?>
                                        <?php $reservationName ='#'. $reservation->getId(). ' | ' . $reservation->getTitle() . ' Pour ' . $reservation->getnbrPassengers().' passager(s)'; ?>
                                        <!--<input type="checkbox" name="reservations[]" value="<?php //echo $reservation->getId(); ?>"><?php //echo $reservationName; ?>-->
                                        <option  value="<?php echo $reservation->getId(); ?>"><?php echo $reservationName; ?></option>
                                <?php endforeach; ?>
                            </select>
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

                    <tr>
                        <td>
                            <label for="nbrPassengers">Nombre de passagers :</label>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="nbrPassengersup">
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
                            <?php echo $controller->updateReservation(); ?>
                        </td>
                    </tr>
                </table>
            </form>
        </td>

        <td>
            <form method="post" action="reservations_crud.php" name ="reservationDeleteForm">
                <table class="form-control" id='in_2'>
                    <tr>
                        <td colspan="2">
                            <h5>Supression d'une réservation</h5>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="id">Réservation :</label>
                        </td>
                        <td>
                            <select name="iddel" class="form-control" id="reservation-select">
                                <option value="" selected disabled>Choisir une réservation</option>
                                <?php foreach ($reservations as $reservation): ?>
                                        <?php $reservationName ='#'. $reservation->getId(). ' | ' . $reservation->getTitle() . ' Pour ' . $reservation->getnbrPassengers().' passager(s)'; ?>
                                        <!--<input type="checkbox" name="reservations[]" value="<?php //echo $reservation->getId(); ?>"><?php //echo $reservationName; ?>-->
                                        <option  value="<?php echo $reservation->getId(); ?>"><?php echo $reservationName; ?></option>
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
                            <?php echo $controller->deleteReservation();?>
                        </td>
                    </tr>
                </table>
            </form>
        </td>
    </tr>
</table>