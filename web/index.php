<?php
/**
 * Created by JetBrains PhpStorm.
 * User: juandalibaba
 * Date: 12/09/13
 * Time: 19:17
 * To change this template use File | Settings | File Templates.
 */

include("../BioRitmo.php"); // file with class
$my_bior = new BioRitmo ('1972-08-02');// new instance
$my_bior->setDaysToShow(20);
$my_bior->setDiagramHeight(400);
$my_bior->setDiagramWidth(600);
$my_bior->DrawBior('images/my_bior.png'); // build diagram image and put it to disk
echo $my_bior->GetDiagramImageTag(); // show diagram in browser

echo '<pre>';
print_r($my_bior->GetAllPercentages());