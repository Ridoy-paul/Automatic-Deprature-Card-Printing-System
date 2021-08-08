<?php require_once("backend/config.php"); ?>
<!doctype html>
<html >
  <head>
    <meta charset="utf-8">
    <meta name="robots" content="noindex,nofollow">

    <title>Invoice &bull; Fara IT Fusion &bull; </title>

    <!--<link rel="apple-touch-icon" sizes="180x180" href="https://dmrokfxvkn5v8.cloudfront.net/public/wavicon/apple-touch-icon.png">-->
    <!--<link rel="icon" type="image/png" href="https://dmrokfxvkn5v8.cloudfront.net/public/wavicon/favicon-32x32.png" sizes="32x32">-->
    <!--<link rel="icon" type="image/png" href="https://dmrokfxvkn5v8.cloudfront.net/public/wavicon/favicon-16x16.png" sizes="16x16">-->
    <!--<link rel="manifest" href="https://dmrokfxvkn5v8.cloudfront.net/public/wavicon/site.webmanifest">-->
    <!--<link rel="mask-icon" href="https://dmrokfxvkn5v8.cloudfront.net/public/wavicon/safari-pinned-tab.svg" color="#308df8">-->
    <!--<link rel="shortcut icon" href="https://dmrokfxvkn5v8.cloudfront.net/public/wavicon/favicon.ico">-->
    <meta name="theme-color" content="#ffffff">
    <meta name="msapplication-square150x150logo" content="https://dmrokfxvkn5v8.cloudfront.net/public/wavicon/mstile-150x150.png">
    <meta name="msapplication-square310x310logo" content="https://dmrokfxvkn5v8.cloudfront.net/public/wavicon/mstile-310x310.png">
    <meta name="msapplication-square70x70logo" content="https://dmrokfxvkn5v8.cloudfront.net/public/wavicon/mstile-70x70.png">
    <meta name="msapplication-wide310x150logo" content="https://dmrokfxvkn5v8.cloudfront.net/public/wavicon/mstile-310x150.png">
    <meta name="msapplication-TileColor" content="#2d89ef">

    <link rel="stylesheet" href="https://d3pgswpng8id0l.cloudfront.net/sitestatic/vendor/bootstrap/css/bootstrap-responsive.min.css">
    <link rel="stylesheet" href="https://d3pgswpng8id0l.cloudfront.net/sitestatic/vendor/font-awesome/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://d3pgswpng8id0l.cloudfront.net/sitestatic/css/40b050d98268.css" type="text/css" />

    <link rel="stylesheet" href="https://dmrokfxvkn5v8.cloudfront.net/19.6.0/buoyant-app.css">

    <style type="text/css">
  .accent-text-color {
    color: #444444 !important;
  }
  .accent-bg-color {
      background: #444444 !important;
    
      color: #fff !important;
    
  }
  .accent-bg-color * {
    color: inherit !important;
  }
  .separate-info tr td:nth-child(2) {
    text-align: right !important;
  }
  .border-top {
    border-top: 1px solid #ccc !important;
  }
  .border-bottom {
    border-bottom: 1px solid #ccc !important;
  }
  .wv-modal__header .wv-close--large {
    right: 16px;
    top: 24px;
  }
  @media print {
  #printPageButton {
    display: none;
  }
}
</style>


</head>

  <body class="nextcontemporary">

    <?php
    $Invoiceid=$_GET['Invoiceid'];
    $query=query("SELECT * FROM `project` WHERE id='$Invoiceid' ");
    $row=fetch_array($query);
    $projectId=$row['id'];
    
    //payment
    $payment_query_for_Client_id=query("SELECT * FROM `payment` WHERE project_id='$projectId' order by id desc");
    $payment_fetch_for_Client_id=fetch_array($payment_query_for_Client_id);
    $client_id_fetch_for_payment=$payment_fetch_for_Client_id['client_id'];
    
    //client fetch
    $Client_Id_select=query("SELECT * FROM `clients` WHERE id='$client_id_fetch_for_payment' ");
    $fetch_Client_Id_for_client=fetch_array($Client_Id_select);
    ?>

    <!-- Google Tag Manager -->
    <noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-6XSR"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    '//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-6XSR');</script>
    <!-- End Google Tag Manager -->
    

    

    <div id="Container" class=" ">
      <div id="ReadOnlyMain" class="payments-disabled horizontal-redesign">
        <div class="iframe-parent">
        
          <div class="wv-spinner--centered">
            <div class="wv-spinner wv-spinner--large"></div>
          </div>
        <div class="readonly-payment-information__nav-actions">
                  
  <!--<button class="wv-button--secondary js-print-button">Print</button>-->
 
  <a  type="button" id="printPageButton" class="wv-button--secondary js-print-button"  onclick="window.print()">Print</a>
  <!--<button class="wv-button--secondary js-export-button">Download PDF</button>-->
  
    
      <!--<div class="wv-dropdown js-receipts-button">-->
      <!--  <button class="wv-dropdown__toggle wv-button--secondary">-->
      <!--    Receipts <svg class="wv-svg-icon"><use xlink:href="#open-menu" href="#open-menu"></use></svg>-->
      <!--  </button>-->
      <!--  <ul class="wv-dropdown__menu">-->
          
      <!--      <li class="wv-dropdown__menu__item">-->
      <!--        <a class="wv-dropdown__menu__link" href="/invoices/7591415/readonly/1080545967368833383/595638556E2F586E796D7A2F3569745075716B71464A4A3465736F71634365/receipt/1080546158117390728" onclick='return window.WaveAnalytics.track(AMPLITUDE_AR_INVOICE_EVENT_PREFIX + "/receipt/submitted",  invoiceEventProperties);'>-->
      <!--          Dec. 1, 2020-->
      <!--        </a>-->
      <!--      </li>-->
          
      <!--  </ul>-->
      <!--</div>-->
    
  
  

                </div>
          <div class="container-fluid non-mobile">
            <div class="row-fluid">
              <div id="ReadOnlyControls" class="span12 no-container-margin">
                
