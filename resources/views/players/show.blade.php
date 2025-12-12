<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $player->name }} - NBA Legends</title>
    @vite(['resources/js/app.js', 'resources/sass/app.scss'])
    <style>
        .navigation-buttons {
            position: sticky;
            bottom: 20px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 50px;
            padding: 10px 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            border: 1px solid rgba(0, 0, 0, 0.1);
        }
        .player-counter {
            background: #0dcaf0;
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 500;
            min-width: 140px;
            text-align: center;
        }
        @media (max-width: 768px) {
            .navigation-buttons {
                flex-wrap: wrap;
                padding: 8px 15px;
            }
            .player-counter {
                order: -1;
                width: 100%;
                margin-bottom: 10px;
                border-radius: 10px;
            }
        }
    </style>
</head>
<body>
    
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="/players">
                <img src="https://logos-world.net/wp-content/uploads/2020/11/NBA-Logo.png" height="40">
            </a>
            <a href="{{ route('players.index') }}" class="btn btn-outline-primary">
                ← Назад к списку
            </a>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="card border-0 shadow-lg">
            <div class="card-body p-5">
                <div class="row">
                    <div class="col-md-5">
                        <img src="{{ $player->img_url ?? 'https://via.placeholder.com/400x500?text=No+Image' }}" 
                             class="img-fluid rounded mb-4" 
                             alt="{{ $player->name }}">
                        
                        <div class="mb-3">
                            @if($player->position)
                                <span class="badge bg-primary me-2 mb-2 p-2 fs-6">
                                    {{ $player->position }}
                                </span>
                            @endif
                            
                            @if($player->team)
                                <span class="badge bg-success me-2 mb-2 p-2 fs-6">
                                    {{ $player->team }}
                                </span>
                            @endif
                            
                            @if($player->number)
                                <span class="badge bg-info p-2 fs-6">
                                    №{{ $player->number }}
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="col-md-7">
                        <h1 class="display-5">{{ $player->name }}</h1>
                        
                        @if($player->fullname)
                            <p class="text-muted fs-5">{{ $player->fullname }}</p>
                        @endif
                        
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <p><strong>Рост:</strong> {{ $player->height ?? 'Не указан' }}</p>
                                <p><strong>Вес:</strong> {{ $player->weight ?? 'Не указан' }}</p>
                                <p><strong>Возраст:</strong> {{ $player->age ?? '?' }} лет</p>
                            </div>
                            
                            <div class="col-md-6">
                                <p><strong>Очки за игру:</strong> {{ $player->ppg ?? '0.0' }}</p>
                                <p><strong>Подборы за игру:</strong> {{ $player->rpg ?? '0.0' }}</p>
                                <p><strong>Передачи за игру:</strong> {{ $player->apg ?? '0.0' }}</p>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <h5>Биография:</h5>
                            <p>
                                @if($player->bio)
                                    {{ $player->bio }}
                                @else
                                    <span class="text-muted">Биография игрока пока не добавлена.</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Кнопки навигации внизу -->
    <div class="container mt-5 mb-5">
        <div class="d-flex justify-content-center">
            <div class="navigation-buttons d-flex gap-3 align-items-center">
                @php
                    $prevPlayer = \App\Models\Player::where('id', '<', $player->id)
                        ->orderBy('id', 'desc')
                        ->first() 
                        ?? \App\Models\Player::orderBy('id', 'desc')->first();
                    
                    $nextPlayer = \App\Models\Player::where('id', '>', $player->id)
                        ->orderBy('id', 'asc')
                        ->first() 
                        ?? \App\Models\Player::orderBy('id', 'asc')->first();
                @endphp
                
                <a href="{{ route('players.show', $prevPlayer->id) }}" 
                   class="btn btn-outline-primary d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left me-1" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                    </svg>
                    <span class="d-none d-md-inline">Предыдущий</span>
                </a>
                
                <div class="player-counter">
                    Игрок {{ $player->id }} из {{ $totalPlayers }}
                </div>
                
                <a href="{{ route('players.show', $nextPlayer->id) }}" 
                   class="btn btn-outline-primary d-flex align-items-center">
                    <span class="d-none d-md-inline">Следующий</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right ms-1" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </a>
            </div>
        </div>
        
        <!-- Информация о клавишах -->
        <div class="text-center mt-3 text-muted small">
            Используйте ← → для навигации
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Навигация клавишами
        document.addEventListener('keydown', function(event) {
            @php
                echo "const prevUrl = '" . route('players.show', $prevPlayer->id) . "';";
                echo "const nextUrl = '" . route('players.show', $nextPlayer->id) . "';";
            @endphp
            
            if (event.key === 'ArrowLeft') {
                window.location.href = prevUrl;
            }
            
            if (event.key === 'ArrowRight') {
                window.location.href = nextUrl;
            }
            
            if (event.key === 'Escape') {
                window.location.href = "{{ route('players.index') }}";
            }
        });
        
        // Анимация при клике на кнопки
        const navButtons = document.querySelectorAll('.navigation-buttons a');
        navButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    window.location.href = this.href;
                }, 150);
            });
        });
    });
    </script>

</body>
</html>