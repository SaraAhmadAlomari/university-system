  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto ">
      <!-- language Dropdown Menu -->
      <li class="nav-item dropdown">
            <div class="dropdown">
            <button class="btn  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="flag-icon flag-icon-{{ LaravelLocalization::getCurrentLocale() == 'en' ? 'gb' :'jo' }}"></span>
                {{ LaravelLocalization::getSupportedLocales()[LaravelLocalization::getCurrentLocale()]['native'] }}
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <a class="dropdown-item" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                <span class="flag-icon flag-icon-{{ $localeCode == 'en' ? 'gb' :'jo' }}"></span>
                                {{ $properties['native'] }}
                            </a>
                    @endforeach
            </div>
            </div>
      </li>


      <li class="nav-item dropdown">
            <div class="dropdown">
            <button class="btn  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{Auth::user()->name}}
            </button>
            <div class="dropdown-menu dropdown-menu-right" style="cursor: pointer;" aria-labelledby="dropdownMenuButton">
                 <!-- Authentication -->
                        <form class="ml-2" method="POST" action="{{ route('logout') }}">
                            @csrf

                            <a :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </a>
                        </form>
            </div>
            </div>
      </li>

    </ul>
  </nav>
  <!-- /.navbar -->