<!--<div id="AuthorizationHeader" style="display:none;">-->

<!--  <div class="readonly-payment-information">-->
<!--    <div class="wv-heading--title readonly-payment-information__title">-->
      
<!--        Credit card pre-authorization request from Fara IT Fusion-->
      
<!--    </div>-->
<!--    <div class="readonly-payment-information__details">-->
<!--      <div class="readonly-payment-information__details__items">-->
<!--        Invoice Amount:-->
<!--        ৳30,000.00-->
<!--      </div>-->
<!--      <div class="readonly-payment-information__details__items readonly-payment-information__details__items--separator"></div>-->
<!--      <div class="readonly-payment-information__details__items">-->
<!--        Due on:-->
<!--        December 1st 2020-->
<!--      </div>-->
<!--      <div class="readonly-payment-information__details__items readonly-payment-information__details__items--separator"></div>-->
<!--      <div class="readonly-payment-information__details__items">-->
<!--        Repeats:-->
        
<!--      </div>-->
<!--    </div>-->
<!--  </div>-->
<!--</div>-->

              </div>
            </div>
            <div class="row-fluid">
              <div id="ReadOnlyView" class="span12 read-only-view">
                



<!-- invoice start -->
<div id="NextContemporary" class="export-template">
  <section class="contemporary-template__header">
    <div class="contemporary-template__header__logo">
      
        <img class="contemporary-template__business-logo" src="https://wave-prod-accounting.s3.amazonaws.com/uploads/invoices/business_logos/b1d81332-b971-4be3-855e-83e14d549a00.png"/>
      
    </div>
    <div class="contemporary-template__header__info">
      <div class="wv-heading--title">INVOICE</div>
      <div class="wv-heading--subtitle"></div>
      <span class="wv-text--strong">Fara IT Fusion</span>
      
        <div class="contemporary-template__header__info__address">
          Dhaka
            <br>
            Bangladesh<br>
            <br>
             Mobile: 01703235615<br>





  <span class="wrappable">faraitfusion.com<br></span>



        </div>
      
    </div>
  </section>

  <div class="contemporary-template__divider contemporary-template__divider--full-width"></div>

  <section class="contemporary-template__metadata">
    <div class="contemporary-template__metadata__customer">
      <div class="contemporary-template__metadata__customer--billing">
        <div class="contemporary-template__metadata__customer__address-header">BILL TO</div>
        <span class="wv-text--strong"><?php echo $fetch_Client_Id_for_client['name'];?></span>
        
          <div class="contemporary-template__metadata__customer__address">
              <?php echo $fetch_Client_Id_for_client['companyAddress'];?>

                <br>
                  <?php echo $fetch_Client_Id_for_client['phone'];?><br>
                <?php echo $fetch_Client_Id_for_client['email'];?><br>

