<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flash Card Quiz App</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap');

    * {
    margin: 0;
    padding: 0;
    font-family: 'Poppins', sans-serif; /* Apply Poppins font to all elements */
    }
    body {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: #F3FFC5; /* Light Green */
    }
    .main {
        height: 90%;
        width: 82%;
        box-shadow: #191A23 0px 5px 0px 0px;
        padding: 40px;
        border: 1px black solid;
        border-radius: 20px;
        background-color: white; /* Purple 0px 5px 0px 0px #191A23; */
        
    }
    .title-container h3 {
        color: #000;
        
    }
    .card-container {
        height: 85%;
        display: flex;
        flex-wrap: wrap;
        overflow-y: auto;
        margin-top: 20px;
        
    }
    .card {
        background-color: #F3FFC5;
        box-shadow: #191A23 0px 5px 0px 0px;
        position: relative;
        padding: 10px;
        border-radius: 20px;
        height: 270px;
        margin: 10px;
        
        border: 2px solid black;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .card:hover {
        background:  #ABF600; /* Soft gradient background */
        border-color: black;
        transform: translateY(-10px); /* Hover effect */
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
    }
    .card-title {
        color: black;
        font-size: 1.4em;
        margin-bottom: 15px;
    }
    .card-subtitle {
        font-size: 1.2em;
        color: black; /* Dark gray */
    }
    .action-button {
        position: absolute;
        bottom: 10px;
        right: 10px;
        display: none; /* Start hidden */
    }
    .modal-dialog {
        display: flex;
        justify-content: center;
        align-items: flex-start;
        height: 100%;
    }
    .modal-content {
        font-family: 'Poppins', sans-serif; /* Apply Poppins font */
        max-width: 500px;  /* Set a max width to prevent it from being too wide */
        width: 100%;
        margin: 70px auto;  /* Ensures the content is centered horizontally */
        padding: 20px;
        border-radius: 10px;
        transition: transform 0.5s ease-in-out;
    }
    .modal-header {
        border-bottom: none;
    }
    .modal-title {
        color: #442D7C;
        font-size: 1.5em;
    }
    .modal-body {
        padding-bottom: 20px;
    }
    .form-group label {
        color: #442D7C;
    }
    .form-control {
        border: 2px solid #6341B4;
        border-radius: 5px;
    }
    .btn-primary, .btn-success, .btn-secondary {
        background-color: #442D7C; /* Dark purple for buttons */
        border-color: #6341B4; /* Purple */
        transition: background-color 0.3s ease;
    }
    .btn-primary:hover, .btn-success:hover, .btn-secondary:hover {
        background-color: #6341B4; /* Lighter purple */
        border-color: #6341B4; /* Lighter purple */
    }
    .card.no-hover:hover {
        background-color: #DAFA8B; /* No hover effect */
        border-color: black;
    }
    .card .action-button {
        pointer-events: auto;  /* Keep the action buttons clickable */
    }
    .action-button img {
        width: 15px;
    }
    .modal-content {
        background-color: #DAFA8B; /* Light yellow */
    }
    .modal-title, .form-group label {
        color: #442D7C; /* Dark purple */
    }
    .card-title, .modal-title, .form-group label {
        color: #442D7C; /* Dark purple for readability */
    }
    .form-control {
        border: 1px solid #6341B4; /* Purple */
    }
    .btn-manage {
        background-color: #ABF600; /* Match card background for consistency */
        border-color: black;
        border-radius: 10px;
        color: #000; /* Text color for readability */
    }
    .btn-add {
        border-radius: 10px;
        background-color: #ABF600; ; /* Dark purple */
        border-color: black; ;
        color: #000; /* Text color for readability */
    }
    .btn-manage:hover {
  
        border-color: black;
        box-shadow: #191A23 0px 5px 0px 0px;
    }
    .btn-add:hover {
        
        border-color: black;
        box-shadow: #191A23 0px 5px 0px 0px;
    }
    .show-answer-button-container {
        position: absolute;
        bottom: 10px;
        right: 10px;
    }
    .show-answer-button-container button {
        padding: 8px 16px;
        font-size: 1em;
        background-color: #6341B4;
        color: #FFF;
        transition: background-color 0.3s ease;
    }
    .show-answer-button-container button:hover {
        background-color: #442D7C; /* Lighter purple */
    }
    .flashcard-modal .flashcard-content {
        font-family: 'Poppins', sans-serif;
        color: #442D7C; /* Dark purple for text color */
    }
   


    .card .answer-con {
        margin-top: 20px;
        visibility: hidden;
        height: 0;
        overflow: hidden;
        transition: visibility 0s, height 0.3s ease-out;
    }
    .card.show-answer .answer-con {
        visibility: visible;
        height: auto;
        transition: visibility 0s, height 0.3s ease-in;
    }
    .card-text {
        visibility: hidden;
        height: 0;
        transition: visibility 0s, height 0.3s ease-out;
    }
    .card.show-answer .card-text {
        visibility: visible;
        height: auto;
        transition: visibility 0s, height 0.3s ease-in;
    }
    #modalQuestion {
        font-size: 1.2em;
        color: #442D7C; /* Dark purple for readability */
        margin-bottom: 15px;
    }
    #modalQuestion h5 {
        font-size: 1.3em; /* Larger font size for the 'Question' label */
        color: #442D7C; /* Dark purple color */
    }
    #modalQuestion h4 {
        font-size: 1.2; /* Larger font size for the question text */
        color: #3C3938; /* Black color for the question text */
    }
    .flashcard-modal {
        display: flex;
        position: fixed;
        z-index: 10;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        border: 1px black solid;
        background-color: rgba(0, 0, 0, 0.6);
        justify-content: center;
        align-items: center;
    }
    .flashcard-content {
        background-color: #F3FFC5;
        padding: 20px;
        border-radius: 10px;
        width: 650px;
        height: 350px;
        position: relative;
        border: 2px solid black; /* Dark purple border */
        Box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        
    }

    /* Notification styling */
