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

    <title>Quizzes - BioVision</title>

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
                            <a class="nav-link active" href="../quizzes">
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
                            <a class="nav-link" href="../students">
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
                    <h1 class="h2">Quizzes</h1>

                    <div class="btn-toolbar mb-2 mb-md-0">

                        <button type="button" class="btn btn-sm btn-outline-primary me-2" data-bs-toggle="modal" data-bs-target="#addQuiz">Add Quiz</button>
                        <div class="btn-group me-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
                        </div>

                        <!--
                        <button id="btnQuizTimeline" class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span data-feather="calendar"></span>
                            All
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#" onclick="showQuizTimeline(this);">All</a></li>
                            <li><a class="dropdown-item" href="#" onclick="showQuizTimeline(this);">This Week</a></li>
                            <li><a class="dropdown-item" href="#" onclick="showQuizTimeline(this);">Last Week</a></li>
                            <li><a class="dropdown-item" href="#" onclick="showQuizTimeline(this);">Last Month</a></li>
                        </ul>-->
                    </div>
                </div>

                <div class="input-group mb-3">
                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="dropdownFilterQuiz">Category</button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#" onclick="getFilterQuiz(this);">ID</a></li>
                        <li><a class="dropdown-item" href="#" onclick="getFilterQuiz(this);">Category</a></li>
                        <li><a class="dropdown-item" href="#" onclick="getFilterQuiz(this);">Question</a></li>
                    </ul>
                    <input type="text" class="form-control" placeholder="Search" id="searchQuiz" onkeyup="filterQuiz();">
                </div>

                <div class="table-responsive">
                    <table class="table table-hover" id="tableQuiz">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Category</th>
                                <th>Question</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="tbodyQuiz">
                        </tbody>
                    </table>
                </div>

                <br>
                <hr>
            </main>
        </div>
    </div>

    <!--Add Quiz-->
    <div class="modal fade" id="addQuiz" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <form id="quizAdd" action="javascript:void(0);" method="post">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Quiz</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="alert alert-success animate__animated d-none" id="success_Add">
                                    Added Successfully!
                                </div>
                                <div class="alert alert-danger animate__animated d-none" id="error_Add">
                                    Error!
                                </div>
                                <div class="col-12 mb-2">
                                    <label for="quizCat_Add" class="form-label">Category</label>
                                    <select class="form-control form-select" id="quizCat_Add">
                                        <option>Prokaryotic Cell</option>
                                        <option>Eukaryotic Cell</option>
                                        <option>Cell Types</option>
                                        <option>Cell Cycle</option>
                                    </select>
                                </div>
                                <div class="col-12 mb-2">
                                    <label for="quizQuestion_Add" class="form-label">Question</label>
                                    <input type="text" class="form-control" id="quizQuestion_Add" placeholder="" value="" required="">
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <label for="quizChoices1_Add" class="form-label">Choices #1</label>
                                    <input type="text" class="form-control" id="quizChoices1_Add" placeholder="" value="" required="">
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <label for="quizChoices2_Add" class="form-label">Choices #2</label>
                                    <input type="text" class="form-control" id="quizChoices2_Add" placeholder="" value="" required="">
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <label for="quizChoices3_Add" class="form-label">Choices #3</label>
                                    <input type="text" class="form-control" id="quizChoices3_Add" placeholder="" value="" required="">
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <label for="quizChoices4_Add" class="form-label">Choices #4</label>
                                    <input type="text" class="form-control" id="quizChoices4_Add" placeholder="" value="" required="">
                                </div>
                                <div class="col-12 mb-2">
                                    <label for="quizAnswer_Add" class="form-label">Answer</label>
                                    <select class="form-control form-select" id="quizAnswer_Add">
                                        <option value="1">Choices #1</option>
                                        <option value="2">Choices #2</option>
                                        <option value="3">Choices #3</option>
                                        <option value="4">Choices #4</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="btn-group">
                            <button type="submit" class="btn btn-sm btn-outline-primary" id="btnConfirmAdd">Confirm</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal" id="btnCancelAdd">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--Edit Quiz-->
    <div class="modal fade" id="editQuiz" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">

                <form id="quizEdit" action="javascript:void(0);" method="post">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Quiz</h4>
                        <div class="d-none" id="quizID_Edit"></div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="alert alert-success animate__animated d-none" id="success_Edit">
                                    Edited Successfully!
                                </div>
                                <div class="alert alert-danger animate__animated d-none" id="error_Edit">
                                    Error!
                                </div>
                                <div class="col-12 mb-2">
                                    <label for="quizCat_Edit" class="form-label">Quiz Category</label>
                                    <select class="form-control form-select" id="quizCat_Edit">
                                        <option>Prokaryotic Cell</option>
                                        <option>Eukaryotic Cell</option>
                                        <option>Cell Types</option>
                                        <option>Cell Cycle</option>
                                    </select>
                                </div>
                                <div class="col-12 mb-2">
                                    <label for="quizQuestion_Edit" class="form-label">Question</label>
                                    <input type="text" class="form-control" id="quizQuestion_Edit" placeholder="" value="" required="">
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <label for="quizChoices1_Edit" class="form-label">Choices #1</label>
                                    <input type="text" class="form-control" id="quizChoices1_Edit" placeholder="" value="" required="">
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <label for="quizChoices2_Edit" class="form-label">Choices #2</label>
                                    <input type="text" class="form-control" id="quizChoices2_Edit" placeholder="" value="" required="">
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <label for="quizChoices3_Edit" class="form-label">Choices #3</label>
                                    <input type="text" class="form-control" id="quizChoices3_Edit" placeholder="" value="" required="">
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <label for="quizChoices4_Edit" class="form-label">Choices #4</label>
                                    <input type="text" class="form-control" id="quizChoices4_Edit" placeholder="" value="" required="">
                                </div>
                                <div class="col-12 mb-2">
                                    <label for="quizAnswer_Edit" class="form-label">Answer</label>
                                    <select class="form-control form-select" id="quizAnswer_Edit">
                                        <option>Choices #1</option>
                                        <option>Choices #2</option>
                                        <option>Choices #3</option>
                                        <option>Choices #4</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="btn-group">
                            <button type="submit" class="btn btn-sm btn-outline-primary" id="btnConfirmEdit">Confirm</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal" id="btnCancelEdit">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--Delete Quiz-->
    <div class="modal fade" id="deleteQuiz" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete Quiz</h4>
                    <div class="d-none" id="quizID_Delete"></div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">

                    <div class="alert alert-success animate__animated d-none" id="success_Delete">
                        Deleted Successfully!
                    </div>
                    <div class="alert alert-danger animate__animated d-none" id="error_Delete">
                        Error!
                    </div>

                    Are you sure you want to delete this quiz?
                </div>
                <div class="modal-footer">
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-outline-danger" id="btnConfirmDelete">Yes</button>
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