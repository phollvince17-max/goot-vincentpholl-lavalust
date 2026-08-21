<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * StudentController
 *
 * Handles the student home page and the (middleware-protected)
 * student profile page.
 *
 * NOTE: Replace the placeholder values in $this->student below with
 * your own real information before submitting this activity.
 */
class StudentController extends Controller
{
    /**
     * Sample student record.
     * TODO: Replace with YOUR actual student information.
     */
    private $student = [
        'student_id'  => 'MMCC-00112',
        'name'        => 'Vincent Pholl C. Goot',
        'course'      => 'BS Information Technology',
        'year'        => '3rd Year',
        'section'     => '3-F3',
        'email'       => 'phollvince@gmail.com',
        'address'     => 'victoria, Oriental Mindoro, Philippines',
        'contact'     => '09691754379',
        'skills'      => 'UI Design',
        'bio'         => 'kahit ano.',
    ];

    /**
     * GET /student
     * Student home / landing page.
     * Visiting this page grants a temporary "access badge" (session flag)
     * required by StudentMiddleware to view the profile page.
     */
    public function index()
    {
        // Grant access badge for the profile page (Part E custom condition)
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['profile_access'] = true;

        $data['name'] = $this->student['name'];
        $data['denied'] = isset($_GET['denied']);

        $this->call->view('student_home', $data);
    }

    /**
     * GET /student/profile
     * Student profile page. Protected by StudentMiddleware.
     */
    public function profile()
    {
        $this->call->view('student_profile', $this->student);
    }
}