.notification {
    display: none;
    position: fixed;
    top: 10px;
    left: 50%;
    transform: translateX(-50%);
    background-color: #444;
    color: #fff;
    padding: 15px;
    border-radius: 5px;
    z-index: 1000;
    font-size: 14px;
    opacity: 0;
    transition: opacity 0.5s ease;
}

.notification.show {
    display: block;
    opacity: 1;
}

    .close {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 24px;
        color: #442D7C;
        cursor: pointer;
        transition: color 0.3s ease;
    }
    .close:hover {
        color: #6341B4;
    }
    .arrow {
        font-size: 30px;
        cursor: pointer;
        position: absolute;
        top: 50%;
        color: #fff; /* White arrow color for contrast */
        transform: translateY(-50%);
        background-color: #6341B4; /* Dark purple background */
        border: none;
        padding: 10px;
        border-radius: 30%; /* Circular buttons */
        transition: all 0.3s ease; /* Smooth transition on hover */
    }
    .arrow:hover {
        background-color: #442D7C; /* Darker purple on hover */
        transform: translateY(-50%) scale(1.1) ; /* Slightly larger on hover */
    }
    .left-arrow {
        left: -60px;
    }
    .right-arrow {
        right: -60px;
    }
    .arrow:active {
        transform: translateY(-50%) scale(0.9) ; /* Slightly reduce size and rotate in the opposite direction */
    }
    .disabled-card {
        pointer-events: none;  /* Disable clicks on the card itself */
    }
    .error-message {
        color: red;
        font-size: 12px;
        display: none; /* Initially hide the error messages */
        padding: 5px;
    }
    /* Search Bar Styles */
    #searchInput {
        border: 1px solid #442D7C; /* Dark purple border color */
        padding: 10px;
        font-size: 16px;
        border-radius: 5px;
        width: 50%; /* Reduced width to 50% */
        max-width: 330px; /* Optional max-width for larger screens */
        box-sizing: border-box; /* Ensures padding doesn't affect width */
        transition: all 0.3s ease;
        margin-right: 35px;
        
        
    }
    #search-container {
        display: flex;
        justify-content: flex-end; /* Align search input to the right */
        width: 100%; /* Full width to ensure proper alignment */
        margin-top: 10px;
    }
    /* Search Bar Placeholder Text */
    #searchInput::placeholder {
        color: rgba(60, 57, 56, 0.8);
        font-style: italic;
        font-size: 0.95em;
    }
    /* When search input is focused */
    #searchInput:focus {
        border-color: #6341B4; 
        outline: none;
        box-shadow: 0 0 5px rgba(99, 65, 180, 0.5);
    }

    /* When search input is empty */
    #searchInput:valid {
        border-color: black; 
    }

    .search-input:hover {
    background-color: #f0f0f0; /* Light gray background on hover */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Adds a shadow on hover */
    border-color: #aaa; /* Slightly darker border color */
}

 

