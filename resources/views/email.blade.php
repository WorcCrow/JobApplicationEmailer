<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body{
            background:
            
            radial-gradient(circle farthest-side at -5% -15%, #ff000036 20%,transparent 30%),
            radial-gradient(circle farthest-side at 40% 40%, #ff000036 20%,transparent 50%),
            radial-gradient(circle farthest-side at 130% 90%, #9f0b6e30 30%,transparent 40%),
            linear-gradient(135deg,#de00ff,#b700ce,#5000aa);
            margin:0px;
        }
        .container{
            display:flex;
            justify-content: center;
            align-items:center;
            height:100vh;
        }
        input{
            font-family: inherit;
            font-size:1em;
            margin-bottom:10px;
            padding:10px 20px 5px 20px;
            background:transparent;
            border:none;
            color:white;
        }
        input::placeholder{
            color:#ff74fc;
        }
        input.error{
            box-shadow:0px 0px 4px 2px red;
        }
        input:focus{
            outline: none;
            box-shadow: 0 15px 5px -15px #7100b6;
            //border-bottom: 1px solid #7100b6;
        }
    
        input[type='submit']{
            margin-top:10px;
            background:#a002027d;
            padding:10px 20px;
            border-radius:15px 40px 15px 40px;
            box-shadow:inset 1px 1px 5px 0px #ef7dff;
        }
        
        [application]{
            display:flex;
            flex-direction:column;
            background:
            rgba(112, 237, 255, 0.18);
            box-shadow:inset 5px 5px 20px -10px #f49dff,
                        5px 5px 20px -10px #3b0142;
            padding:5% 5% 2% 5%;
            border-radius:5px;
            width:80vw;
            max-width:500px;
            margin-top:-200px;
            //rgba(217,0,255,0.5)
        }

        .dropdown{
            display:flex;
            flex-direction:column;
            position:relative;
            font-size:1em;
            margin-bottom:10px;
            padding:10px 20px 5px 20px;
        }

        .dropdown > div{
            cursor:pointer;
            color:#ff74fc;
        }

        .dropdown .icon{
            display:inline-block;
            width:0.5em;
            float:right;
            fill:#ff74fc;
        }

        .dropdown .items{
            display:none;
            font-size:0.8em;
            position:absolute;
            width:100%;
            box-sizing:border-box;
            background:#7b2bc29e;
            border-radius: 0px 0px 5px 5px;
            backdrop-filter: blur(10px);
        }
        .dropdown .items.active{
            display:block;
        }

        .dropdown .items > .item{
            padding:0.5em 1em;
        }
        .dropdown .items > .item:hover{
            background:#7b2bc2;
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="{{ route('send_application') }}" method="POST">
            <div application>   
                <div class="dropdown">
                    <div>
                        <span class='selected'>Template</span>
                        <span class='icon'>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M192 384c-8.188 0-16.38-3.125-22.62-9.375l-160-160c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L192 306.8l137.4-137.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-160 160C208.4 380.9 200.2 384 192 384z"/></svg>
                        </span>
                    </div>
                    <div style="position:relative">
                        <div class="items">
                            <div class="item" data-value="IT">IT Specialist</div>
                            <div class="item" data-value="PHP">PHP Developer</div>
                            <div class="item" data-value="QA">QA Tester</div>
                        </div>
                    </div>
                </div>
                @csrf
                <input class="@error('receiver')error @enderror" value="{{ old('receiver') }}" type="text" name="receiver" placeholder="Receiver" autocomplete="off">
                <input class="@error('name')error @enderror" value="{{ old('name') }}" type="text" name="name" placeholder="Sender Name" autocomplete="off">
                <input class="@error('subject')error @enderror" value="{{ old('subject') }}" type="text" name="subject" placeholder="Subject" autocomplete="off">
                <input class="@error('position')error @enderror" value="{{ old('position') }}" type="text" name="position" placeholder="Position" autocomplete="off">
                <center>
                    <input type="submit" value="Send Application">
                </center>
                @if (Session::has('success'))
                    <small style="padding:10px 10px">Success: {{ session()->get('success') }}</small>
                @endif
                @error('receiver')
                    <small style="padding:10px 10px">Error: {{ $message }}</small>
                @enderror
            </div>
        </form>
    </div>
    <script>
        let template = {
            'IT':{
                name:'IT',
                subject:'IT Specialist',
                position:'IT Specialist',
            },
            'PHP':{
                name:'IT',
                subject:'PHP Developer',
                position:'PHP Developer',
            },
            'QA':{
                name:'IT',
                subject:'QA Tester',
                position:'QA Tester',
            }
        }
        let dropdown = document.querySelector('.dropdown > div')
        let drop_select = document.querySelector('.dropdown .selected')
        let dropitems = document.querySelector('.dropdown .items')
        let drop_items = document.querySelectorAll('.dropdown .item')
        let application = document.querySelector('[application]')
        dropdown.addEventListener('click',()=>{
            dropitems.classList.toggle('active')
        })
        drop_items.forEach(item=>{
            item.addEventListener('click',()=>{
                let value = item.getAttribute('data-value')
                console.log(value)
                console.log(template[value])
                drop_select.innerHTML = item.innerHTML
                dropitems.classList.toggle('active')

                application.querySelector('[name=name]').value = template[value].name
                application.querySelector('[name=subject]').value = template[value].subject
                application.querySelector('[name=position]').value = template[value].position
            })
        })
    </script>
</body>
</html>




