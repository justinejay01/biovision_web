document.getElementById("btnloginReg").onclick = function () {
    document.getElementById('panelLogin').classList.add('d-none');
    document.getElementById('panelReg').classList.remove('d-none');
    gsap.from("#panelReg", { duration: 1, x: 300, opacity: 0, scale: 1 });
}

document.getElementById("btnregLogin").onclick = function () {
    document.getElementById('panelLogin').classList.toggle('d-none');
    document.getElementById('panelReg').classList.toggle('d-none');
    gsap.from("#panelLogin", { duration: 1, x: -300, opacity: 0, scale: 1 });
}

document.getElementById("formLogin").onsubmit = function () {
    var uname = document.getElementById("loginUname").value;
    var pword = document.getElementById("loginPword").value;

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText == uname) {
                var loginSuccess = document.getElementById("loginSuccess");
                loginSuccess.classList.remove("d-none");
                loginSuccess.classList.add("animate__fadeIn");

                document.getElementById("btnloginLogin").setAttribute("disabled", "");

                setTimeout(function () {
                    window.location.replace("index.php");
                }, 3000);
            } else {
                var loginFailed = document.getElementById("loginFailed");
                loginFailed.classList.remove("d-none");

                document.getElementById("btnloginLogin").setAttribute("disabled", "");

                if (loginFailed.classList.contains("animate__fadeOut")) {
                    loginFailed.classList.toggle("animate__fadeOut");
                }

                loginFailed.classList.toggle("animate__fadeIn");

                setTimeout(function () {
                    loginFailed.classList.toggle("animate__fadeIn");
                    loginFailed.classList.toggle("animate__fadeOut");
                }, 2500);
                setTimeout(function () {
                    loginFailed.classList.add("d-none");
                }, 3000);
                setTimeout(function () {
                    document.getElementById("btnloginLogin").removeAttribute("disabled");
                }, 3500);
                document.getElementById("loginPword").value = "";
            }
        }
    };
    xhr.open("POST", "auth/admin_login.php", true);
    xhr.setRequestHeader(
        "Content-Type",
        "application/x-www-form-urlencoded; charset=UTF-8"
    );
    xhr.send("username=" + uname + "&password=" + pword);
};

document.getElementById("formReg").onsubmit = function () {
    var id = document.getElementById("regSchoolID").value;
    var fname = document.getElementById("regFname").value;
    var lname = document.getElementById("regLname").value;
    var dept = document.getElementById("regDept").value;
    var uname = document.getElementById("regUname").value;
    var email = document.getElementById("regEmail").value;
    var pword = document.getElementById("regPword").value;

    var xhr = new XMLHttpRequest();
    try {
        xhr.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText == uname) {
                    var regSuccess = document.getElementById("regSuccess");
                    regSuccess.classList.remove("d-none");
                    regSuccess.classList.add("animate__fadeIn");
    
                    document.getElementById("btnregReg").setAttribute("disabled", "");
    
                    setTimeout(function () {
                        window.location.replace("auth.php");
                    }, 3000);
                } else if (this.responseText == "1") {
                    var regExist = document.getElementById("regExist");
                    regExist.classList.remove("d-none");
    
                    document.getElementById("btnregReg").setAttribute("disabled", "");
    
                    if (regExist.classList.contains("animate__fadeOut")) {
                        regExist.classList.toggle("animate__fadeOut");
                    }
    
                    regExist.classList.toggle("animate__fadeIn");
    
                    setTimeout(function () {
                        regExist.classList.toggle("animate__fadeIn");
                        regExist.classList.toggle("animate__fadeOut");
                    }, 2500);
                    setTimeout(function () {
                        regExist.classList.add("d-none");
                    }, 3000);
                    setTimeout(function () {
                        document.getElementById("btnregReg").removeAttribute("disabled");
                    }, 3500);
                    document.getElementById("regPword").value = "";
                } else {
                    var regError = document.getElementById("regError");
                    regError.innerHTML = this.responseText;
                    regError.classList.remove("d-none");
    
                    document.getElementById("btnregReg").setAttribute("disabled", "");
    
                    if (regError.classList.contains("animate__fadeOut")) {
                        regError.classList.toggle("animate__fadeOut");
                    }
    
                    regError.classList.toggle("animate__fadeIn");
    
                    setTimeout(function () {
                        regError.classList.toggle("animate__fadeIn");
                        regError.classList.toggle("animate__fadeOut");
                    }, 3000);
                    setTimeout(function () {
                        regError.classList.add("d-none");
                    }, 3000);
                    setTimeout(function () {
                        document.getElementById("btnregReg").removeAttribute("disabled");
                    }, 3500);
                    document.getElementById("regPword").value = "";
                }
            }
        };
        xhr.open("POST", "auth/admin_register.php", true);
        xhr.setRequestHeader(
            "Content-Type",
            "application/x-www-form-urlencoded; charset=UTF-8"
        );
        xhr.send("id=" + id + "&username=" + uname + "&password=" + pword + "&firstname=" + fname + "&lastname=" + lname + "&email=" + email + "&department=" + dept);
    } catch(e) {
        alert(e);
    }
};