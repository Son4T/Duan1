document.addEventListener('keydown', function(event) {
    if (event.code === 'Space') {
        jump();
    }
});

function jump() {
    let dino = document.getElementById('dino');
    if (!dino.classList.contains('jump')) {
        dino.classList.add('jump');
        setTimeout(function() {
            dino.classList.remove('jump');
        }, 300); // Thời gian nhảy lên và hạ xuống là 300ms
    }
}

let isAlive = setInterval(function() {
    let dino = document.getElementById('dino');
    let cactus = document.getElementById('cactus');

    let dinoTop = parseInt(window.getComputedStyle(dino).getPropertyValue('top'));
    let cactusLeft = parseInt(window.getComputedStyle(cactus).getPropertyValue('left'));

    if (cactusLeft < 50 && cactusLeft > 0 && dinoTop >= 140) {
        alert('Game Over!');
    }
}, 10);
