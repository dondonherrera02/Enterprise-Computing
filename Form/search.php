<?php

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // $search_query = $_GET["query"]; // Vulnerable line

    // <script>  to   &lt;script&gt;
    $search_query = htmlspecialchars(trim($_GET["query"]));
    echo "Search: " . $search_query;
}
?>