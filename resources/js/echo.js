import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT ?? 80,
    wssPort: import.meta.env.VITE_REVERB_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
});

window.Echo.channel('football.match')
    .listen('ScoreUpdated', (e) => {
        console.log('Score updated via Reverb:', e);
        // Update your Blade UI elements
        document.getElementById('score').innerText =
            `Team A ${e.teamA} - ${e.teamB} Team B`;
    });


// const statusDiv = document.getElementById('status');
// if (statusDiv) {
//     window.Pusher.connection.bind('connected', () => {
//         statusDiv.textContent = ''; // Clear any previous error
//     });

//     window.Pusher.connection.bind('error', (err) => {
//         statusDiv.textContent = '⚠️ Connection error. Trying to reconnect...';
//         console.error('WebSocket error:', err);
//     });

//     window.Pusher.connection.bind('disconnected', () => {
//         statusDiv.textContent = '❌ Disconnected from server.';
//     });
// }

// Ensure the DOM is fully loaded before trying to access elements
document.addEventListener('DOMContentLoaded', () => {
    const connectionStatusElement = document.getElementById('connection-status'); // Assuming you have this div

    if (window.Echo) {
        // Listen for connection status changes
        window.Echo.connector.pusher.connection.bind('state_change', function(states) {
            console.log('Echo connection state changed:', states.current);
            switch (states.current) {
                case 'connected':
                    connectionStatusElement.innerHTML = '<span style="color: green;">Connected</span>';
                    // You might want to clear previous error messages here as well
                    break;
                case 'connecting':
                    connectionStatusElement.innerHTML = '<span style="color: blue;">Connecting...</span>';
                    break;
                case 'disconnected':
                    connectionStatusElement.innerHTML = '<span style="color: red;">❌ Disconnected from server. Trying to reconnect...</span>';
                    break;
                case 'unavailable':
                    // This often means a temporary network issue or server down, but Echo will retry
                    connectionStatusElement.innerHTML = '<span style="color: orange;">⚠️ Connection unavailable. Retrying...</span>';
                    break;
                case 'failed':
                    connectionStatusElement.innerHTML = '<span style="color: red;">❌ Connection failed. Cannot connect to the server.</span>';
                    break;
                default:
                    connectionStatusElement.innerHTML = `<span style="color: gray;">Status: ${states.current}</span>`;
                    break;
            }
        });

        // Your existing channel listening code
        // window.Echo.channel('football.match').listen('ScoreUpdated', (e) => { /* ... */ });

    } else {
        console.error('Laravel Echo (window.Echo) is not defined. Check your JavaScript compilation and loading order.');
        if (connectionStatusElement) {
            connectionStatusElement.innerHTML = '<span style="color: red;">Error: Real-time features not loaded.</span>';
        }
    }
});