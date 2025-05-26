<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Growth - Plateforme e-learning</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8fafc;
        }
        .hero-gradient {
            background: linear-gradient(135deg, #007BFF 0%, #3b82f6 100%);
        }
        .course-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <!-- Logo -->
                    <a href="#" class="flex-shrink-0 flex items-center">
                        <svg class="h-8 w-8 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"></path>
                        </svg>
                        <span class="ml-2 text-xl font-bold text-gray-800">Smart Growth</span>
                    </a>
                    
                    <!-- navbar -->
                    <div class="hidden md:ml-10 md:flex md:space-x-8">
                        <a href="#" class="text-blue-600 border-blue-500 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Accueil</a>
                        <a href="#" class="text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium">Cours</a>
                        <a href="#" class="text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium">Formateurs</a>
                        <a href="#about" class="text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium">À propos</a>
                    </div>
                </div>
                
                <!-- Connection / inscription -->
                <div class="hidden md:flex items-center space-x-4">
                    <a href="{{route('login')}}" class="text-gray-600 hover:text-blue-600 px-3 py-2 text-sm font-medium">Connexion</a>
                    <a href="{{route('register')}}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium">Inscription</a>
                </div>
                
                
                <div class="-mr-2 flex items-center md:hidden">
                    <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none">
                        <span class="sr-only">Open main menu</span>
                        
                        <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    {{-- hero --}}
    <div class="hero-gradient text-white">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl font-extrabold tracking-tight sm:text-5xl lg:text-6xl">
                    Transformez votre savoir en expérience digitale
                </h1>
                <p class="mt-6 max-w-lg mx-auto text-xl">
                    La plateforme idéale pour les formateurs et apprenants souhaitant une solution simple et puissante.
                </p>
                <div class="mt-10 flex justify-center space-x-4">
                    <a href="register.html" class="bg-white text-blue-600 px-8 py-3 rounded-md text-base font-medium hover:bg-gray-100 md:py-4 md:text-lg md:px-10">
                        Commencer gratuitement
                    </a>
                    <a href="#courses" class="bg-transparent border-2 border-white text-white px-8 py-3 rounded-md text-base font-medium hover:bg-white hover:text-blue-600 md:py-4 md:text-lg md:px-10">
                        Explorer les cours
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- About  -->
    <section id="about" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center">
                <h2 class="text-base text-blue-600 font-semibold tracking-wide uppercase">À propos</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Notre mission
                </p>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">
                    Smart Growth a été créé pour démocratiser l'accès à des outils pédagogiques professionnels.
                </p>
            </div>

            <div class="mt-20">
                <div class="grid grid-cols-1 gap-12 lg:grid-cols-2">
                    <div class="bg-gray-50 p-8 rounded-lg">
                        <h3 class="text-lg font-medium text-gray-900">Pour les formateurs</h3>
                        <p class="mt-2 text-base text-gray-500">
                            Créez facilement des cours structurés avec vidéos et quiz, sans compétences techniques. Suivez l'engagement de vos apprenants grâce à des statistiques claires.
                        </p>
                    </div>
                    <div class="bg-gray-50 p-8 rounded-lg">
                        <h3 class="text-lg font-medium text-gray-900">Pour les apprenants</h3>
                        <p class="mt-2 text-base text-gray-500">
                            Accédez à des contenus pédagogiques organisés, testez vos connaissances avec des quiz interactifs et suivez votre progression.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--  Courses  -->
    <section id="courses" class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center">
                <h2 class="text-base text-blue-600 font-semibold tracking-wide uppercase">Cours récents</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Découvrez nos dernières formations
                </p>
            </div>

            <div class="mt-12 grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                <!-- Course Card 1 -->
                <div class="course-card bg-white rounded-lg shadow-md overflow-hidden transition duration-300">
                    <img class="h-48 w-full object-cover" src="https://images.unsplash.com/photo-1496128858413-b36217c2ce36?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=800&q=80" alt="Course image">
                    <div class="p-6">
                        <div class="flex items-center">
                            <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                Développement
                            </span>
                        </div>
                        <a href="#" class="block mt-2">
                            <h3 class="text-xl font-semibold text-gray-900">Laravel pour débutants</h3>
                            <p class="mt-3 text-base text-gray-500">
                                Apprenez les bases du framework PHP Laravel en 10 chapitres.
                            </p>
                        </a>
                        <div class="mt-6 flex items-center">
                            <div class="flex-shrink-0">
                                <img class="h-10 w-10 rounded-full" src="https://randomuser.me/api/portraits/men/32.jpg" alt="Formateur">
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">
                                    Ahmed Z.
                                </p>
                                <div class="flex space-x-1 text-sm text-gray-500">
                                    <span>12 leçons</span>
                                    <span aria-hidden="true">&middot;</span>
                                    <span>4h30</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Course Card 2 -->
                <div class="course-card bg-white rounded-lg shadow-md overflow-hidden transition duration-300">
                    <img class="h-48 w-full object-cover" src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Course image">
                    <div class="p-6">
                        <div class="flex items-center">
                            <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                Marketing
                            </span>
                        </div>
                        <a href="#" class="block mt-2">
                            <h3 class="text-xl font-semibold text-gray-900">Marketing Digital 101</h3>
                            <p class="mt-3 text-base text-gray-500">
                                Maîtrisez les fondamentaux du marketing digital en 2023.
                            </p>
                        </a>
                        <div class="mt-6 flex items-center">
                            <div class="flex-shrink-0">
                                <img class="h-10 w-10 rounded-full" src="https://randomuser.me/api/portraits/women/44.jpg" alt="Formateur">
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">
                                    Fatima E.
                                </p>
                                <div class="flex space-x-1 text-sm text-gray-500">
                                    <span>8 leçons</span>
                                    <span aria-hidden="true">&middot;</span>
                                    <span>3h15</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Course Card 3 -->
                <div class="course-card bg-white rounded-lg shadow-md overflow-hidden transition duration-300">
                    <img class="h-48 w-full object-cover" src="https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Course image">
                    <div class="p-6">
                        <div class="flex items-center">
                            <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                                Design
                            </span>
                        </div>
                        <a href="#" class="block mt-2">
                            <h3 class="text-xl font-semibold text-gray-900">UI/UX avec Figma</h3>
                            <p class="mt-3 text-base text-gray-500">
                                Concevez des interfaces utilisateur modernes avec Figma.
                            </p>
                        </a>
                        <div class="mt-6 flex items-center">
                            <div class="flex-shrink-0">
                                <img class="h-10 w-10 rounded-full" src="https://randomuser.me/api/portraits/men/75.jpg" alt="Formateur">
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">
                                    Karim M.
                                </p>
                                <div class="flex space-x-1 text-sm text-gray-500">
                                    <span>15 leçons</span>
                                    <span aria-hidden="true">&middot;</span>
                                    <span>6h00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-12 text-center">
                <a href="courses.html" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700">
                    Voir tous les cours
                    <svg class="ml-3 -mr-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    
    <div class="bg-blue-700">
        <div class="max-w-2xl mx-auto text-center py-16 px-4 sm:py-20 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold text-white sm:text-4xl">
                <span class="block">Prêt à transformer votre pédagogie ?</span>
            </h2>
            <p class="mt-4 text-lg leading-6 text-blue-200">
                Rejoignez notre communauté de formateurs et apprenants dès aujourd'hui.
            </p>
            <a href="register.html" class="mt-8 w-full inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-blue-600 bg-white hover:bg-blue-50 sm:w-auto">
                Créer un compte gratuit
            </a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">Plateforme</h3>
                    <ul class="mt-4 space-y-4">
                        <li><a href="#" class="text-base text-gray-300 hover:text-white">Fonctionnalités</a></li>
                        <li><a href="#" class="text-base text-gray-300 hover:text-white">Tarifs</a></li>
                        <li><a href="#" class="text-base text-gray-300 hover:text-white">FAQ</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">Ressources</h3>
                    <ul class="mt-4 space-y-4">
                        <li><a href="#" class="text-base text-gray-300 hover:text-white">Documentation</a></li>
                        <li><a href="#" class="text-base text-gray-300 hover:text-white">Blog</a></li>
                        <li><a href="#" class="text-base text-gray-300 hover:text-white">Support</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">Entreprise</h3>
                    <ul class="mt-4 space-y-4">
                        <li><a href="#" class="text-base text-gray-300 hover:text-white">À propos</a></li>
                        <li><a href="#" class="text-base text-gray-300 hover:text-white">Carrières</a></li>
                        <li><a href="#" class="text-base text-gray-300 hover:text-white">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">Légal</h3>
                    <ul class="mt-4 space-y-4">
                        <li><a href="#" class="text-base text-gray-300 hover:text-white">Confidentialité</a></li>
                        <li><a href="#" class="text-base text-gray-300 hover:text-white">Conditions</a></li>
                        <li><a href="#" class="text-base text-gray-300 hover:text-white">Cookies</a></li>
                    </ul>
                </div>
            </div>
            <div class="mt-12 border-t border-gray-700 pt-8">
                <p class="text-base text-gray-400 text-center">
                    &copy; 2025 Smart Growth. Tous droits réservés.
                </p>
            </div>
        </div>
    </footer>
</body>
</html>