<?php

class LinkComponents {
    public $Protocol;
    public $Domain;
    public $Path;
    public $Parameters;
}


function analyzeLink( $link ) {
    if (empty( $link )) {
        echo "Link is empty";
    } else {
        if ( filter_var ( $link, FILTER_VALIDATE_URL ) ) {
            $linkComponents = splitLink( $link );
            echo "<br>Analyzing link: $link\n";
            echo "<br>Protocol: $linkComponents->Protocol\n";
            echo "<br>Domain: $linkComponents->Domain\n";
            echo "<br>Path: $linkComponents->Path\n";
            echo "<br>Parameters: $linkComponents->Parameters\n";
            return "<br>Analysis complete";
        } else {
            echo "Invalid URL";
        }
    }
}

function splitLink( $link ){
    $protocolAndRest = explode("://", $link, 2);
    $protocol = $protocolAndRest[0];
    $restOfLink = $protocolAndRest[1] ?? "";

    $domainAndRest = explode( "/", $restOfLink, 2 );
    $domain = $domainAndRest[0];
    $rest = $domainAndRest[1] ?? "";

    $pathAndParameters = explode( "?", $rest, 2 );
    $path = $pathAndParameters[0];
    $parameters = $pathAndParameters[1] ?? "";

    $linkComponents = new LinkComponents();
    $linkComponents->Protocol = $protocol;
    $linkComponents->Domain = $domain;
    $linkComponents->Path = $path;
    $linkComponents->Parameters = $parameters;

    return $linkComponents;


}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css.css">
    <title>Document</title>
</head>
<body>
<div class="container">
        <div class="wrapper">
            <form action="link.php" method="post">
                <h1>A-Link</h1>
                <div class="input-box">
                    <input type="text" id="link" name="link" placeholder="your link: example : https://www.google.com/" required>
                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAjhJREFUSEuNlo112kAMx3/agBHoBO0IzQQlE0AnCExgMkGTCQITQDcgE5QNygjpBOrTnWzrzmdavZeHY+ST/h+SEe6FAAr+MWbGG+m6zIi37NpPaCRNiguCWs07MT3nbnrzy0nXE4wD7IAgHjUP2bOWwGfgC3ADeRf0lpGVvOYC/4iK8q0KHcpiBJKutsBrfVQo4Pw2RAsP7QU61+BV4KLCV1SekhtgB7zUXPj/EVopZqi5AC5+yCEwsgJOzs6nTFuma4pgXoo2kSN/1vkT8Aic++SigMOs/C5LQb+psHC//wSuQc4+P6OAZ2AftR7mYOJxYY/SjU0ONL6gshunMFF6UGGNyiNohaBhY8A4Xmce9ajCDcXsufaWc6c5NsAb8MesKzBYtpiDIOZBYO0b4LsX66kw7xvfRskHwgZNh1svOzS6qBB5YGqL8sO72YCcQc09J0i0XAO/G02dp9aOXqw3UNpR9SQvEX7ZEAEPbkl7wKjoXFjj2ugyJCsvdnSagnPbNl2pcEKxIbKJjcZKNmzMYdJibj5rBH2n2cv+VHBX6Fo+BD1r3kWze70usEF4MwSA7ZZJtA03VyCXjqvCNPjtC3+YSAdibjGKHtTcMxvTNVOmpuGSLtEi2EBdQE1MK2DxTB7A/wqZESdszYEUGyLTaNiWcV17Q9Nt01gDfZJNrYlqf+b9K8qtegeUBEdMvUFigdhFW8w51SPvsxrEF07ZymjT8p0R+ZggC6m1yHFJ3v3ZMocy3v8L0mYBLzEHyaIAAAAASUVORK5CYII="/>
                </div>
          
                <button type="submit" class="btn">Analizuj</button>
                <?php
                    if ( $_SERVER["REQUEST_METHOD"] == "POST" ) {
                        if ( isset( $_POST["link"]) ) {
                            $linkToAnalyse = $_POST["link"];
                            $analysisResult = analyzeLink( $linkToAnalyse );

                         
                            if ( $analysisResult instanceof LinkComponents ) {
                            
                             
                                echo "{ $analysisResult -> Protocol }";
                                echo "{ $analysisResult -> Domain }";
                                echo "{ $analysisResult -> Path }";
                                echo "{ $analysisResult -> Parameters }";
                                
                            
                            };
                        };
                    };
                ?>
        
            </form>
        

        </div>
    </div>
</body>
</html>
