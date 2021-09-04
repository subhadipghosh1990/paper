
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>{{ Session::get('loggedInUserDetails')->fname}}'s Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container">
    <div class="main-body">
    
          <!-- Breadcrumb -->
          <nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{ Session::get('loggedInUserDetails')->fname}}'s Profile</li>
            </ol>
          </nav>
          <!-- /Breadcrumb -->
    

          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">


                  

                  @if (Session::get('loggedInUserDetails')->img)
                    <img src="{{URL::to('/')}}/{{Session::get('loggedInUserDetails')->img}}" alt="Admin" class="w-100" width="">
                    @else
                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="w-100" width="">
                    @endif

                    
                    <div class="mt-3">
                      <h4>{{ Session::get('loggedInUserDetails')->fname}} {{ Session::get('loggedInUserDetails')->lname}}</h4>
                      <!-- <p class="text-secondary mb-1">Full Stack Developer</p> -->
                      <p class="text-muted font-size-sm">{{ Session::get('loggedInUserDetails')->address}}</p>
                      <button class="btn btn-primary" data-toggle="modal" data-target="#myModal">Edit</button>
                      <a href="/logout"  class="btn btn-outline-primary">logout</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card mt-3">

                <h4 class="p-3">Cart</h4>

                <ul class="list-group list-group-flush">
                </ul>
              </div>
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Full Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    {{ Session::get('loggedInUserDetails')->fname}} {{ Session::get('loggedInUserDetails')->lname}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    {{ Session::get('loggedInUserDetails')->email}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Phone</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    {{ Session::get('loggedInUserDetails')->phone}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Address</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    {{ Session::get('loggedInUserDetails')->address}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-12">
                    <button class="btn btn-info" data-toggle="modal" data-target="#myModal">Edit</button>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row gutters-sm">
                <div class="col-sm-12 mb-3">
                  <div class="card h-100">
                    <div class="card-body">
                      <h6 class="d-flex align-items-center mb-3">Liked Items</h6>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row gutters-sm">
                <div class="col-sm-12 mb-3">
                  <div class="card h-100">
                    <div class="card-body">
                      <h6 class="d-flex align-items-center mb-3">Order History</h6>
                    </div>
                  </div>
                </div>
              </div>


            </div>
          </div>

        </div>
    </div>



<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Edit Profile</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        
      
        <form class="row login_form" action="/user" method="post" id="contactForm" novalidate="novalidate" enctype= multipart/form-data>
                @csrf

                <div class="d-none col-md-6 form-group">
                    <input type="text" class="form-control" id="" name="id" placeholder="First Name" value="{{ Session::get('loggedInUserDetails')->id}}" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Username'">
                </div>

                <div class="col-md-6 form-group">
                    <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" value="{{ Session::get('loggedInUserDetails')->fname}}" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Username'">
                </div>
                <div class="col-md-6 form-group">
                    <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name"value="{{ Session::get('loggedInUserDetails')->lname}}" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Username'">
                </div>
                <div class="col-md-12 form-group">
                    <input type="email" class="form-control" id="mail" name="email" placeholder="Mail" value="{{ Session::get('loggedInUserDetails')->email}}" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'">
                </div>
                <!-- <div class="col-md-12 form-group">
                    <input type="password" class="form-control" id="name" name="pass" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'">
                </div> -->
                <div class="col-md-12 form-group">
                    <input type="text" class="form-control" id="mail" name="address" placeholder="Address" value="{{ Session::get('loggedInUserDetails')->address}}" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'">
                </div>
                <div class="col-md-12 form-group">
                    <input type="tel" class="form-control" id="ph" name="phone" placeholder="Phone" value="{{ Session::get('loggedInUserDetails')->phone}}" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'">
                </div>

                <div class="col-md-12 form-group">
                    <input type="file" class="form-control" id="ph" name="dp">
                </div>

                <div class="col-md-12 form-group">
                    <button type="submit" value="submit" class="btn btn-primary">Change</button>
                </div>
            </form>


      </div>


    </div>
  </div>
</div>

<style type="text/css">
body{
    margin-top:20px;
    color: #1a202c;
    text-align: left;
    background-color: #e2e8f0;    
}
.main-body {
    padding: 15px;
}
.card {
    box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
}

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid rgba(0,0,0,.125);
    border-radius: .25rem;
}

.card-body {
    flex: 1 1 auto;
    min-height: 1px;
    padding: 1rem;
}

.gutters-sm {
    margin-right: -8px;
    margin-left: -8px;
}

.gutters-sm>.col, .gutters-sm>[class*=col-] {
    padding-right: 8px;
    padding-left: 8px;
}
.mb-3, .my-3 {
    margin-bottom: 1rem!important;
}

.bg-gray-300 {
    background-color: #e2e8f0;
}
.h-100 {
    height: 100%!important;
}
.shadow-none {
    box-shadow: none!important;
}

</style>

<script type="text/javascript">

</script>
</body>
</html>