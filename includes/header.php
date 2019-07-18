<html>
<head>
<?php echo (isset($page_title)) ? "<title>$page_title</title>" : "<title>P.P.E.S. 2016</title>"; ?>
</head>
<?php	(isset($theme)) ? $c = $theme : $c = "css.css"; ?>
<?php echo "<link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"../includes/css/$c\">"; ?>
<body>