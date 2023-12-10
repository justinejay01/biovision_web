//var btnQuizTimeline = document.getElementById("btnQuizTimeline");

//function showQuizTimeline(item) {
//    btnQuizTimeline.innerHTML = '<span data-feather="calendar"></span>' + item.innerHTML;
//}

document.addEventListener("DOMContentLoaded", function () {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("tbodyQuiz").innerHTML = this.responseText;
        }
    };
    xhr.open("GET", "../php/quiz_show.php", true);
    xhr.send();
});

function getFilterQuiz(item) {
    document.getElementById("dropdownFilterQuiz").innerHTML = item.innerHTML;
}

function filterQuiz() {
    // Declare variables
    var dropdown, input, filter, table, tr, td, i, txtValue;
    dropdown = document.getElementById("dropdownFilterQuiz").innerHTML;
    input = document.getElementById("searchQuiz");
    filter = input.value.toUpperCase();
    table = document.getElementById("tableQuiz");
    tr = table.getElementsByTagName("tr");

    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {
        if (dropdown == "ID")
            td = tr[i].getElementsByTagName("td")[0];
        else if (dropdown == "Category")
            td = tr[i].getElementsByTagName("td")[1];
        else td = tr[i].getElementsByTagName("td")[2];

        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}

function openModalEdit(rowIdx) {
    let table = document.getElementById('tableQuiz');
    let rows = table.rows;
    // Extract first & last Name
    let id = rows[rowIdx]['cells'][0].innerText;

    populateModal(id);

    var editQuiz = document.getElementById("editQuiz");
    var modal = new bootstrap.Modal(editQuiz);
    modal.show();
}

function populateModal(id) {
    var xhr = new XMLHttpRequest();
    xhr.onload = function () {
        if (this.readyState == 4 && this.status == 200) {
            var quiz = JSON.parse(this.responseText);
            document.getElementById("quizID_Edit").innerHTML = quiz.id;
            document.getElementById("quizCat_Edit").value = quiz.category;
            document.getElementById("quizQuestion_Edit").value = quiz.question;
            document.getElementById("quizChoices1_Edit").value = quiz.choices_1;
            document.getElementById("quizChoices2_Edit").value = quiz.choices_2;
            document.getElementById("quizChoices3_Edit").value = quiz.choices_3;
            document.getElementById("quizChoices4_Edit").value = quiz.choices_4;
            document.getElementById("quizAnswer_Edit").selectedIndex = parseInt(quiz.answer) - 1;
        }
    };
    xhr.open("GET", "../php/quiz_show.php?id=" + id);
    xhr.send();
}

function openModalDelete(rowIdx) {
    let table = document.getElementById('tableQuiz');
    let rows = table.rows;
    // Extract first & last Name
    let id = rows[rowIdx]['cells'][0].innerText;

    document.getElementById("quizID_Delete").innerHTML = id;

    var deleteQuiz = document.getElementById("deleteQuiz");
    var modal = new bootstrap.Modal(deleteQuiz);
    modal.show();
}

document.getElementById("quizAdd").onsubmit = function () {
    var quizCat = document.getElementById("quizCat_Add").value;
    var quizQuestion = document.getElementById("quizQuestion_Add").value;
    var quizChoices1 = document.getElementById("quizChoices1_Add").value;
    var quizChoices2 = document.getElementById("quizChoices2_Add").value;
    var quizChoices3 = document.getElementById("quizChoices3_Add").value;
    var quizChoices4 = document.getElementById("quizChoices4_Add").value;
    var quizAnswer = document.getElementById("quizAnswer_Add").value;

    var intAnswer = parseInt(quizAnswer);

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText == quizQuestion) {
                var success_Add = document.getElementById("success_Add");
                success_Add.classList.remove("d-none");
                success_Add.classList.add("animate__fadeIn");

                document.getElementById("btnConfirmAdd").setAttribute("disabled", "");

                setTimeout(function () {
                    window.location.replace("index.php");
                }, 3000);
            } else {
                var error_Add = document.getElementById("error_Add");
                error_Add.innerHTML = this.responseText;
                error_Add.classList.remove("d-none");

                document.getElementById("btnConfirmAdd").setAttribute("disabled", "");

                if (error_Add.classList.contains("animate__fadeOut")) {
                    error_Add.classList.toggle("animate__fadeOut");
                }

                error_Add.classList.toggle("animate__fadeIn");


                setTimeout(function () {
                    error_Add.classList.toggle("animate__fadeIn");
                    error_Add.classList.toggle("animate__fadeOut");
                }, 2500);
                setTimeout(function () {
                    error_Add.classList.add("d-none");
                }, 3000);
                setTimeout(function () {
                    document.getElementById("btnConfirmAdd").removeAttribute("disabled");
                }, 3500);
            }
        }
    };
    xhr.open("POST", "../php/quiz_add.php", true);
    xhr.setRequestHeader(
        "Content-Type",
        "application/x-www-form-urlencoded; charset=UTF-8"
    );
    xhr.send("quizCat=" + quizCat + "&quizQuestion=" + quizQuestion + "&quizChoices1=" + quizChoices1 + "&quizChoices2=" + quizChoices2 + "&quizChoices3=" + quizChoices3 + "&quizChoices4=" + quizChoices4 + "&quizAnswer=" + intAnswer);
}

