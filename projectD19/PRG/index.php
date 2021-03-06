<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/main.css">

    <title>BK Base — Сервисный центр</title>

    <?php
        if (isset($_POST['servSend'])){
        
            $clientName     = $_POST['clientName'];
            $clientEmail    = $_POST['clientEmail'];
            $clientAddress  = $_POST['clientAddress'];
            $clientPhone    = $_POST['clientPhone'];
            $clientComment  = $_POST['clientComment'];

            $servName       = $_POST['servName'];

            $clientInfo = "Имя: <strong>" . $clientName . "</strong><br>Email: <strong>" . $clientEmail . "</strong><br>Телефон: <strong>" . $clientPhone . "</strong><br>Адрес: <strong>" . $clientAddress . "</strong>";

            $date = date("Y-m-d"); 

            require("inc/connection.php");

            $sql = "INSERT tasks
            VALUES ('', '$clientEmail', '$clientInfo', '$servName', '$clientComment', '', '0', '$date', '0000-00-00')";

            if ($mysqli->query($sql) === TRUE) {
                
            } else {
                echo "Error: " . $sql . "<br>" . $mysqli->error;
            }

            $sql = "INSERT users
            VALUES ('', '$clientName', '$clientEmail', '$clientPhone', '$clientAddress', 'clientpassword', '3')";

            if ($mysqli->query($sql) === TRUE) {
                
            } else {
                echo "Error: " . $sql . "<br>" . $mysqli->error;
            }

            $mysqli->close();

//
//
//

$adminemail = "egecexcel123@gmail.com";

$message_one = $clientName .', ваша заявка на услугу '. $servName .' принята.

В течении суток к вам будет привязан специалист для выполнения необходимых работ

---
С уважением,
Команда BK Base ♥
';

//
//
//

$message_two = 'Поступила новая заявка

Название услуги: ' . $servName . '
Имя клиента: ' . $clientName . '
Email клиента: ' . $clientEmail . '
Телефон клиента: ' . $clientPhone . '
Адрес клиента: ' . $clientAddress . '

Дополнительный комментарий от клиента: ' . $clientComment . '
 
Дата формирования заказа: ' . $date . '

Необходимо оценить работу и назначить ответственного мастера: http://bkbase.ru/admin/
';
//
//
//

mail($clientEmail, "BK Base — заявка на услугу", $message_one,
"From: BK Base <noreply@bkbase.ru> \r\n"
."X-Mailer: PHP/" . phpversion());

mail($adminemail, "BK Base — заявка на услугу", $message_two,
"From: BK Base <noreply@bkbase.ru> \r\n"
."X-Mailer: PHP/" . phpversion());
//
//
//

        }
    ?>

    

   
