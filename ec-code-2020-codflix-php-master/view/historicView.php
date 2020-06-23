<?php ob_start(); ?>

<table class="table">
    <thead class="thead-dark">
    <tr>
        <th style="width: 10%;text-align: center" scope="col">Titre</th>
        <th style="width: 10%;text-align: center" scope="col">Durée</th>
        <th style="width: 10%;text-align: center" scope="col">Description</th>
        <th style="width: 50%;text-align: center" scope="col">url</th>
        <th style="width: 20%;text-align: center" scope="col">Delete</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <?php foreach( $medias as $media ){
            echo '<tr class="ligneTab">';
            echo "<td >" . $media['title']."</td>";
            echo "<td >" . $media['time_of_show']." </td>";
            echo "<td >" . $media['short_description']." </td>";
            echo "<td >" . $media['trailer_url']."</td>";
            echo "<td><a href=\"index.php?deleteHistoric=".$media['id']."\">Delete</a></td>";
            echo "</tr>";
        }
        ?>

    </tr>

    </tbody>
</table>

<a href="index.php?deleteHistoric=0">Delete All</a>

<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>
