document.getElementById("addTaskBtn").addEventListener("click", function () {
    const question = document.getElementById("question").value;
    const answer = document.getElementById("answer").value;
    const difficulty = document.getElementById("difficulty").value;
    const imageFile = document.getElementById("image").files[0];
    const audioFile = document.getElementById("audio").files[0];

    if (!question || !answer) {
        alert("Сұрақ мәтінін және дұрыс жауапты енгізіңіз.");
        return;
    }

    // Жаңа тапсырма объектісін құру
    const task = {
        question,
        answer,
        difficulty,
        image: imageFile ? URL.createObjectURL(imageFile) : null,
        audio: audioFile ? URL.createObjectURL(audioFile) : null
    };

    // Тапсырманы көрсету
    const tasksContainer = document.getElementById("tasksContainer");
    const taskCard = document.createElement("div");
    taskCard.className = "task-card";

    taskCard.innerHTML = `
        <h3>${task.question}</h3>
        <p><strong>Дұрыс жауап:</strong> ${task.answer}</p>
        <p><strong>Деңгей:</strong> ${task.difficulty}</p>
        ${task.image ? `<img src="${task.image}" alt="Сурет" style="width: 100%; max-height: 200px; object-fit: cover; margin-top: 10px;">` : ""}
        ${task.audio ? `<audio controls src="${task.audio}" style="margin-top: 10px; width: 100%;"></audio>` : ""}
    `;

    tasksContainer.appendChild(taskCard);

    // Форма өрістерін тазалау
    document.getElementById("taskForm").reset();
});
