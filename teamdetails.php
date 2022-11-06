<?php
error_reporting(E_ALL);
ini_set("display_errors","On");

// Include init code
require_once("utils/_init.php");
require_once "utils/functions.inc.php";
require_once "utils/auth.inc.php";

if (isset($_GET['team-id'])) {
    $teamId = $_GET['team-id'];
    $team = $teamsStorage->findById($teamId);
    $teams= $teamsStorage->findAll(); //Array of teams
    $matches= $matchesStorage->findAll(); //Array of matches


    if (isset($_POST['comment'])) {
        $comment = $_POST['comment'];
        if ($comment === '') {
            $errors[]  = 'Comment can not be empty';
        } else {
            $comment = [
                "author" => $auth->getUserId(),
                "text" => $comment,
                "teamid" => $teamId,
                "commentid" => uniqid(),
            ];
            $commentsStorage->add($comment);
        }
    }

    $comments =$commentsStorage->findAll(); //Array of comments
} else {
    header('Location: index.php');
}

function getBg($match) {
    return intval($match['hostscore']) > intval($match['guestscore']) ?  'bg-success' :
        (intval($match['hostscore']) < intval($match['guestscore']) ? 'bg-danger' : 'bg-warning');
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php require("partials/header.inc.php") ?>
    <?php require("partials/errors.inc.php") ?>
    <button type="button" class="btn btn-secondary" onclick="location.href = 'index.php'">
        &larr; Back
    </button>
    <?php if (isset($team)): ?>
        <h1><?= $team['name'] ?></h1>

    <table class="table table-bordered">
        <?php foreach (findTeamMatches($matches, $teamId) as $match): ?>
            <tr class="<?= getBg($match) ?> ">
                <td>
                    <p><?=findTeam($teams, $match["hostID"])['name']?> - <?=findTeam($teams, $match["guestID"])['name']?></p>
                </td>
                <td>
                    <p><?= $match['date'] ?></p>
                </td>
                <td>
                    <?php if (isset($match['hostscore']) and isset($match['guestscore'])): ?>
                        <p><?= $match['hostscore'] . ' - ' . $match['guestscore'] ?></p>
                    <?php else: ?>
                        <p>No score</p>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <table class="table table-bordered">
        <?php foreach (findTeamComments($comments, $teamId) as $comment): ?>
            <tr>
                <td>
                    Author: <?= $comment['author'] ?>
                    <p><?= $comment['text'] ?></p>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <?php endif; ?>

    <?php if ($auth->is_authenticated()): ?>
        <h5>Create comment</h5>
        <form method="post">
            <textarea type="text" name="comment" class="input"></textarea>
            <button class="btn btn-primary">Submit</button>
        </form>
    <?php endif; ?>
</body>
</html>
