<?php

// some useful functions

/**
 * @param $teams
 * @param $teamId
 * @return false|mixed|null
 */
function findTeam($teams, $teamId) {
    return current(array_filter($teams, function ($team) use ($teamId) {
        return $team['id'] === $teamId;
    })) ?? null;
}

/**
 * @param array $matches
 * @param string $teamId
 */
function findTeamMatches($matches, $teamId) {
    return array_filter($matches, function ($match) use ($teamId) {
        return $match['hostID'] === $teamId;
    });
}

/**
 * @param array $comments
 * @param string $teamId
 * @return array
 */
function findTeamComments($comments, $teamId) {
    return array_filter($comments, function ($match) use ($teamId) {
        return $match['teamid'] === $teamId;
    });
}


function compareMatchesByDate($match1, $match2) {
    return strtotime($match1['date']) > strtotime($match2['date']) ? 1 :
        (strtotime($match1['date']) < strtotime($match2['date']) ?  -1 : 0);
}

function sortMatches($matches) {
    usort($matches, "compareMatchesByDate");
    return array_reverse($matches);
}

function getFirstN($matches, $size = 5) {
    return array_slice($matches, 0, $size);
}