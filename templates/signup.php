<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Signup</h1>
    <form id="signup">
        <div class="form-row">
            <div class="col-md-6">
                <div class="position-relative form-group">
                    <label for="exampleName">Name</label>
                    <input name="exampleName" id="exampleName" placeholder="Name here..." type="text" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="position-relative form-group">
                    <label for="exampleEmail">Email</label>
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
        <div class="divider row"></div>
        <div class="d-flex align-items-center">
            <div class="ml-auto">
                <!-- <a href="javascript:void(0);" class="btn-lg btn btn-link">
                    Recover Password 
                </a> -->
                <button class="btn btn-primary btn-lg" type="submit">Signup</button>
            </div>
        </div>
    </form>

    <script>
		document.querySelector('#signup').onsubmit = (e) => {
			e.preventDefault();
			
			fetch("./signup",{
				headers:{
					"contentType":"application/json"
				},
				method:"POST",
				body:JSON.stringify({
					"name":document.querySelector('#exampleName').value,
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