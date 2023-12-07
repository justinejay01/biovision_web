var btnQuizTimeline = document.getElementById("btnQuizTimeline");

function showQuizTimeline(item) {
    btnQuizTimeline.innerHTML = '<span data-feather="calendar"></span>' + item.innerHTML;
}