<?php 

    define("DBHOST", "localhost");
    define("DBNAME","shippify-clothes");
    define("DBUSER","MotasemAli");
    define("DBPASS","Simon1110");

    function db_connect($dbhost = DBHOST,$dbname = DBNAME, $dbuser = DBUSER, $dbpass = DBPASS){
        $connectionString = "mysql:host=$dbhost;dbname=$dbname";

        try{
            $pdo = new PDO($connectionString, $dbuser, $dbpass);
        return $pdo;
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }

    function displayHead(){
       $headerHTML = <<<REC
        <header>
            <nav>
            <img src="images/logo.png" alt="logo" height="40" width="40" />
            <span>Shippify</span>
            </nav>
            <h1>Welcome to Shippify</h1>
            <p>
            one of the best stores you could ever visit in your entire life<br />no
            need to go to a thousends of stores
            </p>
            <hr/>
         </header>
    REC;
        return $headerHTML;
    }

    function displayFooter(){
        $footerHTML = <<<REC
        <footer>
            <h2>Contact Details</h2>
            <p>Last update date: 4/6/2024</p>
            <p>Address: Tulkarm/Kuffer Jammal/Secondary school street</p>
            <h3>Customer Support:</h3>
            <nav>
                <ul>
                    <li>Telephone Number: +972 546 697 525</li>
                    <li>Email: shippify@gmail.com</li>
                </ul>
            </nav>
        </footer>
     REC;
         return $footerHTML;
     }
    
?>