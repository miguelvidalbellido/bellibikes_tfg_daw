class WebSocketService{

    constructor() {
        this.socket = null;
    }

    connect(url) {
        this.socket = new WebSocket(url);

        this.socket.onopen = () => {
            console.log('WebSocket Connected');
        };

        this.socket.onmessage = (event) => {
            this.controlEventsChange(event.data);
        };

        this.socket.onerror = (error) => {
            console.error('WebSocket Error:', error);
        };

        this.socket.onclose = () => {
            console.log('WebSocket Disconnected');
        };
    }


    subscribeToMessages(callback) {
        this.onMessage = callback;
    }

    controlEventsChange(data) {
        // Llama al callback con los datos
        if (this.onMessage) {
            this.onMessage(data);
        }
    }

}

export default new WebSocketService();