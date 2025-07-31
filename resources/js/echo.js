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
        console.log(e);
        
        const goalCounts = {
            A: e.teamA,
            B: e.teamB,
            S: e.status,
        };

        localStorage.setItem('goalCounts', JSON.stringify(goalCounts));
        if (goalCounts.S === 'finished') {
            localStorage.clear();
            console.log("Local storage cleared!");
        }

        updateGoalCountUI(goalCounts);
    });


window.Echo.channel('football.match').listen('MatchFinished', (e) => {
    console.log('Match Finished Event:', e);

    document.getElementById('score').innerText = 'No matches found.';
    // Clear local storage for this match
    localStorage.removeItem('goalCounts'); 
   
    window.Echo.leave('football.match');
    console.log('Left channel: football.match as match is finished.');
    
});

function updateGoalCountUI(goalCounts) {
    // document.getElementById('score').innerText =
    //     `Team A ${goalCounts.A} - ${goalCounts.B} Team B`;

    document.getElementById('home-score').innerText = goalCounts.A ?? 0;
    document.getElementById('away-score').innerText = goalCounts.B ?? 0;
}

window.addEventListener('load', () => {
    const cachedCounts = JSON.parse(localStorage.getItem('goalCounts')) || { A: 0, B: 0 };
    updateGoalCountUI(cachedCounts);
});

document.addEventListener('DOMContentLoaded', () => {
    const connectionStatusElement = document.getElementById('connection-status');
    if (window.Echo) {

        window.Echo.connector.pusher.connection.bind('state_change', function (states) {
            console.log('Echo connection state changed:', states.current);
            switch (states.current) {
                case 'connected':
                    connectionStatusElement.innerHTML = '<span style="color: green;">Connected</span>';
                    break;
                case 'connecting':
                    connectionStatusElement.innerHTML = '<span style="color: blue;">Connecting...</span>';
                    break;
                case 'disconnected':
                    connectionStatusElement.innerHTML = '<span style="color: red;">❌ Disconnected from server. Trying to reconnect...</span>';
                    break;
                case 'unavailable':
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

    } else {
        console.error('Laravel Echo (window.Echo) is not defined. Check your JavaScript compilation and loading order.');
        if (connectionStatusElement) {
            connectionStatusElement.innerHTML = '<span style="color: red;">Error: Real-time features not loaded.</span>';
        }
    }
});