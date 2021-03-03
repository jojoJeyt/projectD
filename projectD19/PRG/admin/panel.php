<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/admin.css">

    <title>Административная панель — Услуги комеьютерного мастера</title>

    <?php

        if(!isset($_SESSION['user_login'])){
            header("Location: index.php");
        }

        if(isset($_POST['logout'])){ 
            unset($_SESSION['user_login']);
            session_destroy();
            header("Location: index.php");
        }
    ?>

    <?php
        $userEmail = $_SESSION['user_login'];

        require("../inc/connection.php");
        
        $userInfo 	= 	$mysqli->query("SELECT * FROM users WHERE users.email = '".$userEmail."'");
        while($row = $userInfo->fetch_assoc()){
            $userName    =   $row['name'];
            $userRole    =   $row['role'];

            if ($userRole == '1'){
                $userStatus = "Администратор";
            } else if ($userRole == '2'){
                $userStatus = "Мастер";
            } else if ($userRole == '3'){
                $userStatus = "Клиент";
            }
        }

        $mysqli->close();

        if (isset($_POST['saveManager'])){
        
            $task           = $_POST['taskID'];
            $manager        = $_POST['setManager'];

            require("../inc/connection.php");
            $mysqli->query("UPDATE tasks SET tasks.manager = '$manager', tasks.status = '1'  WHERE tasks.id = '$task'");
            
            $fetch_man  = $mysqli->query("SELECT * FROM users WHERE users.email = '$manager'");
            while ($row = $fetch_man->fetch_assoc()) {
                $setsManagerName = $row['name'];
                $setsManagerPhone = $row['phone'];
            }
            $fetch_clmail   = $mysqli->query("SELECT * FROM tasks WHERE tasks.id = '$task'");
            while ($row = $fetch_clmail->fetch_assoc()) {
                $setsClientEmail = $row['clientEmail'];
                $setsClientTask = $row['task'];
                $setsClientComment = $row['comment'];
            }
            $fetch_clname   = $mysqli->query("SELECT * FROM users WHERE users.email = '$setsClientEmail'");
            while ($row = $fetch_clmail->fetch_assoc()) {
                $setsClientName = $row['name'];
                $setsClientPhone = $row['phone'];
                $setsClientAddress = $row['address'];
            }
            $mysqli->close();

//
//
//
$message_one = 'Уважаемый ' . $setsManagerName .', вам поступила задача на услугу '. $setsClientTask .'.

Детали заказа:

Имя клиента: ' . $setsClientName . '
Email клиента: ' . $setsClientEmail . '
Телефон клиента: ' . $setsClientPhone . '
Адрес клиента: ' . $setsClientAddress . '

Дополнительный комментарий от клиента: ' . $setsClientComment . '

В течении суток вам необходимо связаться с клиентом для уточнения плана работ.
После завершения заказа необходимо отметить статус в панели: http://bkbase.ru/admin/

---
С уважением,
Команда BK Base ♥
';
//
//
//

//
//
//

$message_two = $setsClientName .', на вашу заявку назначен ответственный мастер.

Он свяжется с вами в течении суток.

Контактные данные мастера:

Имя: ' . $setsManagerName . '
Телефон: ' . $setsManagerPhone . '
Email: ' . $manager . '

---
С уважением,
Команда BK Base ♥
';

//
//
//

mail($manager, "BK Base — новый заказ", $message_one,
"From: BK Base <noreply@bkbase.ru> \r\n"
."X-Mailer: PHP/" . phpversion());

mail($setsClientEmail, "BK Base — назначение ответственного мастера", $message_two,
"From: BK Base <noreply@bkbase.ru> \r\n"
."X-Mailer: PHP/" . phpversion());




        }

        if (isset($_POST['successTask'])){
            $task           = $_POST['taskID'];

            require("../inc/connection.php");
            $mysqli->query("UPDATE tasks SET tasks.status = '2'  WHERE id = $task") ;
            $mysqli->close();
        }
    ?>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
            <a class="navbar-brand" href="#">BK Base | Admin</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        Добро пожаловать <strong><?= $userName; ?></strong>! Ваш статус в системе: <strong><?= $userStatus; ?></strong>.
                    </li>
                    <li class="nav-item">
                        <form action="panel.php" method="post" class="logout"><button type="submit" name="logout" class="form-control logout_button">Выход</button></form>
                    </li>
                </ul>
            </div>
        </nav>
    </header>


    <?php
        if ($userRole == '1'){
    ?>
    <section class="all">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h2 class="all_title">Проекты в системе</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-bordered"> 
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Клиент</th>
                                    <th>Задача</th>
                                    <th>Комментарий клиента</th>
                                    <th>Дата поступления заявки</th>
                                    <th>Ответственный менеджер</th>
                                    <th>Статус задачи</th>
                                    <th>Дата закрытия задачи</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                    require("../inc/connection.php");
                                    $tasks = $mysqli->query("SELECT * FROM tasks ORDER BY tasks.start DESC");
                                    $mysqli->close();
                                    
                                    $countnews = 0;
                                    
                                    while ($row = $tasks->fetch_assoc()) {

                                        if ($row['status'] == 0){
                                            $taskClass = 'table-danger';
                                            $taskStatus = 'Ответственный не назначен';
                                        } elseif ($row['status'] == 1){
                                            $taskClass = 'table-info';
                                            $taskStatus = 'Задача в работе';
                                        } elseif ($row['status'] == 2){
                                            $taskClass = 'table-success';
                                            $taskStatus = 'Задача закрыта';
                                        }

                                        if ($row['finish'] == 0000-00-00){
                                            $taskFinish = 'Не закрыта';
                                        } else {
                                            $taskFinish = $row['finish'];
                                        }
                                        
                                    ?>

                                        <tr class="<?= $taskClass; ?>">
                                            <td scope="row"><?= ++$countnews;?></td>
                                            <td scope="row"><?= $row['user'];?></td>
                                            <td scope="row"><?= $row['task'];?></td>
                                            <td scope="row"><?= $row['comment'];?></td>
                                            <td scope="row"><?= $row['start'];?></td>
                                            <td scope="row">
                                                <?php
                                                    if ($row['manager'] == ''){ ?> 
                                                    <form action="panel.php" method="post">
                                                        <div class="form-group">
                                                            <select class="form-control" name="setManager">
                                                                <?php 
                                                                require("../inc/connection.php");
                                                                $managers = $mysqli->query("SELECT * FROM users WHERE users.role = '2'");
                                                                $mysqli->close();
                                                                while ($rows = $managers->fetch_assoc()) { ?>
                                                                        <option value="<?= $rows['email'];?>"><?= $rows['name'];?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <input type="hidden" value="<?= $row['id'];?>" name="taskID">

                                                        <button class="btn btn-primary" type="submit" name="saveManager">Назначить</button>
                                                    </form>
                                                    <?php
                                                    } else {
                                                        $mmEmail = $row['manager'];

                                                        require("../inc/connection.php");
                                                        $managerss = $mysqli->query("SELECT * FROM users WHERE users.email = '$mmEmail'");
                                                        $mysqli->close();

                                                        while ($rows = $managerss->fetch_assoc()) { 
                                                            echo $rows['name'];
                                                        } 
                                                    }
                                                ?>
                                            </td>
                                            <td scope="row"><?= $taskStatus;?></td>
                                            <td scope="row"><?= $taskFinish;?></td>
                                        </tr>
                    
                                    <?php
                                        }
                                ?>

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="all" style="margin-bottom: 150px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <h2 class="all_title_alt">Список мастеров</h2>

                    <div class="table-responsive">
                        <table class="table table-bordered"> 
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Имя</th>
                                    <th>Email</th>
                                    <th>Активных задач</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                    require("../inc/connection.php");
                                    $masters = $mysqli->query("SELECT * FROM users WHERE users.role = '2'");
                                    $mysqli->close();
                                    
                                    $countnews = 0;
                                    
                                    while ($row = $masters->fetch_assoc()) { ?>

                                        <tr>
                                            <td scope="row"><?= ++$countnews;?></td>
                                            <td scope="row"><?= $row['name'];?></td>
                                            <td scope="row"><?= $row['email'];?></td>
                                            <td scope="row">
                                                    <?php 
                                                        $masterEmail = $row['email'];

                                                        require("../inc/connection.php");
                                                        $managers     = $mysqli->query("SELECT * FROM tasks WHERE tasks.manager = '$masterEmail'");
                                                        $managersNum  =	$managers   ->num_rows;
                                                        $mysqli->close();
                                                    ?>
                                                    <?= $managersNum;?>
                                            </td>
                                        </tr>
                    
                                    <?php
                                        }
                                ?>

                            </tbody>

                        </table>
                    </div>
                </div>
                <div class="col-lg-6">
                    <h2 class="all_title_alt">Список клиентов</h2>

                    <div class="table-responsive">
                        <table class="table table-bordered"> 
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Имя</th>
                                    <th>Email</th>
                                    <th>Телефон</th>
                                    <th>Адрес</th>
                                    <th>Обращений</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                    require("../inc/connection.php");
                                    $clients = $mysqli->query("SELECT * FROM users WHERE users.role = '3'");
                                    $mysqli->close();
                                    
                                    $countnews = 0;
                                    
                                    while ($row = $clients->fetch_assoc()) { ?>

                                        <tr>
                                            <td scope="row"><?= ++$countnews;?></td>
                                            <td scope="row"><?= $row['name'];?></td>
                                            <td scope="row"><?= $row['email'];?></td>
                                            <td scope="row"><?= $row['phone'];?></td>
                                            <td scope="row"><?= $row['address'];?></td>
                                            <td scope="row">
                                                    <?php 
                                                        $cccliensEmail = $row['email'];

                                                        require("../inc/connection.php");
                                                        $cccleints     = $mysqli->query("SELECT * FROM tasks WHERE tasks.user LIKE '%$cccliensEmail%'");
                                                        $cccleintsNum  =	$cccleints   ->num_rows;
                                                        $mysqli->close();
                                                    ?>
                                                    <?= $cccleintsNum;?>
                                            </td>
                                        </tr>
                    
                                    <?php
                                        }
                                ?>

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
                    
                </div>
            </div>
        </div>
    </section>

    <?php
        } else if ($userRole == '2'){
    ?>

    <section class="all">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h2 class="all_title">Активные задачи</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-bordered"> 
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Клиент</th>
                                    <th>Задача</th>
                                    <th>Комментарий клиента</th>
                                    <th>Дата поступления заявки</th>
                                    <th>Статус задачи</th>
                                    <th>Отметка о выполнении</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                    require("../inc/connection.php");
                                    $tasks = $mysqli->query("SELECT * FROM tasks WHERE tasks.manager = '$userEmail' ORDER BY tasks.start DESC");
                                    $mysqli->close();
                                    
                                    $countnews = 0;
                                    
                                    while ($row = $tasks->fetch_assoc()) {

                                        if ($row['status'] == 0){
                                            $taskClass = 'table-danger';
                                            $taskStatus = 'Ответственный не назначен';
                                        } elseif ($row['status'] == 1){
                                            $taskClass = 'table-info';
                                            $taskStatus = 'Задача в работе';
                                        } elseif ($row['status'] == 2){
                                            $taskClass = 'table-success';
                                            $taskStatus = 'Задача закрыта';
                                        }

                                    ?>

                                        <tr class="<?= $taskClass; ?>">
                                            <td scope="row"><?= ++$countnews;?></td>
                                            <td scope="row"><?= $row['user'];?></td>
                                            <td scope="row"><?= $row['task'];?></td>
                                            <td scope="row"><?= $row['comment'];?></td>
                                            <td scope="row"><?= $row['start'];?></td>
                                            <td scope="row"><?= $taskStatus;?></td>
                                            <td scope="row">
                                                <?php if ($row['status'] == 2){
                                                    echo 'Задача закрыта';
                                                } else { ?>
                                                <form action="panel.php" method="post">
                                                    <input type="hidden" value="<?= $row['id'];?>" name="taskID">
                                                    <button class="btn btn-success btn-block" type="submit" name="successTask">Закрыть задачу</button>
                                                </form>
                                                <?php } ?>
                                            </td>
                                        </tr>

                                    <?php } ?>

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
        } else if ($userRole == '3'){
    ?>

    <section class="all">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <h2 class="all_title">Ваши обращения</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-bordered"> 
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Задача</th>
                                        <th>Ваш комментарий</th>
                                        <th>Ваш менеджер</th>
                                        <th>Дата поступления заявки</th>
                                        <th>Статус задачи</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                        require("../inc/connection.php");
                                        $tasks = $mysqli->query("SELECT * FROM tasks WHERE tasks.user LIKE '%$userEmail%'");
                                        $mysqli->close();
                                        
                                        $countnews = 0;
                                        
                                        while ($row = $tasks->fetch_assoc()) {

                                            if ($row['status'] == 0){
                                                $taskClass = 'table-danger';
                                                $taskStatus = 'Ответственный не назначен';
                                            } elseif ($row['status'] == 1){
                                                $taskClass = 'table-info';
                                                $taskStatus = 'Задача в работе';
                                            } elseif ($row['status'] == 2){
                                                $taskClass = 'table-success';
                                                $taskStatus = 'Задача закрыта';
                                            }

                                        ?>

                                            <tr class="<?= $taskClass; ?>">
                                                <td scope="row"><?= ++$countnews;?></td>
                                                <td scope="row"><?= $row['task'];?></td>
                                                <td scope="row"><?= $row['comment'];?></td>
                                                <td scope="row"><?= $row['manager'];?></td>
                                                <td scope="row"><?= $row['start'];?></td>
                                                <td scope="row"><?= $taskStatus;?></td>
                                            </tr>

                                        <?php } ?>

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <?php
        }
    ?>

    <footer id="contacts" class="fixed-bottom">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <p>© Tolkach Eugene — Student of <a href="http://mgke.minsk.edu.by/" target="_blank">MGKE</a> | <a href="https://vk.com/jojojey" target="_blank">VK</a></p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    
    <script src="./js/admin.js"></script>
    
</body>
</html>