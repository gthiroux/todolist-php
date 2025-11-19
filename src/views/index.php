<?php
ob_start();
// $user = new Models\User();

// $user->setFirstname('juju');
// $user->setLastname('jslkdj');
// $user->setEmail('jslkdj@dj.s');
// $user->setPassword('ttt');

// $user->createUser();
// $user->modifUser(1);
// $user->deleteUser(1);

// var_dump($user);
$task = new Models\Task();
$task->setNameTask('test');
$task->setTypeTask('test');
$task->createTask();
var_dump($task);

?>

<h1>Acceuil</h1>

<input id="user" type="text" name="" id="">
<small id="userError"></small>

<?php
render('default', true, [
	'title' => 'Acceuil',
	'css' => 'index',
	'content' => ob_get_clean(),
]);
?>