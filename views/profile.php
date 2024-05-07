<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Form</title>
</head>
<body>
<form id="myForm" action="/profile/change" method="post">

    <?php foreach ($data as $k=>$v):?>
    <div>
        <label for="<?php echo $k;?>"><?php echo $k;?></label>
        <input type="<?php echo $k;?>" id="<?php echo $k;?>" name="<?php echo $k;?>" value="<?php echo $v;?>" >
    </div>

    <?php endforeach;?>

    <br/><button type="submit">Изменить</button>
</form><br>

</body>

<script>
    window.onload = function() {


        let inputs = document.querySelectorAll('input');
        let list_status= {};
        let input_login=document.getElementById('login');
        let original_val

        function deleteLabel(id) {
            let obj = document.getElementById(`label_${id}`);
            if (obj) {
                obj.remove();
            }
        }

        function makeLabel(id, responseText, e) {

            if (document.getElementById(`label_${id}`)) {
                document.getElementById(`label_${id}`).remove();
            }

            let label = document.createElement('label');
            label.innerText = `${responseText}`;
            label.setAttribute('for', `${id}`);
            label.setAttribute('id', `label_${id}`);
            e.target.parentNode.appendChild(label);

        }

        function changeStatus(id, status) {
            list_status[`${id}`] = status;
        }

        function checkAcess(data) {
            let count = Object.values(data).reduce((acc, curr) => curr === "error" ? acc + 1 : acc, 0);
            if (count > 1) {
                console.log('close');
                document.querySelector('form').onsubmit = function () {
                    return false;
                };
            } else {
                document.querySelector('form').onsubmit = function () {
                    return true;
                };
                console.log('open');
            }
        }

        inputs.forEach(inp=>{
            inp.addEventListener('focus', (e)=>{
                 original_val=e.target.value;
            });
        });

        inputs.forEach(inp => {
            inp.addEventListener('input', (e) => {

                let ajax = new XMLHttpRequest();
                let str = e.target.value;
                let id = e.target.getAttribute("id");
                let formData = `${id}=${str}`;

                ajax.open("POST", `http://registration/model_registration/validate`, true);
                ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

                if(original_val.trim().toLowerCase() == e.target.value.trim().toLowerCase() ){
                    deleteLabel(id);
                    return false;
                    console.log(`${original_val}`);
                }

                ajax.onreadystatechange = function () {
                    if (this.readyState === 4 && this.status === 200) {
                        if (this.responseText.trim().toLowerCase() == "success") {
                            deleteLabel(id);
                            changeStatus(id, "success");
                            checkAcess(list_status);
                        } else {
                            changeStatus(id, "error");
                            makeLabel(id, this.responseText, e);
                        }

                    } else {
                        console.log(ajax.statusText);
                    }
                };

                ajax.send(formData);
            });
        });
    };
</script>

</html>
