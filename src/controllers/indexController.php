<?php
if (!empty($_SESSION['id'])) redirectTo('taskList');
$error = [];

if (!empty($_POST)) {
	$user = new Models\User();

	if (isset($_POST['register'])) {

		try {
			$user->setFirstname($_POST['firstname']);
		} catch (\Exception $e) {
			$error['firstname'] = $e->getMessage();
		}

		try {
			$user->setLastname($_POST['lastname']);
		} catch (\Exception $e) {
			$error['lastname'] = $e->getMessage();
		}

		try {
			$user->setEmail($_POST['email']);
		} catch (\Exception $e) {
			$error['email'] = $e->getMessage();
		}

		try {
			$user->setPassword($_POST['password'], $_POST['confirmPassword']);
		} catch (\Exception $e) {
			$error['password'] = $e->getMessage();
		}


		if (empty($error)) {
			try {
				if ($user->createUser()) {
					$userData = $user->getUserByEmail();
					if ($userData) {
						$_SESSION['id'] = $userData->id;
						redirectTo('taskList');
					} else {
						$error['global'] = 'Inscription réussie : vous pouvez vous connecté';
					}
				} else {
					$error['global'] = 'Une erreur est survenue, réessayer ultérieurement';
				}
			} catch (\Exception $e) {
				$error['email'] = $e->getMessage();
			}
		}
	} else if (isset($_POST['login'])) {
		try {
			$user->setEmail($_POST['login_email']);
		} catch (\Exception $e) {
			$error['loginEmail'] = $e->getMessage();
		}

		try {
			$user->setPassword($_POST['login_password']);
		} catch (\Exception $e) {
			$error['loginPassword'] = $e->getMessage();
		}
		if (empty($error)) {
			try {
				$userData = $user->getUserByEmail();
				if ($userData) {
					$_SESSION['id'] = $userData->id;
					redirectTo('taskList');
				} else {
					$error['global'] = 'Veuillez réessayer plus tard';
				}
			} catch (\Exception $e) {
				$error['email'] = $e->getMessage();
			}
		}
	}
}
render('index', false, [
	'error' => $error
]);