/* Bounce animation */
@keyframes bounceIn {
    0% {
        transform: scale(0.5);
        opacity: 0;
    }
    50% {
        transform: scale(1.1);
        opacity: 1;
    }
    100% {
        transform: scale(1);
        opacity: 1;
    }
}



 #modalContent {
        margin-bottom: 15px;
    }

#flashcardModal {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 300px;
        height: 250px;
        background-color: white;
        padding: 20px;
        box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        display: none;
        opacity: 0;
        transition: opacity 0.5s ease, transform 0.5s ease;
        text-align: center;
    }


/* Bounce-out effect when closing */
#flashcardModal.hide {
    display: none;
    animation: bounceOut 0.5s ease-out forwards; /* Bounce-out effect */
}

#flashcardModal.show {
        display: block;
        opacity: 1;
        transform: translate(-50%, -50%) scale(1.05);
    }

    /* Fade-out effect for modal content */
    #flashcardModal.fadeOut {
        opacity: 0;
    }

    #modalContent {
        margin-bottom: 15px;
        opacity: 1;
        transition: opacity 0.5s ease; /* Smooth fade for content */
    }

    #modalContent.fadeOut {
        opacity: 0;
    }

/* Other styles for modal and buttons */
    #modalAnswerContainer {
        visibility: hidden;
        margin-top: 10px;
        font-size: 14px;
        color: green;
    }
        </style> 
</head>
<body>
    
    <div class="main">

        <div class="title-container row">
            <h3 class="col-9">Flash Card Study</h3>
            <button class="btn btn-manage mr-1" onclick="showAllActionButtons()">Manage Flashcards</button>
            <button class="btn btn-add" data-toggle="modal" data-target="#addFlashcardModal">Add Flashcard</button>
            
            <!-- Add Flashcard Modal -->
<div class="modal fade" id="addFlashcardModal" tabindex="-1" aria-labelledby="addFlashcard" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addFlashcard">Add Flashcard</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addFlashcardForm" action="./endpoint/add-flashcard.php" method="POST">
                    <div class="form-group">
                        <label for="question">Question:</label>
                        <input type="text" class="form-control" id="question" name="question">
                        <span id="question-error" class="error-message" style="display:none;">Please enter a question.</span> <!-- Error message for question -->
                    </div>
                    <div class="form-group">
                        <label for="answer">Answer:</label>
                        <input type="text" class="form-control" id="answer" name="answer">
                        <span id="answer-error" class="error-message" style="display:none;">Please enter an answer.</span> <!-- Error message for answer -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

                        <!-- Flashcard Modal -->
<!-- Flashcard Modal -->
<div id="flashcardModal" class="flashcard-modal" style="display: none;">
    <div class="flashcard-content">
        <p id="cardCount">Card X of Y</p>
        <span class="close" onclick="closeFlashcardModal()">&times;</span>
        <div id="flashcardDetails">
            <h3 id="modalQuestion"></h3>

            <!-- User's Answer Input -->
            <textarea id="userAnswer" placeholder="Type your answer here..." rows="4" cols="50"></textarea>
            
            <div id="modalAnswerContainer" style="visibility: hidden;">
                <p id="modalAnswer"></p> <!-- Correct answer will be shown here -->
            </div>
            
            <div class="show-answer-button-container">
                <button class="action-btn toggle-answer" onclick="toggleAnswerVisibility()">Show Answer</button>
            </div>

            <div id="notification" class="notification"></div>

        </div>
        
        <div class="timer-container">
            <span id="timer" class="timer">120</span>
        </div>

        <button class="arrow left-arrow" onclick="showPreviousFlashcard()">&#10094;</button>
        <button class="arrow right-arrow" onclick="showNextFlashcard()">&#10095;</button>
    </div>
