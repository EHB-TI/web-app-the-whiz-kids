<nav class="navbar navbar-expand-lg navbar-light bg-white">
  <div class="collapse navbar-collapse about-navbar" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item {{ request()->is('about') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('content.about') }}">Over ons<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item {{ request()->is('contact/create') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('content.contact.create') }}">Contacteer ons</a>
      </li>
      <li class="nav-item {{ request()->is('faq') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('content.faq.index') }}">FAQ</a>
      </li>
      <li class="nav-item {{ request()->is('conditions') ? 'active' : '' }}">
        <a class="nav-link" href="#">Voorwaarden</a>
      </li>
    </ul>
  </div>
</nav>