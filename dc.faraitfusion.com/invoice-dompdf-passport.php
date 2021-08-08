<?php require_once("backend/config.php"); ?>

<?php
// Include autoloader 
require_once 'dompdf/autoload.inc.php'; 
 
// Reference the Dompdf namespace 
use Dompdf\Dompdf; 
 
// Instantiate and use the dompdf class 
$dompdf = new Dompdf();

?>
<?php

    $passPortNum = $_GET['passPortNum'];
              $flightNum = $_GET['flightNum'];
    
    
    // //Shop Details Query
    $query = query("SELECT * FROM passportInfo WHERE flightNum = '$flightNum' AND passportNum='$passPortNum'");
    confirm($query);
    $row = fetch_array($query);
    
    $name = $row['name'];
    $sex = $row['sex'];
    $dateOfBirth = $row['dateOfBirth'];
    $nationality = $row['nationality'];
    $passportNum = $row['passportNum'];
    $passportExpiryD = $row['passportExpiryD'];
    $flightNum = $row['flightNum'];
    $dateOfDeparture = $row['dateOfDeparture'];
    $addressInBDforF = $row['addressInBDforF'];
    $visaNum = $row['visaNum'];
    $visaDateOfExpiry = $row['visaDateOfExpiry'];
    $typeOfVisa = $row['typeOfVisa'];
    $purposeOfVisit = $row['purposeOfVisit'];
                            
    
      
?>    
<?php $html = '
                     
            <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    
                    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
                    <title>Document</title>
                    
                    <style>
                    
                     @page {
                     
                    
                     
                     }
                            
                            @font-face {
                            font-family: "kalpurush";
                            font-style: normal;
                            font-weight: normal;
                            src: url(font/Kalpurush.ttf) format("truetype");
                            }
                            * {
                                font-family: "kalpurush";
                            }
                    
                    
                    p{
                        font-size: 13px;
                    }
                    
                    
                    </style>
                </head>
                <body>
                 
                     <section>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12" >
                                    <img src="media/passbackground.png" alt="Girl in a jacket" width="299" height="422" >
                                    <h1>Hello</h1>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-10">
                                    <p style="margin-top: 62px; margin-left: 50px;">'.$name.'</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7"><p style="margin-left: 5px;">'.$sex.'</p></div>
                                <div class="col-md-5">
                                    <p style="margin-left: 250px; height: 300px;">'.$dateOfBirth.'</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-10">
                                    <p style="margin-left: 70px; margin-top: -10px; ">'.$nationality.'</p>
                                </div>
                            </div>
                            
                        </div>
                    </section>
        
    
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    
    <script type="text/javascript"> 
         window.addEventListener("load", window.print());
     </script>
    
</body>

</html>';?>



<?php

                     ob_end_clean();
                     
                     $f;
$l;
if(headers_sent($f,$l))
{
    echo $f,'<br/>',$l,'<br/>';
    die('now detect line');
}
   
                     
                     $dompdf->loadHtml($html);
                     
                     
                    //  $dompdf->setPaper('A4','portrait');
                    
                    $dompdf->set_paper(array(0, 0, 299, 422), 'portrait');
                     
                     $dompdf->render();
                     
                     
                     $dompdf->stream("$client_name",array("Attachment"=>0));
                     
                     
                     
                     
?>