<div class="menu">
    <a href="{{ route('home') }}"
        class="{{ request()->routeIs('home') || request()->routeIs('landing') ? 'active' : '' }}">HOME</a>

    @auth('admin')
        <a href="{{ route('teachers.index') }}" class="{{ request()->routeIs('teachers.*') ? 'active' : '' }}">TEACHER</a>
        <a href="{{ route('students.index') }}" class="{{ request()->routeIs('students.*') ? 'active' : '' }}">STUDENT</a>
        <a href="{{ route('subjects.index') }}" class="{{ request()->routeIs('subjects.*') ? 'active' : '' }}">SUBJECT</a>
        <a href="{{ route('classes.index') }}" class="{{ request()->routeIs('classes.*') ? 'active' : '' }}">CLASS</a>
        <a href="{{ route('teachings.index') }}"
            class="{{ request()->routeIs('teachings.*') ? 'active' : '' }}">TEACHING</a>
        <a href="{{ route('logout') }}" onclick="return confirm('You Sure?')">LOGOUT</a>
    @endauth

    @auth('student')
        <a href="">ASSESSMENT</a>
        <a href="{{ route('logout') }}" onclick="return confirm('You Sure?')">LOGOUT</a>
    @endauth

    @auth('teacher')
        <a href="">ASSESSMENT</a>
        <a href="{{ route('logout') }}" onclick="return confirm('You Sure?')">LOGOUT</a>
    @endauth
</div>
