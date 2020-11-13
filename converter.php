<?php 
    $thisPage = "Converter"; 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once './components/header.php'; ?>
    <!-- Title -->
    <title>The Cooking Corner | Cooking Conversion Calculator</title>
</head>

<body>
   <?php 
        if (isset($_SESSION["user_id"]) == false) {
            include('components/nav-bar-general.php');
        }
        else if ($_SESSION["user_id"] == true) {
            include('components/nav-bar-login.php');
        }
    ?>
    
    <div class="col-lg-12 p-l-0 title-margin-left">
         <div class="page-header">   
             <ol class="breadcrumb">
                     <li class="breadcrumb-item"><a href="index.php">Home</a></li>                                  
                 <li class="breadcrumb-item active">Cooking Conversion Calculator</li>
             </ol>
         </div>
     </div>
    
    <!-- ##### Breadcumb Area Start ##### -->
     <div class="breadcumb-area bg-img bg-overlay" style="background-image: url(img/bg-img/breadcumb7.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcumb-text text-center">
                        <h2>Cooking Conversion Calculator</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->
    <br/>
    <button name="Chart" class="chart" data-toggle="modal" data-target="#converter">Click here to View Cooking Conversion Chart</button>
    <br/><br/>
    
    <div class="modal fade" id="converter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
           <div class="modal-content">
                   <div class="modal-header">
                           <h4 class="modal-title" id="myModalLabel">Cooking Conversion Table Chart</h4>
                   </div>
                   <div class="modal-body">
                        <img src="img/core-img/converter.png"/>
                   </div>
                   <div class="modal-footer">
                           <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                   </div>
           </div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
	</div>
    
    <form name = "ConverTable">
    <table cellspacing=0 cellpadding=4 border=-1 bordercolor="#b2b2b2" class="center">
        <tr> 
          <th colspan=4 class="table-convert-header1">
              <h3 style="color:white;"><i class="fa fa-thermometer-full"></i> Temperature</h3>
          </th>
        </tr>
        <tr> 
          <th style="background-color: wheat !important; text-align: center;"><strong>Enter 
            value to convert</strong></th>
          <th style="background-color: wheat !important; text-align: center;"><strong>Conversion 
            factor</strong></th>
          <th style="background-color: wheat !important;"></th>
          <th style="background-color: wheat !important; text-align: center;"><strong>Result</strong> 
            </th>
        </tr>
        <tr bgcolor="#FFFFFF"> 
          <td>&nbsp;
            <input type="number" onchange = "document.ConverTable.ccelsius.value = 100/(212-32) * (this.value - 32 )" name="Input">
            &nbsp;Fahrenheit 
          </td>
            <td>
                &nbsp;( _ - 32) x 5/9 
            </td>
          <td> 
              <div class="calculate">&nbsp;=&nbsp;</div></td>
          <td> &nbsp;
            <input name="ccelsius" size=10 class="converter-result-box" onfocus="this.blur()">
            &nbsp;Celsius 
          </td>
        </tr>
        <tr> 
          <td> &nbsp;
            <input type="number" size=10 onchange = "document.ConverTable.cfahren.value = (212-32)/100 * this.value + 32 " name="Input2">
            &nbsp;Celsius
          </td>
          <td>
              &nbsp; x 9/5 + 32 
          </td>
           <td>
               <div class="calculate">&nbsp;=&nbsp;</div>
           </td>
           <td> &nbsp;
            <input name="cfahren" size=10 class="converter-result-box" onfocus="this.blur()">
            &nbsp;Fahrenheit 
           </td>
        </tr>
      </table>
        <br/>
        <p align="right">
            <button type="reset" name="Reset" class="reset">Reset</button>
        </p>
       <hr style="border: 1px solid black; margin-left: auto; margin-right: auto; width: 70%;">
    <table cellspacing=0 cellpadding=4 border=-1 bordercolor="#b2b2b2" class="center">
        <tr> 
            <th colspan=4 class="table-convert-header2">
                <h3 style="color:white;"><i class="fa fa-tint"></i> Liquid Volume</h3>
            </th>
        </tr>
        <tr> 
          <th style="background-color: wheat !important; text-align: center;">
            <strong>Enter value to convert</strong></th>
          <th style="background-color: wheat !important; text-align: center;">
              <strong>Conversion factor</strong></th>
          <th style="background-color: wheat !important;"></th>
          <th style="background-color: wheat !important; text-align: center;"> 
            <strong>Result</strong></th>
        </tr>
        <tr bgcolor="#FFFFFF"> 
          <td> &nbsp;
            <input type="number" onchange = "calc(this.value,29.574,'cml')" name="Input3">
            &nbsp;ounces 
          </td>
          <td> &nbsp; x 29.574 </td>
          <td>
              <div class="calculate">&nbsp;=&nbsp;</div>
          </td>
          <td> &nbsp;
            <input name="cml" size=10 class="converter-result-box" onfocus="this.blur()">
            &nbsp;milliliters 
          </td>
        </tr>
        <tr bgcolor="#FFFFFF"> 
          <td> &nbsp;
            <input type="number" onchange = "calc(this.value,473.176,'cliter')" name="Input3">
            &nbsp;pints 
          </td>
          <td> &nbsp; x 473.176 </td>
          <td>
              <div class="calculate">&nbsp;=&nbsp;</div>
          </td>
          <td> &nbsp;
            <input name="cliter" size=10 class="converter-result-box" onfocus="this.blur()">
            &nbsp;milliliters 
          </td>
        </tr>
        <tr bgcolor="#FFFFFF"> 
          <td> &nbsp;
            <input type="number" onchange = "calc(this.value,0.946,'cliter2')" name="Input3">
            &nbsp;quarts 
          </td>
          <td> &nbsp; x 0.946</td>
          <td>
              <div class="calculate">=</div>
          </td>
          <td> &nbsp;
            <input name="cliter2" size=10 class="converter-result-box" onfocus="this.blur()">
            &nbsp;liters 
          </td>
        </tr>
        <tr bgcolor="#FFFFFF"> 
          <td> &nbsp;
            <input type="number" onchange = "calc(this.value,3.785,'cliter3')" name="Input3">&nbsp;&nbsp;gallons&nbsp;(US)
          </td>
          <td> &nbsp; x 3.785</td>
          <td>
              <div class="calculate">&nbsp;=&nbsp;</div>
          </td>
          <td> &nbsp;
            <input name="cliter3" size=10 class="converter-result-box" onfocus="this.blur()">
            &nbsp;liters 
          </td>
        </tr>
        <tr> 
          <td> &nbsp;  
            <input type="number" onchange = "calc(this.value,0.034,'coz')" name="Input3">
            &nbsp;milliliters 
          </td>
          <td> &nbsp; x 0.034 </td>
          <td>
              <div class="calculate">&nbsp;=&nbsp;</div>
          </td>
          <td> &nbsp;
            <input name="coz" size=10 class="converter-result-box" onfocus="this.blur()">
            &nbsp;ounces 
          </td>
        </tr>
        <tr> 
          <td> &nbsp;
            <input type="number" onchange = "calc(this.value,2.113,'clit1')" name="Input3">
            &nbsp;liters
          </td>
          <td> &nbsp; x 2.113 </td>
          <td>
              <div class="calculate">&nbsp;=&nbsp;</div>
          </td>
          <td> &nbsp;
            <input name="clit1" size=10 class="converter-result-box" onfocus="this.blur()">
            &nbsp;pints
          </td>
        </tr>
        <tr> 
          <td> &nbsp;
            <input type="number" onchange = "calc(this.value,1.057,'cqts')" name="Input3">
            &nbsp;liters </td>

          <td> &nbsp; x 1.057 </td>
          <td>
              <div class="calculate">&nbsp;=&nbsp;</div>
          </td>
          <td> &nbsp;
            <input name="cqts" size=10 class="converter-result-box" onfocus="this.blur()">
            &nbsp;quarts</td>
        </tr>
        <tr bgcolor="#FFFFFF"> 
          <td> &nbsp;
            <input type="number" onchange = "calc(this.value,0.264,'cgal1')" name="Input3">
            &nbsp;liters
          </td>
          <td> &nbsp; x 0.264 </td>
          <td>
              <div class="calculate">&nbsp;=&nbsp;</div>
          </td>
          <td> &nbsp;
            <input name="cgal1" size=10 class="converter-result-box" onfocus="this.blur()">
            &nbsp;gallons (US)
          </td>
        </tr>
    </table>
        <br/>
        <p align="right">
            <button type="reset" name="Reset" class="reset">Reset</button>
        </p>
        <hr style="border: 1px solid black; margin-left: auto; margin-right: auto; width: 70%;">
        
        <table cellspacing=0 cellpadding=4 border=-1 bordercolor="#b2b2b2" class="center">
          <tr> 
            <th colspan=4 class="table-convert-header3">
                <h3 style="color:white;"><i class="fa fa-balance-scale"></i> Weight (Mass)</h3>
            </th>
                  </tr>
                  <tr> 
                    <th style="background-color: wheat !important; text-align: center;">
                        <strong>Enter value to convert</strong></th>
                    <th style="background-color: wheat !important; text-align: center;">
                        <strong>Conversion factor</strong></th>
                    <th style="background-color: wheat !important;"></th>
                    <th style="background-color: wheat !important; text-align: center;">
                        <strong>Result</strong>
                      </th>
                  </tr>
                  <tr bgcolor="#FFFFFF" bordercolor="#FFFFFF"> 
                    <td> &nbsp;
                      <input type="number" onchange = "calc(this.value,28.349,'cgrams')" name="Input4">
                      &nbsp;ounces
                    </td>
                    <td> &nbsp; x 28.349 </td>
                    <td>
                        <div class="calculate">&nbsp;=&nbsp;</div>
                    </td>
                    <td> &nbsp;
                      <input name="cgrams" size=10 class="converter-result-box" onfocus="this.blur()">
                    &nbsp;grams
                    </td>
                  </tr>
                  <tr> 
                    <td> &nbsp;
                      <input type="number" onchange = "calc(this.value,0.454,'ckgrams')" name="Input4">
                      &nbsp;pounds
                    </td>
                    <td> &nbsp; x 0.454 </td>
                    <td>
                        <div class="calculate">&nbsp;=&nbsp;</div>
                    </td>
                    <td> &nbsp;
                        <input name="ckgrams" size=10 class="converter-result-box" onfocus="this.blur()"> &nbsp;kilograms
                    </td>
                  </tr>
                  <tr> 
                    <td> &nbsp;
                      <input type="number" onchange = "calc(this.value,0.035,'cfloz')" name="Input4">
                      &nbsp;grams 
                    </td>
                    <td> &nbsp; x 0.035 </td>
                    <td>
                        <div class="calculate">&nbsp;=&nbsp;</div>
                    </td>
                    <td> &nbsp;
                      <input name="cfloz" size=10 class="converter-result-box" onfocus="this.blur()">
                      &nbsp;ounces 
                    </td>
                  </tr>
                  <tr> 
                    <td> &nbsp; 
                      <input type="number" onchange = "calc(this.value,2.205,'clbs')" name="Input4">
                      &nbsp;kilograms 
                    </td>
                    <td> &nbsp; x2.205 </td>
                    <td>
                        <div class="calculate">&nbsp;=&nbsp;</div>
                    </td>
                    <td> &nbsp;
                      <input name="clbs" size=10 class="converter-result-box" onfocus="this.blur()">
                      &nbsp;pounds 
                    </td>
                  </tr>
                </table>
        <br/>
          <p align="right">
            <button type="reset" name="Reset" class="reset">Reset</button>
          </p>
    </form>
    
    <?php require_once './components/footer.php'; ?>

    <?php require_once './components/js-include-bottom.php'; ?>
    
    <script type='text/javascript'>	
        function calc(val,factor,putin) { 
            if (val == "") {
		val = "0"
            }
	evalstr = "document.ConverTable."+putin+ ".value = "
	evalstr = evalstr + val + "*" + factor
	eval(evalstr)}
    </script>
