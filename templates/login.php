<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Login</h1>
    <form id="login">
        <div class="form-row">
            <div class="col-md-6">
                <div class="position-relative form-group">
                    <label for="exampleEmail" class>Email</label>
                    <input name="email" id="exampleEmail" placeholder="Email here..." type="email" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="position-relative form-group">
                    <label for="examplePassword" class>Password</label>
                    <input name="password" id="examplePassword" placeholder="Password here..." type="password" class="form-control">
                </div>
            </div>
        </div>
        <div class="position-relative form-check">
            <input name="check" id="exampleCheck" type="checkbox" class="form-check-input">
            <label for="exampleCheck" class="form-check-label">Keep me logged in</label>
        </div>
        <div class="divider row"></div>
        <div class="d-flex align-items-center">
            <div class="ml-auto">
                <a href="javascript:void(0);" class="btn-lg btn btn-link">
                    Recover Password 
                </a>
                <button class="btn btn-primary btn-lg" type="submit">Login to Dashboard</button>
            </div>
        </div>
    </form>

    <script>
		document.querySelector('#login').onsubmit = (e) => {
			e.preventDefault();
			
			fetch("./login",{
				headers:{
					"contentType":"application/json"
				},
				method:"POST",
				body:JSON.stringify({
					"page":"login",
					"password":document.querySelector('#examplePassword').value,
					"email":document.querySelector('#exampleEmail').value
				})
			})
			.then(response => response.json())
			.then(res => { 
				console.log(res);
			})
			.catch(err => { console.log(err.message) });
		}
	</script>
</body>
</html>