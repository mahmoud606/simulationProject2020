<?php
require_once 'inventory.php';
$inventory=new Inventory();

if(isset($_POST['submit'])){
    $num=$_POST['name'];

}
if(isset($_POST['reset']))
{
    header('Location: http://localhost/index.php');
}
?>
<html lang="en">
    <head>

        <link rel="stylesheet" href="bootstrap.css">
        <link rel="stylesheet" href="style.css"/>
        <script src="jquery.js"></script>
        <script src="script.js"></script>
    </head>
    <body >
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Simulation</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
    <div class="title"><h1>Monet De Carlo Model </h1></div>

    <div class="box1 col-lg-12 5 col-sm-12">
        <div class="container ">

            <form name="add_name" id="add_name" method="post" class="form">
                <div class="table-responsive ">
                    <table class="table table-bordered" id="dynamic_field">
                        <tr>
                            <td><h2>Daily demand</h2></td>
                            <td><h2>Frequency</h2></td>
                        </tr>
                        <tr>
                            <td><input type="number" name="num1[]" placeholder="Enter your number" class="form-control name_list" required/></td>
                            <td><input type="number" name="name[]" placeholder="Enter your number" class="form-control name_list" required/></td>
                            <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>
                        </tr>
                    </table>

                    <div class="range">
                        <input class="input " name="range" type="search" placeholder="Range(days)" aria-label="Search">
                        <input type="submit"  name="submit" id="submit" class="btn btn-info" value="Submit" />
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="container">
        <?php if(isset($_POST['submit'])){?>
        <h1 align="center" style="font-family: 'Andalus'">Data calculated by your input</h1>
        <table class="table table-striped table-dark table-hover ">
            <thead>
            <tr>
                <td>daily demand</td>
                <td>probability</td>
                <td>cumulative probability</td>
                <td>Intervals</td>
            </tr>
            </thead>
            <tbody>
            <?php
            if(isset($_POST['submit']))
            {
                $len=count($_POST["name"]);
                $num=$_POST['name'];

                for($i=0;$i<$len;$i++)
                {
                    ?>
                    <tr>
                        <td><?= (int)$inventory->DailyDemand()[$i] ?></td>
                        <td><?= $inventory->calculate_probability($num)[$i]?></td>
                        <td><?= $inventory->calculate_cumulative($num)[$i]?></td>
                        <td><?= (int)$inventory->setInterval($num)[$i] ?></td>
                    </tr>
                    <?php
                }
            }
            ?>
            </tbody>
        </table>
    </div>
    <?php } ?>
    <?php if(isset($_POST['submit'])){?>
        <div class="box2 " >
            <div class="container table-bordered border-dark">
                    <div class="container-fluid" >
                        <p> the result simulation </p>
                        <table class="table table-striped table-dark table-hover ">
                            <thead >
                            <tr>
                                <td>days</td>
                                <td>random number</td>
                                <td>simulate</td>
                            </tr>
                            </thead>
                            <tbody>

                            <?php

                            if(isset($_POST['submit']))
                            {
                                if(isset($_POST['range']))
                                {
                                    $range=$_POST['range'];
                                    $len=$_POST['range'];

                                    for($i=0;$i<$len;$i++)
                                    {
                                        ?>
                                        <tr>
                                            <td><?=$i+1?></td>
                                            <?php $random=$inventory->random($range) ?>
                                            <td><?=$random[$i]?></td>
                                            <td><?=$inventory->simulate($range,$num,$random)[$i]?></td>
                                        </tr>
                                        <?php
                                    }?>
                                    <tr>
                                     <td>total</td>
                                     <td></td>
                                     <td> <?=$inventory->resultSimulation?></td>
                                    </tr>
                                    <?php
                                }

                            }
                            ?>
                            </tbody>
                        </table>
                    </div>

                <div class="result">
                    <p>Average daily Demand( simulation ): <?=$inventory->resultSimulation/$range?></p>
                    <p>Expected daily Demand :<?=$inventory->expectedDailyDemand($num) ?></p>
                </div>
                <form method="post" class="rest "> <input  type="submit" name="reset" value="reset" class="rest btn btn-danger btn-lg "/></form>
                </div>
            </div>

    <?php } ?>

    </body>






</html>
