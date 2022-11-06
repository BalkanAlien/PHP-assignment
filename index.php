<?php
error_reporting(E_ALL);
ini_set("display_errors","On");
// Include init code
require_once("utils/_init.php");
require_once("utils/auth.inc.php");
require_once "utils/functions.inc.php";

// Fetch all data
$users = $userStorage->findAll(); // Array of users
$teams= $teamsStorage->findAll(); //Array of teams
$matches=$matchesStorage->findAll(); //Array of matches
$comment=$commentsStorage->findAll(); //Array of comments


$registered=false;
$app=null;

?>
<?php require("partials/header.inc.php") ?>

<html>
    <div class="description">
    <p>I'm proud to introduce ELTE Stadium to you.</p>
    <p>Here you can find all the latest matches and your favorite teams!</p>
    <p>If you liked us, you can register to our page and receive all the latest news!</p>
    </div>

<div class="authentication">
<!--  IDK what part is it   -->
<?php //if ($auth->is_authenticated()): ?>
<!--  --><?php //foreach ($users as $user): ?><!--  -->
<!--                  --><?php //if($post["username"]==($auth->authenticated_user()["username"])): ?>
<!--                      --><?php //if($post["registered"]==true):?>
<!--                            -->
<!--                      <h1 style="color:Red;background-color=Brown">You have already registered!</h1>-->
<!--                              --><?php //endif;?>
<!--                          --><?php //$count=false  ?>
<!--                    --><?php //endif; ?>
<!--   --><?php //endforeach; ?>
<?php //endif; ?>

<br>
<br>

<?php require("partials/errors.inc.php") ?>


    <table class="table table-bordered table-hover">
        <tr scope="row">
            <h3> The most popular teams</h3>
        </tr>
        <?php foreach($teams as $id => $team):?>
            <tr role="button" onclick="location.href='./teamdetails.php?team-id=<?=$id?>'">
                <td>
                    name: <p><?=$team["name"]?></p>
                </td>
                <td>
                    city: <p><?=$team["city"]?></p>
                </td>
            </tr>
        <?php endforeach?>
    </table>
    <table class="table table-bordered mt-4">
        <tr scope="row">
            <h3>Last 5 Matches</h3>
        </tr>
        <?php foreach(getFirstN(sortMatches($matches)) as $match):?>
            <tr>
                <td>
                    <p><?=findTeam($teams, $match["hostID"])['name']?> - <?=findTeam($teams, $match["guestID"])['name']?></p>
                </td>
                <td>
                    <p><?= $match['date'] ?></p>
                </td>
            </tr>
        <?php endforeach?>
    </table>
</html>


