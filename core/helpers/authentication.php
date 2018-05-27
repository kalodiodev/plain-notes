<?php

/**
 * Authenticate user
 *
 * @param \App\Model\User $user
 */
function authenticate(\App\Model\User $user)
{
    $_SESSION['authenticated'] = serialize($user);
}

/**
 * Get authenticated user
 *
 * @return mixed|null
 */
function auth()
{
    if(isAuthenticated()) {
        return unserialize($_SESSION['authenticated']);
    }

    return null;
}

/**
 * Check if is authenticated
 *
 * @return bool
 */
function isAuthenticated()
{
    return isset($_SESSION['authenticated']);
}

/**
 * Sign Out authenticated user
 */
function signOut()
{
    unset($_SESSION['authenticated']);
}

/**
 * Action to perform when unauthorized
 */
function unauthorized()
{
    header('WWW-Authenticate: Basic realm="My Realm"');
    header('HTTP/1.0 401 Unauthorized');
    die ("Not authorized");
}
