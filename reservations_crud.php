<head>
    <meta charset="utf-8">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <title>Page de modification des réservations</title>
</head>
<?php
use App\Controllers\ReservationsController;
use App\Services\ReservationsService;

require __DIR__ . '/vendor/autoload.php';

$controller = new ReservationsController();
echo $controller->getReservations();

$reservationsService = new ReservationsService();
$reservations = $reservationsService->getReservations();
?>
<table id="first_table">
    <tr>
        <td>
            <p>Création d'une réservation</p>
            <form method="post" action="reservations_crud.php" name ="reservationCreateForm">
                <table id="in_1">
                    <tr>
                        <td>
                            <label for="nbrPassengers">Nombre de passagers :</label>  
                        </td>
                        <td>
                            <input type="text" name="nbrPassengers">
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" value="Créer une réservation">
                        </td>
                    </tr>          
                </table>
                <?php echo $controller->createReservation();?>
            </form>
        </td>

        <td>
        <p>Mise à jour d'une réservation</p>
            <form method="post" action="reservations_crud.php" name ="reservationUpdateForm">
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
                            <label for="nbrPassengers">Nombre de passagers :</label>
                        </td>
                        <td>
                            <input type="text" name="nbrPassengersup">
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" value="Modifier la réservation">
                        </td>
                    </tr>
                </table>
                <?php echo $controller->updateReservation(); ?>
            </form>
        </td>

        <td>
            <p>Supression d'une réservation</p>
            <form method="post" action="reservations_crud.php" name ="reservationDeleteForm">
                <table id='in_2'>
                    <tr>
                        <td>
                            <label for="id">Id :</label>
                        </td>
                        <td>
                            <input type="text" name="iddel">
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" value="Supprimer une reservation">
                        </td>
                    </tr>
                </table>
                <?php echo $controller->deleteReservation();?>
            </form>
        </td>
    </tr>
</table>