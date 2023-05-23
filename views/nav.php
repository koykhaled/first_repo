<?php

if (isset($_SESSION['user_id'])) {
?>
<a href="/PHPCOURSE/Darrebeni/htaccess_Task/logout">logout</a>
<?php
} else {
?>
<a href="/PHPCOURSE/Darrebeni/htaccess_Task/login">login</a>
<?php
}