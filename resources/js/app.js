import "./bootstrap";

window.Echo.private("Notifications." + userId)
    // this's represent name of event for broadcast
    // this method exactly make listen on event for notification
    // .notification('Illuminate\Notifications\Events\BroadcastNotificationCreated');
    // event will represent all abject that came from broadcast method
    // .listen("Event Name", (event) => {
    // without pass name of event laravel will understand notification event that came
    .notification((event) => {
        alert(event.title);

        $(".az-notification-list").prepend(`
        <a href="${event.link}?notify_id=${event.id}">
                    <div class="media @if ($notification->unread()) new @endif">
                        <div class="az-img-user"><img src="/assets/dashboard/img/faces/face2.jpg'"
                                alt=""></div>
                        <div class="media-body">
                            <p>${event.body}</p>
                            <span>${new Date().toLocaleTimeString}</span>
                        </div><!-- media-body -->
                    </div><!-- media -->
                </a>
        `);

        // here text() function it use for reading and writing if don't pass parameter be reading and if passed parameter be writing
        var unread = Number($("#unread").text());
        $("#unread").text(++unread);
    });
