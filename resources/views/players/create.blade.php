<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Добавить нового игрока - NBA Legends</title>
    @vite(['resources/js/app.js', 'resources/sass/app.scss'])
    <style>
        .required::after {
            content: " *";
            color: red;
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
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Добавить нового игрока</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('players.store') }}" method="POST">
                            @csrf
                            
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            
                            <!-- Основная информация -->
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label required">Имя игрока</label>
                                        <input type="text" 
                                               class="form-control" 
                                               id="name" 
                                               name="name" 
                                               required
                                               value="{{ old('name') }}"
                                               placeholder="Майкл Джордан">
                                        @error('name')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="fullname" class="form-label">Полное имя</label>
                                        <input type="text" 
                                               class="form-control" 
                                               id="fullname" 
                                               name="fullname"
                                               value="{{ old('fullname') }}"
                                               placeholder="Майкл Джеффри Джордан">
                                    </div>
                                </div>
                            </div>

                            <!-- Позиция, команда и номер -->
                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="position" class="form-label">Позиция</label>
                                        <select class="form-select" id="position" name="position">
                                            <option value="">-- Выберите позицию --</option>
                                            @foreach($positions as $position)
                                                <option value="{{ $position }}" 
                                                    {{ old('position') == $position ? 'selected' : '' }}>
                                                    {{ $position }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="team" class="form-label">Команда</label>
                                        <select class="form-select" id="team" name="team">
                                            <option value="">-- Выберите команду --</option>
                                            @foreach($teams as $team)
                                                <option value="{{ $team }}" 
                                                    {{ old('team') == $team ? 'selected' : '' }}>
                                                    {{ $team }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="number" class="form-label">Номер</label>
                                        <input type="number" 
                                               class="form-control" 
                                               id="number" 
                                               name="number"
                                               value="{{ old('number') }}"
                                               min="0" 
                                               max="99"
                                               placeholder="23">
                                    </div>
                                </div>
                            </div>

                            <!-- Физические данные -->
                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="height" class="form-label">Рост</label>
                                        <input type="text" 
                                               class="form-control" 
                                               id="height" 
                                               name="height"
                                               value="{{ old('height') }}"
                                               placeholder="198 см">
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="weight" class="form-label">Вес</label>
                                        <input type="text" 
                                               class="form-control" 
                                               id="weight" 
                                               name="weight"
                                               value="{{ old('weight') }}"
                                               placeholder="98 кг">
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="age" class="form-label">Возраст</label>
                                        <input type="number" 
                                               class="form-control" 
                                               id="age" 
                                               name="age"
                                               value="{{ old('age') }}"
                                               min="16" 
                                               max="60"
                                               placeholder="35">
                                    </div>
                                </div>
                            </div>

                            <!-- Статистика -->
                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="ppg" class="form-label">Очки за игру (PPG)</label>
                                        <input type="number" 
                                               class="form-control" 
                                               id="ppg" 
                                               name="ppg"
                                               value="{{ old('ppg') }}"
                                               step="0.1"
                                               min="0"
                                               max="50"
                                               placeholder="30.1">
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="rpg" class="form-label">Подборы за игру (RPG)</label>
                                        <input type="number" 
                                               class="form-control" 
                                               id="rpg" 
                                               name="rpg"
                                               value="{{ old('rpg') }}"
                                               step="0.1"
                                               min="0"
                                               max="30"
                                               placeholder="6.2">
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="apg" class="form-label">Передачи за игру (APG)</label>
                                        <input type="number" 
                                               class="form-control" 
                                               id="apg" 
                                               name="apg"
                                               value="{{ old('apg') }}"
                                               step="0.1"
                                               min="0"
                                               max="20"
                                               placeholder="5.3">
                                    </div>
                                </div>
                            </div>

                            <!-- Фото и биография -->
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="img_url" class="form-label">Ссылка на фото</label>
                                        <input type="url" 
                                               class="form-control" 
                                               id="img_url" 
                                               name="img_url"
                                               value="{{ old('img_url') }}"
                                               placeholder="https://example.com/photo.jpg">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label for="bio" class="form-label">Биография</label>
                                <textarea class="form-control" 
                                          id="bio" 
                                          name="bio" 
                                          rows="4"
                                          placeholder="Опишите достижения и карьеру игрока...">{{ old('bio') }}</textarea>
                            </div>

                            <!-- Кнопки формы -->
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('players.index') }}" class="btn btn-secondary">
                                    ← Отмена
                                </a>
                                <button type="submit" class="btn btn-success">
                                    Создать игрока
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>