</div>
        
      </div>
      
    </div>

    <div class="invoice-template-details">
      <table class="wv-table">
        <tr class="wv-table__row">
          <td class="wv-table__cell">
            <strong class="wv-text--strong">Invoice Number:</strong>
          </td>
          <td class="wv-table__cell">
            <span><?php echo $payment_fetch_for_Client_id['id'];?></span>
          </td>
        </tr>
        
        <tr class="wv-table__row">
          <td class="wv-table__cell">
            <strong class="wv-text--strong">Invoice Date:</strong>
          </td>
          <td class="wv-table__cell">
            <span><?php echo date("F jS, Y", strtotime($payment_fetch_for_Client_id['date'])) ?></span>
          </td>
        </tr>
       
      </table>
   </div>
  </section>

  <div class="contemporary-template__items">
    <table class="wv-table">
      <thead class="wv-table__header" style="background-color: #444444;">
        <tr class="wv-table__row">
          <th class="wv-table__cell" colspan="4" style="color: #FFFFFF;">Items</th>
          <th class="wv-table__cell--smaller contemporary-template__items__column--center" colspan="1" style="color: #FFFFFF;"><?php echo $row['unit'];?></th>
          <th class="wv-table__cell--amount" colspan="1" style="color: #FFFFFF;">Price</th>
          <th class="wv-table__cell--amount" colspan="1" style="color: #FFFFFF;">Amount</th>
        </tr>
      </thead>
      <tbody class="wv-table__body">
        
          <tr class="wv-table__row">
            <td class="wv-table__cell invoice-product-name" colspan="4">
              <span class="wv-text--strong"><?php echo $row['projectName'];?></span>
              
                <p class="wv-table__cell--nested invoice-product-description">
                  Domain: <?php echo $row['domainName'];?><br /><?php echo $row['note'];?>
                </p>
              
            </td>
            <?php
            //$TOTAL=$row['quantity']*$row['price'];
            ?>
              <td class="wv-table__cell contemporary-template__items__column--center" colspan="1">
                <span><?php echo $row['quantity'];?></span>
              </td>
            
            
              <td class="wv-table__cell--amount" colspan="1">
                <span>৳<?php //echo number_format($row['amount'])?> <?php echo number_format($row['price'])?></span>
              </td>
            
            
              <td class="wv-table__cell--amount" colspan="1">
                <span>৳<?php echo number_format($row['amount'])?><?php //echo number_format($TOTAL);?></span>
              </td>
            
          </tr>
        
      </tbody>
    </table>
  </div>

  <div class="contemporary-template__divider contemporary-template__divider--full-width contemporary-template__divider--bold"></div>

  <div>
    



<section class="contemporary-template__totals">
  <div class="contemporary-template__totals__blank"></div>
  <div class="contemporary-template__totals__amounts">

    

    <div class="contemporary-template__totals__amounts__line">
      <div class="contemporary-template__totals__amounts__line__label">
        <strong>Total:</strong>
      </div>
      <div class="contemporary-template__totals__amounts__line__amount">
        <WaveText>
          ৳<?php echo number_format($row['amount'])?>
        </WaveText>
      </div>
    </div>

    <?php
    $Invoiceid=$_GET['Invoiceid'];
    $query=query("SELECT * FROM `project` WHERE id='$Invoiceid' ");
    $row=fetch_array($query);
    $projectId=$row['id'];
    
    $total_sumQ = query("SELECT SUM(paying_amount) AS totalPaid FROM `payment` WHERE project_id='$projectId'");
    $totalPaidSum = fetch_array($total_sumQ);
    $totalSum = $totalPaidSum['totalPaid'];
    
    $subTract=$row['amount']-$totalPaidSum['totalPaid'];
    
    
    
    
    
    //payment
    $Payment_query=query("SELECT * FROM `payment` WHERE project_id='$projectId' ");
          while($project_row=fetch_array($Payment_query))
          {
              
              $due_amount=$project_row['due_amount'];
              $project_date=$project_row['date'];
              $Project_date=date("jS F, Y", strtotime("$project_date"));
              //
              ?>
              <div class="contemporary-template__totals__amounts__line">
      <div class="contemporary-template__totals__amounts__line__label">
          
        <span>
            
  Payment on <?php echo $Project_date;?>
     using
    
      cash:
    
  
</span>

      </div>
      <div class="contemporary-template__totals__amounts__line__amount">
        <span>
          ৳<?php echo number_format($project_row['paying_amount']);?>
        </span>
      </div>
    </div>
              <?php
          }
          ?>
    
    


    <div class="contemporary-template__divider contemporary-template__divider--bold contemporary-template__divider--small-margin"></div>

    <div>
      <div class="contemporary-template__totals__amounts__line">
        <div class="contemporary-template__totals__amounts__line__label">
          <strong>
            Amount Due
            
              (BDT)
            :
          </strong>
        </div>
        <div class="contemporary-template__totals__amounts__line__amount">
          <strong>
            
              ৳<?php echo number_format($subTract)?>
            
          </strong>
        </div>
      </div>
    </div>

  </div>
</section>

  </div>

  

  
    <div class="contemporary-template__footer"><span class="wv-text wv-text--fine-print">Address: Shah Ali Plaza, Level - 10, Mirpur - 10, Dhaka Phone: 01703235615</span></div>
  
</div>
<!-- invoice end -->

                

                
              </div>
            </div>
          </div>
         
        </div>
      </div>

    </div>
<script>
    // function printlayer(layer)
    // {
    //     var generator=window.open(",'name,");
    //     var layertext=document.getElementById(layer);
    //     generator.document.write(layertext.innerHTML.replace("Print Me"));
    //     generator.document.close();
    //     generator.print();
    //     generator.close();
    // }
    
    function PrintPreview(){
        window.print();
    }
</script>
   

  </body>
</html>
