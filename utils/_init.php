<?php
// Start session
session_start();

// Loading (all) dependencies
require_once(__DIR__ . "/input.inc.php");
require_once(__DIR__ . "/storage.inc.php");
require_once(__DIR__ . "/navigation.inc.php");
require_once(__DIR__ . "/auth.inc.php");
require_once(__DIR__ . "/flash.inc.php");

// Load (all) data sources
$userStorage = new Storage(new JsonIO(__DIR__ . "/../data/users.json"));
$commentsStorage = new Storage(new JsonIO(__DIR__ . "/../data/comments.json"));
$matchesStorage = new Storage(new JsonIO(__DIR__ . "/../data/matches.json"));
$teamsStorage = new Storage(new JsonIO(__DIR__ . "/../data/teams.json"));

// Initialize Auth class
$auth = new Auth($userStorage);

// Create (all) global variables
$errors = load_from_flash("errors", []);
$successes = load_from_flash("successes", []);