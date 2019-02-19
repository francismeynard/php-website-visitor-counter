<!DOCTYPE html>
<?php
	include_once("counter.php");
?>
<html>

<head>
    <link rel="stylesheet" href="css/tick.css">
</head>

<body>
    <p class="tick tick-flip"><?php echo $counterValue; ?></p>

    <script src="js/jquery.min.js" type="text/javascript"></script>
    <script src="js/jquery.easing.js" type="text/javascript"></script>
    <script src="js/tick.js" type="text/javascript"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $('.tick').ticker({
            incremental: getCounter,
            separators: true,
            autostart: true,
            delay: 500
        });
    });

    var counterValue = <?php echo $counterValue; ?>; // This is the counter retrieved from file.
    var displayCounter = counterValue; // This is the counter currently displayed in screen.
    function getCounter() {
        if (displayCounter < counterValue) {
            displayCounter++;
        }
        return displayCounter;
    }

    function refreshCounter() {
        jQuery.ajax({
            url: 'getCounter.php',
            success: function(result) {
                counterValue = parseInt(result);
                setTimeout(refreshCounter, 3000); // Refresh counter every 3 seconds.
            },
            cache: false
        });
    }
    refreshCounter();
    </script>
</body>

</html>