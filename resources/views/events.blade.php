<!DOCTYPE html>
<html>
<head>
    <title>Events</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

<div class="container-lg">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(!empty($events))
                @foreach($events as $event)
                    <div class="card event-card" data-id="{{ $event['event_id'] }}">
                        <div class="card-body">
                            <h4>Summary - {{ $event['summary'] }}</h4>
                            <p>Description - {{ $event['description'] }}</p>
                            <p>Start time - {{ $event['start'] }}</p>
                            <p>End time - {{ $event['end'] }}</p>
                            <button class="btn btn-danger del-event" data-id="{{ $event['event_id'] }}">Delete</button>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

        let token = $("meta").attr('name', 'csrf-token').attr('content')

        $('.del-event').on('click', function () {
            var eventId = $(this).data('id');
            var card = $(this).closest('.event-card');

            $.ajax({
                url: '/delete-event',
                method: 'POST',
                data: {
                    _token: token,
                    val: eventId
                },
                success: function (response) {
                    if (response.success) {
                        card.remove();
                    } else {
                        alert('Failed to delete the event.');
                    }
                },
                error: function (xhr) {
                    alert('An error occurred while trying to delete the event.');
                }
            });
        });

    });
</script>

</body>
</html>
