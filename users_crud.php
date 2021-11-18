<head>
    <meta charset="utf-8">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <title>Page de modification de users</title>
  </head>
<?php
use App\Controllers\UsersController;
use App\Services\CarsService;

require __DIR__ . '/vendor/autoload.php';

$controller = new UsersController();
echo $controller->getUsers();

echo $controller->createUser();

$carsService = new CarsService();
$cars = $carsService->getCars();
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
                                <?php $carName = $car->getBrand() . ' ' . $car->getModel() . ' ' . $car->getColor(). ' ' . $car->getNbrSlots(); ?>
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
            </form>
        </td>
<?php
echo $controller->deleteUser();
?>
        <td>
            <p>Supression d'un utilisateur</p>
            <form method="post" action="users_crud.php" name ="userDeleteForm">
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
                            <input type="submit" value="Supprimer un utilisateur">
                        </td>
                    </tr>
                </table>
            </form>
        </td>

<?php
echo $controller->updateUser();
?>
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
            </form>
        </td>
    </tr>
</table>