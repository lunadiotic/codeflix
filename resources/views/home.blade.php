<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>
<a class="dropdown-item user-info-item" href="{{ route('logout') }}"
    onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i
        class="fa-solid fa-right-from-bracket"></i>
    Logout</a>
