<!DOCTYPE html>
<html>
<head>
    <title>Events</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <style>
        .error-text {
            color: red;
        }
        .event-card {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="container-lg">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card event-card">
                <div class="card-body">
                    <h2>Create Event</h2>
                    @if(!empty(session('success')))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <form action="{{ route('store_event') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control" id="title" placeholder="Event Title">
                            <div class="error-text">{{ $errors->first('title') }}</div>
                        </div>
                        <div class="form-group">
                            <label for="description">Content</label>
                            <input type="text" name="description" class="form-control" id="description" placeholder="Event Content">
                            <div class="error-text">{{ $errors->first('description') }}</div>
                        </div>
                        <div class="form-group">
                            <label for="start">Start Event</label>
                            <input type="datetime-local" name="start" class="form-control" id="start">
                            <div class="error-text">{{ $errors->first('start') }}</div>
                        </div>
                        <div class="form-group">
                            <label for="end">End Event</label>
                            <input type="datetime-local" name="end" class="form-control" id="end">
                            <div class="error-text">{{ $errors->first('end') }}</div>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Event</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(!empty($events))
                @foreach($events as $event)
                    <div class="card event-card">
                        <div class="card-body">
                            <h4>Summary - {{ $event['summary'] }}</h4>
                            <p>Description - {{ $event['description'] }}</p>
                            <p>Start time - {{ $event['start'] }}</p>
                            <p>End time - {{ $event['end'] }}</p>
                            <button class="btn btn-danger del-event" id="del-event" value="{{ $event['event_id'] }}">Delete</button>
                            <button class="btn btn-warning">Edit</button>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>

</body>
</html>
