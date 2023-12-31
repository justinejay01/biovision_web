<?php
session_start();
if (!isset($_SESSION["teacher"])) {
    echo '<script>window.location.replace("../auth.php");</script>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="BioVision" />
    <meta name="author" content="BioVision" />
    <meta name="theme-color" content="#7952b3">

    <title>Students - BioVision</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/css/bootstrap.min.css" integrity="sha512-thoh2veB35ojlAhyYZC0eaztTAUhxLvSZlWrNtlV01njqs/UdY3421Jg7lX0Gq9SRdGVQeL8xeBp9x1IPyL1wQ==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" />
    <link href="https://getbootstrap.com/docs/5.0/examples/dashboard/dashboard.css" rel="stylesheet">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .center-block {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>

<body>
    <header class="navbar navbar-light sticky-top flex-md-nowrap p-0 shadow" style="background-color: #E0F5CF;">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="../">
            <img class="center-block" src="../assets/AppName.png" width="120px" alt="" srcset="">
        </a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
        <div class="navbar-nav" style="background-color: #73ff00;">
            <div class="nav-item text-nowrap">
                <a class="nav-link px-3" href="../auth/logout.php">Sign out</a>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="../">
                                <span data-feather="home"></span>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../quizzes">
                                <span data-feather="file-text"></span>
                                Quizzes
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../scores">
                                <span data-feather="percent"></span>
                                Scores
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../sections">
                                <span data-feather="users"></span>
                                Sections
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="../students">
                                <span data-feather="user"></span>
                                Students
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../reports">
                                <span data-feather="bar-chart-2"></span>
                                Reports
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../settings">
                                <span data-feather="settings"></span>
                                Settings
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Students</h1>

                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
                        </div>
                        <button id="btnQuizTimeline" class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span data-feather="calendar"></span>
                            All
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#" onclick="showQuizTimeline(this);">All</a></li>
                            <li><a class="dropdown-item" href="#" onclick="showQuizTimeline(this);">This Week</a></li>
                            <li><a class="dropdown-item" href="#" onclick="showQuizTimeline(this);">Last Week</a></li>
                            <li><a class="dropdown-item" href="#" onclick="showQuizTimeline(this);">Last Month</a></li>
                        </ul>
                    </div>
                </div>

                <div class="container d-none">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div style="font-weight: bold; font-size: 50px;">0</div>
                                    <div class="center-block">Total Students</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div style="font-weight: bold; font-size: 50px;">0</div>
                                    <div class="center-block">Total Sections</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div style="font-weight: bold; font-size: 50px;">0</div>
                                    <div class="center-block">Total Quizzes</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Quiz Name</th>
                                <th>Quantity</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Sample</td>
                                <td>1</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#editQuiz">Edit</button>
                                        <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteQuiz">Delete</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <br>
                <hr>

                <h2>Top Performing Students</h2>
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th scope="col">School ID</th>
                                <th scope="col">Rank</th>
                                <th scope="col">Name</th>
                                <th scope="col">Score</th>
                                <th scope="col">Percentage</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1,001</td>
                                <td>random</td>
                                <td>data</td>
                                <td>placeholder</td>
                                <td>text</td>
                            </tr>
                            <tr>
                                <td>1,002</td>
                                <td>placeholder</td>
                                <td>irrelevant</td>
                                <td>visual</td>
                                <td>layout</td>
                            </tr>
                            <tr>
                                <td>1,003</td>
                                <td>data</td>
                                <td>rich</td>
                                <td>dashboard</td>
                                <td>tabular</td>
                            </tr>
                            <tr>
                                <td>1,003</td>
                                <td>information</td>
                                <td>placeholder</td>
                                <td>illustrative</td>
                                <td>data</td>
                            </tr>
                            <tr>
                                <td>1,004</td>
                                <td>text</td>
                                <td>random</td>
                                <td>layout</td>
                                <td>dashboard</td>
                            </tr>
                            <tr>
                                <td>1,005</td>
                                <td>dashboard</td>
                                <td>irrelevant</td>
                                <td>text</td>
                                <td>placeholder</td>
                            </tr>
                            <tr>
                                <td>1,006</td>
                                <td>dashboard</td>
                                <td>illustrative</td>
                                <td>rich</td>
                                <td>data</td>
                            </tr>
                            <tr>
                                <td>1,007</td>
                                <td>placeholder</td>
                                <td>tabular</td>
                                <td>information</td>
                                <td>irrelevant</td>
                            </tr>
                            <tr>
                                <td>1,008</td>
                                <td>random</td>
                                <td>data</td>
                                <td>placeholder</td>
                                <td>text</td>
                            </tr>
                            <tr>
                                <td>1,009</td>
                                <td>placeholder</td>
                                <td>irrelevant</td>
                                <td>visual</td>
                                <td>layout</td>
                            </tr>
                            <tr>
                                <td>1,010</td>
                                <td>data</td>
                                <td>rich</td>
                                <td>dashboard</td>
                                <td>tabular</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    <!-- The Modal -->
    <div class="modal fade" id="deleteQuiz">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Delete Quiz</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    Are you sure you want to delete this quiz?
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-outline-danger">Yes</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">No</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
    <script src="https://getbootstrap.com/docs/5.0/examples/dashboard/dashboard.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/js/bootstrap.bundle.min.js" integrity="sha512-q2vREMvON/xrz1KuOj5QKWmdvcHtM4XNbNer+Qbf4TOj+RMDnul0Fg3VmmYprdf3fnL1gZgzKhZszsp62r5Ugg==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.0/gsap.min.js"></script>
    <script src="../assets/quizzes.js"></script>
</body>

</html>