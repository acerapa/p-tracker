<div class="header">
    <div class="header-wrapper-icon">
        <img class="header-icon" src="<?php echo asset('icons/', 'logo.png'); ?>" alt="logo" srcset="">
        <span class="app-name">P-tracker</span>
    </div>
    <div class="header-wrapper-user">
        <img class="header-icon user-icon" id="user-icon" src="<?php echo asset('icons/', 'user.png'); ?>" alt="user">
    </div>

    <div class="header-dropdown" id="header-dropdown">
        <div class="user-profile">
            <img class="user-icon" src="<?php echo asset('icons/', 'user.png'); ?>" alt="" srcset="">
            <small><?php echo $user->username; ?></small>
            <img class="header-dropdown-close" id="dropdown-close" src="<?php echo asset('icons/', 'close.png'); ?>" alt="">
        </div>
        <div class="header-dropdown-wrapper">
            <div class="header-dropdown-item <?php echo isset($route) && $route['name'] == 'app.index' ? 'active' : '' ?>">
                <a href="<?php echo route('app.index'); ?>" class="header-dropdown-link"><img src="<?php echo asset('icons/', 'home.png'); ?>" alt="">Home</a>
            </div>
            <div class="header-dropdown-item <?php echo isset($route) && $route['name'] == 'user.edit' ? 'active' : '' ?>">
                <a href="<?php echo route('user.edit', [$user->id]); ?>" class="header-dropdown-link"><img src="<?php echo asset('icons/', 'user-circle.png'); ?>" alt="">Profile</a>
            </div>
            <div class="header-dropdown-item <?php echo isset($route) && $route['name'] == 'app.activity' ? 'active' : '' ?>">
                <a href="<?php echo route('app.activity'); ?>" class="header-dropdown-link"><img src="<?php echo asset('icons/', 'activity.png'); ?>" alt="">Activities</a>
            </div>
            <div class="header-dropdown-item">
                <a href="#" class="header-dropdown-link"><img src="<?php echo asset('icons/', 'settings.png'); ?>" alt="">Settings</a>
            </div>
            <div class="header-dropdown-item">
                <a href="/logout" class="header-dropdown-link"><img src="<?php echo asset('icons/', 'logout.png'); ?>" alt="">Logout</a>
            </div>
        </div>
    </div>
</div>