<?php
// $user =  $this->session->userdata();
// echo "<pre>";print_r($user['email']);exit;
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title>Header</title>
    <style>
        .navbar {
            background-color: rgb(50, 50, 50);
            color: white;
            height: auto;
            width: 100%;
            padding-left: 60px;
            padding-right: 60px;
            display: block;
        }

        header img {
            float: left
        }

        .navbar-nav1 {
            flex-direction: row;
        }

        .btn {
            color: white;
        }

        .btn:hover {
            color: white;
            border-bottom: 2px solid white;
        }

        .btn1 {
            border: 2px solid white;
        }

        .btn1:hover {
            color: black;
            background-color: white;
        }

        @media screen and (max-width:700px) {
            .navbar .container-fluid {
                flex-direction: column;
            }
        }

        @media screen and (max-width:525px) {
            .container-fluid div a {
                float: none;
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div>
        <header>
            <nav class="navbar">
                <div class="container-fluid">
                    <div>
                        <h1>Clone</h1>
                    </div>
                    <div class="nav navbar-nav1">
                        <h4><?php $abc =  $this->session->userdata('user');

                            // echo "<pre>"; print_r($abc); exit;
                            $id_sel = $abc['email'];
                            echo $id_sel; ?><h4>
                                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                <h5><a href="logout">LogOut</a></h5>
                    </div>
                </div>
            </nav>
        </header>

        <div class="container-fluid">
            <div class="row flex-nowrap">
                <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                    <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                        <a href="" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                            <span class="fs-5 d-none d-sm-inline"><a href="post_back">Post</a></span>
                        </a>
                        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                            <li class="nav-item">
                                <a href="#" class="nav-link align-middle px-0">
                                    <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline"><a href="post_list">Post List</a></span>
                                </a>
                            </li>

                        </ul>

                        <hr>

                    </div>
                </div>
                <div class="col py-3">
                    <main class="content-wrapper">
                        <div class="page-content">
                            <div class="row">
                                <div class="col-xs-12">
                                    <!-- PAGE CONTENT BEGINS -->
                                    <?php echo $contents; ?>
                                    <!-- PAGE CONTENT ENDS -->
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                        </div><!-- /.page-content -->
                </div>
            </div><!-- /.main-content -->
            </main>
        </div>
    </div>
    <footer class="bg-light text-center text-lg-start">

        <div class="text-center p-3" style="background-color: rgb(0, 0, 0);">
            <h1 style="color: white;">Footer</h1>

        </div>

    </footer>
    </div>

    </div>
</body>

</html>