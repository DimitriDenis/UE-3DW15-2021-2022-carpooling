<head>
    <meta charset="utf-8">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <title>Page de modification des annonces</title>
</head>
<?php
use App\Controllers\AnsController;

require __DIR__ . '/vendor/autoload.php';

$controller = new AnsController();
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
                            <label for="name">Nom :</label>  
                        </td>
                        <td>
                            <input type="text" name="title">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="departure">Départ :</label>
                        </td>
                        <td>
                            <input type="text" name="departure">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="destination">Arrivée :</label>
                        </td>
                        <td>
                            <input type="text" name="destination">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="date">Date de départ :</label>
                        </td>
                        <td>
                            <input type="text" name="datea" placeholder="format dd-mm-yyyy :">
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" value="Créer une annonce">
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
                            <input type="text" name="idup">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="name">Nom :</label>
                        </td>
                        <td>
                            <input type="text" name="titleup">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="departure">Departure :</label>
                        </td>
                        <td>
                            <input type="text" name="departureup">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="destination">Destination :</label>
                        </td>
                        <td>
                            <input type="text" name="destinationup">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="date">Date :</label>
                        </td>
                        <td>
                            <input type="text" name="dateup" placeholder="format dd-mm-yyyy :">
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" value="Modifier l'utilisateur">
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
                            <input type="text" name="iddel">
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" value="Supprimer un utilisateur">
                        </td>
                    </tr>
                </table>
                <?php echo $controller->deleteAn(); ?>
            </form>
        </td>
    </tr>
</table>