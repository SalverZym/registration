<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Form</title>

</head>
<body>
<form id="myForm" action="" method="post">

    <div>
    <label for="login">Имя</label>
    <input type="text" id="login" name="login">
    </div>

    <div>
    <br/><label for="tel">Телефон</label>
    <input type="tel" id="tel" name="tel">
    </div>

    <div>
    <br/><label for="email">Почта</label>
    <input type="email" id="email" name="email">
    </div>

    <div>
    <br/><label for="password">Пароль</label>
    <input type="password" id="password" name="password">
    </div>

    <div>
    <br/><label for="password">Повторите пароль</label>
    <input type="password" id="clone">
    </div>

    <br/><button type="submit">Добавить</button>
</form><br>

</body>
<script>

    let inputs=document.querySelectorAll('input');
    inputs.pop;

    let clone_inp=document.getElementById("clone");
    let pass=document.getElementById('password');
    let list_status= {};

    document.querySelector('form').onsubmit = function() {
        return false;
    };

    function makeLabel(id, responseText, e){

        if(document.getElementById(`label_${id}`)){
            document.getElementById(`label_${id}`).remove();
        }

        let label=document.createElement('label');
        label.innerText=`${responseText}`;
        label.setAttribute('for', `${id}`);
        label.setAttribute('id', `label_${id}`);
        e.target.parentNode.appendChild(label);

    }

    function changeStatus(id, status){
        list_status[`${id}`]=status;
    }

    function checkAcess(data){
        let count=Object.values(data).reduce((acc, curr) => curr === "success" ? acc + 1 : acc, 0);
        if(count == 5){
            console.log('open');
            document.querySelector('form').onsubmit = function() {
                return true;
            };
        }else {
            console.log('close');
        }
    }

    function deleteLabel(id){
        let obj=document.getElementById(`label_${id}`);
        if(obj) {
            obj.remove();
        }
    }

    clone_inp.addEventListener('input', (e)=>{
        if(e.target.value===pass.value){
            changeStatus("clone", "success");
            checkAcess(list_status);
        }else{
            changeStatus("clone", "error");
            makeLabel('clone', "Пароли должны совпадать", e);
        }

    });

    inputs.forEach(inp=>{
        inp.addEventListener('input', (e)=>{

            let ajax=new XMLHttpRequest();
            let str=e.target.value;
            let id=e.target.getAttribute("id");
            let formData=`${id}=${str}`;

            ajax.open("POST", `http://registration/model_registration/validate`, true);
            ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            ajax.onreadystatechange = function() {
                if(this.readyState === 4 && this.status === 200) {
                    if(this.responseText.trim().toLowerCase() == "success"){
                        deleteLabel(id);
                        changeStatus(id, "success");
                        checkAcess(list_status);
                    }else {
                        changeStatus(id, "error");
                        makeLabel(id, this.responseText, e);
                    }

                }else {
                    console.log(ajax.statusText);
                }
            };

            ajax.send(formData);
        });
    });



</script>

</html>
