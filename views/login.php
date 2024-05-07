<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Form</title>
    <script src="https://smartcaptcha.yandexcloud.net/captcha.js" defer></script>

</head>
<body>

<form id="myForm" action="" method="post">

    <div>
        <label for="login">Имя</label>
        <input type="text" id="login" name="login" placeholder="Ввведите логин или email" >
    </div>

    <div>
        <br/><label for="password">Пароль</label>
        <input type="password" id="password" name="password">
    </div>
    <?php if($label):?>
        <div><?php echo $label;?></div>
    <?php endif;?>

    <div
            id="captcha-container"
            class="smart-captcha"
            data-sitekey="ysc1_6LH2lnI4pD3VpUFoqZmfluhwgi2YBkZAiymMkPju94a9065f"
    ></div>

    <br/><button type="submit">Добавить</button>
</form><br>

</body>

<script>

    document.querySelector('form').onsubmit = function() {
        return false;
    };

    window.onload=function () {

        let inputElement = document.querySelector('input[name="smart-token"]');

        console.log(inputElement.value);

        let observer = new MutationObserver(function (mutationsList) {
            for (let mutation of mutationsList) {
                if (mutation.type === 'attributes' && mutation.attributeName === 'value') {

                    let tokenValue = mutation.target.value;

                    let ajax = new XMLHttpRequest();

                    ajax.open("GET", `http://registration/check_capcha/validate?token=${tokenValue}`, true);
                    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

                    ajax.onreadystatechange = function () {
                        if (this.readyState === 4 && this.status === 200) {
                            if (this.responseText.trim().toLowerCase() == "passed") {

                                document.querySelector('form').onsubmit = function() {
                                    return true;
                                };

                            } else {
                                console.log('robot')
                            }

                        } else {
                            console.log(ajax.statusText);
                        }
                    };

                    ajax.send();
                }
            }
        });

        observer.observe(inputElement, {attributes: true});

    }
</script>

</html>
