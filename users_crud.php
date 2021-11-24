<head>
    <meta charset="utf-8">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <title>Page de modification des utilisateurs</title>
  </head>
<?php
use App\Controllers\UsersController;
use App\Services\CarsService;
use App\Services\AnsService;
use App\Services\ReservationsService;
use App\Services\UsersService;

require __DIR__ . '/vendor/autoload.php';
include_once 'menu/nav.php';
$controller = new UsersController();

$usersService = new UsersService();
$users= $usersService->getUsers();

$carsService = new CarsService();
$cars = $carsService->getCars();

$ansService = new AnsService();
$ans = $ansService->getAns();

$reservationsService = new ReservationsService();
$reservations = $reservationsService->getReservations();
echo $controller->getUsers();
?>
<br>
<table id="first_table">
    <tr>
        <td>
            <form method="post" action="users_crud.php" name ="userCreateForm">
                <table class='form-control' id="in_1">
                    <tr>
                        <td colspan="2">
                            <h5>Création d'un utilisateur</h5>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="firstname">Prénom :</label>  
                        </td>
                        <td>
                            <input type="text" class="form-control" name="firstname">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="lastname">Nom :</label>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="lastname">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="email">E-mail :</label>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="email">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="birthday">Date de naissance :</label>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="birthday" placeholder="format dd-mm-yyyy :">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="cars">Voiture(s) :</label>
                        </td>
                        <td>
                            <select name="cars[]" class="form-control" id="an-select">
                                    <option value="" selected disabled>Choisir une voiture</option>
                                    <?php foreach ($cars as $car): ?>
                                        <?php $carName = $car->getBrand() . ' ' . $car->getModel() . ' ' . $car->getColor(). ' - ' . $car->getNbrSlots().' place(s)'; ?>
                                        <option  value="<?php echo $car->getId(); ?>"><?php echo $carName; ?></option>
                                        <br />
                                    <?php endforeach; ?>
                            </select>
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
                            <?php echo $controller->createUser(); ?>
                        </td>
                    </tr>         
                </table>
            </form>
        </td>
        <td>
            <form method="post" action="users_crud.php" name ="userUpdateForm">
                <table class='form-control' id='in_2'>
                    <tr>
                        <td colspan="2">
                            <h5>Mise à jour d'un utilisateur</h5>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="id">Utilisateur :</label>
                        </td>
                        <td>
                        <select name="id" class="form-control" id="an-select">
                                <option value="" selected disabled>Choisir un utilisateur</option>
                                <?php foreach ($users as $user): ?>
                                        <?php $userName ='#'. $user->getId(). ' | ' . $user->getFirstname() . ' ' . $user->getLastname();?>
                                        <!--<input type="checkbox" name="reservations[]" value="<?php //echo $reservation->getId(); ?>"><?php //echo $reservationName; ?>-->
                                        <option  value="<?php echo $user->getId(); ?>"><?php echo $userName; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="firstname">Prénom :</label>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="firstname">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="lastname">Nom :</label>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="lastname">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="email">E-mail :</label>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="email">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="birthday">Date de naissance :</label>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="birthday" placeholder="format dd-mm-yyyy :">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="ans">Annonce(s) :</label>
                        </td>
                        <td>
                            <select name="ans[]" class="form-control" id="an-select">
                                <option value="" selected disabled>Choisir une annonce</option>
                                <option value="0" >Aucune</option>
                                <?php foreach ($ans as $an): ?>
                                    <?php $anName ="#".$an->getId() .'| '. $an->getPrice() . '€ ' . $an->getDeparture() . '➔' . $an->getDestination(). ' ' ; ?>
                                    <!--<input type="checkbox" name="ans[]" value="<?php //echo $an->getId(); ?>"><?php //echo $anName; ?>-->
                                    <option  value="<?php echo $an->getId(); ?>"><?php echo $anName; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="reservations">Reservation(s) :</label>
                        </td>
                        <td>
                            <select name="reservations[]" class="form-control" id="reservation-select">
                                <option value="" selected disabled>Choisir une réservation</option>
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
                        <td colspan="2">
                            <br>
                                <input type="submit" class="button" value="Mise à jour">
                            <br>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <?php echo $controller->updateUser(); ?>
                        </td>
                    </tr>
                </table>
            </form>
        </td>
        <td>
            <form method="post" action="users_crud.php" name ="userDeleteForm">
                <table class='form-control' id='in_3'>
                    <tr>
                        <td colspan="2">
                            <h5>Supression d'un utilisateur</h5>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="id">Utilisateur :</label>
                        </td>
                        <td>
                            <select name="iddel" class="form-control" id="an-select">
                                <option value="" selected disabled>Choisir un utilisateur</option>
                                <?php foreach ($users as $user): ?>
                                        <?php $userName ='#'. $user->getId(). ' | ' . $user->getFirstname() . ' ' . $user->getLastname();?>
                                        <!--<input type="checkbox" name="reservations[]" value="<?php //echo $reservation->getId(); ?>"><?php //echo $reservationName; ?>-->
                                        <option  value="<?php echo $user->getId(); ?>"><?php echo $userName; ?></option>
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
                                <?php echo $controller->deleteUser(); ?>
                        </td>
                    </tr>
                </table>
            </form>
        </td>
    </tr>
</table>