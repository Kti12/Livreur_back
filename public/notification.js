
// Enable pusher logging - don't include this in production
Pusher.logToConsole = true;

var pusher = new Pusher('0ef56a48675e01a0dfc3', {
    cluster: 'eu'
});

var channel = pusher.subscribe('katiene-channel');
channel.bind('katiene-event', function(data) {
    alert(JSON.stringify(data));
});
