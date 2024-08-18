getUserNavMenu(`<li class="nav-item m-2 dropdown d-none d-sm-block text-nowrap">
                <a data-toggle="dropdown" class="user-menu item-menu">
                    <span class="username"></span>
                    <i class="fas fa-angle-down ml-2"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-tip-nw p-2 pull-left">
                    <div class="p-2 border-bottom username"></div>
                    <a href="${profileAdsRoute}"
                       class="dropdown-item">${advsTrans}</a>
                    <a href="${profileRoute}"
                       class="dropdown-item">${accountTrans}</a>
                    <span class="addBlock"></span>
                    <a href="${logoutRoute}" class="dropdown-item">
                        <i class="fas fa-sign-out-alt mr-1"></i>
                        ${logoutTrans}
                    </a>
                </div>
            </li>
            <li class="nav-item post-free-btn d-none d-sm-block">
                <a href="${createAdvRoute}"
                   class="btn ml-xl-3 mt-1 item-menu">${postAdvTrans}</a>
            </li>`, $('.user-nav-menu'));
