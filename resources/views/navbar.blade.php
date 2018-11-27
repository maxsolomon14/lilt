    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
                <a class="navbar-brand" href="/">{{config('app.name', 'Blue Bay')}}</a>
                    <div>
              <ul class="navbar-nav">
                <li class="nav-item">
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
                <form id="searchForm" name="searchForm" class="form-inline my-2 my-lg-0" action="/search" method="post">
                  @csrf
                  <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Search For</button>
                        <input class="span2" id="search_type" name="search_type" type="hidden">
                        <input type="search" class="form-control mr-sm-2" name="search" aria-label="Text input with dropdown button">
                        <ul name="type" class="dropdown-menu">
                          
                          <li class="dropdown-item" onclick="$('#search_type').val('post'); $('#searchForm').submit()">Post</li>
                          <li class="dropdown-item" onclick="$('#search_type').val('users'); $('#searchForm').submit()">User</li>
                          
                        </ul>
                      </div>
                      
                    </div>
                    
                  </form>
                @endif
              </ul>
              
            </div>
    </nav>