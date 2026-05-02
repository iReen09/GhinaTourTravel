document.addEventListener('DOMContentLoaded', () => {
    const trigger = document.getElementById('chatbotTrigger');
    const container = document.getElementById('chatbotContainer');
    const closeBtn = document.getElementById('chatbotClose');
    const input = document.getElementById('chatbotInput');
    const sendBtn = document.getElementById('chatbotSend');
    const messages = document.getElementById('chatbotMessages');

    if (!trigger) return;

    // Toggle Chat
    trigger.addEventListener('click', () => {
        container.classList.toggle('active');
        if (container.classList.contains('active') && messages.children.length === 0) {
            fetchInitialMenu();
        }
    });

    closeBtn.addEventListener('click', () => {
        container.classList.remove('active');
    });

    // Send Message
    const sendMessage = async (text) => {
        if (!text.trim()) return;

        appendMessage(text, 'user');
        input.value = '';
        
        showTyping();

        try {
            const response = await fetch('/api/chatbot/message', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ message: text })
            });
            const data = await response.json();
            hideTyping();
            if (data.success) {
                appendMessage(data.response, 'bot');
            } else {
                appendMessage('Maaf, ada kendala koneksi.', 'bot');
            }
        } catch (error) {
            hideTyping();
            appendMessage('Terjadi kesalahan sistem.', 'bot');
        }
    };

    sendBtn.addEventListener('click', () => sendMessage(input.value));
    input.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') sendMessage(input.value);
    });

    // Initial Menu
    async function fetchInitialMenu() {
        showTyping();
        try {
            const response = await fetch('/api/chatbot/menu');
            const data = await response.json();
            hideTyping();
            if (data.success) {
                appendMessage(data.response, 'bot', data.options);
            }
        } catch (error) {
            hideTyping();
        }
    }

    function appendMessage(text, side, options = []) {
        const msgDiv = document.createElement('div');
        msgDiv.className = `message message-${side}`;
        
        // Handle markdown-like bold/newlines from Gemini
        let formattedText = text.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
                                .replace(/\n/g, '<br>');
        
        msgDiv.innerHTML = `<div>${formattedText}</div>`;
        
        if (options && options.length > 0) {
            const quickReplies = document.createElement('div');
            quickReplies.className = 'quick-replies';
            options.forEach(opt => {
                const btn = document.createElement('button');
                btn.className = 'quick-reply-btn';
                btn.textContent = opt;
                btn.onclick = () => sendMessage(opt);
                quickReplies.appendChild(btn);
            });
            msgDiv.appendChild(quickReplies);
        }

        messages.appendChild(msgDiv);
        messages.scrollTop = messages.scrollHeight;
    }

    function showTyping() {
        const typingDiv = document.createElement('div');
        typingDiv.className = 'message message-bot typing-indicator';
        typingDiv.id = 'typingIndicator';
        typingDiv.innerHTML = '<div class="typing"><span></span><span></span><span></span></div>';
        messages.appendChild(typingDiv);
        messages.scrollTop = messages.scrollHeight;
    }

    function hideTyping() {
        const indicator = document.getElementById('typingIndicator');
        if (indicator) indicator.remove();
    }
});
