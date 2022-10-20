<?php
    include '../functions.php';
    ini_set('memory_limit', '-1');
    $obj = new myFunctions;

    //$startDate = strtotime('2021-07-22');
    $endDate = strtotime(date("Y-m-d"));
    $enddatetry = date_sub(date_create(date("Y-m-d")),date_interval_create_from_date_string("42 days"));
    $resultdate = date_format($enddatetry,"Y-m-d");
    $startDate = strtotime($resultdate);
    //echo date_format($enddatetry,"Y-m-d");
    $weekidentifier = 0;
    $weekdayNumber = 0;

    $dateArr = array();

    do
    {
        if(date("w", $startDate) != $weekdayNumber)
        {
            $startDate += (24 * 3600); // add 1 day
        }
    } while(date("w", $startDate) != $weekdayNumber);


    while($startDate <= $endDate)
    {
        $dateArr[] = date('Y-m-d', $startDate);
        $startDate += (7 * 24 * 3600); // add 7 days
    }

    $datearray = array_reverse($dateArr);
    foreach($datearray as $dates) {
        $weekidentifier = $weekidentifier + 1;
        echo '<div class="seasonalproducts">';
            echo '<div class="seasonheader iphonessection">';
                echo 'WEEK ENDING - '.$dates;
            echo '</div>';
            echo '<div class="seasonproducts">';
                echo '<div class="tablediv">';
                    echo '<div class="tablerowdiv">';
                        echo '<div class="tablecelldiv">';
                        $countresults = $obj->getselectedreportdatacount($dates);
?>
                            <input type="hidden" value="<?php echo $dates; ?>" id="<?php echo 'enddate'.$weekidentifier;?>">
                            <input type="hidden" value="week" id="<?php echo 'reportspan'.$weekidentifier;?>">
                            <input type="hidden" value="<?php echo $dates; ?>" id="<?php echo 'reportingperiod'.$weekidentifier;?>">
                            <div class="indicatorwrap">
                                <div class="indicatoritem">
                                    <div class="indicatortitle">HTS</div>
                                    <div class="indicatorbody">
                                        <span>TST - <?php echo $countresults[0]["htstotal"]; ?></span>
                                        <span>TST_POS - <?php echo $countresults[0]["htspostotal"]; ?></span>
                                    </div>
                                </div>
                                <div class="indicatoritem">
                                    <div class="indicatortitle">ART</div>
                                    <div class="indicatorbody">
                                        <span>TxCURR - <?php echo $countresults[0]["txcurrtotal"]; ?></span>
                                        <span>TxNEW - <?php echo $countresults[0]["txnewtotal"]; ?></span>
                                        <span>TxRTT - <?php echo $countresults[0]["txrtttotal"]; ?></span>
                                        <span>TIs - <?php echo $countresults[0]["transferintotal"]; ?></span>
                                        <span>TOs - <?php echo $countresults[0]["transferouttotal"]; ?></span>
                                        <span>Deaths - <?php echo $countresults[0]["deathstotal"]; ?></span>
                                        <span>LTFU - <?php echo $countresults[0]["ltfutotal"]; ?></span>
                                    </div>
                                </div>
                                <div class="indicatoritem">
                                    <div class="indicatortitle">VLs</div>
                                    <div class="indicatorbody">
                                        <span>Valid - <?php echo $countresults[0]["validvlstotal"]; ?></span>
                                        <span>Due - 0</span>
                                        <span>No VL - 0</span>
                                        <span>Suppressed - <?php echo $countresults[0]["suppressedtotal"]; ?></span>
                                        <span>High - <?php echo $countresults[0]["highvltotal"]; ?></span>
                                    </div>
                                </div>
                                <div class="indicatoritem">
                                    <div class="indicatortitle">PMTCT</div>
                                    <div class="indicatorbody">
                                        <span>PMTCT_ART - 0</span>
                                        <span>PMTCT_EID - 0</span>
                                        <span>HEI_POS - 0</span>
                                        <span>PMTCT_STAT - 0</span>
                                    </div>
                                </div>
                                <div class="indicatoritem">
                                    <div class="indicatortitle">TB</div>
                                    <div class="indicatorbody">
                                        <span>TB_ART - 0</span>
                                        <span>TX_TB - 0</span>
                                    </div>
                                </div>
                                <div class="indicatoritem">
                                    <div class="indicatortitle">PREP</div>
                                    <div class="indicatorbody">
                                        <span>PREP_CURR - 0</span>
                                    </div>
                                </div>
                                <div class="indicatoritem">
                                    <div class="indicatortitle">Appointments</div>
                                    <div class="indicatorbody">
                                        <span>ALL - <?php echo $countresults[0]["appointmentstotal"]; ?></span>
                                        <span>MISSED - <?php echo $countresults[0]["honouredappointmentstotal"]; ?></span>
                                        <span>HONOURED - <?php echo $countresults[0]["missedappointmentstotal"]; ?></span>
                                    </div>
                                </div>
                                <div class="indicatoritem">
                                    <div class="indicatortitle">D. Tracing</div>
                                    <div class="indicatorbody">
                                        <span>Traced - <?php echo $countresults[0]["tracingtotal"]; ?></span>
                                        <span>Returned - 0</span>
                                        <span>Unknown - 0</span>
                                        <span>Terminated - 0</span>
                                    </div>
                                </div>
                                <div class="indicatoritem">
                                    <div class="indicatortitle">CaCx</div>
                                    <div class="indicatorbody">
                                        <span>All Screened - 0</span>
                                        <span>Negative - 0</span>
                                        <span>Positive - 0</span>
                                        <span>Presumptive - 0</span>
                                    </div>
                                </div>
                                <div class="indicatoritem">
                                    <div class="indicatortitle">OVC</div>
                                    <div class="indicatorbody">
                                        <span>All Enrolled - <?php echo $countresults[0]["ovctotal"]; ?></span>
                                        <span>On ART - <?php echo $countresults[0]["ovcarttotal"]; ?></span>
                                        <span>Non ART - 0</span>
                                        <span>Comprehensive - <?php echo $countresults[0]["ovccomprehensivetotal"]; ?></span>
                                        <span>Preventive - 0</span>
                                        <span>Dreams - 0</span>
                                    </div>
                                </div>
                            </div>
<?php                        
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
            echo '<div class="productcategorylink">';
                $userprivilegesarray = unserialize($_COOKIE['userprivileges']);
                if(in_array("Refresh Data", $userprivilegesarray)){
                    echo '<button class="refreshdatabtn" id="refreshdata'.$weekidentifier.'"><i class="fa fa-circle-o-notch" aria-hidden="true"></i> Refresh Data</button>';
                }
            echo '</div>';
            echo '<div class="refreshstatus">';
                
            echo '</div>';
        echo '</div>';
    }
?>