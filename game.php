<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="stylegame.css" />
</head>

<body>
    <video id="video-background" autoplay muted loop>
        <source src="background 4.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <div id="game-content">
        <h1 style="text-align: center;">Snake Game - Dapatkan 3 Skor untuk Lanjut ke Data Mahasiswa</h1>
        <div id="game-board"></div>
        <div id="score">Skor: 0</div>
    </div>


    <script>
        // Variabel permainan
        const gameBoard = document.getElementById('game-board');
        const scoreDisplay = document.getElementById('score');
        const snake = [{
            x: 200,
            y: 200
        }];
        const blockSize = 20; // Ukuran setiap blok (ular atau makanan)
        const boardSize = 400; // Ukuran papan permainan
        let dx = 0;
        let dy = 0;
        let foodX, foodY;
        let score = 0;
        let foodElement = null; // Variabel global untuk menyimpan elemen makanan

        // Membuat makanan
        function generateFood() {
            foodX = Math.floor(Math.random() * (boardSize / blockSize)) * blockSize;
            foodY = Math.floor(Math.random() * (boardSize / blockSize)) * blockSize;
            if (foodElement) {
                gameBoard.removeChild(foodElement); // Hapus makanan yang sudah ada
            }
            foodElement = document.createElement('div'); // Buat elemen makanan baru
            foodElement.classList.add('food');
            foodElement.style.left = foodX + 'px';
            foodElement.style.top = foodY + 'px';
            gameBoard.appendChild(foodElement); // Tambahkan elemen makanan ke gameBoard
        }

        // Memperbarui posisi ular
        function updateSnake() {
            const newHead = {
                x: snake[0].x + dx,
                y: snake[0].y + dy
            };
            // Periksa jika ular menabrak dinding
            if (newHead.x < 0 || newHead.x >= boardSize || newHead.y < 0 || newHead.y >= boardSize) {
                endGame();
                return;
            }
            snake.unshift(newHead);
            const eatenFood = snake[0].x === foodX && snake[0].y === foodY;
            if (!eatenFood) {
                snake.pop();
            } else {
                score++;
                scoreDisplay.innerText = 'Skor: ' + score;
                if (score === 3) {
                    window.location.href = 'index.php'; // Redirect jika skor mencapai 3
                }
                generateFood();
            }
        }

        // Menggambar ular
        function drawSnake() {
            gameBoard.innerHTML = ''; // Hapus semua elemen ular
            snake.forEach(segment => {
                const snakeElement = document.createElement('div');
                snakeElement.classList.add('snake');
                snakeElement.style.left = segment.x + 'px';
                snakeElement.style.top = segment.y + 'px';
                gameBoard.appendChild(snakeElement);
            });
            if (foodElement) {
                gameBoard.appendChild(foodElement); // Tambahkan kembali elemen makanan ke gameBoard
            }
        }

        // Perulangan permainan
        function gameLoop() {
            updateSnake();
            drawSnake();
            setTimeout(gameLoop, 200);
        }

        // Menangani peristiwa penekanan tombol
        document.addEventListener('keydown', e => {
            if (e.key === 'ArrowUp' && dy === 0) {
                dx = 0;
                dy = -blockSize;
            }
            if (e.key === 'ArrowDown' && dy === 0) {
                dx = 0;
                dy = blockSize;
            }
            if (e.key === 'ArrowLeft' && dx === 0) {
                dx = -blockSize;
                dy = 0;
            }
            if (e.key === 'ArrowRight' && dx === 0) {
                dx = blockSize;
                dy = 0;
            }
        });

        // Mengakhiri permainan
        function endGame() {
            alert('Permainan Berakhir! Coba lagi.');
            window.location.reload(); // Memuat ulang permainan
        }

        // Memulai permainan
        generateFood();
        gameLoop();
    </script>
</body>

</html>