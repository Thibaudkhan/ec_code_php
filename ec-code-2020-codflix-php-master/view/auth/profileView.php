<?php ob_start();

?>

<div class="d-flex flex-column mt-5" >
    <div class="container-fluid p-2" style="margin-bottom: 13%;">
        <form class="form-inline" action="index.php?changeProfile=changePassword" method="post">
            <div class="form-group">
                <label for="oldPass">Entrez votre ancien mot de passe</label>
                <input type="password"name="oldPass" id="oldPass" class="form-control mx-sm-3" aria-describedby="passwordHelpInline">
                <label for="newPass">Nouveau mot de passe</label>
                <input type="password" name="newPass" id="newPass" class="form-control mx-sm-3" aria-describedby="passwordHelpInline">
                <label for="newPass2">Répetez votre nouveau mot de passe</label>
                <input type="password" name="newPass2" id="newPass2" class="form-control mx-sm-3" aria-describedby="passwordHelpInline">
                <input type="submit" class="btn btn-primary">Modifier</input>
            </div>
        </form>
    </div>
    <div class="container-fluid p-2" style="margin-bottom: 13%;">
        <form class="form-inline" method="post" action="index.php?changeProfile=changeEmail">
            <div class="form-group">
                <label for="email">Votre adresse mail</label>
                <input name="email" type="email" id="email" value="<?php echo $email ?>" class="form-control mx-sm-3" aria-describedby="passwordHelpInline">
                <button type="submit" class="btn btn-primary">Modifier</button>
            </div>
        </form>
    </div>
    <div class="container-fluid p-2" >
        <form class="form-inline" method="post" action="index.php?changeProfile=deleteAccount">
            <div class="form-group">

                <label for="confirmPassword">Saisissez votre mot de passe pour supprimer </label>
                <input type="password" name="confirmPassword" id="confirmPassword" class="form-control mx-sm-3" aria-describedby="passwordHelpInline">
                <label class="mr-5" for="delete">Cliquer pour supprimer votre compte (cette action sera irréversible)</label>
                <button id="delete" type="submit" class="btn btn-danger">Supprimer</button>
            </div>
        </form>
    </div>
</div>


<?php $content = ob_get_clean(); ?>

<?php require('view/dashboard.php'); ?>
