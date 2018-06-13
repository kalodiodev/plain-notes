<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="/">Plain Notes</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item <?php echo $_SERVER['REQUEST_URI'] === route('') ? 'active' : ''; ?>">
                <a class="nav-link" href="<?php echo route(''); ?>">Home <span class="sr-only">(current)</span></a>
            </li>

            <?php if(isAuthenticated()): ?>
                <li class="nav-item <?php echo $_SERVER['REQUEST_URI'] === route('notes') ? 'active' : ''; ?>">
                    <a class="nav-link" href="<?php echo route('notes'); ?>">Notes</a>
                </li>
            <?php endif; ?>
        </ul>

        <?php if(! isAuthenticated()): ?>
            <ul class="navbar-nav">
                <li class="nav-item <?php echo $_SERVER['REQUEST_URI'] === route('login') ? 'active' : ''; ?>">
                    <a class="nav-link" href="<?php echo route('login'); ?>">Login</a>
                </li>
                <li class="nav-item <?php echo $_SERVER['REQUEST_URI'] === route('register') ? 'active' : ''; ?>">
                    <a class="nav-link" href="<?php echo route('register'); ?>">Register</a>
                </li>
            </ul>
        <?php endif; ?>

        <?php if(isAuthenticated()): ?>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php
                            if(strlen(auth()->firstName) > 0 && strlen(auth()->lastName) > 0) {
                                echo auth()->firstName . ' ' . auth()->lastName;
                            } else {
                                echo auth()->email;
                            }
                        ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?php echo route('settings'); ?>">Settings</a>
                        <a class="dropdown-item" href="<?php echo route('logout'); ?>">Logout</a>
                    </div>
                </li>
            </ul>
        <?php endif; ?>
    </div>
</nav>