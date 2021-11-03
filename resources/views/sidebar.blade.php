<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="sidebar-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ (request()->is('/')) ? 'active' : '' }}" href="{{ url('/') }}">
                    <i data-feather="home"></i>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ (request()->is('events')) ? 'active' : '' }}" href="{{ route('events.index') }}">
                    <i data-feather="dollar-sign"></i>
                    Ver Despesas
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ (request()->is('events.recurring')) ? 'active' : '' }}" href="{{ route('events.recurring') }}">
                    <i data-feather="list"></i>
                    Recorrentes
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ (request()->is('categories*')) ? 'active' : '' }}"
                   href="{{ route('categories.index') }}">
                    <i data-feather="folder"></i>
                    Categorias
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ (request()->is('tags*')) ? 'active' : '' }}"
                   href="{{ route('tags.index') }}">
                    <i data-feather="tag"></i>
                    Tags
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ (request()->is('aggregators*')) ? 'active' : '' }}"
                   href="{{ route('aggregators.index') }}">
                    <i data-feather="link-2"></i>
                    Agregadores
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ (request()->is('payment_options*')) ? 'active' : '' }}"
                   href="{{ route('payment_options.index') }}">
                    <i data-feather="credit-card"></i>
                    Métodos de Pagamento
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ (request()->is('options*')) ? 'active' : '' }}"
                   href="{{ route('options.index') }}">
                    <i data-feather="settings"></i>
                    Configurações
                </a>
            </li>
        </ul>
    </div>
</nav>
