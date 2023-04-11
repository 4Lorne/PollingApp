<form action="" method="post">
    <input type="submit" name="no_vote" value="No">
    <input type="submit" name="yes_vote" value="Yes">
</form>

<?php
session_start();

$max_votes = 5; // maximum number of total votes allowed
$total_votes = isset($_SESSION['total_votes']) ? $_SESSION['total_votes'] : 0; // get current total votes
if ($total_votes >= $max_votes) {
    echo "Maximum number of total votes reached.";
    exit;
}

if (isset($_POST['no_vote'])) {
    $_SESSION['no_click'] += 1;
    $_SESSION['total_votes'] += 1;
} else if (isset($_POST['yes_vote'])){
    $_SESSION['yes_click'] += 1;
    $_SESSION['total_votes'] += 1;
} else {
    $_SESSION['yes_click'] = 0;
    $_SESSION['no_click'] = 0;
    $_SESSION['total_votes'] = 0;
}

$yes_click = isset($_SESSION['yes_click']) ? $_SESSION['yes_click'] : 0;
$no_click = isset($_SESSION['no_click']) ? $_SESSION['no_click'] : 0;
$total_votes = isset($_SESSION['total_votes']) ? $_SESSION['total_votes'] : 0;

echo "<p>Yes ".$yes_click."</p>";
echo "<p>No ".$no_click."</p>";
echo "<p>Total Votes ".$total_votes."/".$max_votes."</p>";
?>
