import * as bootstrap from 'bootstrap';
import '../sass/app.scss';

import '@fortawesome/fontawesome-free/js/fontawesome';
import '@fortawesome/fontawesome-free/js/solid';
import '@fortawesome/fontawesome-free/js/regular';
import '@fortawesome/fontawesome-free/js/brands';

console.log('Webpack и Bootstrap успешно настроены!');

document.addEventListener('DOMContentLoaded', function() {
  const playerModal = new bootstrap.Modal(document.getElementById('playerModal'));
  
  const uploadToastElement = document.getElementById('uploadToast');
  const uploadToast = new bootstrap.Toast(uploadToastElement, {
    autohide: true,
    delay: 4000
  });
  
  let playerCards = [];
  let currentPlayerIndex = 0;
  
 
  const uploadBtn = document.querySelector('.upload-btn');
  uploadBtn.addEventListener('click', function() {
    uploadToast.show();
  });
  
  const careerStatsBtn = document.getElementById('careerStatsBtn');
  const popover = new bootstrap.Popover(careerStatsBtn, {
    trigger: 'focus',
    html: true,
    content: generateCareerStatsContent()
  });
  
  playerCards = Array.from(document.querySelectorAll('.player-detail-btn'));
  
  playerCards.forEach((button, index) => {
    button.addEventListener('click', function() {
      currentPlayerIndex = index;
      showPlayerData(currentPlayerIndex);
      playerModal.show();
    });
  });
  
  // Обработчик клавиатуры для навигации
  document.addEventListener('keydown', function(event) {
    if (document.getElementById('playerModal').classList.contains('show')) {
      switch(event.key) {
        case 'ArrowLeft':
          event.preventDefault();
          navigateToPlayer(-1);
          break;
        case 'ArrowRight':
          event.preventDefault();
          navigateToPlayer(1); 
          break;
      }
    }
  });
  
  // Функция навигации по игрокам
  function navigateToPlayer(direction) {
    currentPlayerIndex += direction;
    
    // Зацикливание навигации
    if (currentPlayerIndex < 0) {
      currentPlayerIndex = playerCards.length - 1;
    } else if (currentPlayerIndex >= playerCards.length) {
      currentPlayerIndex = 0;
    }
    
    showPlayerData(currentPlayerIndex);
  }
  
  // Функция показа данных игрока
  function showPlayerData(index) {
    const button = playerCards[index];
    const playerData = {
      name: button.getAttribute('data-player-name'),
      position: button.getAttribute('data-player-position'),
      team: button.getAttribute('data-player-team'),
      number: button.getAttribute('data-player-number'),
      img: button.getAttribute('data-player-img'),
      fullname: button.getAttribute('data-player-fullname'),
      height: button.getAttribute('data-player-height'),
      weight: button.getAttribute('data-player-weight'),
      age: button.getAttribute('data-player-age'),
      ppg: button.getAttribute('data-player-ppg'),
      rpg: button.getAttribute('data-player-rpg'),
      apg: button.getAttribute('data-player-apg'),
      bio: button.getAttribute('data-player-bio')
    };
    
    fillModalWithPlayerData(playerData);
    updatePopoverContent(playerData);
  }
  
  // Функция для заполнения модального окна данными
  function fillModalWithPlayerData(data) {
    document.querySelector('.modal-player-name').textContent = data.name;
    document.querySelector('.modal-player-position').textContent = data.position;
    document.querySelector('.modal-player-team').textContent = data.team;
    document.querySelector('.modal-player-number').textContent = `№${data.number}`;
    document.querySelector('.modal-player-img').src = data.img;
    document.querySelector('.modal-player-fullname').textContent = data.fullname;
    document.querySelector('.modal-player-height').textContent = data.height;
    document.querySelector('.modal-player-weight').textContent = data.weight;
    document.querySelector('.modal-player-age').textContent = data.age;
    document.querySelector('.modal-player-ppg').textContent = data.ppg;
    document.querySelector('.modal-player-rpg').textContent = data.rpg;
    document.querySelector('.modal-player-apg').textContent = data.apg;
    document.querySelector('.modal-player-bio').textContent = data.bio;
    
    document.getElementById('playerModalLabel').textContent = `Профиль: ${data.name}`;
  }
  
  // Функция для генерации контента popover
  function generateCareerStatsContent(playerData = null) {
    if (!playerData) {
      return 'Выберите игрока для просмотра статистики';
    }
    
    const careerStats = generateRandomCareerStats(playerData.name);
    
    return `
      <div class="career-stats-popover">
        <div class="stats-item">
          <span class="stat-label">Сыграно матчей:</span>
          <span class="stat-value">${careerStats.gamesPlayed}</span>
        </div>
        <div class="stats-item">
          <span class="stat-label">Очки за карьеру:</span>
          <span class="stat-value">${careerStats.totalPoints}</span>
        </div>
        <div class="stats-item">
          <span class="stat-label">Подборы за карьеру:</span>
          <span class="stat-value">${careerStats.totalRebounds}</span>
        </div>
        <div class="stats-item">
          <span class="stat-label">Передачи за карьеру:</span>
          <span class="stat-value">${careerStats.totalAssists}</span>
        </div>
        <div class="stats-item">
          <span class="stat-label">Титулы чемпиона:</span>
          <span class="stat-value">${careerStats.championships}</span>
        </div>
        <div class="stats-item">
          <span class="stat-label">Участник Матча звёзд:</span>
          <span class="stat-value">${careerStats.allStarAppearances}</span>
        </div>
      </div>
    `;
  }
  
  // Функция для обновления контента popover
  function updatePopoverContent(playerData) {
    const newContent = generateCareerStatsContent(playerData);
    popover.setContent({
      '.popover-body': newContent
    });
  }
  

  function generateRandomCareerStats(playerName) {
    const baseStats = {
      'Майкл Джордан': { games: 1072, points: 32292, rebounds: 6672, assists: 5633, chips: 6, allStar: 14 },
      'Леброн Джеймс': { games: 1476, points: 38652, rebounds: 10667, assists: 10420, chips: 4, allStar: 20 },
      'Коби Брайант': { games: 1346, points: 33643, rebounds: 7047, assists: 6306, chips: 5, allStar: 18 },
      'Стефен Карри': { games: 882, points: 21712, rebounds: 4218, assists: 5748, chips: 4, allStar: 10 },
      'Никола Йокич': { games: 638, points: 12054, rebounds: 6254, assists: 3889, chips: 1, allStar: 6 }
    };
    // Функция для генерации случайной статистики карьеры
    const stats = baseStats[playerName] || {
      games: Math.floor(Math.random() * 500) + 800,
      points: Math.floor(Math.random() * 10000) + 15000,
      rebounds: Math.floor(Math.random() * 3000) + 4000,
      assists: Math.floor(Math.random() * 3000) + 4000,
      chips: Math.floor(Math.random() * 3),
      allStar: Math.floor(Math.random() * 5) + 1
    };
    
    return {
      gamesPlayed: stats.games.toLocaleString(),
      totalPoints: stats.points.toLocaleString(),
      totalRebounds: stats.rebounds.toLocaleString(),
      totalAssists: stats.assists.toLocaleString(),
      championships: stats.chips,
      allStarAppearances: stats.allStar
    };
    
  }
  
});