<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon"/>
    <title>V12 Software &dash; Videos Automation</title>
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:400,500,700,400italic"/>
  </head>
  <body style="background-color:#EBEFF2;">
    <noscript>
      <strong>We're sorry but va-vue-app doesn't work properly without JavaScript enabled. Please enable it to continue.</strong>
    </noscript>
    <div id="va-app"></div>
    <!-- built files will be auto injected -->
    <script src="{{ asset(mix('js/app.js')) }}"></script>
  </body>
</html>
