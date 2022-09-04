<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Firebase Demo</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" >
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body>

    @include('firebase.inc.navbar')

    <div id="notifDiv">

    </div>

    <div class="py-3">
        @yield('content')
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" ></script>


    <script>
/*        var firebaseConfig = {
            apiKey: "AIzaSyAg0dBPP2oqhZdSNUty-j5-gYLwOwscMZc",
            authDomain: "notificationservice-79bf0.firebaseapp.com",
            projectId: "notificationservice-79bf0",
            storageBucket: "notificationservice-79bf0.appspot.com",
            messagingSenderId: "711790885281",
            appId: "1:134160842662:web:53d9866a348d9bd3049967",
            measurementId: "G-8YWE33BJF8"
        };
        firebase.initializeApp(firebaseConfig);
        const messaging = firebase.messaging();
        messaging
            .requestPermission()
            .then(function() {
                return messaging.getToken()
            })
            .then(function(token) {
                console.log(token);
            });
        messaging.onMessage(function(payload) {
            const noteTitle = payload.notification.title;
            const noteOptions = {
                body: payload.notification.body,
                icon: payload.notification.icon,
            };
            //new Notification(noteTitle, noteOptions);
        });*/

    </script>

    @stack('scripts')
</body>
</html>
