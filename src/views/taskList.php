<?php ob_start(); ?>
<header>
    <h1>FocusMind</h1>
    <h3 class="slogan">La todo List intelligente qui te permet de te focus sur ce qui est vraiment important</h3>
    <button id="profile_user"><img src="assets/img/user.png" alt=""></button>
</header>

<div id="addTask">
    <input id="newTaskName" type="text" placeholder="Ajouter une nouvelle tâche" />
    <select name="" id="newTaskType">
        <option value="simple">Tâche Simple </option>
        <option value="appointment">Rendez-vous </option>
        <!-- <option value="note">Note</option> -->
    </select>
    <input id="newTaskDate" type="date" />
    <div id="typeTask">
    </div>
    <button id="newTaskValidate" type="submit">Valider</button>
</div>

<h2>Tâches à faire : </h2>
<ul id="taskList"></ul>
<h2>Tâches faites : </h2>
<ul id="checkedTaskList"></ul>

<?php render('default', true, [
    'title' => 'Task List',
    'link' => '<link rel="stylesheet" href="assets/css/taskList.css">',
    'content' => ob_get_clean(),
]);
?>