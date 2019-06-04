<!DOCTYPE html>
<html lang="en">
  <head>
    @include("admin/includes/header")
  </head>
  <body>
    <div class="wrapper">
    @include("admin/includes/navigation")
    @yield('content')

    @include("admin/includes/footer")
     </div>

  </body>
</html>
