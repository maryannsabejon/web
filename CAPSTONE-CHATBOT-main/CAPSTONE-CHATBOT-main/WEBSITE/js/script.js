document.addEventListener("DOMContentLoaded", function() {
    // Define showContent function if it's not defined elsewhere
    function showContent() {
        document.body.style.visibility = 'visible';
    }

    // Load chatbot immediately
    loadChatbot();

    // Handle page load with delay
    window.addEventListener("load", function() {
        setTimeout(showContent, 3500); 
    });
});

function loadChatbot() {
    // Check if jQuery is loaded
    if (typeof jQuery === 'undefined') {
        console.error('jQuery is not loaded! Please include jQuery in your HTML file.');
        return;
    }

    try {
        $("#Chatbot").load("chatbot.html", function(response, status, xhr) {
            if (status == "error") {
                console.error("Error loading chatbot: " + xhr.status + " " + xhr.statusText);
                return;
            }
            const script = document.createElement('script');
            script.src = '/js/chatbot.js';
            script.onerror = function() {
                console.error('Failed to load chatbot.js');
            };
            document.body.appendChild(script);
        });
    } catch (error) {
        console.error('Error in loadChatbot:', error);
    }
} 