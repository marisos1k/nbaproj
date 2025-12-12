<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite(['resources/js/app.js', 'resources/sass/app.scss'])
    </head>

    

        <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src = "https://logos-world.net/wp-content/uploads/2020/11/NBA-Logo.png   " class ="main-img"> </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Легенды NBA</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">Зал славы</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">Текущий топ</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href = "#">Расписание</a>
                </li>
            </ul>
            <button class="upload-btn ms-auto">Загрузить</button>
            </div>
        </div>
        </nav>
    <body>
<!-- @foreach($players as $player)
    <div class="player">
        <h2>{{ $player->name }}</h2>
        <p>Команда: {{ $player->team }}</p>
        <p>Позиция: {{ $player->position }}</p>
    </div>
@endforeach -->

        <div class="container mt-4">
            <div class="row">
                @foreach ($players as $player )
                    <div class="col-md-4 col-xl-3 mb-4">
                    <div class="card">
                        <div class = "card-type">{{ $player ->team }}</div>
                        <img src="https://s-cdn.sportbox.ru/images/styles/1200-auto/fp_fotos/80/ac/0020ec9acff501fec7777f05f2d89c7e5d8bb3b56b81c369398695.jpg" class="card-img-top img-fluid" alt="Игрок 1">
                        <div class="card-body">
                            <h5 class="card-title">{{ $player ->name }}</h5>
                            <p class="card-text">{{$player ->position}}</p>
                            <div class="mt-auto text-center">
                                <a href="#" class="btn btn-primary w-100 player-detail-btn"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#playerModal"
                                    data-player-name="{{ $player->name }}"
                                    data-player-position="{{ $player->position }}"
                                    data-player-team="{{ $player->team }}"
                                    data-player-number="{{ $player->number }}"
                                    data-player-img="{{ $player->img_url }}"
                                    data-player-fullname="{{ $player->fullname ?? 'Не указано' }}"
                                    data-player-height="{{ $player->height }}"
                                    data-player-weight="{{ $player->weight }}"
                                    data-player-age="{{ $player->age }} лет"
                                    data-player-ppg="{{ $player->ppg ?? 'Нет данных' }}"
                                    data-player-rpg="{{ $player->rpg ?? 'Нет данных' }}"
                                    data-player-apg="{{ $player->apg ?? 'Нет данных' }}"
                                    data-player-bio="{{ $player->bio ?? 'Биография не указана' }}">
                                    Подробнее
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <footer class="bg-body-tertiary mt-5 py-3">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <p class="mb-0">© 2024 NBA Legends. Сайт создал Дукман Арсений</p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <a href="#">
                            <i class="fa-brands fa-linkedin"></i>
                        </a>
                    </div>
                </div>
            </div>
        </footer>

        <div class="modal fade" id="playerModal" tabindex="-1" aria-labelledby="playerModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="playerModalLabel">Детальная информация об игроке</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="row">

                    <div class="col-md-5">
                        <img src="" class="img-fluid rounded mb-3 modal-player-img" alt="Игрок">
                        <div class="player-badges">
                        <span class="badge bg-primary modal-player-position">Защитник</span>
                        <span class="badge bg-success modal-player-team">LAL</span>
                        <span class="badge bg-info modal-player-number">№23</span>
                        </div>
                    </div>
                    
                    <div class="col-md-7">
                        <h3 class="modal-player-name">Имя игрока</h3>
                        <p class="text-muted modal-player-fullname">Полное имя</p>
                        
                        <div class="player-stats mt-4">
                        <h5>Статистика:</h5>
                        <div class="row">
                            <div class="col-6">
                            <p><strong>Рост:</strong> <span class="modal-player-height">198 см</span></p>
                            <p><strong>Вес:</strong> <span class="modal-player-weight">98 кг</span></p>
                            <p><strong>Возраст:</strong> <span class="modal-player-age">35 лет</span></p>
                            </div>
                            <div class="col-6">
                            <p><strong>Очки за игру:</strong> <span class="modal-player-ppg">30.1</span></p>
                            <p><strong>Подборы за игру:</strong> <span class="modal-player-rpg">6.2</span></p>
                            <p><strong>Передачи за игру:</strong> <span class="modal-player-apg">5.3</span></p>
                            </div>
                            <button type="button" class="btn btn-outline-info" id="careerStatsBtn" 
                            data-bs-toggle="popover" 
                            data-bs-placement="right"
                            data-bs-title="Статистика карьеры"
                            data-bs-content="Загрузка...">
                        Статистика карьеры
                    </button>
                        </div>
                        </div>
                        
                        <div class="player-bio mt-3">
                        <h5>Биография:</h5>
                        <p class="modal-player-bio">Здесь будет подробная информация об игроке.</p>
                        </div>
                    </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Закрыть</button>
                </div>
                </div>
            </div>
            </div>

            <div class="toast-container position-fixed top-0 end-0 p-3">
                <div id="uploadToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                        <strong class="me-auto">NBA Stats</strong>
                        <small>Только что</small>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        Функционал загрузки временно недоступен.
                        <i class="fa-solid fa-spinner fa-spin ms-2"></i>
                    </div>
                </div>
            </div>

    </body>
</html>