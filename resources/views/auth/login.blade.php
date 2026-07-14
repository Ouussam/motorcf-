<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
{{-- <link rel="icon" href="/images/images.png" type="image/x-icon"> --}}
<title>Login</title>
<style>
body{
    margin:0;
    font-family: Arial;
    background:url('/images/images.jpeg') no-repeat center center/cover;
}

/* هاد الجزء هو اللي كيجيب كلشي فالوسط طول وعرض */
.container{
    display: flex;
    justify-content: center; /* الوسط أفقياً */
    align-items: center;     /* الوسط عمودياً */
    height: 100vh;           /* كياخد الطول ديال الشاشة كاملة */
    width: 100%;
}

.login-card{
    width: 350px;
    background: white;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

h2{
    text-align: center;
    color: #0a1f44;
    margin-top: 0;
}

/* INPUT */
.input{
    width: 100%;
    padding: 10px;
    margin: 8px 0 2px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box; /* باش الحساب ديال العرض يجي عبار */
}

.input:focus{
    border-color: #1e4ed8;
    outline: none;
}

/* ERROR TEXT */
.error-text{
    color: red;
    font-size: 12px;
    margin-bottom: 8px;
    display: block;
}

/* BUTTON */
.btn{
    width: 100%;
    padding: 10px;
    background: #0a1f44;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-top: 10px;
}

.btn:hover{
    background: #1e4ed8;
}

/* LINK */
a{
    display: block;
    text-align: center;
    margin-top: 15px;
    color: #1e4ed8;
    text-decoration: none;
}

a:hover{
    text-decoration: underline;
}
</style>
</head>

<body>

<div class="container">
    <!-- حيدنا الكلاسات الزايدة ديال بوتستراب وخلينا الكارد نيشان وسط الكانتينر -->
    <div class="login-card">
        @if ($errors->has('compte'))
             <div style="background:red;color:white;padding:10px;border-radius:5px;margin-bottom:10px;text-align:center;">
             {{ $errors->first('compte') }}
            </div>
        @endif
        
        <h2>Se connecter</h2>
        
        <form action="{{ route('login') }}" method="POST">
            @csrf
            
            <input class="input" type="email" name="email" placeholder="Email" value="{{ old('email') }}">
            @error('email')
                <span class="error-text">{{ $message }}</span>
            @enderror
            
            <input class="input" type="password" name="password" placeholder="Password">
            @error('password')
                <span class="error-text">{{ $message }}</span>
            @enderror
            
            <button class="btn" type="submit">Login</button>
            <a href="{{ route('rego.create') }}">Create account</a>
        </form>
    </div>
</div>

</body>
</html>