document.addEventListener('DOMContentLoaded', function() {
    const chatbotToggle = document.getElementById('chatbot-toggle');
    const chatbotWindow = document.getElementById('chatbot-window');
    const closeChat = document.getElementById('close-chat');
    const userInput = document.getElementById('user-input');
    const sendMessage = document.getElementById('send-message');
    const chatMessages = document.getElementById('chat-messages');

    // Mensajes predefinidos del bot
    const botResponses = {
        'hola': '¡Hola! ¿En qué puedo ayudarte hoy?',
        'menu': 'Tenemos una gran variedad de productos. ¿Te gustaría ver nuestro menú completo?',
        'precio': 'Los precios varían según el producto. ¿Hay algo específico que te interese?',
        'horario': 'Estamos abiertos de lunes a viernes de 7:00 AM a 4:00 PM.',
        'gracias': '¡De nada! Estoy aquí para ayudarte. 😊',
        'comprar': 'Si te refieres a ¿Cómo comprar?, ¡Facil! Solo buscas el producto de tu gusto, lo metes al carrito o directamente lo compras y listo!',
        'cómo estas?': 'Hola! Muy bien y tu? Gracias por preguntar, ¿En qué te puedo ayudar?',
        'como estas?': 'Hola! Muy bien y tu? Gracias por preguntar, ¿En qué te puedo ayudar?',
        'default': 'No entiendo tu pregunta. ¿Podrías reformularla?'
    };

    // Mensaje inicial del bot
    function addInitialMessage() {
        const initialMessage = document.createElement('div');
        initialMessage.className = 'bot-message';
        initialMessage.innerHTML = `
            <div class="flex items-start gap-2">
                <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center flex-shrink-0">
                    <img src="../assets/imagenes/SchoolSnackPrototipo.png" alt="Bot" class="w-6 h-6">
                </div>
                <div>
                    <p>¡Hola! 👋</p>
                    <p>Soy el asistente virtual de Aperitivo Escolar. ¿En qué puedo ayudarte?</p>
                </div>
            </div>
        `;
        chatMessages.appendChild(initialMessage);
    }

    // Mostrar/ocultar chatbot
    chatbotToggle.addEventListener('click', () => {
        chatbotWindow.classList.toggle('hidden');
        setTimeout(() => {
            chatbotWindow.classList.toggle('active');
        }, 0);
        if (chatMessages.children.length === 0) {
            addInitialMessage();
        }
    });

    closeChat.addEventListener('click', () => {
        chatbotWindow.classList.remove('active');
        setTimeout(() => {
            chatbotWindow.classList.add('hidden');
        }, 300);
    });

    // Función para agregar mensajes
    function addMessage(message, isUser = false) {
        const messageDiv = document.createElement('div');
        messageDiv.className = isUser ? 'user-message' : 'bot-message';
        
        if (!isUser) {
            messageDiv.innerHTML = `
                <div class="flex items-start gap-2">
                    <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center flex-shrink-0">
                        <img src="../assets/imagenes/SchoolSnackPrototipo.png" alt="Bot" class="w-6 h-6">
                    </div>
                    <div>${message}</div>
                </div>
            `;
        } else {
            messageDiv.textContent = message;
        }
        
        chatMessages.appendChild(messageDiv);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    // Función para obtener respuesta del bot
    function getBotResponse(message) {
        const lowerMessage = message.toLowerCase();
        for (const [key, value] of Object.entries(botResponses)) {
            if (lowerMessage.includes(key)) {
                return value;
            }
        }
        return botResponses.default;
    }

    // Enviar mensaje
    function sendUserMessage() {
        const message = userInput.value.trim();
        if (message) {
            addMessage(message, true);
            userInput.value = '';

            // Simular respuesta del bot después de un breve delay
            setTimeout(() => {
                const botResponse = getBotResponse(message);
                addMessage(botResponse);
            }, 500);
        }
    }

    sendMessage.addEventListener('click', sendUserMessage);
    userInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
            sendUserMessage();
        }
    });
});