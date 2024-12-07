const express = require('express');
const app = express();

// Қолданушы мәліметтері (Мұнда нақты деректерді алу керек)
const user = {
    name: 'Адам Аты',
    profileImage: 'https://via.placeholder.com/50'
};

// API арқылы қолданушы мәліметтерін қайтару
app.get('/api/getUserInfo', (req, res) => {
    res.json(user);
});

// Серверді тыңдау
app.listen(3000, () => {
    console.log('Сервер 3000 портында іске қосылды');
});
