<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Танысу</title>
    <link rel="stylesheet" href="section1-1.css">
</head>
<body>
    <header class="header">
        <h1>Танысу. Сан есімдер.</h1>
    </header>
    <main class="content">
        <ul>
            <p>Сан есім – заттың санын, саналу ретін, мөлшерін білдіретін сөз табының бірі. Сұрақтары: қанша? неше? нешеу? нешінші? Жамбыл жүз жас жасаған. (Неше жас? Жүз жас). Төртеу түгел болса, төбедегі келеді, алтау ала болса, ауыздағы кетеді. (Нешеу? – төртеу, алтау).</p>
            <p>Сан есім құрамына қарай екіге бөлінеді: 1) жай сан есім; 2) күрделі сан есім.</p>
            <li>Жай сан есім – бір түбірден құралған негізгі және туынды сан есімдер. Мысалы, үш, оныншы, елудей, ондаған, жүз, алтау, мыңдаған, оннан, миллионыншы, алпыстап, жүздеп, т.б.</li>
            <li>Күрделі сан есім:<ul>а) екі немесе одан да көп түбірдің тіркесуінен: жиырма бес, қырық шақты, сексен алты, тоғыз бүтін алтыдан үш, үш ширек, жүз мыңдай, т.б.</ul>

            <ul>ә) сөздердің қосарлануы мен қайталануынан: екі-екіден, жеті-сегіз, бес-алты, тоғыз-тоғыздан, жиырма-отыздай, бір-бірден жасалады.</ul>

            <ul>б) сөздердің дыбыстық өзгеріске ұшырап кірігуінен жасалған күрделі сан есімдер: сексен – сегіз он, тоқсан – тоғыз он.</ul></li>
          
            <p>Жай сан есім мысалы:</p>
            <ul>а)Менде он кітап бар</ul>
            <ul>а)Ол 18 жаста.</ul>
            <p>Күрделі сан есім мысалы:</p>
            <ul>а)Кеңседе жиырма екі маман жұмыс істейді.</ul>
            <ul>а)Топта отыз екі студент оқиды.</ul>

        </ul>
    <header class="header">
        <h1>Тапсырмалар.</h1> </header>
        <div class="task">
        <p>1-тапсырма: ______ екі қалам бар.</p>
        <div class="options" id="task1">
            <button data-answer="correct">а) Менде</button>
            <button data-answer="wrong">ә) Мен</button>
            <button data-answer="wrong">б) Менің</button>
            <button data-answer="wrong">в) Менікі</button>
        </div>
        <div class="feedback" id="feedback1"></div>
    </div>

    <div class="task">
        <p>2-тапсырма: ______ төрт үйі бар.</p>
        <div class="options" id="task2">
            <button data-answer="wrong">а) Ол</button>
            <button data-answer="correct">ә) Оның</button>
            <button data-answer="wrong">б) Менің</button>
            <button data-answer="wrong">в) Менікі</button>
        </div>
        <div class="feedback" id="feedback2"></div>
    </div>

    <script>
        // Обработка кликов на кнопках
        document.querySelectorAll('.task').forEach(task => {
            const options = task.querySelector('.options');
            const feedback = task.querySelector('.feedback');

            options.addEventListener('click', event => {
                if (event.target.tagName === 'BUTTON') {
                    const answer = event.target.getAttribute('data-answer');

                    if (answer === 'correct') {
                        feedback.textContent = 'Дұрыс!';
                        feedback.classList.remove('wrong');
                    } else {
                        feedback.textContent = 'Қате, тағы бір рет көріңіз.';
                        feedback.classList.add('wrong');
                    }

                    // Отключение кнопок после ответа
                    options.querySelectorAll('button').forEach(btn => btn.disabled = true);
                }
            });
        });
    </script>
    <h1>Сәйкестендіру Тапсырмасы</h1>
    <p>Сөздерді олардың аудармаларымен сәйкестендіріңіз.</p>
    <div class="container">
        <div class="list" id="words">
            <h2>Сөздер</h2>
            <div class="item" draggable="true" data-match="1">Күн</div>
            <div class="item" draggable="true" data-match="2">Жер</div>
            <div class="item" draggable="true" data-match="3">Су</div>
        </div>
        <div class="list" id="translations">
            <h2>Аудармалар</h2>
            <div class="dropzone" data-match="1">Sun</div>
            <div class="dropzone" data-match="2">Earth</div>
            <div class="dropzone" data-match="3">Water</div>
        </div>
    </div>

    <script>
        const items = document.querySelectorAll('.item');
        const dropzones = document.querySelectorAll('.dropzone');

        items.forEach(item => {
            item.addEventListener('dragstart', event => {
                event.dataTransfer.setData('text', event.target.dataset.match);
            });
        });

        dropzones.forEach(dropzone => {
            dropzone.addEventListener('dragover', event => {
                event.preventDefault();
                dropzone.style.borderColor = '#007bff';
            });

            dropzone.addEventListener('dragleave', () => {
                dropzone.style.borderColor = '#ddd';
            });

            dropzone.addEventListener('drop', event => {
                event.preventDefault();
                const match = event.dataTransfer.getData('text');
                const targetMatch = dropzone.dataset.match;

                if (match === targetMatch) {
                    dropzone.textContent = event.dataTransfer.getData('text') === '1' ? 'Күн' :
                                           event.dataTransfer.getData('text') === '2' ? 'Жер' : 'Су';
                    dropzone.classList.add('correct');
                } else {
                    dropzone.classList.add('wrong');
                }

                dropzone.style.borderColor = '#ddd';
                dropzone.style.pointerEvents = 'none';
            });
        });
    </script>
</body>
</html>
</body>
</html>
