<?php 
// SKA INTE LIGGA HÄR 
    // if (isset($_SESSION['role'])) {
    //         $role_from_session = $_SESSION['role'];
    //     } else {
    //         $role_from_session = null;
    //     }

    // $role = user_has_role($role_from_session);

    function user_has_role($role) {
        if (!empty($role)) {
            return $role;
        }
        return "Not valid role";
    }

    // SKA INTE LIGGA HÄR
    // if (isset($_SESSION['auth'])) {
    //     $auth_from_session = $_SESSION['auth'];
    // } else {
    //     $auth_from_session = null;
    // }

    // $auth = is_signed_in($auth_from_session);

    function is_signed_in($auth) {
        if ($auth === true) {
            return true;
        }
        return false;
    }
    


?>