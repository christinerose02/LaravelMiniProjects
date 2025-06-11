<!DOCTYPE html>
<html>
<head>
    <title>Chat</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        /* Reset */
        body, html {
            margin: 0; padding: 0; height: 100%;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen,
                Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
            background: #f2f2f2;
            display: flex;
            flex-direction: column;
            height: 100vh;
        }

        h1 {
            text-align: center;
            background: #6200ee;
            color: white;
            margin: 0;
            padding: 15px 0;
            font-weight: 600;
        }

        /* Messages container */
        #messages {
            flex: 1;
            overflow-y: auto;
            padding: 10px;
            background: white;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        /* Chat bubbles */
        .message {
            max-width: 70%;
            padding: 10px 15px;
            border-radius: 20px;
            word-wrap: break-word;
            font-size: 16px;
            line-height: 1.3;
        }

        .user {
            background: #6200ee;
            color: white;
            align-self: flex-end;
            border-bottom-right-radius: 0;
        }

        .bot {
            background: #e0e0e0;
            color: #333;
            align-self: flex-start;
            border-bottom-left-radius: 0;
        }

        /* Form fixed at bottom */
        form#chat-form {
            display: flex;
            padding: 10px;
            background: white;
            box-shadow: 0 -2px 5px rgba(0,0,0,0.1);
        }

        form#chat-form input[type="text"] {
            flex: 1;
            padding: 12px 15px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 25px;
            outline: none;
            margin-right: 10px;
            box-sizing: border-box;
        }

        form#chat-form button {
            background: #6200ee;
            color: white;
            border: none;
            padding: 12px 20px;
            font-size: 16px;
            border-radius: 25px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        form#chat-form button:hover:not(:disabled) {
            background: #4500bb;
        }

        form#chat-form button:disabled {
            background: #aaa;
            cursor: not-allowed;
        }
    </style>
</head>
<body>
    <h1>Chat</h1>

    <div id="messages" aria-live="polite">
        @foreach ($messages as $message)
            <div class="message {{ $message->sender === 'user' ? 'user' : 'bot' }}">
                {{ $message->message }}
            </div>
        @endforeach
    </div>

    <form id="chat-form">
        @csrf
        <input type="text" name="message" id="message" placeholder="Type your message..." autocomplete="off" required>
        <button type="submit">Send</button>
    </form>

    <script>
        const messagesDiv = document.getElementById('messages');
        const form = document.getElementById('chat-form');
        const input = document.getElementById('message');
        const sendButton = form.querySelector('button');

        // Smooth scroll to bottom
        function scrollToBottom() {
            messagesDiv.scrollTo({
                top: messagesDiv.scrollHeight,
                behavior: 'smooth'
            });
        }

        scrollToBottom();

        form.addEventListener('submit', async function(e) {
            e.preventDefault();

            const userMessage = input.value.trim();
            if (!userMessage) return;

            // Append user message immediately
            const userDiv = document.createElement('div');
            userDiv.classList.add('message', 'user');
            userDiv.textContent = userMessage;
            messagesDiv.appendChild(userDiv);
            scrollToBottom();

            input.value = '';
            input.focus();

            // Disable send button while waiting
            sendButton.disabled = true;

            try {
                const response = await fetch('{{ route("chats.chat-send") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ message: userMessage })
                });

                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }

                const data = await response.json();

                // Append bot reply
                const botDiv = document.createElement('div');
                botDiv.classList.add('message', 'bot');
                botDiv.textContent = data.reply;
                messagesDiv.appendChild(botDiv);
                scrollToBottom();

            } catch (error) {
                console.error('Fetch error:', error);

                const errorDiv = document.createElement('div');
                errorDiv.classList.add('message', 'bot');
                errorDiv.textContent = 'Sorry, something went wrong. Please try again.';
                messagesDiv.appendChild(errorDiv);
                scrollToBottom();
            } finally {
                sendButton.disabled = false;
            }
        });
    </script>
</body>
</html>
