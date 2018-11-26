    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
                <a class="navbar-brand" href="/">{{config('app.name', 'Blue Bay')}}</a>
                    <div>
              <ul class="navbar-nav">
                <li class="nav-item active">
                  <a class="nav-link" href="/">Home</a>
                </li>
                @if(Auth::check())
                <li class="nav-item">
                  <a class="nav-link" href="/create">Create</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/posts">Posts</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/profiles">Profiles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/messages">Messages</a>
                  </li>
                <li class="nav-item">
                    <a class="nav-link" href="/logout">Logout</a>
                  </li>
                <form class="form-inline my-2 my-lg-0" action="/search" method="post">
                  @csrf
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                  </form>
                @endif
              </ul>
              
            </div>
    </nav>