</head>
<body>
    
    <?php
        if (isset($_POST['servSend'])){
            ?>
            <div style="position:absolute; background-color: #fff; padding: 15px; width:100%; top:56px; left:0; z-index: 99999;text-align:center;">
                <p style="margin:0px;">Спасибо! Ваша заявка принята. С Вами скоро свяжутся для уточнения информации.</p>
            </div>
            <?php
        }
    ?>
    
    <menu>
        <nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color: #e3f2fd;">
            <a class="navbar-brand" href="#">BK Base</a>
            
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#about">О компании</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#services">Услуги</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contacts">Контакты</a>
                    </li>
                </ul>
            </div>
        </nav>
    </menu>

    <header>
        <div class="container">
            <div class="row align-items-center" style="height:100vh;">
                <div class="col-12 text-center">
                    <h2 class="header_title">Ремонт компьютеров в Минске с гарантией</h2>
                    <h3 class="header_subtitle">Быстро. Качественно. Надежно.</h3>
                    <a class="header_link" href="#services">Список услуг</a>
                </div>
            </div>
        </div>
    </header>

    <section id="about">
        <div class="container marketing">
            <div class="row">
                <div class="col-12">
                    <h2 class="about_title">О компании</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="about_place">
                        <p class="about_txt">В век современных технологий невозможно представить свою повседневную жизнь без компьютера. Однако технические проблемы ПК не являются редкостью. Очень важным в выбор сервиса по ремонту компьютеров является <strong>уровень профессионализма</strong>, с которым подходит компания к выполнению своей работы.</p>

                        <p class="about_txt">В нашей компании <strong>BK Base</strong> весь процесс осуществляется <strong>опытными специалистами</strong>, которым под силу справиться с задачей любой сложности. Мы предлагаем услуги по ремонту компьютеров.</p>

                        <p class="about_txt">Если у вас возникли вопросы, связанные с ремонтом ПК, или вы хотите получить профессиональную консультацию, сотрудники нашей компании с удовольствием <strong>ответят на все интересующие вас вопросы</strong>.</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <img class="rounded-circle" src="./assets/img/1.png" alt="Generic placeholder image" width="140" height="140">
                    <h2>Гарантии</h2>
                    <p>Гарантия на услуги нашего сервисного центра от 2 месяцев до 1 года</p>
                </div>
                
                <div class="col-lg-4">
                    <img class="rounded-circle" src="./assets/img/2.png" alt="Generic placeholder image" width="140" height="140">
                    <h2>Сроки выполнения</h2>
                    <p>Выполняем задачи в короткие сроки.С нами вы экономите не только время но деньги.</p>
                </div>
                
                <div class="col-lg-4">
                    <img class="rounded-circle" src="./assets/img/3.png" alt="Generic placeholder image" width="140" height="140">
                    <h2>Опыт</h2>
                    <p>Опыт работы мастеров 5 лет, это нам позволяет справиться с любой задачей</p>
                </div>
            </div>

        </div>
    </section>

    <section id="services">

        <div class="container services">
            <div class="row">
                <div class="col-12">
                    <h2 class="services_title">Наши услуги</h2>
                </div>
            </div>

            <div class="card-deck mb-3 text-center">
                <div class="card mb-4 box-shadow">
                    <div class="card-header">
                        <h4 class="my-0 font-weight-normal">Диагностика компьютера</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title">15 <small class="text-muted">BYN</small></h1>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li>Диагностика видеокарты</li>
                            <li>Диагностика жесткого диска (интерфейсы IDE, SATA)</li>
                            <li>Диагностика звуковой карты</li>
                            <li>Диагностика интерфейсных контроллеров USB, 1394 и т.п</li>
                        </ul>
                        <button type="button" class="btn btn-lg btn-block btn-outline-primary" data-toggle="modal" data-target="#servOne">Заказать</button>
                    </div>
                </div>

                <div class="card mb-4 box-shadow">
                    <div class="card-header">
                        <h4 class="my-0 font-weight-normal">Установка операционной системы</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title">35 <small class="text-muted">BYN</small></h1>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li>Подбор оптимальной операционный системы под ваши нужды</li>
                            <li>Покупка и установка лицензионной версии ОС</li>
                            <li>Установка и настройка всех драйверов</li>
                            <li>Установка базового ПО</li>
                        </ul>
                        <button type="button" class="btn btn-lg btn-block btn-outline-primary" data-toggle="modal" data-target="#servTwo">Заказать</button>
                    </div>
                </div>
                <div class="card mb-4 box-shadow">
                    <div class="card-header">
                        <h4 class="my-0 font-weight-normal">Сборка компьютера на заказ</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title">250 <small class="text-muted">BYN</small></h1>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li>Определение целей и потребностей клиента</li>
                            <li>Подбор оптимальных комплектущих</li>
                            <li>Выбор подрядчиков для закупки оборудования</li>
                            <li>Сборка и тесты всей системы</li>
                        </ul>
                        <button type="button" class="btn btn-lg btn-block btn-outline-primary" data-toggle="modal" data-target="#servThree">Заказать</button>
                    </div>
                </div>

                </div>
            <div class="card-deck mb-3 text-center">

                <div class="card mb-4 box-shadow">
                    <div class="card-header">
                        <h4 class="my-0 font-weight-normal">Установка ПО</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title">25 <small class="text-muted">BYN</small></h1>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li>Установка любых приложений (пользовательских и специальных)</li>
                            <li>Установка офисных программ (Пакет Microsoft Office и др.)</li>
                            <li>Установка кодеков для видео и аудиофайлов</li>
                            <li>Установка драйверов</li>
                        </ul>
                        <button type="button" class="btn btn-lg btn-block btn-outline-primary" data-toggle="modal" data-target="#servFoure">Заказать</button>
                    </div>
                </div>
                <div class="card mb-4 box-shadow">
                    <div class="card-header">
                        <h4 class="my-0 font-weight-normal">Восстановление данных</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title">30 <small class="text-muted">BYN</small></h1>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li>Жесткие диски (HDD)</li>
                            <li>SSD накопители</li>
                            <li>Flash-карты любых интерфейсов (usb-флешки, miniSD, microSD)</li>
                        </ul>
                        <button type="button" class="btn btn-lg btn-block btn-outline-primary" data-toggle="modal" data-target="#servFive">Заказать</button>
                    </div>
                </div>

                
                <div class="card mb-4 box-shadow">
                    <div class="card-header">
                        <h4 class="my-0 font-weight-normal">Удаление вирусов</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title">20 <small class="text-muted">BYN</small></h1>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li>Очистка компьютера от вредоностных ПО</li>
                            <li>Исправление при полной блокировки ПК</li>
                            <li>Защита от дальнейших атак</li>
                        </ul>
                        <button type="button" class="btn btn-lg btn-block btn-outline-primary" data-toggle="modal" data-target="#servSix">Заказать</button>
                    </div>
                </div>

                </div>
            <div class="card-deck mb-3 text-center">
                <div class="card mb-4 box-shadow">
                    <div class="card-header">
                        <h4 class="my-0 font-weight-normal">Чистка от пыли. Замена термопасты</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title">25 <small class="text-muted">BYN</small></h1>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li>Безопасная очистка куллера</li>
                            <li>Проверка и чистка систем охлаждения</li>
                            <li>Заменка термопасты на видеокарте и процессоре</li>
                        </ul>
                        <button type="button" class="btn btn-lg btn-block btn-outline-primary" data-toggle="modal" data-target="#servSeven">Заказать</button>
                    </div>
                </div>

                
                <div class="card mb-4 box-shadow">
                    <div class="card-header">
                        <h4 class="my-0 font-weight-normal">Настройка интернета, Wi-Fi</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title">27 <small class="text-muted">BYN</small></h1>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li>Настройка Ethernet(через кабель) подключения</li>
                            <li>Выбор, подключение и настройка Wi-Fi маршрутизаторов</li>
                            <li>Настройка локальной сети</li>
                        </ul>
                        <button type="button" class="btn btn-lg btn-block btn-outline-primary" data-toggle="modal" data-target="#servEight">Заказать</button>
                    </div>
                </div>
                <div class="card mb-4 box-shadow">
                    <div class="card-header">
                        <h4 class="my-0 font-weight-normal">Ремонт и замена комплектующих</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title">25 <small class="text-muted">BYN</small></h1>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li>Ремонт компьютеров и ноутбуков</li>
                            <li>Замена комплектующих</li>
                        </ul>
                        <button type="button" class="btn btn-lg btn-block btn-outline-primary" data-toggle="modal" data-target="#servNine">Заказать</button>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <footer id="contacts">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <p>© Tolkach Eugene — Student of <a href="http://mgke.minsk.edu.by/" target="_blank">MGKE</a> | <a href="https://vk.com/jojojey" target="_blank">VK</a></p>
                </div>
            </div>
        </div>
    </footer>


    <!-- Первая услуга -->
    <div class="modal fade bd-example-modal-xl" id="servOne" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="servOneLabel">Заказ услуги — <strong>Диагностика компьютера</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <div class="row">
                        <div class="col-lg-6">
                            <img src="https://hivetech.ru/wa-data/public/site/img/windwows-install.jpg" style="width:100%; margin-bottom: 15px;">
                        </div>
                        <div class="col-lg-6">
                            <p>По данным социальных опросов в среднем люди до тридцати пяти лет используют компьютер более двух часов в сутки.</p>

                            <p>И хотя современные компьютеры являются надежной техникой, но даже она иногда ломается, причем зачастую тогда, когда Вы в нем нуждаетесь.</p>

                            <p>Диагностика компьютера от компании <strong>BK Base</strong> – это первый шаг к решению проблемы.</p>
                        </div>
                    </div>

                    <h3 style="font-size: 20px; font-weight: 700; margin: 25px 0px;">Оставить заявку</h3>

                    <form action="/" method="post">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nameInput">ФИО</label>
                                    <input type="name" required class="form-control" id="nameInput" name="clientName" placeholder="Введите Ваше ФИО">
                                </div>
                                <div class="form-group">
                                    <label for="emailInput">Email</label>
                                    <input type="email" required class="form-control" id="emailInput" name="clientEmail" placeholder="Введите Ваш адрес почты">
                                </div>
                                <div class="form-group">
                                    <label for="phoneInput">Телефон</label>
                                    <input type="name" required class="form-control" id="phoneInput" name="clientPhone" placeholder="Введите Ваш номер телефона">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="addresInput">Адрес</label>
                                    <input type="name" required class="form-control" id="addresInput" name="clientAddress" placeholder="Введите Ваш адрес">
                                </div>
                                <div class="form-group">
                                    <label for="commArea">Комментарий</label>
                                    <textarea class="form-control" id="commArea" rows="3" name="clientComment" placeholder="Добавьте комментарии, если есть"></textarea>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="servName" value="Диагностика компьютера">
                        
                        <button type="submit" class="btn btn-primary" name="servSend">Заказать</button> <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Вторая услуга -->
    <div class="modal fade bd-example-modal-xl" id="servTwo" tabindex="-1" role="dialog" aria-labelledby="servTwoLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="servTwoLabel">Заказ услуги — <strong>Установка операционной системы</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <div class="row">
                        <div class="col-lg-6">
                            <img src="https://i.ytimg.com/vi/DtrLzGP92Fc/maxresdefault.jpg" style="width:100%; margin-bottom: 15px;">
                        </div>
                        <div class="col-lg-6">
                            <p>Установка Windows самая популярная услуга в сфере ремонта ПК. Ведь без операционной системы компьютер лишь набор микросхем.</p>

                            <p>Сервисный центр <strong>BK Base</strong> осуществляет установку и переустановку Windows с выездом мастера на дом.</p>

                            <p>Установка осуществляется под ключ, в результате Вы получите готовое к работе устройство.</p>
                        </div>
                    </div>

                    <h3 style="font-size: 20px; font-weight: 700; margin: 25px 0px;">Оставить заявку</h3>

                    <form action="/" method="post">
                        <div class="row">
                        <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nameInput">ФИО</label>
                                    <input type="name" required class="form-control" id="nameInput" name="clientName" placeholder="Введите Ваше ФИО">
                                </div>
                                <div class="form-group">
                                    <label for="emailInput">Email</label>
                                    <input type="email" required class="form-control" id="emailInput" name="clientEmail" placeholder="Введите Ваш адрес почты">
                                </div>
                                <div class="form-group">
                                    <label for="phoneInput">Телефон</label>
                                    <input type="name" required class="form-control" id="phoneInput" name="clientPhone" placeholder="Введите Ваш номер телефона">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="addresInput">Адрес</label>
                                    <input type="name" required class="form-control" id="addresInput" name="clientAddress" placeholder="Введите Ваш адрес">
                                </div>
                                <div class="form-group">
                                    <label for="commArea">Комментарий</label>
                                    <textarea class="form-control" id="commArea" rows="3" name="clientComment" placeholder="Добавьте комментарии, если есть"></textarea>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="servName" value="Установка операционной системы">
                        
                        <button type="submit" class="btn btn-primary" name="servSend">Заказать</button> <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Третья услуга -->
    <div class="modal fade bd-example-modal-xl" id="servThree" tabindex="-1" role="dialog" aria-labelledby="servThreeLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="servThreeLabel">Заказ услуги — <strong>Сборка компьютера на заказ</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <div class="row">
                        <div class="col-lg-6">
                            <img src="https://pozitive.org/images/stati/zhelezo/sborka/saratov.jpg" style="width:100%; margin-bottom: 15px;">
                        </div>
                        <div class="col-lg-6">
                            <p><strong>BK Base</strong> предлагает вам воспользоваться услугой индивидуальной сборки компьютера. Услуга по сборке компьютеров доступна для частных и юридических лиц.</p>

                            <p>Несмотря на все разнообразие представленного ассортимента готовых компьютеров, иногда возникают задачи требующие индивидуального подхода. В этом случае, отличным решением будет воспользоваться нашей новой услугой — сборка компьютера на заказ.</p>
                        </div>
                    </div>

                    <h3 style="font-size: 20px; font-weight: 700; margin: 25px 0px;">Оставить заявку</h3>

                    <form action="/" method="post">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nameInput">ФИО</label>
                                    <input type="name" required class="form-control" id="nameInput" name="clientName" placeholder="Введите Ваше ФИО">
                                </div>
                                <div class="form-group">
                                    <label for="emailInput">Email</label>
                                    <input type="email" required class="form-control" id="emailInput" name="clientEmail" placeholder="Введите Ваш адрес почты">
                                </div>
                                <div class="form-group">
                                    <label for="phoneInput">Телефон</label>
                                    <input type="name" required class="form-control" id="phoneInput" name="clientPhone" placeholder="Введите Ваш номер телефона">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="addresInput">Адрес</label>
                                    <input type="name" required class="form-control" id="addresInput" name="clientAddress" placeholder="Введите Ваш адрес">
                                </div>
                                <div class="form-group">
                                    <label for="commArea">Комментарий</label>
                                    <textarea class="form-control" id="commArea" rows="3" name="clientComment" placeholder="Добавьте комментарии, если есть"></textarea>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="servName" value="Сборка компьютера на заказ">
                        
                        <button type="submit" class="btn btn-primary" name="servSend">Заказать</button> <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Четвертая услуга -->
    <div class="modal fade bd-example-modal-xl" id="servFoure" tabindex="-1" role="dialog" aria-labelledby="servFoureLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="servFoureLabel">Заказ услуги — <strong>Установка ПО</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <div class="row">
                        <div class="col-lg-6">
                            <img src="https://fainaidea.com/wp-content/uploads/2016/08/programmnoe-obespechenie_3.jpg" style="width:100%; margin-bottom: 15px;">
                        </div>
                        <div class="col-lg-6">
                            <p>При покупке компьютера продавец установил и настроил Вам систем, но через какое-то время у Вас появится необходимость установить те или иные дополнительные программы или драйвера.</p>

                            <p>Многие думают, что установка программ простая задача, т.к. в интернете можно скачать программы на любой вкус. Но скачивая программы с непроверенных сайтов, Вы рискуете подцепить как минимум вредные дополнения на браузеры, постоянно показывающие рекламу во время серфинга в интернете. А в худшем случае, вместо необходимой программы вы скачаете вирус-вымогатель, либо вирус, который сильно нагружает вашу систему.</p>
                        </div>
                    </div>

                    <h3 style="font-size: 20px; font-weight: 700; margin: 25px 0px;">Оставить заявку</h3>

                    <form action="/" method="post">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nameInput">ФИО</label>
                                    <input type="name" required class="form-control" id="nameInput" name="clientName" placeholder="Введите Ваше ФИО">
                                </div>
                                <div class="form-group">
                                    <label for="emailInput">Email</label>
                                    <input type="email" required class="form-control" id="emailInput" name="clientEmail" placeholder="Введите Ваш адрес почты">
                                </div>
                                <div class="form-group">
                                    <label for="phoneInput">Телефон</label>
                                    <input type="name" required class="form-control" id="phoneInput" name="clientPhone" placeholder="Введите Ваш номер телефона">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="addresInput">Адрес</label>
                                    <input type="name" required class="form-control" id="addresInput" name="clientAddress" placeholder="Введите Ваш адрес">
                                </div>
                                <div class="form-group">
                                    <label for="commArea">Комментарий</label>
                                    <textarea class="form-control" id="commArea" rows="3" name="clientComment" placeholder="Добавьте комментарии, если есть"></textarea>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="servName" value="Установка ПО">
                        
                        <button type="submit" class="btn btn-primary" name="servSend">Заказать</button> <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Пятая услуга -->
    <div class="modal fade bd-example-modal-xl" id="servFive" tabindex="-1" role="dialog" aria-labelledby="servFiveLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="servFiveLabel">Заказ услуги — <strong>Восстановление данных</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <div class="row">
                        <div class="col-lg-6">
                            <img src="http://geek-nose.com/wp-content/uploads/2016/02/vosstanovlenie-dannyh-s-zhestkogo-diska-%E2%84%9615.jpg" style="width:100%; margin-bottom: 15px;">
                        </div>
                        <div class="col-lg-6">
                            <p>Для большинства пользователей наибольшую ценность на устройстве имеет информация.</p>

                            <p>Её потеря куда большая неприятность, чем выход из строя самого компьютера. Ведь технику можно заменить, или приобрести новую, а утраченную информацию не всегда.</p>

                            <p>Наша команда предлагает помочь решить Вам проблему подобного типа</p>
                        </div>
                    </div>

                    <h3 style="font-size: 20px; font-weight: 700; margin: 25px 0px;">Оставить заявку</h3>

                    <form action="/" method="post">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nameInput">ФИО</label>
                                    <input type="name" required class="form-control" id="nameInput" name="clientName" placeholder="Введите Ваше ФИО">
                                </div>
                                <div class="form-group">
                                    <label for="emailInput">Email</label>
                                    <input type="email" required class="form-control" id="emailInput" name="clientEmail" placeholder="Введите Ваш адрес почты">
                                </div>
                                <div class="form-group">
                                    <label for="phoneInput">Телефон</label>
                                    <input type="name" required class="form-control" id="phoneInput" name="clientPhone" placeholder="Введите Ваш номер телефона">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="addresInput">Адрес</label>
                                    <input type="name" required class="form-control" id="addresInput" name="clientAddress" placeholder="Введите Ваш адрес">
                                </div>
                                <div class="form-group">
                                    <label for="commArea">Комментарий</label>
                                    <textarea class="form-control" id="commArea" rows="3" name="clientComment" placeholder="Добавьте комментарии, если есть"></textarea>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="servName" value="Восстановление данных">
                        
                        <button type="submit" class="btn btn-primary" name="servSend">Заказать</button> <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Шестая услуга -->
    <div class="modal fade bd-example-modal-xl" id="servSix" tabindex="-1" role="dialog" aria-labelledby="servSixLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="servSixLabel">Заказ услуги — <strong>Удаление вирусов</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <div class="row">
                        <div class="col-lg-6">
                            <img src="https://my-master.net.ua/wp-content/uploads/2018/08/lechenie-sajta-ot-virusov-ua.png.pagespeed.ce.g_xQ_E2VMr.png" style="width:100%; margin-bottom: 15px;">
                        </div>
                        <div class="col-lg-6">
                            <p>Компьютерный вирус – самая распространенная проблема для вашего компьютера. Каждый день появляются сотни новых вирусов, цели которых завладеть вашими данными, либо завладеть вашими деньгами, также они могут вывести из строя всю операционную систему в целом. Как правило, вирусы могут попасть на ваш компьютер разными путями: через почту, через зараженный сайт, через флеш-накопитель и пр.</p>

                            <p>Мы предлагаем Вам услуги по удалению вирусов с компьютера или ноутбука с выездом мастера на дом. Качественно и быстро очистим вашу систему с сохранением важной или конфиденциальной информации.</p>
                        </div>
                    </div>

                    <h3 style="font-size: 20px; font-weight: 700; margin: 25px 0px;">Оставить заявку</h3>

                    <form action="/" method="post">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nameInput">ФИО</label>
                                    <input type="name" required class="form-control" id="nameInput" name="clientName" placeholder="Введите Ваше ФИО">
                                </div>
                                <div class="form-group">
                                    <label for="emailInput">Email</label>
                                    <input type="email" required class="form-control" id="emailInput" name="clientEmail" placeholder="Введите Ваш адрес почты">
                                </div>
                                <div class="form-group">
                                    <label for="phoneInput">Телефон</label>
                                    <input type="name" required class="form-control" id="phoneInput" name="clientPhone" placeholder="Введите Ваш номер телефона">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="addresInput">Адрес</label>
                                    <input type="name" required class="form-control" id="addresInput" name="clientAddress" placeholder="Введите Ваш адрес">
                                </div>
                                <div class="form-group">
                                    <label for="commArea">Комментарий</label>
                                    <textarea class="form-control" id="commArea" rows="3" name="clientComment" placeholder="Добавьте комментарии, если есть"></textarea>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="servName" value="Удаление вирусов">
                        
                        <button type="submit" class="btn btn-primary" name="servSend">Заказать</button> <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Седьмая услуга -->
    <div class="modal fade bd-example-modal-xl" id="servSeven" tabindex="-1" role="dialog" aria-labelledby="servSevenLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="servSevenLabel">Заказ услуги — <strong>Чистка от пыли. Замена термопасты</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <div class="row">
                        <div class="col-lg-6">
                            <img src="https://pozitive.org/images/stati/zhelezo/chistka/novosib.jpg" style="width:100%; margin-bottom: 15px;">
                        </div>
                        <div class="col-lg-6">
                            <p>В процессе эксплуатации компьютера в его корпусе накапливается пыль. Она забивает радиатор системы охлаждения и оседает на лопастях кулера, тем самым приводя к перегреву устройства</p>

                            <p>При появлении симптомов перегрева необходимо быстрее очистить компьютер от пыли и заменить термопасту, т.к. чем дольше устройство работает перегреваясь, тем вероятнее его выход из строя.</p>
                        </div>
                    </div>

                    <h3 style="font-size: 20px; font-weight: 700; margin: 25px 0px;">Оставить заявку</h3>

                    <form action="/" method="post">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nameInput">ФИО</label>
                                    <input type="name" required class="form-control" id="nameInput" name="clientName" placeholder="Введите Ваше ФИО">
                                </div>
                                <div class="form-group">
                                    <label for="emailInput">Email</label>
                                    <input type="email" required class="form-control" id="emailInput" name="clientEmail" placeholder="Введите Ваш адрес почты">
                                </div>
                                <div class="form-group">
                                    <label for="phoneInput">Телефон</label>
                                    <input type="name" required class="form-control" id="phoneInput" name="clientPhone" placeholder="Введите Ваш номер телефона">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="addresInput">Адрес</label>
                                    <input type="name" required class="form-control" id="addresInput" name="clientAddress" placeholder="Введите Ваш адрес">
                                </div>
                                <div class="form-group">
                                    <label for="commArea">Комментарий</label>
                                    <textarea class="form-control" id="commArea" rows="3" name="clientComment" placeholder="Добавьте комментарии, если есть"></textarea>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="servName" value="Чистка от пыли. Замена термопасты">
                        
                        <button type="submit" class="btn btn-primary" name="servSend">Заказать</button> <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Восьмая услуга -->
    <div class="modal fade bd-example-modal-xl" id="servEight" tabindex="-1" role="dialog" aria-labelledby="servEightLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="servEightLabel">Заказ услуги — <strong>Настройка интернета, Wi-Fi</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <div class="row">
                        <div class="col-lg-6">
                            <img src="https://akket.com/wp-content/uploads/2017/10/Android-Settings-Hide-Internet-33.jpg" style="width:100%; margin-bottom: 15px;">
                        </div>
                        <div class="col-lg-6">
                            <p>Каждый день интернет всё прочнее входит в нашу жизнь, а беспроводными сетями уже мало кого удивишь, ведь это стало обыденным в повседневной жизни. Дома, на работе, в кафе - везде есть точки беспроводного доступа Wi-Fi. Сложно себе даже представить, как раньше обходились без социальных сетей и онлайн сервисов.</p>

                            <p>Поэтому мы понимаем, насколько важен хороший, стабильно работающий интернет у вас дома, либо в офисе. Если у вас нет времени разбираться с IP-адресами, TCP/IP-протоколами, шлюзами, DHCP серверами и прочим — услуга настройки интернета и Wi-Fi определенно для Вас.</p>

                            <p>Наша компания поможет в решении любых проблем с интернетом и поможет в настройке вашего модема от любого провайдера, а опытные специалисты помогут в подключении любого из Ваших устройств: будь то телефон, планшет, ноутбук или телевизор.</p>
                        </div>
                    </div>

                    <h3 style="font-size: 20px; font-weight: 700; margin: 25px 0px;">Оставить заявку</h3>

                    <form action="/" method="post">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nameInput">ФИО</label>
                                    <input type="name" required class="form-control" id="nameInput" name="clientName" placeholder="Введите Ваше ФИО">
                                </div>
                                <div class="form-group">
                                    <label for="emailInput">Email</label>
                                    <input type="email" required class="form-control" id="emailInput" name="clientEmail" placeholder="Введите Ваш адрес почты">
                                </div>
                                <div class="form-group">
                                    <label for="phoneInput">Телефон</label>
                                    <input type="name" required class="form-control" id="phoneInput" name="clientPhone" placeholder="Введите Ваш номер телефона">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="addresInput">Адрес</label>
                                    <input type="name" required class="form-control" id="addresInput" name="clientAddress" placeholder="Введите Ваш адрес">
                                </div>
                                <div class="form-group">
                                    <label for="commArea">Комментарий</label>
                                    <textarea class="form-control" id="commArea" rows="3" name="clientComment" placeholder="Добавьте комментарии, если есть"></textarea>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="servName" value="Настройка интернета, Wi-Fi">
                        
                        <button type="submit" class="btn btn-primary" name="servSend">Заказать</button> <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Девятая услуга -->
    <div class="modal fade bd-example-modal-xl" id="servNine" tabindex="-1" role="dialog" aria-labelledby="servNineLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="servNineLabel">Заказ услуги — <strong>Ремонт и замена комплектующих</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <div class="row">
                        <div class="col-lg-6">
                            <img src="http://files.nicwebsite.ru/a6/1a/a61a4823-3fec-4e4a-b0cc-213e76ec3fd7.jpg" style="width:100%; margin-bottom: 15px;">
                        </div>
                        <div class="col-lg-6">
                            <p>У нас можно осуществить качественный ремонт и замену комплектующих по самым доступным ценам. Перед началом работ проведем комплексную диагностику устройства и выявим все неисправности, которые мешают нормальной работе устройства.</p>

                            <p>Эту ответственную работу необходимо доверить профессионалам. Мы готовы выполнить ПК и ноутбуков любой сложности. Все наши мастера обладают большим опытом работы и высокой квалификацией.</p>

                            <p>Для нас нет невыполнимых задач.</p>
                        </div>
                    </div>

                    <h3 style="font-size: 20px; font-weight: 700; margin: 25px 0px;">Оставить заявку</h3>

                    <form action="/" method="post">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nameInput">ФИО</label>
                                    <input type="name" required class="form-control" id="nameInput" name="clientName" placeholder="Введите Ваше ФИО">
                                </div>
                                <div class="form-group">
                                    <label for="emailInput">Email</label>
                                    <input type="email" required class="form-control" id="emailInput" name="clientEmail" placeholder="Введите Ваш адрес почты">
                                </div>
                                <div class="form-group">
                                    <label for="phoneInput">Телефон</label>
                                    <input type="name" required class="form-control" id="phoneInput" name="clientPhone" placeholder="Введите Ваш номер телефона">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="addresInput">Адрес</label>
                                    <input type="name" required class="form-control" id="addresInput" name="clientAddress" placeholder="Введите Ваш адрес">
                                </div>
                                <div class="form-group">
                                    <label for="commArea">Комментарий</label>
                                    <textarea class="form-control" id="commArea" rows="3" name="clientComment" placeholder="Добавьте комментарии, если есть"></textarea>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="servName" value="Ремонт и замена комплектующих">
                        
                        <button type="submit" class="btn btn-primary" name="servSend">Заказать</button> <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="./assets/js/main.js"></script>

    <script>
        window.replainSettings = { id: 'f7073b10-1c9c-4a6b-9cf5-2d3a90646cee' };
        (function(u){var s=document.createElement('script');s.type='text/javascript';s.async=true;s.src=u;
        var x=document.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);
        })('https://widget.replain.cc/dist/client.js');
    </script>
    
</body>
</html>