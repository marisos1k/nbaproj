<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>NBA Legends</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/js/app.js', 'resources/sass/app.scss'])
    <style>
        .card-actions {
            position: absolute;
            top: 10px;
            right: 10px;
            display: flex;
            gap: 5px;
            opacity: 0;
            transition: opacity 0.3s;
        }
        
        .card:hover .card-actions {
            opacity: 1;
        }
        
        .card-action-btn {
            width: 30px;
            height: 30px;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }
        
        .card {
            position: relative;
        }
    </style>
</head>
<body>
    
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="https://logos-world.net/wp-content/uploads/2020/11/NBA-Logo.png" class="main-img"></a>
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
                        <a class="nav-link" href="{{ route('players.create') }}">Добавить</a>
                    </li>
                </ul>
                <button class="upload-btn ms-auto">Загрузить</button>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            @foreach ($players as $player)
                <div class="col-md-4 col-xl-3 mb-4">
                    <div class="card">
                        <div class="card-actions">
                            <a href="{{ route('players.edit', $player->id) }}" 
                               class="btn btn-warning btn-sm card-action-btn"
                               title="Редактировать">
                                ✏️
                            </a>
                            
                            <form action="{{ route('players.destroy', $player->id) }}" 
                                  method="POST" 
                                  onsubmit="return confirm('Удалить игрока {{ $player->name }}?')"
                                  style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="btn btn-danger btn-sm card-action-btn"
                                        title="Удалить">
                                    🗑️
                                </button>
                            </form>
                        </div>
                        
                        <div class="card-type">{{ $player->team }}</div>
                        <img src="{{ $player ->img_url }}" 
                             class="card-img-top img-fluid" 
                             alt="{{ $player->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $player->name }}</h5>
                            <p class="card-text">{{ $player->bio }}</p>
                            <div class="mt-auto text-center">
                                <a href="{{ route('players.show', $player->id)}}" 
                                   class="btn btn-primary w-100 player-detail-btn">
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

</body>
</html>