</div>


                <!-- Delete Confirmation Modal -->
        <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmation" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteConfirmation">Confirm Deletion</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this flashcard?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
                    </div>
                </div>
            </div>
        </div>
            <!-- Update Flashcard Modal -->
            <div class="modal fade" id="updateFlashcardModal" tabindex="-1" aria-labelledby="updateFlashcard" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="updateFlashcard">Update Flashcard</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="./endpoint/update-flashcard.php" method="POST">
                                <input type="text" class="form-control" id="updateCardID" name="tbl_card_id">
                                <div class="form-group">
                                    <label for="question">Question:</label>
                                    <input type="text" class="form-control" id="updateQuestion" name="question">
                                </div>
                                <div class="form-group">
                                    <label for="answer">Answer:</label>
                                    <input type="text" class="form-control" id="updateAnswer" name="answer">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>

        <div id="search-container">
            <input type="text" id="searchInput" class="form-control" placeholder="Search Flashcards" onkeyup="searchFlashcards()">
            </div>
            <div id="noResults" style="display: none; text-align: center; margin-top: 20px; font-size: 18px; color: #ff0000;">No flashcards found</div>

        <div class="card-container">
            <?php 
                include("./conn/conn.php");

                $stmt = $conn->prepare("SELECT * FROM tbl_card");
                $stmt->execute();

                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $questionNumber = 0;    

                foreach($result as $row) {
                    $cardID = $row['tbl_card_id'];
                    $question = $row['question'];
                    $answer = $row['answer'];
                    $questionNumber++;
                    ?>

                    <div class="card" style="width: 22rem;" onclick="openFlashcardModal(<?= $questionNumber - 1 ?>)">
                        <div class="card-body">
                            <h5 class="card-title">Question <?= $questionNumber ?></h5>
                            <h4 class="card-subtitle mt-2 mb-2" id="question-<?= $cardID ?>"><?= $question ?></h4>
                            <div class="action-button" style="display: none;">
                                <button class="btn btn-sm btn-primary" onclick="event.stopPropagation(); updateFlashcard(<?= $cardID ?>)">
                                    <img src="https://cdn-icons-png.flaticon.com/512/1159/1159633.png" alt="">
                                </button>
                                <button class="btn btn-sm btn-danger" onclick="event.stopPropagation(); deleteFlashcard(<?= $cardID ?>)">
                                    <img src="https://cdn-icons-png.flaticon.com/512/1214/1214428.png" alt="">
                                </button>
                            </div>
                            <div class="answer-con">
                                <p class="card-text m-3" id="answer-<?= $cardID ?>" style="visibility: hidden;"><?= $answer ?></p>
                            </div>
                            
                        </div>
                    </div>

                    <?php
                }
            ?>
        </div>
    </div>
    <!-- Script JS -->
    <script src="https://cdn.jsdelivr.net/npm/fireworks-js/dist/fireworks.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    <script>

        function showNotification(message) {
    const notification = document.getElementById("notification");
    notification.textContent = message;
    notification.classList.add("show");

    // Hide notification after 3 seconds
    setTimeout(() => {
        notification.classList.remove("show");
    }, 3000);
}


    function searchFlashcards() {
        let searchQuery = document.getElementById('searchInput').value.toLowerCase();
        let cards = document.querySelectorAll('.card');
        let noResults = document.getElementById('noResults');
        let foundAny = false; // Track if any card matches the query
        
        cards.forEach(card => {
            let questionText = card.querySelector('.card-subtitle').innerText.toLowerCase();
            
            if (questionText.includes(searchQuery)) {
                card.style.display = 'block';
                foundAny = true; // We found at least one matching card
            } else {
                card.style.display = 'none';
            }
        });
        
        // Display 'No results' message if no cards match
        if (!foundAny) {
            noResults.style.display = 'block';
        } else {
            noResults.style.display = 'none';
        }
    }
        function showAnswer(id) {
            let answerElement = document.getElementById('answer-' + id);

            if (answerElement.style.visibility === 'hidden' || answerElement.style.visibility === '') {
                answerElement.style.visibility = 'visible';
            } else {
                answerElement.style.visibility = 'hidden';
            }
        }
        function updateFlashcard(id) {
            $("#updateFlashcardModal").modal("show");

            let updateQuestion = $("#question-" + id).html();
            let updateAnswer = $("#answer-" + id).html();

            $("#updateCardID").val(id);
            $("#updateQuestion").val(updateQuestion);
            $("#updateAnswer").val(updateAnswer);
        }
                function showAllActionButtons() {
            let actionButtons = document.querySelectorAll('.action-button');
            let cards = document.querySelectorAll('.card');  // Select all cards

            // Toggle the action buttons visibility
            actionButtons.forEach(button => {
                if (button.style.display === 'none' || button.style.display === '') {
                    button.style.display = 'block';
                } else {
                    button.style.display = 'none';
                }
            });

            // Toggle the "disabled-card" class to disable card click functionality but keep action buttons active
            cards.forEach(card => {
                card.classList.toggle('disabled-card'); // Disable click on cards
                card.classList.toggle('no-hover'); // Disable hover effect on card
            });
        }
                let deleteCardID = null; // Store the ID of the card to be deleted

        function deleteFlashcard(id) {
            deleteCardID = id; // Store the card ID
            $("#deleteConfirmationModal").modal("show"); // Show the delete confirmation modal
        }

        document.getElementById("confirmDeleteBtn").addEventListener("click", function() {
            if (deleteCardID !== null) {
                window.location = "./endpoint/delete-flashcard.php?card=" + deleteCardID; // Redirect to delete the card
            }
        });
