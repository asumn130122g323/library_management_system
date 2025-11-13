const quizData = [
    {
        question: "Who wrote '1984'?",
        options: ["George Orwell", "Aldous Huxley", "J.K. Rowling", "Ernest Hemingway"],
        correct: "George Orwell"
    },
    {
        question: "Which book is known as 'The Great American Novel'?",
        options: ["Moby-Dick", "The Great Gatsby", "To Kill a Mockingbird", "Pride and Prejudice"],
        correct: "The Great Gatsby"
    },
    {
        question: "What is the main character's name in 'The Catcher in the Rye'?",
        options: ["Holden Caulfield", "Jay Gatsby", "Hermione Granger", "Atticus Finch"],
        correct: "Holden Caulfield"
    },
    {
        question: "Which of these is a famous detective in literature?",
        options: ["Sherlock Holmes", "Hannibal Lecter", "Lisbeth Salander", "Jack Reacher"],
        correct: "Sherlock Holmes"
    },
    {
        question: "In which city is the book 'The Paris Library' set?",
        options: ["Paris", "London", "New York", "Berlin"],
        correct: "Paris"
    }
];

let currentQuestionIndex = 0;
let score = 0;

// Function to load the current question
function loadQuestion() {
    const questionData = quizData[currentQuestionIndex];
    const quizContainer = document.getElementById("quiz");

    quizContainer.innerHTML = `
        <div class="quiz-question">
            <p>${questionData.question}</p>
        </div>
        <div class="quiz-answer">
            ${questionData.options.map((option, index) => `
                <input type="radio" name="question${currentQuestionIndex}" value="${option}" id="answer${index}">
                <label for="answer${index}">${option}</label><br>
            `).join('')}
        </div>
    `;
}

// Function to submit the quiz
function submitQuiz() {
    const answers = document.querySelectorAll(`input[name="question${currentQuestionIndex}"]:checked`);
    const selectedAnswer = answers.length > 0 ? answers[0].value : null;

    if (selectedAnswer === quizData[currentQuestionIndex].correct) {
        score++;
    }

    currentQuestionIndex++;

    if (currentQuestionIndex < quizData.length) {
        loadQuestion();
    } else {
        showResult();
    }
}

// Function to display the result after the quiz is over
function showResult() {
    const result = document.getElementById("result");
    result.innerHTML = `You got ${score} out of ${quizData.length} correct!`;

    // Show the Restart button
    document.getElementById("restartButton").style.display = "inline-block";
}

// Function to restart the game
function restartGame() {
    // Reset score and question index
    score = 0;
    currentQuestionIndex = 0;

    // Hide the Restart button
    document.getElementById("restartButton").style.display = "none";

    // Reset the result message
    document.getElementById("result").innerHTML = "";

    // Load the first question
    loadQuestion();
}

// Start the quiz on page load
loadQuestion();
