  <div class="sidebar sidebar-style-2">
      <div class="sidebar-wrapper scrollbar scrollbar-inner">
          <div class="sidebar-content">

              <div class="user">
                  <div class="avatar-sm float-left mr-2">
                      <img src="/img/user/{{ Auth::user()->image }}" alt="{{ Auth::user()->image }}" class="avatar-img rounded-circle">
                  </div>

                  <div class="info">
                      <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                          <span>
                              {{ Auth::user()->name }}
                              <span class="user-level">{{ getLevel(Auth::user()->id_level) }}</span>
                              <span class="caret"></span>
                          </span>
                      </a>
                      <div class="clearfix"></div>

                      <div class="collapse in" id="collapseExample">
                          <ul class="nav">
                              <li>
                                  <a href="/user-account">
                                      <span class="link-collapse">User Account</span>
                                  </a>
                              </li>
                          </ul>
                      </div>
                  </div>
              </div>

              <ul class="nav nav-primary">
                  @php
                      echo getMenu();
                  @endphp

                  @can('superadmin')
                      <li class="nav-section">
                          <span class="sidebar-mini-icon">
                              <i class="fa fa-ellipsis-h"></i>
                          </span>
                          <h4 class="text-section">User</h4>
                      </li>

                      <li class="nav-item">
                          <a href="/admin/level">
                              <i class="fas fa-tree"></i>
                              <p>Level</p>
                          </a>
                      </li>

                      <li class="nav-item">
                          <a href="/admin/user">
                              <i class="fas fa-user"></i>
                              <p>User</p>
                          </a>
                      </li>

                      <li class="nav-item">
                          <a href="/admin/menu">
                              <i class="fas fa-clone"></i>
                              <p>Menu</p>
                          </a>
                      </li>

                      <li class="nav-item">
                          <a href="/admin/akses">
                              <i class="fas fa-key"></i>
                              <p>Akses</p>
                          </a>
                      </li>
                  @endcan
              </ul>



          </div>
      </div>
  </div>
