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

require __DIR__ . '/vendor/autoload.php';
include_once 'menu/nav.php';
$controller = new UsersController();

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
            <p>Création d'un utilisateur</p>
            <form method="post" action="users_crud.php" name ="userCreateForm">
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
                                <?php $carName = $car->getBrand() . ' ' . $car->getModel() . ' ' . $car->getColor(). ' - ' . $car->getNbrSlots().' place(s)'; ?>
                                <input type="checkbox" name="cars[]" value="<?php echo $car->getId(); ?>"><?php echo $carName; ?>
                                <br />
                            <?php endforeach; ?>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" value="Créer un utilisateur">
                        </td>
                    </tr>          
                </table>
                <?php echo $controller->createUser();?>
            </form>
        </td>
        <td>
        <p>Mise à jour d'un utilisateur</p>
            <form method="post" action="users_crud.php" name ="userUpdateForm">
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
                            <input type="submit" value="Modifier l'utilisateur">
                        </td>
                    </tr>
                </table>
                <?php echo $controller->updateUser(); ?>
            </form>
        </td>
        <td>
            <p>Supression d'un utilisateur</p>
            <form method="post" action="users_crud.php" name ="userDeleteForm">
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
                            <input type="submit" value="Supprimer un utilisateur">
                        </td>
                    </tr>
                </table>
                <?php echo $controller->deleteUser(); ?>
            </form>
        </td>
    </tr>
</table>