<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * StudentMiddleware
 *
 * Custom access condition (unique to this app):
 * A visitor must first "check in" at the student home page (/student),
 * which stamps a temporary access badge into the session
 * ($_SESSION['profile_access']). Only visitors holding that badge may
 * view the student profile page. Anyone without it is redirected back
 * to the home page with a denial notice.
 */
class StudentMiddleware
{
    /**
     * Handle the incoming request.
     *
     * @param Closure $next
     * @return mixed
     */
    public function handle(Closure $next)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $has_badge = isset($_SESSION['profile_access']) && $_SESSION['profile_access'] === true;

        if (!$has_badge) {
            // Not authorized: bounce back to the home page with a message.
            redirect('student?denied=1');
            return;
        }

        // Authorized: continue to StudentController::profile()
        return $next();
    }
}
