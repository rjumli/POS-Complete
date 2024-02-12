<template>
    <Head title="Login" />
    <div class="auth-page-wrapper py-5 d-flex justify-content-center align-items-center min-vh-100">
        <div class="auth-page-content">
            <b-container>

                <b-row class="justify-content-center">
                <b-col md="8" lg="6" xl="5">
                    <b-card no-body class="mt-4">
                        <b-card-body class="p-4">
                            <a class="d-flex align-items-center mb-3">
                                <div class="flex-shrink-0">
                                    <img :src="currentUrl+'/images/avatars/'+user.data.avatar" alt="" class="avatar-sm rounded-circle img-thumbnail">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="fs-14 mb-0">{{user.data.firstname}} {{user.data.lastname}}</h6>
                                    <p class="text-muted mb-0">{{user.data.role}}</p>
                                </div>
                            </a>
                            <div id="leadDiscovered3" class="collapse border-top border-top-dashed show" is-nav="false">
                                <div class="p-2 mt-2">
                                    <form class="customform">
                                        <div class="mb-3">
                                            <label class="form-label" for="password-input">Password</label>
                                            <div class="position-relative auth-pass-inputgroup">
                                                <input v-model="password" type="password" class="form-control pe-5 password-input"
                                                    onpaste="return false" placeholder="Enter password"
                                                    id="password-input" aria-describedby="passwordInput"
                                                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                                                <b-button variant="link"
                                                    class="position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                                    type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i>
                                                </b-button>
                                            </div>
                                            <div id="passwordInput" class="form-text">Must be at least 8 characters.
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="confirm-password-input">Confirm
                                                Password</label>
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <input v-model="password_confirmation" type="password" class="form-control pe-5 password-input"
                                                    onpaste="return false" placeholder="Confirm password"
                                                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                                    id="confirm-password-input" required>
                                                <b-button variant="link"
                                                    class="position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                                    type="button" id="confirm-password-input"><i class="ri-eye-fill align-middle"></i>
                                                </b-button>
                                            </div>
                                        </div>

                                        <div id="password-contain" class="p-3 bg-light mb-2 rounded">
                                            <h5 class="fs-13">Password must contain:</h5>
                                            <p id="pass-length" class="invalid fs-12 mb-2">Minimum <b>8 characters</b>
                                            </p>
                                            <p id="pass-lower" class="invalid fs-12 mb-2">At <b>lowercase</b> letter
                                                (a-z)</p>
                                            <p id="pass-upper" class="invalid fs-12 mb-2">At least <b>uppercase</b>
                                                letter (A-Z)</p>
                                            <p id="pass-number" class="invalid fs-12 mb-0">A least <b>number</b> (0-9)
                                            </p>
                                        </div>


                                        <div class="mt-4">
                                            <b-button variant="success" class="w-100" @click="submit" type="submit">Reset Password</b-button>
                                        </div>

                                    </form>
                                </div>
                            </div>

                        </b-card-body>
                    </b-card>

                </b-col>
                </b-row>
            </b-container>
        </div>

      
  </div>
</template>
<script>
export default {
    layout: null,
    props: ['user','token'],
    data(){
        return {
            currentUrl: window.location.origin,
            email: this.user.data.email,
            password: '',
            password_confirmation: '',
            form: {}
        }
    },
    methods: {
        submit(){
            this.form = this.$inertia.form({
                token: this.token,
                email: this.email,
                password: this.password,
                password_confirmation: this.password_confirmation
            })

            this.form.post('/reset-password',{
                preserveScroll: true,
                onSuccess: (response) => {
                    this.hide();
                },
            });
        },
        validatePassword() {
            // passowrd match
            var password = document.getElementById("password-input"),
                confirm_password = document.getElementById("confirm-password-input");

            //Password validation

            if (password.value != confirm_password.value) {
                confirm_password.setCustomValidity("Passwords Don't Match");
            } else {
                confirm_password.setCustomValidity("");
            }
        }
    },
    mounted() {
        var password = document.getElementById("password-input");
        password.onchange = this.validatePassword;
        document.querySelectorAll("form .auth-pass-inputgroup")
            .forEach(function (item) {
                item.querySelectorAll(".password-addon").forEach(function (subitem) {
                    subitem.addEventListener("click", function () {
                        var passwordInput = item.querySelector(".password-input");
                        if (passwordInput.type === "password") {
                            passwordInput.type = "text";
                        } else {
                            passwordInput.type = "password";
                        }
                    });
                });
            });



        var myInput = document.getElementById("password-input");
        var letter = document.getElementById("pass-lower");
        var capital = document.getElementById("pass-upper");
        var number = document.getElementById("pass-number");
        var length = document.getElementById("pass-length");

        // When the user clicks on the password field, show the message box
        myInput.onfocus = function () {
            document.getElementById("password-contain").style.display = "block";
        };

        // When the user clicks outside of the password field, hide the password-contain box
        myInput.onblur = function () {
            document.getElementById("password-contain").style.display = "none";
        };

        // When the user starts to type something inside the password field
        myInput.onkeyup = function () {
            // Validate lowercase letters
            var lowerCaseLetters = /[a-z]/g;
            if (myInput.value.match(lowerCaseLetters)) {
                letter.classList.remove("invalid");
                letter.classList.add("valid");
            } else {
                letter.classList.remove("valid");
                letter.classList.add("invalid");
            }

            // Validate capital letters
            var upperCaseLetters = /[A-Z]/g;
            if (myInput.value.match(upperCaseLetters)) {
                capital.classList.remove("invalid");
                capital.classList.add("valid");
            } else {
                capital.classList.remove("valid");
                capital.classList.add("invalid");
            }

            // Validate numbers
            var numbers = /[0-9]/g;
            if (myInput.value.match(numbers)) {
                number.classList.remove("invalid");
                number.classList.add("valid");
            } else {
                number.classList.remove("valid");
                number.classList.add("invalid");
            }

            // Validate length
            if (myInput.value.length >= 8) {
                length.classList.remove("invalid");
                length.classList.add("valid");
            } else {
                length.classList.remove("valid");
                length.classList.add("invalid");
            }
        };
    },
}
</script>
<style>
.auth-page-wrapper {
    background-color: #299cdb;
}
</style>