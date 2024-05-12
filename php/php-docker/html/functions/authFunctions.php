<?php
session_start();

function user_has_role($role) {
    if (!empty($role)) {
        return $role;
    }
    return "Not valid role";
}

function is_signed_in($auth) {
    if ($auth === true) {
        return true;
    }
    return false;
}

function require_role($role) {
    // Kontrollera om användaren är inloggad och har rätt roll
    if (!isset($_SESSION['auth']) || !isset($_SESSION['role']) || !is_signed_in($_SESSION['auth']) || $_SESSION['role'] !== $role) {
        // Användaren har inte rätt roll eller är inte inloggad, gör en omdirigering
        header("Location: /no-access.php");
        exit(); // Avsluta scriptet efter omdirigering
    }
}

// Använda require_role-funktionen för att kontrollera att användaren har rollen 'customer'
require_role('customer');
?>
