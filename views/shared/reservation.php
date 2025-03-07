<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table Reservation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: rgb(242, 233, 233);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            display: flex;
            width: 1000px;
            background: white;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .form-container {
            width: 50%;
            padding: 20px;
        }
        .image-container {
            width: 100%;
            background: url('../../public/images/dcddbdfac1a02feb089c4510443ac131.avif');
            background-size: cover;
            margin: 10px 10px;
        }
        .btn-primary {
            background-color: rgb(159, 39, 39);
            border-color: rgb(159, 39, 39);
        }
        .btn-primary:hover {
            background-color: darkred;
            border-color: darkred;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2 class="text-center">Reserve a Table</h2>
            <form action="process_reservation.php" method="POST">
                <div class="mb-3">
                    <label class="form-label">Number of Guests</label>
                    <input type="number" name="guests" class="form-control" min="1" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Reservation Date</label>
                    <input type="date" name="date" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Reservation Time</label>
                    <input type="time" name="time" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Reserve Now</button>
            </form>
        </div>
        <div class="image-container"></div>
    </div>
</body>
</html>
