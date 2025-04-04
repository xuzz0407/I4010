<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Expires" content="Tue, 01 Jan 1980 1:00:00 GMT">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>I4010 - 網頁程式設計與安全實務</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
            min-height: 100vh;
        }
        
        .main-container {
            max-width: 1000px;
        }
        
        .header-section {
            background: linear-gradient(135deg, #0d6efd 0%, #0dcaf0 100%);
            border-radius: .5rem;
        }
        
        .custom-card {
            transition: all .3s ease;
            border: none;
            overflow: hidden;
        }
        
        .custom-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0,0,0,.1);
        }
        
        .card-body {
            background: white;
        }
        
        .card-icon {
            font-size: 2rem;
            margin-bottom: 1rem;
        }
        
        .card-date {
            font-size: 1.5rem;
            font-weight: 500;
        }
        
        .custom-card.card-1 {
            border-top: 5px solid #0d6efd;
        }
        
        .custom-card.card-2 {
            border-top: 5px solid #6610f2;
        }
        
        .custom-card.card-3 {
            border-top: 5px solid #dc3545;
        }
        
        .custom-card.card-4 {
            border-top: 5px solid #fd7e14;
        }

        .custom-card.card-5 {
            border-top: 5px solid #4a6572;
        }
        
        .card-1 .card-icon {
            color: #0d6efd;
        }
        
        .card-2 .card-icon {
            color: #6610f2;
        }
        
        .card-3 .card-icon {
            color: #dc3545;
        }
        
        .card-4 .card-icon {
            color: #fd7e14;
        }

        .card-5 .card-icon {
            color: #4a6572;
        }
        
        .course-badge {
            background: rgba(255,255,255,.3);
            font-weight: 500;
        }
        
        .student-info {
            background: rgba(0,0,0,.1);
            font-weight: 500;
        }
    </style>
</head>
<body class="d-flex align-items-center py-4">
    <div class="container main-container py-4">
        <div class="header-section text-white p-4 mb-5 shadow-sm">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="display-5 fw-bold mb-0">網頁程式設計與安全實務</h1>
                    <span class="badge course-badge px-3 py-2 mt-2">I4010</span>
                </div>
                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                    <span class="badge student-info px-3 py-2">I3A07 徐士洧</span>
                </div>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-md-3 col-sm-6">
                <a href="20250305/" class="text-decoration-none">
                    <div class="card custom-card card-1 shadow-sm h-100">
                        <div class="card-body text-center py-4">
                            <div class="card-icon">
                                <i class="bi bi-calendar-week"></i>
                            </div>
                            <div class="card-date">20250305</div>
                        </div>
                        <div class="card-footer bg-light border-0 text-center">
                            <small class="text-muted">三月</small>
                        </div>
                    </div>
                </a>
            </div>
            
            <div class="col-md-3 col-sm-6">
                <a href="20250312/" class="text-decoration-none">
                    <div class="card custom-card card-2 shadow-sm h-100">
                        <div class="card-body text-center py-4">
                            <div class="card-icon">
                                <i class="bi bi-calendar-week"></i>
                            </div>
                            <div class="card-date">20250312</div>
                        </div>
                        <div class="card-footer bg-light border-0 text-center">
                            <small class="text-muted">三月</small>
                        </div>
                    </div>
                </a>
            </div>
            
            <div class="col-md-3 col-sm-6">
                <a href="20250319/" class="text-decoration-none">
                    <div class="card custom-card card-3 shadow-sm h-100">
                        <div class="card-body text-center py-4">
                            <div class="card-icon">
                                <i class="bi bi-calendar-week"></i>
                            </div>
                            <div class="card-date">20250319</div>
                        </div>
                        <div class="card-footer bg-light border-0 text-center">
                            <small class="text-muted">三月</small>
                        </div>
                    </div>
                </a>
            </div>
            
            <div class="col-md-3 col-sm-6">
                <a href="20250326/" class="text-decoration-none">
                    <div class="card custom-card card-4 shadow-sm h-100">
                        <div class="card-body text-center py-4">
                            <div class="card-icon">
                                <i class="bi bi-calendar-week"></i>
                            </div>
                            <div class="card-date">20250326</div>
                        </div>
                        <div class="card-footer bg-light border-0 text-center">
                            <small class="text-muted">三月</small>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-3 col-sm-6">
                <a href="20250402/" class="text-decoration-none">
                    <div class="card custom-card card-5 shadow-sm h-100">
                        <div class="card-body text-center py-4">
                            <div class="card-icon">
                                <i class="bi bi-calendar-week"></i>
                            </div>
                            <div class="card-date">20250402</div>
                        </div>
                        <div class="card-footer bg-light border-0 text-center">
                            <small class="text-muted">四月</small>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        
        <footer class="mt-5 pt-4 text-center text-muted border-top">
            <p>&copy; 2025 網頁程式設計與安全實務</p>
        </footer>
    </div>
    
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>