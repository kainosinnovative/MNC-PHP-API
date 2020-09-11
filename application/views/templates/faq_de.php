<!DOCTYPE html>
<html lang="en">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Faq</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <body>
        <style>
            /*******************************
* Does not work properly if "in" is added after "collapse".
* Get free snippets on bootpen.com
*******************************/
            .panel-group .panel {
                border-radius: 0;
                box-shadow: none;
                border-color: #EEEEEE;
            }

            .panel-default > .panel-heading {
                padding: 0;
                border-radius: 0;
                color: #545454;
                background-image:linear-gradient(to bottom,#f5f5f5 0,#e8e8e8 100%);
                font-family: 'CenturyGothic';
            }


            .panel-title {
                font-size: 14px;
            }

            .panel-title > a {
                display: block;
                padding: 15px;
                text-decoration: none;
            }

            .more-less {
                float: right;
                color: #545454;
            }

            .panel-default > .panel-heading + .panel-collapse > .panel-body {
                border-top-color: #EEEEEE;
                text-align:justify;
                color:#545454;
                font-family: 'CenturyGothic';
            }

            /* ----- v CAN BE DELETED v ----- */

            .demo {
                padding-top: 20px;
                padding-bottom: 60px;
            }

            article[role="login"] {
                background: #fff;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
                -webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 10px rgba(0, 0, 0, 0.24);
                webkit-transition: all 400ms cubic-bezier(0.4, 0, 0.2, 1);
                transition: all 400ms cubic-bezier(0.4, 0, 0.2, 1);
                padding: 30px 50px;
                margin-bottom: 20px;
            }

            article[role="login"] input[type="submit"] {
                /*padding: 10px 15px;*/
                font-size: 16px;
            }

            article[role="login"]:hover {
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
                -webkit-box-shadow: 0 10px 20px rgba(0, 0, 0, 0.19), 0 1px 15px rgba(0, 0, 0, 0.23);
                webkit-transition: all 400ms cubic-bezier(0.4, 0, 0.2, 1);
                transition: all 400ms cubic-bezier(0.4, 0, 0.2, 1);
            }

            article[role="login"] h3 {
                font-size: 26px;
                font-weight: 300;
                color: #d44c26;
                margin-bottom: 20px;
            }

            article[role="login"] p {
                font-size: 16px;
                padding: 5px 15px;
            }

            .nav-tab-holder {
                padding: 0 0 0 30px;
                float: right;
            }

            .nav-tab-holder .nav-tabs {
                border: 0;
                float: none;
                display: table;
                table-layout: fixed;
                width: 100%;
            }

            .nav-tab-holder .nav-tabs > li {
                margin-bottom: -3px;
                text-align: center;
                padding: 0;
                display: table-cell;
                float: none;
                padding: 0;
            }

            .nav-tab-holder .nav-tabs > li > a {
                background: #d9d9d9;
                color: #6c6c6c;
                margin: 0;
                font-size: 15px;
                font-weight: 300;
            }

            .nav-tab-holder .nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
                color: #FFF;
                background-color: #d44c26;
                border: 0;
                border-radius: 0;
            }

            .mobile-pull {
                float: right;
            }

            article[role="manufacturer"] {
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
                -webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 10px rgba(0, 0, 0, 0.24);
                padding: 0 0 40px;
                max-width: 420px;
                margin: -45px auto 0;
            }

            article[role="manufacturer"] header {
                background: #d44c26;
                color: #fff;
                padding: 10px;
                font-size: 18px;
                font-weight: 300;
            }

            article[role="manufacturer"] h1 {
                font-size: 26px;
                font-weight: 300;
                border-bottom: 1px solid #f2f2f2;
                padding: 25px 15px;
            }

            article[role="manufacturer"] ul {
                padding: 0 25px;
            }

            article[role="manufacturer"] ul li {
                font-size: 16px;
                border-bottom: 1px solid #eaeaea;
                padding: 20px 15px;
                color:#404040;
            }

            article[role="manufacturer"] ul li i {
                color: #d44c26;
            }

            .login-signup {
                padding: 0 0 25px;
            }

            @media only screen and (max-width: 767px) {
                .mobile-pull {
                    float: none;
                }

                .nav-tab-holder {
                    float: none;
                    overflow: hidden;
                }

                .nav-tabs > li > a {
                    font-size: 13px;
                    font-weight: 600;
                    padding: 10px 5px;
                    overflow: hidden;
                    text-overflow: ellipsis;
                }

                .nav-tabs > li {
                    width: 50%;
                }
            } 
            //d44c26


        </style>
        
        <div class="container demo" style="padding:5px;font-family: 'CenturyGothic';">

            <div class="container"  style="padding:5px;">
                <div class="login-signup">
                    <div class="row">
                        <div class="col-sm-12 nav-tab-holder">
                            <ul class="nav nav-tabs row" role="tablist">
                                <li role="presentation" class="active col-sm-6"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Probefahrt machen</a></li>
                                <li role="presentation" class="col-sm-6"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Probefahrt anbieten</a></li>
                            </ul>
                        </div>

                    </div>


                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="home">
                            <div class="panel-group" style="padding:5px;" id="accordion" role="tablist" aria-multiselectable="true">
                                <?php
                                $i = 1;
                                foreach ($faq2 as $faq_res) {
                                    ?>
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="hheading<?php echo $i; ?>">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" data-parent="#aaccordion<?php echo $i; ?>" href="#ccollapse<?php echo $i; ?>" aria-expanded="true" aria-controls="collapse<?php echo $i; ?>">
                                                    <i class="more-less glyphicon glyphicon-chevron-right"></i>
                                                    <?php echo $faq_res['heading']; ?>
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="ccollapse<?php echo $i; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo $i; ?>">
                                            <div class="panel-body">
                                                <?php echo $faq_res['description']; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $i++;
                                }
                                ?>
                                        
                                       
                            </div><!-- panel-group -->
                        </div>
                        <!-- end of home -->

                        <div role="tabpanel" class="tab-pane" id="profile">

                            <div class="panel-group" style="padding:5px;" id="accordion" role="tablist" aria-multiselectable="true">
                                <?php
                                $i = 1;
                                foreach ($faq1 as $faq_res) {
                                    ?>
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="hhheading<?php echo $i; ?>">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" data-parent="#aaaccordion<?php echo $i; ?>" href="#cccollapse<?php echo $i; ?>" aria-expanded="true" aria-controls="cccollapse<?php echo $i; ?>">
                                                    <i class="more-less glyphicon glyphicon-chevron-right"></i>
                                                    <?php echo $faq_res['heading']; ?>
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="cccollapse<?php echo $i; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="hhheading<?php echo $i; ?>">
                                            <div class="panel-body">
                                                <?php echo $faq_res['description']; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $i++;
                                }
                                
                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- panel-group -->

                        </div>
                    </div>
                </div>







            </div><!-- container -->

        

-->
    </body>

</html>



