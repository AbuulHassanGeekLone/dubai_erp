<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->





        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link @if(Route::currentRouteName() == 'dashboard') active @endif">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                </p>
            </a>
        </li>


        <li class="nav-item has-treeview @if(in_array(Route::currentRouteName(), ['sale_report', 'purchaseorder', 'saleorderreport'])) menu-open @endif" >
            <a href="#" class="nav-link @if(in_array(Route::currentRouteName(), ['sale_report', 'purchaseorder', 'saleorderreport'])) active @endif" >
                <i class="nav-icon fas fa-users-cog"></i>
                <p style="font-size: 15px;">
                    Sales & Purchase Reports
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item ">
                    <a href="{{ route('sale_report') }}" class="nav-link @if(Route::currentRouteName() == 'sale_report') active @endif">
                        <i class="nav-icon fas fa-file"></i>
                        <p>Sales Report</p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="{{ route('saleorderreport') }}" class="nav-link @if(Route::currentRouteName() == 'saleorderreport') active @endif">
                        <i class="nav-icon fas fa-file"></i>
                        <p>Sales Order Report</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('purchaseorder') }}" class="nav-link @if(Route::currentRouteName() == 'purchaseorder') active @endif">
                        <i class="nav-icon fas fa-file"></i>
                        <p>Purchase order Summary</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item has-treeview @if(in_array(Route::currentRouteName(), ['inventry', 'lowstock'])) menu-open @endif">
            <a href="#" class="nav-link @if(in_array(Route::currentRouteName(), ['inventry', 'lowstock'])) active @endif">
                <i class="nav-icon fas fa-users-cog"></i>
                <p>
                    Inventory Report
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('inventry')}}" class="nav-link @if(Route::currentRouteName() == 'inventry') active @endif">
                        <i class="nav-icon fas fa-file"></i>
                        <p>Inventory summery</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('lowstock')}}" class="nav-link @if(Route::currentRouteName() == 'lowstock') active @endif">
                        <i class="nav-icon fas fa-file"></i>
                        <p>Low stock report</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item has-treeview @if(in_array(Route::currentRouteName(), ['accountManagement.index', 'accountType.index', 'balance_sheet', 'trialbalance', 'journal.index', 'profitloss','ledger'])) menu-open @endif" >
            <a href="{{route('profitloss')}}" class="nav-link @if(in_array(Route::currentRouteName(), ['accountManagement.index', 'accountType.index', 'balance_sheet', 'journal.index', 'profitloss','ledger'])) active @endif" >
                <i class="nav-icon fas fa-users-cog"></i>
                <p>
                    Accounts
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('accountManagement.index')}}" class="nav-link @if(Route::currentRouteName() == 'accountManagement.index') active @endif">
                        <i class="nav-icon fas fa-file"></i>
                        <p>Account Management</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('accountType.index')}}" class="nav-link @if(Route::currentRouteName() == 'accountType.index') active @endif">
                        <i class="nav-icon fas fa-file"></i>
                        <p>Account Type</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('journal.index')}}" class="nav-link @if(Route::currentRouteName() == 'journal.index') active @endif">
                        <i class="nav-icon fas fa-file"></i>
                        <p>Journal</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('balance_sheet')}}" class="nav-link @if(Route::currentRouteName() == 'balance_sheet') active @endif">
                        <i class="nav-icon fas fa-file"></i>
                        <p>Balance sheet</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('trialbalance')}}" class="nav-link @if(Route::currentRouteName() == 'trialbalance') active @endif">
                        <i class="nav-icon fas fa-file"></i>
                        <p>Trial balance</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('profitloss')}}" class="nav-link @if(Route::currentRouteName() == 'profitloss') active @endif">
                        <i class="nav-icon fas fa-file"></i>
                        <p>Profit Loss</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('ledger')}}" class="nav-link @if(Route::currentRouteName() == 'ledger') active @endif">
                        <i class="nav-icon fas fa-file"></i>
                        <p>Ledger</p>
                    </a>
                </li>
            </ul>

        </li>


        <li class="nav-item has-treeview @if(in_array(Route::currentRouteName(), ['adminlist.create', 'adminlist.index', 'operatorlist'])) menu-open @endif" >
            <a href="#" class="nav-link @if(in_array(Route::currentRouteName(), ['adminlist.create', 'adminlist.index', 'operatorlist'])) active @endif" >
                <i class="nav-icon fas fa-users-cog"></i>
                <p>
                    User management
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('adminlist.create')}}" class="nav-link @if(Route::currentRouteName() == 'adminlist.create') active @endif">
                        <i class="fas fa-users nav-icon"></i>
                        <p>Create User</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('adminlist.index')}}" class="nav-link @if(Route::currentRouteName() == 'adminlist.index') active @endif">
                        <i class="fas fa-user-shield nav-icon"></i>
                        <p>Admin</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('operatorlist')}}" class="nav-link @if(Route::currentRouteName() == 'operatorlist') active @endif">
                        <i class="fas fa-user-tie nav-icon"></i>
                        <p>Operator</p>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Setting Start from Here -->
        <li class="nav-item">
            <a href="{{route('setting.index')}}" class="nav-link @if(Route::currentRouteName() == 'setting.index') active @endif">
                <i class="nav-icon fas fa-file"></i>
                <p>Company settings</p>
            </a>
        </li>



    </ul>
</nav>