document.getElementById("quizEdit").onsubmit = function () {
    var quizID = document.getElementById("quizID_Edit").innerHTML;
    var quizCat = document.getElementById("quizCat_Edit").value;
    var quizQuestion = document.getElementById("quizQuestion_Edit").value;
    var quizChoices1 = document.getElementById("quizChoices1_Edit").value;
    var quizChoices2 = document.getElementById("quizChoices2_Edit").value;
    var quizChoices3 = document.getElementById("quizChoices3_Edit").value;
    var quizChoices4 = document.getElementById("quizChoices4_Edit").value;
    var quizAnswer = document.getElementById("quizAnswer_Edit").selectedIndex + 1;

    //var intAnswer = parseInt(quizAnswer);

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText == quizQuestion) {
                var success_Edit = document.getElementById("success_Edit");
                success_Edit.classList.remove("d-none");
                success_Edit.classList.add("animate__fadeIn");

                document.getElementById("btnConfirmEdit").setAttribute("disabled", "");

                setTimeout(function () {
                    window.location.replace("index.php");
                }, 3000);
            } else {
                var error_Edit = document.getElementById("error_Edit");
                error_Edit.innerHTML = this.responseText;
                error_Edit.classList.remove("d-none");

                document.getElementById("btnConfirmEdit").setAttribute("disabled", "");

                if (error_Edit.classList.contains("animate__fadeOut")) {
                    error_Edit.classList.toggle("animate__fadeOut");
                }

                error_Edit.classList.toggle("animate__fadeIn");


                setTimeout(function () {
                    error_Edit.classList.toggle("animate__fadeIn");
                    error_Edit.classList.toggle("animate__fadeOut");
                }, 2500);
                setTimeout(function () {
                    error_Edit.classList.add("d-none");
                }, 3000);
                setTimeout(function () {
                    document.getElementById("btnConfirmEdit").removeAttribute("disabled");
                }, 3500);
            }
        }
    };
    xhr.open("POST", "../php/quiz_edit.php", true);
    xhr.setRequestHeader(
        "Content-Type",
        "application/x-www-form-urlencoded; charset=UTF-8"
    );
    xhr.send("quizID=" + quizID + "&quizCat=" + quizCat + "&quizQuestion=" + quizQuestion + "&quizChoices1=" + quizChoices1 + "&quizChoices2=" + quizChoices2 + "&quizChoices3=" + quizChoices3 + "&quizChoices4=" + quizChoices4 + "&quizAnswer=" + quizAnswer);
}

document.getElementById("btnConfirmDelete").onclick = function () {
    var quizID = document.getElementById("quizID_Delete").innerHTML;

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText == quizID) {
                var success_Delete = document.getElementById("success_Delete");
                success_Delete.classList.remove("d-none");
                success_Delete.classList.add("animate__fadeIn");

                document.getElementById("btnConfirmEdit").setAttribute("disabled", "");

                setTimeout(function () {
                    window.location.replace("index.php");
                }, 3000);
            } else {
                var error_Delete = document.getElementById("error_Delete");
                error_Delete.innerHTML = this.responseText;
                error_Delete.classList.remove("d-none");

                document.getElementById("btnConfirmEdit").setAttribute("disabled", "");

                if (error_Delete.classList.contains("animate__fadeOut")) {
                    error_Delete.classList.toggle("animate__fadeOut");
                }

                error_Delete.classList.toggle("animate__fadeIn");


                setTimeout(function () {
                    error_Delete.classList.toggle("animate__fadeIn");
                    error_Delete.classList.toggle("animate__fadeOut");
                }, 2500);
                setTimeout(function () {
                    error_Delete.classList.add("d-none");
                }, 3000);
                setTimeout(function () {
                    document.getElementById("btnConfirmEdit").removeAttribute("disabled");
                }, 3500);
            }
        }
    };
    xhr.open("POST", "../php/quiz_delete.php", true);
    xhr.setRequestHeader(
        "Content-Type",
        "application/x-www-form-urlencoded; charset=UTF-8"
    );
    xhr.send("quizID=" + quizID);
}