<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página no encontrada | Sistema de Tutorias</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #f8f9fc;
            --accent-color: #e74a3b;
        }
        
        body {
            font-family: 'Nunito', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: var(--secondary-color);
            overflow-x: hidden;
        }
        
        .error-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            background: linear-gradient(135deg, var(--secondary-color) 0%, #e5e9f2 100%);
        }
        
        .error-card {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1);
            overflow: hidden;
            max-width: 600px;
            width: 100%;
            transition: transform 0.3s ease;
        }
        
        .error-card:hover {
            transform: translateY(-5px);
        }
        
        .error-header {
            background: var(--primary-color);
            color: white;
            padding: 1.5rem;
            text-align: center;
        }
        
        .error-body {
            padding: 2.5rem;
            text-align: center;
        }
        
        .error-icon {
            font-size: 5rem;
            color: var(--accent-color);
            margin-bottom: 1.5rem;
            animation: pulse 2s infinite;
        }
        
        .error-title {
            font-weight: 800;
            color: #5a5c69;
            margin-bottom: 1rem;
        }
        
        .error-description {
            color: #6c757d;
            margin-bottom: 2rem;
            font-size: 1.1rem;
        }
        
        .btn-home {
            background-color: var(--primary-color);
            border: none;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            transition: all 0.3s;
        }
        
        .btn-home:hover {
            background-color: #3a5ccc;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        .error-search {
            margin-top: 2rem;
        }
        
        .search-box {
            position: relative;
            max-width: 400px;
            margin: 0 auto;
        }
        
        .search-box input {
            padding-left: 2.5rem;
            border-radius: 50px;
        }
        
        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }
        
        /* Efecto de olas decorativo */
        .waves {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100px;
            overflow: hidden;
            z-index: -1;
        }
        
        .wave {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml;utf8,<svg viewBox="0 0 1200 120" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none"><path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" fill="%234e73df" opacity=".25"/><path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" fill="%234e73df" opacity=".5"/><path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" fill="%234e73df"/></svg>');
            background-size: cover;
            animation: wave 10s linear infinite;
        }
        
        .wave:nth-child(2) {
            animation-delay: -5s;
            opacity: 0.7;
        }
        
        @keyframes wave {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-card animate__animated animate__fadeInUp">
            <div class="error-header">
                <h1><i class="fas fa-exclamation-circle me-2"></i> Error 404</h1>
            </div>
            <div class="error-body">
                <div class="error-icon animate__animated animate__pulse animate__infinite">
                    <i class="fas fa-map-marked-alt"></i>
                </div>
                <h2 class="error-title">Página no encontrada</h2>
                <p class="error-description">
                    Lo sentimos, no pudimos encontrar la página que estás buscando.
                    Mientras tanto, puedes volver al inicio.
                </p>
                
                <a href="{{ url('/') }}" class="btn btn-home btn-lg rounded-pill">
                    <i class="fas fa-home me-2"></i> Volver al inicio
                </a>
                
             
            </div>
        </div>
    </div>
    
    <div class="waves">
        <div class="wave"></div>
        <div class="wave"></div>
    </div>

    <!-- Bootstrap JS Bundle con Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Script para el buscador (ejemplo) -->
    <script>
        document.querySelector('.search-box input').addEventListener('keypress', function(e) {
            if(e.key === 'Enter') {
                alert('Función de búsqueda sería implementada aquí');
                // window.location.href = '/search?q=' + encodeURIComponent(this.value);
            }
        });
    </script>
</body>
</html>
