<?php
session_abort();
ob_end_clean();
header("Location: ./index.php");
