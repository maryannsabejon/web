class Chatbot {
    constructor() {
        this.chatIcon = document.getElementById('chatIcon');
        this.chatContainer = document.getElementById('chatContainer');
        this.closeChat = document.getElementById('closeChat');
        this.chatMessages = document.getElementById('chatMessages');
        this.userInput = document.getElementById('userInput');
        this.sendButton = document.getElementById('sendButton');
        this.responses = {};
        this.quickOptions = [
            { text: 'Pricing', keyword: 'price' },
            { text: 'Shipping', keyword: 'shipping' },
            { text: 'Sizes', keyword: 'size' },
            { text: 'Customization', keyword: 'custom' }
        ];
        this.lastContext = null;

        this.init();
    }

    async init() {
        try {
            const response = await fetch('responses.json');
            this.responses = await response.json();
            this.setupEventListeners();
            this.showWelcomeMessage();
        } catch (error) {
            console.error('Error initializing chatbot:', error);
        }
    }

    setupEventListeners() {
        this.chatIcon.addEventListener('click', () => this.toggleChat());
        this.closeChat.addEventListener('click', () => this.toggleChat());
        this.sendButton.addEventListener('click', () => this.handleUserInput());
        this.userInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') this.handleUserInput();
        });

        document.addEventListener('click', (e) => {
            if (this.chatContainer.classList.contains('active') &&
                !this.chatContainer.contains(e.target) &&
                !this.chatIcon.contains(e.target)) {
                this.toggleChat();
            }
        });
    }

    toggleChat() {
        this.chatContainer.classList.toggle('active');
        if (this.chatContainer.classList.contains('active')) {
            this.userInput.focus();
        }
    }

    showWelcomeMessage() {
        setTimeout(() => {
            this.addMessage('hello', false);
            this.createQuickOptions();
        }, 500);
    }

    createQuickOptions() {
        const quickOptionsDiv = document.createElement('div');
        quickOptionsDiv.className = 'quick-options';
        
        this.quickOptions.forEach(option => {
            const button = document.createElement('button');
            button.className = 'quick-option-btn';
            button.textContent = option.text;
            button.addEventListener('click', () => this.handleQuickOption(option.keyword));
            quickOptionsDiv.appendChild(button);
        });
        
        this.chatMessages.appendChild(quickOptionsDiv);
    }

    showTypingIndicator() {
        const typing = document.createElement('div');
        typing.className = 'bot-typing';
        typing.innerHTML = '<span></span><span></span><span></span>';
        this.chatMessages.appendChild(typing);
        this.scrollToBottom();
        return typing;
    }

    async handleUserInput() {
        const text = this.userInput.value.trim();
        if (!text) return;

        this.addMessage(text, true);
        this.userInput.value = '';

        const typingIndicator = this.showTypingIndicator();
        
        // Simulate processing time
        await new Promise(resolve => setTimeout(resolve, 1000));
        typingIndicator.remove();

        this.addMessage(text, false);
    }

    handleQuickOption(keyword) {
        this.addMessage(this.quickOptions.find(opt => opt.keyword === keyword).text, true);
        
        const typingIndicator = this.showTypingIndicator();
        
        setTimeout(() => {
            typingIndicator.remove();
            this.addMessage(keyword, false);
        }, 1000);
    }

    addMessage(text, isUser) {
        const messageDiv = document.createElement('div');
        messageDiv.className = `message ${isUser ? 'user-message' : 'bot-message'}`;
        messageDiv.textContent = isUser ? text : this.getBotResponse(text);
        this.chatMessages.appendChild(messageDiv);
        this.scrollToBottom();
    }

    getBotResponse(text) {
        const lowercaseText = text.toLowerCase();
        
        if (!this.responses) {
            return "Sorry, I'm having trouble accessing my responses. Please try again later.";
        }

        const getRandomResponse = (responses) => {
            if (Array.isArray(responses)) {
                return responses[Math.floor(Math.random() * responses.length)];
            }
            return responses;
        };

        // Check if it's a follow-up question
        const isQuestion = 
            lowercaseText.includes('?') ||
            /^(what|how|can|where|when|why|which|tell|show|explain|give)/i.test(lowercaseText);

        if (this.lastContext && isQuestion) {
            const contextResponses = {
                'material_info': [
                    "Let me tell you more about our materials:\n- Premium Canvas: Durable 450 GSM\n- Eco Cotton: 100% recycled\n- Vegan Leather: Weather resistant\nWhich material interests you?",
                    "Here are our material options:\n- Canvas (Most Popular)\n- Eco Cotton (Sustainable)\n- Vegan Leather (Premium)\nWould you like specific details about any of these?"
                ],
                'shipping': [
                    "Here's more shipping information:\n- Standard (3-5 days): $5.99\n- Express (2 days): $12.99\n- International: Varies by location\nWhat else would you like to know?",
                    "I can help with:\n- Delivery times\n- Shipping costs\n- Order tracking\n- International shipping\nWhat information do you need?"
                ],
                'price': [
                    "Let me break down our pricing:\n- Basic Totes: $15-25\n- Premium Line: $30-45\n- Custom Designs: $25-40\nWould you like specific details about any range?",
                    "Here's our detailed pricing:\n- Standard Collection: From $15\n- Premium Options: From $30\n- Custom Orders: From $25\nNeed more specific information?"
                ],
                'size': [
                    "Here are our size details:\n- Small: 11\"×12\"×2\"\n- Medium: 14\"×15\"×3\"\n- Large: 16\"×18\"×4\"\nWould you like to know what fits in each size?",
                    "Let me explain our sizes:\n- Small (Perfect for essentials)\n- Medium (Fits laptops)\n- Large (Ideal for shopping)\nWhich size would you like to know more about?"
                ],
                'custom': [
                    "Here are customization options:\n- Monogram: $5\n- Custom Print: $10\n- Color Choice: Free\n- Hardware Upgrade: $8\nWhich option interests you?",
                    "Our custom features include:\n- Personal monogram\n- Custom artwork\n- Color selection\n- Premium hardware\nWould you like details about any of these?"
                ]
            };

            if (contextResponses[this.lastContext]) {
                return getRandomResponse(contextResponses[this.lastContext]);
            }
        }

        // Check if it's a follow-up question about sizes
        if (this.lastContext === 'size' && 
            (lowercaseText.includes('yes') || 
             lowercaseText.includes('dimensions') ||
             lowercaseText.includes('sure') ||
             lowercaseText.includes('please') ||
             isQuestion)) {
            
            return "Here are our exact dimensions:\n" +
                   "- Small: 11\"×12\"×2\"\n" +
                   "  Perfect for essentials (tablet, wallet, phone)\n" +
                   "- Medium: 14\"×15\"×3\"\n" +
                   "  Fits laptop up to 13\", daily items\n" +
                   "- Large: 16\"×18\"×4\"\n" +
                   "  Ideal for shopping, travel, or gym\n\n" +
                   "Which size interests you?";
        }

        // Handle initial size inquiry
        if (lowercaseText.includes('size') || lowercaseText.includes('dimensions')) {
            this.lastContext = 'size';
            return "We offer Small, Medium, and Large sizes to fit your needs. Would you like the exact dimensions?";
        }

        // Regular response handling
        if (this.responses[lowercaseText]) {
            this.lastContext = lowercaseText;
            return getRandomResponse(this.responses[lowercaseText]);
        }

        // Keyword matching
        const keywords = {
            'material': 'material_info',
            'materials': 'material_info',
            'fabric': 'material_info',
            'made of': 'material_info',
            'warranty': 'warranty_info',
            'guarantee': 'warranty_info',
            'contact': 'contact_info',
            'support': 'contact_info',
            'reach': 'contact_info',
            'collection': 'collection_info',
            'collections': 'collection_info',
            'small': 'small_size',
            'shipping': 'shipping',
            'delivery': 'shipping',
            'price': 'price',
            'cost': 'price',
            'custom': 'custom',
            'personalize': 'custom'
        };

        for (const [key, responseKey] of Object.entries(keywords)) {
            if (lowercaseText.includes(key)) {
                this.lastContext = responseKey;
                return getRandomResponse(this.responses[responseKey]);
            }
        }

        // Reset context and show options if no match
        this.lastContext = null;
        setTimeout(() => {this.createQuickOptions();}, 1000);
        return "I'm not quite sure about that. Could you try rephrasing your question or choose from these options?";
    }

    scrollToBottom() {
        this.chatMessages.scrollTop = this.chatMessages.scrollHeight;
    }
}

// Initialize chatbot when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    new Chatbot();
}); 
new Chatbot(); 