let countdownInterval;
let timeLeft = 120;
let currentCardIndex = 0;
const cards = <?php echo json_encode($result); ?>;

function openFlashcardModal(index) {
    currentCardIndex = index;
    showFlashcard(currentCardIndex);
    const modal = document.getElementById("flashcardModal");
    
    // Fade in the modal when opening
    modal.classList.remove("fadeOut"); // Ensure fade-out is removed
    modal.style.display = "flex"; // Show modal
    setTimeout(() => modal.classList.add("show"), 50); // Add show class to start fade-in animation
    
    resetTimer();
}

function closeFlashcardModal() {
    clearInterval(countdownInterval); // Stop the timer when closing the modal
    const modal = document.getElementById("flashcardModal");
    
    // Fade out the modal before hiding
    modal.classList.remove("show"); // Remove show class to trigger fade-out
    modal.classList.add("fadeOut");
    
    setTimeout(() => {
        modal.style.display = "none"; // Hide the modal after fade-out completes
    }, 500); // This should match the duration of the fade-out transition (500ms)
    
    document.getElementById("userAnswer").value = ''; // Clear the user's answer
    document.getElementById("modalAnswerContainer").style.visibility = "hidden"; // Hide correct answer
}

function showFlashcard(index) {
    const card = cards[index];

    document.getElementById("modalQuestion").innerHTML = `<h5>Question ${index + 1}:</h5><h4>${card.question}</h4>`;
    document.getElementById("modalAnswer").innerText = card.answer; // Store correct answer in modal
    document.getElementById("modalAnswerContainer").style.visibility = "hidden"; // Hide answer initially

    document.getElementById('cardCount').innerText = `Card: ${index + 1} of ${cards.length}`;

    resetTimer(); // Reset the timer each time a new flashcard is opened
}

function resetTimer() {
    clearInterval(countdownInterval); // Clear any existing interval
    timeLeft = 5; // Reset timer to 120 seconds
    document.getElementById("timer").innerText = timeLeft; // Display the timer
    countdownInterval = setInterval(updateTimer, 1000); // Start countdown
}

