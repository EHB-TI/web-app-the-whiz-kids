<nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="collapse navbar-collapse about-navbar" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" id="info-tab" href="#">Event Info<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="preview-tab" href="#">Event Voorbeeld</a>
            </li>
            @if(auth()->user()->role == "admin")
            <li class="nav-item">
                <a class="nav-link" id="visibility-tab" href="#">Event Zichtbaarheid & Organisatoren</a>
            </li>
            @else
            <li class="nav-item">
                <a class="nav-link" id="visibility-tab" href="#">Event Zichtbaarheid</a>
            </li>
            @endif
            <li class="nav-item">
                <a class="nav-link" id="ticket-tab" href="#">Tickets</a>
            </li>
        </ul>
    </div>
</nav>