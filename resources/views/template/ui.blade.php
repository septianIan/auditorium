<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Auditorium UMM | @yield('title', 'Dashboard')</title>
   @include('template.components.style')
</head>
<body>
   @include('template.components.navbar')
   @include('template.components.sidebar')
   @include('template.components.contentWrapper')
   @include('template.components.footer')
   @include('template.components.script')
</body>
</html>