function updateTimer() {
    if (timeLeft <= 0) {
        clearInterval(countdownInterval); // Stop the timer
        showCorrectAnswer(); // Show the correct answer when time runs out
    } else {
        timeLeft--;
        document.getElementById("timer").innerText = timeLeft; // Update the displayed time
    }
}

function toggleAnswerVisibility() {
    if (timeLeft > 0) {
        // If the timer is still running, show a warning message
        showNotification("Warning: You cannot view the answer before the timer ends!");
    } else {
        const answerElement = document.getElementById("modalAnswer");
        const toggleButton = document.querySelector(".toggle-answer");

        if (answerElement.classList.contains("visible")) {
            // Hide the answer and update the button text
            answerElement.classList.remove("visible");
            toggleButton.textContent = "Show Answer";
        } else {
            // Show the answer and update the button text
            answerElement.classList.add("visible");
            toggleButton.textContent = "Hide Answer";
        }
    }
}


function triggerFireworks() {
     const fireworksWrapper = document.createElement('div');
    fireworksWrapper.style.position = 'absolute';
    fireworksWrapper.style.top = 0;
    fireworksWrapper.style.left = 0;
    fireworksWrapper.style.width = '100%';
    fireworksWrapper.style.height = '100%';
    fireworksWrapper.style.zIndex = '-1'; // Make sure fireworks appear behind modal

    // Append the fireworks wrapper to the body
    document.body.appendChild(fireworksWrapper);

    // Initialize fireworks settings
    const fireworks = new Fireworks(fireworksWrapper, {
        rocketsPoint: 50, // Fireworks origin point from left (in percentage)
        speed: 2,
        acceleration: 1.05,
        friction: 0.98,
        gravity: 1.5,
        particles: 50, // Number of particles per explosion
        traceLength: 3,
        traceSpeed: 8,
        explosion: 2,
        intensity: 50, // Increase for more frequent explosions
        flickering: 50,
        lineWidth: 1,
        hue: { min: 0, max: 360 },
        brightness: { min: 10, max: 80 },
        decay: { min: 0.015, max: 0.03 },
        delay: { min: 15, max: 30 },
    });

    // Start the fireworks for 2 seconds
    fireworks.start();
    setTimeout(() => fireworks.stop(), 10000); // Stop after 2 seconds
}
// Trigger fireworks if the answer is correct


function showCorrectAnswer() {
    const userAnswer = document.getElementById("userAnswer").value.trim().toLowerCase();
    const correctAnswer = cards[currentCardIndex].answer.trim().toLowerCase();
    const answerContainer = document.getElementById("modalAnswerContainer");

    answerContainer.style.visibility = "visible"; 
    answerContainer.innerHTML = `<strong>Correct Answer:</strong> ${correctAnswer}`;

    showNotification(`Your Answer: ${userAnswer} | Correct Answer: ${correctAnswer}`);

    // Trigger fireworks if the user's answer is correct
    if (userAnswer === correctAnswer) {
        triggerFireworks();
    }
}


// Previous and Next Flashcard Functions with Transitions
function showPreviousFlashcard() {
    if (currentCardIndex > 0) {
        currentCardIndex--;
        navigateFlashcard();
    }
}

function showNextFlashcard() {
    if (currentCardIndex < cards.length - 1) {
        currentCardIndex++;
        navigateFlashcard();
    }
}

// Function to navigate flashcards with transitions
function navigateFlashcard() {
    const modal = document.getElementById("flashcardModal");
    
    // Start by fading out the modal content
    modal.classList.add("fadeOut");

    setTimeout(() => {
        showFlashcard(currentCardIndex); // Load the next flashcard
        modal.classList.remove("fadeOut");
        modal.classList.add("show"); // Fade in the modal again with new content
    }, 500); // Match the duration of the fade-out transition (500ms)
}

// Keyboard navigation (left and right arrows)
document.addEventListener('keydown', function(event) {
    if (event.key === 'ArrowLeft') {
        showPreviousFlashcard(); // Go to previous flashcard
    } else if (event.key === 'ArrowRight') {
        showNextFlashcard(); // Go to next flashcard
    }
});




    </script>
</body>
</html>