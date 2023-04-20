<header>
    <div class="logo-container">
    <!--Embedded from google and found at (https://www.w3schools.com/howto/howto_google_translate.asp)-->
    <div id="google_translate_element"></div>
        <script type="text/javascript">
            function googleTranslateElementInit() {
            new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
            }
        </script>
        <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <img src="./images/logo_filler.PNG" alt="Img" width="60px" height="40px">
    </div>
    <!--Navbar-->
    <nav>
    <ul class="navbar-links">
        <li>
        <a class="navbar-linkh" href="index.php">HOME</a>
        </li>
        <li>
        <a class="navbar-links" href="staff.php">STAFF</a>
        </li>
        <li>
        <a class="navbar-linkp" href="products.php">PRODUCTS</a>
        </li>
        <li>
        <a class="navbar-linkc" href="customers.php">CUSTOMERS</a>
        </li>
        <li>
        <a class="navbar-linko" href="orders.php">ORDERS</a>
        </li>
    </ul>
    </nav>
    <div class="logout">
    <!--Div helps to align navbar-->
    </div>
    </div>
    <!--Dropdown menu-->
    <div class="dropdown">
    <button onclick="myFunction()" class="dropbtn">
        <i class="fa fa-user"><img class="dropdown_dropicon" src="./images/dropdown_icon.png"></i> <?php echo ($_SESSION ['username']); ?> 
    </button>
    <div id="myDropdown" class="dropdown-content">
        <a class="increase"href="">
        <i></i>Increase font size</a>
        <a class="decrease"href="">
        <i></i>Decrease font size</a>
        <a href="#" onclick="location.reload()">
        <i class="fa fa-ban fa-fw"></i>Refresh Page </a>
        <span class="empty">&nbsp;</span>
        <form class="logout_form" method='post' action="">
        <input class="logoutbut" type="submit" value="Logout" name="but_logout">
        </form>
    </div>
    </div>
    <!--JQuery Font size change-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(function(){
            $(".increase").on('click', function(){
                var currentSize = $("td").css("font-size");
                var currentSizeNum = parseFloat(currentSize);
                var newSize = currentSizeNum*1.1;
                $("td").css("font-size", newSize);
            });
            
            $(".decrease").on('click', function(){
                var currentSize = $("td").css("font-size");
                var currentSizeNum = parseFloat(currentSize);
                var newSize = currentSizeNum*0.9;
                console.log(newSize);
                $("td").css("font-size", newSize);
            });
        });
                //Prevents font size change reverting to default
                $( ".increase, .decrease" ).click(function( event ) {
        event.preventDefault();
        $( "<div>" )
            .append( "default " + event.type + " prevented" )
            .appendTo( "#log" );
        });

    </script>

    <script>
    //Dropdown menu
    function myFunction() {
        document.getElementById("myDropdown").classList.toggle("show");
    }
    window.onclick = function(event) {
        if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
            openDropdown.classList.remove('show');
            }
        }
        }
    }
    //Ensures that when page is refreshed, the form does not re submit-->
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
    </script>
</header>