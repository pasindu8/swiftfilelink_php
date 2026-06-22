<?php
    
  include 'components/headerNoLogin.php';
?>
<link rel="stylesheet" href="styles/main.css">
<link rel="stylesheet" href="styles/faq.css">
<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Exo+2:wght@400;600;700&family=Audiowide&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0"/>
</head>
<body onload="myFunction()">
    <?php
      include 'components/navBar.php';
      include 'components/MobileDrawer.php';
  ?>

    <div id="loader">
         <?php include 'loader.php'; ?>
    </div>
  
    <div style="display:none;" id="myDiv" class="animate-bottom"> 
        <h1 class="page-title">Frequently Asked Questions</h1>
          
        <div class="faq-container">
            
            <div class="faq-item">
                <button class="faq-question">
                    <span>What is SWIFTFILELINK?</span>
                    <span class="material-symbols-outlined faq-icon">expand_more</span>
                </button>
                <div class="faq-answer">
                    <p>SWIFTFILELINK is a secure, high-speed file management platform that allows you to seamlessly upload, share, and download files using temporary unique PIN numbers with customized expiration terms.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question">
                    <span>How do I upload a file?</span>
                    <span class="material-symbols-outlined faq-icon">expand_more</span>
                </button>
                <div class="faq-answer">
                    <p>Simply navigate to the <a href="uploadn.php">File Send</a> page, generate or type a unique 5-digit security PIN, define your required max download count along with a system deletion date, drop your files, and initiate upload.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question">
                    <span>Is my data secure?</span>
                    <span class="material-symbols-outlined faq-icon">expand_more</span>
                </button>
                <div class="faq-answer">
                    <p>Absolutely. Privacy is our top objective. All file operations utilize highly secure parameters, and records automatically wipe cleanly off servers the instant your designated download quota or set expiry date hits.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question">
                    <span>How can I contact support?</span>
                    <span class="material-symbols-outlined faq-icon">expand_more</span>
                </button>
                <div class="faq-answer">
                    <p>You can get in absolute direct contact with our infrastructure engineers via our dedicated <a href="contactus.php">Contact Us</a> channel anytime for instantaneous technical support answers.</p>
                </div>
            </div>
            
            <div style="text-align: center; margin-top: 10px;">
                <a href="index.php" class="btn-home">Back to Home</a>
            </div>
        </div>

     <?php include 'components/footer.php'; ?>
    </div>
  
    <script>
        // Set up accordion functionality
        const faqQuestions = document.querySelectorAll('.faq-question');

        faqQuestions.forEach(question => {
            question.addEventListener('click', () => {
                const item = question.parentElement;
                const answer = item.querySelector('.faq-answer');
                
                // Toggle active class on item
                item.classList.toggle('active');
                
                if (item.classList.contains('active')) {
                    answer.style.maxHeight = answer.scrollHeight + 'px';
                } else {
                    answer.style.maxHeight = '0';
                }
                
                // Close other opened accordion blocks optionally
                faqQuestions.forEach(otherQuestion => {
                    const otherItem = otherQuestion.parentElement;
                    if (otherItem !== item && otherItem.classList.contains('active')) {
                        otherItem.classList.remove('active');
                        otherItem.querySelector('.faq-answer').style.maxHeight = '0';
                    }
                });
            });
        });
    </script>
    <!-- ── HAMBURGER ── -->
	<script src="scripts/HamburgerMenu.js"></script>
    <!-- ── LOADER ── -->
    <script src="scripts/loader.js"></script>
</body>
</html>