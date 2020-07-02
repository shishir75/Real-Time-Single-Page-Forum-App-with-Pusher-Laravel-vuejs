<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
    <title>Home</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<div id="app">
    <v-app>
        <v-main>
            <v-timeline>
                <v-timeline-item>timeline item</v-timeline-item>
                <v-timeline-item class="text-right">timeline item</v-timeline-item>
                <v-timeline-item>timeline item</v-timeline-item>
            </v-timeline>
        </v-main>
    </v-app>
</div>
<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
