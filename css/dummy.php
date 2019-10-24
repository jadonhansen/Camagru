<html>
    <head>
        <link rel="stylesheet" href="footer.css">
        <link rel="stylesheet" href="body.css">
        <link rel="stylesheet" href="head.css">
    </head>
    <!-- background is the body id -->
    <body id="bground">

        <!-- the header -->
        <div class="head">
            <div class="icon">
                    ICON
            </div>

            <!-- the differing logins and outs -->
            <?php if($_SESSION["loggedIn"] == "yes") { 
                   
               // logout 
                
                session_start();    
                session_destroy();
            } else { ?>

            <!-- login -->
            <div class="create">
                    <a id="link" href="../reference(bootstrap)/create.html">create account</a>
            </div>
            <div class="line">

            </div>
            <div class="create">
                    <a id="link" href="../reference(bootstrap)/create.html">Login</a>
                </div>
            <?php
    }
?>
        </div>

        <!-- the footer -->
        <div class="foot">
            contact us
        </div>
    </body>
</html>




<!-- the login/logout seperater -->

