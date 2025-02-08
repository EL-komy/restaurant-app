<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: white;
            color: white;
            padding: 20px;
        }
        .profile-container {
            max-width: 700px;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            color: black;
        }
        .profile-picture {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
        }
        .nav-tabs .nav-link.active {
            background-color: rgb(159, 39, 39);
            color: white;
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <h2 class="text-center">Edit your Profile</h2>
        
        <div class="tab-content mt-3" id="profileTabsContent">
            <div class="tab-pane fade show active" id="personal" role="tabpanel">
                <form enctype="" method="POST">
                    <div class="d-flex align-items-center mb-3">
                        <img src="logo2.jpg" alt="Profile Picture" class="profile-picture me-3">
                       
                        <input type="file"  class="btn btn-danger">
                        
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" placeholder="Enter your name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="text" class="form-control" placeholder="Enter your email">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="text" class="form-control" placeholder="Enter your password">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" class="form-control" placeholder="Enter your phone">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <input type="text" class="form-control" placeholder="Enter your address">
                    </div>
                   
                    <div class="text-end">
                        <button type="button" class="btn btn-secondary">Cancel</button>
                        <button type="submit" class="btn btn-danger">Save</button>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="dashboard" role="tabpanel">
                <p>Dashboard settings content...</p>
            </div>
            <div class="tab-pane fade" id="advanced" role="tabpanel">
                <p>Advanced settings content...</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
